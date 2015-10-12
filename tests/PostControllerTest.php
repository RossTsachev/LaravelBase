<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class PostControllerTest extends TestCase
{
    private $authorId;
    private $bookId;
    private $postId;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        //authenticating user
        $user = new User(array('id' => 1));
        $this->be($user);
        //new author
        $this->authorId = DB::table('authors')
            ->insertGetId([
                'name' => 'Stephen King'
            ]);
        //new book
        //insert new book
        $this->bookId = DB::table('books')
            ->insertGetId([
                'title' => 'It'
            ]);
        //make link author_book
        DB::table('author_book')
            ->insert([
                    'author_id' => $this->authorId,
                    'book_id' => $this->bookId
            ]);
        //new post
        DB::table('posts')
            ->insert([
                    'user_id' => 1,
                    'book_id' => $this->bookId,
                    'comment' => 'Very good book!'
            ]);
    }

    public function testPostControllerShow()
    {
        $this->visit('/books/' . $this->bookId)
            ->see('Very good book!');
        $this->seeInDatabase('posts', ['comment' => 'Very good book!']);
    }

    public function testSaveNewPost()
    {

        //this way recognizes the user
        $user = factory(App\User::class)->create();

        $this->actingAs($user)
            ->visit('/books/' . $this->bookId)
            ->submitForm('Save', ['comment' => 'I totally agree.'])
            ->see('The post was saved.')
            ->onPage('/books/' . $this->bookId);

        $this->seeInDatabase('posts', ['comment' => 'I totally agree.']);
    }
}
