@extends('layouts.app')
@section('content')

<div class="row">
	<div class="col">
		<div class="pull-left">
			<h2>Página Inicial de Frases</h2>
		</div>
	</div>
</div>

@if (session('sucess'))
		<div class="alert alert-sucess">
			{{ session('sucess')}}
		</div>
	@endif

@if (session('error'))
		<div class="alert alert-danger">
			{{ session('error') }}
		</div>
	@endif

<table class="table table-bordered">
	<tr>
		<th>Id</th>
		<th>Title</th>
		<th>Author</th>
		<th>Created</th>
		<th>Updated</th>
		<th>Action</th>
	</tr>
	@foreach ($frases as $frase)
	<tr>
		<td>{{ $frase->id }}</td>
		<td>
			<a href="{{ url("/frases/{$frase->id}") }}">
				{{$frase->title}}
			</a>
		</td>

		<td>{{ $frase->user->name }}</td>
		<td>{{ $frase->created_at }}</td>
		<td>{{ $frase->updated_at }}</td>

		<td>
			<form action="{{ route('frases.destroy',$frase->id) }}" method="POST">

				<a class="btn btn-primary" href="{{ route('frases.show' ,$frase->id) }}">Show</a>
				<a class="btn btn-primary" href="{{route('frases.edit',$frase->id) }}"> Edit </a>
				@csrf
				@method('DELETE')
				<button type="submit" class="btn btn-danger">Delete</button>

			</form>
		</td>
	</tr>
	@endforeach
</table>

{{ $frases->links() }}


@endsection