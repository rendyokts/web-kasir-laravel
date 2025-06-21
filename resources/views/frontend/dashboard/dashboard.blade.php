 <div class="container-xxl flex-grow-1 container-p-y">
     <div class="row g-6 mb-4">
         <div class="col-xl-4 col-sm-6">
             <div class="card h-100">
                 <div class="card-header pb-0 d-flex justify-content-between align-items-start">
                     <div class="card-title mb-0">
                         <h4 class="mb-0">471</h4>
                         <small class="text-body">Call</small>
                     </div>
                     <div class="badge bg-label-success"><a href="#">Detail</a></div>
                 </div>
                 <div class="card-body">
                     <div id="averageDailyTraffic"></div>
                 </div>
             </div>
         </div>
         <div class="col-xl-4 col-sm-6">
             <div class="card h-100">
                 <div class="card-header pb-0 d-flex justify-content-between align-items-start">
                     <div class="card-title mb-0">
                         <h4 class="mb-0">1044</h4>
                         <small class="text-body">Total SPK Bulan
                             123</small>
                     </div>
                     <div class="badge bg-label-success"><a href="#">Detail</a></div>
                 </div>
                 <div class="card-body">
                     <div id="averageDailyTraffic"></div>
                 </div>
             </div>
         </div>
         <div class="col-xl-4 col-sm-6">
             <div class="card h-100">
                 <div class="card-header pb-0 d-flex justify-content-between align-items-start">
                     <div class="card-title mb-0">
                         <h4 class="mb-0">123</h4>
                         <small class="text-body">Nota Terbit Bulan
                             123</small>
                     </div>
                     <div class="badge bg-label-success"><a href="#">Detail</a></div>
                 </div>
                 <div class="card-body">
                     <div id="averageDailyTraffic"></div>
                 </div>
             </div>
         </div>
         <div class="col-xl-4 col-sm-6">
             <div class="card h-100">
                 <div class="card-header pb-0 d-flex justify-content-between align-items-start">
                     <div class="card-title mb-0">
                         <h4 class="mb-0">123</h4>
                         <small class="text-body">Nota Billed Bulan
                             123</small>
                     </div>
                     <div class="badge bg-label-success"><a href="#">Detail</a></div>
                 </div>
                 <div class="card-body">
                     <div id="averageDailyTraffic"></div>
                 </div>
             </div>
         </div>
         <div class="col-xl-4 col-sm-6">
             <div class="card h-100">
                 <div class="card-header pb-0 d-flex justify-content-between align-items-start">
                     <div class="card-title mb-0">
                         <h4 class="mb-0">35.000.000</h4>
                         <small class="text-body">Total Jasa Bulan
                             123</small>
                     </div>
                     <div class="badge bg-label-success"><a href="#">Detail</a></div>
                 </div>
                 <div class="card-body">
                     <div id="averageDailyTraffic"></div>
                 </div>
             </div>
         </div>
         <div class="col-xl-4 col-sm-6">
             <div class="card h-100">
                 <div class="card-header pb-0 d-flex justify-content-between align-items-start">
                     <div class="card-title mb-0">
                         <h4 class="mb-0">15.000.000</h4>
                         <small class="text-body">Tunda Sharing Bulan
                             123</small>
                     </div>
                     <div class="badge bg-label-success"><a href="#">Detail</a></div>
                 </div>
                 <div class="card-body">
                     <div id="averageDailyTraffic"></div>
                 </div>
             </div>
         </div>
     </div>
     <div class="row g-6 mb-4">
         <div class="col-xl-12 col-sm-6">
             <div class="card">
                 <div class="card-header header-elements">
                     <h5 class="card-title mb-0">Data Call Kapal</h5>
                     <div class="card-action-element ms-auto py-0">
                         <div class="dropdown">
                             <button type="button" class="btn dropdown-toggle px-0" data-bs-toggle="dropdown"
                                 aria-expanded="false">
                                 <i class="icon-base ti tabler-calendar"></i>
                             </button>
                             <ul class="dropdown-menu dropdown-menu-end">
                                 <li>
                                     <a href="javascript:void(0);"
                                         class="dropdown-item d-flex align-items-center">Today</a>
                                 </li>
                                 <li>
                                     <a href="javascript:void(0);"
                                         class="dropdown-item d-flex align-items-center">Yesterday</a>
                                 </li>
                                 <li>
                                     <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last
                                         7 Days</a>
                                 </li>
                                 <li>
                                     <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last
                                         30 Days</a>
                                 </li>
                                 <li>
                                     <hr class="dropdown-divider" />
                                 </li>
                                 <li>
                                     <a href="javascript:void(0);"
                                         class="dropdown-item d-flex align-items-center">Current Month</a>
                                 </li>
                                 <li>
                                     <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last
                                         Month</a>
                                 </li>
                             </ul>
                         </div>
                     </div>
                 </div>
                 <div class="card-body">
                     <canvas id="barChart" class="chartjs" data-height="400"></canvas>
                 </div>
             </div>
         </div>
         <div class="col-xl-12 col-sm-6">
             <div class="card">
                 <div class="card-header header-elements">
                     <h5 class="card-title mb-0">Data Nota Kapal</h5>
                     <div class="card-action-element ms-auto py-0">
                         <div class="dropdown">
                             <button type="button" class="btn dropdown-toggle px-0" data-bs-toggle="dropdown"
                                 aria-expanded="false">
                                 <i class="icon-base ti tabler-calendar"></i>
                             </button>
                             <ul class="dropdown-menu dropdown-menu-end">
                                 <li>
                                     <a href="javascript:void(0);"
                                         class="dropdown-item d-flex align-items-center">Today</a>
                                 </li>
                                 <li>
                                     <a href="javascript:void(0);"
                                         class="dropdown-item d-flex align-items-center">Yesterday</a>
                                 </li>
                                 <li>
                                     <a href="javascript:void(0);"
                                         class="dropdown-item d-flex align-items-center">Last
                                         7 Days</a>
                                 </li>
                                 <li>
                                     <a href="javascript:void(0);"
                                         class="dropdown-item d-flex align-items-center">Last
                                         30 Days</a>
                                 </li>
                                 <li>
                                     <hr class="dropdown-divider" />
                                 </li>
                                 <li>
                                     <a href="javascript:void(0);"
                                         class="dropdown-item d-flex align-items-center">Current Month</a>
                                 </li>
                                 <li>
                                     <a href="javascript:void(0);"
                                         class="dropdown-item d-flex align-items-center">Last
                                         Month</a>
                                 </li>
                             </ul>
                         </div>
                     </div>
                 </div>
                 <div class="card-body">
                     <canvas id="barChart" class="chartjs" data-height="400"></canvas>
                 </div>
             </div>
         </div>
     </div>
     <div class="row g-6 mb-4">
         <div class="col-xl-6 col-sm-6">
             <div class="card">
                 <div class="card-header header-elements">
                     <h5 class="card-title mb-0">Data SPK</h5>
                     <div class="card-action-element ms-auto py-0">
                         <div class="dropdown">
                             <button type="button" class="btn dropdown-toggle px-0" data-bs-toggle="dropdown"
                                 aria-expanded="false">
                                 <i class="icon-base ti tabler-calendar"></i>
                             </button>
                             <ul class="dropdown-menu dropdown-menu-end">
                                 <li>
                                     <a href="javascript:void(0);"
                                         class="dropdown-item d-flex align-items-center">Today</a>
                                 </li>
                                 <li>
                                     <a href="javascript:void(0);"
                                         class="dropdown-item d-flex align-items-center">Yesterday</a>
                                 </li>
                                 <li>
                                     <a href="javascript:void(0);"
                                         class="dropdown-item d-flex align-items-center">Last
                                         7 Days</a>
                                 </li>
                                 <li>
                                     <a href="javascript:void(0);"
                                         class="dropdown-item d-flex align-items-center">Last
                                         30 Days</a>
                                 </li>
                                 <li>
                                     <hr class="dropdown-divider" />
                                 </li>
                                 <li>
                                     <a href="javascript:void(0);"
                                         class="dropdown-item d-flex align-items-center">Current Month</a>
                                 </li>
                                 <li>
                                     <a href="javascript:void(0);"
                                         class="dropdown-item d-flex align-items-center">Last
                                         Month</a>
                                 </li>
                             </ul>
                         </div>
                     </div>
                 </div>
                 <div class="card-body">
                     <canvas id="barChart" class="chartjs" data-height="400"></canvas>
                 </div>
             </div>
         </div>
         <div class="col-xl-6 col-sm-6">
             <div class="card">
                 <div class="card-header header-elements">
                     <h5 class="card-title mb-0">Data Nota</h5>
                     <div class="card-action-element ms-auto py-0">
                         <div class="dropdown">
                             <button type="button" class="btn dropdown-toggle px-0" data-bs-toggle="dropdown"
                                 aria-expanded="false">
                                 <i class="icon-base ti tabler-calendar"></i>
                             </button>
                             <ul class="dropdown-menu dropdown-menu-end">
                                 <li>
                                     <a href="javascript:void(0);"
                                         class="dropdown-item d-flex align-items-center">Today</a>
                                 </li>
                                 <li>
                                     <a href="javascript:void(0);"
                                         class="dropdown-item d-flex align-items-center">Yesterday</a>
                                 </li>
                                 <li>
                                     <a href="javascript:void(0);"
                                         class="dropdown-item d-flex align-items-center">Last
                                         7 Days</a>
                                 </li>
                                 <li>
                                     <a href="javascript:void(0);"
                                         class="dropdown-item d-flex align-items-center">Last
                                         30 Days</a>
                                 </li>
                                 <li>
                                     <hr class="dropdown-divider" />
                                 </li>
                                 <li>
                                     <a href="javascript:void(0);"
                                         class="dropdown-item d-flex align-items-center">Current Month</a>
                                 </li>
                                 <li>
                                     <a href="javascript:void(0);"
                                         class="dropdown-item d-flex align-items-center">Last
                                         Month</a>
                                 </li>
                             </ul>
                         </div>
                     </div>
                 </div>
                 <div class="card-body">
                     <canvas id="barChart" class="chartjs" data-height="400"></canvas>
                 </div>
             </div>
         </div>
     </div>
     <div class="row g-6 mb-4">
         <div class="col-xl-6 col-sm-6">
             <div class="card">
                 <div class="card-header header-elements">
                     <h5 class="card-title mb-0">Total Jasa</h5>
                     <div class="card-action-element ms-auto py-0">
                         <div class="dropdown">
                             <button type="button" class="btn dropdown-toggle px-0" data-bs-toggle="dropdown"
                                 aria-expanded="false">
                                 <i class="icon-base ti tabler-calendar"></i>
                             </button>
                             <ul class="dropdown-menu dropdown-menu-end">
                                 <li>
                                     <a href="javascript:void(0);"
                                         class="dropdown-item d-flex align-items-center">Today</a>
                                 </li>
                                 <li>
                                     <a href="javascript:void(0);"
                                         class="dropdown-item d-flex align-items-center">Yesterday</a>
                                 </li>
                                 <li>
                                     <a href="javascript:void(0);"
                                         class="dropdown-item d-flex align-items-center">Last
                                         7 Days</a>
                                 </li>
                                 <li>
                                     <a href="javascript:void(0);"
                                         class="dropdown-item d-flex align-items-center">Last
                                         30 Days</a>
                                 </li>
                                 <li>
                                     <hr class="dropdown-divider" />
                                 </li>
                                 <li>
                                     <a href="javascript:void(0);"
                                         class="dropdown-item d-flex align-items-center">Current Month</a>
                                 </li>
                                 <li>
                                     <a href="javascript:void(0);"
                                         class="dropdown-item d-flex align-items-center">Last
                                         Month</a>
                                 </li>
                             </ul>
                         </div>
                     </div>
                 </div>
                 <div class="card-body">
                     <canvas id="barChart" class="chartjs" data-height="400"></canvas>
                 </div>
             </div>
         </div>
         <div class="col-xl-6 col-sm-6">
             <div class="card">
                 <div class="card-header header-elements">
                     <h5 class="card-title mb-0">Total Tunda Sharing</h5>
                     <div class="card-action-element ms-auto py-0">
                         <div class="dropdown">
                             <button type="button" class="btn dropdown-toggle px-0" data-bs-toggle="dropdown"
                                 aria-expanded="false">
                                 <i class="icon-base ti tabler-calendar"></i>
                             </button>
                             <ul class="dropdown-menu dropdown-menu-end">
                                 <li>
                                     <a href="javascript:void(0);"
                                         class="dropdown-item d-flex align-items-center">Today</a>
                                 </li>
                                 <li>
                                     <a href="javascript:void(0);"
                                         class="dropdown-item d-flex align-items-center">Yesterday</a>
                                 </li>
                                 <li>
                                     <a href="javascript:void(0);"
                                         class="dropdown-item d-flex align-items-center">Last
                                         7 Days</a>
                                 </li>
                                 <li>
                                     <a href="javascript:void(0);"
                                         class="dropdown-item d-flex align-items-center">Last
                                         30 Days</a>
                                 </li>
                                 <li>
                                     <hr class="dropdown-divider" />
                                 </li>
                                 <li>
                                     <a href="javascript:void(0);"
                                         class="dropdown-item d-flex align-items-center">Current Month</a>
                                 </li>
                                 <li>
                                     <a href="javascript:void(0);"
                                         class="dropdown-item d-flex align-items-center">Last
                                         Month</a>
                                 </li>
                             </ul>
                         </div>
                     </div>
                 </div>
                 <div class="card-body">
                     <canvas id="barChart" class="chartjs" data-height="400"></canvas>
                 </div>
             </div>
         </div>
     </div>
 </div>


 @section('page-js')
     <script src="{{ asset('portos/assets/js/cards-statistics.js') }}"></script>

     <script>
         const averageDailyTrafficEl = document.querySelector('#averageDailyTraffic'),
             averageDailyTrafficConfig = {
                 chart: {
                     height: 145,
                     parentHeightOffset: 0,
                     type: 'bar',
                     toolbar: {
                         show: false
                     }
                 },
                 plotOptions: {
                     bar: {
                         barHeight: '100%',
                         columnWidth: '11px',
                         startingShape: 'rounded',
                         endingShape: 'rounded',
                         borderRadius: 5
                     }
                 },
                 colors: [config.colors.warning],
                 grid: {
                     show: false,
                     padding: {
                         top: -30,
                         left: -18,
                         bottom: -13,
                         right: -18
                     }
                 },
                 dataLabels: {
                     enabled: false
                 },
                 tooltip: {
                     enabled: false
                 },
                 series: [{
                     data: [30, 40, 50, 60, 70, 80, 90]
                 }],
                 legend: {
                     show: false
                 },
                 xaxis: {
                     categories: ['01', '02', '03', '04', '05', '06', '07'],
                     axisBorder: {
                         show: false
                     },
                     axisTicks: {
                         show: false
                     },
                     labels: {
                         style: {
                             colors: labelColor,
                             fontSize: '13px',
                             fontFamily: fontFamily
                         },
                         show: true
                     }
                 },
                 yaxis: {
                     labels: {
                         show: false
                     }
                 },
                 responsive: [{
                         breakpoint: 1441,
                         options: {
                             plotOptions: {
                                 bar: {
                                     borderRadius: 5
                                 }
                             }
                         }
                     },
                     {
                         breakpoint: 1200,
                         options: {
                             plotOptions: {
                                 bar: {
                                     columnWidth: '25%',
                                     borderRadius: 9
                                 }
                             }
                         }
                     },
                     {
                         breakpoint: 992,
                         options: {
                             plotOptions: {
                                 bar: {
                                     borderRadius: 8,
                                     columnWidth: '25%'
                                 }
                             }
                         }
                     },
                     {
                         breakpoint: 836,
                         options: {
                             plotOptions: {
                                 bar: {
                                     columnWidth: '30%'
                                 }
                             }
                         }
                     },
                     {
                         breakpoint: 738,
                         options: {
                             plotOptions: {
                                 bar: {
                                     columnWidth: '35%',
                                     borderRadius: 6
                                 }
                             }
                         }
                     },
                     {
                         breakpoint: 576,
                         options: {
                             plotOptions: {
                                 bar: {
                                     columnWidth: '25%',
                                     borderRadius: 10
                                 }
                             }
                         }
                     },
                     {
                         breakpoint: 500,
                         options: {
                             plotOptions: {
                                 bar: {
                                     columnWidth: '24%',
                                     borderRadius: 8
                                 }
                             }
                         }
                     },
                     {
                         breakpoint: 450,
                         options: {
                             plotOptions: {
                                 bar: {
                                     borderRadius: 6
                                 }
                             }
                         }
                     }
                 ]
             };
         if (typeof averageDailyTrafficEl !== undefined && averageDailyTrafficEl !== null) {
             const averageDailyTraffic = new ApexCharts(averageDailyTrafficEl, averageDailyTrafficConfig);
             averageDailyTraffic.render();
         }
     </script>

     <script>
         const barChart = document.getElementById('barChart');
         if (barChart) {
             const barChartVar = new Chart(barChart, {
                 type: 'bar',
                 data: {
                     labels: [
                         '7/12',
                         '8/12',
                         '9/12',
                         '10/12',
                         '11/12',
                         '12/12',
                         '13/12',
                         '14/12',
                         '15/12',
                         '16/12',
                         '17/12',
                         '18/12',
                         '19/12'
                     ],
                     datasets: [{
                         data: [275, 90, 190, 205, 125, 85, 55, 87, 127, 150, 230, 280, 190],
                         backgroundColor: cyanColor,
                         borderColor: 'transparent',
                         maxBarThickness: 15,
                         borderRadius: {
                             topRight: 15,
                             topLeft: 15
                         }
                     }]
                 },
                 options: {
                     responsive: true,
                     maintainAspectRatio: false,
                     animation: {
                         duration: 500
                     },
                     plugins: {
                         tooltip: {
                             rtl: isRtl,
                             backgroundColor: cardColor,
                             titleColor: headingColor,
                             bodyColor: legendColor,
                             borderWidth: 1,
                             borderColor: borderColor
                         },
                         legend: {
                             display: false
                         }
                     },
                     scales: {
                         x: {
                             grid: {
                                 color: borderColor,
                                 drawBorder: false,
                                 borderColor: borderColor
                             },
                             ticks: {
                                 color: labelColor
                             }
                         },
                         y: {
                             min: 0,
                             max: 400,
                             grid: {
                                 color: borderColor,
                                 drawBorder: false,
                                 borderColor: borderColor
                             },
                             ticks: {
                                 stepSize: 100,
                                 color: labelColor
                             }
                         }
                     }
                 }
             });
         }
     </script>
 @endsection
