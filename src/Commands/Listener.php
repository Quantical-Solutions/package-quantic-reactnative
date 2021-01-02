<?php

namespace Quantic\ReactNative\Commands;

use Quantic\ReactNative\Commands\Workers;

class Listener
{
    private Array $response;
    private Object $console;

    public function __construct($console, $method, $arg, $option)
    {
        $this->console = $console;
        $this->parseJobToDo($method, $arg, $option);
    }

    private function parseJobToDo($method, $arg, $option)
    {
        if ($arg === null) {

            switch ($method)
            {
                case 'create': $this->console->error('You need to explicit a file name'); break;
                case 'compile': $this->console->error('You need to specify an extension type'); break;
                default:
                    $this->console->error('reactnative":' . $method . '" does not exist...');
                    $this->console->info('Methods available :');
                    $this->console->info(':create <filename> [–-type=<filetype>]');
                    break;
            }

        } else {

            $workers = new Workers($method, $arg, $option);
            $this->response = $workers->response;
            $this->render();
        }
    }

    private function render()
    {
        $returnType = $this->response['type'];
        $returnResponse = $this->response['response'];
        switch ($returnType)
        {
            case 'line': $this->console->line($returnResponse); break;
            case 'info': $this->console->info($returnResponse); break;
            case 'warn': $this->console->warn($returnResponse); break;
            case 'error': $this->console->error($returnResponse); break;
        }
    }
}