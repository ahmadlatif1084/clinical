<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {

        $user=factory(User::class)->create([
            'email' => 'admin@admin.com'
        ]);

        $this->browse(function (Browser $browser)use($user){
            $browser->visit('clinical/login')
                    ->type('email',$user->email)
                    ->type('password','secret')
                    ->press('Login')
                    ->assertPathIs('/home');
        });

        $user->forceDelete();
//        $this->browse(function ($browser) {
//            $browser->visit('/') //Go to the homepage
//            ->clickLink('Register') //Click the Register link
//            ->assertSee('Register') //Make sure the phrase in the arguement is on the page
//            //Fill the form with these values
//            ->value('#name', 'Joe')
//                ->value('#email', 'joe@example.com')
//                ->value('#password', '123456')
//                ->value('#password-confirm', '123456')
//                ->click('button[type="submit"]') //Click the submit button on the page
//                ->assertPathIs('/home') //Make sure you are in the home page
//                //Make sure you see the phrase in the arguement
//                ->assertSee("You are logged in!");
//        });

    }
}
