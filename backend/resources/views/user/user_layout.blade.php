
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="cache-control" content="max-age=604800" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<title>{{$setting[0]->site_name}} </title>

<link href="{{asset('website/images/favicon.ico')}}" rel="shortcut icon" type="image/x-icon">

<!-- jQuery -->
<script src="{{asset('website/js/jquery-2.0.0.min.js')}}" type="text/javascript"></script>

<!-- Bootstrap4 files-->
<script src="{{asset('website/js/bootstrap.bundle.min.js')}}" type="text/javascript"></script>
<link href="{{asset('website/css/bootstrap.css')}}" rel="stylesheet" type="text/css"/>

<!-- Font awesome 5 -->
<link href="{{asset('website/fonts/fontawesome/css/all.min.css')}}" type="text/css" rel="stylesheet">

<!-- custom style -->
<link href="{{asset('website/css/ui.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('website/css/responsive.css')}}" rel="stylesheet" media="only screen and (max-width: 1200px)" />

<!-- custom javascript -->
<script src="{{asset('website/js/script.js')}}" type="text/javascript"></script>

<script type="text/javascript">
/// some script

// jquery ready start
$(document).ready(function() {
	// jQuery code

}); 
// jquery end
</script>

</head>
<body>


<header class="section-header">

<nav class="navbar navbar-dark navbar-expand p-0 bg-primary">
<div class="container">
    <ul class="navbar-nav d-none d-md-flex mr-auto">
		<li class="nav-item"><a class="nav-link" href="#">Home</a></li>
		<li class="nav-item"><a class="nav-link" href="#">Delivery</a></li>
		<li class="nav-item"><a class="nav-link" href="#">Payment</a></li>
    </ul>
    <ul class="navbar-nav">
		<li  class="nav-item"><a href="#" class="nav-link"> Call: {{$setting[0]->phone}} </a></li>
		<li class="nav-item dropdown">
		 	<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"> English </a>
		    <ul class="dropdown-menu dropdown-menu-right" style="max-width: 100px;">
				<li><a class="dropdown-item" href="#">Arabic</a></li>
				<li><a class="dropdown-item" href="#">Russian </a></li>
		    </ul>
		</li>
	</ul> <!-- list-inline //  -->
  </div> <!-- navbar-collapse .// -->
</div> <!-- container //  -->
</nav> <!-- header-top-light.// -->

<section class="header-main border-bottom">
	<div class="container">
<div class="row align-items-center">
	<div class="col-lg-2 col-6">
		<a href="" class="brand-wrap">
			
			<img class="logo" src=" {{asset('/'.$setting[0]->site_logo)}} ">
		</a> <!-- brand-wrap.// -->
	</div>
	<div class="col-lg-6 col-12 col-sm-12">
		<form action="#" class="search">
			<div class="input-group w-100">
			    <input type="text" class="form-control" placeholder="Search">
			    <div class="input-group-append">
			      <button class="btn btn-primary" type="submit">
			        <i class="fa fa-search"></i>
			      </button>
			    </div>
		    </div>
		</form> <!-- search-wrap .end// -->
	</div> <!-- col.// -->
	<div class="col-lg-4 col-sm-6 col-12">
		<div class="widgets-wrap float-md-right">
			<div class="widget-header  mr-3">
				<a href="#" class="icon icon-sm rounded-circle border"><i class="fa fa-shopping-cart"></i></a>
				<span class="badge badge-pill badge-danger notify">0</span>
			</div>
			<div class="widget-header icontext">
				<a href="#" class="icon icon-sm rounded-circle border"><i class="fa fa-user"></i></a>
				<div class="text">
					<span class="text-muted">Welcome!</span>
					<div> 
						<a href="#">Sign in</a> |  
						<a href="#"> Register</a>
					</div>
				</div>
			</div>
		</div> <!-- widgets-wrap.// -->
	</div> <!-- col.// -->
</div> <!-- row.// -->
	</div> <!-- container.// -->
</section> <!-- header-main .// -->
</header> <!-- section-header.// -->

       
 
