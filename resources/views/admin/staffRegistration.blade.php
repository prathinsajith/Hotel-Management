@extends('layouts.applcp')

@section('content')

  @if(session()->has('warning'))
  <div class="alert alert-danger">
    {{ session()->get('warning') }}
  </div>
  @endif

  @if(session()->has('success'))
  <div class="alert alert-success">
    {{ session()->get('success') }}
  </div>
  @endif
  
<div class="card card-custom">
    <div class="card-header">
        <h3 class="card-title">
            Staff Registration
        </h3>
    </div>
    <!--begin::Form-->
    <form method="POST" action="{{ route('admin.staffRegistrationStore') }}">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputPassword1">Staff Name<span class="text-danger">*</span></label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Email address <span class="text-danger">*</span></label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password <span class="text-danger">*</span></label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Confirm Password <span class="text-danger">*</span></label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
            <input type="hidden" class="form-control" value="2" name="is_admin" placeholder="Password" />
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary mr-2">
                {{ __('Register') }}
            </button>
        </div>

    </form>
    <!--end::Form-->
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