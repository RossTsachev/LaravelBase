<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;

use App\Http\Requests\PostRequest;

use MyLibrary\Post\Jobs\StorePostJob;

class PostController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store($books, PostRequest $request)
    {
        $this->dispatch(new StorePostJob(
            Auth::user()->id,
            $books,
            $request->comment
        ));

        return redirect($request->url());
    }
}
