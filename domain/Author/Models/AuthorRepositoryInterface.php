<?php

namespace MyLibrary\Author\Models;

interface AuthorRepositoryInterface
{
    public function find($id);

    public function datatables($request);
}
