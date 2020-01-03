@extends('layouts.app')

@section('content')
    <head>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}" />

  <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
    </head>


    




    <div class="tasksToChangeTable" style="margin-top: 5px; margin-left: 50px">

        <form class="formSmallButton" action="{{URL::to('/2/overzicht/taken')}}" method="get">
          <button class="buttonSmall button-orange"  formaction="{{URL::to('/2/overzicht/bewoners')}}">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>Terug gaan
          </button>
        </form>

      <div id="taskTableByAllSelectedClients" style="margin-top: 10px">


      </div>
      <div class="categoryLegend" style="margin-top: 10px; width:250px"></div>
    </div>


    <form class="formAddTask" action="{{URL::to('/2/toevoegen/taak')}}" method="post">
      {{ csrf_field()}}

        <input type="text" name="task_name" value="">
        <button class="button button-orange">
          <p>Taak Toevoegen</p>
        </button>

    </form>


 <div id="checkboxesEmployees" style="display: flex;flex-wrap: wrap; width:100%;text-align:center; margin: 0 auto;"></div>
    
        

<script src="/js/jquery-3.4.1.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
          var tasks = {!! json_encode($tasks->toArray()) !!};     
          console.log(tasks);
          var categories = {!! json_encode($categories->toArray()) !!};     


          makeCategoryLegend();

          function makeCategoryLegend(){
            $('.categoryLegend').empty();  
            var table_body = '';
           
            for(var i=0; i<categories.length; i++){
              table_body += '<div style=" padding: 5px; margin-right:20px; display:inline; background-color:' + categories[i].color + '">' + categories[i].name + '</div>';
            }
            
            $('.categoryLegend').html(table_body);     
          }


          createComboBoxArray(tasks,"comboboxTasks");

          function createComboBoxArray(array, idOfComboBox){
            var combobox = $('<select id="' + idOfComboBox +'" />');
            for(var i = 0; i< array.length; i++ ) {    
                $('<option />', {value: array[i].id, text: array[i].name}).appendTo(combobox);
            }    
            combobox.appendTo('#comboboxTasks'); // or wherever it should be
          }

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



          // console.log(clients[0]);
          // console.log(clients[1].id);
          // console.log(timestamps);
          // console.log(cells);
          // console.log(cells[0][0]);
          // console.log(cells[0]['client_id']);       
          // console.log(cellsGroupedByClient); 
          // console.log(cellsGroupedByClient[2]);  
          // console.log(cellsGroupedByClient[2][0]);  

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
                              "background-color: red;", // red
                              "background-color: green;", // green
                              "background-color: cyan;", // light blue
                              "background-color: #ff8000;" // dark orange
                              ];

                var table_body = '';
              for(var i=0;i<cellsGroupedByClient[clients[0].id].length;i++){ // rows
                  table_body+='<tr>';
                  for(var j=0;j<clients.length;j++){
                        
                      //table_body +='<td style="' + colors[getRandomInt(3)] + '">' + clients[j][i].task.name + '</td>';

                      table_body +='<td class="taskcell ';
                      table_body += cellsGroupedByClient[clients[j].id][i].id;
                      table_body +='" ';           
                      table_body +=' style="background-color:' + cellsGroupedByClient[clients[j].id][i].category.color + '">' + cellsGroupedByClient[clients[j].id][i].task.name + '</td>';
                    
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
                  //console.log( textStatus );
              }).fail(function( jqxhr, settings, exception ) {
                  $( "div.log" ).text( "Triggered ajaxError handler." );
              });
              $.getScript( "/js/script.js" ).done(function( script, textStatus ) {
                //console.log( textStatus );
              }).fail(function( jqxhr, settings, exception ) {
                  $( "div.log" ).text( "Triggered ajaxError handler." );
              });
            }

      function getRandomInt(max) {
        return Math.floor(Math.random() * Math.floor(max));
      }

      function reloadPage(){
                    window.location.reload();
      }

      $('.buttonReloadPage').on('click',function(e){
           window.location.reload();
      });


  

      $( ".fixedTable-body .table-bordered td" ).hover(function() {
        //$(this).css("background-color", "yellow");
        addCombobox($(this),tasks,"comboboxTasksCell");
        addCombobox($(this),categories,"comboboxCategoriesCell");

        }, function(){
        //$(this).css("background-color", "pink");
        $(this).children("#comboboxTasksCell").remove();
        $(this).children("#comboboxCategoriesCell").remove();

      });

      $(document).on('click',".childDiv", function(e){
        e.stopPropagation();        
      });

      $(document).on('change',"#comboboxTasksCell", function(e){

        var thisCombobox = $(this);
        var thisCell = thisCombobox.parent();
        console.log(thisCell);

        var classList = thisCell.attr('class').split(/\s+/);
        console.log(classList[1]); // class id
        var selectedTask = $("#comboboxTasksCell option:selected").val(); 
         var selectedTaskName = $("#comboboxTasksCell option:selected").text(); 
             
        thisCell.text(selectedTaskName);
        console.log('valuesssss');
        console.log(classList[1]);
        console.log(selectedTask);

        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        e.preventDefault();
        var id = classList[1];
        var task_id = selectedTask;

        $.ajax({
          type:'POST',
          url:'/2/bewerken/taken/aanpassen/taak',
          data:{id:id, task_id: task_id},
          success:function(data){
            //alert(data.success);
          }
        });
      });

      $(document).on('change',"#comboboxCategoriesCell", function(e){

        var thisCombobox = $(this);
        var thisCell = thisCombobox.parent();
        console.log(thisCell);
        var classList = thisCell.attr('class').split(/\s+/);
        console.log(classList[1]); // class id
        var selectedCategory = $("#comboboxCategoriesCell option:selected").val(); 
        console.log(selectedCategory);
        console.log(categories);

        console.log(categories.find(x => x.id == selectedCategory).color);

        thisCell.css("background-color", categories.find(x => x.id == selectedCategory).color);
        console.log('valuesssss');
        console.log(classList[1]);
        console.log(selectedCategory);




        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        e.preventDefault();
        var id = classList[1];
        var category_id = selectedCategory;

        $.ajax({
          type:'POST',
          url:'/2/bewerken/taken/aanpassen/verantwoordelijkeOrganisatie',
          data:{id:id, category_id: category_id},
          success:function(data){
            //alert(data.success);
          }
        });
      });



  // employee section
  var employees = {!! json_encode($employees->toArray()) !!};
  console.log(employees);
  var employeeSection = "";






      function addCombobox(currentCell,tasks,idOfComboBox){
        var combobox = $('<select id="' + idOfComboBox +'" />');
        var body = '<option value="1" style="background-color: teal;" selected="selected"></option>';
        $(body).appendTo(combobox);
        for(var i = 0; i< tasks.length; i++ ) {    
            $('<option />', {value: tasks[i].id, text: tasks[i].name}).appendTo(combobox);
        }      
        //clicking on the button will display the combobox or dropdown - clicking on the
        //button it will append the dropdown to a paragraph
        combobox.appendTo(currentCell);
      }
    });
  </script>
@endsection




