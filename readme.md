## Browser Requirement for Laravel
Now you can easily Set-up your minimum Browser Requirement for your Application.

### Install
Require this package with composer using the following command
```
composer require tibian/browser-requirement
```

After updating composer, add the service provider to the providers array in config/app.php
```php
TiBian\BrowserRequirement\BrowserRequirementServiceProvider::class,
```

### Config
Publish the config file to change it as you wish.
```
php artisan vendor:publish

or

php artisan vendor:publish --provider="TiBian\BrowserRequirement\BrowserRequirementServiceProvider" --tag=config
```

### Usage
Open the config/browser.php and you are ready to start.

>Let set-up minimum Browser Requirement for OS X and Windows...
```php
Os::OSX => [
    Browser::CHROME => 25,
    Browser::FIREFOX => 25,
    Browser::OPERA => 29,
],
// Windows
Os::WINDOWS => [
    Browser::CHROME => 25,
    Browser::FIREFOX => 25,
    Browser::OPERA => 29,
    Browser::SAFARI => 8,
    Browser::IE => 9,
    Browser::EDGE => 11,
],
```

### Routes
This is a Example from the Routes you need, you are free to customize the Routes like you wish.

```php
Route::get("requirement-browser", "ErrorsController@browser")
    ->name('requirement::browser');
```

```php
Route::get("/", "PagesController@index")
    ->name('home');
```

##### Any idea for new projects, feel free to Contact me.

##### Thank you for visiting my Repository.
