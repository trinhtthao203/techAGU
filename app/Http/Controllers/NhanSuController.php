<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ObjectController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\TranslatePathController;
use App\Models\NhanSu;
use App\Models\TranslatePath;   
use Illuminate\Support\Facades\Session; use Illuminate\Support\Facades\Validator;
class NhanSuController extends Controller
{
    //
    protected $arr_bo_phan = array(
        'lanh-dao-khoa' => 'Lãnh đạo Khoa',
        'van-phong-khoa' => 'Văn phòng Khoa',
        'bo-mon-cong-nghe-thuc-pham' => 'Bộ môn Công nghệ Thực phẩm',
        'bo-mon-nuoi-trong-thuy-san' => 'Bộ môn Nuôi trồng thủy sản',
        'bo-mon-cong-nghe-sinh-hoc' => 'Bộ môn Công nghệ Sinh Học',
        'bo-mon-chan-nuoi-thu-y' => 'Bộ môn Chăn nuôi Thú y',
        'bo-mon-khoa-hoc-cay-trong' => 'Bộ môn Khoa học Cây trồng',
        'bo-mon-phat-trien-nong-thon-va-qltntn' => 'Bộ môn Phát triển Nông thôn và QLTNTN',
    );
    
    function list(Request $request, $locale = '', $tags = ''){
        if($locale=='vi'){
            $file_path = base_path('resources/lang/') . $locale .('/tong-quan-') .$tags. ('.txt');
        }
        else
        {
            if($tags=='ban-lanh-dao-khoa'){
                $tagsen='faculty-leaders';
                $file_path = base_path('resources/lang/') . $locale .('/tong-quan-faculty-leaders.txt');  
            }
            elseif($tags=='van-phong-khoa'){
                $tagsen='faculty-office';
                $file_path = base_path('resources/lang/') . $locale .('/tong-quan-faculty-office.txt');
            }
            elseif($tags=='bo-mon-cong-nghe-thuc-pham'){
                $tagsen='department-of-food-technology';
                $file_path = base_path('resources/lang/') . $locale .('/tong-quan-department-of-food-technology.txt');
            }
            elseif($tags=='bo-mon-nuoi-trong-thuy-san'){
                $tagsen='department-of-aquaculture';
                $file_path = base_path('resources/lang/') . $locale .('/tong-quan-department-of-aquaculture.txt');
            }
            elseif($tags=='bo-mon-cong-nghe-sinh-hoc'){
                $tagsen='department-of-biotechnology';
                $file_path = base_path('resources/lang/') . $locale .('/tong-quan-department-of-biotechnology.txt');
            }
            elseif($tags=='bo-mon-chan-nuoi-thu-y'){
                $tagsen='department-of-animal-husbandry-and-veterinary-medicine';
                $file_path = base_path('resources/lang/') . $locale .('/tong-quan-department-of-animal-husbandry-and-veterinary-medicine.txt');
            }
            elseif($tags=='bo-mon-khoa-hoc-cay-trong'){
                $tagsen='department-of-crop-science';
                $file_path = base_path('resources/lang/') . $locale .('/tong-quan-department-of-crop-science.txt');
            }
            elseif($tags=='bo-mon-phat-trien-nong-thon-va-qltntn'){
                $tagsen='department-of-rural-development-and-natural-resource-management';
                $file_path = base_path('resources/lang/') . $locale .('/tong-quan-department-of-rural-development-and-natural-resource-management.txt');
            }
        }
        $noi_dung = file_get_contents($file_path);
        $keywords = $request->input('keywords');
        $danhsach = NhanSu::where('tags','=',$tags)->where('locale','=',$locale)->orderBy('updated_at', 'desc')->paginate(30);
        return view('Admin.NhanSu.list')->with(compact('danhsach','tags','noi_dung'));
    }

    function add(Request $request, $locale = '', $tags = ''){
        $trans_id = $request->input('trans_id');
        $trans_lang = $request->input('trans_lang');
        if($trans_id){
            $ds = NhanSu::find($trans_id);
        } else {
            $ds = '';
        }
        return view('Admin.NhanSu.add')->with(compact('ds','trans_id', 'trans_lang','tags'));
    }

