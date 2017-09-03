<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class PostsTest extends DuskTestCase
{
    /**
     * Pagination test
     * @group posts
     *
     * @return void
     */
    public function testPagination()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSeeLink('Post 10')
                    ->clickLink('Next')
                    ->assertSeeLink('Post 1')
                    ->clickLink('Previous')
                    ->assertSeeLink('Post 10');
        });
    }

    /**
     * Categories test
     * @group posts
     *
     * @return void
     */
    public function testCategories()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->clickLink('Category 1')
                    ->assertSee('Category 1');
        });
    }

    /**
     * Tags test
     * @group posts
     *
     * @return void
     */
    public function testTags()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/posts/tag/3')
                    ->assertSee('Posts found with tag Tag3');
        });
    }

    /**
     * Post test and navigation
     * @group posts
     *
     * @return void
     */
    public function testPost()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/posts/post-2')
                    ->assertSee('Post 2')
                    ->clickLink('Post 1')
                    ->assertSee('Post 1')
                    ->clickLink('Post 2')
                    ->assertSee('Post 2');
        });
    }
}
