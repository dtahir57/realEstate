<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Task;
use App\Property;
use Auth;
use App\Company;
use Session;
use App\User;
use DB;
class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() {
      return $this->middleware('auth');
    }

    public function index()
    {
        if (auth::user()->hasRole('superuser') AND session('company_id')) {
          $properties = Property::where('company_id', session('company_id'))->get();
          $user = User::where('company_id', session('company_id'))->first();
          return view('companies/Tasks', compact('properties', 'user'));
        }
        $userId = Auth::user()->id;
        if (auth::user()->hasRole('superuser')) {
          $properties = Property::all();
          return view('Tasks', compact('properties'));
        } elseif (auth::user()->hasRole('admin')) {
          $company = User::find($userId);
          $properties = Property::where('company_id', $company->company_id)->get();
          return view('Tasks', compact('properties'));
        }elseif (auth::user()->hasRole('Agent')) {
          $properties = Property::where('user_id', $userId)->get();
          return view('Tasks', compact('properties'));
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
    public function store(TaskRequest $request)
    {
        if (auth::user()->hasRole('superuser') AND session('company_id')) {
          $property = Property::find($request->property_id);
          $task = new Task;
          $task->property_id = $request->property_id;
          $task->user_id = Auth::user()->id;
          $task->company_id = $property->company_id;
          $task->task_name = $request->task_name;
          $task->task_day = $request->task_day;
          $task->save();
          if ($task) {
            $properties = Property::where('company_id', session('company_id'))->get();
            $user = User::where('company_id', session('company_id'))->first();
            return view('companies/Tasks', compact('properties', 'user'));
          }
        }
        $property = Property::find(session('property_id'));
        $task = new Task;
        $task->property_id = session('property_id');
        $task->user_id = Auth::user()->id;
        $task->company_id = $property->company_id;
        $task->task_name = $request->task_name;
        $task->task_day = $request->task_day;
        $task->save();
        if ($task) {
          session()->forget('property_id');
          Session::flash('created', 'Task Created Successfully!');
          return redirect('home/Tasks');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (auth::user()->hasRole('superuser') AND session('company_id')) {
          $tasks = Task::where('property_id', $id)->get();
          $user = User::where('company_id', session('company_id'))->first();
          return view('companies/Tasks/view', compact('tasks', 'user'));
        }
        session()->forget('property_id');
        $tasks = Task::where('property_id', $id)->get();
        return view('Tasks/view', compact('tasks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth::user()->hasRole('superuser') AND session('company_id')) {
          $task = Task::find($id);
          $user = User::where('company_id', session('company_id'))->first();
          return view('companies/Tasks/edit', compact('task', 'user'));
        }
        $task = Task::find($id);
        return view('Tasks/edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, $id)
    {
        if (auth::user()->hasRole('superuser') AND session('company_id')) {
          $task = Task::findOrFail($id);
          if ($task) {
            $task->task_name = $request->task_name;
            $task->task_day = $request->task_day;
            $task->update();
            Session::flash('updated', 'Task Updated Successfully!');
            $properties = Property::where('company_id', session('company_id'))->get();
            $user = DB::table('users')->where('company_id', session('company_id'))->first();
            return view('companies/Tasks', compact('user', 'properties'));
          }
        }
        $task = Task::findOrFail($id);
        if ($task) {
          $task->task_name = $request->task_name;
          $task->task_day = $request->task_day;
          $task->update();
          Session::flash('updated', 'Task Updated Successfully!');
          return redirect('home/Tasks');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth::user()->hasRole('superuser') AND session('company_id')) {
          $task = Task::find($id);
          $task->delete();

          if ($task) {
            Session::flash('deleted', 'Task Removed Successfully!');
            return redirect()->back();
          }
        }
        $task = Task::find($id);
        $task->delete();

        if ($task) {
          Session::flash('deleted', 'Task Removed Successfully!');
          return redirect()->back();
        }
    }

    public function taskForm($id) {
      if (auth::user()->hasRole('superuser') AND session('company_id')) {
        $user = User::where('company_id', session('company_id'))->first();
        return view('companies/Tasks/create', compact('id', 'user'));
      }
      Session::put('property_id', $id);
      return view('Tasks/create');
    }
}
