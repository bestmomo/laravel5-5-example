<?php

namespace Tests\Browser;

use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class AdminUsersEditTest extends DuskTestCase
{
    /**
     * List and pagination test
     * @group usersedit
     *
     * @return void
     */
    public function testForm()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit('admin/users/22/edit')
                    ->assertInputValue('input[name="name"]', 'Martinobinus')
                    ->assertInputValue('input[name="email"]', 'martin@la.fr')
                    ->assertSelected('role', 'user');
        });
    }

    /**
     * Validation test
     * @group usersedit
     *
     * @return void
     */
    public function testValidation()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit('admin/users/22/edit')
                    ->type('name', 'GreatAdmin')
                    ->type('email', 'mail@o')
                    ->press('Submit')
                    ->assertSee('The name has already been taken')
                    ->assertSee('The email must be a valid email address')
                    ->type('name', str_random(300))
                    ->type('email', 'admin@la.fr')
                    ->press('Submit')
                    ->assertSee('The name may not be greater than 255 characters')
                    ->assertSee('The email has already been taken');
        });
    }

    /**
     * Update test
     * @group usersedit
     *
     * @return void
     */
    public function testUpdate()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit('admin/users/22/edit')
                    ->type('name', 'Raftopoulostinus')
                    ->type('email', 'raftopoulostinus@rafto.com')
                    ->select('role', 'redac')
                    ->check('confirmed')
                    ->check('valid')
                    ->press('Submit')
                    ->assertSee('The user has been successfully updated')
                    ->assertInputValue('input[name="name"]', 'Raftopoulostinus')
                    ->assertInputValue('input[name="email"]', 'raftopoulostinus@rafto.com')
                    ->assertSelected('role', 'redac')
                    ->assertSee('Confirmed')
                    ->assertSee('Valid');
        });
    }
}
