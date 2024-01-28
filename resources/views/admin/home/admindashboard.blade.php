@extends('admin.layouts.master')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12 mt-5">
                    <h3 class="page-title mt-3">Xin chào, {{ Auth::user()->name }}</h3>
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
                        <p class="statistics-title">Số dịch vụ</p>
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
                    <div>
                        <p class="statistics-title">Số lượng người dùng</p>
                        <h3 class="rate-percentage">{{$user_count}}</h3>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 d-flex">
                <div class="card card-chart flex-fill">
                    <div class="card-header">
                        <h4 class="card-title">Biểu đồ thống kê doanh thu theo tháng</h4>
                    </div>

                    <div class="card-body">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col">
                <div>
                    <div class="card card-chart flex-fill">
                        <div class="card-header">
                            <h4 class="card-title">Biểu đồ số lượt đặt theo trạng thái</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="book-counts-chart"></canvas>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="card card-chart flex-fill">
                        <div class="card-header">
                            <h4 class="card-title">Biểu đồ số lượt đánh giá</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="rating-chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('vendor/nnnick/chartjs/Chart.min.js') }}"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($formattedDates); ?>,
            datasets: [{
                label: 'Doanh thu',
                data: <?php echo json_encode($revenues); ?>,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
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
<script>
    var ctx = document.getElementById('book-counts-chart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['đã duyệt', 'chờ duyệt', 'từ chối', 'đã hủy'],
            datasets: [{
                data: <?php echo json_encode($bookCounts); ?>,
                label: 'Số lượt đặt',
                backgroundColor: [
                    '#0088FF',
                    '#00FF00',
                    '#FFFF00',
                    '#FF0000',
                ],
            }],
        },
        options: {
            title: {
                text: 'Biểu đồ lượt book',
            },
        },
    });
</script>
<script>
    var ctx = document.getElementById('rating-chart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['1', '2', '3', '4', '5'],
            datasets: [{
                data: [<?php echo json_encode($onestar); ?>, <?php echo json_encode($twostar); ?>, <?php echo json_encode($therestar); ?>, <?php echo json_encode($fourstar); ?>, <?php echo json_encode($fivestar); ?>],
                label: 'Số lượt đánh giá',
                backgroundColor: [
                    '#FF0000',
                    '#0088FF',
                    '#00FF00',
                    '#FFFF00',
                    '#00FFFF',
                ],
            }],
        },
        options: {
            title: {
                text: 'Biểu đồ lượt book',
            },
        },
    });
</script>

@endsection