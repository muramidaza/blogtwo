@extends('app')
@section('title')
	@if($contragent)
		{{ $contragent->name }}
		@if(Auth::user()->is_admin())
			<button class="btn" style="float: right"><a href="{{ url('contragent/edit/'.$contragent->id)}}">Редактировать пост</a></button>
		@endif
	@else
		Страница не существует
	@endif
@endsection

@section('content')

@if($contragent)
	<div>
		{!! $contragent->numberdogovor !!}
	</div>		

	
@else
404 ошибка
@endif
@endsection