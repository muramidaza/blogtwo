@extends('app')
@section('title')
{{$title}}
@endsection
@section('content')

<div class="">
	@foreach( $files as $file )
	<div class="list-group">
		<div class="list-group-item">
			<h3><a href="{{ url('/files/show/'.$file->id) }}">{{ $file->fullname }}</a>
				
				@if(Auth::user()->is_admin())
					<button class="btn btn-danger" style="float: right"><a href="{{ url('files/delete/'.$file->id.'?_token='.csrf_token())}}">Удалить</a></button>
				@endif
			</h3>
		</div>
		<div class="list-group-item">
			<p>Папка {{ $file->type }}</p>
			<article>
				<img src="{{ asset($file->type.'/'.$file->fullname) }}" style="width: 100px; height: 100px; border: 4px double gray">	
			</article>
		</div>
	</div>
	@endforeach
	
	<button class="btn" style="float: right"><a href="{{ url('files/load')}}">Загрузить еще файлы</a></button>
	{!! $files->render() !!}
</div>

@endsection

