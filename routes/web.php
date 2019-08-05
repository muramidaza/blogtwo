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
	
	Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
	Route::post('login', 'Auth\LoginController@login');
	Route::post('logout', 'Auth\LoginController@logout')->name('logout');
	// Registration Routes...
	Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
	Route::post('register', 'Auth\RegisterController@register');
	// Password Reset Routes...
	Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
	Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
	Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
	Route::post('password/reset', 'Auth\ResetPasswordController@reset');
	//Auth::routes();
	Route::get('/','PostController@index');
	Route::get('/home','PostController@index');
	//Route::get('/home',['as' => 'home', 'uses' => 'PostController@index']);
	
	//authentication
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

		Route::group(['prefix' => 'contragent'], function () {
			Route::get('/list', 'ContragentController@index');
			Route::get('/new', 'ContragentController@create');
			Route::post('/new', 'ContragentController@store');
			Route::get('/edit/{id}', 'ContragentController@edit');
			Route::post('/update', 'ContragentController@update');
			Route::get('/delete/{id}', 'ContragentController@destroy');
			Route::get('/show/{id}', 'ContragentController@show');	
		});
		
		Route::group(['prefix' => 'equipment'], function () {
			Route::get('/list', 'EquipmentController@index');
			Route::get('/new', 'EquipmentController@create');
			Route::post('/new', 'EquipmentController@store');
			Route::get('/edit/{id}', 'EquipmentController@edit');
			Route::post('/update', 'EquipmentController@update');
			Route::get('/delete/{id}', 'EquipmentController@destroy');
			Route::get('/show/{id}', 'EquipmentController@show');	
		});
		
		Route::group(['prefix' => 'files'], function () {
			Route::get('/list', 'FilesController@index');
			Route::get('/load', 'FilesController@load');
			Route::post('/save', 'FilesController@save');
			Route::get('/delete/{id}', 'FilesController@destroy');
			Route::get('/show/{id}', 'FilesController@show');	
		});		
	});
		
	Route::group(['middleware' => ['isadmin']], function()
	{
		Route::get('adminka', function () {
			return 'Admin';
		});
	});

	Route::get('clear', function() {
		Artisan::call('cache:clear');
		Artisan::call('config:cache');
		Artisan::call('view:clear');
		Artisan::call('route:clear');
		//Artisan::call('backup:clear');
		return "Кэш очищен.";
	});

	// пользовательские профили
	Route::get('user/{id}','UserController@profile')->where('id', '[0-9]+');
	// вывод списка постов
	Route::get('user/{id}/posts','UserController@user_posts')->where('id', '[0-9]+');

/* 	Route::get('storage/{folder}/{filename}', function ($folder, $filename)
	{
		//$path = Storage::get(base_path().'\\storage\\'.$folder.'\\'.$filename);
		$path = Storage::get('C:/OpenServer/domains/blogtwo/storage/others/1565022021_IMG_2149.JPG');
		

		$file = File::get($path);
		$type = File::mimeType($path);

		$response = Response::make($file, 200);
		$response->header("Content-Type", $type);

		return $folder.'/'.$filename;
	}); */	