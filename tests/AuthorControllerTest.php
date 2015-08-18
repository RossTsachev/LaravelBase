<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class AuthorControllerTest extends TestCase
{
    use DatabaseTransactions;

    private $savedAuthorId;

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

    public function testAuthorControllerShow()
    {
        $this->visit('authors/'.$this->saveAuthorId)
            ->see('John Lennon Junior');
    }

    public function testSaveNewAuthor()
    {
        $this->visit('/authors/create')
            ->type('John Lennon', 'name')
            ->press('Save')
            ->see('The author was saved.')
            ->onPage('/authors');
    }

    public function testSaveSameAuthor()
    {
        $this->visit('/authors/create')
            ->type('John Lennon Junior', 'name')
            ->press('Save')
            ->see('The name has already been taken.')
            ->onPage('/authors/create');
    }

    public function tearDown()
    {
        //
    }
}