@extends('app')
@section('title')
Редактировать пост
@endsection
@section('content')



<script type="text/javascript" src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>
<script type="text/javascript">
	tinymce.init({ 
		selector : "textarea", 
		plugins : ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste"], 
		toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
	}); 
</script>

<form method="post" action='{{ url("/update") }}'>
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <input type="hidden" name="post_id" value="{{ $post->id }}{{ old('post_id') }}">
  <div class="form-group">
    <input required="required" placeholder="Enter title here" type="text" name = "title" class="form-control" value="@if(!old('title')){{$post->title}}@endif{{ old('title') }}"/>
  </div>
  <div class="form-group">

		<p>
			<select name="contragent" class="form-control">
				@foreach ($contragents as $contragent)
					<option value="{{$contragent->id}}" @if($contragent->id == $post->contragent) selected @endif>{{ $contragent->name }}</option>
				@endforeach
			</select>
		</p>

<?php		
		$arrfiles = [];
		
		foreach($post->files->toArray() as $elem) {
			$arrfiles[] = $elem['id'];
		}
		
		
?>		
		<p>
			<select name="files[]" class="form-control" multiple size="8">
				@foreach ($files as $file)

					<option value="{{$file->id}}" @if(in_array($file->id, $arrfiles)) selected @endif >{{ $file->fullname }}</option>
				@endforeach
			</select>
		</p>		
	
	<textarea name='body'class="form-control">
      @if(!old('body'))
      {!! $post->body !!}
      @endif
      {!! old('body') !!}
    </textarea>
  </div>
  @if($post->active == '1')
  <input type="submit" name='publish' class="btn btn-success" value = "Обновить"/>
  @else
  <input type="submit" name='publish' class="btn btn-success" value = "Опубликовать"/>
  @endif
  <input type="submit" name='save' class="btn btn-default" value = "Сохранить как черновик" />
  <a href="{{  url('delete/'.$post->id.'?_token='.csrf_token()) }}" class="btn btn-danger">Удалить</a>
</form>

@endsection