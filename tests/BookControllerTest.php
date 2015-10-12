<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

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

    public function testEditBoos()
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
}
