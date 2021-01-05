<?php

namespace Quantic\ReactNative\Commands;

use Quantic\ReactNative\Commands\Workers;

class Listener
{
    private Array $response;
    private Object $console;

    public function __construct($console, $method, $arg)
    {
        $this->console = $console;
        $this->parseJobToDo($method, $arg);
    }

    /**
     * Verify if the invocated method exists
     *
     * @return void
     */
    private function parseJobToDo($method, $arg)
    {
        $workers = new Workers($method, $arg);
        $this->response = $workers->response;
        $this->render();
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