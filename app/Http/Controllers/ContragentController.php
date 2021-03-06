<?php

namespace App\Http\Controllers;

use App\Posts;
use App\Contragent;
use App\User;
use Redirect;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContragentFormRequest;
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
		return view('contragent.contragents')->withContragents($contragents)->withTitle($title);
	}

	public function create(Request $request)
	{
		// если пользователь может публиковать автор или администратор
		if($request->user()->can_post())
		{
			return view('contragent.createcontragent');
		}		
		else 
		{
			return redirect('/')->withErrors('У вас нет достаточных прав');
		}
	}

	public function store(ContragentFormRequest $request)
	{
		$contragent = new Contragent();
		$contragent->name = $request->get('name');
		$contragent->numberdogovor = $request->get('numberdogovor');
		$contragent->address = $request->get('address');
		$contragent->contactface1 = $request->get('contactface1');
		$contragent->contact1 = $request->get('contact1');
		$contragent->contactface2 = $request->get('contactface2');
		$contragent->contact2 = $request->get('contact2');
		
		$message = 'Контрагент успешно создан';
		
		$contragent->save();
		
		return redirect('contragent/edit/'.$contragent->id)->withMessage($message);
	}
	
	public function edit(Request $request, $id)
	{
		$contragent = Contragent::where('id', $id)->first();
		if($request->user()->can_post())
			return view('contragent.editcontragent')->with('contragent', $contragent);
		return redirect('/')->withErrors('у вас нет достаточных прав');
	}
	
	public function update(ContragentFormRequest $request)
	{
		$contragent_id = $request->input('contragent_id');
		$contragent = Contragent::find($contragent_id);
		if($request->user()->can_post())
		{
			$contragent->name = $request->get('name');
			$contragent->numberdogovor = $request->get('numberdogovor');
			$contragent->address = $request->get('address');
			$contragent->contactface1 = $request->get('contactface1');
			$contragent->contact1 = $request->get('contact1');
			$contragent->contactface2 = $request->get('contactface2');
			$contragent->contact2 = $request->get('contact2');			
			
			$message = 'Контрагент успешно изменен';
			
			$contragent->save();
			
			return redirect('contragent.contragents')->withMessage($message);
		}
		else
		{
			return redirect('/')->withErrors('у вас нет достаточных прав');
		}
	}
	
	public function destroy(Request $request, $id)
	{
		//
		$contragent = Contragent::find($id);
		if($request->user()->can_post())
		{
			$contragent->delete();
			$data['message'] = 'Контрагент успешно удалён';
		}
		else 
		{
			$data['errors'] = 'У вас нет достаточных прав';
		}
		
		$message = 'Контрагент успешно удален';
		
		return redirect('contragent.contragents')->withMessage($message);
	}

	public function show($id)
	{
		$contragent = Contragent::where('id',$id)->first();

		//$comments = $post->comments;
		return view('contragent.showcontragent')->withContragent($contragent);
	}		
}
