<?php

namespace App\Http\Controllers;

use App\Models\{Terminal, SemiScore, User, Score, Contestant, TerminalScore};
use Illuminate\Http\Request;
use DB;
use Auth;

class TerminalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexTerm()
    {
        $getContestantOverAllTotalJudge = SemiScore::join('contestants','contestants.id','semi_scores.contestant_id')
                                                ->orderBy('overAllTotalJudge', 'DESC')
                                                ->where('overAllTotalJudge', '!=', 0)
                                                ->get()
                                                ->keyBy('contestant_id')->take(3);
        return view('terminal.index', compact('getContestantOverAllTotalJudge'));
    }

    public function generateTop3()
    {
        // $getContestant = SemiScore::get()->keyBy('contestant_id');

        $getContestant = SemiScore::join('contestants','contestants.id','semi_scores.contestant_id')
                                                ->orderBy('total', 'DESC')
                                                ->get()
                                                ->keyBy('contestant_id');
        $getContestant = $getContestant->toArray();

        $getContestantToArray2nd = $getContestant;
        array_unshift($getContestantToArray2nd,"");
        unset($getContestantToArray2nd[0]);
        $getContestantToArray2ndLength = count($getContestantToArray2nd);

        $getUserJudge = User::whereHas(
            'roles', function($q){
                $q->where('name', 'judge');
            }
        )->get()->toArray();

        $getUserJudge2nd = $getUserJudge;
        array_unshift($getUserJudge2nd,"");
        unset($getUserJudge2nd[0]);
        $getUserJudge2ndLength = count($getUserJudge2nd);

        $tempChecker = 0;
        for($i = 1; $i <= $getContestantToArray2ndLength; $i++)
        {
            for($j = 1; $j <= $getUserJudge2ndLength; $j++)
            {
                $checkContestanIfJudge = DB::table('semi_scores')
                    ->where('contestant_id', $getContestantToArray2nd[$i]['contestant_id'])
                    ->where('user_id', $getUserJudge2nd[$j]['id'])
                    ->get()->keyBy('user_id');

                if($checkContestanIfJudge->count() <= 0)
                {
                    $tempChecker = $tempChecker + 1;
                }
                else
                {
                    $tempChecker;
                }
                
                // echo "<pre>";
                //     print_r($getContestantToArray2nd[$i]['contestant_id']);
                // echo "</pre>";
            }
        }
        // return $tempChecker;

        // return $tempChecker;
        if($tempChecker != 0)
        {
            return "WALA PA KA SCORE TANAN JUDGE SA CONSTESTANT";
        }
        elseif($tempChecker == 0)
        {
            for($i = 1; $i <= $getContestantToArray2ndLength; $i++)
            {
                $overAllTotalContestantPerJudge = 0;
                for($j = 1; $j <= $getUserJudge2ndLength; $j++)
                {
                    $checkContestanIfJudge = DB::table('semi_scores')
                        ->where('contestant_id', $getContestantToArray2nd[$i]['contestant_id'])
                        ->where('user_id', $getUserJudge2nd[$j]['id'])
                        ->get()->keyBy('user_id');   

                    $overAllTotalContestantPerJudge = $overAllTotalContestantPerJudge + $checkContestanIfJudge[$j+1]->total;
                    if($j == $getUserJudge2ndLength)
                    {

                        $overAllTotalContestantPerJudge = $overAllTotalContestantPerJudge / $getUserJudge2ndLength;
                        $overAllTotalContestantPerJudge = round($overAllTotalContestantPerJudge, 2);
                        // echo "<pre>";
                        //     print_r($getContestantToArray2nd[$i]['id']);
                        // echo "</pre>";
                        $data2 = array();
                        $data2['overAllTotalJudge'] = $overAllTotalContestantPerJudge;
                        SemiScore::query()
                            ->where('contestant_id', $getContestantToArray2nd[$i]['id'])
                            ->update($data2);   
                    }
                }
            }
        }

        // $getContestantOverAllTotalJudge  = SemiScore::join('contestants','contestants.id','semi_scores.contestant_id')
        //                                         ->orderBy('overAllTotalJudge', 'DESC')
        //                                         ->get()
        //                                         ->keyBy('contestant_id')->take(3);
        return redirect()->back()->with('success','Successfully Generate Top 3!');
    }

    public function finalCriteria()
    {
        $getTerminalCrit = Terminal::get();
        return view('final.index', compact('getTerminalCrit'));
    }

    public function storeFinal(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'term_percentage' => 'required',
        ]);

        Terminal::create($validated);
        return redirect()->back()->with('success','Successfully Created Final Criteria!');
    }

    public function editFinal($final_id)
    {
        $firstTerminal = Terminal::where('id', $final_id)->first();
        return view('terminal._modalFinalTerm',compact('firstTerminal'));
    }

    public function updateTerm(Request $request, $final_id)
    {
        $data = array();
        $data['name'] = $request->name;
        $data['term_percentage'] = $request->term_percentage;

        DB::table('terminals')->where('id', $final_id)->update($data);
        return redirect()->back()->with('success','Successfully Updated Semi Criteria!');
    }


    public function showFinalContestant($contestant_id)
    {
        $firstContestant = Contestant::where('id', $contestant_id)->first();
        $getFinalCrits = Terminal::get();
        return view('terminal._showFinalScoring', compact('firstContestant', 'getFinalCrits'));
    }

    public function destroyFinalCrits($final_id)
    {
        DB::table('terminals')->where('id', $final_id)->delete();
        return redirect()->back()->with('error','Final Criteria succesfully deleted!!');  
    }

    public function addScoreContestantFinal($contestant_id, Request $request)
    {
        $final_crt_id = $request->input('final_crits_id');
        array_unshift($final_crt_id,"");
        unset($final_crt_id[0]);
        $final_crt_Length = count($final_crt_id);

        $score = $request->input('score');
        array_unshift($score,"");
        unset($score[0]);
        $scoreLength = count($score);
        $scoreSum = array_sum($score);

        $ifAlreadyScore = TerminalScore::where('contestant_id', $contestant_id)
            ->where('user_id', Auth::user()->id)
            ->count();

        // $getEventPercentage = Event::where('id', $event_id)->first();
        // $totalEvent = $scoreSum * $getEventPercentage->percentage; 
        
        for($i = 1; $i <= $final_crt_Length; $i++)
        {
            $data = array();
            $data['user_id'] = Auth::user()->id;
            $data['term_id'] = $final_crt_id[$i];
            $data['contestant_id'] = $contestant_id;
            $data['total'] = $scoreSum;
            $data['overAllTotal'] = 0;
            $data['score'] = $score[$i];

            DB::table('terminal_scores')
                ->insert($data);
        }

        return redirect()->back()->with('success','Successfull');
    }

    public function finalRound()
    {
        $getContestantOverAllTotalJudge = TerminalScore::join('contestants','contestants.id','terminal_scores.contestant_id')
                                                ->orderBy('overAllTotalJudge', 'DESC')
                                                ->where('overAllTotalJudge', '!=', null)
                                                ->get()
                                                ->keyBy('contestant_id')->take(3);
                                                
        // return $getContestantOverAllTotalJudge;
        return view('final.index2nd', compact('getContestantOverAllTotalJudge'));
    }

    public function generateFinal()
    {
        $getContestant = TerminalScore::join('contestants','contestants.id','terminal_scores.contestant_id')
                                                ->orderBy('overAllTotalJudge', 'DESC')
                                                ->get()
                                                ->keyBy('contestant_id')->take(3);
        $getContestant = $getContestant->toArray();

        $getContestantToArray2nd = $getContestant;
        array_unshift($getContestantToArray2nd,"");
        unset($getContestantToArray2nd[0]);
        $getContestantToArray2ndLength = count($getContestantToArray2nd);

        $getUserJudge = User::whereHas(
            'roles', function($q){
                $q->where('name', 'judge');
            }
        )->get()->toArray();

        $getUserJudge2nd = $getUserJudge;
        array_unshift($getUserJudge2nd,"");
        unset($getUserJudge2nd[0]);
        $getUserJudge2ndLength = count($getUserJudge2nd);

        $tempChecker = 0;
        for($i = 1; $i <= $getContestantToArray2ndLength; $i++)
        {
            for($j = 1; $j <= $getUserJudge2ndLength; $j++)
            {
                $checkContestanIfJudge = DB::table('terminal_scores')
                    ->where('contestant_id', $getContestantToArray2nd[$i]['contestant_id'])
                    ->where('user_id', $getUserJudge2nd[$j]['id'])
                    ->get()->keyBy('user_id');

                if($checkContestanIfJudge->count() <= 0)
                {
                    $tempChecker = $tempChecker + 1;
                }
                else
                {
                    $tempChecker;
                }
                
                // echo "<pre>";
                //     print_r($getContestantToArray2nd[$i]['contestant_id']);
                // echo "</pre>";
            }
        }
        // return $tempChecker;

        // return $tempChecker;
        if($tempChecker != 0)
        {
            return "WALA PA KA SCORE TANAN JUDGE SA CONSTESTANT";
        }
        elseif($tempChecker == 0)
        {
            for($i = 1; $i <= $getContestantToArray2ndLength; $i++)
            {
                $overAllTotalContestantPerJudge = 0;
                for($j = 1; $j <= $getUserJudge2ndLength; $j++)
                {
                    $checkContestanIfJudge = DB::table('terminal_scores')
                        ->where('contestant_id', $getContestantToArray2nd[$i]['contestant_id'])
                        ->where('user_id', $getUserJudge2nd[$j]['id'])
                        ->get()->keyBy('user_id');   

                    $overAllTotalContestantPerJudge = $overAllTotalContestantPerJudge + $checkContestanIfJudge[$j+1]->total;
                    
                    if($j == $getUserJudge2ndLength)
                    {
                       
                        $overAllTotalContestantPerJudge = $overAllTotalContestantPerJudge / $getUserJudge2ndLength;
                        $overAllTotalContestantPerJudge = round($overAllTotalContestantPerJudge, 2);
                        // echo "<pre>";
                        //     print_r($overAllTotalContestantPerJudge);
                        // echo "</pre>";
                        $data2 = array();
                        $data2['overAllTotalJudge'] = $overAllTotalContestantPerJudge;
                        TerminalScore::query()
                            ->where('contestant_id', $getContestantToArray2nd[$i]['id'])
                            ->update($data2);   
                    }
                }
            }
        }

        // $getContestantOverAllTotalJudge = TerminalScore::join('contestants','contestants.id','terminal_scores.contestant_id')
        //                                         ->orderBy('overAllTotalJudge', 'DESC')
        //                                         ->get()
        //                                         ->keyBy('contestant_id')->take(3);
        return redirect()->back()->with('success','Successfully Generate the FINALE!');
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
     * @param  \App\Models\Terminal  $terminal
     * @return \Illuminate\Http\Response
     */
    public function show(Terminal $terminal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Terminal  $terminal
     * @return \Illuminate\Http\Response
     */
    public function edit(Terminal $terminal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Terminal  $terminal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Terminal $terminal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Terminal  $terminal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Terminal $terminal)
    {
        //
    }
}
