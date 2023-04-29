@extends('customers.layouts.app')
@section('content')
@section('title')
    FAQ
@endsection
<style type="text/css">
    #map {
        height: 450px;
        width: 1100px;
    }
</style>
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="#">Home</a></li>
                <li class='active'>Contact</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="contact-page">
            <div class="row">

                <div class="col-md-12 contact-map outer-bottom-vs">
                    {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3886.0080692193424!2d80.29172299999996!3d13.098675000000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a526f446a1c3187%3A0x298011b0b0d14d47!2sTransvelo!5e0!3m2!1sen!2sin!4v1412844527190" width="600" height="450"  style="border:0"></iframe> --}}
                    <div id="map">

                    </div>
                </div>
                <div class="col-md-9 contact-form">
                    <div class="col-md-12 contact-title">
                        <h4>Contact Form</h4>
                    </div>
                     <form class="register-form" role="form" method="POST" action="{{ route('send.message') }}">
                            @csrf
                    <div class="col-md-4 ">

                            <div class="form-group">
                                 <label class="info-title" for="inputPhone">Name<span>*</span></label>
                                <input type="text" class="form-control unicase-form-control text-input"
                                    id="inputName" name="name" placeholder="">
                            </div>

                    </div>
                    <div class="col-md-4">

                        <div class="form-group">
                            <label class="info-title" for="inputEmail">Email Address <span>*</span></label>
                            <input type="email" class="form-control unicase-form-control text-input" id="inputEmail"
                                name="email" placeholder="">
                        </div>

                    </div>
                    <div class="col-md-4">

                            <div class="form-group">
                                <label class="info-title" for="inputPhone">Phone</label>
                                <input type="text" class="form-control unicase-form-control text-input"
                                    id="inputPhone" name="phone" placeholder="">
                            </div>

                    </div>
                    <div class="col-md-12">

                            <div class="form-group">
                                <label class="info-title" for="exampleInputComments">Your Comments
                                    <span>*</span></label>
                                <textarea class="form-control unicase-form-control" id="exampleInputComments" name="message"></textarea>
                            </div>

                    </div>
                    <div class="col-md-12 outer-bottom-small m-t-20">
                        <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Send
                            Message</button>
                    </div>
                </div>
                </form>
                <div class="col-md-3 contact-info">
                    <div class="contact-title">
                        <h4>Information</h4>
                    </div>
                    <div class="clearfix address">
                        <span class="contact-i"><i class="fa fa-map-marker"></i></span>
                        <span class="contact-span">Čaka iela 24, Rīga</span>
                    </div>
                    <div class="clearfix phone-no">
                        <span class="contact-i"><i class="fa fa-mobile"></i></span>
                        <span class="contact-span">+(371) 110<br>+(371) 112</span>
                    </div>
                    <div class="clearfix email">
                        <span class="contact-i"><i class="fa fa-envelope"></i></span>
                        <span class="contact-span"><a href="#">honneyboney@arguss.lv</a></span>
                    </div>
                </div>
            </div><!-- /.contact-page -->
        </div><!-- /.row -->
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script type="text/javascript">
    function initMap() {

        const myLatLng = {
            lat: 56.95140404521235,
            lng: 24.12756617221934
        };
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 15,
            center: myLatLng,
        });

        new google.maps.Marker({
            position: myLatLng,
            map,
            title: "Hello Rajkot!",
        });
    }

    window.initMap = initMap;
</script>

<script type="text/javascript"
    src="https://maps.google.com/maps/api/js?key={{ config('app.GOOGLE_MAP_KEY') }}&region=LV&language=lv&callback=initMap">
</script>
@endsection
