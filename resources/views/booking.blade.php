@extends('layouts.appHotelUser')
@section('content')
<div class="w3l-availability-form-main py-5">
    <div class="container pt-lg-3 pb-lg-5">
        <div class="forms-top">
            <div class="form-right">
                <div class="form-inner-cont">
                    <h3 class="title-small">Check Availability</h3>
                    <form method="POST" action="{{route('ajaxPostBookDetails')}}" class="signin-form">
                        @csrf
                        <div class="row book-form">
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id}}" />
                            <input type="hidden" name="hoteldetail_id" value="{{$data->id}}" />
                            <input type="hidden" name="no_of_days" id="days" value="" />
                            <div class="form-input col-md-6 col-sm-6 mt-3">
                                <label>Room Number </label>
                                <input type="hidden" name="room_no" id="room_no" value="{{$data->room_no}}"/>
                                <input type="text" value="{{$data->room_no}}" disabled />
                            </div>
                            <div class="form-input col-md-6 col-sm-6 mt-3">
                                <label>Category</label>
                                <input type="text" name="category" id="category" value="{{$data->category}}" disabled />
                            </div>

                            <div class="form-input col-md-6 col-sm-6 mt-3">
                                <label>Check-in Date</label>
                                <input type="date" name="check_in" min="2020-12-10" id="Check-in" placeholder="Date" required="">
                            </div>
                            <div class="form-input col-md-6 col-sm-6 mt-3">
                                <label>Check-out Date</label>
                                <input type="date" name="check_out" min="2020-12-10" id="Check-out" onchange="costCalculator()" placeholder="Date" required="">
                            </div>
                            <div class="form-input col-md-6 col-sm-6 mt-3">
                                <label>Cost Of Room Per day </label>
                                <input type="text" name="cost" id="cost" value="{{$data->cost}}" disabled />
                            </div>
                            <div class="form-input col-md-6 col-sm-6 mt-3">
                                <label>Price </label>
                                <input type="text" name="total_cost" id="price" placeholder="Max Price &#8377;" value="" />
                            </div>
                            <div class="bottom-btn col-md-4 col-sm-6 mt-3">
                                <button type="submit" class="btn btn-style btn-primary w-100 px-2" id="save">Submit</button>
                            </div>
                            <div class="bottom-btn col-md-4 col-sm-6 mt-3">
                                <a href="{{url('booknow')}}" class="btn btn-style btn-secondary w-100 px-2" id="cancel">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>

    $(function() {
        var dtToday = new Date();
        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if (month < 10)
            month = '0' + month.toString();
        if (day < 10)
            day = '0' + day.toString();

        var minDate = year + '-' + month + '-' + day;

        $('#Check-in').attr('min', minDate);
        $('#Check-out').attr('min', minDate);

    });

 

    function costCalculator() 
    {
        var date1 = $('#Check-in').val();
        var date2 = $('#Check-out').val();
        var cost = $('#cost').val();
        var userId = $('#userId').val();


       if (date2 <= date1) {
           alert("Invalid Entry")
           $('#Check-in').val("");
           $('#Check-out').val("");

       }
       else
       {
        //calculate time difference  
        var time_difference = new Date(date2).getTime() - new Date(date1).getTime()
        //calculate days difference by dividing total milliseconds in a day  
        var days_difference = time_difference / (1000 * 60 * 60 * 24);
        var totalPrice = days_difference * cost;
        $('#price').val(totalPrice);
        $('#days').val(days_difference);
       }
    }
</script>
@endsection