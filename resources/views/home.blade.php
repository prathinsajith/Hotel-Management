@extends('layouts.appHotelUser')
@section('content')

<!-- main-slider -->
<section class="w3l-main-slider" id="home">
     <div class="companies20-content">
         <div class="owl-one owl-carousel owl-theme">
             <div class="item">
             @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                 <li>
                     <div class="slider-info banner-view bg bg2">
                         <div class="banner-info">
                             <div class="container">
                                 <div class="banner-info-bg">
                                     <h5>Location is heavenly. Best to visit in week days to enjoy the peaceful beauty
                                     </h5>
                                     
                                 </div>
                             </div>
                         </div>
                     </div>
                 </li>
             </div>
             <div class="item">
                 <li>
                     <div class="slider-info  banner-view banner-top1 bg bg2">
                         <div class="banner-info">
                             <div class="container">
                                 <div class="banner-info-bg">
                                     <h5>Our new hotels will play a leading role in prompting the world peace.</h5>
                                     
                                 </div>
                             </div>
                         </div>
                     </div>
                 </li>
             </div>
             <div class="item">
                 <li>
                     <div class="slider-info banner-view banner-top2 bg bg2">
                         <div class="banner-info">
                             <div class="container">
                                 <div class="banner-info-bg">
                                     <h5>Most hotels train their people with the booklets. We take ours to the ballet.
                                     </h5>
                                    
                                 </div>
                             </div>
                         </div>
                     </div>
                 </li>
             </div>
             <div class="item">
                 <li>
                     <div class="slider-info banner-view banner-top3 bg bg2">
                         <div class="banner-info">
                             <div class="container">
                                 <div class="banner-info-bg">
                                     <h5>Good tourism will follow good hotels. Experience our luxury hotel rooms</h5>
                                    
                                 </div>
                             </div>
                         </div>
                     </div>
                 </li>
             </div>
         </div>
     </div>
 </section>
 <!-- /main-slider -->

<!-- about -->
<section class="w3l-about py-5">
    <div class="container py-sm-4">
        <div class="row">
            <div class="col-lg-6 about-left mb-md-0 mb-5">
                <h3 class="title-big">Relax in our Resort</h3>
                <h5>We make the best for all our customers.</h5>
                <p class="mt-3">Duis nisi sapien, elementum finibus fermentum eget, aliquet leo. Mauris hendrerit vel ex.
                    Quisque vitae luctus massa. Phasellus sed aliquam leo. Vestibulum ullamcorper a massa eu fringilla.
                    Integer ultrices finibus sed nisi. in convallis felis dapibus sit amet. Lorem ipsum dolor, sit
                    amet consectetur adipisicing elit. Totam, porro! Lorem ipsum dolor sit amet.</p>
                <a href="about.html" class="btn btn-style btn-primary mt-sm-5 mt-4">Learn About Us</a>
            </div>
            <div class="col-lg-6 about-right position-relative mt-lg-0 mt-5">
                <img src="assetsuser/images/top.jpg" alt="" class="img-fluid img-border mt-4" />
                <img src="assetsuser/images/bottom.jpg" alt="" class="img-fluid position-absolute img-position" />
            </div>
        </div>
    </div>
</section>
<!-- //about -->
<!-- quotation -->
<div class="quotation py-5">
    <div class="container py-xl-5 py-lg-3">
        <div class="welcome-left text-center py-md-5 py-3">
            <h3>Enjoy a Luxury experience. Discover our locaions. Relax and enjoy your holiday</h3>
            <a href="{{url('booknow')}}" class="btn btn-style transparent-btn mt-sm-5 mt-4 mr-2">Book Now</a>
            <a href="contact.html" class="btn btn-style btn-primary mt-sm-5 mt-4">Contact Us</a>
        </div>
    </div>
</div>
<!-- //quotation -->
<section class="w3l-index3">
    <div class="midd-w3 py-5">
        <div class="container py-lg-5 py-md-3">
            <div class="row">
                <div class="col-lg-6 left-wthree-img text-righ">
                    <div class="position-relative">
                        <img src="assetsuser/images/videobg.jpg" alt="" class="img-fluid" />
                        <a href="#small-dialog" class="popup-with-zoom-anim play-view text-center position-absolute">
                            <span class="video-play-icon">
                                <span class="fa fa-play"></span>
                            </span>
                        </a>
                        <!-- dialog itself, mfp-hide class is required to make dialog hidden -->
                        <div id="small-dialog" class="zoom-anim-dialog mfp-hide">
                            <iframe src="https://player.vimeo.com/video/246941769" allow="autoplay; fullscreen" allowfullscreen=""></iframe>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mt-lg-0 mt-5 about-right-faq align-self">
                    <h6>Discover our Locations</h6>
                    <h3 class="title-big">20 Years of Hotels and Resort Experience</h3>
                    <p class="mt-3">Lorem ipsum viverra feugiat. Pellen tesque libero ut justo,
                        ultrices in ligula. Semper at tempufddfel.</p>
                    <ul class="w3l-right-book mt-4">
                        <li><span class="fa fa-check" aria-hidden="true"></span>We make the best for all our customers</li>
                        <li><span class="fa fa-check" aria-hidden="true"></span>Follow our Resort Luxury Hotels</li>
                        <li><span class="fa fa-check" aria-hidden="true"></span>Luxury hotels and best resorts</li>
                        <li><span class="fa fa-check" aria-hidden="true"></span>Double rooms and family rooms</li>
                        <li><span class="fa fa-check" aria-hidden="true"></span>Enjoy a luxury experience</li>
                    </ul>
                    <a href="about.html" class="btn btn-style btn-primary mt-4">Check all packages</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection