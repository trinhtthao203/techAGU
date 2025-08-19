<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ImageController;
use App\Models\Banner;
use Illuminate\Support\Str;
use File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
class BannerController extends Controller
{
    function list(Request $request, $locale = ''){
        $danhsach = Banner::orderBy('order', 'asc')->orderBy('updated_at', 'desc')->get();
        return view('Admin.Banner.list')->with(compact('danhsach'));
    }

    function add(){
        return view('Admin.Banner.add');
    }

    function create(Request $request, $locale = ''){
        $data = $request->all();
        $validator = Validator::make($data, [
            'title' => 'required:banners'
        ]);
        if ($validator->fails()) {
          return redirect(env('APP_URL').$locale.'/admin/banner/add')->withErrors($validator)->withInput();
        }
        $arr_hinhanh = array();
        if(isset($data['hinhanh_aliasname']) && $data['hinhanh_aliasname']){
            foreach($data['hinhanh_aliasname'] as $k => $v){
              array_push($arr_hinhanh, array('aliasname' => $v, 'filename' => $data['hinhanh_filename'][$k], 'title' => $data['hinhanh_title'][$k]));
            }
        }
        $db = new Banner();
        $db->title = $data['title'];
        $db->url = $data['url'];
        $db->order = intval($data['thutu']);
        $db->photos = $arr_hinhanh;
        $db->status = isset($data['status']) ? intval($data['status']) : 0;
        $db->locale = $locale;
        $db->save();
        return redirect(env('APP_URL').$locale.'/admin/banner');
    }

    function edit(Request $request, $locale = '', $id = ''){
        $ds = Banner::find($id);
        return view('Admin.Banner.edit')->with(compact('ds'));
    }

    function update(Request $request, $locale = ''){
        $data = $request->all();
        $validator = Validator::make($data, [
            'title' => 'required:banners'
        ]);
        if ($validator->fails()) {
          return redirect(env('APP_URL').$locale.'/admin/banner/edit/'.$data['id'])->withErrors($validator)->withInput();
        }
        $arr_hinhanh = array();
        if(isset($data['hinhanh_aliasname']) && $data['hinhanh_aliasname']){
            foreach($data['hinhanh_aliasname'] as $k => $v){
              array_push($arr_hinhanh, array('aliasname' => $v, 'filename' => $data['hinhanh_filename'][$k], 'title' => $data['hinhanh_title'][$k]));
            }
        }
        $db = Banner::find($data['id']);
        $db->title = $data['title'];
        $db->url = $data['url'];
        $db->order = intval($data['thutu']);
        $db->photos = $arr_hinhanh;
        $db->status = isset($data['status']) ? intval($data['status']) : 0;
        $db->locale = $locale;
        $db->save();
        return redirect(env('APP_URL').$locale.'/admin/banner');
    }

    function delete(Request $request, $locale = '', $id = null){
        $cat = Banner::find($id);
        if($cat['photos']){
            foreach($cat['photos'] as $h){
                ImageController::remove($h['aliasname']);
            }
        }
        Banner::destroy($id);
        return redirect(env('APP_URL').$locale.'/admin/banner');
    }

    function tong_quan(Request $request, $locale = 'vi') {
        $file_path = base_path('resources/lang/') . $locale . '/tong-quan.txt';
        $noi_dung = file_get_contents($file_path);
        return view('Admin.Banner.tong-quan')->with(compact('noi_dung'));
    }

    function tong_quan_update (Request $request, $locale = 'vi') {
        $file_path = base_path('resources/lang/') . $locale . '/tong-quan.txt';
        $noi_dung = $request->input('noi_dung');
        file_put_contents($file_path, $noi_dung);

        Session::flash('msg', 'Cập nhật thành công.');
        return redirect(env('APP_URL').$locale.'/admin/tong-quan');
    }

    function lien_he(Request $request, $locale = 'vi') {
        $file_path = base_path('resources/lang/') . $locale . '/lien-he.txt';
        $noi_dung = file_get_contents($file_path);
        return view('Admin.Banner.lien-he')->with(compact('noi_dung'));
    }

    function lien_he_update(Request $request, $locale = 'vi') {
        $file_path = base_path('resources/lang/') . $locale . '/lien-he.txt';
        $noi_dung = $request->input('noi_dung');
        file_put_contents($file_path, $noi_dung);

        Session::flash('msg', 'Cập nhật thành công.');
        return redirect(env('APP_URL').$locale.'/admin/lien-he');
    }
}