    function create(Request $request, $locale = '', $tags = ''){
        $data = $request->all();
        $validator = Validator::make($data, [
            'ho_ten' => 'required:nhan_su'
        ]);
        if ($validator->fails()) {
          return redirect(env('APP_URL').$locale .'/admin/nhan-su/'.$tags.'/add?trans_id='.$data['trans_id'].'&trans_lang='.$data['trans_lang'])->withErrors($validator)->withInput();
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
        $db = new NhanSu();
        $db->_id = $id;
        $db->ho_ten = $data['ho_ten'];
        $db->chuc_vu = $data['chuc_vu'];
        $db->hoc_vi = $data['hoc_vi'];
        $db->chuyen_nganh = $data['chuyen_nganh'];
        $db->dien_thoai = $data['dien_thoai'];
        $db->email = $data['email'];
        $db->mo_ta = $data['mo_ta'];
        $db->thu_tu = isset($data['thu_tu']) ? intval($data['thu_tu']) : 0;
        $db->photos = $arr_photo;
        $db->attachments = $arr_dinhkem;
        $db->tags = $tags;
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
                $trans->collection = 'nhan_su';
                $trans->save();
            }
            else {
                $trans = new TranslatePath();
                $trans->{"id_$locale"} = $id;
                $trans->{"slug_$locale"} = $id;
                $trans->{"id_$trans_lang"} = $trans_id;
                $trans->{"slug_$trans_lang"} = $trans_id;
                $trans->collection = 'nhan_su';
                $trans->save();
            }
        } /*else {
            $trans = new TranslatePath();
            $trans->{"id_$locale"} = $id;
            $trans->{"slug_$locale"} = $id;
            $trans->collection = 'nhan_su';
            $trans->save();
        }*/

        
        $logQuery = array (
            'action' => 'Thêm Nhân sự ['.$data['ho_ten'].']',
            'id_collection' => $id,
            'collection' => 'nhan_su',
            'data' => $data
        );
        LogController::addLog($logQuery);
        Session::flash('msg', 'Cập nhật thành công');
        if($trans_lang) return redirect(env('APP_URL') .$trans_lang.'/admin/nhan-su/'.$tags);
        return redirect(env('APP_URL') .$locale.'/admin/nhan-su/'.$tags);
    }

    function edit(Request $request, $locale = '',$tags='', $id = ''){
        $trans_id = $request->input('trans_id');
        $trans_lang = $request->input('trans_lang');
        $ds = NhanSu::find($id);
        return view('Admin.NhanSu.edit')->with(compact('ds','trans_id', 'trans_lang','tags'));
    }

    function update(Request $request, $locale = '', $tags = ''){
        $data = $request->all();
        $validator = Validator::make($data, [
            'ho_ten' => 'required|unique:nhan_su,_id,'.$data['id']
        ]);
        if ($validator->fails()) {
          return redirect(env('APP_URL').$locale .'/admin/nhan-su/'.$tags.'/edit/'.$data['id'].'?trans_id='.$data['trans_id'].'&trans_lang='.$data['trans_lang'])->withErrors($validator)->withInput();
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
        $db = NhanSu::find($data['id']);
        $db->ho_ten = $data['ho_ten'];
        $db->chuc_vu = $data['chuc_vu'];
        $db->hoc_vi = $data['hoc_vi'];
        $db->chuyen_nganh = $data['chuyen_nganh'];
        $db->dien_thoai = $data['dien_thoai'];
        $db->email = $data['email'];
        $db->mo_ta = $data['mo_ta'];
        $db->thu_tu = isset($data['thu_tu']) ? intval($data['thu_tu']) : 0;
        $db->photos = $arr_photo;
        $db->attachments = $arr_dinhkem;
        $db->tags = $tags;
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
        $trans->collection = 'nhan_su';
        $trans->save();
        $logQuery = array (
            'action' => 'Chỉnh sửa Nhân sự ['.$data['ho_ten'].']',
            'id_collection' => ObjectController::ObjectId($data['id']),
            'collection' => 'nhan_su',
            'data' => $data
        );
        LogController::addLog($logQuery);
        Session::flash('msg', 'Cập nhật thành công');
        if($trans_lang) return redirect(env('APP_URL') .$trans_lang.'/admin/nhan-su/'.$tags);
        return redirect(env('APP_URL') .$locale.'/admin/nhan-su/'.$tags);
    }

    function delete(Request $request, $locale = '',$tags='', $id = ''){
        $data = NhanSu::find($id);
        $tags = $data['tags'];
        $logQuery = array (
            'action' => 'Xóa Nhân sự ['.$data['ho_ten'].']',
            'id_collection' => $id,
            'collection' => 'nhan_su',
            'data' => $data
        );
        if($data['photos']){
            foreach($data['photos'] as $p){
                ImageController::remove($p['aliasname']);
            }
        }
        NhanSu::destroy($id);
        $id_path = ObjectController::ObjectId($id);
        $trans = TranslatePath::where('id_'.$locale, '=', $id_path)->first();
        if($trans){
            $trans->unset('id_'.$locale);
            $trans->unset('slug_'.$locale);
        }
        LogController::addLog($logQuery);
        Session::flash('msg', 'Xóa thành công');
        return redirect(env('APP_URL').$locale.'/admin/nhan-su/'.$tags);
    }

    function tong_quan_update (Request $request, $locale = '', $tags='') { 
        if($locale=='vi'){
            $file_path = base_path('resources/lang/') . $locale .('/tong-quan-') .$tags. ('.txt');
        }
       
        else
        {
            if($tags=='ban-lanh-dao-khoa'){
                $tagsen='faculty-leaders';
                $file_path = base_path('resources/lang/') . $locale .('/tong-quan-faculty-leaders.txt');  
            }
            elseif($tags=='van-phong-khoa'){
                $tagsen='faculty-office';
                $file_path = base_path('resources/lang/') . $locale .('/tong-quan-faculty-office.txt');
            }
            elseif($tags=='bo-mon-cong-nghe-thuc-pham'){
                $tagsen='department-of-food-technology';
                $file_path = base_path('resources/lang/') . $locale .('/tong-quan-department-of-food-technology.txt');
            }
            elseif($tags=='bo-mon-nuoi-trong-thuy-san'){
                $tagsen='department-of-aquaculture';
                $file_path = base_path('resources/lang/') . $locale .('/tong-quan-department-of-aquaculture.txt');
            }
            elseif($tags=='bo-mon-cong-nghe-sinh-hoc'){
                $tagsen='department-of-biotechnology';
                $file_path = base_path('resources/lang/') . $locale .('/tong-quan-department-of-biotechnology.txt');
            }
            elseif($tags=='bo-mon-chan-nuoi-thu-y'){
                $tagsen='department-of-animal-husbandry-and-veterinary-medicine';
                $file_path = base_path('resources/lang/') . $locale .('/tong-quan-department-of-animal-husbandry-and-veterinary-medicine.txt');
            }
            elseif($tags=='bo-mon-khoa-hoc-cay-trong'){
                $tagsen='department-of-crop-science';
                $file_path = base_path('resources/lang/') . $locale .('/tong-quan-department-of-crop-science.txt');
            }
            elseif($tags=='bo-mon-phat-trien-nong-thon-va-qltntn'){
                $tagsen='department-of-rural-development-and-natural-resource-management';
                $file_path = base_path('resources/lang/') . $locale .('/tong-quan-department-of-rural-development-and-natural-resource-management.txt');
            }

        }
        $noi_dung = $request->input('noi_dung');
        file_put_contents($file_path, $noi_dung);
        Session::flash('msg', 'Cập nhật thành công.');
        // if($locale=='vi')
        return redirect(env('APP_URL').$locale.'/admin/nhan-su/'.$tags);
        // else
        // return redirect(env('APP_URL').$locale.'/admin/personel/'.$tagsen);
    }
}
