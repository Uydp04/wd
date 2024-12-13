<?php

namespace App\Http\Controllers;

use App\Models\BaiViet;
use App\Http\Requests\StoreBaiVietRequest;
use App\Http\Requests\UpdateBaiVietRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Storage;

class BaiVietController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $baiviets = BaiViet::orderByDesc('id')->paginate(5);
        //dd($baiviets);
        return UserResource::collection($baiviets);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBaiVietRequest $request)
    {
        // Xử lý hình ảnh
        $filePath = null;
        if ($request->hasFile('hinh_anh')) {
            $filePath = $request->file('hinh_anh')->store('uploads/sanpham', 'public');
        }

        // Xử lý thêm dữ liệu
        $dataBaiviet = [
            'hinh_anh' => $filePath,
            'tieu_de' => $request->input('ma_san_pham'),
            'noi_dung' => $request->input('noi_dung'),
            'ngay_dang' => $request->input('ngay_dang'),
            'trang_thai' => $request->input('trang_thai'),
        ];

        //lưu dữ liệu vào database
        $baiviet = BaiViet::create($dataBaiviet);
        return response()->json([
            'message' => 'Bai viet tao thanh cong',
            'data' => new UserResource($baiviet)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(BaiViet $baiviet)
    {
        
        //dd($baiViet);
        if ($baiviet) {
            return new UserResource($baiviet);
        }else {
            return response()->json([
                'message' => 'Bai viet khong ton tai'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BaiViet $baiViet)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBaiVietRequest $request, BaiViet $baiViet)
    {

         // Xử lý hình ảnh
         $filePath = $baiViet->hinh_anh; // Giữ nguyên hình ảnh cũ nếu có
         if ($request->hasFile('hinh_anh')) {
             $filePath = $request->file('hinh_anh')->store('uploads/sanpham', 'public');

             // Xóa hình cũ nếu có hình ảnh mới đẩy lên
             if ($baiViet->hinh_anh && Storage::disk('public')->exists($baiViet->hinh_anh)) {
                 Storage::disk('public')->delete($baiViet->hinh_anh);
             }
         }

         // Xử lý cập nhật dữ liệu
         $dataBaiviet = [
            'hinh_anh' => $filePath,
            'tieu_de' => $request->input('ma_san_pham'),
            'noi_dung' => $request->input('noi_dung'),
            'ngay_dang' => $request->input('ngay_dang'),
            'trang_thai' => $request->input('trang_thai'),  
         ];
         // Kiểm tra xem đã lấy được đủ dữ liệu lên chưa
         // dd($dataSanPham);

         // Lưu dữ liệu vào database
         //DB::table('san_phams')->where('id', $id)->update($dataSanPham);
         $baiViet->update($dataBaiviet);
         return response()->json([
             'message' => 'Bai viet cap nhat thanh cong',
             'data' => new UserResource($baiViet)
         ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BaiViet $baiViet)
    {
        if (!$baiViet) {
            return response()->json([
                'message' => 'Bai viet khong ton tai'
            ]);
        }

        // Lưu trữ đường dẫn của hình ảnh vào đây
        $filePath = $baiViet->hinh_anh;

        //$deleteBaiViet = DB::table('san_phams')->where('id', $id)->delete();
        $deleteBaiViet = $baiViet->delete();
        // Nếu xóa thành công thì tiến hành xóa ảnh
        if ($deleteBaiViet) {
            if (isset($filePath) && Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }
            return response()->json([
                'message' => 'Xoa bai viet thanh cong'
            ]);
        }
        return response()->json([
            'message' => 'Xoa bai viet that bai'
        ]);
    }
}
