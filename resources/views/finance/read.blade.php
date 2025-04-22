@extends('app')

@section('content')
<div class="flex h-screen bg-gray-50">
  <!-- Sidebar -->
  @include('sidebar')

  <!-- Main Content -->
  <div class="flex-1 overflow-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Finance</h1>

    <!-- Tabs -->
    <div class="mb-6">
      <div class="inline-flex bg-gray-100 rounded-lg p-1">
        <button id="tab-ringkasan" onclick="showTab('ringkasan')" class="px-4 py-2 text-sm font-medium bg-white text-black rounded-md shadow">
          Ringkasan
        </button>
        <button id="tab-transaksi" onclick="showTab('transaksi')" class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-black rounded-md">
          Transaksi
        </button>
      </div>
    </div>

    <!-- Ringkasan Content -->
    <div id="content-ringkasan" class="space-y-6">
      <div class="grid gap-4 md:grid-cols-3">
        <div class="bg-white p-5 border rounded-lg">
          <div class="text-sm text-gray-600 flex justify-between mb-1">
            <span>Total Pendapatan</span><span>Rp</span>
          </div>
          <div class="text-2xl font-bold">Rp 45.231.890</div>
          <div class="text-sm text-green-500">+20.1% dari bulan lalu</div>
        </div>
        <div class="bg-white p-5 border rounded-lg">
          <div class="text-sm text-gray-600 flex justify-between mb-1">
            <span>Total Pengeluaran</span>
            <span><svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M6 10h12M6 13h8M6 16h12" />
              </svg></span>
          </div>
          <div class="text-2xl font-bold">Rp 12.345.678</div>
          <div class="text-sm text-green-500">+10.5% dari bulan lalu</div>
        </div>
        <div class="bg-white p-5 border rounded-lg">
          <div class="text-sm text-gray-600 flex justify-between mb-1">
            <span>Laba Bersih</span>
            <span><svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M3 17l6-6 4 4L21 7" />
              </svg></span>
          </div>
          <div class="text-2xl font-bold">Rp 32.886.212</div>
          <div class="text-sm text-green-500">+24.5% dari bulan lalu</div>
        </div>
      </div>

      <!-- Placeholder grafik -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white p-5 rounded-lg border">
          <h2 class="text-lg font-semibold mb-2">Ringkasan Keuangan</h2>
          <div class="h-48 bg-gray-100 flex items-center justify-center text-gray-400">
            (Grafik Placeholder)
          </div>
        </div>
        <div class="bg-white p-5 rounded-lg border">
          <h2 class="text-lg font-semibold mb-2">Komposisi Pengeluaran</h2>
        </div>
      </div>
      <div>
        <div class="bg-white p-5 rounded-lg border">
        <h2 class="text-lg font-semibold mb-2">Transaksi Terbaru</h2>
          <p class="text-sm text-gray-500 mb-2">3/23/2025 - 4/23/2025</p>
          <ul class="space-y-2">
            <li class="flex justify-between">
              <span>Pembayaran dari Klien A</span>
              <span class="text-green-600 font-semibold">+Rp 5.000.000</span>
            </li>
            <li class="flex justify-between">
              <span>Pembelian Peralatan Kantor</span>
              <span class="text-red-600 font-semibold">-Rp 1.200.000</span>
            </li>
            <li class="flex justify-between">
              <span>Pembayaran dari Klien B</span>
              <span class="text-green-600 font-semibold">+Rp 3.500.000</span>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Transaksi Content -->
    <div id="content-transaksi" class="hidden">
      <p class="text-gray-700">Ini adalah halaman Transaksi.</p>
    </div>
  </div>
</div>

<script>
  function showTab(tab) {
    const tabs = ["ringkasan", "transaksi"];
    tabs.forEach(id => {
      document.getElementById("content-" + id).classList.add("hidden");
      document.getElementById("tab-" + id).className =
        "px-4 py-2 text-sm font-medium text-gray-500 hover:text-black rounded-md";
    });

    document.getElementById("content-" + tab).classList.remove("hidden");
    document.getElementById("tab-" + tab).className =
      "px-4 py-2 text-sm font-medium bg-white text-black shadow rounded-md";
  }
</script>
@endsection