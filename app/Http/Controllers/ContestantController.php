<?php

namespace App\Http\Controllers;

use App\Models\{Contestant, Criteria, Event};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Image;

class ContestantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contestant = Contestant::get(); 
        return view('contestant.index',compact('contestant'));
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
            'name' => 'required',
            'age' => 'required',
            'location' => 'required',
            'vital_stat' => 'required',
            'weight' => 'required',
            'height' => 'required',
            'birthdate' => 'required',
            'number' => 'required',
            'educational' => 'required',
        ]);
        $contestant=new Contestant();
        $contestant->name=$request->name;
        $contestant->age=$request->age;
        $contestant->location=$request->location;
        $contestant->vital_stat=$request->vital_stat;
        $contestant->weight=$request->weight;
        $contestant->height=$request->height;
        $contestant->birthdate=$request->birthdate;
        $contestant->number=$request->number;
        $contestant->educational=$request->educational;
        if( $request->file('image') != null){
            $picture = $request->file('image');
            $fileName = time() . '.' . $picture->getClientOriginalExtension();
            $img = Image::make($picture->getRealPath());
            $img->stream();
            $url = Storage::disk('public')->put('uploads/contestant', $picture);
            $contestant->image = $url;  
        }
        $contestant->save();
        return redirect()->back()->with('success','Successfully Created Contestant!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contestant  $contestant
     * @return \Illuminate\Http\Response
     */
    public function show(Contestant $contestant)
    {
        $criteria = array();
        $event = Event::get();
        return view('score._showScoring',compact('contestant', 'criteria', 'event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contestant  $contestant
     * @return \Illuminate\Http\Response
     */
    public function edit(Contestant $contestant)
    {
        return view('contestant._modal',compact('contestant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contestant  $contestant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contestant $contestant)
    {
        $validatedData = $request->validate([
            'name' => '',
            'age' => '',
            'location' => '',
            'vital_stat' => '',
            'weight' => '',
            'height' => '',
            'birthdate' => '',
            'number' => '',
            'educational' => '',
        ]);

        $contestant = $contestant->update($validatedData);
        return redirect()->back()->with('success','Successfully Updated Contestant!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contestant  $contestant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contestant $contestant)
    {
        $contestant->delete();
        return redirect()->route('contestant.index')
            ->with('message','Contestant deleted successfully. <a href="'.route('contestant.restore',$contestant->id).'">Whoops, Undo</a>');
    }
    public function restore(int $id)
    {
        $contestant = Contestant::withTrashed()->find($id);
        if($contestant && $contestant->trashed()){
            $contestant->restore();    
        }
        return redirect()->route('contestant.index')->with('message','Contestant restored succesfully');        
    }
}
