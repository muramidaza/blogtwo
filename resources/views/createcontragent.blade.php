@extends('app')
@section('title')
Добавить новыго контрагента
@endsection
@section('content')

<form action="/new-contragent" method="post">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="form-group">
		<input required="required" value="{{ old('name') }}" placeholder="Введите название" type="text" name = "name" class="form-control">
	</div>
	<div class="form-group">
		<input value="{{ old('numberdogovor') }}" placeholder="Введите номер договора" type="text" name = "numberdogovor" class="form-control">
		<input value="{{ old('address') }}" placeholder="Введите адрес объекта" type="text" name = "address" class="form-control">
		<input value="{{ old('contactface1') }}" placeholder="Введите ФИО представителя 1" type="text" name = "contactface1" class="form-control">
		<input value="{{ old('contact1') }}" placeholder="Введите  телефонный номер 1" type="text" name = "contact1" class="form-control">
		<input value="{{ old('contactface2') }}" placeholder="Введите ФИО представителя 2" type="text" name = "contactface12" class="form-control">
		<input value="{{ old('contact2') }}" placeholder="Введите телефонный номер 2" type="text" name = "contact2" class="form-control">
	</div>
	<input type="submit" name='addcontragent' class="btn btn-success" value = "Сохранить">
</form>

@endsection