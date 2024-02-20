<!DOCTYPE html> 
<html lang="ar">
	
<!-- doccure/checkout.html  30 Nov 2019 04:12:16 GMT -->
<head>
		<meta charset="utf-8">
		<title>purehub</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		
		<!-- Favicons -->
		<link href="assets/img/favicon.png" rel="icon">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="assets/css/style.css">
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	
	</head>
	<body>

		<!-- Main Wrapper -->
		<div class="main-wrapper">
		
		<!-- Header -->
			<header class="header">
				<nav class="navbar navbar-expand-lg header-nav">
					<div class="navbar-header">
						<a id="mobile_btn" href="javascript:void(0);">
							<span class="bar-icon">
								<span></span>
								<span></span>
								<span></span>
							</span>
						</a>
					
					</div>
					<div class="main-menu-wrapper">
						<div class="menu-header">
							
							<a id="menu_close" class="menu-close" href="javascript:void(0);">
								<i class="fas fa-times"></i>
							</a>
						</div>
						<ul class="main-nav">
							<li class="active">
								<a href="#">{{__("messages.Home")}}</a>
							</li>
					
                </li>	
                         <li class="has-submenu">
                                <a href="#">{{__("messages.Language")}}<i class="fas fa-chevron-down"></i></a>
                        <ul class="submenu">
        <li class="{{ session()->has('lang_code') && session()->get('lang_code') == 'en' ? 'selected' : '' }}">
            <a href="javascript:void(0);" onclick="changeLanguage('en')">{{__("messages.English")}}</a>
        </li>
        <li class="{{ session()->has('lang_code') && session()->get('lang_code') == 'ar' ? 'selected' : '' }}">
            <a href="javascript:void(0);" onclick="changeLanguage('ar')">{{__("messages.Arabic")}}</a>
        </li>
        <!-- Add more language options as needed -->
    </ul>
</li>
								
							
						
						
							<li class="login-link">
								<a href="#">Login / Signup</a>
							</li>
						</ul>		 
					</div>		 
					<ul class="nav header-navbar-rht">
					
						<li class="nav-item">
							<a class="nav-link header-login" href="#">login / Signup </a>
						</li>
					</ul>
				</nav>
			</header>





			<!-- /Header -->
			
			<!-- Breadcrumb -->
			<div class="breadcrumb-bar">
				<div class="container-fluid">
					<div class="row align-items-center">
						<div class="col-md-12 col-12">
							<nav aria-label="breadcrumb" class="page-breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index-2.html">{{__("messages.Home")}}</a></li>
									<li class="breadcrumb-item active" aria-current="page">{{__("messages.Checkout")}}</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">{{__("messages.Checkout")}}</h2>
						</div>
					</div>
				</div>
			</div>
			<!-- /Breadcrumb -->
			
			<!-- Page Content -->
			<div class="content">
				<div class="container">

					<div class="row">
						<div class="col-md-7 col-lg-8">
							<div class="card">
								<div class="card-body">
								
									<!-- Checkout Form -->
									<form action="{{ url('OTPSMS')}}" method="GET">
									
									
										<!-- /Personal Information -->
										
										<div class="payment-widget">
											<h4 class="card-title">{{__("messages.Payment")}}</h4>
											
											<!-- Credit Card Payment -->
											<div class="payment-list">
												<label class="payment-radio credit-card-option">
													<input type="radio" name="radio" checked>
													<span class="checkmark"></span>
													{{__("messages.Credit")}}
												</label>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group card-label">
															<label for="card_name">Name</label>
															<input class="form-control" id="card_name" type="text">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group card-label">
															<label for="card_number">phone Number</label>
															<input class="form-control" id="card_number" placeholder="12345432" type="number">
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group card-label">
															<label for="card_number">email</label>
															<input class="form-control" id="card_number" placeholder="" type="emil">
														</div>
													</div>
													
												
													
												</div>
											</div>
											<!-- /Credit Card Payment -->
											
										
											
											<!-- Terms Accept -->
										
											<!-- /Terms Accept -->
											
											<!-- Submit Section -->
											<div class="submit-section mt-4">
												<button type="submit" class="btn btn-primary submit-btn">{{__("messages.Confirm")}}</button>
											</div>
											<!-- /Submit Section -->
											
										</div>
									</form>
									<!-- /Checkout Form -->
									
								</div>
							</div>
							
						</div>
						
						<div class="col-md-5 col-lg-4 theiaStickySidebar">
					
							<!-- Booking Summary -->
							<div class="card booking-card">
								<div class="card-header">
									<h4 class="card-title">{{__("messages.name")}}</h4>
								</div>
								<div class="card-body">
								
									<!-- Booking Doctor Info -->
									<div class="booking-doc-info">
										<a href="doctor-profile.html" class="booking-doc-img">
											<img src="assets/img/doctors/doctor-04.jpg" alt="User Image">
										</a>
										<div class="booking-info">
											<h4><a href="doctor-profile.html">{{__("messages.namee")}}</a></h4>
											<div class="rating">
												<i class="fas fa-star filled"></i>
												<i class="fas fa-star filled"></i>
												<i class="fas fa-star filled"></i>
												<i class="fas fa-star filled"></i>
												<i class="fas fa-star"></i>
												<span class="d-inline-block average-rating">35</span>
											</div>
											<div class="clinic-details">
												<p class="doc-location"><i class="fas fa-map-marker-alt"></i>{{__("messages.Riyadh")}}</p>
											</div>
										</div>
									</div>
									<!-- Booking Doctor Info -->
									
									<div class="booking-summary">
										<div class="booking-item-wrap">
										
											<ul class="booking-fee">
												<li>{{__("messages.inf")}} <span>$100</span></li>
												<li>{{__("messages.tax")}} <span>$10</span></li>
											
											</ul>
											<div class="booking-total">
												<ul class="booking-total-list">
													<li>
													    <span class="total-cost">110SAR</span>
														<span>{{__("messages.Total")}}</span>
														
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- /Booking Summary -->
						
						</div>
					</div>

				</div>

			</div>		
			<!-- /Page Content -->
   
			<!-- Footer -->
		<footer id="footer" class="ct-footer" data-id="type-1" itemscope="" itemtype="https://schema.org/WPFooter" ><div data-row="bottom" ><div class="ct-container" data-columns-divider="sm" ><div data-column="copyright" >
