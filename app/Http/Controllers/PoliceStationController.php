<?php

namespace App\Http\Controllers;

use App\Models\PoliceStation;
use App\Models\District;
use Illuminate\Http\Request;

class PoliceStationController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $term = $request->term;
        $district_name = $request->district_name;

        $policestations = PoliceStation::
        where(function($query) use ($term, $district_name){
            if($term){
                $query->where('name','like',"%$term%")
                ->orWhere('name_en','like',"%$term%")
                ;
            }else if($district_name){
                $query->whereHas('district', function ($query) use ($district_name) {

                        $query->where('districts.name', 'like', "%$district_name%")
                        ->orWhere('districts.name_en', 'like', "%$district_name%");


                        ;
                });
            }
        })
        ->orderBy("name")->paginate();

        $policestations->appends($request->all());

        return view('police_stations.index', compact('policestations','term','district_name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $districts = District::pluck('name', 'id')->prepend('Please Select...', null);

        return view('police_stations.create',compact('districts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'district_id' => 'required',
        ]);

        $district = District::find($request->district_id);

        $request->validate(['name'=>Rule::unique('police_stations')->where(function ($query) use ($district, $request) {
            return $query->where('name', $request->name)
            ->where('district_id', $district->id);
        })]);

      PoliceStation::create($request->all());

        return redirect()->route('policestations.index')->withMessage('Police Station Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PoliceStation $policeStation)
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
        $districts = District::pluck('name', 'id')->prepend('Please Select...', null);
      

        $policestation = PoliceStation::find($id);

        return view('police_stations.edit', compact('policestation', 'districts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PoliceStation $policestation)
    {
        $request->validate([
            'name' => 'required',

            'district_id' => 'required',
        ] );

        $district = District::find($request->district_id);

        $request->validate(['name'=>Rule::unique('police_stations')->where(function ($query) use ($district,$policestation, $request) {
            return $query->where('name', $request->name)
            ->where('district_id', $district->id)
            ->where('name','!=', $policestation->name);
        })]);

        $policestation->update($request->all());

        return redirect()->route('policestations.index')->withMessage('district Updated!');
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
}
