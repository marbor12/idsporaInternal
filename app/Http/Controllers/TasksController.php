<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function index()
    {
        // Ambil data tasks dari sesi, jika tidak ada, gunakan array kosong
        $tasks = session('tasks', []);
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        // Ambil data tasks dari sesi
        $tasks = session('tasks', []);

        // Tambahkan task baru ke array
        $tasks[] = [
            'id' => count($tasks) + 1, // Buat ID unik
            'title' => $request->input('title'),
            'event' => $request->input('event'),
            'assigned_to' => $request->input('assigned_to'),
            'deadline' => $request->input('deadline'),
            'status' => $request->input('status'),
            'evidence' => $request->input('evidence'),
        ];

        // Simpan kembali ke sesi
        session(['tasks' => $tasks]);

        return redirect()->route('tasks');
    }
    public function edit($id)
    {
        // Ambil data tasks dari sesi
        $tasks = session('tasks', []);

        // Cari task berdasarkan ID dengan validasi
        $task = collect($tasks)->first(function ($task) use ($id) {
            return isset($task['id']) && $task['id'] == $id;
        });

        // Jika task tidak ditemukan, redirect dengan pesan error
        if (!$task) {
            return redirect()->route('tasks')->with('error', 'Task not found.');
        }

        return view('tasks.edit', compact('task'));
    }
    
    public function update(Request $request, $id)
    {
        // Ambil data tasks dari sesi
        $tasks = session('tasks', []);

        // Perbarui task berdasarkan ID dengan validasi
        foreach ($tasks as &$task) {
            if (isset($task['id']) && $task['id'] == $id) {
                $task['title'] = $request->input('title');
                $task['event'] = $request->input('event');
                $task['assigned_to'] = $request->input('assigned_to');
                $task['deadline'] = $request->input('deadline');
                $task['status'] = $request->input('status');
                $task['evidence'] = $request->input('evidence');
                break;
            }
        }

        // Simpan kembali ke sesi
        session(['tasks' => $tasks]);

        return redirect()->route('tasks');
    }

    public function destroy($id)
    {
        // Ambil data tasks dari sesi
        $tasks = session('tasks', []);

        // Hapus task berdasarkan ID dengan validasi
        $tasks = array_filter($tasks, function ($task) use ($id) {
            return isset($task['id']) && $task['id'] != $id;
        });

        // Simpan kembali ke sesi
        session(['tasks' => array_values($tasks)]); // Reindex array

        return redirect()->route('tasks');
    }
}