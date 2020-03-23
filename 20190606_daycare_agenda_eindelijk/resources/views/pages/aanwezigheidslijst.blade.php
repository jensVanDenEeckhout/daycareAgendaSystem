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

        <a class="btn btn-warning" href="{{URL::to('/2/overzicht/bewoners')}}"> Terug gaan </a>

    
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
    var employees = {!! json_encode($employees->toArray()) !!};

    $.ajaxSetup({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });


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
    });
</script>  
    @endsection
  @endif
@endif
