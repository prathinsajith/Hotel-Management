@extends('layouts.appHotel')

@section('content')

<section class="w3l-breadcrumb">
    <div class="breadcrum-bg py-sm-5 py-4">
        <div class="container py-lg-3">
            <h2>Contact Us</h2>
            <p><a href="index.html">Home</a> &nbsp; / &nbsp; Contact</p>

        </div>
    </div>
</section>
<!-- contact1 -->
<section class="w3l-contact-1 py-5">
    <div class="contacts-9 py-lg-5 py-sm-4">
        <div class="container">
            <div class="d-grid contact-view">
                <div class="cont-details">
                    <p>Get in touch</p>
                    <h3 class="title-big">Contact and Access</h3>
                </div>
                <div class="map-content-9">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit tempore sapiente, distinctio
                        perferendis voluptas consequatur quaerat incidunt. Similique, officia! Dolorum fugiat et aliquam
                        necessitatibus quas reiciendis, totam voluptatibus deleniti tempore doloribus.</p>
                </div>
            </div>
            <div class="map-iframe my-5">
                <iframe
                    src="https://maps.google.com/maps?q=ernakulam&t=&z=13&ie=UTF8&iwloc=&output=embed"
                    width="100%" height="300" frameborder="0" style="border: 0px; pointer-events: none;"
                    allowfullscreen=""></iframe>
            </div>
            <div class="d-grid contact-view">
                <div class="cont-details">
                    <div class="cont-top">
                        <div class="cont-left text-center">
                            <span class="fa fa-phone text-primary"></span>
                        </div>
                        <div class="cont-right">
                            <h6>Call Us</h6>
                            <p><a href="tel:+44 99 555 42">+123 45 67 89</a></p>
                        </div>
                    </div>
                    <div class="cont-top margin-up">
                        <div class="cont-left text-center">
                            <span class="fa fa-envelope-o text-primary"></span>
                        </div>
                        <div class="cont-right">
                            <h6>Email Us</h6>
                            <p><a href="mailto:example@mail.com" class="mail">example@mail.com</a></p>
                        </div>
                    </div>
                    <div class="cont-top margin-up">
                        <div class="cont-left text-center">
                            <span class="fa fa-map-marker text-primary"></span>
                        </div>
                        <div class="cont-right">
                            <h6>Address</h6>
                            <p>Address here, 208 Trainer Avenue street, Illinois, UK - 62617.</p>
                        </div>
                    </div>
                </div>
                <div class="map-content-9 mt-lg-0 mt-4">
                    <form action="https://sendmail.w3layouts.com/submitForm" method="post">
                        <div class="twice-two">
                            <input type="text" class="form-control" name="w3lName" id="w3lName" placeholder="Name"
                                required="">
                            <input type="email" class="form-control" name="w3lSender" id="w3lSender" placeholder="Email"
                                required="">
                        </div>
                        <div class="twice">
                            <input type="text" class="form-control" name="w3lSubject" id="w3lSubject"
                                placeholder="Subject" required="">
                        </div>
                        <textarea name="w3lMessage" class="form-control" id="w3lMessage" placeholder="Message"
                            required=""></textarea>
                        <button type="submit" class="btn btn-contact">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection