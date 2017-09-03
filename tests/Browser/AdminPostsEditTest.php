<?php

namespace Tests\Browser;

use App\Models\User;
use Facebook\WebDriver\WebDriverBy;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class AdminPostsEditTest extends DuskTestCase
{
    /**
     * List and pagination test
     * @group postsedit
     *
     * @return void
     */
    public function testForm()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit('admin/posts/9/edit')
                    ->assertInputValue('input[name="title"]', 'Post 9')
                    ->assertInputValue('textarea[name="excerpt"]', 'Consequatur sequi temporibus enim. Neque atque quo et rerum. Nihil quis maxime eos aut qui modi. Eos illo iste quaerat voluptatem illum.')
                    ->assertInputValue('input[name="tags"]', 'Tag1,Tag2,Tag5,Tag6')
                    ->assertInputValue('input[name="slug"]', 'post-9')
                    ->assertInputValue('input[name="image"]', '/files/user2/img09.jpg')
                    ->assertInputValue('textarea[name="meta_description"]', 'Aperiam molestiae ut sed vel harum nulla vel.')
                    ->assertInputValue('textarea[name="meta_keywords"]', 'minus,facilis,quo')
                    ->assertInputValue('input[name="seo_title"]', 'Post 9')
                    ->assertSelected('select[name="categories[]"]', '1')
                    ->assertChecked('input[name="active"]');
        });
    }

    /**
     * Validation test
     * @group postsedit
     *
     * @return void
     */
    public function testValidation()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit('admin/posts/9/edit')
                ->type('title', str_random(300))
                ->type('seo_title', str_random(300))
                ->type('image', str_random(300))
                ->type('slug', 'post-1')
                ->type('meta_keywords', 'one two')
                ->type('tags', 'one two')
                ->press('Submit')
                ->assertSee('The title may not be greater than 255 characters')
                ->assertSee('The seo title may not be greater than 255 characters')
                ->assertSee('The image may not be greater than 255 characters')
                ->assertSee('Keywords, separated by commas (no spaces), should have a maximum of 50 characters')
                ->assertSee('Tags, separated by commas (no spaces), should have a maximum of 50 characters')
                ->assertSee('The slug has already been taken');
        });
    }

    /**
     * Update test
     * @group postsedit
     *
     * @return void
     */
    public function testUpdate()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit('admin/posts/9/edit')
                ->select('categories[]','3')
                ->type('title', 'Post 99')
                ->type('seo_title', 'Post 099')
                ->type('slug', 'post-99')
                ->type('meta_keywords', 'one,two')
                ->type('tags', 'Tag3,Tag20');

            $this->typeInCKEditor('#cke_body iframe', $browser, 'Post Body 99');

            $browser->press('Submit')
                ->assertSee('The post has been successfully updated')
                ->visit('admin/posts/9')
                ->assertSee('Post 99')
                ->assertSee('Post Body 99')
                ->assertSee('Post 099')
                ->assertSee('post-99')
                ->assertSee('one,two')
                ->assertSee('Tag3')
                ->assertSee('Tag20')
                ->assertSee('Category 3');
        });
    }

    /**
     * @param string $selector
     * @param \Laravel\Dusk\Browser $browser
     * @param string $text
     */
    public function typeInCKEditor ($selector, $browser, $text)
    {
        $ckIframe = $browser->elements($selector)[0];
        $browser->driver->switchTo()->frame($ckIframe);
        $body = $browser->driver->findElement(WebDriverBy::xpath('//body'));
        $body->sendKeys($text);
        $browser->driver->switchTo()->defaultContent();
    }
}
