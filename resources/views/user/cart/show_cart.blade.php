@extends('layout')
@section('content')
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
			<?php 
			 $content = Cart::content();
			?>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Image</td>
							<td class="description">Description</td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@foreach($content as $key => $value)
						<tr>
							<td class="cart_product">
								<a href="{{URL::to('/product-detail/'.$value->id)}}"><img src="{{URL::to('public/upload/product/'.$value->options->image)}}" style="width:100px;height:150px;"alt="" /></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$value->name}}</a></h4>
								<p>Product ID: {{$value->id}}</p>
							</td>
							<td class="cart_price">
								<p>{{$value->price}} VND</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<form action="{{URL::to('/update-cart')}}" method="post">
										{{ csrf_field() }}
										<input class="cart_quantity_input" type="text" name="quantity" value="{{$value->qty}}" autocomplete="off" size="2">
    									<input type="hidden" value="{{$value->rowId}}" name="rowId_cart" >
    									<input type="submit" value="Update" name="update_qty" class="btn btn-default btn-sm"> 
									</form>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
								<?php 
								    $subtotal = $value->price * $value->qty;
								    echo number_format($subtotal).' '.'VND';
								?>
								</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{URL::to('/delete-cart/'.$value->rowId)}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->
	
	<section id="do_action">
		<div class="container">
			
			<div class="row">
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span>{{number_format(Cart::subtotal()).' '.'VND'}}</span></li>
							<li>Eco Tax <span>{{number_format(Cart::tax(),0, ",",".").' '.'VND'}}</span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li>Total <span>{{number_format(Cart::total()).' '.'VND'}}</span></li>
						</ul>
							<a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">Check Out</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->

@endsection