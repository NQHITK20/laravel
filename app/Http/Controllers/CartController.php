<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Middleware\PreventRequestsDuringMaintenance;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
session_start();

class CartController extends Controller
{
    
    public function save_cart(Request $request){

        
        $product_id2=$request->productid_hidden;
        $quantity=$request->qty;
        $product_info=DB::table('tbl_product')->where('product_id',$product_id2)->first();

    
        $data['id']=$product_info->product_id;
        $data['qty']=$quantity;
        $data['name']=$product_info->product_name;
        $data['weight']='123';
        $data['price']=$product_info->product_price;
        $data['options']['image']=$product_info->product_image;
        Cart::add($data);
        Cart::setGlobaltax($data);
        return Redirect::to('/show-cart');
        
    }
    public function show_cart(){
        $cate_product=DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id','desc')->get();

        return view('pages.cart.show_cart')->with('category',$cate_product)->with('brand',$brand_product);

    }
    public function delete_to_cart($rowId){
        Cart::update($rowId,0);
        return Redirect::to('/show-cart');

    }
    public function update_cart_quantity(Request $request){
        $rowId=$request->rowId_cart;
        $qty=$request->cart_quantity;
        Cart::update($rowId,$qty);
        return Redirect::to('/show-cart');
       
    }
}
