@extends('admin.layouts.allbooking')
@section('menu')
@extends('admin.sidebar.allbooking')
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
                        <h4 class="card-title float-left mt-2">Quản lý đặt chỗ</h4>
                        <!--<button class="btn btn-primary float-right veiwbutton" type="submit">Xóa</button>-->
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body booking_card">
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input type="text" class="input-sm form-control" placeholder="Search">
                                <span class="input-group-btn">
                                    <button class="btn btn-sm btn-default btn-search" type="button">Go!</button>
                                </span>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="datatable table table-stripped table table-hover table-center mb-0 table-filter b-t b-light" id="myTable">
                                <thead>
                                    <tr>

                                        <th>Mã đơn</th>
                                        <th>Tên khách hàng</th>
                                        <th>Dạng đặt</th>
                                        <th>Vé người lớn</th>
                                        <th>Từ ngày</th>
                                        <th>Đến ngày</th>
                                        <th>Tổng tiền</th>
                                        <th>Email</th>
                                        <th>số điện thoại</th>
                                        <th>Trang thái</th>
                                        <th class="text-right">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($alladBooking as $adbookings)

                                    <tr>
                                        <td>{{ $adbookings->id }}</td>
                                        <td>{{ $adbookings->customers->last_name . ' ' . $adbookings->customers->first_name ?? '' }}
                                        </td>
                                        <td>{{ $adbookings->type_of_day }}</td>
                                        <td>{{ $adbookings->number_of_adults }}</td>
                                        <td>{{ $adbookings->start_date }}</td>
                                        <td>{{ $adbookings->end_date }}</td>
                                        <td>{{number_format( $adbookings->total_cost,  0, '.', ','). ' ₫'}}</td>
                                        <td>{{ $adbookings->customers->users->email ?? ''}}</td>
                                        <td>{{ $adbookings->customers->users->phone ?? ''}}</td>
                                        <td>
                                            <div class="actions"> <a href="#" class="btn btn-sm bg-success-light mr-2">{{ $adbookings->status_book }}</a> </div>

                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v ellipse_color"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="{{ route('adminapproveBooking', $adbookings->id) }}">
                                                        <i class="fas fa-check m-r-5"></i> Duyệt
                                                    </a>
                                                    <a class="dropdown-item bookingDelete" href="{{ route('admincancelBooking', $adbookings->id) }}">
                                                        <i class="fas fa-times m-r-5"></i> Hủy
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

</div>

<script>
    $(document).ready(function() {
        $("#myTable").on("click", ".btn-search", function() {
            var searchTerm = $(this).prev("input").val();
            // Lọc nội dung bảng dựa trên searchTerm
        });
    });
</script>



@endsection