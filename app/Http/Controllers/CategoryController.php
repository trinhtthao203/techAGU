<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ObjectController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\TranslatePathController;
use App\Models\Category;
use App\Models\TranslatePath;
use Illuminate\Support\Facades\Session; use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //
    protected const CATS = array(
        'nghien-cuu-khoa-hoc'=>'Nghiên cứu khoa học',
        'quan-he-doi-ngoai'=>'Quan hệ đối ngoại',
        'doan-the'=>'Đoàn thể',
        'hoat-dong-doi-ngoai'=>'Hoạt động đối ngoại',
        'hoc-bong'=>'Học bổng',
        'su-kien'=>'Sự kiện',
        'thong-bao'=>'Thông báo',
        'tuyen-dung'=>'Tuyển dụng',
        'uncategorized'=>'Uncategorized',
        'tin-tuc'=>'Tin tức',
        'de-tai'=>'Đề tài',
        'hoi-thao'=>'Hội thảo',
        'dam-bao-chat-luong'=>'Đảm bảo chất lượng',
        'thong-bao-he-chinh-quy'=>'Thông báo hệ chính quy'

    );
    protected const CATSEN = array(
        'scientific-research'=>'Scientific Research',
        'international-cooperation'=>'International cooperation',
        'union'=>'Union',
        'foreign-affairs-activities'=>'Foreign affairs activities',
        'scholarship'=>'Scholarship',
        'events'=>'Events',
        'announcement'=>'Announcement',
        'recruitment'=>'Recruitment',
        'uncategorized'=>'Uncategorized',
        'news'=>'News',
        'topic'=>'Topic',
        'seminar'=>'Seminar',
        'qa'=>'Quality Assurance',
        'full-time-notice'=>'Fulltme Notice',
    );

    static function get_cats() {
        return self::CATS;
    }
    static function get_catsen() {
        return self::CATSEN;
    }

    function list(Request $request, $locale = ''){
        if($locale=='')
            $locale='vi';
        if($locale=='vi')
            $cats = self::CATS;
        else{
            $cats = self::CATSEN;
        }
        $keywords = $request->input('keywords');
        //$danhsach = Category::where('locale','=',$locale)->orderBy('date_post', 'desc')->paginate(30);
        // $danhsach = Category::where('locale','=',$locale)->orderBy('date_post', 'desc')->limit(30)->get();
        $danhsach = Category::where('locale','=',$locale)
                    ->orderBy('tin_moi', 'desc')
                    ->orderBy('date_post', 'desc')
                    ->limit(30)
                    ->get();


        $danhsach->transform(function ($category) use ($locale) {
            $translation = TranslatePath::where("id_{$locale}", ObjectController::ObjectId($category->_id))->select('id_vi', 'id_en')->first();
            $translationArray = $translation ? $translation->toArray() : [];
            $category->translation = $translationArray;
            return $category;
        });

    if($danhsach->toArray()); // Kiểm tra dữ liệu đầy đủ
        return view('Admin.Category.list')->with(compact('danhsach', 'cats'));
    }

    function add(Request $request, $locale = ''){
        $trans_id = $request->input('trans_id');
        $trans_lang = $request->input('trans_lang');
        if($trans_id){
            $ds = Category::find($trans_id);
        } else {
            $ds = '';
        }
        if($locale=='vi')
        $cats = self::CATS;
        else
        $cats = self::CATSEN;
        // dd($cats);
        return view('Admin.Category.add')->with(compact('ds','trans_id', 'trans_lang','cats'));
    }

    function create(Request $request, $locale = ''){
        $data = $request->all();
        $validator = Validator::make($data, [
            'slug' => 'required',
        ]);
        if ($validator->fails()) {
          return redirect(env('APP_URL').$locale .'/admin/category/add?trans_id='.$data['trans_id'].'&trans_lang='.$data['trans_lang'])->withErrors($validator)->withInput();
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
        $db = new Category();
        $db->_id = $id;
        $db->ten = $data['ten'];
        $db->slug = $data['slug'];
        $db->mo_ta = $data['mo_ta'];
        $db->noi_dung = $data['noi_dung'];
        $db->thu_tu = intval($data['thu_tu']);
        $db->id_cat = $data['id_cat'];
        $db->photos = $arr_photo;
        $db->attachments = $arr_dinhkem;
        $db->locale = $locale;
        $db->date_post = $data['date_post'];
        $db->tin_moi = isset($data['tin_moi']) ? intval($data['tin_moi']) : 0;
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
                $trans->collection = 'category';
                $trans->save();
            }
        } else {
            $trans = new TranslatePath();
            $trans->{"id_$locale"} = $id;
            $trans->{"slug_$locale"} = $data['slug'];
            $trans->collection = 'category';
            $trans->save();
        }
        $logQuery = array (
            'action' => 'Thêm Thông tin ['.$data['ten'].']',
            'id_collection' => $id,
            'collection' => 'category',
            'data' => $data
        );
        LogController::addLog($logQuery);
        Session::flash('msg', 'Cập nhật thành công');
        if($trans_lang) return redirect(env('APP_URL') .$trans_lang.'/admin/category');
        return redirect(env('APP_URL') .$locale.'/admin/category');
    }

    function edit(Request $request, $locale = '', $id = ''){
        $trans_id = $request->input('trans_id');
        $trans_lang = $request->input('trans_lang');
        $ds = Category::find($id);
        if($locale=='vi')
        $cats = self::CATS;
        else
        $cats = self::CATSEN;
        return view('Admin.Category.edit')->with(compact('ds','trans_id', 'trans_lang','cats'));
    }

    function update(Request $request, $locale = '', $id = ''){
        $data = $request->all();
        $validator = Validator::make($data, [
            'slug' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect(env('APP_URL').$locale .'/admin/category/edit/'.$data['id'].'?trans_id='.$data['trans_id'].'&trans_lang='.$data['trans_lang'])->withErrors($validator)->withInput();
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
        $db = Category::find($data['id']);
        $db->ten = $data['ten'];
        $db->slug = $data['slug'];
        $db->mo_ta = $data['mo_ta'];
        $db->noi_dung = $data['noi_dung'];
        $db->thu_tu = intval($data['thu_tu']);
        $db->id_cat = $data['id_cat'];
        $db->photos = $arr_photo;
        $db->attachments = $arr_dinhkem;
        $db->locale = $locale;
        $db->date_post = $data['date_post'];
        $db->tin_moi = isset($data['tin_moi']) ? intval($data['tin_moi']) : 0;
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
        $trans->collection = 'category';
        $trans->save();
        $logQuery = array (
            'action' => 'Chỉnh sửa Văn bản ['.$data['ten'].']',
            'id_collection' => $data['id'],
            'collection' => 'category',
            'data' => $data
        );
        LogController::addLog($logQuery);
        Session::flash('msg', 'Cập nhật thành công');
        if($trans_lang) return redirect(env('APP_URL') .$trans_lang.'/admin/category');
        return redirect(env('APP_URL') .$locale.'/admin/category');
    }

    function delete(Request $request, $locale = '', $id = ''){
        $data = Category::find($id);
        $logQuery = array (
            'action' => 'Xóa Văn bản ['.$data['ten'].']',
            'id_collection' => $id,
            'collection' => 'category',
            'data' => $data
        );

        if($data['attachments']) {
            foreach($data['attachments'] as $dk){
                FileController::remove($dk['aliasname']);
            }
        }
        Category::destroy($id);
        $id_path = ObjectController::ObjectId($id);
        $trans = TranslatePath::where('id_'.$locale, '=', $id_path)->first();
        if($trans){
            $trans->unset('id_'.$locale);
            $trans->unset('slug_'.$locale);
        }
        LogController::addLog($logQuery);
        Session::flash('msg', 'Xóa thành công');
        return redirect(env('APP_URL').$locale.'/admin/category');
    }
}
