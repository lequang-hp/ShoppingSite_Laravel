@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Update brand product
                        </header>
                        <?php 
                    		  $message = Session::get('message');
                    		  if($message){
                    		      echo "<p style='color:green;font-weight:bold;text-align:center;'>$message</p>";
                    		      Session::put('message',null);
                    		  }
                    	?>
                        <div class="panel-body">
             				@foreach($brand_product as $key => $edit_value)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-brand-product/'.$edit_value->brand_id)}}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">brand Name</label>
                                    <input type="text" value="{{$edit_value->brand_name}} " name="brand_product_name" class="form-control" id="exampleInputEmail1" placeholder="Product name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">brand Description</label>
                                    <textarea style="resize:none;" rows="5" type="text" name="brand_product_desc" class="form-control" id="exampleInputPassword1">{{$edit_value->brand_desc}}</textarea>
                                </div>
                                <button type="submit" name="add_brand_product" class="btn btn-info">UPDATE</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>

            </div>
        </div>
        
   @endsection