<?php

namespace Quantic\ReactNative\Jobbers;

class Compiler
{
    public array $response;
    private string $arg;
    
    public function __construct($arg)
    {
        $this->arg = $arg;
        $this->compile();
        return $this->response;
    }

    /**
     * Filters argument $arg type to compile the rights assets
     *
     * @return void
     */
    private function compile()
    {
        switch ($this->arg) {

            case 'styles':

                try {

                    $styles = $this->assetsParser(
                        config('reactnative.compile.styles'),
                        'styles.css'
                    );

                } catch (\ErrorException $e) {
                    $this->compileError();
                }

                break;

            case 'libs':

                try {

                    $scripts_head = $this->assetsParser(
                        config('reactnative.compile.scripts.head'),
                        'libs.js'
                    );

                } catch (\ErrorException $e) {
                    $this->compileError();
                }

                break;

            case 'scripts':

                try {

                    $scripts_footer = $this->assetsParser(
                        config('reactnative.compile.scripts.footer'),
                        'scripts.js'
                    );

                } catch (\ErrorException $e) {
                    $this->compileError();
                }

                break;

            case 'all':

                try {

                    $styles = $this->assetsParser(
                        config('reactnative.compile.styles'),
                        'styles.css'
                    );
                    $scripts_head = $this->assetsParser(
                        config('reactnative.compile.scripts.head'),
                        'libs.js'
                    );
                    $scripts_footer = $this->assetsParser(
                        config('reactnative.compile.scripts.footer'),
                        'scripts.js'
                    );

                } catch (\ErrorException $e) {
                    $this->compileError();
                }

                break;

            case 'remove':
                $this->removeAssets();
                break;

            default:

                $this->response = [
                    'type' => 'error',
                    'response' => '"' . $this->arg . '" argument is not valid'
                ];
                break;
        }
    }

    /**
     * Verify if asset exists. If it exists, the asset is deleted then recreated.
     * If not, the asset is simply created.
     *
     * @return void
     */
    private function assetsParser($files, $dest_filename)
    {
        try {

            $dist = base_path('app/ReactNative/assets/dist');
            $ifExistFile = $dist . '/' . $dest_filename;
            if (file_exists($ifExistFile)) {
                unlink($ifExistFile);
            }

            ob_start();
            foreach ($files as $file) {
                echo file_get_contents($file);
            }
            $content = ob_get_clean();

            if ($content !== '') {

                $newFile = fopen($ifExistFile, 'w');
                fwrite($newFile, $content);
                fclose($newFile);

                if ($this->arg === 'all') {

                    $this->response = [
                        'type' => 'info',
                        'response' => 'All files have been compiled and copied successfuly to ReactNative assets directory.'
                    ];

                } else {

                    $this->response = [
                        'type' => 'info',
                        'response' => $dest_filename . ' has been compiled and copied successfuly to ReactNative assets directory.'
                    ];
                }
                
            } else {

                $this->response = [
                    'type' => 'warn',
                    'response' => $dest_filename . ' has not been created because there is no source file to compile.'
                ];
            }

        } catch (\ErrorException $e) {
            $this->compileError();
        }
    }

    /**
     * Remove all ReactNative assets.
     *
     * @return void
     */
    private function removeAssets()
    {
        try {

            $styles = base_path('app/ReactNative/assets/dist/styles.css');
            $libs = base_path('app/ReactNative/assets/dist/libs.js');
            $scripts = base_path('app/ReactNative/assets/dist/scripts.js');

            if (file_exists($styles)) {
                unlink($styles);
            }

            if (file_exists($libs)) {
                unlink($libs);
            }

            if (file_exists($scripts)) {
                unlink($scripts);
            }

            $this->response = [
                'type' => 'info',
                'response' => 'All assets have been deleted from ReactNative assets directory.'
            ];

        } catch (\ErrorException $e) {

            $this->response = [
                'type' => 'error',
                'response' => 'Deleting assets process has failed.'
            ];
        }
    }

    /**
     * If permissions are not allowed, an error message is sent to the CLI
     *
     * @return void
     */
    private function compileError()
    {
        $this->response = [
            'type' => 'error',
            'response' => 'A compiling error has occured. Please check permissions.'
        ];
    }
}
