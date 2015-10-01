<?php

namespace app\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use MyLibrary\Author\Requests\AuthorRequest;

use MyLibrary\Author\Models\AuthorRepositoryInterface;
use MyLibrary\Author\Models\AuthorDatatables;
use MyLibrary\Author\Jobs\StoreAuthorJob;
use MyLibrary\Author\Jobs\UpdateAuthorJob;

class AuthorController extends Controller
{
    
    protected $author;

    /**
     * injects the author upon creation
     */
    public function __construct(AuthorRepositoryInterface $author)
    {
        $this->author = $author;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('authors.index');
    }

    /**
     * Displays json for all the authors.
     *
     * @return json
     */
    public function getAuthors(Request $request, AuthorDatatables $datatables)
    {
        $result = $datatables->datatables($request);
        
        return $result;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('authors.create');
    }

    /**
     * Store a newly created resource in storage.
     * Validated by author response.
     *
     * @return Response
     */
    public function store(AuthorRequest $request)
    {
        $input = $request->all();
        $this->dispatch(new StoreAuthorJob($input['name']));

        return redirect('authors');
    }

    /**
     * Display the specified resource.
     *
     * @return Response
     */
    public function show($id)
    {
        $author = $this->author->find($id);

        return view('authors.show')->with('author', $author);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return Response
     */
    public function edit($id)
    {
        $author = $this->author->find($id);

        return view('authors.edit')->with('author', $author);
    }

    /**
     * Update the specified resource in storage.
     * Validated by author response
     *
     * @return Response
     */
    public function update($id, AuthorRequest $request)
    {
        $input = $request->all();
        $this->dispatch(new UpdateAuthorJob($id, $input['name']));

        return redirect('authors');
    }
}
