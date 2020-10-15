@extends('layouts.app')
@section('content')

<div class="row">
	<div class="col-lg-12 margin-tb">
		<div class="pull-left">
			<h2>Editar Gênero</h2>
		</div>
	</div>
</div>

@if($errors->any())
<div class="alert alert-danger">
	<strong>Ops!</strong> Existe um problema com os dados inseridos: <br>
	<ul>
		@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif

<form action="{{ route('generos.update',$genero->id) }}" method="POST">
	@csrf
	@method('PUT')
	<div class="row">
		<div class="col">
			<div class="form-group">
				<strong>Name:</strong>
				<input type="text" name="name" class="form-control" required maxlength="30" value="{{ $genero->name }}">
			</div>
		</div>
	</div>

<div class="row">
	<div class="col text-center">
		<button type="submit" class="btn col btn-primary">Update</button>
	</div>
</div>	
</form>

@endsection