<?php

namespace App\Http\Controllers;

use App\Http\Requests\Todo\UpdateRequest;
use App\Models\Todo;
use Inertia\Inertia;
use Inertia\Response;

class TodoController extends Controller
{
    public function index(): Response
    {
        $todos = Todo::all();
        return Inertia::render('Todo/Index', ['todos' => $todos]);
    }

    public function create()
    {
        //
    }

    public function store()
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Todo $todo, UpdateRequest $request)
    {
        $todo->update($request->validated());


        return redirect()->route('todos.index');
    }

    public function destroy($id)
    {
        //
    }
}
