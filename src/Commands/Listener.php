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

    /**
     * Verify if the invocated method exists
     *
     * @return void
     */
    private function parseJobToDo($method, $arg, $option)
    {
        if ($arg === null) {

            switch ($method)
            {
                case 'create':
                    $this->console->newline();
                    $this->console->error('Error -> missing argument...');
                    $this->console->warn('You need to explicit a file name like in the exemple below:');
                    $this->console->info('reactnative:create head | footer | all');
                    $this->console->newline();
                    break;
                case 'compile':
                    $this->console->newline();
                    $this->console->error('Error -> missing argument...');
                    $this->console->warn('You need to specify an asset type like in the exemple below:');
                    $this->console->info('reactnative:compile styles | libs | scripts | all | remove');
                    $this->console->newline();
                    break;
                case 'url':
                    $this->console->newline();
                    $this->console->error('Error -> missing argument...');
                    $this->console->warn('You need to specify an URL for the WebView component source like in the exemple below:');
                    $this->console->info('reactnative:url http://exemple.com');
                    $this->console->newline();
                    break;
            }

        } else {

            $workers = new Workers($method, $arg, $option);
            $this->response = $workers->response;
            $this->render();
        }
    }

    /**
     * Write message in console depending on the task statement
     *
     * @return void
     */
    private function render()
    {
        $returnType = $this->response['type'];
        $returnResponse = $this->response['response'];
        switch ($returnType)
        {
            case 'line':
                $this->console->newline();
                $this->console->line('----------------');
                $this->console->warn('😶 Information :');
                $this->console->line('----------------');
                $this->console->line($returnResponse);
                $this->console->newline();
                break;
            case 'info':
                $this->console->newline();
                $this->console->line('-------------');
                $this->console->warn('😎 Good Job !');
                $this->console->line('-------------');
                $this->console->info($returnResponse);
                $this->console->newline();
                break;
            case 'warn':
                $this->console->newline();
                $this->console->line('------------');
                $this->console->warn('🤔 Warning :');
                $this->console->line('------------');
                $this->console->warn($returnResponse);
                $this->console->newline();
                break;
            case 'error':
                $this->console->newline();
                $this->console->line('---------------------');
                $this->console->warn('😓 What\'s the hell ?');
                $this->console->line('---------------------');
                $this->console->error($returnResponse);
                $this->console->newline();
                break;
        }
    }
}