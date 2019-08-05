@extends('app')
@section('title')
Добавить новыго контрагента
@endsection
@section('content')

<form action="save" method="post" enctype="multipart/form-data">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="form-group">
		<input type="file" multiple name="file[]">
	</div>
	<input type="submit" class="btn btn-success" value = "Загрузить">
</form>

@endsection