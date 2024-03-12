@extends('admin.layouts.app')
@section('title_page')
    <div class="app-navbar-item ms-1 ms-md-3">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                Dashboard</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <a href="/admin" class="text-muted text-hover-primary">Admin</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">Dashboard</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
    </div>
@endsection
@section('contents')
    <style>
        h3 {
            text-transform: uppercase;
        }
    </style>
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Row-->
        <div class="row mx-5 p-5 mt-4">
            <div class="text-center">
                <h1 class="mb-5">Thông kê số lượng</h1>
            </div>
            <div class="col">
                <div class="card p-5 mx-0">
                    <h3>Người dùng: {{ $report['countUser'] }}</h3>
                </div>
            </div>
            <div class="col">
                <div class="card p-5 mx-0">
                    <h3>Đơn hàng: {{ $report['countOrder'] }} đơn </h3>
                </div>
            </div>
            <div class="col">
                <div class="card p-5 mx-0">
                    <h3>Sản phẩm : {{ $report['countProduct'] }}</h3>
                </div>
            </div>
            <div class="col">
                <div class="card p-5 mx-0">
                    <h3>Danh mục: {{ $report['countCategory'] }}</h3>
                </div>
            </div>
        </div>
        <!--end::Row-->
        <!--begin::Row-->
        <div class="row g-5 g-xl-10 mt-3 mb-5 mb-xl-10 mx-5">
            <!--begin::Col-->
            <div class="text-center">
                <h1>Biểu đồ bán hàng</h1>
            </div>
            <div class="col-xxl-8">
                <!--begin::Chart widget 38-->
                <div class="card card-flush h-md-100">
                    <!--begin::Header-->
                    <div class="card-header">
                        <!--begin::Title-->
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">Lượng mua hàng</span>
                            <span class="text-gray-400 mt-1 fw-bold fs-6">Số lượng mua hàng của user</span>
                        </h3>
                        <!--end::Title-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body d-flex align-items-end px-0 pt-3 pb-5">
                        <!--begin::Chart-->
                        <div class="w-100 min-h-auto pe-6">
                            <div class="card-body">
                                <canvas id="chBar"></canvas>
                            </div>
                        </div>
                        <!--end::Chart-->
                    </div>
                    <!--end: Card Body-->
                </div>
                <!--end::Chart widget 38-->
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xxl-4">
                <!--begin::Engage widget 1-->
                <div class="card h-md-100" dir="ltr">
                    <!--begin::Header-->
                    <div class="card-header">
                        <!--begin::Title-->
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">Tỉ lệ đơn hàng</span>
                        </h3>
                        <!--end::Title-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body">
                        <canvas id="doughnutChart"></canvas>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Engage widget 1-->
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>
@endsection
@push('scripts')
    <script>
        <?php if($chartSP) { ?>
        // chart colors
        var colors = ['#3E97FF', '#E1E3EA', '#70FD8A'];
        /* bar chart */
        var chBar = document.getElementById("chBar");
        if (chBar) {
            new Chart(chBar, {
                type: 'bar',
                data: {
                    labels: <?= json_encode($chartSP['label']) ?>,
                    datasets: [{
                        label: 'Đơn hàng',
                        data: <?= json_encode($chartSP['data']) ?>,
                        backgroundColor: colors[0]
                    }]

                },
                options: {
                    plugins: {
                        legend: {
                            display: false,
                        }
                    },
                    scales: {
                        xAxes: [{
                            barPercentage: 0.4,
                            categoryPercentage: 0.5
                        }]
                    }
                }
            });
        }
        <?php } ?>
        //doughnut
        <?php if($chartOrders) { ?>
        var ctxD = document.getElementById("doughnutChart");
        var myLineChart = new Chart(ctxD, {
            type: 'doughnut',
            data: {
                labels: ['Đơn hàng đã hủy', 'Đơn hàng đang chuyển', 'Đơn hàng thành công'],
                datasets: [{
                    data: <?= json_encode($chartOrders) ?>,
                    backgroundColor: ["#f1416c", "#009ef7", "#50cd89"],
                    hoverBackgroundColor: ["#f1416c", "#009ef7", "#50cd89"]
                }]
            },
            options: {
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                responsive: true
            }
        });
        <?php } ?>
    </script>
@endpush
