<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class TranslateController extends Controller
{
    //
    function index(Request $request){
        $locale = app()->getLocale();
        $keyword = $request->input('keyword');
        $file_path = base_path('resources/lang/') . $locale . '.json';
        $datos = file_get_contents($file_path);
        $data = json_decode($datos, true);
        if($keyword){
            $data = json_decode($datos, true);
            $data = Arr::where($data, function ($value, $key) use ($keyword){
                return Str::contains(strtolower($value), strtolower($keyword)) || Str::contains(strtolower($key), strtolower($keyword));
            });
        }
        return view('Admin.Translate.index')->with(compact('data', 'keyword'));
    }

    function add(Request $request){
        $key = $request->input('key');
        $value = '';
        return view('Admin.Translate.add')->with(compact('key', 'value'));
    }

    function create(Request $request){
        $locale = app()->getLocale();
        $file_path = base_path('resources/lang/') . $locale . '.json';
        $datos = file_get_contents($file_path);
        $arr_data = json_decode($datos, true);

        $data = $request->all();
        $arr_data[trim($data['key'])] = trim($data['value']);
        $new_data =  json_encode($arr_data, JSON_UNESCAPED_UNICODE);
        file_put_contents($file_path, stripslashes($new_data));
        return redirect(env('APP_URL').$locale.'/admin/translate');
    }

    function update(Request $request){
        $locale = app()->getLocale();
        $file_path = base_path('resources/lang/') . $locale . '.json';
        $datos = file_get_contents($file_path);
        $arr_data = json_decode($datos, true);

        $data = $request->all();
        unset($arr_data['old_key']);
        $arr_data[trim($data['key'])] = trim($data['value']);
        $new_data =  json_encode($arr_data, JSON_UNESCAPED_UNICODE);
        file_put_contents($file_path, stripslashes($new_data));
        return redirect(env('APP_URL').$locale.'/admin/translate');
    }

    function edit(Request $request, $locale = '', $key = ''){
        $locale = app()->getLocale();
        $file_path = base_path('resources/lang/') . $locale . '.json';
        $datos = file_get_contents($file_path);
        $arr_data = json_decode($datos, true);
        $value = $arr_data[$key];
        return view('Admin.Translate.edit')->with(compact('key', 'value'));
    }

    function delete(Request $request, $locale = '', $key = ''){
        $locale = app()->getLocale();
        $file_path = base_path('resources/lang/') . $locale . '.json';
        $datos = file_get_contents($file_path);
        $arr_data = json_decode($datos, true);

        $data = $request->all();
        unset($arr_data[$key]);
        $new_data =  json_encode($arr_data, JSON_UNESCAPED_UNICODE);
        file_put_contents($file_path, stripslashes($new_data));
        return redirect(env('APP_URL').$locale.'/admin/translate');
    }
}
