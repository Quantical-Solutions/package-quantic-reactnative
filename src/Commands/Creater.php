<?php

namespace Quantic\ReactNative\Commands;

use Quantic\ReactNative\Commands\HtmlStringParser;

class Creater extends HtmlStringParser
{
    private string $arg;
    private string $option;
    public array $response;

    public function __construct($arg, $option)
    {
        $this->arg = $arg;
        $this->option = $option;
        $this->create();
        return $this->response;
    }

    private function create()
    {
        $this->response = [
            'type' => 'info',
            'response' => 'Create Class is alive !'
        ];
    }
}
