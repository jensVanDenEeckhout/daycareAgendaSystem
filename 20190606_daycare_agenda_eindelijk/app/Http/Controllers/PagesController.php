<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Task;
use App\Cell;
use App\Client;
use App\Floor;
use App\Employee;
use App\Category;
use App\Timetracking;

use DateTime;

class PagesController extends Controller
{
        public function attendanceListChangeStatusSelectedEmployee(Request $request){
            DB::table('employees')
            ->where('id', $request->input('id'))
            ->update(['attendance' => $request->input('attendance')]);
            return response()->json(['success'=>'Data is successfully added']);   
        }



    public function store(Request $request){

        // update
        DB::table('employees')
            ->where('name', $request->input('name'))
            ->update(['note' => $request->input('note')]);
        $employees = Employee::all();
        /*return view('pages.tasks')->with('employees',$employees);*/

        return response()->json(['success'=>'Data is successfully added']);
    }



    // 
    //https://stackoverflow.com/questions/47078330/get-the-request-values-in-laravel
    //https://gist.github.com/haakym/8f36a857ddd9bf051079085dd732b517
    
    public function saveTasks(Request $request){
       $ids = $request->all(); // gets (id of day of the week) , (all selected users) , (button) and (token)
      //dd($ids);
        $employee = new Employee;
        $employee->name = $request->input('name');
        $employee->note = $request->input('note');
        $employee->save();
        return response()->json(['success'=>'change working']);
    }




        
        public function aanpassenTaak(Request $request){
            $id = $request->input('id');
            $cell = Cell::where('id', '=', $id)->first();
            $cell->task_id = $request->input('task_id');
            $cell->save();
            return response()->json(['success'=>'change working']);   
        }   


        public function toevoegenTaak(Request $request){

            $requests = $request->all();
            $task_name = $request->input('task_name');
            $task = new Task;
            $task->name = $task_name;
            $task->save();
            return view('pages.toevoegen'); 
        }

        public function toevoegenPersoneel(Request $request){

            $requests = $request->all();
            $employee_name = $request->input('employee_name');
            $employee = new Employee;
            $employee->name = $employee_name;
            $employee->save();
            return view('pages.toevoegen'); 
        }

            
        public function toevoegen(){
            return view('pages.toevoegen');
        }



        public function startTimeStart(Request $request){
            date_default_timezone_set('Europe/Brussels');
            $ldate = new DateTime();
            $date = $ldate->format('Y-m-d');
            $timestamp = $ldate->format('H:i:s');
            //dd($timestamp);
            $requests = $request->all();
            $user_id = $request->input('user_id');

            $timetracking = new Timetracking;

            $timetracking->user_id = $user_id;
            
            $timetracking->start_date = $date;
            $timetracking->start_time = $timestamp;
            $timetracking->startStop_status = "start";

            $timetracking->save();  
            return view('pages.tijdsregistratie.overzicht');       
        }      


        public function timetracker_stop(Request $request){
            date_default_timezone_set('Europe/Brussels');
            $ldate = new DateTime();
            $stop_date = $ldate->format('Y-m-d');
            $stop_time = $ldate->format('H:i:s');

            $lastrecord = DB::table('timetracking')
                ->where('user_id', '=', $request->input('user_id'))
                ->where('startStop_status', '=', 'start')
                ->orderBy('id','desc')
                ->first();

                $ts1 = strtotime($lastrecord->start_time);
                $ts2 = strtotime($stop_time);     
                $seconds_diff = $ts2 - $ts1;     


                $totalTime =   gmdate('H:i:s',$seconds_diff);                     
                //dd( $totalTime );
/*
                $hours = round((($seconds_diff % 604800) % 86400) / 3600); 
                $minutes = round(((($seconds_diff % 604800) % 86400) % 3600) / 60); 
                $sec = round((((($seconds_diff % 604800) % 86400) % 3600) % 60));

                $total = ($hours . ':' . $minutes . ':' . $sec);
*/
            $lastrecord = DB::table('timetracking')
                ->where('user_id', '=', $request->input('user_id'))
                ->where('startStop_status', '=', 'start')
                ->orderBy('id','desc')
                ->take(1)
                ->update([
                    'stop_date' => $stop_date,
                    'stop_time' => $stop_time,
                    'startStop_status' => 'stop',
                    'total_time' => $totalTime
                ]);  

                return view('pages.tijdsregistratie.overzicht');     


            //dd($lastrecord);  
        }

        
        public function overzichtBewoners(){
            $clients =  Client::all();
            //dd($clients);
            $employees = Employee::all();
            $floors = Floor::all();
            return view('pages.overzichtBewoners')
            ->with('floors',$floors)
            ->with('employees',$employees)
            ->with('clients',$clients);
        }

