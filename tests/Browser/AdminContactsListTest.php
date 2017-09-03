<?php

namespace Tests\Browser;

use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class AdminContactsListTest extends DuskTestCase
{
    /**
     * List and pagination test
     * @group contactslist
     *
     * @return void
     */
    public function testListPagination()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit('admin/contacts')
                    ->assertSee('Contacts Gestion')
                    ->assertSee('Softagonopoulos')
                    ->click('ul.pagination li:nth-child(3) a')
                    ->assertDontSee('Softagonopoulos');
        });
    }

    /**
     * Change new
     * @group contactslist
     *
     * @return void
     */
    public function testChangeNew()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit('admin/contacts')
                ->assertSee('Softagonopoulos')
                ->click('input[value="6"]')
                ->visit('admin/contacts?new=on')
                ->assertDontSee('Softagonopoulos');
        });
    }

}
