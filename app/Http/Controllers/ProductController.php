<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class ProductController extends Controller
{   public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('/dashboard');
        }else{
            return Redirect::to('/admin')->send();
        }
    }
    
    public function add_product(){
        $this->AuthLogin();
        $category = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        return view('admin.add_product')->with('cate_product',$category)->with('brand_product',$brand);
    }
    
    public function all_product(){
        $this->AuthLogin();
        $all_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->orderby('tbl_product.product_id','desc')->get();
        $manager_product = view('admin.all_product')->with('all_product',$all_product);
        return view('admin_layout')->with('admin.all-product',$manager_product);
    }
    
    public function save_product(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['product_price'] = $request->product_price;
        $data['product_status'] = $request->product_status;
        $data['category_id'] = $request->cate_product;
        $data['brand_id'] = $request->brand_product;
        
        $get_image = $request->file('product_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/product',$new_image);
            $data['product_image'] = $new_image;
        }
        else{
           $data['product_image'] = '';
        }
        DB::table('tbl_product')->insert($data);
        Session::put('message','Add product successfully');
        return Redirect::to('/add-product');
    }
    
    public function active_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>1]);
        return Redirect::to('/all-product');
    }
    
    public function unactive_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>0]);
        return Redirect::to('/all-product');
    }
    
    public function edit_product($product_id){
        $this->AuthLogin();
        $category = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        $edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get();
        $manager_product = view('admin.edit_product')->with('edit_product',$edit_product)->with('cate_product',$category)->with('brand_product',$brand);
        return view('admin_layout')->with('admin.edit-product',$manager_product);
    }
    
    public function update_product($product_id,Request $request){
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['product_price'] = $request->product_price;
        $data['product_status'] = $request->product_status;
        $data['category_id'] = $request->cate_product;
        $data['brand_id'] = $request->brand_product;
        
        $get_image = $request->file('product_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/product',$new_image);
            $data['product_image'] = $new_image;
        }
        // neu ng dung ko update anh thi de nguyen
        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        Session::put('message','Update product successfully');
        return Redirect::to('/all-product');
    }
    
    public function delete_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->delete();
        Session::put('message','Delete product successfully');
        return Redirect::to('/all-product');
    }
}
?>