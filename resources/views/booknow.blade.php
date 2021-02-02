@extends('layouts.appHotelUser')
@section('content')

<div class="best-rooms py-5">
    <div class="container py-lg-5 py-sm-4">
        <h3 class="title-big text-center">Best Rooms Available</h3>
        <div class="ban-content-inf row py-lg-3">
            @foreach($data as $datas)
            <div class="maghny-gd-1 col-lg-6">
                <div class="maghny-grid">
                    <figure class="effect-lily">
                        <img class="img-fluid" src="{{asset('images/'.$datas->imagepath)}}" alt="" height="373.33">
                        <figcaption class="w3set-hny">
                            <div>
                                <h4 class="top-text">Luxury Hotel and Best Resort
                                    <span>Peaceful Place to stay</span></h4>
                                <p>From &#8377; {{$datas->cost}} /Day </p>
                            </div>
                        </figcaption>
                    </figure>
                    <div class="room-info">
                        <h3 class="room-title"><a href="room-single.html">Hotel</a></h3>
                        <ul class="mb-3">
                            <li><span class="fa fa-users"></span> {{$datas->guest_no}} Guest</li>
                            <li><span class="fa fa-bed"></span> {{$datas->category}} Bed</li>
                            <li><span class="fa fa-bed"></span> {{$datas->room_size}}sqft</li>
                        </ul>
                        <a href="{{route('booked',$datas->id)}}" class="btn btn-style btn-primary mt-sm-4 mt-3">Book Now</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<script>

</script>
@endsection