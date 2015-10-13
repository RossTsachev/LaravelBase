<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use MyLibrary\Book\Models\Book;
use MyLibrary\Book\Models\BookDatatables;

class BookControllerTest extends TestCase
{
    use DatabaseTransactions;

    private $saveAuthorId;
    private $saveSecondAuthorId;
    private $saveBookId;

    /**
     * saving the book initially
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
                'name' => 'Ringo Star'
            ]);
        $this->saveSecondAuthorId = DB::table('authors')
            ->insertGetId([
                'name' => 'George Harrison'
            ]);
        //insert new book
        $this->saveBookId = DB::table('books')
            ->insertGetId([
                'title' => 'I play drums'
            ]);
        //make link author_book
        DB::table('author_book')
            ->insert([
                    'author_id' => $this->saveAuthorId,
                    'book_id' => $this->saveBookId
            ]);
    }

    /**
     * view single book page
     * @return void
     */
    public function testBookControllerShow()
    {
        $this->visit('books/'.$this->saveBookId)
            ->see('I play drums')
            ->see('Ringo Star');
        $this->seeInDatabase('books', ['title' => 'I play drums']);
    }

    /**
     * save Book
     * @return
     */
    public function testSaveNewBooks()
    {
        $this->visit('/books/create')
            ->submitForm(
                'Save',
                [
                'title' => 'I play guitar',
                'author_list' => [$this->saveAuthorId, $this->saveSecondAuthorId]
                ]
            )
            ->see('The book was saved.')
            ->onPage('/books');
        $this->seeInDatabase('books', ['title' => 'I play guitar']);
    }

    public function testEditBooks()
    {
        $this->visit('/books/' . $this->saveBookId . '/edit')
            ->see('I play drums')
            ->submitForm(
                'Edit',
                [
                'title' => 'I play guitar 111',
                'author_list' => [$this->saveAuthorId]
                ]
            )
            ->see('The book was edited.')
            ->onPage('books');

            $this->seeInDatabase('books', ['title' => 'I play guitar 111']);
    }

    public function testAllBooks()
    {
        $book = Book::first();
        $this->setupInputVariables();
        $request = Request::capture();

        $datatables = new BookDatatables;
        $result = $datatables->datatables($request);
        $this->assertEquals($book->title, $result->getData()->data[0]->title);
    }

    public function testSearchBook()
    {
        $book = Book::first();
        $this->setupInputVariables($book->title);
        $request = Request::capture();

        $datatables = new BookDatatables;
        $result = $datatables->datatables($request);
        $this->assertEquals($book->title, $result->getData()->data[0]->title);
    }

    private function setupInputVariables($searchValue = '')
    {
        $_GET                                  = [];
        $_GET['draw']                          = 1;
        $_GET['start']                         = 0;
        $_GET['length']                        = 10;
        $_GET['search']['value']               = $searchValue;
        $_GET['search']['regex']               = false;

        $_GET['columns'][0]['data']            = 'books.id';
        $_GET['columns'][0]['name']            = 'books.id';
        $_GET['columns'][0]['search']['value'] = '';
        $_GET['columns'][0]['search']['regex'] = false;
        $_GET['columns'][0]['searchable']      = true;
        $_GET['columns'][0]['orderable']       = true;

        $_GET['columns'][1]['data']            = 'books.title';
        $_GET['columns'][1]['name']            = 'books.title';
        $_GET['columns'][1]['search']['value'] = '';
        $_GET['columns'][1]['search']['regex'] = false;
        $_GET['columns'][1]['searchable']      = true;
        $_GET['columns'][1]['orderable']       = true;

        $_GET['columns'][2]['data']            = 'authors.authors';
        $_GET['columns'][2]['name']            = 'authors.authors';
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
}
