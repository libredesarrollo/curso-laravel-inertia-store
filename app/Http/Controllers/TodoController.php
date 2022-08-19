<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::where('user_id', auth()->id())->orderBy('count')->get();
        return inertia('Todo/Index', compact('todos'));
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'name' => 'required|min:2|max:255'
        ]);

        Todo::create(
            [
                'name' => $data['name'],
                'user_id' => auth()->id(),
                'count' => Todo::where('user_id', auth()->id())->count()
            ]
        );

        return back();
    }
    public function update(Todo $todo, Request $request)
    {

        $data = $request->validate([
            'name' => 'required|min:2|max:255'
        ]);

        Todo::where('user_id', auth()->id())->where('id', $todo->id)->update(
            [
                'name' => $data['name'],
            ]
        );

        return back();
    }

    public function status(Todo $todo, Request $request)
    {
        Todo::where('user_id', auth()->id())->where('id', $todo->id)->update(
            [
                'status' => request('status') == '1',
            ]
        );
        return back();
    }
    public function orden()
    {
        // dd(request('ids'));
        foreach (request('ids') as $count => $id) {
            Todo::where('user_id', auth()->id())->where('id', $id)->update(
                [
                    'count' => $count,
                ]
            );
        }
        return back();
    }

    public function destroy(Todo $todo = null)
    {
        if ($todo == null)
            Todo::where('user_id', auth()->id())->delete();
        else
            Todo::where('user_id', auth()->id())->where('id', $todo->id)->delete();
        return back();
    }
}
