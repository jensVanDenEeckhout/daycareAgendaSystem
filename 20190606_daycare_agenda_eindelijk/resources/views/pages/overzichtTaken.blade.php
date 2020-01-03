@extends('layouts.app')

@section('content')
    <head>
 	<meta name="_token" content="{{csrf_token()}}" />
    </head>
	<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
	<link href="{{ asset('css/employeesSection.css') }}" rel="stylesheet">
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

	        <form class="formSmallButton" action="{{URL::to('/2/overzicht/taken')}}" method="get">
              <button class="buttonSmallTaken button-orange"  style="margin-top: 6px;position: absolute;width: 111px;height: 26px;margin-left: -12px;" formaction="{{URL::to('/2/overzicht/bewoners')}}">
                <i class="fa fa-arrow-left" aria-hidden="true" ></i>
                Terug gaan
              </button>
      </form>

    <div style="margin-top: 5px; margin-left: 50px">
    	<div id="taskTableByAllSelectedClients" style="margin-top: 10px"></div>
    </div>



    <h1 style="text-align:center"> Notitieblok </h1>
    <div class="employeesSection">
      <div class="employees" style="text-align:center;font-weight: bold;"></div>
    </div>



<script src="/js/jquery-3.4.1.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

        	console.log('test table blade page');
        	
	        var clients = {!! json_encode($clients->toArray()) !!};   	
	        var cellsGroupedByClient = {!! json_encode($cellsGroupedByClient->toArray()) !!};

		    // get timestamps
		    	var timestamps =  timestampsAsArray();
		     	function timestampsAsArray(){
			        var timestamps = [
			          @foreach ($hours as $hour)
			              [ "{{ $hour }}"], 
			          @endforeach
			          ];
			        return timestamps
		     	}

		    createScrollableTable(timestamps,clients,cellsGroupedByClient)

		    //complete table creation
				function createScrollableTable(timestamps,clients,cellsGroupedByClient){
		      		$('#taskTableByAllSelectedClients').empty();	
				    var table_body = '';
				    table_body += '<div>';
				    table_body += '<p class="custom">';
				    table_body += '</p>';
				    table_body += '</div>';

				    table_body += tablePartHorizontalClients(clients);
				    table_body += tablePartVerticalTimestamps(timestamps);
				    table_body += tablePartTaskCells(clients,cellsGroupedByClient);

			    	$('#taskTableByAllSelectedClients').html(table_body);    	

			    	runScripts();	
				}
				//table creation Different parts
					function tablePartHorizontalClients(clients){
				     	var table_body = '';
					    // horizontal - all selected clients
					      table_body += '<div class="fixedTable" id="demo">';
					        table_body += '<header class="fixedTable-header">';
					          table_body += '<table class="table table-bordered">';
					            table_body += '<thead>';
					              table_body += '<tr>';
					                for(var k = 0; k<clients.length;k++){
					                  table_body += '<th class="tableNames">' + clients[k].name + '</th>';
					                }
					              table_body += '</tr>';
					            table_body += '</thead>';
					          table_body += '</table>';
					        table_body += '</header>';		
					    return table_body;     	
				    }
				    function tablePartVerticalTimestamps(timestamps){
				      	var table_body = ''; 				
				        // vertical - all timestamps - 6:00 - 23:45
				        table_body += '<aside class="fixedTable-sidebar">';
				          table_body += '<table class="table table-bordered">';
				            table_body += '<tbody>';
				              for(var j = 0; j<timestamps.length;j++){
				                table_body += '<tr class="tableHours">';
				                table_body += '<td>' + timestamps[j] +'</td>';
				                table_body += '</tr>';
				              }
				            table_body += '</tbody>';
				          table_body += '</table>';
				        table_body += '</aside>';

				        table_body += '<div class="fixedTable-body">';
				           table_body += '<table class="table table-bordered">';
				             table_body += '<tbody>';
				        return table_body;
			 		}
			 		function tablePartTaskCells(clients,cellsGroupedByClient){
							var colors = [
							                "background-image:linear-gradient(to bottom right, #FE5F55, rgba(255,64,0,0.9));", // red
							                "background-image:linear-gradient(to bottom right, #88a753, #88a753);", // green
							                "background-image:linear-gradient(to bottom right, rgba(0,191,255,0.5),rgba(0,191,255,0.5));", // light blue
							                "background-image:linear-gradient(to bottom right, rgba(255,128,0,0.8),rgba(255,128,0,0.8));" // dark orange
							                ];

					     	var table_body = '';
							for(var i=0;i<cellsGroupedByClient[clients[0].id].length;i++){ // rows
							    table_body+='<tr>';
							    for(var j=0;j<clients.length;j++){
							          
							        table_body +='<td class="taskcell ';
							        table_body += cellsGroupedByClient[clients[j].id][i].id;
							        table_body +='" ';   

							        if( cellsGroupedByClient[clients[j].id][i].task_done == "1"){
										table_body += 'style="background-color:' + "grey" + '">' + cellsGroupedByClient[clients[j].id][i].task.name + '</td>';
							        }else{  
							        table_body += 'style="background-color:' + cellsGroupedByClient[clients[j].id][i].category.color + '">' + cellsGroupedByClient[clients[j].id][i].task.name + '</td>';
							    	}
							      
							    }
							    table_body+='</tr>';
							}

							        table_body += '</tbody>';
							    table_body += '</table>';
							 table_body += '</div>';	
							 return table_body;
					}

				    function runScripts(){
				    	$.getScript( "/js/jquery-3.4.1.js" ).done(function( script, textStatus ) {
				    	}).fail(function( jqxhr, settings, exception ) {
				      		$( "div.log" ).text( "Triggered ajaxError handler." );
				    	});
				    	$.getScript( "/js/script.js" ).done(function( script, textStatus ) {
				    	}).fail(function( jqxhr, settings, exception ) {
				      		$( "div.log" ).text( "Triggered ajaxError handler." );
				    	});
				    }

			function getRandomInt(max) {
		    	return Math.floor(Math.random() * Math.floor(max));
		    }

			$('.fixedTable-body td').on('click',function(e){
			    var thisCell = $(this);

			    console.log(thisCell);

			    var classList = thisCell.attr('class').split(/\s+/);
			    console.log(classList[1]); // class id

			    $(this).toggleClass('clicked');
			    console.log($(this).parent().prevAll().length);   // ALL PREVIOUS FIELDS
			    var task_done = 0;

			    if($(this).hasClass('clicked')){
			    	task_done = 1;
			    }else{
			    	task_done = 0;
			    }

		        $.ajaxSetup({
		          headers: {
		              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		          }
		        });
		        e.preventDefault();
		        var id = classList[1];
		        console.log('task done state: ' + task_done);

		        $.ajax({
		          type:'post',
		          url:'/2/overzicht/taken/taak/compleet',
		          data:{id:id, task_done: task_done},
		          success:function(data){
		          	console.log("task complete");
		          }
		        });
			});


            // employee section
            var employees = {!! json_encode($employees->toArray()) !!};
            console.log(employees);
            var employeeSection = "";


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
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
      });
      jQuery.ajax({
        url: "{{ url('/tasks/post') }}",  method: 'post', data: { name: selectedName, note: jQuery('#commentBoxEmployee').val() 
      }});
    });
});

	</script>
@endsection




