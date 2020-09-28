<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
//use Gloudemans\Shoppingcart\Cart;
use Cart;
session_start();

class CheckoutController extends Controller
{
  public function login_checkout(){
    $category = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
    $brand = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
    return view('user.checkout.login_checkout')->with('category',$category)->with('brand',$brand);    
  }
  
  public function add_customer(Request $request){
      $data = array();
      $data['customer_name'] = $request->customer_name;
      $data['customer_email'] = $request->customer_email;
      $data['customer_password'] = md5($request->customer_password);
      $data['customer_phone'] = $request->customer_phone;
      
      $customer_id = DB::table('tbl_customer')->insertGetId($data);
      
      Session::put('customer_id',$customer_id);
      Session::put('customer_name',$request->customer_name);
      return Redirect::to('/checkout');
  }
  
  public function checkout(){
      $category = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
      $brand = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
      return view('user.checkout.show_checkout')->with('category',$category)->with('brand',$brand); 
  }
  
}
?>