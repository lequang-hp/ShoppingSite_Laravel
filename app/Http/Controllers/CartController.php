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

class CartController extends Controller
{
    public function save_cart(Request $request){
        $product_id = $request->product_id;
        $quantity = $request->qty;
        $product_info = DB::table('tbl_product')->where('product_id',$product_id)->first();
        
        $data['id'] = $product_info->product_id;
        $data['qty'] = $quantity;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['weight'] = '123';
        $data['options']['image'] = $product_info->product_image;
        Cart::add($data);
        
        //Cart::destroy();
        return Redirect::to('/show-cart');
    }
    
    public function show_cart(){
        $category = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        return view('user.cart.show_cart')->with('category',$category)->with('brand',$brand);
    }
    
    public function delete_cart($rowId){
        Cart::update($rowId,0); 
        return Redirect::to('/show-cart');
    }
    
    public function update_cart(Request $request){
        $rowId = $request->rowId_cart;
        $qty = $request->quantity;
        Cart::update($rowId,$qty);
        return Redirect::to('/show-cart');
    }
}
?>