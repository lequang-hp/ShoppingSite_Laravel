<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class HomeController extends Controller
{
    public function index(){
        $category = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $latest_product = DB::table('tbl_product')->where('product_status','1')->orderby('product_id','desc')->limit(4)->get();
        return view('user.home')->with('category',$category)->with('brand',$brand)->with('latest_product',$latest_product);
    }
}
?>
