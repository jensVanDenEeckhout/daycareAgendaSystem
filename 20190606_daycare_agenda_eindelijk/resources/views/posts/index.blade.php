@extends('layouts.app')

@section('content')
    <h3>posts</h3>

    @if(count($posts) > 0)
    	@foreach($posts as $post)
    		<div class="well">
    			<h3><a href="/posts/{{$post->id}}"> {{$post->title}}</a></h3>
    			<p> {{$post->body}}</p>
    		</div>
    	@endforeach
    @else
    	<p> no post</p>
    @endif
@endsection

