<?php

namespace Tests\Browser;

use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class CommentsTest extends DuskTestCase
{
    /**
     * Add comment test
     * @group comments
     *
     * @return void
     */
    public function testAddComment()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(4))
                    ->visit('/posts/post-2')
                    ->type('message', 'My message')
                    ->click('div.respond form button')
                    ->assertSee('My message')
                    ->type('message', 'My second message')
                    ->click('div.respond form button')
                    ->assertDontSee('Walker')
                    ->clickLink('More comments')
                    ->assertSee('Walker')
            ;
        });
    }
}
