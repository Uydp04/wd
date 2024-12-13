<?php

namespace App\Http\Controllers;

use App\Models\Sinh_vien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Sinh_vienController extends Controller
{
    public function index()
    {
        $sinhviens = DB::table('sinh_viens')->orderByDesc('id')->paginate(5);
        return view('admins.sinhviens.sinhvien', ['sinhviens' => $sinhviens]);
    }

    public function create()
    {
        return view('admins.sinhviens.createsinhvien');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ma_sinh_vien' => 'required|max:20|unique:sinh_viens',
            'ten_sinh_vien' => 'required',
            'hinh_anh' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'ngay_sinh' => 'required|date',
            'so_dien_thoai' => 'required',
            'trang_thai' => 'required|in:0,1', 
        ],[
            'ma_sinh_vien.required' => 'Bạn cần phải nhập mã sinh viên.',
            'ma_sinh_vien.max' => 'Mã sinh viên không được vượt quá :max ký tự.',
            'ma_sinh_vien.unique' => 'Mã sinh viên này đã tồn tại.',

            'ten_sinh_vien.required' => 'Bạn cần phải nhập tên sinh viên.',

            'hinh_anh.image' => 'File tải lên phải là hình ảnh.',
            'hinh_anh.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif.',
            'hinh_anh.max' => 'Kích thước hình ảnh không được vượt quá :max KB.',

            'ngay_sinh.required' => 'Bạn cần phải nhập ngày sinh.',
            'ngay_sinh.date' => 'Ngày sinh không hợp lệ.',

            'so_dien_thoai.required' => 'Bạn cần phải nhập số điện thoại.',

            'trang_thai.required' => 'Bạn cần phải chọn trạng thái.',
            'trang_thai.in' => 'Trạng thái không hợp lệ.'
        ]);

        DB::beginTransaction();
        try {
            $data = $request->except('_token', 'hinh_anh');

            if ($request->hasFile('hinh_anh')) {
                $data['hinh_anh'] = $request->file('hinh_anh')->store('images', 'public');
            }

            $data['created_at'] = now();
            $data['updated_at'] = now();

            DB::table('sinh_viens')->insert($data);

            DB::commit();
            return redirect()->route('sinhvien.index')->with('success', 'Thêm sinh viên thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('sinhvien.index')->with('error', 'Có lỗi xảy ra khi thêm sinh viên!');
        }
    }
    public function edit($id)
    {
        $sinhvien = DB::table('sinh_viens')->where('id', $id)->first();
        return view('admins.sinhviens.edit', compact('sinhvien'));
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        $request->validate([
            'ma_sinh_vien' => 'required|max:20|unique:sinh_viens,ma_sinh_vien,' . $id,
            'ten_sinh_vien' => 'required',
            'hinh_anh' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'ngay_sinh' => 'required|date',
            'so_dien_thoai' => 'required',
            'trang_thai' => 'required|in:0,1', 
        ], [
            'ma_sinh_vien.required' => 'Bạn cần phải nhập mã sinh viên.',
            'ma_sinh_vien.max' => 'Mã sinh viên không được vượt quá :max ký tự.',
            'ma_sinh_vien.unique' => 'Mã sinh viên này đã tồn tại.',

            'ten_sinh_vien.required' => 'Bạn cần phải nhập tên sinh viên.',

            'hinh_anh.image' => 'File tải lên phải là hình ảnh.',
            'hinh_anh.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif.',
            'hinh_anh.max' => 'Kích thước hình ảnh không được vượt quá :max KB.',

            'ngay_sinh.required' => 'Bạn cần phải nhập ngày sinh.',
            'ngay_sinh.date' => 'Ngày sinh không hợp lệ.',

            'so_dien_thoai.required' => 'Bạn cần phải nhập số điện thoại.',

            'trang_thai.required' => 'Bạn cần phải chọn trạng thái.',
            'trang_thai.in' => 'Trạng thái không hợp lệ.'
        ]);
        //dd($validatedData);
        DB::beginTransaction();
        $data = DB::table('sinh_viens')->where('id', $id)->first();

        try {

            $filePath = $data->hinh_anh; 
            if ($request->hasFile('hinh_anh')) {
                $filePath = $request->file('hinh_anh')->store('images', 'public');
                if ($data->hinh_anh && Storage::disk('public')->exists($data->hinh_anh)) {
                    Storage::disk('public')->delete($data->hinh_anh);
                }
            }
            $data =[
                'ma_sinh_vien' => $request->input('ma_sinh_vien'),
                'ten_sinh_vien' => $request->input('ten_sinh_vien'),
                'ngay_sinh' => $request->input('ngay_sinh'),
                'hinh_anh' => $filePath,
                'so_dien_thoai' => $request->input('so_dien_thoai'),
                'trang_thai' => $request->input('trang_thai'),  
            ];
            //dd($data);
            DB::table('sinh_viens')->where('id', $id)->update($data);
           // dd($data);
            DB::commit();
            return redirect()->route('sinhvien.index')->with('success', 'Cập nhật sinh viên thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('sinhvien.index')->with('error', 'Có lỗi xảy ra khi cập nhật sinh viên!');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            // Xóa hình ảnh cũ
            $oldImage = DB::table('sinh_viens')->where('id', $id)->value('hinh_anh');
            if ($oldImage) {
                Storage::disk('public')->delete($oldImage);
            }

            DB::table('sinh_viens')->where('id', $id)->delete();

            DB::commit();
            return redirect()->route('sinhvien.index')->with('success', 'Xóa sinh viên thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('sinhvien.index')->with('error', 'Có lỗi xảy ra khi xóa sinh viên!');
        }
    }
    public function show($id)
    {
        $sinhvien = DB::table('sinh_viens')->where('id', $id)->first();
        return view('admins.sinhviens.show', compact('sinhvien'));
    }
}