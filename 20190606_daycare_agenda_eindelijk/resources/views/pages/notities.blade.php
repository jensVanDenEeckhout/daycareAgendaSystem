


@extends('layouts.app')

@if(!Auth::guest())
	@if(Auth::user()->id == 1 )
		@section('content') 


<link href="{{ asset('css/employeesSection.css') }}" rel="stylesheet">
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>



<div class="container">
<div class="content">	
	<a class="btn btn-warning" href="{{URL::to('/2/overzicht/bewoners')}}"> Terug gaan </a>

	<div>
		<h1 style="text-align:center"> Notitieblok </h1>
		<div class="employeesSection">
			<div class="employees" style="text-align:center;font-weight: bold;">
			</div>
		</div>
	</div>  

</div>
</div>


<style>


</style>	

<script src="/js/jquery-3.4.1.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
	var employees = {!! json_encode($employees->toArray()) !!};

	$.ajaxSetup({
	  headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
	});


	createComboboxEmployeesForCommentSection();
	function createComboboxEmployeesForCommentSection(){
	  var employeeSection = "";
	  employeeSection += '<select id="employeesCombobox">';
	  employeeSection +=  '<option value="1" style="background-color: teal;" selected="selected"></option>';
	  for(var employee in employees){
		employeeSection +=
		'<option value="' + employees[employee]['name']  +'" style="background-color: teal;">' + employees[employee]['name'] + '</option>';
	  }    
	  employeeSection += '</select>';
	  $('.employees').append(employeeSection);      
	}


	$("#employeesCombobox").change(function() {
	  var selectedEmployee = $(this).val();
	  var content = "";
	  for(var i=0; i<employees.length;i++){
		if(selectedEmployee == employees[i].name){
		  content += '<h1 class="commentBoxStyling">' + selectedEmployee + '</h1>';
		  content += '<button method="post" type="submit" id="saveCommentOfEmployee">opslaan</button>';
		  content += '<textarea id="commentBoxEmployee" rows="16" cols="54">' + employees[i].note + '</textarea>';
		  $('#commentBoxEmployee').val(employees[i].note);           
		}
	  }
	  $('.commentBoxStyling').remove();
	  $('#commentBoxEmployee').remove();
	  $('.employeesSection').append(content);
	});





	$(document).on("click","#saveCommentOfEmployee", function(e){
	  var selectedName = $( "#employeesCombobox option:selected" ).text();
	  $.each(employees, function(index,value){
		if(value.name == selectedName){
		  value.note = $('#commentBoxEmployee').val();
		  return false;
		}
	  });
	  e.preventDefault();
	  jQuery.ajax({
		url: "{{ url('/tasks/post') }}",  method: 'post', data: { name: selectedName, note: jQuery('#commentBoxEmployee').val() 
	  }});
	});

  });
</script>
		@endsection
	@endif
@endif
