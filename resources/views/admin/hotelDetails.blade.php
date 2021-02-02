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
  <h3 class="card-header text-center font-weight-bold text-uppercase py-4">View Book Table</h3>
  <div class="card-body">
    <div id="table" class="table-editable">
      <span class="table-add float-right mb-3 mr-2"><a href="{{route('hotelDetails.create')}}" class="text-success"><i class="fas fa-plus fa-2x" aria-hidden="true"></i></a></span>
      <table class="table table-bordered table-responsive-md table-striped text-center">
        <thead>
          <tr>
            <th class="text-center">Room No</th>
            <th class="text-center">Cost</th>
            <th class="text-center">Category</th>
            <th class="text-center">Guest No</th>
            <th class="text-center">Room Size</th>
            <th class="text-center">Image</th>
            <th class="text-center">Edit</th>
            <th class="text-center">Remove</th>
          </tr>
        </thead>
        <tbody>
          <input type="hidden" value="{{$i=0}}" />
          @foreach($data as $datas)
          <tr>
            <td class="">{{$datas->room_no}} </td>
            <td class="">{{$datas->cost}}</td>
            <td class="">{{$datas->category}}</td>
            <td class="">{{$datas->guest_no}}</td>
            <td class="">{{$datas->room_size}}</td>
            <td class="">

              <img src="{{asset('images/'.$datas->imagepath)}}" style=" height: 75px;width: 100px;margin-top: 0.5rem; margin-bottom: 0.2rem;" />
            </td>
            <td><span class="table-edit"> <a class="btn btn-primary btn-rounded btn-sm my-0" href="{{route('hotelDetails.edit',$datas->id)}}">UPDATE </a></td></span>
            <td>
              <form action="{{route('hotelDetails.destroy',$datas->id)}}" method="POST">
                {{ method_field('DELETE') }}
                @csrf
                <button type="submit" class="btn btn-danger btn-rounded btn-sm my-0" style="margin-right: 0.5rem;" href="{{route('hotelDetails.destroy',$datas->id)}}"> DELETE </button>
            </td>
            </form>
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