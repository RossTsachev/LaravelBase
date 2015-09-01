<?php

namespace MyLibrary\Author;

class StoreAuthorCommand
{
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }
}
