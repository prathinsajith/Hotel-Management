<!--
Author: W3layouts
Author URL: http://w3layouts.com
-->
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Hotels | Home </title>

  <link href="//fonts.googleapis.com/css?family=Spartan:400,500,600,700,900&display=swap" rel="stylesheet">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{asset('assetsuser/css/style-starter.css')}}">
</head>

<body>
  <!--w3l-header-->

  <header class="w3l-header-nav">
    <!--/nav-->
    <nav class="navbar navbar-expand-lg navbar-light fill px-lg-0 py-0 px-3">
      <div class="container">
        <a class="navbar-brand" href="index.html">
          <img src="{{asset('assetsuser/images/hotels.png')}}" alt="Your logo" style="height:35px;" /> Hotels</a>
        <!-- if logo is image enable this   
						<a class="navbar-brand" href="#index.html">
							<img src="image-path" alt="Your logo" title="Your logo" style="height:35px;" />
						</a> -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="{{ route('welcome') }}">Home</a>
            </li>
            <li class="nav-item @@about__active">
              <a class="nav-link" href="{{ route('about') }}">About</a>
            </li>
            <li class="nav-item @@services__active">
              <a class="nav-link" href="{{ route('service') }}">Services</a>
            </li>
            <li class="nav-item @@contact__active">
              <a class="nav-link" href="{{ route('contact') }}">Contact</a>
            </li>
          </ul>
          <a href="{{ route('login') }}" class="ml-3 book btn btn-secondary btn-style">Login </a>
          <a href="{{ route('register') }}" class="ml-3 book btn btn-secondary btn-style">Register </a>
        </div>
      </div>
    </nav>
    <!--//nav-->
  </header>
  <!-- //w3l-header -->

  @yield('content')
  <section class="w3l-footer-29-main">
    <div class="footer-29 py-5">
      <div class="container py-lg-4">
        <div class="row footer-top-29">
          <div class="col-lg-3 col-md-6 col-sm-8 footer-list-29 footer-1">
            <h6 class="footer-title-29">Contact Us</h6>
            <ul>
              <li>
                <p><span class="fa fa-map-marker"></span> Luxury hotel, #32841 block, #221DRS Rental & Paid rooms
                  business, UK.</p>
              </li>
              <li><a href="tel:+7-800-999-800"><span class="fa fa-phone"></span> +(21)-255-999-8888</a></li>
              <li><a href="mailto:hotels@mail.com" class="mail"><span class="fa fa-envelope-open-o"></span>
                  hotels@mail.com</a></li>
            </ul>
          </div>
          <div class="col-lg-2 col-md-6 col-sm-4 footer-list-29 footer-2 mt-sm-0 mt-5">

            <ul>
              <h6 class="footer-title-29">Useful Links</h6>
              <li><a href="index.html">Home</a></li>
              <li><a href="about.html">About hotels</a></li>
              <li><a href="#blogposts"> Blog posts</a></li>
              <li><a href="contact.html">Contact us</a></li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-5 footer-list-29 footer-3 mt-lg-0 mt-5">
            <h6 class="footer-title-29">Latest from blog</h6>
            <div class="footer-post mb-4">
              <a href="#url">Work Passionately</a>
              <p class="small"><span class="fa fa-clock-o"></span> March 9, 2020</p>
            </div>
            <div class="footer-post">
              <a href="#url">Work Passionately without any hesitation</a>
              <p class="small"><span class="fa fa-clock-o"></span> March 9, 2020</p>
            </div>

          </div>
          <div class="col-lg-4 col-md-6 col-sm-7 footer-list-29 footer-4 mt-lg-0 mt-5">
            <h6 class="footer-title-29">Newsletter </h6>
            <p>Enter your email and receive the latest news from us.
              We'll never share your email address</p>

            <form action="#" class="subscribe" method="post">
              <input type="email" name="email" placeholder="Your Email Address" required="">
              <button><span class="fa fa-envelope-o"></span></button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="w3l-footer-29-main w3l-copyright">
    <div class="container">
      <div class="row bottom-copies">
        <p class="col-lg-8 copy-footer-29">© 2020 Hotels. All rights reserved | Designed by <a href="https://voyotech.com/">Voyo Technologies</a></p>

        <div class="col-lg-4 main-social-footer-29">
          <a href="#facebook" class="facebook"><span class="fa fa-facebook"></span></a>
          <a href="#twitter" class="twitter"><span class="fa fa-twitter"></span></a>
          <a href="#instagram" class="instagram"><span class="fa fa-instagram"></span></a>
          <a href="#linkedin" class="linkedin"><span class="fa fa-linkedin"></span></a>
        </div>

      </div>
    </div>

    <!-- move top -->
    <button onclick="topFunction()" id="movetop" title="Go to top">
      &#10548;
    </button>
    <script>
      // When the user scrolls down 20px from the top of the document, show the button
      window.onscroll = function() {
        scrollFunction()
      };

      function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
          document.getElementById("movetop").style.display = "block";
        } else {
          document.getElementById("movetop").style.display = "none";
        }
      }

      // When the user clicks on the button, scroll to the top of the document
      function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
      }
    </script>
    <!-- /move top -->
  </section>

  <!-- Template JavaScript -->
  <script src="{{asset('assetsuser/js/jquery-3.3.1.min.js')}}"></script>

  <script src="{{asset('assetsuser/js/owl.carousel.js')}}"></script>
  <!-- script for banner slider-->
  <script>
    $(document).ready(function() {
      $('.owl-one').owlCarousel({
        loop: true,
        margin: 0,
        nav: false,
        responsiveClass: true,
        autoplay: false,
        autoplayTimeout: 5000,
        autoplaySpeed: 1000,
        autoplayHoverPause: false,
        responsive: {
          0: {
            items: 1,
            nav: false
          },
          480: {
            items: 1,
            nav: false
          },
          667: {
            items: 1,
            nav: true
          },
          1000: {
            items: 1,
            nav: true
          }
        }
      })
    })
  </script>
  <!-- //script -->

  <!-- script for owlcarousel -->
  <script>
    $(document).ready(function() {
      $('.owl-testimonial').owlCarousel({
        loop: true,
        margin: 0,
        nav: true,
        responsiveClass: true,
        autoplay: false,
        autoplayTimeout: 5000,
        autoplaySpeed: 1000,
        autoplayHoverPause: false,
        responsive: {
          0: {
            items: 1,
            nav: false
          },
          480: {
            items: 1,
            nav: false
          },
          667: {
            items: 1,
            nav: true
          },
          1000: {
            items: 1,
            nav: true
          }
        }
      })
    })
  </script>
  <!-- //script for owlcarousel -->
  <script src="{{asset('assetsuser/js/jquery.magnific-popup.min.js')}}"></script>
  <script>
    $(document).ready(function() {
      $('.popup-with-zoom-anim').magnificPopup({
        type: 'inline',

        fixedContentPos: false,
        fixedBgPos: true,

        overflowY: 'auto',

        closeBtnInside: true,
        preloader: false,

        midClick: true,
        removalDelay: 300,
        mainClass: 'my-mfp-zoom-in'
      });

      $('.popup-with-move-anim').magnificPopup({
        type: 'inline',

        fixedContentPos: false,
        fixedBgPos: true,

        overflowY: 'auto',

        closeBtnInside: true,
        preloader: false,

        midClick: true,
        removalDelay: 300,
        mainClass: 'my-mfp-slide-bottom'
      });
    });
  </script>


  <!-- disable body scroll which navbar is in active -->
  <script>
    $(function() {
      $('.navbar-toggler').click(function() {
        $('body').toggleClass('noscroll');
      })
    });
  </script>
  <!-- disable body scroll which navbar is in active -->

  <script src="{{asset('assetsuser/js/bootstrap.min.js')}}"></script>

</body>

</html>