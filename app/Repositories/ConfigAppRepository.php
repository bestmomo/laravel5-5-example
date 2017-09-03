<?php

namespace App\Repositories;

class ConfigAppRepository
{
    /**
     * ConfigApp string representation.
     *
     * @var string
     */
    protected $configApp;

    /**
     * ConfigApp path.
     *
     * @var string
     */
    protected $configAppPath;

    /**
     * Items.
     *
     * @var array
     */
    protected $items = [
        'name' => [
            'name',
            "/('name' => ')(.+)(')/"
        ],
        'locale' => [
            'locale',
            "/('locale' => ')(.+)(')/"
        ],
        'timezone' => [
            'timezone',
            "/('timezone' => ')(.+)(')/"
        ],
        'backcommentsnestedlevel' => [
            'commentsNestedLevel',
            "/('commentsNestedLevel' =>\s)(.+)(,)/",
        ],
        'backcommentsparent' => [
            'numberParentComments',
            "/('numberParentComments' =>\s)(.+)(,)/",
        ],
        'frontposts' => [
            'nbrPages.front.posts',
            "/('front' => \[\n\s*'posts' =>\s)(.+)(,)/",
        ],
        'backposts' => [
            'nbrPages.back.posts',
            "/('back' => \[\n\s*'posts' =>\s)(.+)(,)/",
        ],
        'backusers' => [
            'nbrPages.back.users',
            "/('posts' =>\s.+\n\s*'users' =>\s)(.+)(,)/",
        ],
        'backcomments' => [
            'nbrPages.back.comments',
            "/('users' =>.+\n\s*'comments' =>\s)(.+)(,)/",
        ],
        'backcontacts' => [
            'nbrPages.back.contacts',
            "/('comments' =>.+\n\s*'contacts' =>\s)(.+)(,)/",
        ],
    ];

    /**
     * Create a new ConfigAppRepository.
     *
     */
    public function __construct()
    {
        $this->configAppPath = config_path ('app.php');

        $this->configApp = file_get_contents($this->configAppPath);
    }

    /**
     * Update app config.
     *
     * @param array $inputs
     */
    public function update($inputs)
    {
        foreach ($inputs as $key => $value) {
            if (config('app.' . $this->items[$key][0]) != $value) {
                $this->configApp = preg_replace ($this->items[$key][1], '${1}' . $value . '$3', $this->configApp);
            }
        }

        file_put_contents($this->configAppPath, $this->configApp);
    }
}