		<header id="header" class="full-header header-size-md">
			<div id="header-wrap">
				<div class="container">
					<div class="header-row justify-content-lg-between">

						<!-- Logo
						============================================= -->
						<div id="logo" class="mr-lg-4">
							<a href="demo-shop.html" class="standard-logo"><img src="demos/shop/images/logo.png" alt="Canvas Logo"></a>
							<a href="demo-shop.html" class="retina-logo"><img src="demos/shop/images/logo%402x.png" alt="Canvas Logo"></a>
						</div><!-- #logo end -->
						
						<div class="header-misc">

							<!-- Top Search
							============================================= -->
							<div id="top-account">
								@if(auth()->check())
								<a href="#" data-lightbox="inline" >
									<i class="icon-line2-user mr-1 position-relative" style="top: 1px;">
								</i><span class="d-none d-sm-inline-block font-primary font-weight-medium">{{ auth()->user()->name }}</span></a>
							@else
							<a href="#modal-register" data-lightbox="inline" ><i class="icon-line2-user mr-1 position-relative" style="top: 1px;"></i>
							<span class="d-none d-sm-inline-block font-primary font-weight-medium">Login</span></a>
							@endif
							</div><!-- #top-search end -->

							<!-- Top Cart MANUAL CART
							============================================= -->
							<div id="top-cart" class="header-misc-icon d-none d-sm-block">
								<a href="#" id="top-cart-trigger"><i class="icon-line-bag"></i><span class="top-cart-number">{{count(cartItem())}}</span></a>
								<div class="top-cart-content">
									<div class="top-cart-title">
										<h4>Shopping Cart</h4>
									</div>
									<div class="top-cart-items">
									@php  $total=0; @endphp
									@foreach(cartItem() as $cart)
										<div class="top-cart-item cartDelete_{{ $cart->id }}" >
											<div class="top-cart-item-image">
											@php  $productImage= json_decode($cart->product->image) @endphp
											@if($productImage)
												<a href="#"><img src="{{asset('/').$productImage[0]}}" alt="Blue Round-Neck Tshirt" /></a>
												@endif
											</div>
											@php $total+=$cart->product->productDetails->price; @endphp
											<div class="top-cart-item-des" >
												<div class="top-cart-item-desc-title">
													<a href="#">{{$cart->product->name}}</a>
													<span  data-id="{{$cart->id}}" class="cart-item-remove text-right ml-4"> <a href="#" class="text-danger">Delete</a> </span>
													<span class="top-cart-item-price d-block">${{$cart->product->productDetails->price}}</span>
												</div>
												<div class="top-cart-item-quantity">x {{$cart->quantity}}</div>
											</div>
										</div>
										@endforeach
								
									</div>
									<div class="top-cart-action mt-2">
										<span class="top-checkout-price">${{$total}}</span>
										<a href="{{route('checkout')}}" class="button button-3d button-small m-0">Checkout</a>
									</div>
								</div>
							</div>
							<!-- #top-cart end -->


							<!-- aJAX cART -->
							<!-- Top Cart 
							============================================= -->
						<!-- 	<div id="top-cart" class="header-misc-icon d-none d-sm-block">
								<a href="#" class=""  id="top-cart-trigger"><i  class="icon-line-bag"></i><span class="top-cart-number">{{count(cartItem())}}</span></a>
								<div class="top-cart-content">
									<div class="top-cart-title">
										<h4 >Shopping Cart</h4>
									</div>
									<div class="top-cart-items" id="showCart">
									
										
									</div>
									<div class="top-cart-action mt-2">
										<span class="top-checkout-price">${{$total}}</span>
										<a href="#" class="button button-3d button-small m-0">View Cart</a>
									</div>
								</div>
							</div> -->
							<!-- #top-cart end -->

							<!-- Top Search
							============================================= -->
							<div id="top-search" class="header-misc-icon">
								<a href="#" id="top-search-trigger"><i class="icon-line-search"></i><i class="icon-line-cross"></i></a>
							</div><!-- #top-search end -->

						</div>

						<div id="primary-menu-trigger">
							<svg class="svg-trigger" viewBox="0 0 100 100"><path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path><path d="m 30,50 h 40"></path><path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path></svg>
						</div>

						<!-- Primary Navigation
						============================================= -->
						<nav class="primary-menu with-arrows mr-lg-fluid">
							
							<ul class="menu-container">
								<li class="menu-item current"><a class="menu-link" href="#"><div>Home</div></a></li>
								<li class="menu-item mega-menu"><a class="menu-link" href="#"><div>Category</div></a>
									
								</li>
								<li class="menu-item mega-menu mega-menu-small"><a class="menu-link" href="#"><div>Brand</div></a>
								
								</li>
								<li class="menu-item"><a class="menu-link" href="#"><div>Shop</div></a></li>
								<li class="menu-item"><a class="menu-link" href="#"><div>Blog</div></a></li>
							</ul>

						</nav><!-- #primary-menu end -->

						<form class="top-search-form" action="http://themes.semicolonweb.com/html/canvas/search.html" method="get">
							<input type="text" name="q" class="form-control" value="" placeholder="Type &amp; Hit Enter.." autocomplete="off">
						</form>

					</div>
				</div>
			</div>
			<div class="header-wrap-clone"></div>
		</header><!-- #header end -->