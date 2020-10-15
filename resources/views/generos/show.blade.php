@extends('layouts.app')
@section('content')

<div class="row">
	<div class="col">
		<div class="pull-left">
			<h2>Mostrar Gêneros</h2>
		</div>
	</div>
</div>

<div class="row">
	<div class="col">
		<div class="form-group">
			<strong>Id:</strong>
			{{ $genero->id }}
		</div>
	</div>
</div>

<div class="row">
	<div class="col">
		<div class="form-group">
			<strong>Name:</strong>
			{{ $genero->name }}
		</div>
	</div>
</div>

<div class="row">
	<div class="col">
		<div class="form-group">
			<strong>Updated:</strong>
			{{ $genero->updated_at }}
		</div>
	</div>
</div>

<div class="row">
	<div class="col">
		<div class="form-group">
			<strong>Created:</strong>
			{{ $genero->created_at}}
		</div>
	</div>
</div>

<div class="row">
	<div class="col-8">
		<div class="form-group">
			<strong>Frases com este gênero</strong>
			<ul class="list-group">
				@foreach($genero->frases as $frase)
					<div class="col">
						<li class="list-group-item">
							<a href="{{ url("/frases/{$frase->id}") }}">
								{{$frase->title}}
							</a>
						</li>
					</div>
				@endforeach	
			</ul>
		</div>
	</div>
</div>



@endsection