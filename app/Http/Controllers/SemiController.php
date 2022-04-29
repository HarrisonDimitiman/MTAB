<?php

namespace App\Http\Controllers;

use App\Models\{Semi, Score, Contestant, Event, User, SemiScore};
use Illuminate\Http\Request;
use DB;
use Auth;

class SemiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getContestantOverAllTotalJudge = Score::join('contestants','contestants.id','scores.contestant_id')
                                                ->orderBy('overAllTotalJudge', 'DESC')
                                                ->where('overAllTotalJudge', '!=', null)
                                                ->get()
                                                ->keyBy('contestant_id')->take(6);
        // return $getContestantOverAllTotalJudge;
        return view('semi.index', compact('getContestantOverAllTotalJudge'));
    }

    public function generateTop6()
    {
        $getEvent = Event::get();
        // $getContestant = Contestant::get();
        // $getContestantCount = $getContestant->count();

        $getContestantToArray = Contestant::get();
        $getContestantToArray = $getContestantToArray->toArray();

        $getContestantToArray2nd = $getContestantToArray;
        array_unshift($getContestantToArray2nd,"");
        unset($getContestantToArray2nd[0]);
        $getContestantToArray2ndLength = count($getContestantToArray2nd);

        $getUserJudge = User::whereHas(
            'roles', function($q){
                $q->where('name', 'judge');
            }
        )->get()->toArray();
        // $getUserJudgeCount = $getUserJudge->count();
        
        $getUserJudge2nd = $getUserJudge;
        array_unshift($getUserJudge2nd,"");
        unset($getUserJudge2nd[0]);
        $getUserJudge2ndLength = count($getUserJudge2nd);

        $getEventToArray = Event::get();
        $getEventToArray = $getEventToArray->toArray();

        $getEvent2nd = $getEventToArray;
        array_unshift($getEvent2nd,"");
        unset($getEvent2nd[0]);
        $getEventLength = count($getEvent2nd);

        $tempChecker = 0;
        for($i = 1; $i <= $getContestantToArray2ndLength; $i++)
        {
            for($j = 1; $j <= $getUserJudge2ndLength; $j++)
            {
                $checkContestanIfJudge = DB::table('scores')
                    ->where('contestant_id', $getContestantToArray2nd[$i]['id'])
                    ->where('user_id', $getUserJudge2nd[$j]['id'])
                    ->where('overAllTotal', '!=', 0)
                    ->get()->keyBy('user_id');

                if($checkContestanIfJudge->count() <= 0)
                {
                    $tempChecker = $tempChecker + 1;
                }
                else
                {
                    $tempChecker;
                }

            }
        }



        if($tempChecker != 0)
        {
            return "WALA PA KA SCORE TANAN JUDGE SA CONSTESTANT";
        }
        elseif($tempChecker == 0)
        {
            $dataArrayNi = array();
            for($x = 1; $x <= $getEventLength; $x++)
            {
                for($i = 1; $i <= $getContestantToArray2ndLength; $i++)
                {
                    $overAllTotalContestantPerJudge = 0;
                    for($j = 1; $j <= $getUserJudge2ndLength; $j++)
                    {
                        $checkContestanIfJudge = DB::table('scores')
                            ->where('contestant_id', $getContestantToArray2nd[$i]['id'])
                            ->where('user_id', $getUserJudge2nd[$j]['id'])
                            ->where('event_id', $getEvent2nd[$x]['id'])
                            ->get()->keyBy('event_id');

                        $overAllTotalContestantPerJudge = $overAllTotalContestantPerJudge + $checkContestanIfJudge[$x]->total;
                        if($j == $getUserJudge2ndLength)
                        {
                            $overAllTotalContestantPerJudge = $overAllTotalContestantPerJudge / $getUserJudge2ndLength;
                            $overAllTotalContestantPerJudge = round($overAllTotalContestantPerJudge, 2);

                            // $dataArrayNi['percentagePerEvent'] = $overAllTotalContestantPerJudge;
                            // $dataArrayNi['percentageContestantPerEvent'] = $getContestantToArray2nd[$i]['id'];
                            

                            $getScoresPlease = DB::table('scores')
                                ->where('contestant_id', $getContestantToArray2nd[$i]['id'])
                                ->first();
                            // echo "<pre>";
                            //     print_r($getScoresPlease->overAllTotalJudge);
                            // echo "</pre>";
                            $data2 = array();
                            $data2['overAllTotalJudge'] = $overAllTotalContestantPerJudge + $getScoresPlease->overAllTotalJudge;
                            Score::query()
                                ->where('contestant_id', $getContestantToArray2nd[$i]['id'])
                                ->update($data2);   
                            
                            
                        }
                        
                    }

                    
                    
                }
            }
            
                
        }

        // $getContestantOverAllTotalJudge = Score::join('contestants','contestants.id','scores.contestant_id')
        //                                         ->orderBy('overAllTotalJudge', 'DESC')
        //                                         ->where('overAllTotalJudge', '!=', null)
        //                                         ->get()
        //                                         ->keyBy('overAllTotalJudge')->take(7);
        // return $getContestantOverAllTotalJudge;
        return redirect()->back()->with('success','Successfully Generate Top 6!');
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
    public function indexSemi()
    {
        $semi = Semi::get(); 
        return view('semi.indexSemi',compact('semi'));
    }
    public function storeSemi(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'semi_percentage' => 'required',
        ]);

        Semi::create($validated);
        return redirect()->back()->with('success','Successfully Created Semi Criteria!');
    }
    public function editSemi(Semi $semi, $semi_id)
    {
        $firstSemi = Semi::where('id', $semi_id)->first();
        return view('semi._modalSemi',compact('firstSemi'));
    }
    public function updateSemi(Request $request, Semi $semi, $semi_id)
    {
        $data = array();
        $data['name'] = $request->name;
        $data['semi_percentage'] = $request->semi_percentage;

        DB::table('semis')->where('id', $semi_id)->update($data);
        return redirect()->back()->with('success','Successfully Updated Semi Criteria!');
    }
    public function destroySemi(Semi $semi, $semi_id)
    {
        DB::table('semis')->where('id', $semi_id)->delete();
        return redirect()->back()->with('error','Semi Criteria succesfully deleted!!');  
    }

    public function showContestant($contestant_id)
    {
        $firstContestant = Contestant::where('id', $contestant_id)->first();
        $getSemiCrits = Semi::get();
        return view('semi._showSemiScoring', compact('firstContestant', 'getSemiCrits'));
    }
    
    public function addScoreContestantSemi($contestant_id, Request $request)
    {
        $semi_crt_id = $request->input('semi_crits_id');
        array_unshift($semi_crt_id,"");
        unset($semi_crt_id[0]);
        $semi_crt_Length = count($semi_crt_id);

        $score = $request->input('score');
        array_unshift($score,"");
        unset($score[0]);
        $scoreLength = count($score);
        $scoreSum = array_sum($score);

        $ifAlreadyScore = SemiScore::where('contestant_id', $contestant_id)
            ->where('user_id', Auth::user()->id)
            ->count();

        // $getEventPercentage = Event::where('id', $event_id)->first();
        // $totalEvent = $scoreSum * $getEventPercentage->percentage; 
        
        for($i = 1; $i <= $semi_crt_Length; $i++)
        {
            $data = array();
            $data['user_id'] = Auth::user()->id;
            $data['semi_id'] = $semi_crt_id[$i];
            $data['contestant_id'] = $contestant_id;
            $data['total'] = $scoreSum;
            $data['overAllTotal'] = 0;
            $data['score'] = $score[$i];

            DB::table('semi_scores')
                ->insert($data);
        }

        return redirect()->back()->with('success','Successfull');
    }
    

    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Semi  $semi
     * @return \Illuminate\Http\Response
     */
    public function show(Semi $semi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Semi  $semi
     * @return \Illuminate\Http\Response
     */
    public function edit(Semi $semi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Semi  $semi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Semi $semi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Semi  $semi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Semi $semi)
    {
        //
    }
}
