@extends('layouts.app')
@section('content')

<div class="row">
	<div class="col">
		<div class="pull-left">
			<h2>Mostrar frases</h2>
		</div>
	</div>
</div>

<div class="card">
         <div class="card-header">
             <h1>{{$frase->title}}</h1>
         </div>
        @isset($frase->image)
        <img class="card-img-top" src="{{ asset('storage/'.$frase->image->path) }}">
        @endisset
        
        <div class="card-body">
            <h5 class="card-title">Author: {{$frase->user->name}}</h5>
            <p class="card-text">{{$frase->body}}</p>
        </div>
         <div class="card-footer text-muted">
             <div class="row">
                 <div class="col-6">
                     <ul class="list-inline">
                         @foreach ($frase->generos as $genero)
                         <li class="list list-inline">
                             <h5><span class="badge badge-secondary h4">{{ $genero->name}}</span></h5>
                         </li>
                         @endforeach
                     </ul>
                 </div>
                  <div class="col-6">Created: {{$frase->created_at}}</div>
                 <div class="col-6">Updated: {{$frase->updated_at}}</div>
             </div>
         </div>
     </div>



@endsection