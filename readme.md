## Laravel Passport


#### Laravel V-5.8
#### Passport V-7.5.1


## Installation

```` composer require laravel/passport:7.5.1 ````

```` php artisan migrate ````

```` php artisan passport:install ````



## Config/app.php.

```javascript 

config/app.php
'providers' =>[
Laravel\Passport\PassportServiceProvider::class,
],

````

## app/User.php

```javascript 

use Laravel\Passport\HasApiTokens;


````


## app/Providers/AuthServiceProvider.php


```javascript 

use Laravel\Passport\Passport; 

    protected $policies = [ 
        'App\Model' => 'App\Policies\ModelPolicy', 
    ];

    public function boot() 
    { 
        $this->registerPolicies(); 
        Passport::routes(); 
    } 

````

## Config/auth.php

```javascript 


        'api' => [ 
            'driver' => 'passport', 
            'provider' => 'users', 
        ], 


````