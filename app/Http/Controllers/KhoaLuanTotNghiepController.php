<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ObjectController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\TranslatePathController;
use App\Models\KhoaLuanTotNghiep;
use App\Models\TranslatePath;

class KhoaLuanTotNghiepController extends Controller
{
    const TAGS = array(
        'khoa-luan-tot-nghiep'=>'Khóa luận tốt nghiệp',
        'chuyen-de-tot-nghiep'=>'Chuyên đề tốt nghiệp'

    );
    static function get_tags(){
        return self::TAGS;
    }
    function list(Request $request, $locale = '') {
        $danhsach = KhoaLuanTotNghiep::where('locale','=',$locale)->get();
        return view('Admin.KhoaLuanTotNghiep.list')->with(compact('danhsach'));
    }

    function add(Request $request, $locale=''){
        $trans_id = $request->input('trans_id');
        $trans_lang = $request->input('trans_lang');
        if($trans_id){
            $ds = KhoaLuanTotNghiep::find($trans_id);
        } else {
            $ds = '';
        }
        $tags = self::TAGS;
        return view('Admin.KhoaLuanTotNghiep.add')->with(compact('ds','trans_id', 'trans_lang','tags'));
    }  

    function create(Request $request, $locale = '') {
        $data = $request->all();
        $validator = Validator::make($data, [
            'tieu_de' => 'required|unique:khoa_luan_tot_nghiep',
        ]);
        if ($validator->fails()) {
          return redirect(env('APP_URL').$locale.'/admin/khoa_luan_tot_nghiep/add')->withErrors($validator)->withInput();
        }

        $arr_dinhkem = array();
        if(isset($data['file_aliasname']) && $data['file_aliasname']){
            foreach($data['file_aliasname'] as $k => $v){
              array_push($arr_dinhkem, array('aliasname' => $v, 'filename' => $data['file_filename'][$k], 'title' => $data['file_title'][$k], 'size' => $data['file_size'][$k], 'type' => $data['file_type'][$k]));
            }
        }

        $id = ObjectController::Id();
        $id_user = $request->session()->get('user._id');
        $db = new KhoaLuanTotNghiep();
        $db->_id = $id;
        $db->tieu_de = $data['tieu_de'];
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
                $trans->collection = 'khoa_luan_tot_nghiep';
                $trans->save();
            }
        } else {
            $trans = new TranslatePath();
            $trans->{"id_$locale"} = $id;
            $trans->{"slug_$locale"} = $id;
            $trans->collection = 'khoa_luan_tot_nghiep';
            $trans->save();
        }
        $logQuery = array (
            'action' => 'Thêm Thông tin ['.$data['tieu_de'].']',
            'id_collection' => $id,
            'collection' => 'khoa_luan_tot_nghiep',
            'data' => $data
        );
        LogController::addLog($logQuery);
        Session::flash('msg', 'Cập nhật thành công');
        if($trans_lang) return redirect(env('APP_URL') .$trans_lang.'/admin/khoa-luan-tot-nghiep');
        return redirect(env('APP_URL').$locale.'/admin/khoa-luan-tot-nghiep');
    }

    function edit(Request $request, $locale = '', $id = '') {
        $trans_id = $request->input('trans_id');
        $trans_lang = $request->input('trans_lang');
        $ds = KhoaLuanTotNghiep::find($id);
        $tags = self::TAGS;
        return view('Admin.KhoaLuanTotNghiep.edit')->with(compact('ds','trans_id', 'trans_lang','tags'));
    }

    function update(Request $request, $locale = '', $id='') {
        $data = $request->all();
        $validator= Validator::make($data,[
        'tieu_de'=>'required|unique:khoa_luan_tot_nghiep, _id,'.$data['id'],
        ]);
        
        if ($validator->fails()) {
          return redirect(env('APP_URL').$locale.'/admin/khoa-luan-tot-nghiep/edit/'.$data['id'].'?trans_id='.$data['trans_id'].'&trans_lang='.$data['trans_lang'])->withErrors($validator)->withInput();
        }
        $arr_dinhkem = array();
        if(isset($data['file_aliasname']) && $data['file_aliasname']){
            foreach($data['file_aliasname'] as $k => $v){
              array_push($arr_dinhkem, array('aliasname' => $v, 'filename' => $data['file_filename'][$k], 'title' => $data['file_title'][$k], 'size' => $data['file_size'][$k], 'type' => $data['file_type'][$k]));
            }
        }
        $id_user = $request->session()->get('user._id');
        $db = KhoaLuanTotNghiep::find($data['id']);
        $db->tieu_de = $data['tieu_de'];
        $db->tags = $data['tags'];
        $db->attachments = $arr_dinhkem;
        $db->locale = $locale;
        $db->id_user = ObjectController::ObjectId($id_user);
        $db->save();

        //update translatepath
        $trans_lang = $data['trans_lang'];
        $trans_id = $data['trans_id'];
        $id_path = ObjectController::ObjectId($data['id']);
        $check_path = TranslatePath::where("id_".$locale, "=", $id_path)->first();
        $trans = TranslatePath::find($check_path['_id']);
        $trans->{"id_$locale"} = $id_path;
        $trans->{"slug_$locale"} = ObjectController::ObjectId($data['id']);
        $trans->collection = 'khoa_luan_tot_nghiep';
        $trans->save();
        $logQuery = array (
            'action' => 'Chỉnh sửa Khóa Luận tốt nghiệp ['.$data['tieu_de'].']',
            'id_collection' => $data['id'],
            'collection' => 'khoa_luan_tot_nghiep',
            'data' => $data
        );
        LogController::addLog($logQuery);
        Session::flash('msg', 'Cập nhật thành công');
        if($trans_lang) return redirect(env('APP_URL') .$trans_lang.'/admin/khoa-luan-tot-nghiep');
        return redirect(env('APP_URL') .$locale.'/admin/khoa-luan-tot-nghiep');
    }

    function delete(Request $request, $locale='', $id = '') {
        $data = KhoaLuanTotNghiep::find($id);
        $logQuery = array (
            'action' => 'Xóa Khóa luận tốt nghiệp ['.$data['ten_de_tai'].']',
            'id_collection' => $id,
            'collection' => 'khoa_luan_tot_nghiep',
            'data' => $data
        );
        if($data['photos']){
            foreach($data['photos'] as $p){
                ImageController::remove($p['aliasname']);
            }
        }
        KhoaLuanTotNghiep::destroy($id);
        $id_path = ObjectController::ObjectId($id);
        $trans = TranslatePath::where('id_'.$locale, '=', $id_path)->first();
        if($trans){
            $trans->unset('id_'.$locale);
            $trans->unset('slug_'.$locale);
        }
        LogController::addLog($logQuery);
        Session::flash('msg', 'Xóa thành công');
        return redirect(env('APP_URL').$locale.'/admin/khoa-luan-tot-nghiep');
    }
}
