<?php

namespace Tests\Browser;

use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class AdminPostsListTest extends DuskTestCase
{
    /**
     * List and pagination test
     * @group postslist
     *
     * @return void
     */
    public function testListPagination()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit('admin/posts')
                    ->assertSee('Posts Gestion')
                    ->clickLink('2')
                    ->assertSee('Post 1');
        });
    }

    /**
     * Change new
     * @group postslist
     *
     * @return void
     */
    public function testChangeNew()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit('admin/posts')
                    ->assertSee('Post 9')
                    ->click('input[name="seen"][value="9"]')
                    ->click('.box-header input[name="new"]')
                    ->assertDontSee('Post 9');
        });
    }

    /**
     * Change new
     * @group postslist
     *
     * @return void
     */
    public function testChangeStatus()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit('admin/posts')
                ->assertSee('Post 9')
                ->click('input[name="status"][value="9"]')
                ->click('.box-header input[name="active"]')
                ->assertDontSee('Post 9');
        });
    }
}
