@extends('layouts.app')


@section('content')
<head>

  <link href="{{ asset('css/attendanceListEmployees.css') }}" rel="stylesheet">
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
  <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <meta name="_token" content="{{csrf_token()}}" />
</head>


<body>
  <div class="container">
    <div class="content">
         
   <div id="checkboxesEmployees" style="display: flex;flex-wrap: wrap; width:100%;text-align:center; margin: 0 auto;">
    @foreach ($employees as $employee)
     <div class="inputGroup">
        @if( $employee->attendance == 1 )
          <label class="checked" for="{{ $employee->name }}"> {{ $employee->name }}
        <input  id="{{ $employee->name }}" name="{{ $employee->name }}"value="{{ $employee->id }}" type="checkbox"/>;
          </label>
        @elseif(   $employee->attendance == 0 )
          <label for="{{ $employee->name }}"> {{ $employee->name }}
        <input  id="{{ $employee->name }}" name="{{ $employee->name }}"value="{{ $employee->id }}" type="checkbox"/>;
          </label>
        @else

        @endif
      </div>
    @endforeach
   </div>


  <button class="btn-test">test</button>
      </div> 
  </div>
</body>


<script type="text/javascript">
    console.log("test)");

    $.ajaxSetup({
      headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
    });
var employees = {!! json_encode($employees->toArray()) !!};
     
  $(document).on('click',"label input",function(e){

    
    var selectedEmployee = $(this);
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