        public function aanwezigheidslijst(){
            $employees = Employee::all();

             return view('pages.aanwezigheidslijst')
            ->with('employees',$employees);

        }

        public function notities(){

            $employees = Employee::all();

            return view('pages.notities')
            ->with('employees',$employees);

        }

        
        public function aanpassenVerantwoordelijkeOrganisatie(Request $request){
            $id = $request->input('id');
            $cell = Cell::where('id', '=', $id)->first();
            $cell->category_id = $request->input('category_id');
            $cell->save();
            return response()->json(['success'=>'change working']);   
        }

       
        public function taakCompleet(Request $request){
            $id = $request->input('id');
            $cell = Cell::where('id', '=', $id)->first();
            $cell->task_done = $request->input('task_done');
            $cell->save();
            return response()->json(['success'=>'change working']);   
        } 

        
        public function bewerkenDagplanning(Request $request){
            $ids = $request->all(); // gets (id of day of the week) , (all selected users) , (button) and (token)
  $employees = Employee::all();
            $day = $request->get('dayOfTheWeek');

            $client_ids = $request->except('dayOfTheWeek','button','_token');
            //$client_ids = [1,2];
            $tasks = Task::all();
            $clients = Client::find($client_ids);
            //dd($client_ids);
            $cells = Cell::with('task')->with('category')->whereIn('client_id', $client_ids)->where('table_id', $day)->get();
            $cellsGroupedByClient = $cells->groupBy('client_id');
            $categories = Category::all();
            $time = array('hours' => ['6:00','6:15','6:30','6:45','7:00','7:15','7:30','7:45','8:00','8:15','8:30','8:45','9:00','9:15','9:30','9:45','10:00','10:15','10:30','10:45','11:00','11:15','11:30','11:45','12:00','12:15','12:30','12:45','13:00','13:15','13:30','13:45','14:00','14:15','14:30','14:45','15:00','15:15','15:30','15:45','16:00','16:15','16:30','16:45','17:00','17:15','17:30','17:45','18:00','18:15','18:30','18:45','19:00','19:15','19:30','19:45','20:00','20:15','20:30','20:45','21:00','21:15','21:30','21:45','22:00','22:15','22:30','22:45','23:00','23:15','23:30','23:45']);

            return view('pages.bewerkenDagplanning')
            ->with('employees',$employees)
            ->with('clients',$clients)
            //->with('cells',$cells)
            ->with('cellsGroupedByClient',$cellsGroupedByClient)
            ->with($time)
            ->with('tasks',$tasks)
            ->with('categories',$categories)
            ->with('day',$day);
        }

        //replace
        public function overzichtDagplanning(Request $request){
            $ids = $request->all(); // gets (id of day of the week) , (all selected users) , (button) and (token)
            //dd($ids);
            $day = $request->get('dayOfTheWeek');
            //dd($ids);
            $client_ids = $request->except('dayOfTheWeek','button','_token');

            $clients = Client::find($client_ids);
            //dd($client_ids);
            $cells = Cell::with('task')->with('category')->whereIn('client_id', $client_ids)->where('table_id', $day)->get();
            $cellsGroupedByClient = $cells->groupBy('client_id');

            $time = array('hours' => ['6:00','6:15','6:30','6:45','7:00','7:15','7:30','7:45','8:00','8:15','8:30','8:45','9:00','9:15','9:30','9:45','10:00','10:15','10:30','10:45','11:00','11:15','11:30','11:45','12:00','12:15','12:30','12:45','13:00','13:15','13:30','13:45','14:00','14:15','14:30','14:45','15:00','15:15','15:30','15:45','16:00','16:15','16:30','16:45','17:00','17:15','17:30','17:45','18:00','18:15','18:30','18:45','19:00','19:15','19:30','19:45','20:00','20:15','20:30','20:45','21:00','21:15','21:30','21:45','22:00','22:15','22:30','22:45','23:00','23:15','23:30','23:45']);

            $employees = Employee::all();

            return view('pages.overzichtDagplanning')
            ->with('clients',$clients)
            //->with('cells',$cells)
            ->with('cellsGroupedByClient',$cellsGroupedByClient)
            ->with($time)
            ->with('employees',$employees)
            ->with('day',$day);
        }

        public function bewonersAanwezig(Request $request){
            
        }

        public function personeelAanwezig(){
            $employees = Employee::all();
            //dd($employees);
            return view('pages.overzichtPersoneel')
            ->with('employees',$employees);
       
        }


}
            
         
            