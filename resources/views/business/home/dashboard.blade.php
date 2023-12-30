@extends('business.layouts.master')
@section('menu')
@extends('business.sidebar.dashboard')
@endsection
@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12 mt-5">
                    <h3 class="page-title mt-3">Hi, {{ Auth::user()->name }}</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active">Trang chủ</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="statistics-details d-flex align-items-center justify-content-between mb-5">
                    <div>
                        <p class="statistics-title">Số lượng dịch vụ</p>
                        <h3 class="rate-percentage">{{$totalServices}}</h3>
                    </div>

                    <div>
                        <p class="statistics-title">Số lượt đặt vé</p>
                        <h3 class="rate-percentage">{{$totalBookings}}</h3>
                    </div>

                    <div>
                        <p class="statistics-title">Số lượng đánh giá</p>
                        <h3 class="rate-percentage">{{$totalRatings}}</h3>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 d-flex">
                <div class="card card-chart flex-fill">
                    <div class="card-header">
                        <h4 class="card-title">Biểu đồ thống kê doanh thu theo tháng</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    var ctx = document.getElementById('revenueChart').getContext('2d');
    var labels = $formattedDates;
    var data = $revenues;
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Monthly Revenue',
                data: $revenues,
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

@endsection