@extends('layouts.app')

@section('content')

    @if(count($hours) > 0)
      <p> TIMESTAMPS 
        @foreach($hours as $timestamp)
          {{ $timestamp }}              
        @endforeach
      </p> 



    @endif

  <div id="comboboxes"></div>
  <div id="checkboxes"></div>

   <div style="margin-top: 50px; margin-left: 250px">
          <button class="table1b">generate all from jos</button>
          <button class="table1c">generate all persons</button>
          <button class="table1d">generate based on name and day</button>


      <div id="table1" style="margin-top: 40px">
          Table will generate here.
      </div>

  </div>




<script type="text/javascript">
    $(document).ready(function() {


  // CLICK EVENTS
    $(".table1b").on('click', function(event){
      tableOnePersonTwoDays(timestamps);
    });
    $(".table1c").on('click', function(event){
      tableAllPersons(timestamps);
    });


  //
    var timestamps =  timestampsAsArray();
    var momentsOfTheWeek = momentsOfTheWeekAsArray();
    console.log(momentsOfTheWeek)
 var clients = {!! json_encode($clients->toArray()) !!};


function convertAllValueToArray(){
  var all = {!! json_encode($all->toArray()) !!};
  console.log(all);
  console.log(all[0]);
  console.log(all[0].id);
  console.log(all[0].client.name);
  return all;
}



var all =  convertAllValueToArray();


var allCopy = all.slice(0);

var client1 = [];
for ( var i = 0;  i < allCopy.length; i++ ) {
    //if(allCopy[i].client.name == "Jos Lathouwers"){ 
      if(allCopy[i].client.id == "1"){
      client1.push(all[i]);
    }
}
  console.log("client ");
  console.log(client1[0]);


var client1copy = client1.slice();
var client1week = [];
while(client1copy.length) client1week.push(client1copy.splice(0,72));

var allCopy =  JSON.parse(JSON.stringify(all)); //all.slice();
var allClientsPerDay = [];
while(allCopy.length) allClientsPerDay.push(allCopy.splice(0,72));

// CONSOLE LOG TESTING
  /*
  console.log("client per day");
  console.log(client1week);

  console.log("client per day single element");
  console.log(client1week[0][0]);

  console.log("client per day single element length");
  console.log(client1week[0].length);

  console.log("client");
  console.log(client1);
  */


/*clients / clients[0] / clients[0].name (2) [{…}, {…}]
0: {id: 1, name: "Jos Lathouwers"}
1: {id: 2, name: "Kenneth Nagels"} */
const clientsCopy = JSON.parse(JSON.stringify(clients));

// clientsNames (2) ["Jos Lathouwers", "Kenneth Nagels"]
var clientNames = getSingleField(clientsCopy,'name');

// floors / floor[0] = (4) ["gelijk", "eerste", "tweede", "molenberg"]
var floors = {!! json_encode($floors->toArray()) !!};
var floors = getSingleField(floors,'name');

createComboBoxArray(floors,"floorsCombobox");
createComboBoxArray(clientNames,"clientsCombobox");
createComboBoxArray(momentsOfTheWeek,"momentsOfTheWeek");

createCheckBoxes(clientNames,'clientCheckBoxes'); 
function createCheckBoxes(array,name){
   var container = $('#checkboxes');
   var inputs = container.find('input');
   var id = inputs.length+1;

  for(var i = 0; i< array.length; i++ ) {    
    $('<input />', { type: 'checkbox', id: i+1 , value: array[i] }).appendTo(container);
    $('<label />', { 'for': name, text: array[i]}).appendTo(container);
  }
}
var selectedComboboxes = []
  $('input[type="checkbox"]').click(function(){
      if($(this).prop("checked") == true){
          //alert($(this).attr('id'));
          var indexClient = $(this).attr('id');
          //generateTableBasedOnId(indexClient);
          selectedComboboxes.push(indexClient);
          console.log(selectedComboboxes);
          var indexDay = getIndexOfCombobox("#momentsOfTheWeek"); 

          tableAllPersons2(timestamps,selectedComboboxes,indexDay);

      }
      else if($(this).prop("checked") == false){
          //alert("Checkbox is unchecked.");
          var indexClient = $(this).attr('id');
          selectedComboboxes.splice( $.inArray(indexClient,selectedComboboxes),1)
          console.log(selectedComboboxes);
                    var indexDay = getIndexOfCombobox("#momentsOfTheWeek"); 

                    tableAllPersons2(timestamps,selectedComboboxes,indexDay);

      }
  });


function tableAllPersons2(timestamps,clientsIds,dayOfTheWeek){

var allCopy = all.slice(0);

var client1 = [];


for(var k = 0; k < clientsIds.length; k++){
  for ( var i = 0;  i < allCopy.length; i++ ) {
      //if(allCopy[i].client.name == "Jos Lathouwers"){ 
        if(allCopy[i].client.id == clientsIds[k] && allCopy[i].table_id == dayOfTheWeek){
        client1.push(allCopy[i]);
      }
  }
}

  var clients = [];
  while(client1.length) clients.push(client1.splice(0,72));


console.log(clientsIds);
console.log("selected combox");
console.log(clients);
console.log(clients.length);
console.log("clients[0].length");
console.log(clients[0].length);
console.log(clients[0][0].table_id);



    console.log("test");
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


function generateTableBasedOnId(indexClient){
  
  var allCopy2 =  JSON.parse(JSON.stringify(all));
  var clientNew = getCollection(allCopy2,indexClient);

  var clientWeek = [];
  while(clientNew.length) clientWeek.push(clientNew.splice(0,72));
  var indexDay = getIndexOfCombobox("#momentsOfTheWeek"); 

  tableOnePersonOneDay2(timestamps,clientWeek[indexDay-1]);
}


$( "#clientsCombobox" ).change(function() {
  generateTable();
});

$( "#momentsOfTheWeek" ).change(function() {
  generateTable();
});

function generateTable(){
  var indexClient = getIndexOfCombobox("#clientsCombobox");
  var allCopy2 =  JSON.parse(JSON.stringify(all));
  var clientNew = getCollection(allCopy2,indexClient);

  var clientWeek = [];
  while(clientNew.length) clientWeek.push(clientNew.splice(0,72));
  var indexDay = getIndexOfCombobox("#momentsOfTheWeek"); 

  tableOnePersonOneDay2(timestamps,clientWeek[indexDay-1]);
}



  function tableOnePersonOneDay2(timestamps, clientDay){
    console.log(clientDay);   
    var number_of_rows = clientDay.length;
    var number_of_cols =2;
    var table_body = '<table border="1">';

    //for(var i=0;i<client1week[0].length;i++){
    for(var i=0;i<clientDay.length;i++){  
      table_body+='<tr>';
      table_body +='<td>'+ timestamps[i] +'</td>';
      //for(var j=0;j<client1week.length;j++){
      for(var j=0;j<1;j++){  
        table_body +='<td>';
        //table_body += '<p>'+client1week[j][i].task.name+'</p>';
      table_body += '<p>'+clientDay[i].task.name+'</p>';  
        table_body +='<td>'
      }
        table_body+='</tr>';
      }
      table_body+='</table>';
     $('#table1').html(table_body);
     }


  function getIndexOfCombobox(combobox){
    var index = ($(combobox).prop('selectedIndex') +1);
    return index;    
  }

    function getCollection(allCopy,index){
      var client = [];
      for ( var i = 0;  i < allCopy.length; i++ ) {
    //if(allCopy[i].client.name == "Jos Lathouwers"){ 

      if(allCopy[i].client.id == index){
      client.push(allCopy[i]);
        }
    }

    return client;
    }


   // tableOnePersonOneDayCombobox(tim)


// FUNCTIONS - smaller
  function getSingleField(object,ColumnName){
    var singleFieldArray = [];
      for(var i in object){
        singleFieldArray.push(object[i][ColumnName]);
      }
      return singleFieldArray;
  }

  function createComboBoxArray(array, idOfComboBox){

    var combobox = $('<select id="' + idOfComboBox +'" />');

    for(var i = 0; i< array.length; i++ ) {
        
        $('<option />', {value: array[i], text: array[i]}).appendTo(combobox);
    }


    combobox.appendTo('#comboboxes'); // or wherever it should be
  }

// FUNCTIONS - tables
  // single day one person
  function tableOnePersonOneDay(timestamps){
    console.log("test");
      var number_of_rows = client1.length;
      var number_of_cols =2;
      var table_body = '<table border="1">';

      //for(var i=0;i<client1week[0].length;i++){
      for(var i=0;i<client1.length;i++){  
        table_body+='<tr>';
        table_body +='<td>'+ timestamps[i] +'</td>';
        //for(var j=0;j<client1week.length;j++){
        for(var j=0;j<1;j++){  
          table_body +='<td>';
          //table_body += '<p>'+client1week[j][i].task.name+'</p>';
        table_body += '<p>'+client1[i].task.name+'</p>';  
          table_body +='<td>'
        }
          table_body+='</tr>';
        }
        table_body+='</table>';
       $('#table1').html(table_body);
     }

  function tableOnePersonTwoDays(timestamps){
    console.log("test");
      var number_of_rows = client1.length;
      var number_of_cols =2;
      var table_body = '<table border="1">';

      for(var i=0;i<client1week[0].length;i++){

        table_body+='<tr>';
        table_body +='<td>'+ timestamps[i] +'</td>';
        for(var j=0;j<client1week.length;j++){

          table_body +='<td>';
          table_body += '<p>'+client1week[j][i].task.name+'</p>';

          table_body +='<td>'
        }
          table_body+='</tr>';
        }
        table_body+='</table>';
       $('#table1').html(table_body);
     }

  function tableOnePersonOneDayCombobox(timestamps, client){
    console.log("test");
      var number_of_rows = client.length;
      var number_of_cols =2;
      var table_body = '<table border="1">';

      //for(var i=0;i<client1week[0].length;i++){
      for(var i=0;i<client.length;i++){  
        table_body+='<tr>';
        table_body +='<td>'+ timestamps[i] +'</td>';
        //for(var j=0;j<client1week.length;j++){
        for(var j=0;j<1;j++){  
          table_body +='<td>';
          //table_body += '<p>'+client1week[j][i].task.name+'</p>';
        table_body += '<p>'+client[i].task.name+'</p>';  
          table_body +='<td>'
        }
          table_body+='</tr>';
        }
        table_body+='</table>';
       $('#table1').html(table_body);
     }



  function tableAllPersons(timestamps){
    console.log("test");
      var number_of_rows = client1.length;
      var number_of_cols =2;
      var table_body = '<table border="1">';

      for(var i=0;i<allClientsPerDay[0].length;i++){

        table_body+='<tr>';
        table_body +='<td>'+ timestamps[i] +'</td>';
        for(var j=0;j<allClientsPerDay.length;j++){

          table_body +='<td>';
          table_body += '<p>'+allClientsPerDay[j][i].task.name+'</p>';

          table_body +='<td>'
        }
          table_body+='</tr>';
        }
        table_body+='</table>';
       $('#table1').html(table_body);
     }


// FUNCTIONS - timestamps to array
  function timestampsAsArray(){
    // conversion from blade to javascript
    var timestamps = [
      @foreach ($hours as $hour)
          [ "{{ $hour }}"], 
      @endforeach
      ];
     // console.log(timestamps[0]);
     return timestamps
  }

  function momentsOfTheWeekAsArray(){
    // conversion from blade to javascript
    var array = [
      @foreach ($momentOfTheWeek as $moment)
          [ "{{ $moment }}"], 
      @endforeach
      ];
     // console.log(timestamps[0]);
     return array;
  }

  });
</script>



@endsection
