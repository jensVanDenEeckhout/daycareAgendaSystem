@extends('layouts.app')

@if(!Auth::guest())
@if(Auth::user()->id == 1 )
@section('content') 




<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

<link href="{{ asset('css_refactor/timetracker.css') }}" rel="stylesheet">


<div class="container" >
<div class="content">

	<h1> time tracker STABE </h1>
  
	<div class="timetracking"> 
	    	<form action="/2/startTime/now/start" method="post">
	    	{{ csrf_field()}}
	    		<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
	        	
	        	<button type="submit" class="btn btn-success"  >
	          		start
	        	</button >
	    	</form>

	    	<form action="/2/timetracker/stop" method="post">
	    	{{ csrf_field()}}
	    		<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
	        
	        	<button type="submit" class="btn btn-danger"  >
	          		stop
	        	</button >
	    	</form>
		

	    	<form action="/2/timetracker/seperatePerDate" method="post">
	    	{{ csrf_field()}}
	    		<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
	        
	        	<button type="submit" class="btn btn-danger"  >
	          		overview
	        	</button >
	    	</form>
		

	<p> {{ Auth::user()->id }}</p>
		


	</div>





</div> 
</div>

<style>

</style>

<script src="/js/jquery-3.4.1.js"></script>
<script type="text/javascript">
  $(document).ready(function() {


  	/*
		find latest 

  	*/
  });
</script>
@endsection
@endif
@endif



