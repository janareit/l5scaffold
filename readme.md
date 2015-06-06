# Laravel 5 Scaffold Generator

This is a scaffold generator for Laravel 5.0.x.

This generator has less advanced features than my other forked generators set at https://github.com/janareit/laravel5generators. Check out both of them to see whic one better suits your project needs.


## Usage

### Step 1: Install Through Composer

```
composer require 'janareit/l5scaffold' --dev
```

### Step 2: Add the Service Provider

This package scaffolds views using `laracasts/flash` package, so you need add also this to providers.

Open `config/app.php` and, to your **providers** array at the bottom, add:

```
'janareit\L5scaffold\GeneratorsServiceProvider',
'Laracasts\Flash\FlashServiceProvider'
```

Add a facade alias to the same file at the bottom:

```
'Flash' => 'Laracasts\Flash\Flash'
```

### Step 3: Run Artisan Command

```
php artisan vendor:publish
```

### Step 4: Edit scaffolding config

Open `config/scaffold.php` and edit it according to your needs and wishes


### Step 5: Run Artisan!

You're all set. Run `php artisan` from the console, and you'll see the new commands `make:scaffold`.

## Command example

(--prefix option is OPTIONAL. Running command without it will simply skip prefix in folders)

```
php artisan make:scaffold Post --schema="title:string:default('Main title'), body:text" --prefix=Blog
```
This command will generate:

```
app/Repositories/Blog/Post.php
app/Http/Controllers/Blog/PostController.php
database/migrations/2015_06_03_234422_create_posts_table.php
database/seeds/Blog/PostTableSeeder.php
resources/views/blog/posts/index.blade.php
resources/views/blog/posts/show.blade.php
resources/views/blog/posts/edit.blade.php
resources/views/blog/posts/create.blade.php
```

And don't forget to run:

```
php artisan migrate
```

### Step 6: Add route

Open `routes.php` and add route that you generated.

For example:
```
Route::resource('blog/posts', 'Blog\PostController');
```

### Step 7: Add Route-Model binding

Add Route-Model binding and "use" clause to `RouteServiceProvider.php`

For example:
```
use App\Repositories\Blog\Post;

public function boot(Router $router)
	{
		parent::boot($router);

        $router->bind('posts', function($id) {
            return Post::findOrFail($id);
        });

	}
```


## Scaffold
![image](http://i62.tinypic.com/2nhm5xu.png)
![image](http://i57.tinypic.com/k506mv.png)
![image](http://i62.tinypic.com/2ivi58j.png)


Thanks for all previous contributors but since fixing bugs and adding features
according to my own need was very slow I forked this repo.
Mainly for my own project needs:)

Love and greetings to all Laravel 5 fellows ot there:)
