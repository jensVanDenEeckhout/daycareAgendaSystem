@extends('layouts.app')

@section('content')
      <head>
        <meta name="_token" content="{{csrf_token()}}" />
      </head>
<link href="{{ asset('css/styles.css') }}" rel="stylesheet">

<div class="container">
    <div class="header"><span>klik hier voor de namen te verbergen</span>
    </div>
  <div class="content">
    <div id="comboboxes"></div>
    <div id="checkboxesClients" style="display: flex;flex-wrap: wrap; width:100%;text-align:center; margin: 0 auto;"></div>
    <button id="generateTable">toon tabel</button>
  </div>
</div>
  <div class="overview1" style="width:100%; display:inline-block;">

  </div>

    <div class="overview2" style="width:100%; display:inline-block;">
      <div class="divOne">
         <form id="myForm">
            <div class="form-group">
              <h1 id="nameNote"></h1>
               <button class="btn btn-primary" id="ajaxSubmit2">Opslaan</button>      
            </div>
            <div class="form-group">
              <textarea  id="note2" rows="8" cols="54"></textarea>
            </div>
          </form>
      </div>
  <div class="overview" style="display:none;">

    <div class="divInfo">
       <div style="width:100%;">  <img id="profilePicture" height="140" width="140" /></div>
    
    </div>

    <div class="divInfo">
      <h3>Medische Informatie</h3>
      <div  id="medischeInformatie" rows="8" cols="54" style="width:100%;"></div>
    </div>

    <div class="divInfo">
      <h3>Belangrijke Nummers</h3>
      <div  id="nummers" rows="8" cols="54" style="width:100%;"></div>
    </div>

    <div class="divInfo">
    <h3>Medicatielijst</h3>
         <div  id="medicatielijst" rows="8" cols="54" style="width:100%;"></div>
    </div>



  </div>
    </div>






   <div style="margin-top: 5px; margin-left: 50px">
      <div id="taskTableByAllSelectedClients" style="margin-top: 40px">
          
      </div>
  </div>

