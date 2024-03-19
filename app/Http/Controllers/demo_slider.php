<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\make_lavarel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class demo_slider extends Controller
{
    public function slider() {
        $banners = make_lavarel::()->where('status', 1)
            ->orderBy('order')->get();
        return view('clients.slider', [
            'banners'=>$banners
        ])
            ->with('title', 'Slider');
    }

    public function store(Request $request) {
        if ($request->has('image')) {
            $file = $request->image;
            $file_name = $file->getClientoriginalName();
            dd($file_name);
        }
    }

//    public function delete($id) {
//        $deleted = DB::table('App\Models\make_lavarel')->delete();
//    }
}
