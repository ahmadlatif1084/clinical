<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Todo;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class TodoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $todo = Todo::all();

        return view('backEnd.todo.index', compact('todo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backEnd.todo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
        Todo::create($request->all());

        Session::flash('message', 'Todo added!');
        Session::flash('status', 'success');

        return redirect('todo');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show($id)
    {
        $todo = Todo::findOrFail($id);

        return view('backEnd.todo.show', compact('todo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $todo = Todo::findOrFail($id);

        return view('backEnd.todo.edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        
        $todo = Todo::findOrFail($id);
        $todo->update($request->all());

        Session::flash('message', 'Todo updated!');
        Session::flash('status', 'success');

        return redirect('todo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $todo = Todo::findOrFail($id);

        $todo->delete();

        Session::flash('message', 'Todo deleted!');
        Session::flash('status', 'success');

        return redirect('todo');
    }

}
