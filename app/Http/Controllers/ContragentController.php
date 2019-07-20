<?php

namespace App\Http\Controllers;

use App\Posts;
use App\Contragent;
use App\User;
use Redirect;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostFormRequest;
use Illuminate\Http\Request;

class ContragentController extends Controller
{
	public function index()
	{
		// сделать выборку 5 постов из базы данных, активных и последних
		$contragents = Contragent::orderBy('created_at','desc')->paginate(5);
		// заголовок страницы
		$title = 'Контрагенты';
		// вывод шаблона home.blade.php из папки resources/views
		return view('admin.contragents')->withContragents($contragents)->withTitle($title);
	}

	
}
