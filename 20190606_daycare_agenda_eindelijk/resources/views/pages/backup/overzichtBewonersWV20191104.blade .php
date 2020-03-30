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

 

              <div class="employeesSection">

                   <div class="employees" style="text-align:center;font-weight: bold;"> <p> Notitieblok </p></div>
                   <div class="employeeNote"></div>
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
                  var clients = {!! json_encode($clients->toArray()) !!};
                  var floors = {!! json_encode($floors->toArray()) !!};
                  console.log(clients);
      
                  var floorsCheckBoxesContent = "";
                  for(var i in floors){
                    floorsCheckBoxesContent +=
                      '<div class="inputGroup verdieping">' +
                      '<input id="' +  floors[i]['name'] + '" name="' + floors[i]['name'] + '" value="' + clients[i]['id'] + '" type="checkbox"/>' +
                      '<label for="' + floors[i]['name'] + '">' + floors[i]['name']  + '</label>' +

                      '</div>'
                      ;
                  }
                  $('#checkboxesFloors').append(floorsCheckBoxesContent);

                      var clientsCheckBoxesContent = "";
                      for(var i in clients){
                        clientsCheckBoxesContent +=
                          '<div class="inputGroup bewoner">' +
                          '<input id="' +  clients[i]['name'] + '" name="' + clients[i]['name'] + '" value="' + clients[i]['id'] + '" type="checkbox"/>' +
                          '<label for="' + clients[i]['name'] + '">' + clients[i]['name']  + '</label>' +

                          '</div>'
                          ;
                      }
                      $('#checkboxesClients').append(clientsCheckBoxesContent);


    $.ajaxSetup({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });


                  // employee section
                  var employees = {!! json_encode($employees->toArray()) !!};
                  console.log(employees);
                  var employeeSection = "";

$( ".checkboxEmployee" ).on( "click", function(e) {
  $(this).toggleClass('green');
  

console.log($(this));

    var selectedEmployee = $(this).find('input');
    var selectedEmployeeId = selectedEmployee.val();
    var selectedEmployeeIdInArray = selectedEmployeeId-1;
    var attendance = 1 - employees[selectedEmployeeIdInArray]['attendance'];
    console.log(selectedEmployeeId)
    console.log(employees[selectedEmployeeIdInArray]['name']);

    e.preventDefault();

    $.ajax({
       type:'POST',
       url:'/test',
       data:{id:selectedEmployeeId, attendance:attendance},
       success:function(data){
          //alert(data.id);
          //console.log(id);
       }
    });
   }); 






                  // note block employees
                    employeeSection += '<select id="employeesCombobox">';
                    employeeSection +=  '<option value="1" style="background-color: teal;" selected="selected"></option>';
                      
                    for(var employee in employees){
                        employeeSection +=
                            '<option value="' + employees[employee]['name']  +'" style="background-color: teal;">' + employees[employee]['name'] + '</option>'

                    }    
                  employeeSection += '</select>';
                  $('.employees').append(employeeSection);

                  $("#employeesCombobox").change(function() {
                      console.log('name' + $(this).val());
                      var selectedEmployee = $(this).val();
                      var content = "";


                      for(var i=0; i<employees.length;i++){
                        if(selectedEmployee == employees[i].name){
                       
                          /*content += '<div  style="width:400px;">';*/
                            content += '<h1 style="font-size:1.5em; width:300px; display:inline-block;">' + selectedEmployee + '</h1>';
                            content += '<button method="post" type="submit" id="ajaxSubmit2" style="float:right; margin-top:20px; padding:8px 20px; background-color: #4CAF50">opslaan</button>';
                            content += '<textarea id="note2" rows="8" cols="54">' + employees[i].note + '</textarea>';
                         /* content += '</div>';*/

                          console.log('note' + employees[i].note);
                         // $('input[name=name]').val(employees[i].note);

                          $('#nameNote').text(employees[i].name);
                           $('#note2').val(employees[i].note);           
                        }
                      }
                      $('.employeeNote').html(content);
                  });



      $("label:contains('Iedereen')").on("click", function(e){
      console.log('iedereen');
      $(this).prop( "checked", false );  
      //$( "#x" ).prop( "checked", true );
      /*
              $("#checkboxesClients input[type=text]").each(function() {
                console.log($(this));
                     $( "input").prop( "checked", true );   

              });
              */

              $("#checkboxesClients .inputGroup input").each(function(){
          //$(this).find('input') //<-- Should return all input elements in that specific form.
           $(this).prop( "checked", true );  

          console.log('found');
      });     
      });

      $("label:contains('Iedereen')").parent().css("background-color", "#FFE4E1");


      $(".verdieping input").on("click", function(e){

        var selectedFloorName = $(this).parent().find('input').attr('name');
        var floorNumber = 0;
        console.log( selectedFloorName );

        for(var i in floors){
          if(selectedFloorName == floors[i]['name']){
            floorNumber = floors[i]['id'];
              console.log( floorNumber );
            var counter = 0;
            for(var j in clients){
              //console.log(clients[j]);
              if(clients[j]['floor_id'] == floorNumber){
                counter++;
                //$("#tbIntervalos").find("td#" + horaInicial)
                $('.bewoner > input[value="' + clients[j]['id'] + '"]').prop( "checked", true ); 
              }
            }
              console.log(counter);
          }
        }
      });
    });

                  $(document).on("click","#ajaxSubmit2", function(e){
                  var employees = {!! json_encode($employees->toArray()) !!};
                    var selectedName = $( "#employeesCombobox option:selected" ).text();
                    console.log(selectedName);
                    
                    $.each(employees, function(index,value){

                      if(value.name == selectedName){
                          //alert( index + ": " + value.name );
                         // alert( index + ": " + value.note );
                         // alert( index + ": " + $('#note2').val());

                          value.note = $('#note2').val();

                          return false;
                      }
                    });

                   e.preventDefault();
                   $.ajaxSetup({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      }
                    });
                   jQuery.ajax({
                      url: "{{ url('/tasks/post') }}",
                      method: 'post',
                      data: {
                         name: selectedName,
                         note: jQuery('#note2').val()
                      },
                      success: function(result){
                       //  jQuery('.alert').show();
                       //  jQuery('.alert').html(result.success);
                      }});
                  });
          </script>
    @endsection
  @endif
@endif



