@extends('admin.layouts.allbusiness')

@section('content')
{{-- message --}}
{!! Toastr::message() !!}
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <div class="mt-5">
                        <h4 class="card-title float-left mt-4">Quản lý Doanh Nghiệp</h4>
                        <div class="top-nav-search float-left">
                            <form method="get" action="{{route('adminsearch.business')}}">
                                <input type="search" name="query" placeholder="Tìm kiếm..." class="form-control">
                                <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                            </form>
                        </div>
                        <a href="{{ route('form/adbusinessadd') }}" class="btn btn-primary float-right veiwbutton ">Thêm</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body booking_card">
                        <div class="col-sm-3">
                        </div>
                        <div class="table-responsive">
                            <table class="datatable table table-stripped table table-hover table-center mb-0 table-filter b-t b-light" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Mã tài khoản</th>
                                        <th>Tên tài khoản</th>
                                        <th>Email</th>
                                        <th>Tên doanh nghiệp</th>
                                        <th>Số điện thoại</th>
                                        <th>Địa chỉ</th>
                                        <th>Xã/ Phường</th>
                                        <th>Quận/ Huyện</th>
                                        <th>Thành Phố</th>
                                        <th>Trạng thái</th>
                                        <th class="text-right">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allbusinesses as $business )
                                    <tr>
                                        <td>{{ $business->id }}</td>
                                        <td>{{ $business->name }}</td>
                                        <td>{{ $business->email }}</td>
                                        <td><img src="{{ $business->businesses->logo }}" width="40" height="40" class="rounded-circle mr-4">{{ $business->businesses->business_name}}</td>
                                        <td>{{ $business->phone }}</td>
                                        <td>{{ $business->businesses->address }}</td>
                                        <td>{{ $business->businesses->ward }}</td>
                                        <td>{{ $business->businesses->district }}</td>
                                        <td>{{ $business->businesses->city }}</td>
                                        <td>
                                            <div class="actions"> <a href="#" class="btn btn-sm bg-success-light mr-2">{{ $business->user_statuses->state_name }}</a> </div>

                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v ellipse_color"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">

                                                    <a class="dropdown-item" href="{{ route('admincancelBusiness', $business->id) }}">
                                                        <i class="fas fa-lock m-r-5"></i> Khóa
                                                    </a>
                                                    <a class="dropdown-item" href="{{ route('adminapproveBusiness', $business->id) }}">
                                                        <i class="fas fa-unlock m-r-5"></i> Mở khóa
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


@endsection