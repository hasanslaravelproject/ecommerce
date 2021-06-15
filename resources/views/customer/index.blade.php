@extends('layouts.customer')

@section('customer-content')
	
<section id="slider" class="slider-element swiper_wrapper" data-autoplay="6000" data-speed="800" data-loop="true" data-grab="true" data-effect="fade" data-arrow="false" style="height: 600px;">

<div class="swiper-container swiper-parent">
	<div class="swiper-wrapper">
		<div class="swiper-slide dark">
			<div class="container">
				<div class="slider-caption slider-caption-center">
					<div>
						<div class="h5 mb-2 font-secondary">Fresh Arrivals</div>
						<h2 class="bottommargin-sm text-white">Winter / 2021</h2>
						<a href="#" class="button bg-white text-dark button-light">Shop Menswear</a>
					</div>
				</div>
			</div>
			<div class="swiper-slide-bg" style="background-image: url('demos/shop/images/slider/1.jpg');"></div>
		</div>
		<div class="swiper-slide dark">
			<div class="container">
				<div class="slider-caption slider-caption-center">
					<div>
						<div class="h5 mb-2 font-secondary">Summer Collections</div>
						<h2 class="bottommargin-sm text-white">Sale 40% Off</h2>
						<a href="#" class="button bg-white text-dark button-light">Shop Beachwear</a>
					</div>
				</div>
			</div>
			<div class="swiper-slide-bg" style="background-image: url('demos/shop/images/slider/3.jpg'); background-position: center 20%;"></div>
		</div>
		<div class="swiper-slide dark">
			<div class="container">
				<div class="slider-caption slider-caption-center">
					<div>
						<h2 class="bottommargin-sm text-white">New Arrivals / 18</h2>
						<a href="#" class="button bg-white text-dark button-light">Shop Womenswear</a>
					</div>
				</div>
			</div>
			<div class="swiper-slide-bg" style="background-image: url('demos/shop/images/slider/2.jpg'); background-position: center 40%;"></div>
		</div>
	</div>
	<div class="swiper-pagination"></div>
</div>

</section>

