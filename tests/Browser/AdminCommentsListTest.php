<?php

namespace Tests\Browser;

use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class AdminCommentsListTest extends DuskTestCase
{
    /**
     * List and pagination test
     * @group commentslist
     *
     * @return void
     */
    public function testListPagination()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(21))
                ->visit('/posts/post-2')
                ->type('message', 'My message')
                ->click('div.respond form button')
                ->assertSee('My message')
                ->loginAs(User::find(1))
                ->visit('/admin/comments')
                ->assertSee('Comments Gestion')
                ->assertSee('Sorditofublos')
                ->click('ul.pagination li:nth-child(3) a')
                ->assertDontSee('Sorditofublos');
        });
    }

    /**
     * Change new
     * @group commentslist
     *
     * @return void
     */
    public function testChangeNew()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit('admin/comments')
                ->assertSee('Sorditofublos')
                ->uncheck('seen')
                ->visit('admin/comments?new=on')
                ->assertDontSee('Sorditofublos');
        });
    }
}
