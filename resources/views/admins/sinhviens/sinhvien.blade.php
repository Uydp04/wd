@extends('layouts.admin') 

@section('title', 'Quản lý sinh viên')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Danh sách sinh viên</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('sinhvien.create') }}" class="btn btn-primary mb-3">Thêm mới sinh viên</a>
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong> {{ session('success') }} </strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong> {{ session('error') }} </strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <table id="datatable" class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Mã sinh viên</th>
                                    <th>Tên sinh viên</th>
                                    <th>Hình ảnh</th>
                                    <th>Ngày sinh</th>
                                    <th>Số điện thoại</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($sinhviens as $sinhvien) 
                                    <tr>
                                        <td>{{ $sinhvien->id }}</td>
                                        <td>{{ $sinhvien->ma_sinh_vien }}</td>
                                        <td>{{ $sinhvien->ten_sinh_vien }}</td>
                                        <td>
                                            @if ($sinhvien->hinh_anh)
                                                <img src="{{ asset('storage/' . $sinhvien->hinh_anh) }}" alt="Hình ảnh" width="100">
                                            @else
                                                Không có hình ảnh
                                            @endif
                                        </td>
                                        <td>{{ $sinhvien->ngay_sinh }}</td>
                                        <td>{{ $sinhvien->so_dien_thoai }}</td>
                                        <td>{{ $sinhvien->trang_thai ? 'Kích hoạt' : 'Khóa' }}</td>
                                        <td>
                                            <a href="{{ route('sinhvien.edit', $sinhvien->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                                            <form action="{{ route('sinhvien.destroy', $sinhvien->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                                            </form>
                                            <a href="{{ route('sinhvien.show', $sinhvien->id) }}" class="btn btn-primary btn-sm">xem</a>
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
@endsection
@section('JS')
    {{-- <script src="https:////cdn.ckeditor.com/4.8.0/basic/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('mo_ta');
    </script> --}}
@endsection
