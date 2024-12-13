<?php

namespace App\Http\Controllers;

use App\Models\Nhanvien;
use App\Http\Requests\StoreNhanvienRequest;
use App\Http\Requests\UpdateNhanvienRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class NhanvienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nhanviens = DB::table('nhanviens')->orderByDesc('id')->paginate(5);
        return view('admins.nhanviens.index', ['nhanviens' => $nhanviens]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.nhanviens.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNhanvienRequest $request)
    {
        $request->validate([
            'ma_nhan_vien' => 'required|max:20|unique:nhanviens',
            'ten_nhan_vien' => 'required',
            'hinh_anh' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'ngay_vao_lam' => 'required|date',
            'luong' => 'required',
            'trang_thai' => 'required|in:0,1',
        ],[
            'ma_nhan_vien.required' => 'Vui lòng nhập mã nhân viên.',
            'ma_nhan_vien.max' => 'Mã nhân viên không được vượt quá :max ký tự.',
            'ma_nhan_vien.unique' => 'Mã nhân viên đã tồn tại.',

            'ten_nhan_vien.required' => 'Vui lòng nhập tên nhân viên.',

            'hinh_anh.image' => 'File tải lên phải là hình ảnh.',
            'hinh_anh.mimes' => 'File tải lên phải có định dạng: jpeg, png, jpg, gif.',
            'hinh_anh.max' => 'Kích thước file tải lên không được vượt quá :max KB.',

            'ngay_vao_lam.required' => 'Vui lòng nhập ngày vào làm.',
            'ngay_vao_lam.date' => 'Ngày vào làm phải là một ngày hợp lệ.',

            'luong.required' => 'Vui lòng nhập luong.',

            'trang_thai.required' => 'Vui lòng chọn trang thai.',
            'trang_thai.in' => 'Trang thai phải là khoa và không khóa.'
        ]);
        DB::beginTransaction();
        try {
            $data = $request->except('_token', 'hinh_anh');

            if ($request->hasFile('hinh_anh')) {
                $data['hinh_anh'] = $request->file('hinh_anh')->store('images', 'public');
            }

            $data['created_at'] = now();
            $data['updated_at'] = now();

            DB::table('nhanviens')->insert($data);

            DB::commit();
            return redirect()->route('nhanviens.index')->with('success', 'Thêm thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('nhanviens.index')->with('error', 'Có lỗi xảy ra khi thêm !');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Nhanvien $nhanvien)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nhanvien $nhanvien)
    {
        return view('admins.nhanviens.edit', ['nhanvien' => $nhanvien]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNhanvienRequest $request, Nhanvien $nhanvien)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nhanvien $nhanvien)
    {
        DB::beginTransaction();
        try {
            // Xóa hình ảnh cũ
            $oldImage = DB::table('nhanviens')->where('id', $nhanvien->id)->value('hinh_anh');
            if ($oldImage) {
                Storage::disk('public')->delete($oldImage);
            }

            DB::table('nhanviens')->where('id', $nhanvien->id)->delete();

            DB::commit();
            return redirect()->route('nhanviens.index')->with('success', 'Xóa  thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('nhanviens.index')->with('error', 'Có lỗi !');
        }
    }
}
