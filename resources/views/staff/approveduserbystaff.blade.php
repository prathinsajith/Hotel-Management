
@extends('layouts.appstaff')
@section('content')
@if(session()->has('success'))
  <div class="alert alert-success">
    {{ session()->get('success') }}
  </div>
  @endif
  @if(session()->has('warning'))
  <div class="alert alert-danger">
    {{ session()->get('warning') }}
  </div>
  @endif
<div class="card">
  <h3 class="card-header text-center font-weight-bold text-uppercase py-4">View User Booking Details</h3>
  <div class="card-body">
    <div id="table" class="table-editable">
      <table class="table table-bordered table-responsive-md table-striped text-center">
        <thead>
          <tr>
            <th class="text-center">Room No</th>
            <th class="text-center">Cost</th>
            <th class="text-center"> No of Days</th>
            <th class="text-center">Check In Date</th>
            <th class="text-center"> Check Out Date</th>
            <th class="text-center">Check Out </th>   
          </tr>
        </thead>
        <tbody>
          <input type="hidden" value="{{$i=0}}" />
          @foreach($data as $datas)
          <tr>
            <td class="">{{$datas->room_no}}</td>
            <td class="">{{$datas->total_cost}} </td>
            <td class="">{{$datas->no_of_days}} </td>
            <td class="">{{$datas->check_in}} </td>
            <td class="">{{$datas->check_out}} </td>
            <td><span class="table-edit"> <a class="btn btn-primary btn-rounded btn-sm my-0" href="{{route('checkout', ['id'=>$datas->id,'hotel_id'=>$datas->hoteldetail_id])}}">Check Out Approve</a></td></span>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

@section('js_files')
@endsection

@section('js_script')
@endsection

@section('css_files')
@endsection

@section('css_custom')
@endsection