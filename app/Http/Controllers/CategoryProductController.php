<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryProductController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('/dashboard');
        }else{
            return Redirect::to('/admin')->send();
        }
    }
    
    public function add_category_product(){
        $this->AuthLogin();
        return view('admin.add_category_product');
    }
    
    public function all_category_product(){
        $this->AuthLogin();
        $all_category_product = DB::table('tbl_category_product')->get();
        $manager_category_product = view('admin.all_category_product')->with('all_category_product',$all_category_product);
        return view('admin_layout')->with('admin.all-category-product',$manager_category_product);
    }
    
    public function save_category_product(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status;
        DB::table('tbl_category_product')->insert($data);
        Session::put('message','Add product successfully');
        return Redirect::to('/add-category-product');
    }
    
    public function active_category_product($category_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_id)->update(['category_status'=>1]);
        return Redirect::to('/all-category-product');
    }
    
    public function unactive_category_product($category_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_id)->update(['category_status'=>0]);
        return Redirect::to('/all-category-product');
    }
    
    public function edit_category_product($category_id){
        $this->AuthLogin();
        $category_product = DB::table('tbl_category_product')->where('category_id',$category_id)->get();
        $manager_category_product = view('admin.edit_category_product')->with('category_product',$category_product);
        return view('admin_layout')->with('admin.edit-category-product',$manager_category_product);
    }
    
    public function update_category_product($category_id,Request $request){
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        DB::table('tbl_category_product')->where('category_id',$category_id)->update($data);
        Session::put('message','Update product successfully');
        return Redirect::to('/all-category-product');
    }
    
    public function delete_category_product($category_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_id)->delete();
        Session::put('message','Delete product successfully');
        return Redirect::to('/all-category-product');
    }   
    
    // For user role
    public function show_category_home($category_id){
        $category = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $product_by_category = DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')
        ->where('tbl_product.category_id',$category_id)->get();
        return view('user.category.show_category')->with('category',$category)->with('brand',$brand)->with('product_by_category',$product_by_category);
    }
    
    
}

?>