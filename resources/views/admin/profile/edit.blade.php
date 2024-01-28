@extends('admin.layouts.master')

@section('content')
{{-- message --}}
{!! Toastr::message() !!}
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title mt-5">Chỉnh sửa thông tin</h3>
                </div>
            </div>
        </div>
        <form action="{{route('admin/profile/update')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="row formtype">
                        <div class="col-md-11">
                            <div class="form-group">
                                <img id="preview-image" class="mb-5" src="{{$admin->logo}}" alt="Hình ảnh" style="width: 100px; height: 100px; border-radius: 50%; border: none;">
                                <input type="file" name="image" class="form-control @error('logo') is-invalid @enderror" value="{{ $admin->logo }}">
                            </div>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group">
                                <label>Tên tài khoản</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}">
                            </div>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group">
                                <label>Email</label>
                                <div>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <div>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $user->phone }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group">
                                <label>Tên quản trị</label>
                                <div>
                                    <input type="text" class="form-control @error('admin_name') is-invalid @enderror" name="admin_name" value="{{ $admin->admin_name }}">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary buttonedit1">Lưu</button>
        </form>
    </div>
</div>

<script>
    const imageInput = document.querySelector('input[type="file"]');
    const previewImage = document.querySelector('#preview-image');

    imageInput.addEventListener('change', (event) => {
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = (event) => {
            previewImage.src = event.target.result;
        };

        reader.readAsDataURL(file);
    });
</script>


@endsection