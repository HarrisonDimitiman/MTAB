<?php

namespace App\Http\Controllers;

use App\Models\{Semi, Score, Contestant, Event, User};
use Illuminate\Http\Request;
use DB;

class SemiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('semi.index');
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
            for($i = 1; $i <= $getContestantToArray2ndLength; $i++)
            {
                for($j = 1; $j <= $getUserJudge2ndLength; $j++)
                {
                    $checkContestanIfJudge = DB::table('scores')
                        ->where('contestant_id', $getContestantToArray2nd[$i]['id'])
                        ->where('user_id', $getUserJudge2nd[$j]['id'])
                        ->where('overAllTotal', '!=', 0)
                        ->get()->keyBy('user_id');

                    // TO BE CONTINUE
                    return $checkContestanIfJudge->overAllTotal;

                }
            }
        }
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
