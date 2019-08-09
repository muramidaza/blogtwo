<?php

namespace App\Http\Controllers;

use App\Posts;
use App\Contragent;
use App\Equipment;
use App\User;
use Redirect;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContragentFormRequest;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
	public function index()
	{
		// сделать выборку 5 постов из базы данных, активных и последних
		$equipments = Equipment::orderBy('created_at','desc')->paginate(5);
		// заголовок страницы
		$title = 'Оборудование';
		// вывод шаблона home.blade.php из папки resources/views
		return view('equipment.equipments')->withEquipments($equipments)->withTitle($title);
	}

	public function create(Request $request)
	{
		// если пользователь может публиковать автор или администратор
		if($request->user()->can_post())
		{
			return view('equipment.createequipment');
		}		
		else 
		{
			return redirect('/')->withErrors('У вас нет достаточных прав');
		}
	}

	public function store(EquipmentFormRequest $request)
	{
		$equipment = new Equipment();
		$equipment->type = $request->get('type');
		$equipment->model = $request->get('model');
		$equipment->serialnumber = $request->get('serialnumber');
		$equipment->invnumber = $request->get('invnumber');
		
		foreach ($request->file() as $file) {
                foreach ($file as $f) {
                    $f->move(storage_path('images'), time().'_'.$f->getClientOriginalName());
                }
            }
		
		$message = 'Контрагент успешно создан';
		
		$equipment->save();
		
		return redirect('edit-equipment/'.$equipment->id)->withMessage($message);
	}
	
	public function edit(Request $request, $id)
	{
		$equipment = Equipment::where('id', $id)->first();
		if($request->user()->can_post())
			return view('equipment.editequipment')->with('equipment', $equipment);
		return redirect('/')->withErrors('у вас нет достаточных прав');
	}
	
	public function update(EquipmentFormRequest $request)
	{
		$equipment_id = $request->input('equipment_id');
		$equipment = Equipment::find($equipment_id);
		if($request->user()->can_post())
		{
			$equipment->name = $request->get('name');
			$equipment->numberdogovor = $request->get('numberdogovor');
			$equipment->address = $request->get('address');
			$equipment->contactface1 = $request->get('contactface1');
			$equipment->contact1 = $request->get('contact1');
			$equipment->contactface2 = $request->get('contactface2');
			$equipment->contact2 = $request->get('contact2');			
			
			$message = 'Контрагент успешно изменен';
			
			$equipment->save();
			
			return redirect('equipment.equipments')->withMessage($message);
		}
		else
		{
			return redirect('/')->withErrors('у вас нет достаточных прав');
		}
	}
	
	public function destroy(Request $request, $id)
	{
		//
		$equipment = Equipment::find($id);
		if($request->user()->can_post())
		{
			$equipment->delete();
			$data['message'] = 'Контрагент успешно удалён';
		}
		else 
		{
			$data['errors'] = 'У вас нет достаточных прав';
		}
		
		$message = 'Запись успешно удалена';
		
		return redirect('equipment.equipments')->withMessage($message);
	}	
}
