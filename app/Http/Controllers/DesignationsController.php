<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\Designations;


class DesignationsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $designations = DB::table('designation')->orderBy('created_at', 'desc')->paginate(10);
        return view('designation.designation-list', ['designations' => $designations]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('designation.designation-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input     = $request->all();
        $today     = Carbon::now();

        $validatedData = $request->validate([
            'designationName'      => 'required',
        ]);
        $designations             = new Designations;
        $designations->name       = $input['designationName'];
        $designations->created_at = $today;
        $designations->updated_at = $today;
        $designations->save();
        return response()->json(['status'=>'success']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $designation = DB::table('designation')->find($id);
        return view('designation.designation-edit')->with([ 'designation' => $designation ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $input   = $request->all();
        $today   = Carbon::now();

        $validatedData = $request->validate([
            'designationName'      => 'required',
        ]);
        $aUpdate     =  [];
        $id          = $input['id'];
        $aUpdate     = [
            'name'       =>  $input['designationName'],
            'updated_at' =>  $today
        ];

        $designation = DB::table('designation')
            ->where('id', $id)
            ->update($aUpdate);
        return response()->json(['status'=>'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $designations = Designations::find( $id )->delete();
        return redirect()->back();
    }
}
