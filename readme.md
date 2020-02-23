## Laravel Passport


#### Laravel V-5.8
#### Passport V-7.5.1


## Installation

```` composer require laravel/passport:7.5.1 ````

```` php artisan migrate ````

```` php artisan passport:install ````



## open config/app.php file and add service provider.

```javascript 

config/app.php
'providers' =>[
Laravel\Passport\PassportServiceProvider::class,
],

````

## Step 3: Passport Configuration  app/User.php

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

## Step 4 :config/auth.php

```javascript 


        'api' => [ 
            'driver' => 'passport', 
            'provider' => 'users', 
        ], 


````

## Step 5: Create API Route

```javascript

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');
Route::group(['middleware' => 'auth:api'], function(){
Route::post('details', 'API\UserController@details');
});

````


## Step 6: Create the Controller

```javascript 

<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;
class UserController extends Controller 
{
public $successStatus = 200;
/** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function login(){ 
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            return response()->json(['success' => $success], $this-> successStatus); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }
/** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'email' => 'required|email', 
            'password' => 'required', 
            'c_password' => 'required|same:password', 
        ]);
if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
$input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        $user = User::create($input); 
        $success['token'] =  $user->createToken('MyApp')-> accessToken; 
        $success['name'] =  $user->name;
return response()->json(['success'=>$success], $this-> successStatus); 
    }
/** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function details() 
    { 
        $user = Auth::user(); 
        return response()->json(['success' => $user], $this-> successStatus); 
    } 
}


````

