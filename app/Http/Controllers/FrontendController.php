<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\TinTucSuKien;
use App\Models\NghienCuuKhoaHoc;
use App\Models\VanBan;
use App\Models\HoiNghiHoiThao;
use App\Models\CongBoKhoaHoc;
use App\Models\DuAn;
use App\Models\DichVu;
use App\Models\DoiTac;
use App\Models\HinhAnh;
use App\Models\NhanSu;
use App\Http\Controllers\VanBanController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Controllers\ObjectControler;
use App\Models\KhoaLuanTotNghiep;
use App\Models\DaoTao;
use App\Models\BieuMau;
use App\Models\Category;
use App\Models\HinhAnhHoatDong;
use Illuminate\Support\Facades\Config;

class FrontendController extends Controller
{
    //
    function index(Request $request, $locale = '') {
        if($locale=='vi')
        {
            $danhsach_dao_tao = DaoTao::where('locale', '=', $locale)->where('tags','=','Đại học')->orderBy('date_post', 'desc')->paginate(30);
        }
        else
        {
            $danhsach_dao_tao = DaoTao::where('locale', '=', $locale)->where('tags','=','University Programs')->orderBy('date_post', 'desc')->paginate(30);   
        }
        
        $danhsach_hinh_anh_hoat_dong=HinhAnhHoatDong::orderBy('order', 'asc')->orderBy('date_post', 'desc')->paginate(27);
        $danhsach_hinh_anh_hoat_dong2=Category::orderBy('order', 'asc')->orderBy('date_post', 'desc')->paginate(27);
        $danhsach_category=Category::where('locale', '=', $locale)->orderBy('tin_moi', 'desc')->orderBy('date_post', 'desc')->paginate(9);
        return view('Frontend.index')->with(compact('danhsach_dao_tao','danhsach_hinh_anh_hoat_dong2','danhsach_hinh_anh_hoat_dong','danhsach_category'));
    }
    // function nhiem_vu_khoa_hoc_cong_nghe(Request $request, $locale = '') {
    //     $danhsach = NghienCuuKhoaHoc::where('locale', '=', $locale)->orderBy('updated_at', 'desc')->paginate(20);
    //     return view('Frontend.nhiem-vu-khoa-hoc-cong-nghe')->with(compact('danhsach'));
    // }
    // function nhiem_vu_khoa_hoc_cong_nghe_ct(Request $request, $locale = '', $slug='') {
    //     $ds = NghienCuuKhoaHoc::where('locale', '=', $locale)->where('slug','=',ObjectController::ObjectId($slug))->first();
    //     $danhsach = NghienCuuKhoaHoc::where('locale', '=', $locale)->orderBy('updated_at', 'desc')->paginate(7);
    //     return view('Frontend.nhiem-vu-khoa-hoc-cong-nghe-ct')->with(compact('danhsach','ds'));
    // }
    // function du_an(Request $request, $locale = '') {
    //     $danhsach = DuAn::where('locale', '=', $locale)->orderBy('updated_at', 'desc')->paginate(7);
    //     return view('Frontend.du-an')->with(compact('danhsach'));
    // }
    function khoa_luan_tot_nghiep(Request $request, $locale = '') {
        $danhsach = KhoaLuanTotNghiep::orderBy('updated_at', 'desc')->paginate(7);
        return view('Frontend.khoa-luan-tot-nghiep')->with(compact('danhsach'));
    }
    function khoa_luan_tot_nghiep_tags(Request $request, $locale = '', $key = 0) {
        $tags = KhoaLuanTotNghiepController::get_tags();
        if($locale=='en')
        {
            if($key=='graduation-thesis') $tamp= 'Khóa luận tốt nghiệp';
            elseif($key=='thesis') $tamp= 'Chuyên đề tốt nghiệp';
        }
        else
        $tamp=$tags[$key];
        $danhsach = KhoaLuanTotNghiep::where('tags','=',$tamp)->orderBy('date_post', 'desc')->paginate(9);
        return view('Frontend.khoa-luan-tot-nghiep')->with(compact('danhsach'));
    }
    function khoa_luan_tot_nghiep_xtt(Request $request, $locale = '', $id = '', $key = 0) {
        $ds = KhoaLuanTotNghiep::find($id);
        $key = intval($key);
        echo '<embed src="'.env('APP_URL').'storage/files/'.$ds['attachments'][$key]['aliasname'].'" style="width:100%;min-height:80vh;height:100% !important;" />';
    }
    function khoa_luan_tot_nghiep_tv(Request $request, $locale='', $id = '', $key = 0) {
        $ds = KhoaLuanTotNghiep::find($id);
        $key = intval($key);
        $file_path = 'public/files/' . $ds['attachments'][$key]['aliasname'];
        $name  = Str::slug($ds['attachments'][$key]['title'], '-') . '.' . $ds['attachments'][$key]['type'];
        return Storage::download($file_path, $name);
    }
    function nghien_cuu_khoa_hoc(Request $request, $locale = '') {
        $danhsach = NghienCuuKhoaHoc::orderBy('updated_at', 'desc')->paginate(9);
        return view('Frontend.nghien-cuu-khoa-hoc')->with(compact('danhsach'));
    }
    function nghien_cuu_khoa_hoc_cats(Request $request, $locale = '', $key = 0) {
        $cats = NghienCuuKhoaHocController::get_tags();
        if($locale=='en')
        {
            if($key=='elementary-level-topic') $tamp= 'Đề tài cấp Cơ sở';
            elseif($key=='school-level-topic') $tamp= 'Đề tài cấp Trường';
            elseif($key=='national-university-level-topic') $tamp= 'Đề tài cấp ĐHQG';
            elseif($key=='provincial-level-topic') $tamp= 'Đề tài cấp Tỉnh';
        }
        else
        $tamp=$cats[$key];
        //  dd($tamp, $key);
        $danhsach = NghienCuuKhoaHoc::where('tags','=',$tamp)->orderBy('date_post', 'desc')->paginate(9);
        return view('Frontend.nghien-cuu-khoa-hoc')->with(compact('danhsach'));
    }
    // function nghien_cuu_khoa_hoc_xtt(Request $request, $locale = '', $id = '', $key = 0) {
    //     $ds = NghienCuuKhoaHoc::find($id);
    //     $key = intval($key);
    //     echo '<embed src="'.env('APP_URL').'storage/files/'.$ds['attachments'][$key]['aliasname'].'" style="width:100%;min-height:80vh;height:100% !important;" />';
    // }
    function nghien_cuu_khoa_hoc_tv(Request $request, $locale='', $id = '', $key = 0) {
        $ds = NghienCuuKhoaHoc::find($id);
        $key = intval($key);
        $file_path = 'public/files/' . $ds['attachments'][$key]['aliasname'];
        $name  = Str::slug($ds['attachments'][$key]['title'], '-') . '.' . $ds['attachments'][$key]['type'];
        return Storage::download($file_path, $name);
    }
    // function du_an_ct(Request $request, $locale = '', $slug='') {
    //     $ds = DuAn::where('locale', '=', $locale)->where('slug','=',ObjectController::ObjectId($slug))->first();
    //     $danhsach = DuAn::where('locale', '=', $locale)->orderBy('updated_at', 'desc')->paginate(7);
    //     return view('Frontend.du-an-ct')->with(compact('danhsach','ds'));
    // }
    function dao_tao(Request $request, $locale = '') {
        $danhsach = DaoTao::where('locale', '=', $locale)->orderBy('date_post', 'desc')->paginate(20);
        return view('Frontend.dao-tao')->with(compact('danhsach'));
    }
    function dao_tao_ct(Request $request, $locale = '', $slugtags = '', $slug='') {
        $ds = DaoTao::where('locale', '=', $locale)->where('slugtags', '=', $slugtags)->where('slug','=',$slug)->first();
        $danhsach = DaoTao::where('slugtags', '=', $slugtags)->where('locale', '=', $locale)->paginate(7); 
        return view('Frontend.dao-tao-ct')->with(compact('danhsach', 'ds'));
    }
    function dao_tao_tag(Request $request, $locale = '', $key = 0) {
        $tags = DaoTaoController::get_tags();
        $danhsach = DaoTao::where('locale', '=', $locale)->where('tags','=',$tags[$key])->orderBy('date_post', 'desc')->paginate(9);
        return view('Frontend.dao-tao')->with(compact('danhsach'));
    }
    function dao_tao_xtt(Request $request, $locale = '',$slugtags = '', $slug='', $id = '', $key = 0) {
        $ds = DaoTao::where('locale', '=', $locale)->where('slugtags', '=', $slugtags)->where('slug','=',$slug)->find($id);
        $key = intval($key);
        echo '<embed src="'.env('APP_URL').'storage/files/'.$ds['attachments'][$key]['aliasname'].'" style="width:100%;min-height:80vh;height:100% !important;" />';
    }
    function dao_tao_tv(Request $request, $locale='', $slugtags = '', $slug='',$id = '', $key = 0) {
        $ds = DaoTao::where('locale', '=', $locale)->where('slugtags', '=', $slugtags)->where('slug','=',$slug)->find($id);
        $key = intval($key);

        $file_path = 'public/files/' . $ds['attachments'][$key]['aliasname'];
        $name  = Str::slug($ds['attachments'][$key]['title'], '-') . '.' . $ds['attachments'][$key]['type'];
        return Storage::download($file_path, $name);
    }
    // function tin_tuc_su_kien(Request $request, $locale = '') {
    //     $danhsach = TinTucSuKien::where('locale', '=', $locale)->orderBy('date_post', 'desc')->paginate(6);
    //     return view('Frontend.tin-tuc-su-kien')->with(compact('danhsach'));
    // }
    // function tin_tuc_su_kien_tag(Request $request, $locale = '', $key = 0) {
    //     $tags = TinTucSuKienController::get_tags();
    //     $danhsach = TinTucSuKien::where('locale', '=', $locale)->where('tags','=',$tags[$key])->orderBy('date_post', 'desc')->paginate(9);
    //     return view('Frontend.tin-tuc-su-kien')->with(compact('danhsach','tags'));
    // }
    // function tin_tuc_su_kien_ct(Request $request, $locale = '', $slug = '') {
    //     $ds = TinTucSuKien::where('locale', '=', $locale)->where('slug', '=', $slug)->first();
    //     $danhsach = TinTucSuKien::where('tags','=',$ds['tags'])->where('locale', '=', $locale)->paginate(7);
    //     return view('Frontend.tin-tuc-su-kien-ct')->with(compact('danhsach', 'ds'));
    // }
    // function tin_tuc_su_kien_xtt(Request $request, $locale = '', $id = '', $key = 0) {
    //     $ds = TinTucSuKien::find($id);
    //     $key = intval($key);
    //     echo '<embed src="'.env('APP_URL').'storage/files/'.$ds['attachments'][$key]['aliasname'].'" style="width:100%;min-height:80vh;height:100% !important;" />';
    // }
    // function tin_tuc_su_kien_tv(Request $request, $locale='', $id = '', $key = 0) {
    //     $ds = TinTucSuKien::find($id);
    //     $key = intval($key);

