<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\Models\User;
use DB;
use Illuminate\Support\Str;

class PasswordTest extends DuskTestCase
{
    /**
     * Test visit reset
     * @group reset
     *
     * @return void
     */
    public function testVisit()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->clickLink('Forgot Your Password?')
                    ->assertPathIs('/password/reset')
                    ->assertSee('Reset Password');
        });
    }

    /**
     * Test validation
     * @group reset
     *
     * @return void
     */
    public function testValidationEmail()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/password/reset')
                    ->type('email', 'slacker@l')
                    ->press('Send Password Reset Link')
                    ->assertSee('The email must be a valid email address');
        });
    }

    /**
     * Test email reset
     * @group reset
     *
     * @return void
     */
    public function testEmailReset()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/password/reset')
                    ->type('email', 'slacker@la.fr')
                    ->press('Send Password Reset Link')
                    ->assertSee('We have e-mailed your password reset link!');
        });
    }
}
