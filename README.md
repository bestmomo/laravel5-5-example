## Laravel 5-5 example ##

**Laravel 5-5 example** is a tutorial application.

### Installation ###

* type `git clone https://github.com/bestmomo/laravel5-5-example.git projectname` to clone the repository 
* type `cd projectname`
* type `composer install`
* type `composer update`
* type `php artisan key:generate`to regenerate secure key
* if you use MySQL in *.env* file :
   * set DB_CONNECTION
   * set DB_DATABASE
   * set DB_USERNAME
   * set DB_PASSWORD
* if you use sqlite :
   * type `touch database/database.sqlite` to create the file
* type `php artisan migrate --seed` to create and populate tables
* edit *.env* for emails configuration

### Include ###

* [Styleshout](https://www.styleshout.com/) for front template
* [CKEditor](http://ckeditor.com) the great editor
* [Elfinder](https://github.com/Studio-42/elFinder) the nice file manager
* [Sweat Alert](http://t4t5.github.io/sweetalert/) for the cool alerts
* [AdminLTE](https://adminlte.io/themes/AdminLTE/index2.html) the great admin template
* [Gravatar](https://github.com/creativeorange/gravatar) the Gravatar package
* [Intervention Image](http://image.intervention.io/) for image manipulation
* [Email confirmation](https://github.com/bestmomo/laravel-email-confirmation) the package for email confirmation
* [Artisan language](https://github.com/bestmomo/laravel-artisan-language) the package for language strings management

### Features ###

* Home page
* Custom error pages 403, 404 and 503
* Authentication (registration, login, logout, password reset, mail confirmation, throttle)
* Users roles : administrator (all access), redactor (create and edit post, upload and use medias in personnal directory), and user (create comment in blog)
* Blog with comments
* Search in posts
* Tags on posts
* Contact us page
* Admin dashboard with messages, users, posts, roles and comments
* Users admin (roles filter, show, edit, delete, create, blog report)
* Posts admin (list with dynamic order, show, edit, delete, create)
* Multi users medias gestion
* Localization
* Application tests
* Use of new notifications to send emails and notify redactors for new comments

### Assets ###

CSS is compiled with Elixir, look at **gulpfile.js** for details.

### Tricks ###

To use application the database is seeding with users :

* Administrator : email = admin@la.fr, password = admin
* Redactor : email = redac@la.fr, password = redac
* User : email = walker@la.fr, password = walker
* User : email = slacker@la.fr, password = slacker

### Tests ###

When you want to launch the tests first rollback the database :

`php artisan migrate:rollback`

Then migrate and seed :

`php artisan migrate --seed`

You can then use PHPUnit
