<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

//Definir el parametro de una ruta es con {nombre de la variable}, al pasarlo al controlador tiene que tener el mismo nombre

// Route::group(
//     ['prefix' => 'Users', 'controller' => UserController::class],
//     function () {
        // Route::get('/getAllUsers', 'showUsers')->name('users'); 
        // Route::get('/getUser', 'getAllUsers');  // trae la data  
        // Route::post('/SaveUser', 'saveUser');
        // Route::put('/UpdateUser/{user}', 'updateUser');


        // Route::get('/user/{user}', 'getUser');
        // Route::get('/lendsByUser/{user}', 'getAllLendsByUser');
        // Route::delete('/deleteUser/{user}', 'deleteUser');
//     }
// );

// Route::group(
//     ['prefix' => 'Products', 'controller' => ProductController::class],
//     function () {       
//         Route::get('/getProducts', 'getAllProducts');  // trae la data  
//         Route::post('/SaveProduct', 'saveProduct');
//         Route::put('/UpdateProduct/{product}', 'updateProduct');


//     }
// );


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