<nav class="navbar navbar-main navbar-expand-lg navbar-light border-bottom">
  <div class="container">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav" aria-controls="main_nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="main_nav">
      <ul class="navbar-nav">
      	<li class="nav-item dropdown">
          <a class="nav-link pl-0" data-toggle="dropdown" href="#"><strong> <i class="fa fa-bars"></i> &nbsp  All category</strong></a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Foods and Drink</a>
            <a class="dropdown-item" href="#">Home interior</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Category 1</a>
            <a class="dropdown-item" href="#">Category 2</a>
            <a class="dropdown-item" href="#">Category 3</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Fashion</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Supermarket</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Electronics</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Baby &amp Toys</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Fitness sport</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Clothing</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Furnitures</a>
        </li>
      </ul>
    </div> <!-- collapse .// -->
  </div> <!-- container .// -->
</nav>

</header> <!-- section-header.// -->

  

<!-- ========================= SECTION INTRO ========================= -->
<section class="section-intro padding-y-sm">
<div class="container">

<div class="intro-banner-wrap">
	<img src="{{asset('/'.$slider->slider_image)}}" class="img-fluid rounded" style="height: 320px; width: 100%;">

</div>

</div> <!-- container //  -->
</section>
<!-- ========================= SECTION INTRO END// ========================= -->


<!-- ========================= SECTION FEATURE ========================= -->
<section class="section-content padding-y-sm">
<div class="container">
<article class="card card-body">


<div class="row">
	<div class="col-md-4">	
		<figure class="item-feature">
			<span class="text-primary"><i class="fa fa-2x fa-truck"></i></span>
			<figcaption class="pt-3">
				<h5 class="title">Fast delivery</h5>
				<p>Dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore </p>
			</figcaption>
		</figure> <!-- iconbox // -->
	</div><!-- col // -->
	<div class="col-md-4">
		<figure  class="item-feature">
			<span class="text-primary"><i class="fa fa-2x fa-landmark"></i></span>	
			<figcaption class="pt-3">
				<h5 class="title">Creative Strategy</h5>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				 </p>
			</figcaption>
		</figure> <!-- iconbox // -->
	</div><!-- col // -->
    <div class="col-md-4">
		<figure  class="item-feature">
			<span class="text-primary"><i class="fa fa-2x fa-lock"></i></span>
			<figcaption class="pt-3">
				<h5 class="title">High secured </h5>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				 </p>
			</figcaption>
		</figure> <!-- iconbox // -->
	</div> <!-- col // -->
</div>
</article>

</div> <!-- container .//  -->
</section>
<!-- ========================= SECTION FEATURE END// ========================= -->


<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content">
<div class="container">

<header class="section-heading">
	<h3 class="section-title">Popular products</h3>
</header><!-- sect-heading -->

	
<div class="row">
	<div class="col-md-3">
		<div href="#" class="card card-product-grid">
			<a href="#" class="img-wrap"> <img src="images/items/1.jpg"> </a>
			<figcaption class="info-wrap">
				<a href="#" class="title">Just another product name</a>
				
				<div class="rating-wrap">
					<ul class="rating-stars">
						<li style="width:80%" class="stars-active"> 
							<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
						</li>
						<li>
							<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> 
						</li>
					</ul>
					<span class="label-rating text-muted"> 34 reviws</span>
				</div>
				<div class="price mt-1">$179.00</div> <!-- price-wrap.// -->
			</figcaption>
		</div>
	</div> <!-- col.// -->
	<div class="col-md-3">
		<div href="#" class="card card-product-grid">
			<a href="#" class="img-wrap"> <img src="images/items/2.jpg"> </a>
			<figcaption class="info-wrap">
				<a href="#" class="title">Some item name here</a>
				
				<div class="rating-wrap">
					<ul class="rating-stars">
						<li style="width:80%" class="stars-active"> 
							<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
						</li>
						<li>
							<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> 
						</li>
					</ul>
					<span class="label-rating text-muted"> 34 reviws</span>
				</div>
				<div class="price mt-1">$280.00</div> <!-- price-wrap.// -->
			</figcaption>
		</div>
	</div> <!-- col.// -->
	<div class="col-md-3">
		<div href="#" class="card card-product-grid">
			<a href="#" class="img-wrap"> <img src="images/items/3.jpg"> </a>
			<figcaption class="info-wrap">
				<a href="#" class="title">Great product name here</a>
				
				<div class="rating-wrap">
					<ul class="rating-stars">
						<li style="width:80%" class="stars-active"> 
							<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
						</li>
						<li>
							<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> 
						</li>
					</ul>
					<span class="label-rating text-muted"> 34 reviws</span>
				</div>
				<div class="price mt-1">$56.00</div> <!-- price-wrap.// -->
			</figcaption>
		</div>
	</div> <!-- col.// -->
	<div class="col-md-3">
		<div href="#" class="card card-product-grid">
			<a href="#" class="img-wrap"> <img src="images/items/4.jpg"> </a>
			<figcaption class="info-wrap">
				<a href="#" class="title">Just another product name</a>
				
				<div class="rating-wrap">
					<ul class="rating-stars">
						<li style="width:80%" class="stars-active"> 
							<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
						</li>
						<li>
							<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> 
						</li>
					</ul>
					<span class="label-rating text-muted"> 34 reviws</span>
				</div>
				<div class="price mt-1">$179.00</div> <!-- price-wrap.// -->
			</figcaption>
		</div>
	</div> <!-- col.// -->
