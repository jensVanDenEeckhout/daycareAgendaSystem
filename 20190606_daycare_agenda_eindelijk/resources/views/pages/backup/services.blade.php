@extends('layouts.app')

@section('content')
    <p>{{$title}}</p>
    @if(count($services) > 0)
    <ul>
    	@foreach($services as $service)
    		<li>{{ $service}}</li>
    	@endforeach
    </ul>
    @endif
@endsection

