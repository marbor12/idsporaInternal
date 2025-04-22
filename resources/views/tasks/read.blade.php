@extends('app')

@section('content')
    <div class="flex h-screen bg-gray-50">
        <!-- Sidebar -->
        @include('sidebar')

        <!-- Main Content -->
        <div class="flex-1 overflow-auto p-4">
            <h1 class="text-2xl font-bold mb-4">📋 Task Page</h1>

            <!-- Filter & Search -->
            <div class="bg-white border rounded p-4 mb-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                <div class="relative col-span-2">

                    <img src="https://cdn-icons-png.flaticon.com/512/4347/4347487.png" alt="Search Icon"
                        class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 opacity-50">
                    <input type="text" placeholder="Search task (judul/deskripsi)"
                        class="pl-10 border rounded px-3 py-2 w-full">
                </div>
            </div>
            <select class="border rounded px-3 py-2">
                <option>Semua Event</option>
                <option>Webinar AI 2025</option>
                <option>Pelatihan BUMN</option>

            </select>
            <select class="border rounded px-3 py-2">
                <option>Semua Status</option>
                <option value="pending">Pending</option>
                <option value="in_progress">In Progress</option>
                <option value="done">Done</option>
            </select>
            <select class="border rounded px-3 py-2">
                <option>Tugas Untuk (All)</option>
                <option>Rani</option>
                <option>Agvin</option>
            </select>

            <!-- Tombol Tambah -->
            <div class="flex justify-end mb-4">
                <a href="#" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 flex items-center gap-2">
                    <img src="https://cdn-icons-png.flaticon.com/512/13878/13878141.png" alt="Add Icon" class="w-5 h-5">
                    Tambah Task Baru
                </a>
            </div>


            <!-- Daftar Task -->
            <div class="bg-white border rounded p-4">
                <table class="w-full text-l">
                    <thead>
                        <tr class="border-b font-semibold text-left">
                            <th class="py-2">Judul Task</th>
                            <th class="py-2">Event Terkait</th>
                            <th class="py-2">Tugas Untuk</th>
                            <th class="py-2">Deadline</th>
                            <th class="py-2">Status</th>
                            <th class="py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b">
                            <td class="py-2">Kirim Sertifikat</td>
                            <td class="py-2">Webinar AI 2025</td>
                            <td class="py-2">Rani</td>
                            <td class="py-2">22 Apr 2025</td>
                            <td class="py-2">
                                <span class="px-2 py-1 rounded text-xs bg-yellow-100 text-yellow-800">In Progress</span>
                            </td>
                            <td class="py-2">
                                <a href="#" class="text-blue-600 hover:underline">Delete</a> /
                                <a href="#" class="text-green-600 hover:underline">Edit</a>
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-2">Cek Vendor Ruang</td>
                            <td class="py-2">Pelatihan BUMN</td>
                            <td class="py-2">Agvin</td>
                            <td class="py-2">24 Apr 2025</td>
                            <td class="py-2">
                                <span class="px-2 py-1 rounded text-xs bg-red-100 text-red-800">Pending</span>
                            </td>
                            <td class="py-2">
                                <a href="#" class="text-blue-600 hover:underline">Delete</a> /
                                <a href="#" class="text-green-600 hover:underline">Edit</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection