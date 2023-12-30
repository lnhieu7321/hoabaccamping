@extends('admin.layouts.master')
@section('menu')
@extends('admin.sidebar.dashboard')
@endsection
@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12 mt-5">
                    <h3 class="page-title mt-3">Hi, {{ Auth::user()->name }}</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active">Dashboard</li>
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
            <div class="col-md-12 col-lg-6">
                <div class="card card-chart">
                    <div class="card-header">
                        <h4 class="card-title">VISITORS</h4>
                    </div>
                    <div class="card-body">
                        <div id="line-chart"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-6">
                <div class="card card-chart">
                    <div class="card-header">
                        <h4 class="card-title">ROOMS BOOKED</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('vendor/nnnick/chartjs/Chart.min.js') }}"></script>

@endsection