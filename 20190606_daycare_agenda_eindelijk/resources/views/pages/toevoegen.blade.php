@extends('layouts.app')

@if(!Auth::guest())
	@if(Auth::user()->permission == 2 )
		@section('content')

<link href="{{ asset('css_refactor/toevoegen.css') }}" rel="stylesheet">
	

<div class="container">
	<div class="content">	
		<a class="btn btn-warning" href="{{URL::to('/2/overzicht/bewoners')}}"> Terug gaan </a>

<div class="row">
	<div class="col-sm-12 col-md-5">
			<form action="/2/toevoegen/taak" method="post">
			{{ csrf_field()}}
				<input type="text"  name="task_name" value="">
				<button type="submit" class="btn btn-primary"  >
					Taak Toevoegen
				</button >
			</form>
	</div>

	<div class="col-sm-12 col-md-5">
			<form action="/2/verwijderen/taak" method="post">
				{{ csrf_field()}}
				{{ Form::select('tasks', $tasks, null) }}
				<button type="submit" class="btn btn-danger">Taak Verwijderen</button >
			</form>
	</div>
</div>


	<div class="row">
		<div class="test col-sm-12 col-md-5">
			<form action="/2/toevoegen/personeel" method="post">
				{{ csrf_field()}}
				<div class="row">
					<label>naam </label>
					<input type="text" class="offset-2" name="employee_name" value="">
				</div>
				<div class="row">
					<label>email </label>				
					<input type="text" class="offset-2" name="employee_email" value="">
				</div>
			
				<div class="row">
					<label>password </label>		
					<input type="password" class="offset-1" name="employee_password" value="">				
				</div>

				<div class="row">
					<label>permission </label>		
					<input type="permission" class="offset-1" name="employee_permission" value="">	
					<label> 1: normal user / 2: admin </label>				
				</div>
					
					<button type="submit" class="btn btn-primary"  >
						Personeel Toevoegen
					</button >
			</form>
		</div>

		<div class="col-sm-12 col-md-5">
			<form action="/2/verwijderen/personeel" method="post">
				{{ csrf_field()}}
				{{ Form::select('employees', $employees, null) }}
				<button type="submit" class="btn btn-danger">Personeel Verwijderen</button >
			</form>
		</div>
	</div>

		<div class="test">
			What happens when a record gets deleted but is used in a clients schedule
			Make sure to catch the error
		</div>




	</div>
</div>


<script type="application/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script type="application/javascript">
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

	var tasks = {!! json_encode($tasks->toArray()) !!};   
	console.log(tasks);
        	


  });
</script>
		@endsection
	@endif
@endif