<div
	class="ct-footer-copyright"
	data-id="copyright" >

	<p>Thamer © 2023</p></div>
</div><div data-column="socials" >
<div
	class="ct-footer-socials"
	data-id="socials" >

	
		<div class="ct-social-box" data-icon-size="custom" data-color="custom" data-icons-type="simple" >
			
			
							
				<a href="https://wa.me/966502778822" data-network="whatsapp" aria-label="WhatsApp" rel="noopener" >
					<span class="ct-icon-container" >
				<svg
				width="20px"
				height="20px"
				viewBox="0 0 20 20"
				aria-hidden="true">
					<path d="M10,0C4.5,0,0,4.5,0,10c0,1.9,0.5,3.6,1.4,5.1L0.1,20l5-1.3C6.5,19.5,8.2,20,10,20c5.5,0,10-4.5,10-10S15.5,0,10,0zM6.6,5.3c0.2,0,0.3,0,0.5,0c0.2,0,0.4,0,0.6,0.4c0.2,0.5,0.7,1.7,0.8,1.8c0.1,0.1,0.1,0.3,0,0.4C8.3,8.2,8.3,8.3,8.1,8.5C8,8.6,7.9,8.8,7.8,8.9C7.7,9,7.5,9.1,7.7,9.4c0.1,0.2,0.6,1.1,1.4,1.7c0.9,0.8,1.7,1.1,2,1.2c0.2,0.1,0.4,0.1,0.5-0.1c0.1-0.2,0.6-0.7,0.8-1c0.2-0.2,0.3-0.2,0.6-0.1c0.2,0.1,1.4,0.7,1.7,0.8s0.4,0.2,0.5,0.3c0.1,0.1,0.1,0.6-0.1,1.2c-0.2,0.6-1.2,1.1-1.7,1.2c-0.5,0-0.9,0.2-3-0.6c-2.5-1-4.1-3.6-4.2-3.7c-0.1-0.2-1-1.3-1-2.6c0-1.2,0.6-1.8,0.9-2.1C6.1,5.4,6.4,5.3,6.6,5.3z"/>
				</svg>
			</span>				</a>
							
				<a href="https://twitter.com/iThamerSA" data-network="twitter" aria-label="X (Twitter)" rel="noopener" >
					<span class="ct-icon-container" >
				<svg
				width="20px"
				height="20px"
				viewBox="0 0 20 20"
				aria-hidden="true">
					<path d="M2.9 0C1.3 0 0 1.3 0 2.9v14.3C0 18.7 1.3 20 2.9 20h14.3c1.6 0 2.9-1.3 2.9-2.9V2.9C20 1.3 18.7 0 17.1 0H2.9zm13.2 3.8L11.5 9l5.5 7.2h-4.3l-3.3-4.4-3.8 4.4H3.4l5-5.7-5.3-6.7h4.4l3 4 3.5-4h2.1zM14.4 15 6.8 5H5.6l7.7 10h1.1z"/>
				</svg>
			</span>				</a>
							
				<a href="tel:0502778822" data-network="phone" aria-label="الهاتف" rel="noopener" >
					<span class="ct-icon-container" >
				<svg
				width="20"
				height="20"
				viewBox="0 0 20 20"
				aria-hidden="true">
					<path d="M4.8,0C2.1,0,0,2.1,0,4.8v10.5C0,17.9,2.1,20,4.8,20h10.5c2.6,0,4.8-2.1,4.8-4.8V4.8C20,2.1,17.9,0,15.2,0H4.8z M6.7,3.8C7,3.8,7.2,4,7.4,4.3C7.6,4.6,7.9,5,8.3,5.6c0.3,0.5,0.4,1.2,0.1,1.8l-0.7,1C7.4,8.7,7.4,9,7.5,9.3c0.2,0.5,0.6,1.2,1.3,1.9c0.7,0.7,1.4,1.1,1.9,1.3c0.3,0.1,0.6,0.1,0.9-0.1l1-0.7c0.6-0.3,1.3-0.3,1.8,0.1c0.6,0.4,1.1,0.7,1.3,0.9c0.3,0.2,0.4,0.4,0.4,0.7c0.1,1.7-1.2,2.4-1.6,2.4c-0.3,0-3.4,0.4-7-3.2s-3.2-6.8-3.2-7C4.3,5.1,5,3.8,6.7,3.8z"/>
				</svg>
			</span>				</a>
			
			
					</div>

	</div>

</div></div></div></footer>
			<!-- /Footer -->
		   
		</div>
		<!-- /Main Wrapper -->
	  
		<!-- jQuery -->
		<script src="assets/js/jquery.min.js"></script>
			<script>
    function changeLanguage(lang) {
        // Assuming you have a route named 'change-language' for handling language changes
        window.location = '{{ url("change-language") }}/' + lang;
    }
</script>
		<!-- Bootstrap Core JS -->
		<script src="assets/js/popper.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		
		<!-- Sticky Sidebar JS -->
        <script src="assets/plugins/theia-sticky-sidebar/ResizeSensor.js"></script>
        <script src="assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
		
	</body>

<!-- doccure/checkout.html  30 Nov 2019 04:12:16 GMT -->
</html>