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

Auth::routes();

Route::get('/','PostController@index');
Route::get('/home',['as' => 'home', 'uses' => 'PostController@index']);
//authentication
//Route::controllers([
// 'auth' => 'Auth\AuthController',
// 'password' => 'Auth\PasswordController',
//]);
// проверка залогиненного пользователя
Route::group(['middleware' => ['auth']], function()
{
 // показ новой пост формы
 Route::get('new-post','PostController@create');
 // сохранение нового поста
 Route::post('new-post','PostController@store');
 // редактирование формы поста
 Route::get('edit/{slug}','PostController@edit');
 // обновление поста
 Route::post('update','PostController@update');
 // удаление поста
 Route::get('delete/{id}','PostController@destroy');
 // вывод всех постов пользователю
 Route::get('my-all-posts','UserController@user_posts_all');
 // вывод пользовательских черновиков
 Route::get('my-drafts','UserController@user_posts_draft');
 // добавление комментариев
 Route::post('comment/add','CommentController@store');
 // удаление комментария
 Route::post('comment/delete/{id}','CommentController@distroy');
});
// пользовательские профили
Route::get('user/{id}','UserController@profile')->where('id', '[0-9]+');
// вывод списка постов
Route::get('user/{id}/posts','UserController@user_posts')->where('id', '[0-9]+');
// вывод одного поста
Route::get('/{slug}',['as' => 'post', 'uses' => 'PostController@show'])->where('slug', '[A-Za-z0-9-_]+');