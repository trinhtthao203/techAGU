<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ObjectController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\TranslatePathController;
use App\Models\HoiNghiHoiThao;
use App\Models\TranslatePath;
use Illuminate\Support\Facades\Session; use Illuminate\Support\Facades\Validator;

class HoiNghiHoiThaoController extends Controller
{
    //

    function list(Request $request, $locale = ''){
        $keywords = $request->input('keywords');
        $danhsach = HoiNghiHoiThao::where('locale','=',$locale)->where('locale','=',$locale)->orderBy('updated_at', 'desc')->paginate(30);
        return view('Admin.HoiNghiHoiThao.list')->with(compact('danhsach'));
    }

    function add(Request $request, $locale = ''){
        $trans_id = $request->input('trans_id');
        $trans_lang = $request->input('trans_lang');
        if($trans_id){
            $ds = HoiNghiHoiThao::find($trans_id);
        } else {
            $ds = '';
        }
        return view('Admin.HoiNghiHoiThao.add')->with(compact('ds','trans_id', 'trans_lang'));
    }

    function create(Request $request, $locale = ''){
        $data = $request->all();
        $validator = Validator::make($data, [
            'slug' => 'required|unique:hoi_nghi_hoi_thao',
            'ten' => 'required',
            'mo_ta' => 'required',
            'noi_dung' => 'required'
        ]);
        if ($validator->fails()) {
          return redirect(env('APP_URL').$locale .'/admin/hoi-nghi-hoi-thao/add?trans_id='.$data['trans_id'].'&trans_lang='.$data['trans_lang'])->withErrors($validator)->withInput();
        }
        $arr_photo = array();
        if(isset($data['hinhanh_aliasname'])){
          foreach($data['hinhanh_aliasname'] as $key => $value){
            array_push($arr_photo, array('aliasname' => $value, 'filename' => $data['hinhanh_filename'][$key], 'title' => $data['hinhanh_title'][$key]));
          }
        }

        $arr_dinhkem = array();
        if(isset($data['file_aliasname']) && $data['file_aliasname']){
            foreach($data['file_aliasname'] as $k => $v){
              array_push($arr_dinhkem, array('aliasname' => $v, 'filename' => $data['file_filename'][$k], 'title' => $data['file_title'][$k], 'size' => $data['file_size'][$k], 'type' => $data['file_type'][$k]));
            }
        }

        $id = ObjectController::Id();
        $id_user = $request->session()->get('user._id');
        $db = new HoiNghiHoiThao();
        $db->_id = $id;
        $db->ten = $data['ten'];
        $db->slug = $data['slug'];
        $db->mo_ta = $data['mo_ta'];
        $db->noi_dung = $data['noi_dung'];
        $db->photos = $arr_photo;
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
                $trans->{"slug_$locale"} = $data['slug'];
                $trans->collection = 'hoi_nghi_hoi_thao';
                $trans->save();
            }
        } else {
            $trans = new TranslatePath();
            $trans->{"id_$locale"} = $id;
            $trans->{"slug_$locale"} = $data['slug'];
            $trans->collection = 'hoi_nghi_hoi_thao';
            $trans->save();
        }
        $logQuery = array (
            'action' => 'Thêm Thông tin ['.$data['ten'].']',
            'id_collection' => $id,
            'collection' => 'hoi_nghi_hoi_thao',
            'data' => $data
        );
        LogController::addLog($logQuery);
        Session::flash('msg', 'Cập nhật thành công');
        if($trans_lang) return redirect(env('APP_URL') .$trans_lang.'/admin/hoi-nghi-hoi-thao');
        return redirect(env('APP_URL') .$locale.'/admin/hoi-nghi-hoi-thao');
    }

    function edit(Request $request, $locale = '', $id = ''){
        $trans_id = $request->input('trans_id');
        $trans_lang = $request->input('trans_lang');
        $ds = HoiNghiHoiThao::find($id);
        return view('Admin.HoiNghiHoiThao.edit')->with(compact('ds','trans_id', 'trans_lang'));
    }

    function update(Request $request, $locale = '', $id = ''){
        $data = $request->all();
        $validator = Validator::make($data, [
            'slug' => 'required|unique:hoi_nghi_hoi_thao,_id,'.$data['id'],
            'ten' => 'required',
            'mo_ta' => 'required',
            'noi_dung' => 'required'
        ]);
        if ($validator->fails()) {
          return redirect(env('APP_URL').$locale .'/admin/hoi-nghi-hoi-thao/edit/'.$data['id'].'?trans_id='.$data['trans_id'].'&trans_lang='.$data['trans_lang'])->withErrors($validator)->withInput();
        }
        $arr_photo = array();
        if(isset($data['hinhanh_aliasname'])){
          foreach($data['hinhanh_aliasname'] as $key => $value){
            array_push($arr_photo, array('aliasname' => $value, 'filename' => $data['hinhanh_filename'][$key], 'title' => $data['hinhanh_title'][$key]));
          }
        }
        $arr_dinhkem = array();
        if(isset($data['file_aliasname']) && $data['file_aliasname']){
            foreach($data['file_aliasname'] as $k => $v){
              array_push($arr_dinhkem, array('aliasname' => $v, 'filename' => $data['file_filename'][$k], 'title' => $data['file_title'][$k], 'size' => $data['file_size'][$k], 'type' => $data['file_type'][$k]));
            }
        }

        $id_user = $request->session()->get('user._id');
        $db = HoiNghiHoiThao::find($data['id']);
        $db->ten = $data['ten'];
        $db->slug = $data['slug'];
        $db->mo_ta = $data['mo_ta'];
        $db->noi_dung = $data['noi_dung'];
        $db->photos = $arr_photo;
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
        $trans->{"slug_$locale"} = $data['slug'];
        $trans->collection = 'hoi_nghi_hoi_thao';
        $trans->save();
        $logQuery = array (
            'action' => 'Chỉnh sửa Hội nghị Hội thảo ['.$data['ten'].']',
            'id_collection' => $data['id'],
            'collection' => 'hoi_nghi_hoi_thao',
            'data' => $data
        );
        LogController::addLog($logQuery);
        Session::flash('msg', 'Cập nhật thành công');
        if($trans_lang) return redirect(env('APP_URL') .$trans_lang.'/admin/hoi-nghi-hoi-thao');
        return redirect(env('APP_URL') .$locale.'/admin/hoi-nghi-hoi-thao');
    }

    function delete(Request $request, $locale = '', $id = ''){
        $data = HoiNghiHoiThao::find($id);
        $logQuery = array (
            'action' => 'Xóa Hội nghị Hội thảo ['.$data['ten'].']',
            'id_collection' => $id,
            'collection' => 'hoi_nghi_hoi_thao',
            'data' => $data
        );
        if($data['photos']){
            foreach($data['photos'] as $p){
                ImageController::remove($p['aliasname']);
            }
        }
        if($data['attachments']) {
            foreach($data['attachments'] as $dk){
                FileController::remove($dk['aliasname']);
            }
        }
        HoiNghiHoiThao::destroy($id);
        $id_path = ObjectController::ObjectId($id);
        $trans = TranslatePath::where('id_'.$locale, '=', $id_path)->first();
        if($trans){
            $trans->unset('id_'.$locale);
            $trans->unset('slug_'.$locale);
        }
        LogController::addLog($logQuery);
        Session::flash('msg', 'Xóa thành công');
        return redirect(env('APP_URL').$locale.'/admin/hoi-nghi-hoi-thao');
    }
}
