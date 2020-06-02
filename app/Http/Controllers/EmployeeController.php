<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Role;
use App\Status;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employee', ['roles' => Role::all(), 'employees' => Employee::where('role_id', 1)->where('status_id', 1)->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    public function ajax_add(Request $request) {
//        dd($request->all());
        $employee = new Employee($request->all());
        $employee->role_id = $request->role_id;
        $employee->save();
        $view = view('tr', ['employee' => $employee, 'statuses' => Status::all()])->render();
        $statuses = Status::all();

//        $select = '<select class="browser-default custom-select slc" name="role_id">';
//
//            if ($employee->status_id == 1){
//                $select .= '<option value="'. $employee->id .'" data-id="'. $status->id .'"></option>';
//            }
//            else{
//
//            }



        return response()->json([
            'html_data' => $view,
        ]);

    }
    public function change_tab(Request $request) {
        $id = $request->role_id;
        $managers = Employee::where('role_id', $request->role_id)->where('status_id', 1)->get();
        $employees = Employee::where('role_id', $request->role_id)->where('status_id', 1)->get();
        $interns = Employee::where('role_id', $request->role_id)->where('status_id', 1)->get();
        $inactive = Employee::where('status_id', 2)->get();

        if ($id == 1){
            $view = view('role', ['employees' => $managers, 'statuses' => Status::all()])->render();
        }else if($id == 2){
            $view = view('role', ['employees' => $employees, 'statuses' => Status::all()])->render();
        }else if($id == 3){
            $view = view('role', ['employees' => $interns, 'statuses' => Status::all()])->render();
        }else if ($id == 4) {
            $view = view('inactive', ['employees' => $inactive, 'statuses' => Status::all()])->render();
        }
        return response()->json([
            'view' => $view,
        ]);
    }

    public function change_option(Request $request) {
//        dd($request);

        $employee = Employee::find($request->id);
        if ($request->status_id){
            $employee->status_id = $request->status_id;
            $employee->save();
        }

//        $view = view('role')->render();

//        return response()->json()([
//            'view' => $view,
//        ]);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {

    }
}
