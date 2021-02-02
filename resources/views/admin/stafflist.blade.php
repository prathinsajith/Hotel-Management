@extends('layouts.applcp')

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
            <th class="text-center">Staff Name</th>
            <th class="text-center">Email</th>
            <th class="text-center">Remove Staff</th>

          </tr>
        </thead>
        <tbody>
          <input type="hidden" value="{{$i=0}}" />
          @foreach($data as $datas)
          <tr>
            <td class="">{{$datas->name}}</td>
            <td class="">{{$datas->email}} </td>
            <td>
              <form action="{{route('admin.staffDestroy',$datas->id)}}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger btn-rounded btn-sm my-0" style="margin-right: 0.5rem;" href="{{route('admin.staffDestroy',$datas->id)}}"> Remove Staff </button>
            </td>
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