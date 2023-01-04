<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\Designations;
use App\Models\Employee;

class EmployeeController extends Controller
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
        $employees = Employee::with('designations')
            ->orderBy('employee.created_at', 'desc')
            ->paginate(10);
        return view('employee.employee-list', ['employees' => $employees]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $designations   = Designations::all('id', 'name');
        return view('employee.employee-add',["designations" => $designations]);
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
            'firstName'   => 'required',
            'jod'         => 'required',
            'dob'         => 'required',
            'gender'      => 'required',
            'designationName' => 'required',
            'mob'         => 'required',
            'email'       => 'required',
            'profile_input_image'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);

        //insert new Profile
        if ($resFiles = $request->file('resume')) {
            $destinationResumePath = 'resume/'; 
            $resume    = time()."-".$request->firstName.".".$resFiles->getClientOriginalExtension();
           $resFiles->move($destinationResumePath, $resume);
        }else{
            $resume = NULL;
        }

        //insert new Profile
        if ($files = $request->file('profile_input_image')) {
            $destinationProfilePath = 'images/'; 
            $profileImage    = time()."-".$request->firstName.".".$files->getClientOriginalExtension();
           $files->move($destinationProfilePath, $profileImage);
        }else{
            $profileImage = NULL;
        }

        $employee                = new Employee;
        $employee->first_name    = $input['firstName'];
        $employee->last_name     = $input['lastName'];
        $employee->joining_date  = $input['jod'];
        $employee->dob           = $input['dob'];
        $employee->designation_id= $input['designationName'];
        $employee->gender        = $input['gender'];
        $employee->mobile        = $input['mob'];
        $employee->phone         = $input['phone'];
        $employee->email         = $input['email'];
        $employee->present_address = $input['permanentAddress'];
        $employee->same_address  = $input['adress_same'];
        $employee->permenant_address = $input['presentAddress'];
        $employee->status        = $input['status'];
        $employee->image         = $profileImage;
        $employee->resume        = $resume;
        $employee->created_at    = $today;
        $employee->updated_at    = $today;
        $employee->save();
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
        $designations   = Designations::all('id', 'name');
        $employee = DB::table('employee')
            ->where('id', '=', $id )
            ->get();
        return view('employee.employee-edit',["employee" =>$employee[0],"designations" => $designations]);
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
            'firstName'   => 'required',
            'jod'         => 'required',
            'dob'         => 'required',
            'gender'      => 'required',
            'designationName' => 'required',
            'mob'         => 'required',
            'email'       => 'required',
            'profile_input_image'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);

    
        $aUpdate     =  [];
        $id          = $input['id'];
        $aUpdate     = [
            'first_name'          =>  $input['firstName'],
            'last_name'           =>  $input['lastName'],
            'joining_date'        =>  $input['jod'],
            'dob'                 =>  $input['dob'],
            'designation_id'      =>  $input['designationName'],
            'gender'              =>  $input['gender'],
            'mobile'              =>  $input['mob'],
            'phone'               =>  $input['phone'],
            'email'               =>  $input['email'],
            'present_address'     =>  $input['permanentAddress'],
            'same_address'        =>  $input['adress_same'],
            'permenant_address'   =>  $input['presentAddress'],
            'status'              =>  $input['status'],
            'updated_at'          =>  $today,
        ];

        //insert new Profile
        if ($resFiles = $request->file('resume')) {
            $destinationResumePath = 'resume/'; 
            $resume    = time()."-".$request->firstName.".".$resFiles->getClientOriginalExtension();
            $resFiles->move($destinationResumePath, $resume);
            $aUpdate['resume']  = $resume;
        }

        //insert new Profile
        if ($files = $request->file('profile_input_image')) {
            $destinationProfilePath = 'images/'; 
            $profileImage    = time()."-".$request->firstName.".".$files->getClientOriginalExtension();
           $files->move($destinationProfilePath, $profileImage);
            $aUpdate['image']  = $profileImage;

        }

        $employee = DB::table('employee')
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
        $employee = Employee::find( $id )->delete();
        return redirect()->back();
    }
}
