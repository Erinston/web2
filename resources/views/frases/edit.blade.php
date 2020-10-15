@extends('layouts.app')
@section('content')


<div class="row">
	<div class="col">
		<div class="pull-left">
			<h2>Editar frase</h2>
		</div>
	</div>
</div>

@if ($errors->any())
  <div class="alert alert-danger">
    <strong>Ops!</strong>Existe um problema com os dados inseridos <br><br>
    <ul>
      @foreach($errors->all() as $error)
      <li>
        {{ $error }}
       </li>
       @endforeach
    </ul>
  </div>
@endif

<form  action="{{ route('frases.update',$frase->id) }}" method="POST" enctype="multipart/form-data">
	@csrf
	@method('PUT')

	<div class="row">
		<div class="col">
			<div class="form-group">
				<strong>Title:</strong>
				<input type="text" name="title" class="form-control" value= "{{ $frase->title }}" required="" maxlength="255">
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col">
			<div class="form-group">
				<strong>Body:</strong>
				<textarea class="form-control" name="body" >{{ $frase->body }}</textarea>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col">
			<div class="form-group">
				<strong class='col-2'>Image:</strong>
				<img class='col-2' src="{{ asset('storage/'.$frase->image->path) }}">
				<input class='col-8' id="image" type="file" name="image" class="form-control">
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col">
			<div class="form-group">
				<strong>Gêneros:</strong>
				<select class="custom-select" name="generos_id[]" multiple>
					@foreach ($generos as $genero)
						@if($frase->generos->contains($genero))
							<option value="{{ $genero->id }}">{{ $genero->name }}</option>
						@else
							<option value="{{ $genero->id }}">{{ $genero->name }}</option>
						@endif
					@endforeach
				</select>
			</div>
		</div>
	</div>

	<div class="col text-center">
		<button type="submit" class="btn btn-primary col">Update</button>
	</div>

</form>


@endsection