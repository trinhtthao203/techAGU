<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TranslatePath;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ObjectController;
use Illuminate\Support\Facades\Session;
class TranslatePathController extends Controller
{
    //
    function index(Request $request, $locale = 'vi') {
        $slug = $request->input('slug');
        if($slug) {
            $danhsach = TranslatePath::where('slug_vi', 'regexp', '/.*'.$slug.'/i')
                ->orWhere('slug_en', 'regexp', '/.*'.$slug.'/i')
                ->orWhere('collection', 'regexp', '/.*'.$slug.'/i')
                ->orderBy('updated_at', 'desc')->paginate(20);
        } else {
            $danhsach = TranslatePath::orderBy('updated_at', 'desc')->paginate(20);
        }

        return view('Admin.TranslatePath.list')->with(compact('danhsach', 'slug'));
    }

    function add(Request $request, $locale = '') {
        return view('Admin.TranslatePath.add');
    }

    function delete(Request $request, $locale = '', $id = '') {
        $data = TranslatePath::find($id);
        TranslatePath::destroy($id);
        $logQuery = array (
            'action' => 'Xóa Translate Path ['.$data['slug_vi'].']',
            'id_collection' => $data['_id'],
            'collection' => $data['collection'],
            'data' => $data
        );
        LogController::addLog($logQuery);
        Session::flash('msg', 'Cập nhật thành công');
        return redirect(env('APP_URL') .$locale.'/admin/translate-path');
    }

    function create(Request $request, $locale = '') {
        $data = $request->all();
        $db = new TranslatePath();
        $id = ObjectController::Id();
        $db->_id = $id;
        $db->id_vi = '';
        $db->id_en = '';
        $db->collection = 'page';
        $db->slug_vi = $data['slug_vi'];
        $db->slug_en = $data['slug_en'];
        $db->save();
        $logQuery = array (
            'action' => 'Thêm Translate Path ['.$data['slug_vi'].']',
            'id_collection' => $id,
            'collection' => 'page',
            'data' => $data
        );
        LogController::addLog($logQuery);
        Session::flash('msg', 'Cập nhật thành công');
        return redirect(env('APP_URL').$locale.'/admin/translate-path');
    }

    function edit(Request $request, $locale = '', $id = '') {
        $ds = TranslatePath::find($id);
        return view('Admin.TranslatePath.edit')->with(compact('ds'));
    }

     function update(Request $request, $locale = '') {
        $data = $request->all();
        $db = TranslatePath::find($data['id']);
        $db->id_vi = '';
        $db->id_en = '';
        $db->collection = 'page';
        $db->slug_vi = $data['slug_vi'];
        $db->slug_en = $data['slug_en'];
        $db->save();
        $logQuery = array (
            'action' => 'Sửa Translate Path ['.$data['slug_vi'].']',
            'id_collection' => $data['id'],
            'collection' => 'page',
            'data' => $data
        );
        LogController::addLog($logQuery);
        Session::flash('msg', 'Cập nhật thành công');
        return redirect(env('APP_URL').$locale.'/admin/translate-path');
    }

    static function getPath($path='') {
        $locale = app()->getLocale();
        $arr_path = explode('/', $path);
        $path = str_replace($locale.'/', '', $path);
        $path_slug = end($arr_path);
        $ds = TranslatePath::where('slug_'.$locale, '=', $path)->orWhere('slug_'.$locale, '=', $path_slug)->first();
        if($ds) {
            if($locale == 'vi') return 'en/'. $ds['slug_en'];
            else return 'vi/'.$ds['slug_vi'];
        }
        return '';
    }

    static function check_id($lang = ''){

    }

}
