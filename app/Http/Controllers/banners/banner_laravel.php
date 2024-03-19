<?php

namespace App\Http\Controllers\banners;

use App\Http\Controllers\Controller;
use App\Models\make_lavarel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;





class banner_laravel extends Controller
{
    // Lay danh sach

    public function list() {
        $banners = make_lavarel::query()->get();
        return view('clients.banner.list', ['banners'=>$banners]);
    }



    // Tao moi banner
    public function store(Request $request){

        if($request->method() == 'POST'){

            // Gán ràng buộc cho các thuộc tính
//            $rules = [
//               'background' => 'required|min:6',
//               'button' => 'required|min:6',
//               'button_link' => 'required|min:6',
//               'content' => 'required|min:8',
//               'order' => 'required|integer',
//            ];
//            $messages = [
//               'background.required' => ':Attribute bắt buộc phải nhập',
//               'background.min' => ':Attribute không được nhỏ hơn :min kí tự',
//               'button.required' => ':Attribute bắt buộc phải nhập',
//               'button.min' => ':Attribute không được nhỏ hơn :min kí tự',
//               'button_link.required' => ':Attribute bắt buộc phải nhập',
//               'button_link.min' => ':Attribute không được nhỏ hơn :min kí tự',
//               'content.required' => ':Attribute bắt buộc phải nhập',
//               'content.min' => ':Attribute không được nhỏ hơn :min kí tự',
//               'order.required' => ':Attribute bắt buộc phải nhập',
//               'order.integer' => ':Attribute phải là số',
//            ];
//            $request->validate($rules, $messages);



            // Upload file
            $banner = new make_lavarel();
            if ($request->has('image')) {
                $file = $request->image;
                $file_name = $file->getclientOriginalName();
                $file->move(public_path('img'), $file_name);
                $banner->image = '/img/'.$file_name; // Save ảnh
            }



            // Save dữ liệu
            $banner->background = $request->get('background');
            $banner->button = $request->get('button');
            $banner->button_link = $request->get('button_link');
            $banner->content = $request->get('content');
            $banner->order = $request->get('order');
            $banner->status = $request->get('status') == 'on' ? 1 : 0;

            $banner->save();

            return redirect(route('clients.banner.list'));
//            dd($request->all());
        }

        return view('clients.banner.store');

    }



    // Cap nhat banner
    public function edit($id,Request $request){

        $banner = make_lavarel::find($id);

        if($request->method() == 'POST'){

            // Gán ràng buộc cho các thuộc tính
//            $rules = [
//                'background' => 'required|min:6',
//                'button' => 'required|min:6',
//                'button_link' => 'required|min:6',
//                'content' => 'required|min:8',
//                'order' => 'required|integer',
//            ];
//            $messages = [
//                'background.required' => ':Attribute bắt buộc phải nhập',
//                'background.min' => ':Attribute không được nhỏ hơn :min kí tự',
//                'button.required' => ':Attribute bắt buộc phải nhập',
//                'button.min' => ':Attribute không được nhỏ hơn :min kí tự',
//                'button_link.required' => ':Attribute bắt buộc phải nhập',
//                'button_link.min' => ':Attribute không được nhỏ hơn :min kí tự',
//                'content.required' => ':Attribute bắt buộc phải nhập',
//                'content.min' => ':Attribute không được nhỏ hơn :min kí tự',
//                'order.required' => ':Attribute bắt buộc phải nhập',
//                'order.integer' => ':Attribute phải là số',
//            ];
//            $request->validate($rules, $messages);



            // Upload file
            if ($request->has('image')) {
                $file = $request->image;
                $file_name = $file->getclientOriginalName();

                $file->move(public_path('img'), $file_name);

                if(!File::exists('convert')){
                    File::makeDirectory('convert', $mode = 0777, true, true);
                }

                $image = Image::make(public_path('img/').$file_name)->fit(480, 270)->save(public_path('convert/').$file_name);

                $banner->image = '/convert/'.$file_name; // Save ảnh
            }



            // Save dữ liệu
            $banner->background = $request->get('background');
            $banner->button = $request->get('button');
            $banner->button_link = $request->get('button_link');
            $banner->content = $request->get('content');
            $banner->order = $request->get('order');
            $banner->status = $request->get('status') == 'on' ? 1 : 0;
            $banner->save();

            return redirect(route('clients.banner.list'));
//            dd($request->all());
        }

        return view('clients.banner.edit',['banner' => $banner]);
    }




    // Xóa không dùng ajax
//    public function delete($id,Request $request){
//
//        $banner = make_lavarel::findOrFail($id);
//
//        $banner->delete();
//
//        return redirect(route('clients.banner.list'));
//    }



    public function delete($id){

        $banner = make_lavarel::findOrFail($id);
        if($banner->delete()){
            return response()->json([
                'success' => true,
                'message' => 'Xóa thành công'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Không xóa được'
        ]);
    }

}
