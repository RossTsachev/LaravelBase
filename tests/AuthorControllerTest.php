<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use MyLibrary\Author\Models\Author;
use MyLibrary\Author\Models\AuthorDatatables;

class AuthorControllerTest extends TestCase
{
    use DatabaseTransactions;

    private $saveAuthorId;

    /**
     * initial setup - calls parent setup
     * TO DO - check why transactions don't delete records at the end
     * authenticates user
     * and creates new author
     */
    public function setUp()
    {
        //very important
        parent::setUp();
        //authenticating user
        $user = new User(array('name' => 'test'));
        $this->be($user);

        //insert new author
        $this->saveAuthorId = DB::table('authors')
            ->insertGetId([
                'name' => 'John Lennon Junior'
            ]);
    }

    /**
     * view single author page
     * @return void
     */
    public function testAuthorControllerShow()
    {
        $this->visit('authors/'.$this->saveAuthorId)
            ->see('John Lennon Junior');
        $this->seeInDatabase('authors', ['name' => 'John Lennon Junior']);
    }

    /**
     * save Author
     * @return
     */
    public function testSaveNewAuthor()
    {
        $this->visit('/authors/create')
            ->type('John Lennon', 'name')
            ->press('Save')
            ->see('The author was saved.')
            ->onPage('/authors');
        $this->seeInDatabase('authors', ['name' => 'John Lennon']);
    }

    /**
     * cannot have an author with the same name
     * it is not set on database level, only front end
     * TO DO - backend unique author name
     * @return void
     */
    public function testSaveSameAuthor()
    {
        $this->visit('/authors/create')
            ->type('John Lennon Junior', 'name')
            ->press('Save')
            ->see('The name has already been taken.')
            ->onPage('/authors/create');
    }

    /**
     * edit Author
     * @return void
     */
    public function testEditAuthor()
    {
        $this->visit('/authors/' . $this->saveAuthorId . '/edit')
            ->see('John Lennon')
            ->type('John Lennon XXX', 'name')
            ->press('Edit')
            ->see('The author was edited.')
            ->onPage('/authors');
        $this->seeInDatabase('authors', ['name' => 'John Lennon XXX']);
    }

    public function testAllAuthors()
    {
        $author = Author::first();
        $this->setupInputVariables();
        $request = Request::capture();

        $datatables = new AuthorDatatables;
        $result = $datatables->datatables($request);
        $this->assertEquals($author->name, $result->getData()->data[0]->name);
    }

    public function testSearchAuthor()
    {
        $author = Author::first();
        $this->setupInputVariables($author->name);
        $request = Request::capture();

        $datatables = new AuthorDatatables;
        $result = $datatables->datatables($request);
        $this->assertEquals($author->name, $result->getData()->data[0]->name);
    }

    private function setupInputVariables($searchValue = '')
    {
        $_GET                                  = [];
        $_GET['draw']                          = 1;
        $_GET['start']                         = 0;
        $_GET['length']                        = 10;
        $_GET['search']['value']               = $searchValue;
        $_GET['search']['regex']               = false;

        $_GET['columns'][0]['data']            = 'id';
        $_GET['columns'][0]['name']            = 'id';
        $_GET['columns'][0]['search']['value'] = '';
        $_GET['columns'][0]['search']['regex'] = false;
        $_GET['columns'][0]['searchable']      = true;
        $_GET['columns'][0]['orderable']       = true;

        $_GET['columns'][1]['data']            = 'name';
        $_GET['columns'][1]['name']            = 'name';
        $_GET['columns'][1]['search']['value'] = '';
        $_GET['columns'][1]['search']['regex'] = false;
        $_GET['columns'][1]['searchable']      = true;
        $_GET['columns'][1]['orderable']       = true;

        $_GET['columns'][2]['data']            = 'books';
        $_GET['columns'][2]['name']            = 'books';
        $_GET['columns'][2]['search']['value'] = '';
        $_GET['columns'][2]['search']['regex'] = false;
        $_GET['columns'][2]['searchable']      = true;
        $_GET['columns'][2]['orderable']       = true;

        $_GET['columns'][3]['data']            = 'action';
        $_GET['columns'][3]['name']            = 'action';
        $_GET['columns'][3]['search']['value'] = '';
        $_GET['columns'][3]['search']['regex'] = false;
        $_GET['columns'][3]['searchable']      = false;
        $_GET['columns'][3]['orderable']       = false;

    }

    public function tearDown()
    {
        //
    }
}
