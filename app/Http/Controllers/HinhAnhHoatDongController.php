<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HinhAnhHoatDong;
use Illuminate\Support\Facades\Validator;
class HinhAnhHoatDongController extends Controller
{
    function list(Request $request, $locale = ''){
        $danhsach = HinhAnhHoatDong::orderBy('order', 'asc')->orderBy('updated_at', 'desc')->get();
        return view('Admin.HinhAnhHoatDong.list')->with(compact('danhsach'));
    }

    function add(){
        return view('Admin.HinhAnhHoatDong.add');
    }

    function create(Request $request, $locale = ''){
        $data = $request->all();
        $validator = Validator::make($data, [
            'title' => 'required:hinh_anh_hoat_dong'
        ]);
        if ($validator->fails()) {
          return redirect(env('APP_URL').$locale.'/admin/hinh-anh-hoat-dong/add')->withErrors($validator)->withInput();
        }
        $arr_hinhanh = array();
        if(isset($data['hinhanh_aliasname']) && $data['hinhanh_aliasname']){
            foreach($data['hinhanh_aliasname'] as $k => $v){
              array_push($arr_hinhanh, array('aliasname' => $v, 'filename' => $data['hinhanh_filename'][$k], 'title' => $data['hinhanh_title'][$k]));
            }
        }
        $db = new HinhAnhHoatDong();
        $db->title = $data['title'];
        $db->url = $data['url'];
        $db->order = intval($data['thutu']);
        $db->photos = $arr_hinhanh;
        $db->status = isset($data['status']) ? intval($data['status']) : 0;
        $db->locale = $locale;
        $db->save();
        return redirect(env('APP_URL').$locale.'/admin/hinh-anh-hoat-dong');
    }

    function edit(Request $request, $locale = '', $id = ''){
        $ds = HinhAnhHoatDong::find($id);
        return view('Admin.HinhAnhHoatDong.edit')->with(compact('ds'));
    }

    function update(Request $request, $locale = ''){
        $data = $request->all();
        $validator = Validator::make($data, [
            'title' => 'required:hinh_anh_hoat_dong'
        ]);
        if ($validator->fails()) {
          return redirect(env('APP_URL').$locale.'/admin/hinh-anh-hoat-dong/edit/'.$data['id'])->withErrors($validator)->withInput();
        }
        $arr_hinhanh = array();
        if(isset($data['hinhanh_aliasname']) && $data['hinhanh_aliasname']){
            foreach($data['hinhanh_aliasname'] as $k => $v){
              array_push($arr_hinhanh, array('aliasname' => $v, 'filename' => $data['hinhanh_filename'][$k], 'title' => $data['hinhanh_title'][$k]));
            }
        }
        $db = HinhAnhHoatDong::find($data['id']);
        $db->title = $data['title'];
        $db->url = $data['url'];
        $db->order = intval($data['thutu']);
        $db->photos = $arr_hinhanh;
        $db->status = isset($data['status']) ? intval($data['status']) : 0;
        $db->locale = $locale;
        $db->save();
        return redirect(env('APP_URL').$locale.'/admin/hinh-anh-hoat-dong');
    }

    function delete(Request $request, $locale = '', $id = null){
        $cat = HinhAnhHoatDong::find($id);
        if($cat['photos']){
            foreach($cat['photos'] as $h){
                ImageController::remove($h['aliasname']);
            }
        }
        HinhAnhHoatDong::destroy($id);
        return redirect(env('APP_URL').$locale.'/admin/hinh-anh-hoat-dong');
    }
}
