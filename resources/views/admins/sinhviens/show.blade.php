@extends('layouts.admin')

@section('title', 'Chi tiết sinh viên')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Chi tiết sinh viên</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-4 mb-3">
                            <div class="col-sm">
                                <div class="d-flex justify-content-sm-end">
                                    <a href="{{ route('sinhvien.edit', $sinhvien->id) }}" class="btn btn-success">
                                        <i class="ri-edit-line align-bottom me-1"></i> Chỉnh sửa
                                    </a>
                                    <form action="{{ route('sinhvien.destroy', $sinhvien->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                            <i class="ri-delete-bin-line align-bottom me-1"></i> Xóa
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            @if ($sinhvien->hinh_anh)
                                <img src="{{ asset('storage/' . $sinhvien->hinh_anh) }}" alt="Hình ảnh sinh viên" class="img-thumbnail avatar-xl rounded-circle">
                            @else
                                <i class="ri-user-2-line avatar-xl rounded-circle"></i>
                            @endif
                            <h5 class="mb-1 mt-3">{{ $sinhvien->ten_sinh_vien }}</h5>
                            <p class="text-muted">{{ $sinhvien->ma_sinh_vien }}</p>
                        </div>

                        <div class="mt-4">
                            <h5 class="fs-15">Thông tin chi tiết</h5>
                            <div class="table-responsive">
                                <table class="table table-borderless mb-0">
                                    <tbody>
                                        <tr>
                                            <th class="ps-0" scope="row">Mã sinh viên :</th>
                                            <td class="text-muted">{{ $sinhvien->ma_sinh_vien }}</td>
                                        </tr>
                                        <tr>
                                            <th class="ps-0" scope="row">Tên sinh viên :</th>
                                            <td class="text-muted">{{ $sinhvien->ten_sinh_vien }}</td>
                                        </tr>
                                        <tr>
                                            <th class="ps-0" scope="row">Ngày sinh :</th>
                                            <td class="text-muted">{{ $sinhvien->ngay_sinh }}</td>
                                        </tr>
                                        <tr>
                                            <th class="ps-0" scope="row">Số điện thoại :</th>
                                            <td class="text-muted">{{ $sinhvien->so_dien_thoai }}</td>
                                        </tr>
                                        <tr>
                                            <th class="ps-0" scope="row">Trạng thái :</th>
                                            <td class="text-muted">{{ $sinhvien->trang_thai ? 'Kích hoạt' : 'Khóa' }}</td>
                                        </tr>
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