@extends('business.layouts.allbooking')
@section('menu')
@extends('business.sidebar.serviceadd')
@endsection
@section('content')
{{-- message --}}
{!! Toastr::message() !!}
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title mt-5">Thêm dịch vụ du lịch</h3>
                </div>
            </div>
        </div>
        <form action="{{ route('form/service/save') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="row formtype">
                        <div class="col-md-11">
                            <div class="form-group">
                                <label>Tên dịch vụ</label>
                                <input type="text" class="form-control @error('service_name') is-invalid @enderror" name="service_name" value="{{ old('service_name') }}">
                            </div>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group">
                                <label>Mô tả</label>
                                <div>
                                    <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group">
                                <label>Giá</label>
                                <div>
                                    <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}">
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

                        <div class="col-md-11">
                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <div>
                                    <img id="preview-image" class="mb-5" src="" alt="Hình ảnh" style="width: 100px; height: 100px;">
                                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" value="{{ old('image') }}">
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
@section('script')
<script>
    $(function() {
        $('#datetimepicker3').datetimepicker({
            format: 'LT'
        });
    });
</script>

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

@endsection