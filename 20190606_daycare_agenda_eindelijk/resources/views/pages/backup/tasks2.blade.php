@extends('layouts.app')


@section('content')
<link href="{{ asset('css/persons.css') }}" rel="stylesheet">
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

<div class="container">
  <div class="content">
    	<form class="form" action="{{URL::to('/tasks2/table')}}" method="post">
    		{{ csrf_field()}}


 <div id="checkboxesClients" style="display: flex;flex-wrap: wrap; width:100%;text-align:center; margin: 0 auto;"></div>
   
   <!--
			<select name="dayOfTheWeek" class="DropdownDayOfTheWeek" style="background-color: #3498DB;
    color: white;">
			  <option value="1" style="background-color: orange;">Maandag</option>
			  <option value="2" style="background-color: teal;">Dinsdag</option>
        <option value="3" style="background-color: salmon;">Woensdag</option>
        <option value="4" style="background-color: crimson;">Donderdag</option>
        <option value="5" style="background-color: lawngreen;">Vrijdag</option>
        <option value="6" style="background-color: seagreen;">Zaterdag</option>
        <option value="7" style="background-color: sienna;">Zondag</option>
			</select>
    -->
    <!--
          <select name="dayOfTheWeek" class="DropdownDayOfTheWeek" style="background-color: #3498DB;
    color: white;">
        <option value="1" style="background-color: #009090;">Maandag</option>
        <option value="2" style="background-color: #009494;">Dinsdag</option>
        <option value="3" style="background-color: #00A8A8;">Woensdag</option>
        <option value="4" style="background-color: #00BCBC;">Donderdag</option>
        <option value="5" style="background-color: #00D0D0;">Vrijdag</option>
        <option value="6" style="background-color: #00E4E4;">Zaterdag</option>
        <option value="7" style="background-color: #00F8F8;">Zondag</option>
      </select>
    -->
      <select name="dayOfTheWeek" class="DropdownDayOfTheWeek" style="background-color: #3498DB;
    color: white;">
        <option value="1" style="background-color: teal;">Maandag</option>
        <option value="2" style="background-color: teal;">Dinsdag</option>
        <option value="3" style="background-color: teal;">Woensdag</option>
        <option value="4" style="background-color: teal;">Donderdag</option>
        <option value="5" style="background-color: teal;">Vrijdag</option>
        <option value="6" style="background-color: teal;">Zaterdag</option>
        <option value="7" style="background-color: teal;">Zondag</option>
      </select>
<!--
              <button formaction="{{URL::to('/tasks2/table')}}">dagplanning</button>
              <button formaction="{{URL::to('/tasks2/edit')}}">aanpassen</button>
-->
              <button class="button button-green" formaction="{{URL::to('/tasks2/table')}}">
                <i class="fa fa-clock-o"></i>
                Dagplanning
              </button>
              <button class="button button-orange" formaction="{{URL::to('/tasks2/edit')}}">
                <i class="fa fa-exclamation-triangle"></i>
                Aanpassen
              </button>
    	</form>

    </div> 
</div>

    	<script src="/js/jquery-3.4.1.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            var clients = {!! json_encode($clients->toArray()) !!};
            console.log(clients);
/*
            for(var i in clients){
               $('#checkboxesClients').append(
               	'<div style="height: 50px; flex-basis: 20%;display: flex;align-items: center;  border: 2px solid black;border-radius: 5px; padding:10px;">' +
               	'<input type="checkbox" name="' + clients[i]['name'] + '" value="' + clients[i]['id'] + '"style="width:40px;height:40px;"/> ' + clients[i]['name'] + '<br>'
               	);
            }*/

            var body = "";

            for(var i in clients){
              body +=
                '<div class="inputGroup">' +
                '<input id="' +  clients[i]['name'] + '" name="' + clients[i]['name'] + '" value="' + clients[i]['id'] + '" type="checkbox"/>' +
                '<label for="' + clients[i]['name'] + '">' + clients[i]['name']  + '</label>' +

                '</div>'
                ;
            }
       
            $('#checkboxesClients').append(body);


        });
    </script>

@endsection