</div> <!-- row.// -->

</div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->



<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content">
<div class="container">

<header class="section-heading">
	<h3 class="section-title">New arrived</h3>
</header><!-- sect-heading -->

<div class="row">
	<div class="col-md-3">
		<div href="#" class="card card-product-grid">
			<a href="#" class="img-wrap"> <img src="images/items/5.jpg"> </a>
			<figcaption class="info-wrap">
				<a href="#" class="title">Just another product name</a>
				
				<div class="rating-wrap">
					<ul class="rating-stars">
						<li style="width:80%" class="stars-active"> 
							<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
						</li>
						<li>
							<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> 
						</li>
					</ul>
					<span class="label-rating text-muted"> 34 reviws</span>
				</div>
				<div class="price mt-1">$179.00</div> <!-- price-wrap.// -->
			</figcaption>
		</div>
	</div> <!-- col.// -->
	<div class="col-md-3">
		<div href="#" class="card card-product-grid">
			<a href="#" class="img-wrap"> <img src="images/items/6.jpg"> </a>
			<figcaption class="info-wrap">
				<a href="#" class="title">Some item name here</a>
				
				<div class="rating-wrap">
					<ul class="rating-stars">
						<li style="width:80%" class="stars-active"> 
							<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
						</li>
						<li>
							<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> 
						</li>
					</ul>
					<span class="label-rating text-muted"> 34 reviws</span>
				</div>
				<div class="price mt-1">$280.00</div> <!-- price-wrap.// -->
			</figcaption>
		</div>
	</div> <!-- col.// -->
	<div class="col-md-3">
		<div href="#" class="card card-product-grid">
			<a href="#" class="img-wrap"> <img src="images/items/7.jpg"> </a>
			<figcaption class="info-wrap">
				<a href="#" class="title">Great product name here</a>
				
				<div class="rating-wrap">
					<ul class="rating-stars">
						<li style="width:80%" class="stars-active"> 
							<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
						</li>
						<li>
							<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> 
						</li>
					</ul>
					<span class="label-rating text-muted"> 34 reviws</span>
				</div>
				<div class="price mt-1">$56.00</div> <!-- price-wrap.// -->
			</figcaption>
		</div>
	</div> <!-- col.// -->
	<div class="col-md-3">
		<div href="#" class="card card-product-grid">
			<a href="#" class="img-wrap"> <img src="images/items/9.jpg"> </a>
			<figcaption class="info-wrap">
				<a href="#" class="title">Just another product name</a>
				
				<div class="rating-wrap">
					<ul class="rating-stars">
						<li style="width:80%" class="stars-active"> 
							<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
						</li>
						<li>
							<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> 
						</li>
					</ul>
					<span class="label-rating text-muted"> 34 reviws</span>
				</div>
				<div class="price mt-1">$179.00</div> <!-- price-wrap.// -->
			</figcaption>
		</div>
	</div> <!-- col.// -->
