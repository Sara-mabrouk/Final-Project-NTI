<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TasksController extends Controller
{

    function __construct()
    {

        $this->middleware(['cannotDeleteExpiredTask'], ['except' => [ "create", "store"]]);
    }
    public function index()
    {
        $currentid = auth()->user()->id;
        $data = DB::table('tasks')->join('Admin', 'Admin.id', '=', 'tasks.Admin_id')->select('tasks.*', 'Admin.name  as WriterName')->orderby('id')->where('Admin_id', $currentid)->get();

        return view('tasks.index', ['data' => $data]);
    }

    public function create()
    {
        return view('tasks.create', ['title' => "Create Task "]);
    }


    public function store(Request $request)
    {
        $data = $this->validate($request, [
            "title"   => "required|min:10",
            "content" => "required|min:50",
            "start_date" => "required|date|after_or_equal:today",
            "end_date" => "required|date|after_or_equal:today",
            "image"   => "required|image|mimes:png,jpg"
        ]);

        # SET ADDED BY ID .....
        $data['Admin_id'] = auth()->user()->id;
        $data['start_date'] = $request->start_date;
        $data['end_date'] = $request->end_date;


        # Rename Image ....
        $FinalName = uniqid() . '.' . $request->image->extension();

        if ($request->image->move(public_path('/Tasks'), $FinalName)) {
            $data['image'] = $FinalName;
        }


        $op =   DB::table('tasks')->insert($data);

        if ($op) {
            $message = "Raw Inserted";
        } else {
            $message = "Error Try Again";
        }

        session()->flash('Message', $message);

        return redirect(url('/Task'));
    }

    public function destroy($id)
    {
        $op = DB::table('tasks')->where('id', $id)->delete();

        if ($op) {
            $message = "Raw Removed";
        } else {
            $message = "Error Try Again";
        }

        session()->flash('Message', $message);

        return redirect(url('/Task'));
    }
    public function message()
    {
    }
}
