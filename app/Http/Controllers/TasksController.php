<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TasksController extends Controller
{
    private $tasks = [
        [
            'id' => 1,
            'title' => 'Kirim Sertifikat',
            'event' => 'Kuliah Umum Capstone',
            'assigned_to' => 'Fathan',
            'deadline' => '2025-04-26',
            'status' => 'In Progress',
            'evidence' => null,
        ],
        [
            'id' => 2,
            'title' => 'Link Registrasi',
            'event' => 'Kuliah Umum Capstone',
            'assigned_to' => 'Agvin',
            'deadline' => '2025-04-18',
            'status' => 'Done',
            'evidence' => 'https://drive.google.com/file/d/1mN0s_DHMpsfPk1P_s8BSzNUSnl9TEY-J/view?usp=sharing',
        ]
    ];

    public function index() 
    {
        $tasks = $this->tasks;
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request$request)
    {
        return redirect()->route('tasks');
    }

    public function edit($id)
    {
        $task = collect($this->tasks)->firstWhere('id', $id);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('tasks');
    }

    public function destroy($id) 
    {
        return redirect()->route('tasks');
    }
}
