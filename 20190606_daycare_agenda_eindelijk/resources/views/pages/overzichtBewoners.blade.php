@extends('layouts.app')

@if(!Auth::guest())
@if(Auth::user()->id == 1 )
@section('content') 

<link href="{{ asset('css/persons.css') }}" rel="stylesheet">
<link href="{{ asset('css/employeesSection.css') }}" rel="stylesheet">

<link href="{{ asset('css/attendanceListEmployees.css') }}" rel="stylesheet">
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
<link href="{{ asset('css/callToActions.css') }}" rel="stylesheet">


<div class="container" >
  <div class="content">
    <form class="formFloors" action="{{URL::to('/2/overzicht/taken')}}" method="post" style="height:75px;">    
    <div name="floors" id="checkboxesFloors" style="text-align:center; margin: 0 auto;"></div>
    </form>

    <form class="form" action="{{URL::to('/2/overzicht/taken')}}" method="post">
      {{ csrf_field()}}
      <div id="checkboxesClients" style="text-align:center; margin: 0 auto;"></div>

      <div class="overviewCallToActionsHomePage">


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


        <button class="btn btn-primary" formaction="{{URL::to('/2/overzicht/taken')}}">
          <i class="fa fa-clock-o"> &nbsp;  Dagplanning</i>
        </button>

        <button class="btn button-orange" formaction="{{URL::to('/2/bewerken/taken')}}">
          <i class="fa fa-exclamation-triangle">&nbsp; Aanpassen</i>
        </button>


        <a class="btn btn-success" href="{{URL::to('/2/toevoegen')}}"> <i class="fa fa-plus">&nbsp; Toevoegen</i></a>

         <button class="btn btn-success" formaction="{{URL::to('/2/aanwezigheidslijst')}}">
          <i class="fa fa-plus">&nbsp; Aanwezigheden</i>
        </button>

               


      </div>
    </form>

    <h1 style="text-align:center"> Notitieblok </h1>
    <div class="employeesSection">
      <div class="employees" style="text-align:center;font-weight: bold;"></div>
    </div>

  
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


 

    // n
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

    // n
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
    // n
    $("label:contains('Iedereen')").on("click", function(e){
      $(this).prop( "checked", false );  
      $("#checkboxesClients .inputGroup input").each(function(){
        $(this).prop( "checked", true );  
      });     
    });


    // n
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

    $("label:contains('Iedereen')").addClass( "iedereen" );

  });
</script>
@endsection
@endif
@endif



