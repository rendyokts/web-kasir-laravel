 <div class="container-xxl flex-grow-1 container-p-y">
     <div class="row g-6 mb-4">
         <!-- Card Border Shadow -->
         <div class="col-lg-3 col-sm-6">
             <div class="card card-border-shadow-primary h-100">
                 <div class="card-body">
                     <div class="d-flex align-items-center mb-2">
                         <div class="avatar me-4">
                             <span class="avatar-initial rounded bg-label-primary"><i
                                     class="icon-base ti tabler-truck icon-28px"></i></span>
                         </div>
                         <h4 class="mb-0">42 <small>item</small></h4>
                     </div>
                     <p class="mb-1">Barang Terjual Harian</p>
                     {{-- <p class="mb-0">
                         <span class="text-heading fw-medium me-2">+18.2%</span>
                         <small class="text-body-secondary">than last week</small>
                     </p> --}}
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
                         <h4 class="mb-0">8</h4>
                     </div>
                     <p class="mb-1">Penjualan Harian</p>
                     {{-- <p class="mb-0">
                         <span class="text-heading fw-medium me-2">-8.7%</span>
                         <small class="text-body-secondary">than last week</small>
                     </p> --}}
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
                         <h4 class="mb-0"><small>Rp</small> 270.000</h4>
                     </div>
                     <p class="mb-1">Pendapatan Hari Ini</p>
                     {{-- <p class="mb-0">
                         <span class="text-heading fw-medium me-2">+4.3%</span>
                         <small class="text-body-secondary">than last week</small>
                     </p> --}}
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
                     {{-- <p class="mb-0">
                         <span class="text-heading fw-medium me-2">-2.5%</span>
                         <small class="text-body-secondary">than last week</small>
                     </p> --}}
                 </div>
             </div>
         </div>
         <!--/ Card Border Shadow -->

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
                         <p class="card-subtitle">Total 10 Pembeli</p>
                     </div>
                 </div>
                 <div class="card-body">
                     <ul class="p-0 m-0">
                         <li class="d-flex mb-6">
                             <div class="me-4">
                                 <img src="../../assets/img/products/iphone.png" alt="User" class="rounded"
                                     width="46" />
                             </div>
                             <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                 <div class="me-2">
                                     <h6 class="mb-0">Indomie Goreng</h6>
                                     <small class="text-body d-block">Kode Barang</small>
                                 </div>
                                 <div class="user-progress d-flex align-items-center gap-1">
                                     <p class="mb-0">Rp 120.000</p>
                                 </div>
                             </div>
                         </li>
                         
                         <li class="d-flex mb-6">
                             <div class="me-4">
                                 <img src="../../assets/img/products/iphone.png" alt="User" class="rounded"
                                     width="46" />
                             </div>
                             <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                 <div class="me-2">
                                     <h6 class="mb-0">Kopi Liong</h6>
                                     <small class="text-body d-block">Kode Barang</small>
                                 </div>
                                 <div class="user-progress d-flex align-items-center gap-1">
                                     <p class="mb-0">Rp 40.000</p>
                                 </div>
                             </div>
                         </li>
                         
                         <li class="d-flex mb-6">
                             <div class="me-4">
                                 <img src="../../assets/img/products/iphone.png" alt="User" class="rounded"
                                     width="46" />
                             </div>
                             <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                 <div class="me-2">
                                     <h6 class="mb-0">Nutrisari Sirsak</h6>
                                     <small class="text-body d-block">Kode Barang</small>
                                 </div>
                                 <div class="user-progress d-flex align-items-center gap-1">
                                     <p class="mb-0">Rp 30.000</p>
                                 </div>
                             </div>
                         </li>
                         
                     </ul>
                 </div>
             </div>
            </div>
            @include('layouts.footer')

         @section('page-js')
             <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
             <script src="{{ asset('portos/assets/js/cards-statistics.js') }}"></script>
             <script>
                 const labels = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                 const pendapatanData = [270000, 180000, 250000, 220000, 300000, 270000, 290000]; // contoh
                 const pengeluaranData = [130000, 150000, 120000, 100000, 110000, 90000, 95000]; // contoh

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
