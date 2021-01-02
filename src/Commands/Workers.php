<?php

namespace Quantic\ReactNative\Commands;

use Quantic\ReactNative\Commands\Compiler;
use Quantic\ReactNative\Commands\Creater;

class Workers
{
    private string $arg;
    private string $option;
    public array $response;

    public function __construct($method, $arg, $option)
    {
        $this->option = $option;
        $this->arg = $arg;
        return $this->$method();
    }

    private function create()
    {
        $creater = new Creater($this->arg, $this->option);
        $this->response = $creater->response;
    }

    private function compile()
    {
        $compiler = new Compiler($this->arg);
        $this->response = $compiler->response;
    }
}