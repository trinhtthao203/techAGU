<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ObjectController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\TranslatePathController;
use App\Models\NghienCuuKhoaHoc;
use App\Models\TranslatePath;

class NghienCuuKhoaHocController extends Controller
{
    //
    const TAGS = array(
        'de-tai-cap-co-so'=>'Đề tài cấp Cơ sở',
        'de-tai-cap-truong'=>'Đề tài cấp Trường',
        'de-tai-cap-tinh'=> 'Đề tài cấp Tỉnh',
        'de-tai-cap-dhqg'=>'Đề tài cấp ĐHQG');

    static function get_tags(){
        return self::TAGS;
    }

    function list(Request $request, $locale = '') {
        $danhsach = NghienCuuKhoaHoc::where('locale','=',$locale)->get();
        return view('Admin.NghienCuuKhoaHoc.list')->with(compact('danhsach'));
    }

    function add(Request $request, $locale=''){
        $trans_id = $request->input('trans_id');
        $trans_lang = $request->input('trans_lang');
        if($trans_id){
            $ds = NghienCuuKhoaHoc::find($trans_id);
        } else {
            $ds = '';
        }
        $tags = self::TAGS;
        return view('Admin.NghienCuuKhoaHoc.add')->with(compact('ds','trans_id', 'trans_lang','tags'));
    }

    function create(Request $request, $locale = '') {
        $data = $request->all();
        $validator = Validator::make($data, [
            'ten_nhiem_vu' => 'required|unique:nghien_cuu_khoa_hoc'
        ]);
        if ($validator->fails()) {
          return redirect(env('APP_URL').$locale.'/admin/nghien-cuu-khoa-hoc/add')->withErrors($validator)->withInput();
        }
        $arr_dinhkem = array();
        if(isset($data['file_aliasname']) && $data['file_aliasname']){
            foreach($data['file_aliasname'] as $k => $v){
              array_push($arr_dinhkem, array('aliasname' => $v, 'filename' => $data['file_filename'][$k], 'title' => $data['file_title'][$k], 'size' => $data['file_size'][$k], 'type' => $data['file_type'][$k]));
            }
        }
        $id = ObjectController::Id();
        $id_user = $request->session()->get('user._id');
        $db = new NghienCuuKhoaHoc();
        $db->_id = $id;
        $db->ten_nhiem_vu = $data['ten_nhiem_vu'];
        $db->chu_nhiem_nhiem_vu = $data['chu_nhiem_nhiem_vu'];
        $db->thoi_gian_thuc_hien = $data['thoi_gian_thuc_hien'];
        $db->tags = $data['tags'];
        $db->attachments = $arr_dinhkem;
        $db->locale = $locale;
        $db->id_user = ObjectController::ObjectId($id_user);
        $db->save();

        //cập nhật translate path
        $trans_lang = $data['trans_lang'];
        $trans_id = $data['trans_id'];
        if($trans_id && $trans_lang){
            $trans_id = ObjectController::ObjectId($trans_id);
            $check_path = TranslatePath::where("id_".$trans_lang, "=", $trans_id)->first();
            if($check_path){
                $trans = TranslatePath::find($check_path['_id']);
                $trans->{"id_$locale"} = $id;
                $trans->{"slug_$locale"} = $id;
                $trans->collection = 'nghien_cuu_khoa_hoc';
                $trans->save();
            }
        } else {
            $trans = new TranslatePath();
            $trans->{"id_$locale"} = $id;
            $trans->{"slug_$locale"} = $id;
            $trans->collection = 'nghien_cuu_khoa_hoc';
            $trans->save();
        }
        $logQuery = array (
            'action' => 'Thêm Thông tin ['.$data['ten_nhiem_vu'].']',
            'id_collection' => $id,
            'collection' => 'nghien_cuu_khoa_hoc',
            'data' => $data
        );
        LogController::addLog($logQuery);
        Session::flash('msg', 'Cập nhật thành công');
        if($trans_lang) return redirect(env('APP_URL') .$trans_lang.'/admin/nghien-cuu-khoa-hoc');
        return redirect(env('APP_URL').$locale.'/admin/nghien-cuu-khoa-hoc');
    }

