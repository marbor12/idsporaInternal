<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Need;

class NeedController extends Controller
{
    // Tampilkan daftar kebutuhan yang menunggu approval CEO
    public function approvalList()
    {
        $needs = Need::with('event')->where('status', 'submitted_to_ceo')->get();
        return view('needs.approval', compact('needs'));
    }

    // Approve kebutuhan oleh CEO
    public function approve($id, Request $request)
    {
        $need = Need::findOrFail($id);
        $need->status = 'approved_by_ceo';
        $need->approval_notes = $request->notes;
        $need->save();
        return back();
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
}