@extends('layouts.app')
@section('content')

<div class="row">
	<div class="col">
		<div class="pull-left">
		<h2>Página Inicial de Gênero</h2>
		</div>
	</div>
</div>

@if(session('sucess'))
	<div class="alert alert-sucess">
		{{ session('sucess') }}
	</div>
@endif

@if(session('error'))
	<div class="alert alert-danger">
		{{ session('error') }}
	</div>
@endif

<table class="table table-bordered">
	<tr>
		<th>Id</th>
		<th>Name</th>
		<th>Frases Counter</th>
		<th>Created</th>
		<th>Updated</th>
		<th>Action</th>
	</tr>
	@foreach ($generos as $genero)
	<tr>
		<td>{{$genero->id}}</td>
		<td>{{$genero->name}}</td>
		<td>{{$genero->frases_count()}}</td>
		<td>{{$genero->created_at}}</td>
		<td>{{$genero->updated_at}}</td>
		<td>
		<form action="{{ route('generos.destroy', $genero->id) }}" method="POST">
			<a class="btn btn-info" href="{{ route('generos.show', $genero->id) }}">Show</a>

			<a class="btn btn-primary" href="{{ route('generos.edit', $genero->id) }}">Edit</a>
			@csrf
			@method('DELETE')
			<button type="submit" class="btn btn-danger">Delete</button>
		</form>
		</td>
	</tr>
	@endforeach
</table>

@endsection