<script type="text/javascript">
  $(document).ready(function() {

    // create checkbox
      // clients checkboxes
        var clients = {!! json_encode($clients->toArray()) !!};
        const clientsCopy = JSON.parse(JSON.stringify(clients));
        var clientNames = getSingleField(clientsCopy,'name');

        function getSingleField(object,ColumnName){
          var singleFieldArray = [];
            for(var i in object){
              singleFieldArray.push(object[i][ColumnName]);
            }
            return singleFieldArray;
        }

    // create checkboxes
      createCheckBoxes(clientNames,'clientCheckBoxes');

      function createCheckBoxes(array,name){
        var container = $('#checkboxes');
        var inputs = container.find('input');
        var id = inputs.length+1;
        var divWithListOfCheckboxes = '';
        for(var i = 0; i< array.length; i++ ) {
        divWithListOfCheckboxes += '<div style="height: 50px; flex-basis: 20%;display: flex;align-items: center;  border: 2px solid black;border-radius: 5px; padding:10px;">';
        divWithListOfCheckboxes += '<input type="checkbox" id="'+(i+1)+'" value="'+array[i]+'" style="width:40px;height:40px;">';
        divWithListOfCheckboxes += '<label for="clientCheckBoxes" style="font-size:20px;margin-left:5px;">'+array[i]+'</label>';
        divWithListOfCheckboxes += '</div>';
        }
        $('#checkboxesClients').html(divWithListOfCheckboxes);
      }

    $(".header").click(function () {
        $header = $(this);
        //getting the next element
        $content = $header.next();
        //open up the content needed - toggle the slide- if visible, slide up, if not slidedown.
        $content.slideToggle(500, function () {
            //execute this after slideToggle is done
            //change text of header based on visibility of content div
            $header.text(function () {
                //change text based on condition
                return $content.is(":visible") ? "klik hier voor de namen te verbergen" : "klik hier voor de namen te tonen";
            });
        });
    });

        var all2 = [];
    
    // all2[0] = {!! json_encode($cellsAndTasksTable1->toArray()) !!};
    // all2[1] = {!! json_encode($cellsAndTasksTable2->toArray()) !!};
    ////console.log('all2');
    ////console.log(all2);


    $("#generateTable").on('click', function(event){
      var selectedClients = [];
      $('#checkboxesClients input:checked').each(function() {
          selectedClients.push($(this).attr('id'));
      });    
      var indexDay = getIndexOfCombobox("#momentsOfTheWeek");  
      console.log(indexDay);
      if((indexDay-1) == 0){
          all2[0] = {!! json_encode($cellsAndTasksTable1->toArray()) !!};
      }
      createTableScroll2(timestamps,selectedClients,indexDay);
    });

    function createTableScroll2(timestamps,clientsIds,dayOfTheWeek){
      $('#taskTableByAllSelectedClients').empty();
      var table_body = '';
      table_body += '<div>';
      table_body += '<p class="custom">';
      table_body += '</p>';
      table_body += '</div>';

      // horizontal - all selected clients
      table_body += '<div class="fixedTable" id="demo">';
        table_body += '<header class="fixedTable-header">';
          table_body += '<table class="table table-bordered">';
            table_body += '<thead>';
              table_body += '<tr>';
                for(var k = 0; k<clientsIds.length;k++){
                  table_body += '<th class="tableNames">' + clientNames[clientsIds[k]-1] +'</th>';
                }
              table_body += '</tr>';
            table_body += '</thead>';
          table_body += '</table>';
        table_body += '</header>';

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

      var all2Copy = all2.slice(0);
      var clientSpecific = [];

      for(var k = 0; k < clientsIds.length; k++){
        for ( var i = 0;  i < all2Copy[0].length; i++ ) {
          if(all2Copy[0][i].client_id == clientsIds[k] && all2Copy[0][i].table_id == dayOfTheWeek){
            clientSpecific.push(all2[0][i]);
          }
        }
      }
      // rgba(17, 153, 142, 1) // rgba(56, 239, 125, 1) //  #11998e, #38ef7d)


      //  "background-image:linear-gradient(to bottom right, #EB5757, #F2C94C);" 
      //rgba(235, 87, 87, 1) rgba(242, 201, 76, 1) EB5757, #F2C94C)
      var colors = [
                    "background-image:linear-gradient(to bottom right, rgba(135,206,235,0.1), rgba(135,206,235,0.9));",
                    "background-image:linear-gradient(to bottom right, rgba(17, 153, 142, 0.3), rgba(56, 239, 125, 0.8));",
                    "background-image:linear-gradient(to bottom right, rgba(235, 87, 87, 0.3), rgba(242, 201, 76, 0.8));"];
      var counter = 0;
      var clients = [];
      while(clientSpecific.length) clients.push(clientSpecific.splice(0,72));

      for(var i=0;i<clients[0].length;i++){ // rows
        table_body+='<tr>';
        for(var j=0;j<clients.length;j++){
              
            //table_body +='<td style="' + colors[getRandomInt(3)] + '">' + clients[j][i].task.name + '</td>';

            table_body +='<td class="taskcell ';
            table_body += clients[j][i].id;
            table_body +='" ';           
            table_body +=' style="' + colors[getRandomInt(3)] + '">' + clients[j][i].task.name + '</td>';
          
        }
        table_body+='</tr>';
      }
             table_body += '</tbody>';
           table_body += '</table>';
      table_body += '</div>';


      $('#taskTableByAllSelectedClients').html(table_body);

      runScripts();

    }















    function runScripts(){
      $.getScript( "js/jquery-3.4.1.js" ).done(function( script, textStatus ) {
        //console.log( textStatus );
      }).fail(function( jqxhr, settings, exception ) {
        $( "div.log" ).text( "Triggered ajaxError handler." );
      });
      $.getScript( "js/script.js" ).done(function( script, textStatus ) {
        //console.log( textStatus );
      }).fail(function( jqxhr, settings, exception ) {
        $( "div.log" ).text( "Triggered ajaxError handler." );
      });

    }

    var allTasks = [];
    allTasks = {!! json_encode($tasks->toArray()) !!};



    function getRandomInt(max) {
      return Math.floor(Math.random() * Math.floor(max));
    }




  
    $("#button1").on('click', function(event){
      //console.log(timestamps);

        var selectedClients = [];
        $('#checkboxesClients input:checked').each(function() {
            selectedClients.push($(this).attr('id'));
        });
        var indexDay = getIndexOfCombobox("#momentsOfTheWeek"); 
        createTableScroll2(timestamps,selectedClients,indexDay);

    });

    // create comboboxes
      // floors
        var floors = {!! json_encode($floors->toArray()) !!};
        var floors = getSingleField(floors,'name');

        createComboBoxArray(floors,"floorsCombobox");


        function momentsOfTheWeekAsArray(){
          // conversion from blade to javascript
          var array = [
            @foreach ($momentOfTheWeek as $moment)
                [ "{{ $moment }}"], 
            @endforeach
            ];
           // //console.log(timestamps[0]);
           return array;
        }

      // days
        var momentsOfTheWeek = momentsOfTheWeekAsArray();
        createComboBoxArray(momentsOfTheWeek,"momentsOfTheWeek");

      // employees
        var employees = [];
        employees = {!! json_encode($employees->toArray()) !!};  
        console.log(employees);

        var employeeNames = getSingleField(employees,'name');
        function getSingleField(object,ColumnName){
          var singleFieldArray = [];
            for(var i in object){
              singleFieldArray.push(object[i][ColumnName]);
            }
            return singleFieldArray;
        }
        createComboBoxArray(employeeNames,"employeesCombobox");
        document.getElementById('employeesCombobox').selectedIndex = -1;


      // function create combobox
        function createComboBoxArray(array, idOfComboBox){
          var combobox = $('<select id="' + idOfComboBox +'" />');
          for(var i = 0; i< array.length; i++ ) {    
              $('<option />', {value: array[i], text: array[i]}).appendTo(combobox);
          }

          combobox.appendTo('.overview1'); // or wherever it should be
        }



    // checkbox checked/unchecked
      var selectedComboboxes = [];

      $('input[type="checkbox"]').click(function(){
        if($(this).prop("checked") == true){

          if( $(this).next().html() == "Iedereen" ){
            selectedComboboxes = [];
            //console.log($(this).next().html());
            $('#checkboxesClients input:checkbox:not(:checked)').each(function() {
              //console.log('unchecked');
              $(this).prop( "checked", true );
              var indexClient = $(this).attr('id');
              //console.log(indexClient);
              selectedComboboxes.push(indexClient);
            });
            var indexDay = getIndexOfCombobox("#momentsOfTheWeek"); 
          }else{
            var indexClient = $(this).attr('id');
            selectedComboboxes.push(indexClient);
            var indexDay = getIndexOfCombobox("#momentsOfTheWeek"); 
            //createTable(timestamps,selectedComboboxes,indexDay);
          }

          //createTable(timestamps,selectedComboboxes,indexDay);
        }
        else if($(this).prop("checked") == false){
          if( $(this).next().html() == "Iedereen" ){
            selectedComboboxes = [];
            $('#table1').empty();
            $('#checkboxesClients input:checked').each(function() {
              //console.log('unchecked');
              $(this).prop( "checked", false );
            });
          }else{
            var indexClient = $(this).attr('id');
            selectedComboboxes.splice( $.inArray(indexClient,selectedComboboxes),1)
            var indexDay = getIndexOfCombobox("#momentsOfTheWeek"); 
            // createTable(timestamps,selectedComboboxes,indexDay);          
          }




        }
      });

      function getIndexOfCombobox(combobox){
        var index = ($(combobox).prop('selectedIndex') +1);
        return index;    
      }

    // create table
      function createTable(timestamps,clientsIds,dayOfTheWeek){
        //console.log("START CREATING TABLE");
        $('#table1').empty();
        var allCopy = all.slice(0);
        var client1 = [];          
        for(var k = 0; k < clientsIds.length; k++){
          for ( var i = 0;  i < allCopy.length; i++ ) {
            if(allCopy[i].client.id == clientsIds[k] && allCopy[i].table_id == dayOfTheWeek){
              client1.push(allCopy[i]);

            }
          }
        }


        var clients = [];
        while(client1.length) clients.push(client1.splice(0,72));
        var number_of_rows = client1.length;
        var number_of_cols =2;
        var table_body = '<table border="1">';
            table_body+='<tr>';
        table_body +='<td>'+ "hours" +'</td>';
        for(var c = 0; c < clientsIds.length;c++){
          table_body +='<td>'+ clientNames[clientsIds[c]-1] +'</td>';          
        }
                   table_body+='</tr>';

                                                      
        for(var i=0;i<clients[0].length;i++){ // rows
          table_body+='<tr>';
          table_body +='<td>'+ timestamps[i] +'</td>';
          for(var j=0;j<clients.length;j++){
            table_body +='<td>';
            table_body += '<p>'+clients[j][i].task.name+'</p>';
            table_body +='</td>'
          }
          table_body+='</tr>';
        }
          table_body+='</table>';
          $('#table1').html(table_body);
                        }

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
      <?php     // get all queries in one variable
    /*
      var all =  convertAllValueToArray();
      function convertAllValueToArray(){
        var all = {!! json_encode($all->toArray()) !!};
        //console.log(all);
        //console.log(all[0]);
        //console.log(all[0].id);
        //console.log(all[0].client.name);
        return all;
      }
      */ ?>



      $( "#momentsOfTheWeek" ).change(function() {
        var selectedClients = [];
        $('#checkboxesClients input:checked').each(function() {
            selectedClients.push($(this).attr('id'));
        });
        var indexDay = getIndexOfCombobox("#momentsOfTheWeek"); 
        createTable(timestamps,selectedClients,indexDay);
      });

      $("#employeesCombobox").change(function() {
        console.log($(this).val());
        var selectedEmployee = $(this).val();
        var content = "";
        for(var i=0; i<employees.length;i++){
          if(selectedEmployee == employees[i].name){
         
            content += '<div  style="width:400px;">';
              content += '<h1 style="font-size:1.5em; width:300px; display:inline-block;">' + selectedEmployee + '</h1>';
              content += '<button action= "/insert" method="post" type="submit" id="ajaxSubmit2" style="float:right; margin-top:20px; padding:8px 20px; background-color: #4CAF50">opslaan</button>';
              content += '<textarea id="note2" rows="8" cols="54">' + employees[i].note + '</textarea>';
            content += '</div>';

            console.log(employees[i].note);
           // $('input[name=name]').val(employees[i].note);

            $('#nameNote').text(employees[i].name);
             $('#note2').val(employees[i].note);
                       
          }
        }
        $('.divOne').html(content);
      });

        $(document).on("click", '#buttonSaveNote', function() {
          var name = $(this).prev('h1').text();    
          $.each(employees, function( index, value ) {
            console.log(value)
            if(value.name == name){
              alert( index + ": " + value.name );
              return false;
            }
          });

        });

            $(document).on("click","#ajaxSubmit2", function(e){
              var selectedName = $( "#employeesCombobox option:selected" ).text();
              console.log(selectedName);
              $.each(employees, function(index,value){

                if(value.name == selectedName){
                    //alert( index + ": " + value.name );
                    alert( index + ": " + value.note );
                    alert( index + ": " + $('#note2').val());

                    value.note = $('#note2').val();

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
                url: "{{ url('/tasks/post') }}",
                method: 'post',
                data: {
                   name: selectedName,
                   note: jQuery('#note2').val()
                },
                success: function(result){
                   jQuery('.alert').show();
                   jQuery('.alert').html(result.success);
                }});
            });


            $(document).on('click','.fixedTable-header th',function(){
              var name = $(this).text();
              console.log("click");              
              console.log(name);

             $.each(clients, function( index, value ) {
              console.log(value)
              if(value.name == name){
                //$('#medischeInformatie').val(value.medicatielijst); // for textarea
                $('#medischeInformatie').text(value['medische informatie']); // for p                            
                $('#medicatielijst').text(value.medicatielijst); // for p 
                $('#nummers').text(value.nummers); // for p 

                $("#profilePicture").attr("src",value.picture);
                  // medicatielijst
                return false;
              }
              });
            });

               
          
          });




</script>



@endsection




