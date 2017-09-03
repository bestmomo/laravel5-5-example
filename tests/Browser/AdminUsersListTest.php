<?php

namespace Tests\Browser;

use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class AdminUsersListTest extends DuskTestCase
{
    /**
     * List and pagination test
     * @group userslist
     *
     * @return void
     */
    public function testListPagination()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit('admin/users')
                    ->assertSee('Users Gestion')
                    ->clickLink('3')
                    ->assertSee('GreatRedactor');
        });
    }

    /**
     * Roles test
     * @group userslist
     *
     * @return void
     */
    public function testRoles()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit('admin/users')
                    ->click('input[name="role"][value="admin"]')
                    ->assertSee('GreatAdmin')
                    ->click('input[name="role"][value="redac"]')
                    ->assertSee('GreatRedactor')
                    ->click('input[name="role"][value="user"]')
                    ->assertDontSee('GreatRedactor');
        });
    }

    /**
     * Roles status
     * @group userslist
     *
     * @return void
     */
    public function testStatus()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit('admin/users')
                    ->click('input[name="new"]')
                    ->assertDontSee('Martinobinus')
                    ->click('input[name="new"]')
                    ->click('input[name="valid"]')
                    ->assertDontSee('Martinobinus')
                    ->click('input[name="valid"]')
                    ->click('input[name="confirmed"]')
                    ->assertDontSee('Martinobinus');
        });
    }

    /**
     * Change new
     * @group userslist
     *
     * @return void
     */
    public function testChangeNew()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit('admin/users')
                    ->assertSee('Sorditofublos')
                    ->click('input[value="21"]')
                    ->click('input[name="new"]')
                    ->assertDontSee('Sorditofublos');
        });
    }
}
