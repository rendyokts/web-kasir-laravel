 <div class="container-xxl flex-grow-1 container-p-y">
    @if (auth()->user()->regist_by_google === 2)

            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <strong class="text-primary">Perhatian!</strong> <span class="text-primary">Anda login menggunakan Google. Silahkan segera ganti password Anda.</span>
                <a href="{{ route('profil.ganti-password') }}" class="btn btn-sm btn-primary ms-3">
                    Ubah Password
                </a>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
     <div class="row g-6 mb-4">
         <div class="col-lg-3 col-sm-6">
             <div class="card card-border-shadow-primary h-100">
                 <div class="card-body">
                     <div class="d-flex align-items-center mb-2">
                         <div class="avatar me-4">
                             <span class="avatar-initial rounded bg-label-primary"><i
                                     class="icon-base ti tabler-truck icon-28px"></i></span>
                         </div>
                         <h4 class="mb-0">{{ $qtyHarian }} <small>item</small></h4>
                     </div>
                     <p class="mb-1">Barang Terjual Pada</p>
                     <div class="mb-1"> {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</div>
                 </div>
             </div>
         </div>
         <div class="col-lg-3 col-sm-6">
             <div class="card card-border-shadow-warning h-100">
                 <div class="card-body">
                     <div class="d-flex align-items-center mb-2">
                         <div class="avatar me-4">
                             <span class="avatar-initial rounded bg-label-warning"><i
                                     class="icon-base ti tabler-alert-triangle icon-28px"></i></span>
                         </div>
                         <h4 class="mb-0">{{ $trxHarian }}</h4>
                     </div>
                     <p class="mb-1">Penjualan Harian</p>
                     <div class="mb-1"> {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</div>
                 </div>
             </div>
         </div>
         <div class="col-lg-3 col-sm-6">
             <div class="card card-border-shadow-danger h-100">
                 <div class="card-body">
                     <div class="d-flex align-items-center mb-2">
                         <div class="avatar me-4">
                             <span class="avatar-initial rounded bg-label-danger"><i
                                     class="icon-base ti tabler-git-fork icon-28px"></i></span>
                         </div>
                         <h4 class="mb-0"><small>Rp</small> {{ number_format($transaksiHarian, 0, ',', '.') }}</h4>
                     </div>
                     <p class="mb-1">Pendapatan Hari Ini</p>
                     <div class="mb-1"> {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</div>
                 </div>
             </div>
         </div>
         <div class="col-lg-3 col-sm-6">
             <div class="card card-border-shadow-info h-100">
                 <div class="card-body">
                     <div class="d-flex align-items-center mb-2">
                         <div class="avatar me-4">
                             <span class="avatar-initial rounded bg-label-info"><i
                                     class="icon-base ti tabler-clock icon-28px"></i></span>
                         </div>
                         <h4 class="mb-0"><small>Rp</small> 130.000</h4>
                     </div>
                     <p class="mb-1">Pengeluaran Hari Ini</p>
                     <div class="mb-1"> {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</div>
                 </div>
             </div>
         </div>

         @if ($barangStokTipis->count() > 0)
             <div class="col-xxl-12 col-lg-12 col-md-12 col-sm-12">
                 <div class="alert alert-danger fade show" role="alert">
                     <strong>⚠ Stok Barang Menipis!</strong><br>
                     <ul class="mb-0 mt-0">
                         @foreach ($barangStokTipis as $barang)
                             <li>{{ $barang->nama_barang }} — <strong>{{ $barang->stok }}</strong> item tersisa</li>
                         @endforeach
                     </ul>
                 </div>
             </div>
         @endif

         <div class="col-xxl-9 col-lg-12 col-md-12 col-sm-12">
             <div class="card h-100">
                 <div class="card-header d-flex align-items-center justify-content-between">
                     <div class="card-title mb-0">
                         <h5 class="m-0 me-2">Pendapatan & Pengeluaran (7 Hari Terakhir)</h5>
                     </div>
                 </div>
                 <div class="card-body">
                     <div class="table-responsive">
                         <canvas id="pendapatanPengeluaranChart" height="150"></canvas>
                     </div>
                 </div>
             </div>
         </div>
         <div class="col-xxl-3 col-md-6">
             <div class="card h-100">
                 <div class="card-header d-flex justify-content-between">
                     <div class="card-title m-0 me-2">
                         <h5 class="mb-1">Paling Laris</h5>
                         <p class="card-subtitle">Minggu Ini</p>
                     </div>
                 </div>
                 <div class="card-body">
                     <ul class="p-0 m-0">
                         @foreach ($terlaris as $laris)
                             <li class="d-flex mb-6">
                                 <div class="me-4">
                                     <img src="{{ asset('storage/' . $laris->gambar_produk) }}" alt="User"
                                         class="rounded" width="46" />
                                 </div>
                                 <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                     <div class="me-2">
                                         <h6 class="mb-0">{{ $laris->nama_barang }}</h6>
                                         <small class="text-body d-block">Total terjual:
                                             {{ $laris->total_terjual }}</small>
                                     </div>
                                     <div class="user-progress d-flex align-items-center gap-1">
                                         <p class="mb-0">Rp {{ number_format($laris->harga_barang, 0, ',', '.') }}
                                         </p>
                                     </div>
                                 </div>
                             </li>
                         @endforeach
                     </ul>
                 </div>
             </div>
         </div>
         @include('layouts.footer')

         @section('page-js')
             <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
             <script src="{{ asset('portos/assets/js/cards-statistics.js') }}"></script>
             <script>
                 const labels = @json($labels);
                 const pendapatanData = @json($pendapatan);
                 const pengeluaranData = @json($pengeluaran);

                 new Chart(document.getElementById('pendapatanPengeluaranChart'), {
                     type: 'line',
                     data: {
                         labels: labels,
                         datasets: [{
                                 label: 'Pendapatan',
                                 data: pendapatanData,
                                 borderColor: '#28a745',
                                 backgroundColor: 'rgba(40, 167, 69, 0.1)',
                                 fill: true,
                                 tension: 0.4
                             },
                             {
                                 label: 'Pengeluaran',
                                 data: pengeluaranData,
                                 borderColor: '#dc3545',
                                 backgroundColor: 'rgba(220, 53, 69, 0.1)',
                                 fill: true,
                                 tension: 0.4
                             }
                         ]
                     },
                     options: {
                         responsive: true,
                         plugins: {
                             tooltip: {
                                 callbacks: {
                                     label: function(context) {
                                         let label = context.dataset.label || '';
                                         let value = context.parsed.y;
                                         return `${label}: Rp ${value.toLocaleString('id-ID')}`;
                                     }
                                 }
                             }
                         },
                         scales: {
                             y: {
                                 beginAtZero: true,
                                 ticks: {
                                     callback: function(value) {
                                         return 'Rp ' + value.toLocaleString('id-ID');
                                     }
                                 }
                             }
                         }
                     }
                 });
             </script>
         @endsection
