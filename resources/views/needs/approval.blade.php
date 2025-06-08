@extends('app')

@section('content')
<div class="flex h-screen bg-gray-50">
    @include('sidebar')
    <div class="flex-1 p-6">
        <h1 class="text-2xl font-bold mb-6">Approval Kebutuhan (CEO)</h1>
        <div class="bg-white border rounded p-4 overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b font-semibold text-center">
                        <th class="py-2">Kebutuhan</th>
                        <th class="py-2">Event</th>
                        <th class="py-2">Status</th>
                        <th class="py-2">Notes</th>
                        <th class="py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($needs as $need)
                    <tr class="border-b text-center">
                        <td class="py-2">{{ $need->description }}</td>
                        <td class="py-2">{{ $need->event->title ?? '-' }}</td>
                        <td class="py-2">
                            <span class="px-2 py-1 rounded text-xs
                                @if($need->status == 'draft') bg-gray-100 text-gray-800
                                @elseif($need->status == 'submitted_to_ceo') bg-yellow-100 text-yellow-800
                                @elseif($need->status == 'approved_by_ceo') bg-green-100 text-green-800
                                @elseif($need->status == 'rejected_by_ceo') bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst(str_replace('_',' ', $need->status)) }}
                            </span>
                        </td>
                        <td class="py-2">{{ $need->approval_notes }}</td>
                        <td class="py-2">
                            @if($need->status == 'submitted_to_ceo')
                            <form action="{{ route('needs.approve', $need->id) }}" method="POST" class="inline">
                                @csrf
                                <input type="text" name="notes" placeholder="Catatan (opsional)" class="border rounded px-2 py-1 mb-1">
                                <button class="bg-green-600 text-white px-2 py-1 rounded text-xs">Approve</button>
                            </form>
                            <form action="{{ route('needs.reject', $need->id) }}" method="POST" class="inline">
                                @csrf
                                <input type="text" name="notes" placeholder="Alasan" class="border rounded px-2 py-1 mb-1">
                                <button class="bg-red-600 text-white px-2 py-1 rounded text-xs">Reject</button>
                            </form>
                            @else
                                <span class="text-gray-400 text-xs">-</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-gray-500 py-4">Tidak ada kebutuhan yang menunggu approval.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection