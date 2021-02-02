@extends('layouts.applcp')

@section('content')
<div class="card card-custom">
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="card-header">
        <h3 class="card-title">
            Input Sizing
        </h3>
    </div>
    <!--begin::Form-->
    <form class="form" method="POST" action="{{route('hotelDetails.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label>Room No </label>
                <input type="text" class="form-control form-control-lg" placeholder="Room No" name="room_no" />
            </div>
            <div class="form-group">
                <label for="exampleSelectl">Category</label>
                <select class="form-control form-control-lg" id="category" name="category">
                    <option value="Single">Single</option>
                    <option value="Double">Double</option>
                    <option value="King">King</option>
                </select>
            </div>
            <div class="form-group">
                <label>Cost </label>
                <input type="number" class="form-control form-control-lg" placeholder="Cost" name="cost" />
            </div>

            <div class="form-group">
                <label>No of Guest </label>
                <input type="number" class="form-control form-control-lg" placeholder="No Of Guest" name="guest_no" />
            </div>

            <div class="form-group">
                <label>Room Size </label>
                <input type="number" class="form-control form-control-lg" placeholder="Room Size in Sqft" name="room_size" />
            </div>

            <div class="form-group">
                <label>Photo</label>
                <input type="file" class="form-control form-control-lg" placeholder="Photo" name="imagepath" />
            </div>

            <div class="card-footer">
                <button type="Submit" class="btn btn-success mr-2">Submit</button>
                <button type="reset" class="btn btn-secondary">Cancel</button>
            </div>
    </form>
    <!--end::Form-->
</div>
@endsection