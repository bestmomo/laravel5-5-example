<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\Models\User;

class RegisterTest extends DuskTestCase
{
    /**
     * Test visit register
     * @group registration
     *
     * @return void
     */
    public function testVisit()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->clickLink('Not registered?')
                    ->assertPathIs('/register')
                    ->assertSee('Register');
        });
    }

    /**
     * Test validation
     * @group registration
     *
     * @return void
     */
    public function testValidation()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->type('name', 'Slacker')
                    ->type('email', 'slacker@la.fr')
                    ->type('password', '01')
                    ->type('password_confirmation', '01')
                    ->press('Register')
                    ->assertSee('The name has already been taken')
                    ->assertSee('The email has already been taken')
                    ->assertSee('The password must be at least 6 characters')
                    ->type('name', str_random(300))
                    ->type('email', 'slacker@l')
                    ->type('password', str_random(10))
                    ->type('password_confirmation', '01')
                    ->press('Register')
                    ->assertSee('The name may not be greater than 255 characters')
                    ->assertSee('The email must be a valid email address')
                    ->assertSee('The password confirmation does not match');
        });
    }

    /**
     * Test registration
     * @group registration
     *
     * @return void
     */
    public function testRegistration()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->type('name', 'Dupont')
                    ->type('email', 'dupont@la.fr')
                    ->type('password', 'dupont')
                    ->type('password_confirmation', 'dupont')
                    ->press('Register')
                    ->assertSee('Thanks for signing up! Please check your email');
        });
    }

    /**
     * Test confirmation
     * @group registration
     *
     * @return void
     */
    public function testConfirmation()
    {
        $user = User::whereEmail('dupont@la.fr')->first();

        $this->browse(function (Browser $browser) use($user) {
            $browser->visit('/confirmation/' . $user->id . '/' . $user->confirmation_code)
                    ->assertSee('You have successfully verified your account! You can now login');
        });
    }
}
