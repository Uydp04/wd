{{-- Để kế thừa lại master layout ta sử dụng extends --}}
@extends('layouts.admin')
{{-- Một file chỉ được kế thừa 1 master layout --}}

@section('title')
    Quản lý sản phẩm
@endsection

@section('CSS')
@endsection

{{-- @section: dùng để chị định phần nội dụng được hiển thị --}}
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Quản lý sản phẩm</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                            <li class="breadcrumb-item active">Thêm mới sản phẩm</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col">

                <div class="h-100">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    @if ($sanPham->hinh_anh)
                                        <img src="{{ asset('storage/' . $sanPham->hinh_anh) }}" alt="{{ $sanPham->ten_san_pham }}" class="img-fluid">
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <h5 class="card-title">{{ $sanPham->ten_san_pham }}</h5>
                                    <p class="card-text">
                                        <strong>Mã sản phẩm:</strong> {{ $sanPham->ma_san_pham }}<br>
                                        <strong>Giá:</strong> {{ number_format($sanPham->gia) }} VNĐ<br>
                                        @if ($sanPham->gia_khuyen_mai)
                                            <strong>Giá khuyến mãi:</strong> {{ number_format($sanPham->gia_khuyen_mai) }} VNĐ<br>
                                        @endif
                                        <strong>Số lượng:</strong> {{ $sanPham->so_luong }}<br>
                                        <strong>Ngày nhập:</strong> {{ $sanPham->ngay_nhap }}<br>
                                        <strong>Mô tả:</strong> {{ $sanPham->mo_ta }}<br>
                                        <strong>Trạng thái:</strong> {{ $sanPham->trang_thai ? 'Còn hàng' : 'Hết hàng' }}
                                    </p>
                                    <a href="{{ route('sanphams.index') }}" class="btn btn-primary">Quay lại danh sách</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end card -->

            </div> <!-- end .h-100-->

        </div> <!-- end col -->
    </div>

    </div>
@endsection

@section('JS')
    <script src="https:////cdn.ckeditor.com/4.8.0/basic/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('mo_ta');
    </script>
@endsection