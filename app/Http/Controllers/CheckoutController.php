<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Middleware\PreventRequestsDuringMaintenance;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
session_start();

class CheckoutController extends Controller
{
    public function login2_checkout(){

        $cate_product=DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id','desc')->get();
        return view('pages.checkout.login_checkout')->with('category',$cate_product)->with('brand',$brand_product);

    }
    public function login_add_checkout(Request $request){

        $data2=array();
        $data2['customer_name']=$request->customer_name;
        $data2['customer_email']=$request->customer_email;
        $data2['customer_password']=md5( $request->customer_password);
        $data2['customer_confirm_password']=$request->customer_confirm_password;
        $data2['customer_phone']=$request->customer_phone;

        $customer_id=DB::table('tbl_customer')->insertGetId($data2);
        Session::put('customer_id',$customer_id);
        Session::put('customer_name',$request->customer_name);
        return redirect::to('/check-out');
        
    }
    public function check_out(){
        $cate_product=DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id','desc')->get();
        return view('pages.checkout.show_checkout')->with('category',$cate_product)->with('brand',$brand_product);
    }
    public function save_check_out_customer(Request $request){
        $data2=array();
        $data2['shipping_name']=$request->shipping_name;
        $data2['shipping_phone']=$request->shipping_phone;
        $data2['shipping_email']=$request->shipping_email;
        $data2['shipping_notes']=$request->shipping_notes;
        $data2['shipping_address']=$request->shipping_address;

        $shipping_id=DB::table('tbl_shipping')->insertGetId($data2);
        Session::put('shipping_id',$shipping_id);
        return redirect::to('/payment');

    }
    public function payment(){
        $cate_product=DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id','desc')->get();
        return view('pages.checkout.payment')->with('category',$cate_product)->with('brand',$brand_product);
    }
    public function order_place(Request $request){
        //isert payment method
        $data=array();
        $data['payment_method']=$request->payment_option;
        $data['payment_status']='Đang chờ xử lý';
        $payment_id=DB::table('tbl_payment')->insertGetId($data);

         //isert order
         $order_data=array();
         $order_data['customer_id']=Session::get('customer_id');
         $order_data['shipping_id']=Session::get('shipping_id');
         $order_data['payment_id']=$payment_id;
         $order_data['order_total']=Cart::total();
         $order_data['order_status']='Đang chờ xử lý';
         $order_id=DB::table('tbl_order')->insertGetId($order_data);

         //isert order details
         $content=Cart::content();
         foreach ($content as $v_content) {
          $order_details_data=array();
          $order_details_data['order_id']=$order_id;
          $order_details_data['product_id']=$v_content->id;
          $order_details_data['product_name']=$v_content->name;
          $order_details_data['product_price']=$v_content->price;
          $order_details_data['product_sales_quantity']=$v_content->qty;
          DB::table('tbl_order_details')->insertGetId($order_details_data);
         }
         if ($data['payment_method']==1) {
            echo 'Thẻ ATM';
         }elseif ($data['payment_method']==2) {
            Cart::destroy();
            $cate_product=DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
            $brand_product=DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id','desc')->get();
            return view('pages.checkout.handcash')->with('category',$cate_product)->with('brand',$brand_product);
         }elseif ($data['payment_method']==3) {
            echo 'Dùng thẻ ghi nợ';
         }

         
    }
    public function logout_checkout(){
        Session::flush();
        return Redirect::to('/login-checkout');
    }
    public function login_customer(Request $request){
        $email=$request->email_account;
        $password=md5( $request->password_account);
        $result=DB::table('tbl_customer')->where('customer_email',$email)
        ->where('customer_password',$password)->first();
        if($result!=NULL){
            Session::put('customer_id',$result->customer_id);
            Session::put('customer_name',$result->customer_name);
            return redirect::to('/check-out');
        }
        else{
        return redirect::to('/login-checkout');
        }
       

    }
    public function AuthLogin(){
        $admin_id=Session::get('admin_id');
        if($admin_id){
            return redirect::to('dashboard');
        }
        else{
            return redirect::to('admin')->send();
        }
    }
    public function manage_order(){
        $this->AuthLogin();

       $all_customer=DB::table('tbl_order')
       ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
       ->orderBy('tbl_order.order_id','desc')->get();
       $manage_order=view('admin.manage_order')->with('all_customer',$all_customer);
       return view('admin_layout')->with('admin.manage_order',$manage_order);
    }
    public function view_order($orderId){
        $this->AuthLogin();
        $order_by_id=DB::table('tbl_order')
        ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
        ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
        ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
        ->select('tbl_order.*','tbl_shipping.*','tbl_customer.*','tbl_order_details.*')
        ->orderBy('tbl_order.order_id','desc')->get();
        return view('admin.view_order')->with('order_by_id',$order_by_id);
    }

}
