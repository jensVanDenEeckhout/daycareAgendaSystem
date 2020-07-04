@extends('layouts.app')

@if(!Auth::guest())
@if(Auth::user()->permission == 2 )
@section('content') 

<link href="{{ asset('css/persons.css') }}" rel="stylesheet">

<link href="{{ asset('css_refactor/overzicht.css') }}" rel="stylesheet">


<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>



<div class="container" >
	<div class="content">
		<form class="formFloors" action="{{URL::to('/2/overzicht/taken')}}" method="post" style="height:75px;">    
			<div name="floors" id="checkboxesFloors" style="text-align:center; margin: 0 auto;"></div>
		</form>

		<form class="form" method="post">

			{{ csrf_field()}}
			<div id="checkboxesClients" style="text-align:center; margin: 0 auto;"></div>


			<div class="normal_user">
				<div class="dropdown">
					<select name="dayOfTheWeek" class="btn btn-secondary dropdown-toggle btn-lg" style="color: white;">
					<option value="1" class="dropdown-item">Maandag</option>
					<option value="2" class="dropdown-item">Dinsdag</option>
					<option value="3" class="dropdown-item">Woensdag</option>
					<option value="4" class="dropdown-item">Donderdag</option>
					<option value="5" class="dropdown-item">Vrijdag</option>
					<option value="6" class="dropdown-item">Zaterdag</option>
					<option value="7" class="dropdown-item">Zondag</option>
					</select>
				</div>

				<div class="dagplanning_button">
					<button class="btn btn-primary" formaction="{{URL::to('/2/overzicht/dagplanning')}}">
						<i class="fa fa-clock-o"> &nbsp;  Dagplanning</i>
					</button>
				</div>
				<div>	
					<button class="btn btn-success" formaction="{{URL::to('/2/aanwezigheidslijst')}}">
						<i class="fa fa-user">&nbsp; Aanwezigheden</i>
					</button> 
				</div>
				<div>
					<button class="btn btn-success" formaction="{{URL::to('/2/notities')}}"> 
						<i class="fa fa-plus">&nbsp; Notities</i>
					</button>	
					<button class="btn btn-danger" formaction="{{URL::to('/2/tijdsregistratie/overzicht')}}"> 
						<i class="fa fa-plus">&nbsp; tijdsregistratie</i>
					</button>	   
				</div>
			</div>

			<div class="admin_user">     
				<h1>Admin section</h1>
				<div class="aanpassen_dagplanning_button">
					<button class="btn button-orange" formaction="{{URL::to('/2/bewerken/dagplanning')}}"> 
						<i class="fa fa-exclamation-triangle">&nbsp; Aanpassen</i>
					</button>
				</div>
				<button class="btn btn-success" formaction="{{URL::to('/2/toevoegen')}}"> 
					<i class="fa fa-plus">&nbsp; Toevoegen</i>
				</button>
			</div>

		</form>
	</div> 
</div>

<style>
  .btn{
	font-size: 25px;
	width: 215px;
	height: 75px;
	color:white;

  }
  .button-orange{
	  background-color: #f58a38;
	  background-image: linear-gradient(to bottom, #f58a38, #f57c20);
	  border: 1px solid #c25706;
	  box-shadow: inset 0 1px 0 #ffb984, inset 0 -1px 0 #db6f1d, inset 0 0 0 1px #f59851, 0 2px 4px rgba(0, 0, 0, 0.2);
	  text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
  }
  .button-orange i{ 
	  color: white;   
  } 

  #checkboxesFloors{
	max-width: 1200px;
  }
  .overviewCallToActionsHomePage{
	margin-top: 22px;
	text-align: center;
  }
  
</style>

<script src="/js/jquery-3.4.1.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
	var clients   = {!! json_encode($clients->toArray()) !!};
	var floors    = {!! json_encode($floors->toArray()) !!};
	var employees = {!! json_encode($employees->toArray()) !!};

	$.ajaxSetup({
	  headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
	});

	createCheckBoxes(floors,'#checkboxesFloors','verdieping');
	createCheckBoxes(clients,'#checkboxesClients','bewoner');

	function createCheckBoxes(dataToPutInCheckBoxes, idElementNameOfCheckBoxesGroup, className){
	  var checkBoxesContent = "";
	  for(var i in dataToPutInCheckBoxes){
		checkBoxesContent +=
		'<div class="inputGroup ' +  className + '">' +
		'<input id="' +  dataToPutInCheckBoxes[i]['name'] + '" name="' + dataToPutInCheckBoxes[i]['name'] + '" value="' + dataToPutInCheckBoxes[i]['id'] + '" type="checkbox"/>' +
		'<label for="' + dataToPutInCheckBoxes[i]['name'] + '">' + dataToPutInCheckBoxes[i]['name']  + '</label>' +
		'</div>';
	  }
	  $(idElementNameOfCheckBoxesGroup).append(checkBoxesContent);
	}


	$("label:contains('Iedereen')").on("click", function(e){
	  $(this).prop( "checked", false );  
	  $("#checkboxesClients .inputGroup input").each(function(){
		$(this).prop( "checked", true );  
	  });     
	});


	
	$("label").on("click", function(e){
	  let floorName = $(this).html();
	  for(var i in floors){
		if(floorName == floors[i]['name']){
		  let floorNumber = floors[i]['id'];
		  var counter = 0;
		  for(var j in clients){
			if(clients[j]['floor_id'] == floorNumber){
			  counter++;
			  $('.bewoner > input[value="' + clients[j]['id'] + '"]').prop( "checked", true );
			}
		  }
		}
	  }      
	});



	$("label:contains('Iedereen')").addClass( "iedereen" );




	$('.dagplanning_button').find('button').attr('disabled', true);
	$('.aanpassen_dagplanning_button').find('button').attr('disabled', true);

	$("input[type=checkbox]").click(function() { 
		var counter = 0;
		$('#checkboxesClients input[type=checkbox]').each(function () {
		      if ($(this)[0].checked) { 

				counter++;
		      } else { 
		            console.log("Check box is Unchecked"); 
		      } 	      
		});

		if(counter > 0){
	            $('.dagplanning_button').find('button').attr('disabled', false);
			$('.aanpassen_dagplanning_button').find('button').attr('disabled', false);
		}else{
			$('.dagplanning_button').find('button').attr('disabled', true);
			$('.aanpassen_dagplanning_button').find('button').attr('disabled', true);
		}
	});



  });
</script>
@endsection
@endif
@endif



