<?php

namespace Quantic\ReactNative\Commands;

class Listener
{
    public Array $response;

    public function __construct($console, $method, $arg, $option)
    {
        $this->response = [
            'type' => 'warn',
            'response' => 'Salut ReactNative'
        ];
        
        $this->render($console);
    }

    private function render($console)
    {
        $returnType = $this->response['type'];
        $returnResponse = $this->response['response'];
        switch ($returnType)
        {
            case 'line': $console->line($returnResponse); break;
            case 'info': $console->info($returnResponse); break;
            case 'warn': $console->warn($returnResponse); break;
            case 'error': $console->error($returnResponse); break;
        }
    }
}