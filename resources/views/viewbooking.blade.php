@extends('layouts.appHotelUser')
@section('content')

<!-- Editable table -->
<div class="card">
  <h3 class="card-header text-center font-weight-bold text-uppercase py-4">View Book Table</h3>
  <div class="card-body">
    <div id="table" class="table-editable">
      <span class="table-add float-right mb-3 mr-2"><a href="#!" class="text-success"><i
            class="fas fa-plus fa-2x" aria-hidden="true"></i></a></span>
      <table class="table table-bordered table-responsive-md table-striped text-center">
        <thead>
          <tr>
            <th class="text-center">Person Name</th>
            <th class="text-center">Rooms No</th>
            <th class="text-center">Price</th>
            <th class="text-center">No Of Days</th>
            <th class="text-center">Status</th>
            <th class="text-center">Cancel Booking</th>
          </tr>
        </thead>
        <tbody>
        @foreach($data as $datas)
          <tr>
            <td class="pt-3-half" contenteditable="true">{{ Auth::user()->name }}</td>
            <td class="pt-3-half" contenteditable="true">{{$datas->room_no}}</td>
            <td class="pt-3-half" contenteditable="true">{{$datas->total_cost}}</td>
            <td class="pt-3-half" contenteditable="true">{{$datas->no_of_days}}</td>
            @if($datas->status == 0)
              <td class="pt-3-half" contenteditable="true"><h4><span class="badge badge-info">Pending</span></h4></td>
            @elseif ($datas->status == 1)
            <td class="pt-3-half" contenteditable="true"><h4><span class="badge badge-success">Approve</span></h4></td>
            @else($datas->status == 2)
            <td class="pt-3-half" contenteditable="true"><h4><span class="badge badge-danger">Reject</span></h4></td>
            @endif
            <td>
              <form action="{{route('cancelBooking', ['id'=>$datas->id,'roomno'=>$datas->room_no])}}" method="POST">
              @csrf
              <button type="SUBMIT" class="btn btn-danger btn-rounded btn-sm my-0" >Cancel</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- Editable table -->
@endsection