@extends('layout')
@section('content')

<div class="features_items"><!--features_items-->
	<h2 class="title text-center">Latest product</h2>
						@foreach($latest_product as $key => $product)
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									
									<div class="productinfo text-center">
										<img src="{{URL::to('public/upload/product/'.$product->product_image)}}" style="width:100px;height:150px;"alt="" />
										<h2>{{number_format($product->product_price)}} VND</h2>
										<p>{{$product->product_name}}</p>
										<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
									</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
									</ul>
								</div>
							</div>
						</div>
						@endforeach
					</div><!--features_items-->
				
@endsection