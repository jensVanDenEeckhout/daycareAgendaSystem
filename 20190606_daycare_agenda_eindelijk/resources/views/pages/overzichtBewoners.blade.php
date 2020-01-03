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
        <select name="dayOfTheWeek" class="DropdownDayOfTheWeek" style="background-color: #3498DB; color: white;">
          <option value="1" style="background-color: teal;">Maandag</option>
          <option value="2" style="background-color: teal;">Dinsdag</option>
          <option value="3" style="background-color: teal;">Woensdag</option>
          <option value="4" style="background-color: teal;">Donderdag</option>
          <option value="5" style="background-color: teal;">Vrijdag</option>
          <option value="6" style="background-color: teal;">Zaterdag</option>
          <option value="7" style="background-color: teal;">Zondag</option>
        </select>

        <button class="button button-green" formaction="{{URL::to('/2/overzicht/taken')}}">
          <i class="fa fa-clock-o" style="color:teal"></i>
          <p>Dagplanning</p>
        </button>

        <button class="button button-orange" formaction="{{URL::to('/2/bewerken/taken')}}">
          <i class="fa fa-exclamation-triangle" style="color:khaki"></i>
          <p>Aanpassen</p>
        </button>
      </div>
    </form>

    <h1 style="text-align:center"> Notitieblok </h1>
    <div class="employeesSection">
      <div class="employees" style="text-align:center;font-weight: bold;"></div>
    </div>

    <div class="headerSection">
      <h1> Aanwezigheidslijst</h1>
    </div>

    <div id="checkboxesEmployees">
      @foreach ($employees as $employee)
        @if( $employee->attendance == 1 )
          <div class="checkboxEmployee green">
          <label class="checked" for="{{ $employee->name }}"> {{ $employee->name }}
          <input type="hidden" id="{{ $employee->name }}" name="{{ $employee->name }}"value="{{ $employee->id }}" type="checkbox"/>
          </label>
        @elseif(   $employee->attendance == 0 )
          <div class="checkboxEmployee">
          <label for="{{ $employee->name }}"> {{ $employee->name }}
          <input type="hidden" id="{{ $employee->name }}" name="{{ $employee->name }}"value="{{ $employee->id }}" type="checkbox"/>
          </label>
        @else
        @endif
        </div>
      @endforeach
      </div>
    </div> 

    
  </div> 
</div>

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


    $( ".checkboxEmployee" ).on( "click", function(e) {
      $(this).toggleClass('green');
      var selectedEmployee = $(this).find('input');
      var selectedEmployeeId = selectedEmployee.val();
      var selectedEmployeeIdInArray = selectedEmployeeId-1;
      var attendance = 1 - employees[selectedEmployeeIdInArray]['attendance'];
      e.preventDefault();
      $.ajax({
      type:'POST',
      url:'/2/attendanceListChangeStatusSelectedEmployee',
      data:{id:selectedEmployeeId, attendance:attendance},
      success:function(data){ }
      });
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



