<?php

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use App\Models\Contact;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Users
        User::create(
            [
                'name' => 'GreatAdmin',
                'email' => 'admin@la.fr',
                'password' => bcrypt('admin'),
                'role' => 'admin',
                'valid' => true,
                'confirmed' => true,
                'remember_token' => str_random(10),
            ]
        );
        User::create(
            [
                'name' => 'GreatRedactor',
                'email' => 'redac@la.fr',
                'password' => bcrypt('redac'),
                'role' => 'redac',
                'valid' => true,
                'confirmed' => true,
                'remember_token' => str_random(10),
            ]
        );
        User::create(
            [
                'name' => 'Walker',
                'email' => 'walker@la.fr',
                'password' => bcrypt('walker'),
                'role' => 'user',
                'valid' => true,
                'confirmed' => true,
                'remember_token' => str_random(10),
            ]
        );
        User::create(
            [
                'name' => 'Slacker',
                'email' => 'slacker@la.fr',
                'password' => bcrypt('slacker'),
                'role' => 'user',
                'valid' => true,
                'confirmed' => true,
                'remember_token' => str_random(10),
            ]
        );
        User::create(
            [
                'name' => 'Worker',
                'email' => 'worker@la.fr',
                'password' => bcrypt('worker'),
                'role' => 'user',
                'valid' => false,
                'confirmed' => true,
                'remember_token' => str_random(10),
            ]
        );

        // Uncheck new for these users
        foreach(User::all() as $user) {
            $user->ingoing->delete();
        }

        $nbrUsers = 5;

        // Other users
        factory(User::class, 15)->create();
        sleep(2);
        User::create(
            [
                'name' => 'Sorditofublos',
                'email' => 'sordi@la.fr',
                'password' => bcrypt('sordi'),
                'role' => 'user',
                'valid' => true,
                'confirmed' => true,
                'remember_token' => str_random(10),
            ]
        );
        $user = User::create(
            [
                'name' => 'Martinobinus',
                'email' => 'martin@la.fr',
                'password' => bcrypt('martin'),
                'role' => 'user',
                'valid' => false,
                'confirmed' => false,
                'remember_token' => str_random(10),
            ]
        );
        $user->ingoing->delete();

        // Categories
        DB::table('categories')->insert([
            [
                'title' => 'Category 1',
                'slug' => 'category-1'
            ],
            [
                'title' => 'Category 2',
                'slug' => 'category-2'
            ],
            [
                'title' => 'Category 3',
                'slug' => 'category-3'
            ],
        ]);

        $nbrCategories = 3;

        // Contacts
        factory(Contact::class, 5)->create();
        sleep(2);
        factory(Contact::class)->create([
            'name' => 'Softagonopoulos',
        ]);


        // Tags
        DB::table('tags')->insert([
            ['tag' => 'Tag1'],
            ['tag' => 'Tag2'],
            ['tag' => 'Tag3'],
            ['tag' => 'Tag4'],
            ['tag' => 'Tag5'],
            ['tag' => 'Tag6']
        ]);

        $nbrTags = 6;

        // Posts
        factory(Post::class)->create([
            'title' => 'Post 1',
            'slug' => 'post-1',
            'seo_title' => 'Post 1',
            'user_id' => 1,
            'image' => '/files/img01.jpg',
        ]);

        factory(Post::class)->create([
            'title' => 'Post 2',
            'slug' => 'post-2',
            'seo_title' => 'Post 2',
            'user_id' => 1,
            'image' => '/files/img02.jpg',
        ]);

        sleep(2);

        factory(Post::class)->create([
            'title' => 'Post 3',
            'slug' => 'post-3',
            'seo_title' => 'Post 3',
            'user_id' => 2,
            'image' => '/files/user2/img03.jpg',
        ]);

        factory(Post::class)->create([
            'title' => 'Post 4',
            'slug' => 'post-4',
            'seo_title' => 'Post 4',
            'user_id' => 2,
            'image' => '/files/user2/img04.jpg',
        ]);

        factory(Post::class)->create([
            'title' => 'Post 5',
            'slug' => 'post-5',
            'seo_title' => 'Post 5',
            'user_id' => 2,
            'image' => '/files/user2/img05.jpg',
        ]);

        factory(Post::class)->create([
            'title' => 'Post 6',
            'slug' => 'post-6',
            'seo_title' => 'Post 6',
            'user_id' => 2,
            'image' => '/files/user2/img06.jpg',
        ]);

        factory(Post::class)->create([
            'title' => 'Post 7',
            'slug' => 'post-7',
            'seo_title' => 'Post 7',
            'user_id' => 2,
            'image' => '/files/user2/img07.png',
        ]);

        sleep(2);

        factory(Post::class)->create([
            'title' => 'Post 8',
            'slug' => 'post-8',
            'seo_title' => 'Post 8',
            'user_id' => 2,
            'image' => '/files/user2/img08.jpg',
        ]);

        Post::create([
            'title' => 'Post 9',
            'slug' => 'post-9',
            'seo_title' => 'Post 9',
            'user_id' => 2,
            'image' => '/files/user2/img09.jpg',
            'meta_description' => 'Aperiam molestiae ut sed vel harum nulla vel.',
            'meta_keywords' => 'minus,facilis,quo',
            'excerpt' => 'Consequatur sequi temporibus enim. Neque atque quo et rerum. Nihil quis maxime eos aut qui modi. Eos illo iste quaerat voluptatem illum.',
            'body' => 'Asperiores dicta necessitatibus ea. Veritatis beatae similique accusantium ad omnis. Nihil laudantium quo dolor expedita. Quia qui voluptas ipsa omnis magni et aut voluptatem. Et molestiae explicabo delectus voluptas voluptates.',
            'active' => true,
        ]);

        factory(Post::class)->create([
            'title' => 'Post 10',
            'slug' => 'post-10',
            'seo_title' => 'Post 10',
            'user_id' => 2,
            'image' => '/files/user2/img10.jpg',
        ]);

        $nbrPosts = 10;

        // Tags attachment
        $posts = Post::all();

        foreach ($posts as $post) {
            if ($post->id === 9) {
                $numbers=[1,2,5,6];
                $n = 4;
            } else {
                $numbers = range (1, $nbrTags);
                shuffle ($numbers);
                $n = rand (2, 4);
            }
            for($i = 0; $i < $n; ++$i) {
                $post->tags()->attach($numbers[$i]);
            }
        }

        // Set categories
        foreach ($posts as $post) {
            if ($post->id === 9) {
                DB::table ('category_post')->insert ([
                    'category_id' => 1,
                    'post_id' => 9,
                ]);
            } else {
                $numbers = range (1, $nbrCategories);
                shuffle ($numbers);
                $n = rand (1, 2);
                for ($i = 0; $i < $n; ++$i) {
                    DB::table ('category_post')->insert ([
                        'category_id' => $numbers[$i],
                        'post_id' => $post->id,
                    ]);
                }
            }
        }

        // Comments first level
        foreach (range(1, $nbrPosts) as $i) {
            factory(Comment::class)->create([
                'post_id' => $i,
                'user_id' => rand(1, $nbrUsers),
            ]);
        }

        $comment1 = factory(Comment::class)->create([
            'post_id' => 2,
            'user_id' => 3,
        ]);

        $comment2 = factory(Comment::class)->create([
            'post_id' => 4,
            'user_id' => 4,
        ]);

        $nbrComments = $nbrPosts + 2;

        // Comments second level
        $comment3 = factory(Comment::class)->create([
            'post_id' => 2,
            'user_id' => 4,
            //'parent_id' => $nbrComments - 1,
        ])->makeChildOf($comment1);

        factory(Comment::class)->create([
            'post_id' => 4,
            'user_id' => 5,
            //'parent_id' => $nbrComments,
        ])->makeChildOf($comment2);

        // Comments third level
        factory(Comment::class)->create([
            'post_id' => 2,
            'user_id' => 2,
            //'parent_id' => $nbrComments + 1,
        ])->makeChildOf($comment3);

        factory(Comment::class)->create([
            'post_id' => 2,
            'user_id' => 1,
            //'parent_id' => $nbrComments + 1,
        ])->makeChildOf($comment3);

    }
}
