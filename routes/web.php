<?php


$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->group(
    ['middleware' => 'jwt.auth'], 
    function() use ($router) {
        $router->get('users', function() {
            $users = \App\User::all();
            return response()->json($users);
        });
    }
);


$router->group(
    ['prefix' => 'api/v1'], 
    function() use ($router) {
        
        $router->get('/categories', ['uses' => 'CategoryController@index']);
        $router->post('/categories', ['uses' => 'CategoryController@create']);
        $router->put('/categories/{id}', ['uses' => 'CategoryController@update']);
        $router->delete('/categories/{id}', ['uses' => 'CategoryController@destroy']);
    }
);




$router->post(
    'auth/login', 
    [
       'uses' => 'AuthController@authenticate'
    ]
);