<!-- Content
============================================= -->
<section id="content">
<div class="content-wrap">
	<div class="container clearfix">

		<!-- Shop Categories
		============================================= -->
		<div class="fancy-title title-border title-center mb-4">
			<h4>Shop popular categories</h4>
		</div>

		<div class="row shop-categories clearfix">
			<div class="col-lg-7">
				<a href="#" style="background: url('demos/shop/images/categories/2-1.jpg') no-repeat right center; background-size: cover;">
					<div class="vertical-middle dark center">
						<div class="heading-block m-0 border-0">
							<h3 class="nott font-weight-semibold ls0">For Him</h3>
						</div>
					</div>
				</a>
			</div>
			<div class="col-lg-5">
				<a href="#" style="background: url('demos/shop/images/categories/1.jpg') no-repeat center right; background-size: cover;">
					<div class="vertical-middle dark center">
						<div class="heading-block m-0 border-0">
							<h3 class="nott font-weight-semibold ls0">For Her</h3>
						</div>
					</div>
				</a>
			</div>

			<div class="col-lg-4">
				<a href="#" style="background: url('demos/shop/images/categories/4.jpg') no-repeat center center; background-size: cover;">
					<div class="vertical-middle dark center">
						<div class="heading-block m-0 border-0">
							<h3 class="nott font-weight-semibold ls0">Popular Products</h3>
							<small class="button bg-white text-dark button-light button-mini">Browse Now</small>
						</div>
					</div>
				</a>
			</div>
			<div class="col-lg-4">
				<a href="#" style="background: url('demos/shop/images/categories/3.jpg') no-repeat center center; background-size: cover;">
					<div class="vertical-middle dark center">
						<div class="heading-block m-0 border-0">
							<h3 class="nott font-weight-semibold ls0">Footwears</h3>
							<small class="button bg-white text-dark button-light button-mini">Shop Now</small>
						</div>
					</div>
				</a>
			</div>
			<div class="col-lg-4">
				<a href="#" style="background: url('demos/shop/images/categories/5.jpg') no-repeat center center; background-size: cover;">
					<div class="vertical-middle dark center">
						<div class="heading-block m-0 border-0">
							<h3 class="nott font-weight-semibold ls0">Sportswear</h3>
							<small class="button bg-white text-dark button-light button-mini">Shop Now</small>
						</div>
					</div>
				</a>
			</div>
		</div>

		<!-- Featured Carousel
		============================================= -->
		<div class="fancy-title title-border mt-4 title-center">
			<h4>Weekly Featured Items</h4>
		</div>
		
		<div id="oc-products" class="owl-carousel products-carousel carousel-widget" data-margin="20" data-loop="true" data-autoplay="5000" data-nav="true" data-pagi="false" data-items-xs="1" data-items-sm="2" data-items-md="3" data-items-lg="4" data-items-xl="5">

			<!-- Shop Item 1
			============================================= -->
	
			@foreach($Products as $product)
		
			<div class="oc-item">
				<div class="product">
					<div class="product-image">
					@php $productImage=json_decode($product->image) @endphp
						<a href="#"><img src="{{asset('/'.$productImage[0])}}" alt="Round Neck T-shirts"></a>
						@if(count($productImage) > 1)
						<a href="#"><img src="{{asset('/'.$productImage[1])}}" alt="Round Neck T-shirts"></a>
						@endif
						<div class="sale-flash badge badge-danger p-2">Sale!</div>
						<div class="bg-overlay">
							<div class="bg-overlay-content align-items-end justify-content-between" data-hover-animate="fadeIn" data-hover-speed="400">
								<a href="#" data-product-id="{{$product->id}}" class="btn btn-dark mr-2 addToCartButton"><i class="icon-shopping-basket"></i></a>
								<a href="demos/shop/ajax/shop-item.html" class="btn btn-dark" data-lightbox="ajax"><i class="icon-line-expand"></i></a>
							</div>
							<div class="bg-overlay-bg bg-transparent"></div>
						</div>
					</div>
				
					<div class="product-desc">
						<div class="product-title mb-1"><h3><a href="#">{{$product->name}}</a></h3></div>
						<div class="product-price font-primary"><del class="mr-1">{{ isset($product->productDetails) ? $product->productDetails->price:''}}</del> <ins></ins></div>
					
					</div>
				</div>
			</div>
			@endforeach
			
		
	

		</div>

	</div>

	<!-- New Arrival Section
	============================================= -->
	<div class="section my-4">
		<div class="container">
			<div class="row align-items-stretch">
				<div class="col-md-5">
					<div class="row">
						<div class="col-md-12 center p-5">
							<div class="heading-block mb-1 border-bottom-0 mx-auto">
								<div class="font-secondary text-black-50 mb-1">New Arrivals</div>
								<h3 class="nott ls0">Fresh Arrivals / Autumn 18</h3>
								<p class="font-weight-normal mt-2 mb-3 text-muted" style="font-size: 17px; line-height: 1.4">Dynamically drive interdependent metrics for worldwide portals. Proactively grow client technology schemas.</p>
								<a href="#" class="button bg-dark text-white button-dark button-small ml-0">Shop Now</a>
							</div>
						</div>
						<div class="col-6">
							<a href="demos/shop/images/sections/1-2.jpg" data-lightbox="image"><img src="demos/shop/images/sections/1-2.jpg" alt="Image"></a>
						</div>
						<div class="col-6">
							<a href="demos/shop/images/sections/1-3.jpg" data-lightbox="image"><img src="demos/shop/images/sections/1-3.jpg" alt="Image"></a>
						</div>
					</div>
				</div>
				<div class="col-md-7 min-vh-50">
					<a href="https://www.youtube.com/watch?v=bpNcuh_BnsA" data-lightbox="iframe" class="d-block position-relative h-100" style="background: url('demos/shop/images/sections/1.jpg') center center no-repeat; background-size: cover;">
						<div class="vertical-middle text-center">
							<div class="play-icon"><i class="icon-play-sign display-3 text-light"></i></div>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>

	<div class="clear"></div>

	<!-- New Arrivals Men
	============================================= -->
	<div class="container clearfix">

		<div class="fancy-title title-border topmargin-sm mb-4 title-center">
			<h4>New Arrivals: Men</h4>
		</div>
		
		<div class="row grid-6">
			
			@foreach ($newProducts as $newProduct)
			
			<div class="col-lg-2 col-md-3 col-6 px-2">
				<div class="product">
					<div class="product-image">
						<a href="#"><img src="{{asset('download.PNG')}}" alt="Image 1"></a>
						<a href="#"><img src="{{asset('download.PNG')}}" alt="Image 1"></a>
						<div class="sale-flash badge badge-danger p-2">Sale!</div>
						<div class="bg-overlay">
							<div class="bg-overlay-content align-items-end justify-content-between" data-hover-animate="fadeIn" data-hover-speed="400">
								<a href="#" class="btn btn-dark mr-2"><i class="icon-shopping-basket"></i></a>
								<a href="demos/shop/ajax/shop-item.html" class="btn btn-dark" data-lightbox="ajax"><i class="icon-line-expand"></i></a>
							</div>
							<div class="bg-overlay-bg bg-transparent"></div>
						</div>
					</div>
					<div class="product-desc">
						<div class="product-title mb-1"><h3><a href="#">{{$newProduct->name}}</a></h3></div>
						<div class="product-price font-primary"><del class="mr-1">{{ isset($newProduct->productDetails) ? $newProduct->productDetails->price:''}}</del> 
						<ins>$12.49</ins></div>
					</div>
				</div>
			</div>
			@endforeach
	

		</div>

	</div>

	<!-- Sign Up
	============================================= -->
	<div class="section my-4 py-5">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="row align-items-stretch align-items-center">
						<div class="col-md-7 min-vh-50" style="background: url('demos/shop/images/sections/3.jpg') center center no-repeat; background-size: cover;">
							<div class="vertical-middle pl-5">
								<h2 class="pl-5"><strong>40%</strong> Off<br>First Order*</h2>
							</div>
						</div>
						<div class="col-md-5 bg-white">
							<div class="card border-0 py-2">
								<div class="card-body">
									<h3 class="card-title mb-4 ls0">Sign up to get the most out of shopping.</h3>
									<ul class="iconlist ml-3">
										<li><i class="icon-circle-blank text-black-50"></i> Receive Exclusive Sale Alerts</li>
										<li><i class="icon-circle-blank text-black-50"></i> 30 Days Return Policy</li>
										<li><i class="icon-circle-blank text-black-50"></i> Cash on Delivery Accepted</li>
									</ul>
									<a href="#" class="button button-rounded ls0 font-weight-semibold ml-0 mb-2 nott px-4">Sign Up</a><br>
									<small class="font-italic text-black-50">Don't worry, it's totally free.</small>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container">

		<!-- Features
		============================================= -->
		<div class="row col-mb-50 mb-0 mt-5">
			<div class="col-lg-7">
				<div class="row mt-3">
					<div class="col-sm-6">
						<div class="feature-box fbox-sm fbox-plain">
							<div class="fbox-icon">
								<a href="#"><i class="icon-line2-present text-dark text-dark"></i></a>
							</div>
							<div class="fbox-content">
								<h3 class="font-weight-normal">100% Original</h3>
								<p>Canvas provides support for Native HTML5 Videos that can be added to a Full Width Background.</p>
							</div>
						</div>
					</div>

					<div class="col-sm-6 mt-4 mt-sm-0">
						<div class="feature-box fbox-sm fbox-plain">
							<div class="fbox-icon">
								<a href="#"><i class="icon-line2-globe text-dark"></i></a>
							</div>
							<div class="fbox-content">
								<h3 class="font-weight-normal">Free Shipping</h3>
								<p>Display your Content attractively using Parallax Sections that have unlimited customizable areas.</p>
							</div>
						</div>
					</div>

					<div class="col-sm-6 mt-4">
						<div class="feature-box fbox-sm fbox-plain">
							<div class="fbox-icon">
								<a href="#"><i class="icon-line2-reload text-dark"></i></a>
							</div>
							<div class="fbox-content">
								<h3 class="font-weight-normal">30-Days Returns</h3>
								<p>You have complete easy control on each &amp; every element that provides endless customization possibilities.</p>
							</div>
						</div>
					</div>

					<div class="col-sm-6 mt-4">
						<div class="feature-box fbox-sm fbox-plain">
							<div class="fbox-icon">
								<a href="#"><i class="icon-line2-wallet text-dark"></i></a>
							</div>
							<div class="fbox-content">
								<h3 class="font-weight-normal">Payment Options</h3>
								<p>We accept Visa, MasterCard and American Express. And We also Deliver by COD(only in US)</p>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-5">
				<div class="accordion clearfix">

					<div class="accordion-header">
						<div class="accordion-icon">
							<i class="accordion-closed icon-ok-circle"></i>
							<i class="accordion-open icon-remove-circle"></i>
						</div>
						<div class="accordion-title">
							Our Mission
						</div>
					</div>
					<div class="accordion-content">Donec sed odio dui. Nulla vitae elit libero, a pharetra augue. Nullam id dolor id nibh ultricies vehicula ut id elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.</div>

					<div class="accordion-header">
						<div class="accordion-icon">
							<i class="accordion-closed icon-ok-circle"></i>
							<i class="accordion-open icon-remove-circle"></i>
						</div>
						<div class="accordion-title">
							What we Do?
						</div>
					</div>
					<div class="accordion-content">Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Duis mollis, est non commodo luctus. Aenean lacinia bibendum nulla sed consectetur. Cras mattis consectetur purus sit amet fermentum.</div>

					<div class="accordion-header">
						<div class="accordion-icon">
							<i class="accordion-closed icon-ok-circle"></i>
							<i class="accordion-open icon-remove-circle"></i>
						</div>
						<div class="accordion-title">
							Our Company's Values
						</div>
					</div>
					<div class="accordion-content">Nullam id dolor id nibh ultricies vehicula ut id elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Duis mollis, est non commodo luctus. Aenean lacinia bibendum nulla sed consectetur.</div>

					<div class="accordion-header">
						<div class="accordion-icon">
							<i class="accordion-closed icon-ok-circle"></i>
							<i class="accordion-open icon-remove-circle"></i>
						</div>
						<div class="accordion-title">
							Our Return Policy
						</div>
					</div>
					<div class="accordion-content">Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Duis mollis, est non commodo luctus. Aenean lacinia bibendum nulla sed consectetur. Cras mattis consectetur purus sit amet fermentum.</div>

				</div>
			</div>

		</div>

		<div class="clear"></div>

		<!-- Brands
		============================================= -->
		<div class="row mt-5">
			<div class="col-12">
				<div class="fancy-title title-border title-center mb-4">
					<h4>Brands who give Flat <span class="text-danger">40%</span> Off</h4>
				</div>
				
				<ul class="clients-grid grid-2 grid-sm-3 grid-md-6 grid-lg-8 mb-0">
					@foreach($brands as $brand)
					<li class="grid-item"><a href="#"><img src="{{ asset('download.PNG') }}" alt="Clients"></a></li>
					@endforeach
				</ul>
			</div>
		</div>
	
	</div>
	
	<div class="clear"></div>

	<!-- App Buttons
	============================================= -->
	<div class="section pb-0 mb-0" style="background-color: #f8f5f0">
		<div class="container">
			<div class="row">
				<div class="col-md-6 offset-1 bottommargin-lg d-flex flex-column align-self-center">
					<h3 class="card-title font-weight-normal ls0">Follow. Find. Favorite.<br>Discover Fashion on the Go.</h3>
					<span>Proactively enable Corporate Benefits.</span>
					<div class="mt-3">
						<a href="#" class="button inline-block button-small button-rounded button-desc font-weight-normal ls1 clearfix"><i class="icon-apple"></i><div><span>Download Canvas Shop</span>App Store</div></a>
						<a href="#" class="button inline-block button-small button-rounded button-desc button-light text-dark font-weight-normal ls1 bg-white border clearfix"><i class="icon-googleplay"></i><div><span>Download Canvas Shop</span>Google Play</div></a>
					</div>
				</div>
				<div class="col-md-4 d-none d-md-flex align-items-end">
					<img src="demos/shop/images/sections/app.png" alt="Image" class="mb-0">
				</div>
			</div>
		</div>
	</div>

	<!-- Last Section
	============================================= -->
	<div class="section footer-stick bg-white m-0 py-3 border-bottom">
		<div class="container clearfix">

			<div class="row clearfix">
				<div class="col-lg-4 col-md-6">
					<div class="shop-footer-features mb-3 mb-lg-3"><i class="icon-line2-globe-alt"></i><h5 class="inline-block mb-0 ml-2 font-weight-semibold"><a href="#">Free Shipping</a><span class="font-weight-normal text-muted"> &amp; Easy Returns</span></h5></div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="shop-footer-features mb-3 mb-lg-3"><i class="icon-line2-notebook"></i><h5 class="inline-block mb-0 ml-2"><a href="#">Geniune Products</a><span class="font-weight-normal text-muted"> Guaranteed</span></h5></div>
				</div>
				<div class="col-lg-4 col-md-12">
					<div class="shop-footer-features mb-3 mb-lg-3"><i class="icon-line2-lock"></i><h5 class="inline-block mb-0 ml-2"><a href="#">256-Bit</a> <span class="font-weight-normal text-muted">Secured Checkouts</span></h5></div>
				</div>
			</div>

		</div>
	</div>
