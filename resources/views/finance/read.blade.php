@extends('app')

@section('content')
<div class="flex h-screen bg-gray-50">
  <!-- Sidebar -->
  @include('sidebar')

  <!-- Main Content -->
  <div class="flex-1 overflow-auto p-6">
    <div class="flex items-center justify-between">
      <h1 class="text-2xl font-bold tracking-tight">Finance</h1>
      <div class="flex items-center gap-2">
        <a href="{{ route('finance.create') }}">
          <button class="btn flex bg-black p-2 rounded-md text-white">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 mr-1">
              <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
            </svg>
            Add Transaction
          </button>
        </a>
        <!-- ...dropdown export, dll... -->
      </div>
    </div>

    <!-- Tabs -->
    <div class="mb-6">
      <div class="inline-flex bg-gray-100 rounded-lg p-1">
        <button id="tab-ringkasan" onclick="showTab('ringkasan')" class="px-4 py-2 text-sm font-medium bg-gray-800 text-white rounded-md shadow">
          Ringkasan
        </button>
        <button id="tab-transaksi" onclick="showTab('transaksi')" class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-800 rounded-md">
          Transaksi
        </button>
      </div>
    </div>

    <!-- Ringkasan Content -->
    <div id="content-ringkasan" class="space-y-6">
      <!-- ...ringkasan dan chart (tidak diubah)... -->
      <div class="grid gap-4 md:grid-cols-3">
        <div class="bg-white p-5 border rounded-lg">
          <div class="text-sm text-gray-600 flex justify-between mb-1">
            <span>Total Revenue</span><span>Rp</span>
          </div>
          <div class="text-2xl font-bold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
        </div>
        <div class="bg-white p-5 border rounded-lg">
          <div class="text-sm text-gray-600 flex justify-between mb-1">
            <span>Total Expenses</span>
            <span><svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M6 10h12M6 13h8M6 16h12" />
              </svg></span>
          </div>
          <div class="text-2xl font-bold">Rp {{ number_format($totalExpenses, 0, ',', '.') }}</div>
        </div>
        <div class="bg-white p-5 border rounded-lg">
          <div class="text-sm text-gray-600 flex justify-between mb-1">
            <span>Net Balance</span>
            <span><svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M3 17l6-6 4 4L21 7" />
              </svg></span>
          </div>
          <div class="text-2xl font-bold">Rp {{ number_format($netBalance, 0, ',', '.') }}</div>
        </div>
      </div>
      <!-- Chart section tetap -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white p-5 rounded-lg border">
          <h2 class="text-lg font-semibold mb-2">Financial Summary</h2>
          <div class="h-auto bg-gray-100 flex items-center justify-center text-gray-400">
            <div class="h-[400px]">
              <canvas id="financialSummaryChart"></canvas>
            </div>
          </div>
        </div>
        <div class="bg-white p-5 rounded-lg border">
          <h2 class="text-lg font-semibold mb-2">Expense Composition</h2>
          <div class=" flex items-center justify-center text-gray-400">
            <div class="h-[400px]">
              <canvas id="expenseCompositionChart"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Transaksi Content -->
    <div id="content-transaksi" class="hidden">
      <div class="bg-white shadow rounded p-4">
        <h2 class="text-xl font-semibold mb-1">All transaction</h2>
        <p class="text-sm text-gray-500 mb-4">Daftar semua transaksi dalam periode yang dipilih</p>
        <div class="flex items-center space-x-2 mb-4">
          <button class="border px-3 py-1 rounded">Filter</button>
          <button class="bg-gray-200 px-3 py-1 rounded">All</button>
          <button class="bg-green-100 text-green-600 px-3 py-1 rounded">↑ Revenue</button>
          <button class="bg-red-100 text-red-600 px-3 py-1 rounded">↓ Expense</button>
        </div>
        <input type="text" placeholder="Cari transaksi..." class="w-full border px-3 py-2 rounded mb-4">

        <div class="overflow-x-auto">
          <table class="w-full table-auto text-left text-sm">
            <thead class="bg-gray-100">
              <tr>
                <th class="px-4 py-2">Tanggal</th>
                <th class="px-4 py-2">Deskripsi</th>
                <th class="px-4 py-2">Kategori</th>
                <th class="px-4 py-2">Subkategori</th>
                <th class="px-4 py-2">Jumlah</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($transactions as $t)
              <tr class="border-b hover:bg-gray-50">
                <td class="px-4 py-3">{{ $t->date }}</td>
                <td class="px-4 py-3">{{ $t->descriptions }}</td>
                <td class="px-4 py-3">
                  @if($t->category === 'revenue')
                  <span class="text-green-600 font-semibold">Revenue</span>
                  @else
                  <span class="text-red-600 font-semibold">Expenses</span>
                  @endif
                </td>
                <td>
                  @if($t->subcategory === 'event')
                  <span class="text-black font-medium">Event</span>
                  @elseif($t->subcategory === 'operational')
                  <span class="text-black font-medium">Operational</span>
                  @else
                  <span class="text-black font-medium">{{ ucfirst($t->subcategory) }}</span>
                  @endif
                </td>
                <td class="px-4 py-3">Rp {{ number_format($t->amount, 0, ',', '.') }}</td>
                <td>
                  @if($t->status === 'completed')
                  <span class="text-black font-medium">Completed</span>
                  @elseif($t->status === 'pending')
                  <span class="text-black font-medium">Pending</span>
                  @else
                  <span class="text-black font-medium">Processing</span>
                  @endif
                </td>
                <td class="px-4 py-3">
                  <a href="{{ route('finance.edit',  $t->id)}}">
                    <button class="px-2 py-1 bg-blue-500 text-white rounded text-xs">Edit</button>
                  </a>
                  <form action="{{ route('finance.destroy', $t->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded text-xs" onclick="return confirm('Are you sure you want to delete?')">
                      Delete</button>
                  </form>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="7" class="text-center text-gray-500">No transactions found.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
        <div class="flex justify-end mt-4">
          <button class="border px-4 py-2 rounded flex items-center space-x-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path d="M12 5v14m7-7H5" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
            </svg>
            <span>Export</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  // ...seluruh script chart dan tab tetap...
  // (tidak perlu diubah)
</script>
@endsection