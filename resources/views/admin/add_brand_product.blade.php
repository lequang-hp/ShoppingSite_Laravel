@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Add brand
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
                                <form role="form" action="{{URL::to('/save-brand-product')}}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Brand Name</label>
                                    <input type="text" name="brand_product_name" class="form-control" id="exampleInputEmail1" placeholder="Brand name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Brand Description</label>
                                    <textarea style="resize:none;" rows="5" type="text" name="brand_product_desc" class="form-control" id="exampleInputPassword1" placeholder="Description"></textarea>
                                </div>
                                <div class="form-group">
                                 	<label for="exampleInputEmail1">ShowHidden</label>
                                    <select name="brand_product_status" class="form-control input-sm m-bot15">
                                        <option value="0">Hidden</option>
                                        <option value="1">Show</option>
                                    </select>
                                </div>
                                <button type="submit" name="add_brand_product" class="btn btn-info">Add</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
        </div>
        
   @endsection