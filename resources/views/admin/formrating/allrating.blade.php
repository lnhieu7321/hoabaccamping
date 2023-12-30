@extends('admin.layouts.allbooking')
@section('menu')
@extends('admin.sidebar.allrating')
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
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($alladRatings as $ratings)

                                    <tr>
                                        <td>{{ $ratings->id }}</td>
                                        <td>{{ $ratings->customers->last_name . ' ' . $ratings->customers->first_name}}</td>
                                        <td>{{ $ratings->services->service_name }}</td>
                                        <td>{{ $ratings->bookings_id }}</td>
                                        <td>{{ $ratings->rate}}</td>
                                        <td>{{ $ratings->comment }}</td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v ellipse_color"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item bookingDelete" href="#" data-toggle="modal" data-target="#delete_asset">
                                                        <i class="fas fa-trash-alt m-r-5"></i> Xóa
                                                    </a>
                                                </div>
                                            </div>
                                        </td>

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
    {{-- Model delete --}}
    <div class="modal fade" id="delete_asset">
        <div class="modal-dialog">
            <form action="{{ route('adminrating/delete', $ratings->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Xác nhận xóa</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Bạn có chắc chắn muốn xóa dịch vụ này không?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- End Model delete --}}
</div>


@endsection