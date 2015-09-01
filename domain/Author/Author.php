<?php

namespace MyLibrary\Author;

use Illuminate\Database\Eloquent\Model;
use MyLibrary\Eventing\EventGenerator;

class Author extends Model
{
    use EventGenerator;

    public function store($name)
    {
        $this->name = $name;
        $this->save();

        $this->raise(new AuthorWasStored($this));

        return $this;
    }
}