</div> <!-- row.// -->

</div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->



<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-bottom-sm">
<div class="container">

<header class="section-heading">
	<a href="#" class="btn btn-outline-primary float-right">See all</a>
	<h3 class="section-title">Recommended</h3>
</header><!-- sect-heading -->

<div class="row">
	<div class="col-md-3">
		<div href="#" class="card card-product-grid">
			<a href="#" class="img-wrap"> <img src="images/items/1.jpg"> </a>
			<figcaption class="info-wrap">
				<a href="#" class="title">Just another product name</a>
				<div class="price mt-1">$179.00</div> <!-- price-wrap.// -->
			</figcaption>
		</div>
	</div> <!-- col.// -->
	<div class="col-md-3">
		<div href="#" class="card card-product-grid">
			<a href="#" class="img-wrap"> <img src="images/items/2.jpg"> </a>
			<figcaption class="info-wrap">
				<a href="#" class="title">Some item name here</a>
				<div class="price mt-1">$280.00</div> <!-- price-wrap.// -->
			</figcaption>
		</div>
	</div> <!-- col.// -->
	<div class="col-md-3">
		<div href="#" class="card card-product-grid">
			<a href="#" class="img-wrap"> <img src="images/items/3.jpg"> </a>
			<figcaption class="info-wrap">
				<a href="#" class="title">Great product name here</a>
				<div class="price mt-1">$56.00</div> <!-- price-wrap.// -->
			</figcaption>
		</div>
	</div> <!-- col.// -->
	<div class="col-md-3">
		<div href="#" class="card card-product-grid">
			<a href="#" class="img-wrap"> <img src="images/items/4.jpg"> </a>
			<figcaption class="info-wrap">
				<a href="#" class="title">Just another product name</a>
				<div class="price mt-1">$179.00</div> <!-- price-wrap.// -->
			</figcaption>
		</div>
	</div> <!-- col.// -->
</div> <!-- row.// -->

</div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->

<!-- ========================= SECTION  ========================= -->
<section class="section-name bg padding-y-sm">
<div class="container">
<header class="section-heading">
	<h3 class="section-title">Our Brands</h3>
</header><!-- sect-heading -->

<div class="row">
	<div class="col-md-2 col-6">
		<figure class="box item-logo">
			<a href="#"><img src="images/logos/logo1.png"></a>
			<figcaption class="border-top pt-2">36 Products</figcaption>
		</figure> <!-- item-logo.// -->
	</div> <!-- col.// -->
	<div class="col-md-2  col-6">
		<figure class="box item-logo">
			<a href="#"><img src="images/logos/logo2.png"></a>
			<figcaption class="border-top pt-2">980 Products</figcaption>
		</figure> <!-- item-logo.// -->
	</div> <!-- col.// -->
	<div class="col-md-2  col-6">
		<figure class="box item-logo">
			<a href="#"><img src="images/logos/logo3.png"></a>
			<figcaption class="border-top pt-2">25 Products</figcaption>
		</figure> <!-- item-logo.// -->
	</div> <!-- col.// -->
	<div class="col-md-2  col-6">
		<figure class="box item-logo">
			<a href="#"><img src="images/logos/logo4.png"></a>
			<figcaption class="border-top pt-2">72 Products</figcaption>
		</figure> <!-- item-logo.// -->
	</div> <!-- col.// -->
	<div class="col-md-2  col-6">
		<figure class="box item-logo">
			<a href="#"><img src="images/logos/logo5.png"></a>
			<figcaption class="border-top pt-2">41 Products</figcaption>
		</figure> <!-- item-logo.// -->
	</div> <!-- col.// -->
	<div class="col-md-2  col-6">
		<figure class="box item-logo">
			<a href="#"><img src="images/logos/logo2.png"></a>
			<figcaption class="border-top pt-2">12 Products</figcaption>
		</figure> <!-- item-logo.// -->
	</div> <!-- col.// -->
</div> <!-- row.// -->
</div><!-- container // -->
</section>
<!-- ========================= SECTION  END// ========================= -->



