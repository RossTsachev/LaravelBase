<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use MyLibrary\Commanding\CommandBus;

class BaseController extends Controller
{

    protected $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->middleware('auth');
        $this->commandBus = $commandBus;
    }
}
