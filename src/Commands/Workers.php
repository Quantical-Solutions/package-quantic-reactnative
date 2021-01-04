<?php

namespace Quantic\ReactNative\Commands;

use Quantic\ReactNative\Jobbers\Compiler;
use Quantic\ReactNative\Jobbers\Creater;
use Quantic\ReactNative\Jobbers\Url;

class Workers
{
    private string $arg;
    public array $response;

    public function __construct($method, $arg)
    {
        $this->arg = ($arg === null) ? 'none' : $arg;
        return $this->$method();
    }

    /**
     * Use Quantic\ReactNative\Jobbers\Creater to create html files
     *
     * @return void
     */
    private function create()
    {
        $creater = new Creater($this->arg);
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

    /**
     * Use Quantic\ReactNative\Jobbers\Compiler to compile url files
     *
     * @return void
     */
    private function url()
    {
        $url = new Url($this->arg);
        $this->response = $url->response;
    }
}