    function edit(Request $request, $locale = '', $id = '') {
        $trans_id = $request->input('trans_id');
        $trans_lang = $request->input('trans_lang');
        $ds = NghienCuuKhoaHoc::find($id);
        $tags = self::TAGS;
        return view('Admin.NghienCuuKhoaHoc.edit')->with(compact('ds','trans_id', 'trans_lang','tags'));
    }

    function update(Request $request, $locale = '',$id='') {
        $data = $request->all();
        $validator = Validator::make($data, [
            'ten_nhiem_vu' => 'required:unique:nghien_cuu_khoa_hoc,_id,'.$data['id']
        ]);
        if ($validator->fails()) {
          return redirect(env('APP_URL').$locale.'/admin/nghien-cuu-khoa-hoc/edit/'.$data['id'].'?trans_id='.$data['trans_id'].'&trans_lang='.$data['trans_lang'])->withErrors($validator)->withInput();
        }
        $arr_dinhkem = array();
        if(isset($data['file_aliasname']) && $data['file_aliasname']){
            foreach($data['file_aliasname'] as $k => $v){
              array_push($arr_dinhkem, array('aliasname' => $v, 'filename' => $data['file_filename'][$k], 'title' => $data['file_title'][$k], 'size' => $data['file_size'][$k], 'type' => $data['file_type'][$k]));
            }
        }
        $id_user = $request->session()->get('user._id');
        $db = NghienCuuKhoaHoc::find($data['id']);
        $db->ten_nhiem_vu = $data['ten_nhiem_vu'];
        $db->chu_nhiem_nhiem_vu = $data['chu_nhiem_nhiem_vu'];
        $db->thoi_gian_thuc_hien = $data['thoi_gian_thuc_hien'];
        $db->tags = $data['tags'];
        $db->attachments = $arr_dinhkem;
        $db->locale = $locale;
        $db->id_user = ObjectController::ObjectId($id_user);
        $db->save();

        //update translate path
        $trans_lang = $data['trans_lang'];
        $trans_id = $data['trans_id'];
        $id_path = ObjectController::ObjectId($data['id']);
        $check_path = TranslatePath::where("id_".$locale, "=", $id_path)->first();
        $trans = TranslatePath::find($check_path['_id']);
        $trans->{"id_$locale"} = $id_path;
        $trans->{"slug_$locale"} = ObjectController::ObjectId($data['id']);
        $trans->collection = 'nghien_cuu_khoa_hoc';
        $trans->save();
        $logQuery = array (
            'action' => 'Thêm Thông tin ['.$data['ten_nhiem_vu'].']',
            'id_collection' => $data['id'],
            'collection' => 'nghien_cuu_khoa_hoc',
            'data' => $data
        );
        LogController::addLog($logQuery);
        Session::flash('msg', 'Cập nhật thành công');
        if($trans_lang) return redirect(env('APP_URL') .$trans_lang.'/admin/nghien-cuu-khoa-hoc');
        return redirect(env('APP_URL') .$locale.'/admin/nghien-cuu-khoa-hoc');
    }

    function delete(Request $request, $locale='', $id = '') {
        $data = NghienCuuKhoaHoc::find($id);
        $logQuery = array (
            'action' => 'Xóa nghiên cứu khoa học ['.$data['ten_nhiệm vụ'].']',
            'id_collection' => $id,
            'collection' => 'nghien_cuu_khoa_hoc',
            'data' => $data
        );
        if($data['photos']){
            foreach($data['photos'] as $p){
                ImageController::remove($p['aliasname']);
            }
        }
        NghienCuuKhoaHoc::destroy($id);
        $id_path = ObjectController::ObjectId($id);
        $trans = TranslatePath::where('id_'.$locale, '=', $id_path)->first();
        if($trans){
            $trans->unset('id_'.$locale);
            $trans->unset('slug_'.$locale);
        }
        Session::flash('msg', 'Cập nhật thành công');
        return redirect(env('APP_URL').$locale.'/admin/nghien-cuu-khoa-hoc');
    }
}
