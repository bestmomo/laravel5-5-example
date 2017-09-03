<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class LoginTest extends DuskTestCase
{
    /**
     * Test login by name and logout
     * @group login
     *
     * @return void
     */
    public function testLoginByNameAndLogout()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('log', 'Slacker')
                    ->type('password', 'slacker')
                    ->press('Login')
                    ->assertPathIs('/')
                    ->assertSee('Logout')
                    ->clickLink('Logout')
                    ->assertSee('Login');
        });
    }

    /**
     * Test login by email
     * @group login
     *
     * @return void
     */
    public function testLoginByEmail()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('log', 'redac@la.fr')
                    ->type('password', 'redac')
                    ->press('Login')
                    ->assertPathIs('/')
                    ->assertSee('Logout')
                    ->clickLink('Logout');
        });
    }

    /**
     * Test login fail
     * @group login
     *
     * @return void
     */
    public function testLoginFail()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('log', 'toto@la.fr')
                    ->type('password', 'toto')
                    ->press('Login')
                    ->assertSee('These credentials do not match our records');
        });
    }
}
