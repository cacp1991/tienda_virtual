<?php

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use Illuminate\Routing\Controllers\Middleware;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CarritoComprasController;



// Route::get('/test', function () {
//     Role::create(['name' => 'admin']);
// });

Route::get('/test', function () {
    $users = User::get();
    foreach ($users as $user) {
        if ($user->number_id == 1144045278) $user->assignRole('admin');
        else  $user->assignRole('user');
    }
});


//en esta ruta situamos el home

Route::get('/', function () {
    return view('principal.index');
});


Auth::routes();


// users//

Route::group(

    // 'prefix' => 'users',
    [
        'prefix' => 'Users', 'middleware' => ['auth','role:admin|user'],
        'controller' => UserController::class
    ],
    function () {
        Route::get('/', 'showAllUsers')->name('users');
        Route::get('/getUsers', 'getAllRoles');
        Route::get('/getUser/{user}', 'getUser');
        Route::get('/GetAllRoles', 'getAllRoles');
        Route::get('/GetAllUsersDataTable', 'getAllUsersForDataTable');
        // Route::post('/CreateUser', 'createUser')->name('CrudUsers.index.create-post');// blade
        Route::post('/SaveUser', 'saveUser'); //vue
        Route::put('/UpdateUser/{user}', 'updateUser')->name('CrudUsers.index.create-put');
        Route::delete('/deleteUser/{user}', 'deleteUser');
    }
);

// products//
Route::group(['prefix' => 'Products', 'middleware' => ['auth', 'role:admin|user'], 'controller' => ProductController::class], function () {
    Route::get('/', 'showAllProducts')->name('products');
    Route::get('/GetProduct/{product}', 'getProduct'); //traemos un producto

    Route::get('/getProducts', 'getAllProducts');  // trae la data
    Route::get('/GetAllProductsDataTable', 'getAllProductsForDataTable');
    Route::post('/SaveProduct', 'saveProduct');
    Route::post('/UpdateProduct/{product}', 'updateProduct');
    Route::delete('/DeleteProduct/{product}', 'deleteProduct');

});

//
Route::group(['prefix' => 'ProductsView', 'middleware' => ['auth', 'role:admin|user'], 'controller' => ProductController::class], function () {
    Route::get('/', 'homeView')->name('productsview.index');
    Route::get('/GetAProduct/{product}', 'getAProduct')->name('productsview.index');
});

//categories

Route::group(['prefix' => 'Categories','controller' => CategoryController::class],
function () {
    Route::get('/GetCategoryElectric/{product}', 'getCategoryElectric'); //listar detalle por producto de categoria
    Route::get('/GetCategoriesWithProducts', 'getCategoriesWithProducts'); //listamos el index de las categorias
    Route::get('/', 'showAllCategories')->name('categories'); // enrutamos en blade  linea 75 y 76 para obtener gategorias
    Route::get('/GetAllCategories', 'getAllCategories');
    Route::get('/GetAllCategoriesDataTable', 'getAllCategoriesForDataTable'); //datatables
    Route::get('/Category/{category}', 'getCategory');
    Route::get('/GetCategory/{category}', 'getAllCategory');
    Route::get('/GetCategoryProduct/{product}', 'getCategoryProduct');

}
);

Route::group(['prefix' => 'Categories', 'middleware' => ['auth', 'role:admin'], 'controller' => CategoryController::class],
function () {

    // Route::get('/GetCategoriesWithProducts', 'getCategoriesWithProducts')->name('categoriaUno.index'); //listamos el index de las categorias
        Route::post('/CreateCategory', 'createCategory');
        Route::post('/SaveCategory', 'saveCategory');
        Route::post('/UpdateCategory/{category}', 'updateCategory');
        Route::delete('/DeleteCategory/{category}', 'deleteCategory');
    }
);


//carro de compras
Route::group(['prefix' => 'Kart', 'middleware' => ['auth'],'controller' => KartController::class], function () {
    Route::get('/', 'mostrarCarrito')->name('kart');
});

//carro de compras2
Route::group(['prefix' => 'CarritoCompras','controller' => CarritoComprasController::class], function () {
    Route::get('/', 'MostrarCarrito')->name('carritocompras');
});

Route::group(['controller' => RegisterController::class], function () {
	Route::get('register', 'showRegistrationForm')->name('register');
	Route::post('register', 'register');
});

// Route::get('/', [CartController::class, 'shop'])->name('shop');


