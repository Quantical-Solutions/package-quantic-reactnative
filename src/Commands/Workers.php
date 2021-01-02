<?php

namespace Quantic\ReactNative\Commands;

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
        $this->response = [
            'type' => 'info',
            'response' => 'Create ReactNative'
        ];
    }

    private function compile()
    {
        $this->response = [
            'type' => 'warn',
            'response' => 'Compile ReactNative'
        ];
    }
}