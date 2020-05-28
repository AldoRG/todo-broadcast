# To-Do broadcast

## About To-Do broadcast app
To-Do broadcast is a web application using [Laravel](https://laravel.com), [VueJS](https://vuejs.org) and [Pest](https://pestphp.com/) to make an example how you can create a realtime application using [Pusher](https://pusher.com) and [Laravel Echo](https://laravel.com/docs/7.x/broadcasting#installing-laravel-echo). 

## Screenshots
![Image of To-Do App](https://aldorg.com/todoapp.png)

## Installation
```
composer install
php artisan key:generate
php artisan migrate
```

## Testing
Unit test is using [Pest](https://pestphp.com/). Pest is a Testing Framework with a focus on simplicity. It was carefully crafted to bring the joy of testing to PHP.  
Run tests with:
```
./vendor/bin/pest
```
![Image of To-Do Unit Test](https://aldorg.com/todounit.png)

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
