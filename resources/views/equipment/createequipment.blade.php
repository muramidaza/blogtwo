@extends('app')
@section('title')
Добавить новыго контрагента
@endsection
@section('content')

<form action="/contragent/new" method="post">
	<input type="hidden" name="_token" value="{{ csrf_token() }}" enctype="multipart/form-data">
	<div class="form-group">
		<input value="{{ old('type') }}" placeholder="Введите тип" type="text" name = "type" class="form-control">
		<input value="{{ old('model') }}" placeholder="Введите модель" type="text" name = "model" class="form-control">
		<input value="{{ old('serialnumber') }}" placeholder="Введите серийный номер" type="text" name = "serialnumber" class="form-control">
		<input value="{{ old('invnumber') }}" placeholder="Введите инвентарный номер" type="text" name = "invnumber" class="form-control">
		
		<input value="{{ old('contragent_id') }}" placeholder="Введите номер контрагента" type="text" name = "contragent_id" class="form-control">		
	</div>
	<div class="form-group">
		<input type="file" multiple name="file[]" class="form-control">
	</div>
	<input type="submit" name='addcontragent' class="btn btn-success" value = "Сохранить">
</form>

@endsection