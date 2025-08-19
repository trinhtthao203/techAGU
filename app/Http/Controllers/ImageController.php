<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Config;
class ImageController extends Controller
{
    //
    function uploads(Request $request, $locale = ''){
      $locale = app()->getLocale();
      $files = $request->file('hinhanh_files');
    	if(!empty($files)):
    		foreach($files as $file):
          $extension = $file->getClientOriginalExtension();
          $realname = $file->getClientOriginalName();
          $filename = date("YmdHis") . '_' . strtolower(uniqid()) . '.' . $extension;
          Storage::put( '/app/private/images/'.$filename, file_get_contents($file), 'private');
          //$storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
          $origin = storage_path() . '/app/public/images/origin/' . $filename;
          Image::make($file->getRealPath())->save($origin);
          $thumb = storage_path() . '/app/public/images/thumb_360x200/' . $filename;
          Image::make($file->getRealPath())->resize(360, null, function($constraint){ $constraint->aspectRatio();})->save($thumb);
          $thumb_50 = storage_path() . '/app/public/images/thumb_50/' . $filename;
          Image::make($file->getRealPath())->resize(null, 50, function($constraint){ $constraint->aspectRatio();})->save($thumb_50);
          echo '<div class="col-sm-6 col-md-4 items draggable-element text-center">
                <input type="hidden" name="hinhanh_aliasname[]" value="'.$filename.'" readonly/>
                <input type="hidden" name="hinhanh_filename[]" class="form-control" value="'.$realname.'" />
                  <a href="'.env('APP_URL').'storage/images/origin/'.$filename.'" class="image-popup">
                    <div class="portfolio-masonry-box">
                      <div class="portfolio-masonry-img">
                        <img src="'.env('APP_URL').'storage/images/thumb_360x200/'.$filename.'" class="thumb-img img-fluid" alt="'.$filename.'">
                      </div>
                      <div class="portfolio-masonry-detail">
                        <p>'.$realname.'</p>
                      </div>
                    </div>
                  </a>
                  <a href="'.env('APP_URL').$locale.'/image/delete/'.$filename.'" onclick="return false;" class="btn btn-danger btn-sm delete_file" style="position:absolute;top:40px;right:30px;">
                    <i class="fa fa-trash"></i>
                  </a>
                  <input type="text" name="hinhanh_title[]" class="form-control" value="'.$realname.'" />
                </div>';
    		endforeach;
    	endif;
    }

    function delete(Request $request, $locale = '', $filename =''){
      //Storage::delete('private/images/'.$filename);
      //Storage::delete('public/images/origin/'.$filename);
      //Storage::delete('public/images/thumb_360x200/'.$filename);
      //Storage::delete('public/images/thumb_50/'.$filename);
      //Storage::delete('public/images/thumb_800x800/'.$filename);
      //Storage::delete('public/images/thumb_785x476/'.$filename);
    }

    static function remove($filename){
      //Storage::delete('private/images/'.$filename);
      //Storage::delete('public/images/origin/'.$filename);
      //Storage::delete('public/images/thumb_360x200/'.$filename);
      //Storage::delete('public/images/thumb_50/'.$filename);
      //Storage::delete('public/images/thumb_800x800/'.$filename);
      //Storage::delete('public/images/thumb_785x476/'.$filename);
    }
}