    //     $file_path = 'public/files/' . $ds['attachments'][$key]['aliasname'];
    //     $name  = Str::slug($ds['attachments'][$key]['title'], '-') . '.' . $ds['attachments'][$key]['type'];
    //     return Storage::download($file_path, $name);
    // }
    // function doi_tac(Request $request, $locale = '') {
    //     $danhsach = DoiTac::where('locale', '=', $locale)->orderBy('date_post', 'desc')->paginate(9);
    //     return view('Frontend.doi-tac')->with(compact('danhsach'));
    // }
    // function doi_tac_ct(Request $request, $locale = '', $slug = '') {
    //     $ds = DoiTac::where('locale', '=', $locale)->where('slug', '=', $slug)->first();
    //     $danhsach = DoiTac::where('locale', '=', $locale)->paginate(9);
    //     return view('Frontend.doi-tac-ct')->with(compact('danhsach', 'ds'));
    // }
    // function hoi_nghi_hoi_thao(Request $request, $locale = '') {
    //     $danhsach = HoiNghiHoiThao::where('locale', '=', $locale)->paginate(9);
    //     return view('Frontend.hoi-nghi-hoi-thao')->with(compact('danhsach'));
    // }
    // function hoi_nghi_hoi_thao_ct(Request $request, $locale = '', $slug = '') {
    //     $ds = HoiNghiHoiThao::where('locale', '=', $locale)->where('slug', '=', $slug)->first();
    //     $danhsach = HoiNghiHoiThao::where('locale', '=', $locale)->paginate(9);
    //     return view('Frontend.hoi-nghi-hoi-thao-ct')->with(compact('danhsach', 'ds'));
    // }
    // function hoi_nghi_hoi_thao_xtt(Request $request, $locale = '', $id = '', $key = 0) {
    //     $ds = HoiNghiHoiThao::find($id);
    //     $key = intval($key);
    //     echo '<embed src="'.env('APP_URL').'storage/files/'.$ds['attachments'][$key]['aliasname'].'" style="width:100%;min-height:80vh;height:100% !important;" />';
    // }
    // function hoi_nghi_hoi_thao_tv(Request $request, $locale='', $id = '', $key = 0) {
    //     $ds = HoiNghiHoiThao::find($id);
    //     $key = intval($key);
    //     $file_path = 'public/files/' . $ds['attachments'][$key]['aliasname'];
    //     $name  = Str::slug($ds['attachments'][$key]['title'], '-') . '.' . $ds['attachments'][$key]['type'];
    //     return Storage::download($file_path, $name);
    // }
    function van_ban(Request $request, $locale = '') {
        $cats = VanBanController::get_cats(); 
        return view('Frontend.van-ban')->with(compact('cats'));
    }
    function van_ban_ct(Request $request, $locale = '', $slug = '') {
        $ds = VanBan::where('slug', '=', $slug)->first();
        $danhsach = VanBan::where('cats','=',$ds['cats'])->where('locale', '=', $locale)->paginate(7);
        return view('Frontend.van-ban-ct')->with(compact('danhsach', 'ds'));
    }
    function van_ban_tv(Request $request, $locale='', $id = '', $key = 0) {
        $ds = VanBan::find($id);$key = intval($key);
        $file_path = 'public/files/' . $ds['attachments'][$key]['aliasname'];
        $name  = Str::slug($ds['attachments'][$key]['title'], '-') . '.' . $ds['attachments'][$key]['type'];
        return Storage::download($file_path, $name);
    }
    function bieu_mau(Request $request, $locale = '') {
        $cats = BieuMauController::get_cats();
        return view('Frontend.bieu-mau')->with(compact('cats'));
    }
    function bieu_mau_ct(Request $request, $locale = '', $slug = '') {
        $ds = BieuMau::where('slug', '=', $slug)->first();
        $danhsach = BieuMau::where('cats','=',$ds['cats'])->where('locale', '=', $locale)->paginate(7);
        return view('Frontend.bieu-mau-ct')->with(compact('danhsach', 'ds'));
    }
    function bieu_mau_tv(Request $request, $locale='', $id = '', $key = 0) {
        $ds = BieuMau::find($id);$key = intval($key);
        $file_path = 'public/files/' . $ds['attachments'][$key]['aliasname'];
        $name  = Str::slug($ds['attachments'][$key]['title'], '-') . '.' . $ds['attachments'][$key]['type'];
        return Storage::download($file_path, $name);
    }
    // function cong_bo_khoa_hoc(Request $request, $locale = '') {
    //     $danhsach = CongBoKhoaHoc::where('locale', '=', $locale)->orderBy('updated_at', 'desc')->paginate(20);
    //     return view('Frontend.cong-bo-khoa-hoc')->with(compact('danhsach'));
    // }
    // function cong_bo_khoa_hoc_ct(Request $request, $locale = '', $slug='') {
    //     $ds = CongBoKhoaHoc::where('locale', '=', $locale)->where('slug','=',ObjectController::ObjectId($slug))->first();
    //     $danhsach = CongBoKhoaHoc::where('locale', '=', $locale)->orderBy('updated_at', 'desc')->paginate(7);
    //     return view('Frontend.cong-bo-khoa-hoc-ct')->with(compact('danhsach','ds'));
    // }
    function lien_he(Request $request, $locale = '') {
        $file_path = base_path('resources/lang/') . $locale . '/lien-he.txt';
        $noi_dung = file_get_contents($file_path);
        if($locale == 'vi'){
            return view('Frontend.'.$locale.'.lien-he')->with(compact('noi_dung'));
        }
        if($locale == 'en'){
            return view('Frontend.'.$locale.'.contacts')->with(compact('noi_dung'));
        }
    }
    function tong_quan(Request $request, $locale = '') {
        $file_path = base_path('resources/lang/') . $locale . '/tong-quan.txt';
        $noi_dung = file_get_contents($file_path);
        if($locale == 'vi'){
            return view('Frontend.'.$locale.'.tong-quan')->with(compact('noi_dung'));
        }
        if($locale == 'en'){
            return view('Frontend.'.$locale.'.overview')->with(compact('noi_dung'));
        }
    }
    function chuyen_gia(Request $request, $locale = '') {
        $danhsach = NhanSu::where('locale','=',$locale)->where('tags','=','chuyen-gia')->orderBy('thu_tu', 'asc')->get();
        if($locale == 'vi'){
            return view('Frontend.'.$locale.'.chuyen-gia')->with(compact('danhsach'));
        }
        if($locale == 'en'){
            return view('Frontend.'.$locale.'.experts')->with(compact('danhsach'));
        }
    }
    function nhan_su(Request $request, $locale = '', $tags='') {
        if($locale=='vi'){
            $file_path = base_path('resources/lang/') . $locale .('/tong-quan-') .$tags. ('.txt');
        }
        else
        {
            if($tags=='faculty-leaders'){
                $tagsvi='ban-lanh-dao-khoa';
                $file_path = base_path('resources/lang/') . $locale .('/tong-quan-faculty-leaders.txt');  
            }
            elseif($tags=='faculty-office'){
                $tagsvi='van-phong-khoa';
                $file_path = base_path('resources/lang/') . $locale .('/tong-quan-faculty-office.txt');
            }
            elseif($tags=='department-of-food-technology'){
                $tagsvi='bo-mon-cong-nghe-thuc-pham';
                $file_path = base_path('resources/lang/') . $locale .('/tong-quan-department-of-food-technology.txt');
            }
            elseif($tags=='department-of-aquaculture'){
                $tagsvi='bo-mon-nuoi-trong-thuy-san';
                $file_path = base_path('resources/lang/') . $locale .('/tong-quan-department-of-aquaculture.txt');
            }
            elseif($tags=='department-of-biotechnology'){
                $tagsvi='bo-mon-cong-nghe-sinh-hoc';
                $file_path = base_path('resources/lang/') . $locale .('/tong-quan-department-of-biotechnology.txt');
            }
            elseif($tags=='department-of-animal-husbandry-and-veterinary-medicine'){
                $tagsvi='bo-mon-chan-nuoi-thu-y';
                $file_path = base_path('resources/lang/') . $locale .('/tong-quan-department-of-animal-husbandry-and-veterinary-medicine.txt');
            }
            elseif($tags=='department-of-crop-science'){
                $tagsvi='bo-mon-khoa-hoc-cay-trong';
                $file_path = base_path('resources/lang/') . $locale .('/tong-quan-department-of-crop-science.txt');
            }
            elseif($tags=='department-of-rural-development-and-natural-resource-management'){
                $tagsvi='bo-mon-phat-trien-nong-thon-va-qltntn';
                $file_path = base_path('resources/lang/') . $locale .('/tong-quan-department-of-rural-development-and-natural-resource-management.txt');
            }

        }
        $noi_dung = file_get_contents($file_path);
        if($locale=='vi')
        {
            $danhsach_lanh_dao = NhanSu::where('tags','=',$tags)->where('locale','=','vi')->orderBy('thu_tu', 'asc')->get();
        }
        else
        {
            $danhsach_lanh_dao = NhanSu::where('tags','=',$tagsvi)->where('locale','=','en')->orderBy('thu_tu', 'asc')->get();
        }
        $tamp=$tags;
        if($locale == 'vi') {
            return view('Frontend.'.$locale.'.nhan-su')->with(compact('danhsach_lanh_dao','noi_dung','tamp','file_path'));
        }
        if($locale == 'en') {
            return view('Frontend.'.$locale.'.personnel')->with(compact('danhsach_lanh_dao','noi_dung','tamp','file_path' ));
        }
    }
    function nhan_su_xtt(Request $request, $locale = '', $id = '', $tags=0) {
        $ds = NhanSu::find($id);
        $key = intval($tags);
        echo '<embed src="'.env('APP_URL').'storage/files/'.$ds['attachments'][$key]['aliasname'].'" style="width:100%;min-height:80vh;height:100% !important;" />';
    }
    // function dich_vu(Request $request, $locale = '', $slug = '') {
    //     $ds = DichVu::where('locale', '=', $locale)->where('slug','=',$slug)->first();
    //     $danhsach = DichVu::where('locale', '=', $locale)->get();
    //     return view('Frontend.dich-vu')->with(compact('ds', 'danhsach'));
    // }

