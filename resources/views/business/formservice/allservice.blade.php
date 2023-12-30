@extends('business.layouts.allbooking')
@section('menu')
@extends('business.sidebar.allservice')
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
                        <h4 class="card-title float-left mt-2">Quản lý dịch vụ</h4>
                        <a href="{{ route('form/serviceadd') }}" class="btn btn-primary float-right veiwbutton ">Thêm</a>
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
                                        <th>Mã dịch vụ</th>
                                        <th>Tên dịch vụ</th>
                                        <th class="col-md-4">Mô tả</th>
                                        <th>Hình ảnh</th>
                                        <th>Giá chung</th>
                                        <th>Địa chỉ</th>
                                        <th>Phường/ Quận</th>
                                        <th>Thành Phố</th>
                                        <th>Quốc gia</th>
                                        <th class="text-right">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allServices as $services )
                                    <tr>
                                        <td>{{ $services->id }}</td>
                                        <td>{{ $services->service_name }}</td>
                                        <td class="col-md-4">
                                            <span data-toggle="tooltip" data-placement="top" title="{{ $services->description }}">{{ Str::limit($services->description, 50, '...') }}</span>
                                        </td>
                                        <td>
                                            @if ($services->images->count())
                                            <img src="{{ $services->images->first()->url }}" alt="{{ $services->service_name }}" width="100px">
                                            @else
                                            <span>Không có hình ảnh</span>
                                            @endif
                                        </td>
                                        <td>{{number_format( $services->price,  0, '.', ','). ' ₫'}}</td>
                                        <td>{{ $services->address }}</td>
                                        <td>{{ $services->ward . ', ' . $services->district ?? '' }}
                                        </td>
                                        <td>{{ $services->city }}</td>
                                        <td>{{ $services->country }}</td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v ellipse_color"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">

                                                    <a class="dropdown-item" href="{{ route('form/serviceedit', $services->id) }}">
                                                        <i class="fas fa-pencil-alt m-r-5"></i> Sửa
                                                    </a>
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
            <form action="{{ route('form/service/delete', $services->id) }}" method="POST">
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
@section('script')
{{-- delete model --}}

@endsection
@endsection