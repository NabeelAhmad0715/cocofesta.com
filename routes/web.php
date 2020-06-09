<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group.
|
*/





// Backend

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', function () {
        return redirect(route("admin.login"));
    });
    Route::get('login', 'AdminAuth\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'AdminAuth\LoginController@login')->name('admin.login');
    Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset')->name('admin.password.update');
    Route::get('password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('logout', 'AdminAuth\LoginController@logout')->name('admin.logout');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    Route::get('/', 'Admin\PageController@index')->name('admin.pages.home');
    // Categories
    Route::resource('/categories', 'Admin\CategoriesController');
    Route::get('/category/image-delete/{id}', 'Admin\CategoriesController@delete')->name('category.delete');

    // Image Utility
    Route::get('/image-gallery/selected', 'Admin\ImagesController@selectedImage')->name('image-gallery.selected');
    Route::get('/image-gallery/image/deselect', 'Admin\ImagesController@deselectImage')->name('image-gallery.deselect');
    Route::get('/pagination/fetch-data', 'Admin\ImagesController@fetchData')->name('pagination.fetch-data');
    Route::post('/upload-image', 'Admin\ImagesController@upload')->name('images.upload');
    Route::post('/delete-image', 'Admin\ImagesController@delete')->name('images.delete');

    // Types
    Route::resource('types', 'Admin\TypesController');
    Route::get('posts/create/{slug}', 'Admin\PostsController@create')->name('posts.create');
    Route::get('posts/{slug}', 'Admin\PostsController@index')->name('posts.index');
    Route::post('posts/{slug}', 'Admin\PostsController@store')->name('posts.store');
    Route::get('posts/{slug}/{id}/edit', 'Admin\PostsController@edit')->name('posts.edit');
    Route::put('posts/{slug}/{id}', 'Admin\PostsController@update')->name('posts.update');
    Route::delete('posts/{slug}/{id}', 'Admin\PostsController@destroy')->name('posts.destroy');
    Route::get('/set-stock-status/{id}/{in_stock}', 'Admin\PageController@setStockStatus')->name('admin.set-stock-status');

    Route::get('view/tags', 'Admin\PageController@tags')->name('posts.tags');
    Route::get('/types/image-delete/{id}/{postId}/{image}', 'Admin\PostsController@delete')->name('type.delete');

    // Contact Inquiries
    Route::get('/general-settings/create', "Admin\GeneralSettingController@create")->name("general-settings.create");
    Route::post('/general-settings', "Admin\GeneralSettingController@store")->name("general-settings.store");
    Route::get('/general-settings/edit', "Admin\GeneralSettingController@edit")->name("general-settings.edit");
    Route::put('/general-settings', "Admin\GeneralSettingController@update")->name("general-settings.update");
    Route::resource('contact-enquiries', 'Admin\ContactEnquiryController');

    Route::get('/change-password', 'AdminAuth\ChangePasswordController@changePassword')->name('admin.change-password.edit');
    Route::put('/change-password', 'AdminAuth\ChangePasswordController@updatePassword')->name('admin.change-password.update');
});

Auth::routes();

// Route::group(['middleware' => 'auth:user'], function () {
//     Route::get('/home', 'Frontend\PageController@dashboard')->name('home');
// });

Route::get('/', 'Frontend\PageController@index')->name('pages.home');
Route::get('/about', 'Frontend\PageController@about')->name('pages.about');
Route::get('/contact-us', 'Frontend\PageController@contactUs')->name('pages.contact-us');
Route::post('/contact-enquiry', 'Frontend\PageController@contactEnquiry')->name('pages.contact-enquiry');

Route::get('/cart', 'Frontend\PageController@viewCart')->name('pages.cart')->middleware('auth');
Route::get('count/post/cart', 'Frontend\CartController@count')->name('cart.count');

Route::get('create/post/cart', 'Frontend\CartController@create')->name('cart.create');
Route::get('remove/post/cart', 'Frontend\CartController@remove')->name('cart.remove');
Route::get('cart/change/quantity', 'Frontend\CartController@quantity')->name('cart.quantity');

Route::get('/checkout', 'Frontend\PageController@checkout')->name('pages.checkout');
Route::post('/place-order', 'Frontend\OrderController@order')->name('generate.order');
Route::get('/thankyou', 'Frontend\PageController@thankyou')->name('pages.thankyou');

Route::get('/whishlist', 'Frontend\WhishlistController@index')->name('pages.whishlist')->middleware('auth');
Route::get('count/post/whishlist', 'Frontend\WhishlistController@count')->name('whishlist.count');

Route::get('create/post/whishlist', 'Frontend\WhishlistController@create')->name('whishlist.create');
Route::get('remove/post/whishlist', 'Frontend\WhishlistController@remove')->name('whishlist.remove');

Route::get('products/{slug}', 'Frontend\PageController@product')->name('pages.products');
Route::get('/products/{category}/{slug}', 'Frontend\PageController@productPost')->name('pages.product-post');
Route::get('products-search/{slug}', 'Frontend\PageController@search')->name('pages.search');

Route::get('/create-symlink', function () {
    $projectFolder = base_path() . '/../';
    // The file that you want to create a symlink of
    $source = $projectFolder . "/3jcRCPACuQtF5aKa/storage/app/public";
    // The path where you want to create the symlink of the above
    $destination = $projectFolder . "/storage";

    if (file_exists($destination)) {
        if (is_link($destination)) {
            return "<h1>Symlink already exists</h1>";
        }
    } else {
        symlink($source, $destination);
        return "<h1>Symlink created successfully</h1>";
    }
});

Route::get('/remove-symlink', function () {
    $projectFolder = base_path() . '/../';
    $destination = $projectFolder . "/storage";
    if (file_exists($destination)) {
        if (is_link($destination)) {
            unlink($destination);
            return "<h1>Removed symlink</h1>";
        }
    } else {
        return "<h1>Symlink does not exist</h1>";
    }
});
