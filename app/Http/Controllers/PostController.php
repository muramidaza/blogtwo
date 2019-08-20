<?php namespace App\Http\Controllers;
use App\Posts;
use App\User;
use App\Files;
use Redirect;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostFormRequest;
use Illuminate\Http\Request;
use App\Contragent;

class PostController extends Controller
{
	public function index()
	{
		// сделать выборку 5 постов из базы данных, активных и последних
		$posts = Posts::where('active',1)->orderBy('created_at','desc')->paginate(5);
		// заголовок страницы
		$title = 'Последние посты';
		// вывод шаблона home.blade.php из папки resources/views
		return view('home')->withPosts($posts)->withTitle($title);
	}
	
	public function create(Request $request)
	{
		// если пользователь может публиковать автор или администратор
		if($request->user()->can_post())
		{
			$contragents = Contragent::all();
			$files = Files::all();
			
			return view('create')->withContragents($contragents)->withFiles($files);
		}		
		else 
		{
			return redirect('/')->withErrors('У вас нет достаточных прав для написания поста');
		}
	}
	
	public function store(PostFormRequest $request)
	{
		//dd($request->get('files'));
		
		$post = new Posts();
		$post->title = $request->get('title');
		$post->contragent = $request->get('contragent');
		
		
		
		$post->body = $request->get('body');
		$post->slug = str_slug($post->title);
		$post->author_id = $request->user()->id;
		if($request->has('save'))
		{
			$post->active = 0;
			$message = 'Пост успешно сохранён';						
		}						
		else 
		{
			$post->active = 1;
			$message = 'Пост опубликован успешно';
		}
		$post->save();
		
		$post->files()->attach($request->get('files'));
		
		return redirect('edit/'.$post->slug)->withMessage($message);
	}
	
	public function show($slug)
	{
		$post = Posts::where('slug', $slug)->first();
		if(!$post)
		{
			 return redirect('/')->withErrors('запрошенная страница не найдена');
		}
		$comments = $post->comments;
		return view('show')->withPost($post)->withComments($comments);
	}
	
	public function edit(Request $request, $slug)
	{
		$contragents = Contragent::all();
		$files = Files::all();
		
		$post = Posts::where('slug',$slug)->first();
		
		if($post && ($request->user()->id == $post->author_id || $request->user()->is_admin()))
			return view('edit')->with('post', $post)->with('contragents', $contragents)->with('files', $files);
		
		return redirect('/')->withErrors('у вас нет достаточных прав');
	}
	
	public function update(Request $request)
	{
		//
		$post_id = $request->input('post_id');
		$post = Posts::find($post_id);
		
		$arrfiles = [];
		
		foreach($post->files->toArray() as $elem) {
			$arrfiles[] = $elem['id'];
		}
		
		if($post && ($post->author_id == $request->user()->id || $request->user()->is_admin()))
		{
			$title = $request->input('title');
			$slug = str_slug($title);
			$duplicate = Posts::where('slug',$slug)->first();
			if($duplicate)
			{
				if($duplicate->id != $post_id)
				{
					return redirect('edit/'.$post->slug)->withErrors('Title already exists.')->withInput();
				}
				else 
				{
					$post->slug = $slug;
				}
			}
			$post->title = $title;
			$post->body = $request->input('body');
			$post->contragent = $request->get('contragent');
			if($request->has('save'))
			{
				$post->active = 0;
				$message = 'Post saved successfully';
				$landing = 'edit/'.$post->slug;
			}						
			else {
				$post->active = 1;
				$message = 'Post updated successfully';
				$landing = $post->slug;
			}
			$post->save();
			
			$post->files()->detach($arrfiles);
			$post->files()->attach($request->get('files'));
			
			return redirect($landing)->withMessage($message);
		}
		else
		{
			return redirect('/')->withErrors('у вас нет достаточных прав');
		}
	}
	
	public function destroy(Request $request, $id)
	{
		//
		$post = Posts::find($id);
		if($post && ($post->author_id == $request->user()->id || $request->user()->is_admin()))
		{
			$post->delete();
			$data['message'] = 'Пост успешно удалён';
		}
		else 
		{
			$data['errors'] = 'Неправильная операция. У вас нет достаточных прав';
		}
		return redirect('/')->with($data);
	}
	
}