    // function dich_vu_xtt(Request $request, $locale = '', $id = '', $key = 0) {
    //     $ds = DichVu::find($id);
    //     $key = intval($key);
    //     echo '<embed src="'.env('APP_URL').'storage/files/'.$ds['attachments'][$key]['aliasname'].'" style="width:100%;min-height:80vh;height:100% !important;" />';
    // }

    // function dich_vu_tv(Request $request, $locale='', $id = '', $key = 0) {
    //     $ds = DichVu::find($id);
    //     $key = intval($key);
    //     $file_path = 'public/files/' . $ds['attachments'][$key]['aliasname'];
    //     $name  = Str::slug($ds['attachments'][$key]['title'], '-') . '.' . $ds['attachments'][$key]['type'];
    //     return Storage::download($file_path, $name);
    // }
    function chuyen_gia_va_doi_tac(Request $request, $locale = '') {
        if($locale == 'vi') {

        }
        if($locale == 'en') {
            return view('Frontend.'.$locale.'.experts-and-partners');
        }
    }
    // function hinh_anh_hoat_dong(Request $request, $locale = '') {
    //     $danhsach = HinhAnh::where('locale', '=', $locale)->orderBy('date_post', 'desc')->paginate(9);
    //     return view('Frontend.hinh-anh-hoat-dong')->with(compact('danhsach'));
    // }
    // function hinh_anh_hoat_dong_ct(Request $request, $locale = '', $id= '') {
    //     $ds = HinhAnhHoatDong::where('locale', '=', $locale)->where('id', '=', $id)->first();
    //     $danhsach = HinhAnhHoatDong::where('locale', '=', $locale)->paginate(9);
    //     return view('Frontend.index')->with(compact('danhsach', 'ds'));
    // }

