<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// front pages
Route::get('', 'FrontPagesController@index')->name('front.index');
Route::get('offers', 'FrontPagesController@houses')->middleware('remove.token')->name('front.houses');
Route::get('offers/{offer}', 'FrontPagesController@house')->name('front.house');
Route::get('additional-offers', 'FrontPagesController@getPage')->name('front.page');
Route::get('contacts', 'FrontPagesController@getContactPage')->name('front.contact.get');
Route::post('contacts', 'FrontPagesController@sendContactMessage')->name('front.contact.send');


// admin login
Route::get('login', [
    'as' => 'login',
    'uses' => 'Auth\LoginController@showLoginForm'
]);
Route::post('login', [
    'as' => '',
    'uses' => 'Auth\LoginController@login'
]);
Route::post('logout', [
    'as' => 'logout',
    'uses' => 'Auth\LoginController@logout'
]);


// admin
Route::group(['prefix' => 'home', 'middleware' => 'auth'], function(){
    Route::get('', 'Admin\HomeController@index')->name('home');

    Route::resource('houses', 'Admin\HouseController');

    Route::resource('sliders', 'Admin\SliderController');

    Route::get('pages', 'Admin\PageController@index')->name('pages.index');
    Route::get('pages/{page}', 'Admin\PageController@edit')->name('pages.edit');
    Route::match(['put', 'patch'],'pages/{page}', 'Admin\PageController@update')->name('pages.update');

    Route::get('uploads', 'Admin\UploadController@index')->name('uploads.index');
    Route::post('uploads', 'Admin\UploadController@store')->name('uploads.store');
    Route::delete('uploads/{upload}', 'Admin\UploadController@destroy')->name('uploads.destroy');

    Route::get('footer', 'Admin\HomeController@getFooter')->name('footer.index');
    Route::match(['put', 'patch'],'footer', 'Admin\HomeController@updateFooter')->name('footer.update');

    Route::get('contacts', 'Admin\HomeController@getContacts')->name('contacts.index');
});

