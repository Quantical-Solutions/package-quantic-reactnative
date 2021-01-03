<?php

namespace Quantic\ReactNative\Tools;

class HtmlStringParser
{
    private string $head;
    private string $footer;
    public array $result;
    
    public function buildCapsule($arg, $option)
    {
        $headStyles = $headLibs = $footerScripts = '';
        
        $styles = app_path('ReactNative/assets/dist/styles.css');
        if (file_exists($styles)) {
            ob_start();
            require $styles;
            $headStyles = ob_get_clean();
        }

        $libs = app_path('ReactNative/assets/dist/libs.js');
        if (file_exists($libs)) {
            ob_start();
            require $libs;
            $headLibs = ob_get_clean();
        }

        $scripts = app_path('ReactNative/assets/dist/scripts.js');
        if (file_exists($scripts)) {
            ob_start();
            require $scripts;
            $footerScripts = ob_get_clean();
        }

        ob_start();
        require dirname(dirname(__DIR__)) . '/stubs/templates/head.template.php';
        $this->head = ob_get_clean();

        ob_start();
        require dirname(dirname(__DIR__)) . '/stubs/templates/footer.template.php';
        $this->footer = ob_get_clean();

        $this->renderComponents($arg, $option);
    }
    
    private function renderComponents($arg, $option)
    {
        $dist = app_path('ReactNative/includes/common');

        if ($arg === 'head') {

            try {

                $ifHeadExists = $dist . '/head.html';
                if (file_exists($ifHeadExists)) {
                    unlink($ifHeadExists);
                }

                $newHead = fopen($ifHeadExists, 'w');
                fwrite($newHead, $this->head);
                fclose($newHead);

                $this->result = [
                    'type' => 'info',
                    'response' => 'head.html has been created successfuly !'
                ];

            } catch (\ErrorException $e) {

                $this->result = [
                    'type' => 'error',
                    'response' => 'Something went wrong while trying to create head.html in ReactNative includes/common folder...'
                ];
            }

        } else if ($arg === 'footer') {

            try {

                $ifFooterExists = $dist . '/footer.html';
                if (file_exists($ifFooterExists)) {
                    unlink($ifFooterExists);
                }

                $newFooter = fopen($ifFooterExists, 'w');
                fwrite($newFooter, $this->footer);
                fclose($newFooter);

                $this->result = [
                    'type' => 'info',
                    'response' => 'footer.html has been created successfuly !'
                ];

            } catch (\ErrorException $e) {

                $this->result = [
                    'type' => 'error',
                    'response' => 'Something went wrong while trying to create footer.html in ReactNative includes/common folder...'
                ];
            }

        } else if ($arg === 'all') {

            try {

                $ifHeadExists = $dist . '/head.html';
                if (file_exists($ifHeadExists)) {
                    unlink($ifHeadExists);
                }

                $newHead = fopen($ifHeadExists, 'w');
                fwrite($newHead, $this->head);
                fclose($newHead);

                $this->result = [
                    'type' => 'info',
                    'response' => 'head.html has been created successfuly !'
                ];

            } catch (\ErrorException $e) {

                $this->result = [
                    'type' => 'error',
                    'response' => 'Something went wrong while trying to create head.html in ReactNative includes/common folder...'
                ];
            }

            try {

                $ifFooterExists = $dist . '/footer.html';
                if (file_exists($ifFooterExists)) {
                    unlink($ifFooterExists);
                }

                $newFooter = fopen($ifFooterExists, 'w');
                fwrite($newFooter, $this->footer);
                fclose($newFooter);

                $this->result = [
                    'type' => 'info',
                    'response' => 'footer.html has been created successfuly !'
                ];

            } catch (\ErrorException $e) {

                $this->result = [
                    'type' => 'error',
                    'response' => 'Something went wrong while trying to create footer.html in ReactNative includes/common folder...'
                ];
            }
            
        } else {

            $this->result = [
                'type' => 'warn',
                'response' => '"' . $arg . '" argument is not available. You mean "head", "footer" or "all" ?'
            ];
        }
    }
}