</div>
</section>

@endsection
@section('js')
<script>
$(document).on('click', '.addToCartButton', function (e) {
            e.preventDefault();
            
            const productId = $('.addToCartButton').attr('data-product-id');
    
            $.ajax({
                method: "post",
                url: "{{route('add-to.cart')}}",
                data: {
                    "_token": '{{csrf_token()}}',
                    "product_id": productId,
             
                },
                success: function (res) {
                    if (res.status == 'success') {
                        toastr.success(res.message, 'success', {timeOut: 5000});
                    } else {
                            toastr.error(res.message, 'failed', {timeOut: 5000});
                    
                    }
                }

            })

        });
	
		</script>
			<script>
  $(document).on('click', '.top-cart-number', function (e) {
            e.preventDefault();
            console.log(e);
            
            $.ajax({
                method: "get",
                url: "{{route('view.cart')}}",
            
                success: function (res) {
                    let html = '';
                    $.each(res.data, function (index, value) {
                        html += `<div class="top-cart-item">
											<div class="top-cart-item-image">
												<a href="#"><img src="/ + ${value.image}" alt="Blue Round-Neck Tshirt" /></a
											</div>
										
											<div class="top-cart-item-des">
												<div class="top-cart-item-desc-title">
													<a href="#">${value.name}</a>
													<span class="top-cart-item-price d-block">${value.name}</span>
												</div>
												<div class="top-cart-item-quantity">x ${value.quantity}</div>
											</div>
										</div>`;
                    })

                    $('#showCart').html(html);
                }
            
            })
        
        })
        
		
 
		@endsection