<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Need;
use App\Models\Events;
use App\Models\Tasks; // pastikan import model Tasks

class NeedController extends Controller
{
    // Daftar kebutuhan yang menunggu approval CEO
    public function approvalList()
    {
        $needs = Need::with('event')->where('status', 'submitted_to_ceo')->get();
        return view('needs.approval', compact('needs'));
    }

    // Form tambah kebutuhan (Add)
    public function create($event_id)
    {
        $this->authorizePM();
        $event = Events::findOrFail($event_id);
        return view('needs.create', compact('event'));
    }

    // Simpan kebutuhan baru (Store)
    public function store(Request $request)
    {
        $this->authorizePM();
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'description' => 'required|string',
        ]);

        $validated['status'] = 'draft';

        Need::create($validated);

        return redirect()->route('events.show', $request->event_id)
            ->with('success', 'Kebutuhan berhasil ditambahkan!');
    }

    // Form edit kebutuhan (Edit)
    public function edit($id)
    {
        $this->authorizePM();
        $need = Need::findOrFail($id);
        return view('needs.edit', compact('need'));
    }

    // Update kebutuhan (Update)
    public function update(Request $request, $id)
    {
        $this->authorizePM();
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|string',
            'approval_notes' => 'nullable|string',
        ]);

        $need = Need::findOrFail($id);
        $need->update($validated);

        return redirect()->route('events.show', $need->event_id)
            ->with('success', 'Kebutuhan berhasil diupdate!');
    }

    // Hapus kebutuhan (Delete)
    public function destroy($id)
    {
        $this->authorizePM();
        $need = Need::findOrFail($id);
        $event_id = $need->event_id;
        $need->delete();

        return redirect()->route('events.show', $event_id)
            ->with('success', 'Kebutuhan berhasil dihapus!');
    }

    // Approve kebutuhan oleh CEO
    public function approve($id, Request $request)
    {
        $need = Need::findOrFail($id);
        $need->status = 'approved_by_ceo';
        $need->approval_notes = $request->notes;
        $need->save();

        // Buat task jika belum ada
        if (!$need->task) {
            // Pastikan assigned_to diisi (COO atau null jika nullable)
            Tasks::create([
                'title' => $need->title,
                'description' => $need->description,
                'event_id' => $need->event_id,
                'need_id' => $need->id,
                'status' => 'pending',
                'approval_status' => 'approved',
                'assigned_to' => null, 
            ]);
        }

        return back()->with('success', 'Kebutuhan sudah di-approve dan task dibuat!');
    }

    // Reject kebutuhan oleh CEO
    public function reject($id, Request $request)
    {
        $need = Need::findOrFail($id);
        $need->status = 'rejected_by_ceo';
        $need->approval_notes = $request->notes;
        $need->save();
        return back();
    }

    // Helper: hanya PM yang boleh akses
    private function authorizePM()
    {
        if (!auth()->check() || auth()->user()->role !== 'PM') {
            abort(403, 'Unauthorized');
        }
    }
}