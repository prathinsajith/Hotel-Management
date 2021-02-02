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
            <th class="text-center">User Details</th>
            <th class="text-center">Room No</th>
            <th class="text-center">Cost</th>
            <th class="text-center"> No of Days</th>
            <th class="text-center">Check In Date</th>
            <th class="text-center"> Check Out Date</th>
            <th class="text-center">Approve</th>
            <th class="text-center">Reject</th>
          </tr>
        </thead>
        <tbody>
          @foreach($data as $datas)

          <tr>
            <td class=""> <a href="#" data-toggle="modal" data-target="#exampleModalCenterUser" onclick="userDetails('{{$datas->user_id}}')"> User info</a> </td>
            <td class="">{{$datas->room_no}}</td>
            <td class="">{{$datas->total_cost}} </td>
            <td class="">{{$datas->no_of_days}} </td>
            <td class="">{{$datas->check_in}} </td>
            <td class="">{{$datas->check_out}} </td>
            <td><span class="table-edit"> <a class="btn btn-primary btn-rounded btn-sm my-0" href="{{route('staff.approve',$datas->id)}}">Approve </a></td></span>
            <td><a class="btn btn-danger btn-rounded btn-sm my-0" style="margin-right: 0.5rem;" href="{{route('staff.reject',$datas->id)}}"> Reject </button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- Modal-->
    <div class="modal fade" id="exampleModalCenterUser" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"> User userDetails</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <i aria-hidden="true" class="ki ki-close"></i>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label> User Name</label>
              <input type="text" class="form-control" disabled="disabled" id="userName" />
            </div>
            <div class="form-group">
              <label>Email Address</label>
              <input type="email" class="form-control" disabled="disabled" id="userEmail" />
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js_custom')
<script>
  function userDetails(id) {
    var userId = id;
    $.ajax({
      url: "ajaxGetUserDetails/" + userId,
      type: 'GET',
      data: {},
      success: function(response) {
        $("#userName").val(response.name);
        $("#userEmail").val(response.email);
      }
    });
  };
</script>
@endsection

@section('js_script')
@endsection

@section('css_files')
@endsection

@section('css_custom')
@endsection