    function search(Request $request, $locale = 'vi') {
    $q = $request->input('q');
    $danhsach = Category::where('locale', '=', $locale)
                        ->where('ten', 'regexp', '/.*'.$q.'/i')
                        ->orderBy('date_post', 'desc')
                        ->paginate(9);

    return view('Frontend.tim-kiem')->with(compact('danhsach','q'));

    }
    function category(Request $request, $locale = '') {
        $cats = CategoryController::get_cats();
        $danhsach=Category::where('locale', '=', $locale)->orderBy('date_post', 'desc')->paginate(9); 
        return view('Frontend.category-all')->with(compact('danhsach','cats'));
    }
    function category_cats(Request $request, $locale = '', $key = 0) {
        if($locale=='vi')
            $cats = CategoryController::get_cats();
        else
            $cats = CategoryController::get_catsen();

        $danhsach = Category::where('locale', '=', $locale)->where('id_cat','=',$cats[$key])->orderBy('date_post', 'desc')->paginate(9);
        return view('Frontend.category')->with(compact('danhsach','cats','key'));
    }
    function category_ct(Request $request, $locale = '', $slug = '') {
       
        $ds = Category::where('locale', '=', $locale)->where('slug', '=', $slug)->first();
        //$danhsach = Category::where('id_cat','=',$ds['id_cat'])->where('locale', '=', $locale)->paginate(7);		
		$danhsach = Category::where('_id','=',$ds['_id'])->where('locale', '=', $locale)->paginate(7);
        return view('Frontend.category-ct')->with(compact('danhsach', 'ds'));
    }
    function category_xtt(Request $request, $locale = '', $id = '', $key = 0) {
        $ds = Category::find($id);
        $key = intval($key);
        echo '<embed src="'.env('APP_URL').'storage/files/'.$ds['attachments'][$key]['aliasname'].'" style="width:100%;min-height:80vh;height:100% !important;" />';
    }
    function category_tv(Request $request, $locale='', $id = '', $key = 0) {
        $ds = Category::find($id);
        $key = intval($key);
        $file_path = 'public/files/' . $ds['attachments'][$key]['aliasname'];
        $name  = Str::slug($ds['attachments'][$key]['title'], '-') . '.' . $ds['attachments'][$key]['type'];
        return Storage::download($file_path, $name);
    }
    function hinh_anh_hoat_dong(Request $request, $locale = '')
    {
        $danhsach = HinhAnhHoatDong::orderBy('date_post', 'desc')->paginate(20);
        $danhsach_hinh_anh_hoat_dong2=Category::orderBy('date_post', 'desc')->paginate(27);
        return view('Frontend.hinh-anh-hoat-dong')->with(compact('danhsach','danhsach_hinh_anh_hoat_dong2'));
    }
   
}