<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ObjectController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\TranslatePathController;
use App\Models\DuAn;
use App\Models\TranslatePath;

class DuAnController extends Controller
{
    //
    function list(Request $request, $locale = '') {
        $danhsach = DuAn::where('locale','=',$locale)->get();
        return view('Admin.DuAn.list')->with(compact('danhsach'));
    }

    function add(Request $request, $locale=''){
        $trans_id = $request->input('trans_id');
        $trans_lang = $request->input('trans_lang');
        if($trans_id){
            $ds = DuAn::find($trans_id);
        } else {
            $ds = '';
        }
        return view('Admin.DuAn.add')->with(compact('ds','trans_id', 'trans_lang'));
    }

    function create(Request $request, $locale = '') {
        $data = $request->all();
        $validator = Validator::make($data, [
            'ten_du_an' => 'required:du_an'
        ]);
        if ($validator->fails()) {
          return redirect(env('APP_URL').$locale.'/admin/du-an/add')->withErrors($validator)->withInput();
        }

        $db = new DuAn();
        $id = ObjectController::Id();
        $db->_id = $id;
        $db->ten_du_an = $data['ten_du_an'];
        $db->co_quan_chu_tri = $data['co_quan_chu_tri'];
        $db->co_quan_chu_quan = $data['co_quan_chu_quan'];
        $db->don_vi_tai_tro = $data['don_vi_tai_tro'];
        $db->kinh_phi_tai_tro = $data['kinh_phi_tai_tro'];
        $db->can_bo_du_an = $data['can_bo_du_an'];
        $db->thoi_gian_thuc_hien = $data['thoi_gian_thuc_hien'];
        $db->noi_dung_hoat_dong = $data['noi_dung_hoat_dong'];
        $db->locale = $locale;
        $db->slug = $id;
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
                $trans->collection = 'du_an';
                $trans->save();
            }
        } else {
            $trans = new TranslatePath();
            $trans->{"id_$locale"} = $id;
            $trans->{"slug_$locale"} = $id;
            $trans->collection = 'du_an';
            $trans->save();
        }
        Session::flash('msg', 'Cập nhật thành công');
        return redirect(env('APP_URL').$locale.'/admin/du-an');
    }

    function edit(Request $request, $locale = '', $id = '') {
        $trans_id = $request->input('trans_id');
        $trans_lang = $request->input('trans_lang');
        $ds = DuAn::find($id);
        return view('Admin.DuAn.edit')->with(compact('ds','trans_id', 'trans_lang'));
    }

    function update(Request $request, $locale = '') {
        $data = $request->all();
        $validator = Validator::make($data, [
            'ten_du_an' => 'required:du_an,_id,'.$data['id']
        ]);
        if ($validator->fails()) {
          return redirect(env('APP_URL').$locale.'/admin/du-an/edit/'.$data['id'].'?trans_id='.$data['trans_id'].'&trans_lang='.$data['trans_lang'])->withErrors($validator)->withInput();
        }
        $db = DuAn::find($data['id']);
        $db->ten_du_an = $data['ten_du_an'];
        $db->co_quan_chu_tri = $data['co_quan_chu_tri'];
        $db->co_quan_chu_quan = $data['co_quan_chu_quan'];
        $db->don_vi_tai_tro = $data['don_vi_tai_tro'];
        $db->kinh_phi_tai_tro = $data['kinh_phi_tai_tro'];
        $db->can_bo_du_an = $data['can_bo_du_an'];
        $db->thoi_gian_thuc_hien = $data['thoi_gian_thuc_hien'];
        $db->noi_dung_hoat_dong = $data['noi_dung_hoat_dong'];
        $db->locale = $locale;
        $db->slug = ObjectController::ObjectId($data['id']);
        $db->save();

        //update translatepath
        $trans_lang = $data['trans_lang'];
        $trans_id = $data['trans_id'];
        $id_path = ObjectController::ObjectId($data['id']);
        $check_path = TranslatePath::where("id_".$locale, "=", $id_path)->first();
        $trans = TranslatePath::find($check_path['_id']);
        $trans->{"id_$locale"} = $id_path;
        $trans->{"slug_$locale"} = ObjectController::ObjectId($data['id']);
        $trans->collection = 'du_an';
        $trans->save();
        Session::flash('msg', 'Cập nhật thành công');
        if($trans_lang) return redirect(env('APP_URL') .$trans_lang.'/admin/du-an');
        return redirect(env('APP_URL') .$locale.'/admin/du-an');
    }

    function delete(Request $request, $locale='', $id = '') {
        DuAn::destroy($id);
        $id_path = ObjectController::ObjectId($id);
        $trans = TranslatePath::where('id_'.$locale, '=', $id_path)->first();
        if($trans){
            $trans->unset('id_'.$locale);
            $trans->unset('slug_'.$locale);
        }
        Session::flash('msg', 'Cập nhật thành công');
        return redirect(env('APP_URL').$locale.'/admin/du-an');
    }
}