<!-- ========================= SECTION  ========================= -->
<div class=" padding-y">
   <div class="container">
      <output>
         <div class="row">
            <div class="col-md-4">
               <article class="card card-body">
                  <figure class="itemside">
                     <div class="aside"><span class="icon-sm rounded-circle bg-primary"><i class="fa fa-money-bill-alt white"></i></span></div>
                     <figcaption class="info">
                        <h6 class="title">Reasonable prices</h6>
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                           tempor incididunt ut labor 
                        </p>
                     </figcaption>
                  </figure>
               </article>
            </div>
            <div class="col-md-4">
               <article class="card card-body">
                  <figure class="itemside">
                     <div class="aside"><span class="icon-sm rounded-circle bg-secondary"><i class="fa fa-comment-dots white"></i></span></div>
                     <figcaption class="info">
                        <h6 class="title">Customer support 24/7 </h6>
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                           tempor incididunt ut labor 
                        </p>
                     </figcaption>
                  </figure>
               </article>
            </div>
            <div class="col-md-4">
               <article class="card card-body">
                  <figure class="itemside">
                     <div class="aside"><span class="icon-sm rounded-circle bg-success"><i class="fa fa-truck white"></i></span></div>
                     <figcaption class="info">
                        <h6 class="title">Quick delivery</h6>
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                           tempor incididunt ut labor 
                        </p>
                     </figcaption>
                  </figure>
               </article>
            </div>
         </div>
      </output>
   </div>
</div>

<!-- ========================= SECTION  END// ======================= -->



<!-- ========================= FOOTER ========================= -->
<footer class="section-footer border-top">
   <div class="container">
      <section class="footer-top padding-y">
         <div class="row">
            <aside class="col-md-4">
               <article class="mr-3">
                  <a href="/" class="brand-wrap active nuxt-link-active"><img src="{{asset('/'.$setting[0]->site_logo)}}" class="logo-footer img-fluid"></a> 
                  <p class="mt-3"> {{$setting[0]->email}} </p>
                  <div>
                     <!----> <!----> <!----> <!---->
                  </div>
               </article>
            </aside>
            <aside class="col-sm-3 col-md-2">
               <h6 class="title">About</h6>
               <ul class="list-unstyled">
                  <li><a href="#">About us</a></li>
                  <li><a href="#">Services</a></li>
                  <li><a href="#">Rules and terms</a></li>
                  <li><a href="#">Blogs</a></li>
               </ul>
            </aside>
            <aside class="col-sm-3 col-md-2">
               <h6 class="title">Services</h6>
               <ul class="list-unstyled">
                  <li><a href="#">Help center</a></li>
                  <li><a href="#">Money refund</a></li>
                  <li><a href="#">Terms and Policy</a></li>
                  <li><a href="#">Open dispute</a></li>
               </ul>
            </aside>
            <aside class="col-sm-3  col-md-2">
               <h6 class="title">For users</h6>
               <ul class="list-unstyled">
                  <li><a href="/privacy-policy" class=""> Privacy Policy </a></li>
                  <li><a href="/terms-and-condition" class=""> Terms and Condition </a></li>
                  <li><a href="/refund-and-return" class=""> Refund and Return </a></li>
                  <li><a href="/shipping-and-delievery" class=""> Shipping &amp; Delivery </a></li>
                  <li><a href="/payment-policy" class=""> Payment Policy </a></li>
               </ul>
            </aside>
            <aside class="col-sm-2  col-md-2">
               <h6 class="title">Our app</h6>
               <a href="#" class="d-block mb-2"><img src="/_nuxt/img/30853b3.png" height="40"></a> <a href="#" class="d-block mb-2"><img src="/_nuxt/img/4df0946.png" height="40"></a>
            </aside>
         </div>
      </section>
      <section class="footer-copyright border-top">
         <p class="float-left text-muted"> {{ $setting[0]->copyright  }} </p>
         <p target="_blank" class="float-right text-muted"><a href="#">Privacy &amp; Cookies</a> &nbsp;   &nbsp; 
            <a href="#">Accessibility</a>
         </p>
      </section>
   </div>
</footer>
<!-- ========================= FOOTER END // ========================= -->


</body>
</html>