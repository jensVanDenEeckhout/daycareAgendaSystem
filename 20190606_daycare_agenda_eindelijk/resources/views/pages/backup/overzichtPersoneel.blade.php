@extends('layouts.appOriginal')


@section('content')
<head>

  <link href="{{ asset('css/attendanceListEmployees.css') }}" rel="stylesheet">
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
  <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <meta name="csrf-token" content="{{csrf_token()}}" />
</head>


<body>
  <div class="container">
    <div class="content">
      <div class="headerSection">

       <form class="formSmallButton" action="{{URL::to('/2/overzicht/taken')}}" method="get">
        <button formaction="{{URL::to('/2/overzicht/bewoners')}}">Ga Terug</button>
      </form>



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
</body>


<script type="text/javascript">
    console.log("test)");




    $.ajaxSetup({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });





var employees = {!! json_encode($employees->toArray()) !!};
    
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
</script>

@endsection



