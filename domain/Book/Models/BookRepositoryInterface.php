<?php

namespace MyLibrary\Book\Models;

interface BookRepositoryInterface
{
    public function find($id);

    public function store($title, $authors);

    public function edit($id, $title, $authors);
}
