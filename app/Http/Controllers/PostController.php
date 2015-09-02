<?php namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Controllers\BaseController;

use Illuminate\Http\Request;

use Auth;
use App\Post;
use Session;
use MyLibrary\Post\StorePostCommand;

class PostController extends BaseController
{

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store($books, PostRequest $request)
    {
        $command = new StorePostCommand(
            Auth::user()->id,
            $books,
            $request->comment
        );
        $this->commandBus->execute($command);

        return redirect($request->url());
    }
}
