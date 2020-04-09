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
use Illuminate\Support\Facades\Auth;

class TijdsRegistratieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 
        return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function tijdsregistratie_overzicht( ){
        //$userId = Auth::id();
        //dd ( $userId );
        $t = Timetracking::all()->toArray();
        $seconds = 0;
        foreach( $t as $tr){
             $ts2 = strtotime( $tr['total_time'] ); 
             $seconds += $ts2;
             /* 
                $hours = round((( $ts2 % 604800) % 86400) / 3600); 
                $minutes = round(((( $ts2 % 604800) % 86400) % 3600) / 60); 
                $sec = round((((( $ts2 % 604800) % 86400) % 3600) % 60));
*/
           // dd($tr['id']  );
        }
         $totalTime =   gmdate('H:i:s',$seconds);


        return view('pages.tijdsregistratie.overzicht')
         //->with('user_id', $userId)
        // ->with('count', $count)
         ;
    }

  

    public function timetracker_seperatePerDate(){
        $timesWorkedGroupedPerDayorted = self::groupRecordsPerDate();

        //$arrayWithOneDate =  $sorted[ array_keys($sorted)[2] ];


        $totalTimeWorkedPerDayCollection = [];

        // first element is zero, not sure for whatever reason this is 
        array_shift($timesWorkedGroupedPerDayorted);

        foreach ( $timesWorkedGroupedPerDayorted as $date => $singleRecord ){
            $totalTimeWorkedPerDay = self::calculateTotalTimePerDate($singleRecord);
            $totalTimeWorkedPerDayCollection[ $date ] = $totalTimeWorkedPerDay;
        }
        //dd($totalTimeWorkedPerDay );

        return view('pages.tijdsregistratie.totalWorkedPerDay')
        ->with('totalTimeWorkedPerDayCollection',$totalTimeWorkedPerDayCollection);
    }

    public function groupRecordsPerDate(){
        $t = Timetracking::all()->toArray();
        $templevel=0;   
        $newkey=0;
        $grouparr[$templevel]="";
        foreach ($t as $key => $val) {
            if ($templevel==$val['start_date']){
                $grouparr[$templevel][$newkey]=$val;
            } else {
                $grouparr[$val['start_date']][$newkey]=$val;
            }
            $newkey++;       
        }
        return $grouparr;
    } 

    public function calculateTotalTimePerDate($t){
        $seconds = 0;
        foreach( $t as $tr){
             $ts2 = strtotime( $tr['total_time'] ); 
             $seconds += $ts2;
             /* 
                $hours = round((( $ts2 % 604800) % 86400) / 3600); 
                $minutes = round(((( $ts2 % 604800) % 86400) % 3600) / 60); 
                $sec = round((((( $ts2 % 604800) % 86400) % 3600) % 60));
*/
           // dd($tr['id']  );
        }
         $totalTime =   gmdate('H:i:s',$seconds);  
         return $totalTime;      
    } 




}
