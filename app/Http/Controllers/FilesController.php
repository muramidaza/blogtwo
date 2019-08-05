<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Files;
use Redirect;
use App\Http\Controllers\Controller;

class FilesController extends Controller
{
    //
	
	public function index()
	{

		$files = Files::orderBy('created_at','desc')->paginate(20);
		$title = 'Файлы на сервере';
		return view('files.list')->withFiles($files)->withTitle($title);
	}
	
	public function load(Request $request)
	{
		if($request->user()->can_post())
		{
			return view('files.savefiles');
		}		
		else 
		{
			return redirect('/')->withErrors('У вас нет достаточных прав');
		}
	}
	
	public function save(Request $request)
	{
		foreach ($request->file() as $file) {
                foreach ($file as $f) {
					$fullname = time().'_'.$f->getClientOriginalName();
                    $f->move('others', $fullname);
					
					$files = new Files();
					$files->type = 'others';
					$files->fullname = $fullname;
					$files->save();
                }
            }
		
		$message = 'Файлы успешно сохранены';
		
		return redirect('files/list')->withMessage($message);
	}	
	
	
}
