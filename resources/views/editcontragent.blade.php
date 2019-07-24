@extends('app')
@section('title')
Редактировать данные контрагента
@endsection
@section('content')

<form method="post" action='{{ url("/update-contragent") }}'>
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<input type="hidden" name="contragent_id" value="{{ $contragent->id }}">
	<div class="form-group">
		<input required="required" placeholder="Введите название" type="text" name = "name" class="form-control" value="@if(!old('name')){{$contragent->name}}@endif{{ old('name') }}"/>
	</div>
	<div class="form-group">
		
		<input placeholder="Введите номер договора" type="text" name = "numberdogovor" class="form-control" value="@if(!old('numberdogovor')){{$contragent->numberdogovor}}@endif{{ old('numberdogovor') }}"/>
		<input placeholder="Введите адрес объекта" type="text" name = "address" class="form-control" value="@if(!old('address')){{$contragent->address}}@endif{{ old('address') }}"/>
		<input placeholder="Введите ФИО представителя 1" type="text" name = "contactface1" class="form-control" value="@if(!old('contactface1')){{$contragent->contactface1}}@endif{{ old('contactface1') }}"/>
		<input placeholder="Введите телефонный номер 1" type="text" name = "contact1" class="form-control" value="@if(!old('contact1')){{$contragent->contact1}}@endif{{ old('contact1') }}"/>
		<input placeholder="Введите ФИО представителя 2" type="text" name = "contactface2" class="form-control" value="@if(!old('contactface2')){{$contragent->contactface2}}@endif{{ old('contactface2') }}"/>
		<input placeholder="Введите телефонный номер 2" type="text" name = "contact2" class="form-control" value="@if(!old('contact2')){{$contragent->contact2}}@endif{{ old('contact2') }}"/>
	
	</div>

	<input type="submit" name='save' class="btn btn-success" value = "Обновить"/>
	
</form>

@endsection