<?php

/**
+----------------------------------------------------------------+
|\ Creating Routes                                              /|
+----------------------------------------------------------------+
|
| There are two ways to create route, there is the facade 'Route'
| or the function route()
|
*/
Route::addGet(
    '/users',
    [
        'controller' => 'Users',
        'action' => 'get',
    ]
);
Route::addGet(
    '/users/{user}/profile/{profile}',
    [
        'controller' => 'Users',
        'action' => 'getById',
    ]
);
Route::addPost(
    '/users',
    [
        'controller' => 'Users',
        'action' => 'Store',
    ]
);
Route::addGet('/posts', [
    'controller' => 'Posts',
    'action' => 'get'
]);
Route::addGet('/posts/{id}', [
    'controller' => 'Posts',
    'action' => 'getById'
]);
//Route::addGet(
//    '/try-sample-forms',
//    [
//    'controller' => 'Welcome',
//    'action' => 'trySampleForms',
//    ]
//)->setName('trySampleForms');

/*
+----------------------------------------------------------------+
|\ Organized Routes using RouteGroup                            /|
+----------------------------------------------------------------+
|
| You can group your routes by using route classes,
| mounting them to organize your routes
|
*/

//Route::mount(new App\Main\Routes\AuthRoutes);
//Route::mount(new App\Main\Routes\NewsfeedRoutes);
