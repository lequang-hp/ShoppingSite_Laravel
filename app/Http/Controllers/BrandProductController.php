<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class BrandProductController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('/dashboard');
        }else{
            return Redirect::to('/admin')->send();
        }
    }
    
    public function add_brand_product(){
        $this->AuthLogin();
        return view('admin.add_brand_product');  
    }
    
    public function all_brand_product(){
        $this->AuthLogin();
        $all_brand_product = DB::table('tbl_brand')->get();
        $manager_brand_product = view('admin.all_brand_product')->with('all_brand_product',$all_brand_product);
        return view('admin_layout')->with('admin.all-brand-product',$manager_brand_product);
    }
    
    public function save_brand_product(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        $data['brand_status'] = $request->brand_product_status;
        DB::table('tbl_brand')->insert($data);
        Session::put('message','Add product successfully');
        return Redirect::to('/add-brand-product');
    }
    
    public function active_brand_product($brand_id){
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id',$brand_id)->update(['brand_status'=>1]);
        return Redirect::to('/all-brand-product');
    }
    
    public function unactive_brand_product($brand_id){
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id',$brand_id)->update(['brand_status'=>0]);
        return Redirect::to('/all-brand-product');
    }
    
    public function edit_brand_product($brand_id){
        $this->AuthLogin();
        $brand_product = DB::table('tbl_brand')->where('brand_id',$brand_id)->get();
        $manager_brand_product = view('admin.edit_brand_product')->with('brand_product',$brand_product);
        return view('admin_layout')->with('admin.edit-brand-product',$manager_brand_product);
    }
    
    public function update_brand_product($brand_id,Request $request){
        $this->AuthLogin();
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        DB::table('tbl_brand')->where('brand_id',$brand_id)->update($data);
        Session::put('message','Update brand successfully');
        return Redirect::to('/all-brand-product');
    }
    
    public function delete_brand_product($brand_id){
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id',$brand_id)->delete();
        Session::put('message','Delete brand successfully');
        return Redirect::to('/all-brand-product');
    }
    
    public function show_brand_home($brand_id){
        $category = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $product_by_brand = DB::table('tbl_product')->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')
        ->where('tbl_product.brand_id',$brand_id)->get();
        $brand_name = DB::table('tbl_brand')->where('brand_id',$brand_id)->get();
        return view('user.brand.show_brand')->with('category',$category)->with('brand',$brand)->with('product_by_brand',$product_by_brand)
        ->with('brand_name',$brand_name);
    }
}
?>