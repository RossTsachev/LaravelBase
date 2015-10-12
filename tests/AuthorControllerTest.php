<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

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

    public function tearDown()
    {
        //
    }
}
