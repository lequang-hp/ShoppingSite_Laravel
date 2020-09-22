@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Update product
                        </header>
                        <div class="panel-body">
                        	<?php 
                    		  $message = Session::get('message');
                    		  if($message){
                    		      echo "<p style='color:green;font-weight:bold;text-align:center;'>$message</p>";
                    		      Session::put('message',null);
                    		  }
                    		?>
                            <div class="position-center">
                            	@foreach($edit_product as $key => $pro)
                                <form role="form" action="{{URL::to('/update-product/'.$pro->product_id)}}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product Name</label>
                                    <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" placeholder="Product name" value="{{$pro->product_name}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product Price</label>
                                    <input type="text" name="product_price" class="form-control" id="exampleInputEmail1" placeholder="Product price" value="{{$pro->product_price}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Product Image</label>
                                    <input type="file" name="product_image" class="form-control" id="exampleInputEmail1" placeholder="Product image">
                                	<img src="{{URL::to('public/upload/product/'.$pro->product_image)}}" style="height:150px;width:100px;">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Product Description</label>
                                    <textarea style="resize:none;" rows="5" type="text" name="product_desc" class="form-control" id="exampleInputPassword1" placeholder="Description" >{{$pro->product_desc}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Product Content</label>
                                    <textarea style="resize:none;" rows="5" type="text" name="product_content" class="form-control" id="exampleInputPassword1" placeholder="Content" >{{$pro->product_content}}</textarea>
                                </div>
                                <div class="form-group">
                                 	<label for="exampleInputEmail1">Category</label>
                                    <select name="cate_product" class="form-control input-sm m-bot15">
                                        @foreach($cate_product as $key => $cate)
                                        	@if($cate->category_id == $pro->category_id)
                                        	<option selected value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                        	@else
                                        	<option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                        	@endif
                                        @endforeach	
                                    </select>
                                </div>
                                <div class="form-group">
                                 	<label for="exampleInputEmail1">Brand</label>
                                    <select name="brand_product" class="form-control input-sm m-bot15">
                                          @foreach($brand_product as $key => $brand)
                                        	@if($brand->brand_id == $pro->brand_id)
                                        	<option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                        	@else
                                        	<option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                        	@endif
                                        @endforeach	
                                    </select>
                                </div>
                                <div class="form-group">
                                 	<label for="exampleInputEmail1">ShowHidden</label>
                                    <select name="product_status" class="form-control input-sm m-bot15">
                                        <option value="0">Hidden</option>
                                        <option value="1">Show</option>
                                    </select>
                                </div>
                                <button type="submit" name="add_product" class="btn btn-info">Update</button>
                            </form>
                            @endforeach
                            </div>

                        </div>
                    </section>

            </div>
        </div>
        
   @endsection