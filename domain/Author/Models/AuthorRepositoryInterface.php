<?php

namespace MyLibrary\Author\Models;

interface AuthorRepositoryInterface
{
    public function find($id);

    public function dropdown();

    public function store($name);

    public function edit($id, $name);

    public function datatables($request);
}
