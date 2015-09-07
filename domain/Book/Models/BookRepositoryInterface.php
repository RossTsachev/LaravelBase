<?php

namespace MyLibrary\Book\Models;

interface BookRepositoryInterface
{
    public function find($id);

    public function datatables($request);
}
