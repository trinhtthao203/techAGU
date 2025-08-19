<?php

namespace App\Http\Controllers;

use App\Models\DaoTao;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\ObjectController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\TranslatePathController;
use Illuminate\Support\Facades\Validator;
use App\Models\TranslatePath;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\FileController;
class DaoTaoController extends Controller
{
    const TAGS = array('Đại học','Thạc sỹ','Tiến sĩ');
    const TAGSEN= array('University Programs','Masters Programs');
    static function get_tags(){
        return self::TAGS;
    }
    static function get_tagsen(){
        return self::TAGSEN;
    }
    static function get_list_dh(){
        $danhsach_dtdh= DaoTao::where('slugtags','=','dai-hoc')->orderBy('date_post', 'desc')->paginate(30);
        return $danhsach_dtdh ;
    }
    static function get_list_ts(){
        $danhsach_dtts= DaoTao::where('slugtags','=','thac-sy')->orderBy('date_post', 'desc')->paginate(30);
        return $danhsach_dtts;
    }
    static function get_list_dh_en(){
        $danhsach_dtdh= DaoTao::where('slugtags','=','university-programs')->orderBy('date_post', 'desc')->paginate(30);
        return $danhsach_dtdh ;
    }
    static function get_list_ts_en(){
        $danhsach_dtts= DaoTao::where('slugtags','=','masters-programs')->orderBy('date_post', 'desc')->paginate(30);
        return $danhsach_dtts;
    }
    function list(Request $request, $locale = ''){
        
        $danhsach = DaoTao::where('locale','=',$locale);
        $danhsach = $danhsach->where('locale','=',$locale)->orderBy('thu_tu', 'asc')->orderBy('date_post', 'desc')->paginate(30);
        return view('Admin.DaoTao.list')->with(compact('danhsach'));
    }
    function add(Request $request, $locale = ''){
        $trans_id = $request->input('trans_id');
        $trans_lang = $request->input('trans_lang');
        if($trans_id){
            $ds = DaoTao::find($trans_id);
        } else {
            $ds = '';
        }
        if($locale=='vi')
        {
            $tags = self::TAGS;
            return view('Admin.DaoTao.add')->with(compact('ds','trans_id', 'trans_lang','tags'));
        }
        else
        {
            $tags = self::TAGSEN;
            return view('Admin.DaoTao.add')->with(compact('ds','trans_id', 'trans_lang','tags'));
        }
    }
    function create(Request $request, $locale = ''){
        $data = $request->all();
        $validator = Validator::make($data, [
            'slug' => 'required|unique:dao-tao',
            'ten' => 'required'
        ]);
        if ($validator->fails()) {
          return redirect(env('APP_URL').$locale .'/admin/dao-tao/add?trans_id='.$data['trans_id'].'&trans_lang='.$data['trans_lang'])->withErrors($validator)->withInput();
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
        $db = new DaoTao();
        $db->_id = $id;
        $db->ten = $data['ten'];
        $db->slug = $data['slug'];
        $db->noi_dung = $data['noi_dung'];
        $db->tags = $data['tags'];
        $db->slugtags =Str::slug($data['tags'], '-');
        
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
                $trans->collection = 'dao_tao';
                $trans->save();
            }
        } else {
            $trans = new TranslatePath();
            $trans->{"id_$locale"} = $id;
            $trans->{"slug_$locale"} = $data['slug'];
            $trans->collection = 'dao_tao';
            $trans->save();
        }
        $logQuery = array (
            'action' => 'Thêm Thông tin Đào tạo ['.$data['ten'].']',
            'id_collection' => $id,
            'collection' => 'dao_tao',
            'data' => $data
        );
        LogController::addLog($logQuery);
        Session::flash('msg', 'Cập nhật thành công');
        if($trans_lang) return redirect(env('APP_URL') .$trans_lang.'/admin/dao-tao');
        return redirect(env('APP_URL') .$locale.'/admin/dao-tao');
    }function edit(Request $request, $locale = '', $id = '') {
        $trans_id = $request->input('trans_id');
        $trans_lang = $request->input('trans_lang');
        $ds = DaoTao::find($id);
        if($locale=='vi')
        {
            $tags = self::TAGS;
            return view('Admin.DaoTao.edit')->with(compact('ds','trans_id', 'trans_lang','tags'));
        }
        else
        {
            $tags = self::TAGSEN;
            return view('Admin.DaoTao.edit')->with(compact('ds','trans_id', 'trans_lang','tags'));
        }
    }
    function update(Request $request, $locale = '', $id = '') {
        $data = $request->all();
        $validator = Validator::make($data, [
            'ten' => 'required:dao_tao,_id,'.$data['id']
        ]);
        if ($validator->fails()) {
          return redirect(env('APP_URL').$locale.'/admin/dao-tao/edit/'.$data['id'].'?trans_id='.$data['trans_id'].'&trans_lang='.$data['trans_lang'])->withErrors($validator)->withInput();
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
        $db = DaoTao::find($data['id']);
        $db->ten = $data['ten'];
        $db->slug = $data['slug']; 
        $db->tags = $data['tags'];
        $db->slugtags =Str::slug($data['tags'], '-');
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
        $trans->{"slug_$locale"} = ObjectController::ObjectId($data['id']);
        $trans->collection = 'dao_tao';
        $trans->save();
        $logQuery = array (
            'action' => 'Chỉnh sửa Ngành Đào tạo ['.$data['ten'].']',
            'id_collection' => $data['id'],
            'collection' => 'dao_tao',
            'data' => $data
        );
        LogController::addLog($logQuery);
        Session::flash('msg', 'Cập nhật thành công');
        if($trans_lang) return redirect(env('APP_URL') .$trans_lang.'/admin/dao-tao');
        return redirect(env('APP_URL') .$locale.'/admin/dao-tao');
    }
    function delete(Request $request, $locale='', $id = '') {
        $data = DaoTao::find($id);
        $logQuery = array (
            'action' => 'Xóa Đào tạo ['.$data['ten'].']',
            'id_collection' => $id,
            'collection' => 'dao_tao',
            'data' => $data
        );
        if($data['photos']){
            foreach($data['photos'] as $p){
                ImageController::remove($p['aliasname']);
            }
        }
        DaoTao::destroy($id);
        $id_path = ObjectController::ObjectId($id);
        $trans = TranslatePath::where('id_'.$locale, '=', $id_path)->first();
        if($trans){
            $trans->unset('id_'.$locale);
            $trans->unset('slug_'.$locale);
        }
        LogController::addLog($logQuery);
        Session::flash('msg', 'Cập nhật thành công');
        return redirect(env('APP_URL').$locale.'/admin/dao-tao');
    }
   
}
