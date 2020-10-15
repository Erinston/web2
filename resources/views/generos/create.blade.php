@extends('layouts.app')
@section('content')

<div class="row">
	<div class="col-lg-12 margin-tb">
		<div class="pull-left">
			<h2>Criar novo gênero</h2>
		</div>
	</div>
</div>

@if($errors->any())
	<div class="alert alert-danger">
		<strong>Ops!</strong> Existe um problema com os dados inseridos: <br>
		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif

<form action="{{ route('generos.store') }}" method="POST">
	@csrf

	<div class="row">
	<div class="col">
		<div class="form-group">
			<strong>Name:</strong>
			<input type="text" name="name" class="form-control" required maxlength="30" value="{{ old('name') }}">
		</div>
	</div>
</div>

<div class="row">
	<div class="col tex-center">
		<button type="submit" class="btn col btn-primary">Create</button>
	</div>
</div>

</form>










@endsection