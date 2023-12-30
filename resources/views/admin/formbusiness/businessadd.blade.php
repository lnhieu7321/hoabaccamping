@extends('admin.layouts.allbooking')
@section('menu')
@extends('admin.sidebar.serviceadd')
@endsection
@section('content')
{{-- message --}}
{!! Toastr::message() !!}
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title mt-5">Thêm tài khoản doanh nghiệp</h3>
                </div>
            </div>
        </div>
        <form action="{{ route('adminbusiness/save') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="row formtype">
                        <div class="col-md-11">
                            <div class="form-group">
                                <label>Tên tài khoản</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
                            </div>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group">
                                <label>Email</label>
                                <div>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <div>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group">
                                <label>Tên doanh nghiệp</label>
                                <div>
                                    <input type="text" class="form-control @error('business_name') is-invalid @enderror" name="business_name" value="{{ old('business_name') }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-11">
                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <div>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group">
                                <label>Phường(xã)</label>
                                <div>
                                    <input type="text" class="form-control @error('ward') is-invalid @enderror" name="ward" value="{{ old('ward') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group">
                                <label>Quận(huyện)</label>
                                <input type="text" class="form-control @error('district') is-invalid @enderror" name="district" value="{{ old('district') }}">
                            </div>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group">
                                <label>Tỉnh(Thành phố)</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary buttonedit1">Lưu</button>
        </form>
    </div>
</div>


@endsection