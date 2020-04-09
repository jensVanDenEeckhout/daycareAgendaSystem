@extends('layouts.app')

@if(!Auth::guest())
@if(Auth::user()->id == 1 )
@section('content') 




<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

<link href="{{ asset('css_refactor/timetracker.css') }}" rel="stylesheet">


<div class="container" >
<div class="content">

	<h1> time tracker STABE </h1>
  
		

	<p> {{ Auth::user()->id }}</p>
		


	</div>


	<?php 
		var_dump(
			$totalTimeWorkedPerDayCollection
				[array_keys($totalTimeWorkedPerDayCollection)[0] ] 
			);
	?>




</div> 
</div>

<style>

</style>

<script src="/js/jquery-3.4.1.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
  	// LAST WORKED ON 2020 04 03 ===> show code in html view
	var totalTimeWorkedPerDayCollection = {!! json_encode($totalTimeWorkedPerDayCollection) !!};

	console.log( totalTimeWorkedPerDayCollection);
//console.log ( $totalTimeWorkedPerDayCollection );
  	/*
		find latest 

  	*/
  });
</script>
@endsection
@endif
@endif



