<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BieuMau;
use Illuminate\Support\Facades\Validator;
use App\Models\TranslatePath;
use Illuminate\Support\Facades\Session;
class BieuMauController extends Controller
{
    protected const CATS = array(
        'bieu_mau_giang_vien'=>'Biểu mẫu cho giảng viên',
        'bieu_mau_sinh_vien'=>'Biểu mẫu cho sinh viên'
    );

    static function get_cats() {
        return self::CATS;
    }

    function list(Request $request, $locale = ''){
        $keywords = $request->input('keywords');
        $danhsach = BieuMau::where('locale','=',$locale)->where('locale','=',$locale)->orderBy('date_post', 'desc')->paginate(30);
        return view('Admin.BieuMau.list')->with(compact('danhsach'));
    }

    function add(Request $request, $locale = ''){
        $trans_id = $request->input('trans_id');
        $trans_lang = $request->input('trans_lang');
        if($trans_id){
            $ds = BieuMau::find($trans_id);
        } else {
            $ds = '';
        }
        $cats = self::CATS;
        return view('Admin.BieuMau.add')->with(compact('ds','trans_id', 'trans_lang','cats'));
    }

    function create(Request $request, $locale = ''){
        $data = $request->all();
        $validator = Validator::make($data, [
            'slug' => 'required|unique:bieu_mau',
            'ten' => 'required'
        ]);
        if ($validator->fails()) {
          return redirect(env('APP_URL').$locale .'/admin/bieu-mau/add?trans_id='.$data['trans_id'].'&trans_lang='.$data['trans_lang'])->withErrors($validator)->withInput();
        }
        $arr_dinhkem = array();
        if(isset($data['file_aliasname']) && $data['file_aliasname']){
            foreach($data['file_aliasname'] as $k => $v){
              array_push($arr_dinhkem, array('aliasname' => $v, 'filename' => $data['file_filename'][$k], 'title' => $data['file_title'][$k], 'size' => $data['file_size'][$k], 'type' => $data['file_type'][$k]));
            }
        }

        $id = ObjectController::Id();
        $id_user = $request->session()->get('user._id');
        $db = new BieuMau();
        $db->_id = $id;
        $db->ten = $data['ten'];
        $db->slug = $data['slug'];
        $db->mo_ta = $data['mo_ta'];
        $db->attachments = $arr_dinhkem;
        $db->id_cat = $data['id_cat'];
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
                $trans->collection = 'bieu_mau';
                $trans->save();
            }
        } else {
            $trans = new TranslatePath();
            $trans->{"id_$locale"} = $id;
            $trans->{"slug_$locale"} = $data['slug'];
            $trans->collection = 'bieu_mau';
            $trans->save();
        }
        $logQuery = array (
            'action' => 'Thêm Thông tin ['.$data['ten'].']',
            'id_collection' => $id,
            'collection' => 'bieu_mau',
            'data' => $data
        );
        LogController::addLog($logQuery);
        Session::flash('msg', 'Cập nhật thành công');
        if($trans_lang) return redirect(env('APP_URL') .$trans_lang.'/admin/bieu-mau');
        return redirect(env('APP_URL') .$locale.'/admin/bieu-mau');
    }

    function edit(Request $request, $locale = '', $id = ''){
        $trans_id = $request->input('trans_id');
        $trans_lang = $request->input('trans_lang');
        $ds = BieuMau::find($id);
        $cats = self::CATS;
        return view('Admin.BieuMau.edit')->with(compact('ds','trans_id', 'trans_lang','cats'));
    }

    function update(Request $request, $locale = '', $id = ''){
        $data = $request->all();
        $validator = Validator::make($data, [
            'slug' => 'required|unique:bieu_mau,_id,'.$data['id'],
            'ten' => 'required',
            'mo_ta' => 'required',
        ]);
        if ($validator->fails()) {
          return redirect(env('APP_URL').$locale .'/admin/bieu-mau/edit/'.$data['id'].'?trans_id='.$data['trans_id'].'&trans_lang='.$data['trans_lang'])->withErrors($validator)->withInput();
        }
        $arr_dinhkem = array();
        if(isset($data['file_aliasname']) && $data['file_aliasname']){
            foreach($data['file_aliasname'] as $k => $v){
              array_push($arr_dinhkem, array('aliasname' => $v, 'filename' => $data['file_filename'][$k], 'title' => $data['file_title'][$k], 'size' => $data['file_size'][$k], 'type' => $data['file_type'][$k]));
            }
        }

        $id_user = $request->session()->get('user._id');
        $db = BieuMau::find($data['id']);
        $db->ten = $data['ten'];
        $db->slug = $data['slug'];
        $db->mo_ta = $data['mo_ta'];
        $db->attachments = $arr_dinhkem;
        $db->locale = $locale;
        $db->id_cat = $data['id_cat'];
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
        $trans->collection = 'bieu_mau';
        $trans->save();
        $logQuery = array (
            'action' => 'Chỉnh sửa Biểu mẫu ['.$data['ten'].']',
            'id_collection' => $data['id'],
            'collection' => 'bieu_mau',
            'data' => $data
        );
        LogController::addLog($logQuery);
        Session::flash('msg', 'Cập nhật thành công');
        if($trans_lang) return redirect(env('APP_URL') .$trans_lang.'/admin/bieu-mau');
        return redirect(env('APP_URL') .$locale.'/admin/bieu-mau');
    }

    function delete(Request $request, $locale = '', $id = ''){
        $data = BieuMau::find($id);
        $logQuery = array (
            'action' => 'Xóa Biểu mẫu ['.$data['ten'].']',
            'id_collection' => $id,
            'collection' => 'bieu_mau',
            'data' => $data
        );

        if($data['attachments']) {
            foreach($data['attachments'] as $dk){
                FileController::remove($dk['aliasname']);
            }
        }
        BieuMau::destroy($id);
        $id_path = ObjectController::ObjectId($id);
        $trans = TranslatePath::where('id_'.$locale, '=', $id_path)->first();
        if($trans){
            $trans->unset('id_'.$locale);
            $trans->unset('slug_'.$locale);
        }
        LogController::addLog($logQuery);
        Session::flash('msg', 'Xóa thành công');
        return redirect(env('APP_URL').$locale.'/admin/bieu-mau');
    }
}
