@extends('business.layouts.allbooking')
@section('menu')
@extends('business.sidebar.allrating')
@endsection
@section('content')
{{-- message --}}
{!! Toastr::message() !!}
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <div class="mt-5">
                        <h4 class="card-title float-left mt-2">Quản lý đánh giá</h4>
                        <!--<button class="btn btn-primary float-right veiwbutton" type="submit">Xóa</button>-->
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body booking_card">
                        <div class="table-responsive">
                            <table class="datatable table table-stripped table table-hover table-center mb-0">
                                <thead>
                                    <tr>

                                        <th>Mã</th>
                                        <th>Tên khách hàng</th>
                                        <th>Tên dịch vụ</th>
                                        <th>Mã đặt</th>
                                        <th>Đánh giá</th>
                                        <th>Nhận xét</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allRatings as $ratings)

                                    <tr>
                                        <td>{{ $ratings->id }}</td>
                                        <td>{{ $ratings->customers->last_name . ' ' . $ratings->customers->first_name}}</td>
                                        <td>{{ $ratings->services->service_name }}</td>
                                        <td>{{ $ratings->bookings_id }}</td>
                                        <td>{{ $ratings->rate}}</td>
                                        <td>{{ $ratings->comment }}</td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
{{-- End Model delete --}}
</div>
@section('script')

@endsection

@endsection