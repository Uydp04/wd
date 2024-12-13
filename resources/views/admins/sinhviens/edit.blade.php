@extends('layouts.admin')

@section('title', 'Chỉnh sửa sinh viên')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Chỉnh sửa sinh viên</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('sinhvien.update', $sinhvien->id) }}" method="POST" enctype="multipart/form-data"> 
                            @csrf
                            @method('PUT') 

                            <div class="mb-3">
                                <label for="ma_sinh_vien" class="form-label">Mã sinh viên</label>
                                <input type="text" class="form-control @error('ma_sinh_vien') is-invalid @enderror" id="ma_sinh_vien" name="ma_sinh_vien" value="{{ old('ma_sinh_vien', $sinhvien->ma_sinh_vien) }}" readonly> 
                                @error('ma_sinh_vien')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="ten_sinh_vien" class="form-label">Tên sinh viên</label>
                                <input type="text" class="form-control @error('ten_sinh_vien') is-invalid @enderror" id="ten_sinh_vien" name="ten_sinh_vien" value="{{ old('ten_sinh_vien', $sinhvien->ten_sinh_vien) }}"> 
                                @error('ten_sinh_vien')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="hinh_anh" class="form-label">Hình ảnh</label>
                                <input type="file" class="form-control @error('hinh_anh') is-invalid @enderror" id="hinh_anh" name="hinh_anh">
                                @error('hinh_anh')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if ($sinhvien->hinh_anh)
                                    <img src="{{ asset('storage/' . $sinhvien->hinh_anh) }}" alt="Hình ảnh hiện tại" width="100" class="mt-2">
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="ngay_sinh" class="form-label">Ngày sinh</label>
                                <input type="date" class="form-control @error('ngay_sinh') is-invalid @enderror" id="ngay_sinh" name="ngay_sinh" value="{{ old('ngay_sinh', $sinhvien->ngay_sinh) }}"> 
                                @error('ngay_sinh')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="so_dien_thoai" class="form-label">Số điện thoại</label>
                                <input type="text" class="form-control @error('so_dien_thoai') is-invalid @enderror" id="so_dien_thoai" name="so_dien_thoai" value="{{ old('so_dien_thoai', $sinhvien->so_dien_thoai) }}"> 
                                @error('so_dien_thoai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="trang_thai" class="form-label">Trạng thái</label>
                                <select class="form-select @error('trang_thai') is-invalid @enderror" id="trang_thai" name="trang_thai">
                                    <option value="1" {{ old('trang_thai', $sinhvien->trang_thai) == 1 ? 'selected' : '' }}>Kích hoạt</option> 
                                    <option value="0" {{ old('trang_thai', $sinhvien->trang_thai) == 0 ? 'selected' : '' }}>Khóa</option> 
                                </select>
                                @error('trang_thai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('JS')
    <script src="https:////cdn.ckeditor.com/4.8.0/basic/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('mo_ta');
    </script>
@endsection
