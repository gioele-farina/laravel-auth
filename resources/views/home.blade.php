@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>

                <div class="card-header upload-image">Upload you profile image</div>
                <div class="card-body">
                  <form action="{{route('upload-icon')}}" method="POST" enctype="multipart/form-data">
                      @csrf
                      @method('POST')
                      <input name="upload-icon" type="file">
                      <br><br>
                      <input type="submit" value="Upload file">
                  </form>
                  <a href="{{route('delete-icon')}}" class="btn btn-danger">Delete avatar</a>
                </div>

                @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
                @endif

                @if (Auth::user() -> profile_icon)
                  <div class="card-header">Your avatar</div>
                  <div class="card-body">
                    <img class="profile-image-big" src="{{asset('storage/icons/' . Auth::user() -> profile_icon )}}" alt="">
                  </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection
