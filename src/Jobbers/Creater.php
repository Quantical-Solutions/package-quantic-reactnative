<?php

namespace Quantic\ReactNative\Jobbers;

use Quantic\ReactNative\Tools\HtmlStringParser;

class Creater extends HtmlStringParser
{
    private string $arg;
    public array $response;

    public function __construct($arg)
    {
        $this->arg = $arg;
        $this->create();
        return $this->response;
    }

    private function create()
    {
        $build = $this->buildCapsule($this->arg);
        $this->response = $this->result;
    }
}
