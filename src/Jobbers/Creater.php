<?php

namespace Quantic\ReactNative\Jobbers;

use Quantic\ReactNative\Tools\HtmlStringParser;

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
        $build = $this->buildCapsule($this->arg, $this->option);
        $this->response = $this->result;
    }
}
