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
                            <li class="breadcrumb-item active">Danh sách sản phẩm</li>
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
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Danh sách nhân viên</h4>
                            <a href="{{ route('nhanviens.create') }}" class="btn btn-soft-success material-shadow-none">
                                <i class="ri-add-circle-line align-middle me-1"></i>
                                Thêm nhân viên
                            </a>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="live-preview">
                                <div class="table-responsive">
                                    {{-- @if (session('success'))
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
                                    @endif --}}


                                    <table class="table table-striped table-nowrap align-middle mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">STT</th>
                                                <th scope="col">Mã nhân viên</th>
                                                <th scope="col">Hình ảnh</th>
                                                <th scope="col">ngày vào làm</th>
                                                <th scope="col">lương</th>
                                                <th scope="col">Trạng thái</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($nhanviens as $index => $nhanvien)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $nhanvien->ma_nhan_vien }}</td>
                                                <td>
                                                    <img src="{{ asset('storage/' . $nhanvien->hinh_anh) }}" alt="Hình ảnh" width="100">    
                                                </td>
                                                <td>{{ $nhanvien->ngay_vao_lam }}</td>
                                                <td>{{ $nhanvien->luong }}</td>
                                                <td>
                                                    @if ($nhanvien->trang_thai == 1)
                                                        <span class="badge bg-success">Hoạt động</span>
                                                    @else   
                                                        <span class="badge bg-danger">Khóa</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('nhanviens.edit', $nhanvien->id) }}"
                                                        class="btn btn-soft-info material-shadow-none">
                                                        <i class="ri-edit-2-line align-middle"></i>
                                                    </a>
                                                    <form action="{{ route('nhanviens.destroy', $nhanvien->id) }}" method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-soft-danger material-shadow-none" onclick="return confirm('Ban co chac chan muon xoa khong?')">
                                                            <i class="ri-delete-bin-line align-middle"></i> 
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="mt-3">
                                        {{-- {{ $nhanviens->links('pagination::bootstrap-5') }} --}}
                                    </div>
                                </div>
                            </div>

                        </div><!-- end card-body -->
                    </div><!-- end card -->

                </div> <!-- end .h-100-->

            </div> <!-- end col -->
        </div>

    </div>
@endsection

@section('JS')
@endsection