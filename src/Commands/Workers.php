<?php

namespace Quantic\ReactNative\Commands;

use Quantic\ReactNative\Jobbers\Compiler;
use Quantic\ReactNative\Jobbers\Creater;

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

    /**
     * Use Quantic\ReactNative\Jobbers\Creater to create html files
     *
     * @return void
     */
    private function create()
    {
        $creater = new Creater($this->arg, $this->option);
        $this->response = $creater->response;
    }

    /**
     * Use Quantic\ReactNative\Jobbers\Compiler to compile assets files
     *
     * @return void
     */
    private function compile()
    {
        $compiler = new Compiler($this->arg);
        $this->response = $compiler->response;
    }
}