<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
	
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	
	@include('layouts.lk')
	
	<title>Shop Demo | Canvas</title>

</head>

<body class="stretched">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		<div class="modal-on-load d-none" data-target="#myModal1"></div>

		<!-- On LOad Modal -->
		<div class="modal1 mfp-hide subscribe-widget mx-auto" id="myModal1" style="max-width: 750px;">
			<div class="row justify-content-center bg-white align-items-center" style="min-height: 380px;">
				<div class="col-md-5 p-0">
					<div style="background: url('images/modals/modal1.jpg') no-repeat center right; background-size: cover;  min-height: 380px;"></div>
				</div>
				<div class="col-md-7 bg-white p-4">
					<div class="heading-block border-bottom-0 mb-3">
						<h3 class="font-secondary nott ">Join Our Newsletter &amp; Get <span class="text-danger">40%</span> Off your First Order</h3>
						<span>Get Latest Fashion Updates &amp; Offers</span>
					</div>
					<div class="widget-subscribe-form-result"></div>
					<form class="widget-subscribe-form2 mb-2" action="http://themes.semicolonweb.com/html/canvas/include/subscribe.php" method="post">
						<input type="email" id="widget-subscribe-form2-email" name="widget-subscribe-form-email" class="form-control required email" placeholder="Enter your Email Address..">
						<div class="d-flex justify-content-between align-items-center mt-1">
							<button class="button button-dark  bg-dark text-white ml-0" type="submit">Subscribe</button>
							<a href="#" class="btn-link" onClick="$.magnificPopup.close();return false;">Don't Show me</a>
						</div>
					</form>
					<small class="mb-0 font-italic text-black-50">*We also hate Spam &amp; Junk Emails.</small>
				</div>
			</div>
		</div>

		<!-- Login Modal -->
		<div class="modal1 mfp-hide d-none" id="modal-register">
			<div class="card mx-auto" style="max-width: 540px;">
				<div class="card-header py-3 bg-transparent center">
					<h3 class="mb-0 font-weight-normal">Hello, Welcome Back</h3>
				</div>
				<div class="card-body mx-auto py-5" style="max-width: 70%;">
					


					<form id="login-form" name="login-form" class="mb-0 row" action="{{route('customer.authentication')}}" method="post">
						@csrf
						<div class="col-12">
							<input type="email" id="login-form-username" name="email" value="" class="form-control not-dark" placeholder="example@mail.com" />
						</div>
						
						<div class="col-12 mt-4">
							<input type="password" id="login-form-password"  name="password" value="" class="form-control not-dark" placeholder="Password" />
						</div>

						<div class="col-12">
							<a href="#" class="float-right text-dark font-weight-light mt-2">Forgot Password?</a>
						</div>

						<div class="col-12 mt-4">
							<button class="button btn-block m-0" id="login-form-submit" type="submit" value="login">Login</button>
						</div>
					</form>
				</div>
				<div class="card-footer py-4 center">
					<p class="mb-0">Don't have an account? <a href="#"><u>Sign up</u></a></p>
				</div>
			</div>
		</div>

		<!-- Top Bar
		============================================= -->
		<div id="top-bar" class="dark" style="background-color: #a3a5a7;">
			<div class="container">

				<div class="row justify-content-between align-items-center">

					<div class="col-12 col-lg-auto">
						<p class="mb-0 d-flex justify-content-center justify-content-lg-start py-3 py-lg-0"><strong>Free U.S. Shipping on Order above $99. Easy Returns.</strong></p>
					</div>

					<div class="col-12 col-lg-auto d-none d-lg-flex">

						<!-- Top Links
						============================================= -->
						<div class="top-links">
							<ul class="top-links-container">
								<li class="top-links-item"><a href="#">About</a></li>
								<li class="top-links-item"><a href="#">FAQS</a></li>
								<li class="top-links-item"><a href="#">Blogs</a></li>
								<li class="top-links-item"><a href="#">EN</a>
									<ul class="top-links-sub-menu">
										<li class="top-links-item"><a href="#"><img src="images/icons/flags/french.png" alt="French"> FR</a></li>
										<li class="top-links-item"><a href="#"><img src="images/icons/flags/italian.png" alt="Italian"> IT</a></li>
										<li class="top-links-item"><a href="#"><img src="images/icons/flags/german.png" alt="German"> DE</a></li>
									</ul>
								</li>
							</ul>
						</div><!-- .top-links end -->
						
						<!-- Top Social
						============================================= -->
						<ul id="top-social">
							<li><a href="#" class="si-facebook"><span class="ts-icon"><i class="icon-facebook"></i></span><span class="ts-text">Facebook</span></a></li>
							<li><a href="#" class="si-instagram"><span class="ts-icon"><i class="icon-instagram2"></i></span><span class="ts-text">Instagram</span></a></li>
							<li><a href="tel:+1.11.85412542" class="si-call"><span class="ts-icon"><i class="icon-call"></i></span><span class="ts-text">+1.11.85412542</span></a></li>
							<li><a href="mailto:info@canvas.com" class="si-email3"><span class="ts-icon"><i class="icon-envelope-alt"></i></span><span class="ts-text">info@canvas.com</span></a></li>
						</ul><!-- #top-social end -->

					</div>
				</div>
			
			</div>
		</div>
		
	
	
		@include('layouts.header')
		
@yield('customer-content')
		
		@include('layouts.footer')
		

	</div>

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-line-arrow-up"></div>
	
	<!-- JavaScripts
	============================================= -->
	<script src="{{asset('js/jquery.js')}}"></script>
	<script src="{{asset('js/plugins.min.js')}}"></script>
	<script src="{{asset('js/functions.js')}}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
	<script>
  $(document).on('click', '.icon-line-bag', function (e) {
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
        
        });

		$(document).on('click', '.cart-item-remove', function (e) {
            e.preventDefault();
            console.log(e);
			const cart_id =$(this).attr('data-id');
            
            $.ajax({
                method: "get",
                url: "{{route('cart.delete')}}",
				data:{
					cart_id:cart_id,
				},
            
                success: function (res) {
					if(res.status=='success'){
					toastr.success(res.message, 'success', {timeOut: 5000});
                    $('.cartDelete_' +cart_id).remove();
					}
					else{
						toastr.error(res.message, 'failed', {timeOut: 5000});
					}
                }
            
            })
        
        });

        
 </script>
	
	<!-- Footer Scripts
	============================================= -->
    @php $allErrors=''; @endphp
@if (isset($errors) && count($errors) > 0)
    @foreach ($errors->all() as $error)
        @php $allErrors.=$error.'<br/>' @endphp
    @endforeach
    <script>
        $(function () {
            toastr.error('{!! $allErrors !!}', 'Failed', {timeOut: 5000});
        });

    </script>
@endif

@if (session()->has('success'))
    <script>
        $(function () {
            toastr.success('{!! session()->get('success') !!}', 'success', {timeOut: 5000});
        });
    </script>
@endif

@yield('js')

</body>

<!-- Mirrored from themes.semicolonweb.com/html/canvas/demo-shop.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 09 Nov 2020 08:02:37 GMT -->
</html>