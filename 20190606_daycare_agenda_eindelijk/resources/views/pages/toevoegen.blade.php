@extends('layouts.app')

@if(!Auth::guest())
	@if(Auth::user()->id == 1 )
		@section('content') 

<link href="{{ asset('css_refactor/toevoegen.css') }}" rel="stylesheet">
	

<div class="container">
  <div class="content">	
	<a class="btn btn-warning" href="{{URL::to('/2/overzicht/bewoners')}}"> Terug gaan </a>

	<div>
	    	<form action="/2/toevoegen/taak" method="post">
	    	{{ csrf_field()}}
	        	<input type="text"  name="task_name" value="">
	        	<button type="submit" class="btn btn-primary"  >
	          		Taak Toevoegen
	        	</button >
	    	</form>
	</div>
	<div class="test">
	    <form action="/2/toevoegen/personeel" method="post">
	    	{{ csrf_field()}}
	        	<input type="text"  name="employee_name" value="">
	        	<button type="submit" class="btn btn-primary"  >
	          		Personeel Toevoegen
	        	</button >
	    </form>
	</div>

</div>
</div>


<style>


</style>	

<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<!--<script src="/js/jquery-3.4.1.js"></script>-->
<script type="text/javascript">
  $(document).ready(function() {


	$('input[type=text]').each(function(){
		inputFieldChangedValue($(this));
	});

	$("input").keyup(function(){
		inputFieldChangedValue($(this));	
	});

	function inputFieldChangedValue(inputFieldValue){
		if( !inputFieldValue.val() ){
		 	//$(this).closest('div').siblings().find('button').attr('disabled', true);
		   inputFieldValue.closest('button').prop('disabled', true);
			console.log('empty');
			console.log(  $(this).closest('form').find('button').text() );

			inputFieldValue.closest('form').find('button').prop('disabled', true);
		}else{
			inputFieldValue.closest('form').find('button').prop('disabled', false);
		}
	}


  });
</script>
		@endsection
	@endif
@endif
