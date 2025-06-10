@extends('app')

@section('content')
<div class="flex h-screen bg-gray-50">
    @include('sidebar')
    <div class="flex-1 overflow-auto p-4">
        <div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
            <h2 class="text-xl font-bold mb-4">Tambah Kebutuhan Event</h2>
            <form action="{{ route('needs.store') }}" method="POST">
                @csrf
                <input type="hidden" name="event_id" value="{{ $event->id }}">
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1" for="description">Deskripsi Kebutuhan</label>
                    <input type="text" name="description" id="description" required
                        class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-1 focus:ring-orange-500">
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="px-4 py-2 bg-orange-600 text-white rounded hover:bg-orange-700">
                        Simpan
                    </button>
                    <a href="{{ route('events.show', $event->id) }}"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection