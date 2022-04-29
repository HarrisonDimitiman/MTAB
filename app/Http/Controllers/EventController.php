<?php

namespace App\Http\Controllers;

use App\Models\{Event,Program};
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use PDF;
use URL;
use Illuminate\Support\Facades\Redirect;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $programs_id)
    {
        $event = Event::join('programs','programs.id','events.programs_id')
            ->select('events.*')
            ->where('events.programs_id',$programs_id)->get();
        $prgm = Program::where('id', $programs_id)->first();
        return view('event.index',compact('event', 'programs_id', 'prgm'));
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
        $validated = $request->validate([
            'event_name' => 'required|unique:events',
        ]);
        $event=new Event();
        $event->event_name = $request->event_name;
        $event->programs_id = $request->programs_id;
        $event->save();

        return redirect()->back()->with('success','Successfully Created Event');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event, $events_id)
    {
        $getEvents = Event::where('id', $events_id)->first();
        return view('event._modal',compact('getEvents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event, $events_id)
    {
        $validatedData = $request->validate([
            'event_name' => '',
        ]);
        $getEvents = Event::where('id', $events_id)->first();
        $upEvents = array();
        $upEvents['event_name'] = $request->event_name;
        DB::table('events')->where('id', $events_id)->update($upEvents);

        return redirect()->back()->with('success','Successfully Updated Event');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */

    public function destroy(Event $events, $events_id, $programs_id)
    {
        DB::table('events')->where('id', $events_id)->update(['deleted_at' => Carbon::now()]);
        // $events->delete();
        // dd($programs_id);
        return Redirect::to('/event/'.$programs_id)
            ->with('message','Event deleted successfully. <a href="'.URL::to('/eventRestore/'.$events_id.'/'.$programs_id).'">Whoops, Undo</a>');
    }

    public function restore(int $id, int $programs_id)
    {
        // dd($id);
        $event = Event::withTrashed()->find($id);
        if($event && $event->trashed()){
            $event->restore();    
        }
        return Redirect::to('/event/'.$programs_id)->with('message','Event restored succesfully');        
    }
    public function ResultbyEvent()
    {
        $pdf=PDF::loadView('pdf.ResultbyEvent');
        return $pdf->stream('ResultbyEvent.pdf'); 
    }
}
