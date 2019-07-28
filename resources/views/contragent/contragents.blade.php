@extends('app')
@section('title')
{{$title}}
@endsection
@section('content')

<div class="">
	@foreach( $contragents as $contragent )
	<div class="list-group">
		<div class="list-group-item">
			<h3><a href="{{ url('/contragent/show/'.$contragent->id) }}">{{ $contragent->name }}</a>
				@if(Auth::user()->is_admin())
					<button class="btn" style="float: right"><a href="{{ url('contragent/edit/'.$contragent->id)}}">Редактировать</a></button>
					<button class="btn btn-danger" style="float: right"><a href="{{ url('contragent/delete/'.$contragent->id.'?_token='.csrf_token())}}">Удалить</a></button>
				@endif
			</h3>
		</div>
		<div class="list-group-item">
			<article>
				<!--{!! str_limit($contragent->body, $limit = 1500, $end = '....... <a href='.url("/".$contragent->slug).'>Подробнее</a>') !!}-->
				<p>{{ $contragent->numberdogovor }}</p>
				<p>{{ $contragent->address }}</a></p>
				<p>{{ $contragent->contactface1 }}</a></p>
				<p>{{ $contragent->contact1 }}</a></p>
			</article>
		</div>
	</div>
	@endforeach
	
	<button class="btn" style="float: right"><a href="{{ url('contragent/new')}}">Добавить нового</a></button>
	{!! $contragents->render() !!}
</div>

@endsection