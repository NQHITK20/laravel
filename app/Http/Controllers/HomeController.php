<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Middleware\PreventRequestsDuringMaintenance;
use Illuminate\Support\Facades\Redirect;
session_start();

class HomeController extends Controller
{
    public function index(Request $request){
        //seo
        $meta_desc="Kinh đô thời trang cho mọi lứa tuổi";
        $meta_keyword="Áo,quần, giày,dép";
        $meta_title="SHOP HS";
        $url_canonical=$request->url();
        //-endseo
        $cate_product=DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id','desc')->get();
    //     $all_product=DB::table('tbl_product')
    //    ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
    //    ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
    //    ->orderBy('tbl_product.brand_id','desc')->get();
       
    $all_product=DB::table('tbl_product')->where('product_status','1')->orderBy('product_id','desc')->limit(6)->get();
    return view('pages.home')->with('category',$cate_product)
    ->with('brand',$brand_product)->with('all_product',$all_product)->with('meta_desc',$meta_desc)->with('meta_keyword',$meta_keyword)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);//1
    // return view('pages.home')->with(compact('tbl_product','cate_product','all_product'));//2
    }
    public function search(Request $request){
        $keywords=$request->keywords_submit;
        $cate_product=DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id','desc')->get();
    //     $all_product=DB::table('tbl_product')
    //    ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
    //    ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
    //    ->orderBy('tbl_product.brand_id','desc')->get();
       
     $search_product=DB::table('tbl_product')->where('product_status','1')->where('product_name','like','%'.$keywords.'%')
    ->orderBy('product_id','desc')->get();
        return view('pages.product.search')->with('category',$cate_product)->with('brand',$brand_product)->with('search_product',$search_product);

    }
}
