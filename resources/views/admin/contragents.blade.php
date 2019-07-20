@extends('app')
@section('title')
{{$title}}
@endsection
@section('content')

<div class="">
	@foreach( $contragents as $contragent )
	<div class="list-group">
		<div class="list-group-item">
			<h3><a href="{{ url('/contragents/'.$contragent->id) }}">{{ $contragent->title }}</a>
				@if(!Auth::guest() && ($contragent->author_id == Auth::user()->id || Auth::user()->is_admin()))
			<button class="btn" style="float: right"><a href="{{ url('editcontragent/'.$contragent->id)}}">Редактировать данные</a></button>
				@endif
			</h3>
			<p>{{ $contragent->name }}</p>
			<p>{{ $contragent->numberdogovor }}</p>
			<p>{{ $contragent->address }}</a></p>
			<p>{{ $contragent->contactface1 }}</a></p>

		</div>
		<div class="list-group-item">
			<article>
				{!! str_limit($contragent->body, $limit = 1500, $end = '....... <a href='.url("/".$contragent->slug).'>Подробнее</a>') !!}
			</article>
		</div>
	</div>
	@endforeach
	{!! $contragents->render() !!}
</div>

@endsection