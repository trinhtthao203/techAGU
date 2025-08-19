<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ObjectController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\TranslatePathController;
use App\Models\VanBan;
use App\Models\TranslatePath;
use Illuminate\Support\Facades\Session; use Illuminate\Support\Facades\Validator;

class VanBanController extends Controller
{
    //
    /*protected const CATS = array(
        '​Khoa học và Công nghệ Quốc gia',
        'Đại học Quốc gia Thành phố Hồ Chí Minh',
        'Tỉnh An Giang',
        'Trường Đại học An Giang',
        'Trung tâm Nghiên cứu KHXH và Nhân văn',
        'Kỹ năng làm việc',
        'Biểu mẫu',
        'Tài liệu tham khảo'
    );*/

    protected const CATS = array(
        'Văn bản của phòng Đào tạo',
        'Văn bản của phòng Khảo thí',
        'Văn bản của Khoa',
        'Văn bản của Trường'
    );

    static function get_cats() {
        return self::CATS;
    }

    function list(Request $request, $locale = ''){
        $keywords = $request->input('keywords');
        $danhsach = VanBan::where('locale','=',$locale)->where('locale','=',$locale)->orderBy('date_post', 'desc')->paginate(30);
        return view('Admin.VanBan.list')->with(compact('danhsach'));
    }

    function add(Request $request, $locale = ''){
        $trans_id = $request->input('trans_id');
        $trans_lang = $request->input('trans_lang');
        if($trans_id){
            $ds = VanBan::find($trans_id);
        } else {
            $ds = '';
        }
        $cats = self::CATS;
        return view('Admin.VanBan.add')->with(compact('ds','trans_id', 'trans_lang','cats'));
    }

    function create(Request $request, $locale = ''){
        $data = $request->all();
        $validator = Validator::make($data, [
            'slug' => 'required|unique:van_ban',
            'ten' => 'required'
        ]);
        if ($validator->fails()) {
          return redirect(env('APP_URL').$locale .'/admin/van-ban/add?trans_id='.$data['trans_id'].'&trans_lang='.$data['trans_lang'])->withErrors($validator)->withInput();
        }
        $arr_dinhkem = array();
        if(isset($data['file_aliasname']) && $data['file_aliasname']){
            foreach($data['file_aliasname'] as $k => $v){
              array_push($arr_dinhkem, array('aliasname' => $v, 'filename' => $data['file_filename'][$k], 'title' => $data['file_title'][$k], 'size' => $data['file_size'][$k], 'type' => $data['file_type'][$k]));
            }
        }

        $id = ObjectController::Id();
        $id_user = $request->session()->get('user._id');
        $db = new VanBan();
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
                $trans->collection = 'van_ban';
                $trans->save();
            }
        } else {
            $trans = new TranslatePath();
            $trans->{"id_$locale"} = $id;
            $trans->{"slug_$locale"} = $data['slug'];
            $trans->collection = 'van_ban';
            $trans->save();
        }
        $logQuery = array (
            'action' => 'Thêm Thông tin ['.$data['ten'].']',
            'id_collection' => $id,
            'collection' => 'van_ban',
            'data' => $data
        );
        LogController::addLog($logQuery);
        Session::flash('msg', 'Cập nhật thành công');
        if($trans_lang) return redirect(env('APP_URL') .$trans_lang.'/admin/van-ban');
        return redirect(env('APP_URL') .$locale.'/admin/van-ban');
    }

    function edit(Request $request, $locale = '', $id = ''){
        $trans_id = $request->input('trans_id');
        $trans_lang = $request->input('trans_lang');
        $ds = VanBan::find($id);
        $cats = self::CATS;
        return view('Admin.VanBan.edit')->with(compact('ds','trans_id', 'trans_lang','cats'));
    }

    function update(Request $request, $locale = '', $id = ''){
        $data = $request->all();
        $validator = Validator::make($data, [
            'slug' => 'required|unique:van_ban,_id,'.$data['id'],
            'ten' => 'required',
            'mo_ta' => 'required',
        ]);
        if ($validator->fails()) {
          return redirect(env('APP_URL').$locale .'/admin/van-ban/edit/'.$data['id'].'?trans_id='.$data['trans_id'].'&trans_lang='.$data['trans_lang'])->withErrors($validator)->withInput();
        }
        $arr_dinhkem = array();
        if(isset($data['file_aliasname']) && $data['file_aliasname']){
            foreach($data['file_aliasname'] as $k => $v){
              array_push($arr_dinhkem, array('aliasname' => $v, 'filename' => $data['file_filename'][$k], 'title' => $data['file_title'][$k], 'size' => $data['file_size'][$k], 'type' => $data['file_type'][$k]));
            }
        }

        $id_user = $request->session()->get('user._id');
        $db = VanBan::find($data['id']);
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
        $trans->collection = 'van_ban';
        $trans->save();
        $logQuery = array (
            'action' => 'Chỉnh sửa Văn bản ['.$data['ten'].']',
            'id_collection' => $data['id'],
            'collection' => 'van_ban',
            'data' => $data
        );
        LogController::addLog($logQuery);
        Session::flash('msg', 'Cập nhật thành công');
        if($trans_lang) return redirect(env('APP_URL') .$trans_lang.'/admin/van-ban');
        return redirect(env('APP_URL') .$locale.'/admin/van-ban');
    }

    function delete(Request $request, $locale = '', $id = ''){
        $data = VanBan::find($id);
        $logQuery = array (
            'action' => 'Xóa Văn bản ['.$data['ten'].']',
            'id_collection' => $id,
            'collection' => 'van_ban',
            'data' => $data
        );

        if($data['attachments']) {
            foreach($data['attachments'] as $dk){
                FileController::remove($dk['aliasname']);
            }
        }
        VanBan::destroy($id);
        $id_path = ObjectController::ObjectId($id);
        $trans = TranslatePath::where('id_'.$locale, '=', $id_path)->first();
        if($trans){
            $trans->unset('id_'.$locale);
            $trans->unset('slug_'.$locale);
        }
        LogController::addLog($logQuery);
        Session::flash('msg', 'Xóa thành công');
        return redirect(env('APP_URL').$locale.'/admin/van-ban');
    }
}
