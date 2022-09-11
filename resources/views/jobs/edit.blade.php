@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Job') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('edit-job') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $jobs->name}}" required autocomplete="name" autofocus>
                                <input type="hidden" name="id" value="{{$jobs->id}}">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $jobs->email}}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="emirates" class="col-md-4 col-form-label text-md-end">{{ __('Emirates') }}</label>

                            <div class="col-md-6">
                            <select name="emirates" class="form-control" id="emirates">
                                <option value="">SELECT EMIRATES</option>
                                @foreach($emirates as $val)
                                <option value="{{$val->id}}" @if($jobs->emirates==$val->id) selected="selected" @endif>{{$val->title}}</option>

                                @endforeach
                            </select>
                                @error('emirates')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
 
                        <div class="row mb-3">
                            <label for="location" class="col-md-4 col-form-label text-md-end">{{ __('Location') }}</label>

                            <div class="col-md-6">
                                <input id="location" type="text" class="form-control @error('location') is-invalid @enderror" name="location" value="{{ $jobs->location }}"  autocomplete="location" autofocus>

                                @error('location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        
 
                        <div class="row mb-3">
                            <label for="company" class="col-md-4 col-form-label text-md-end">{{ __('company') }}</label>

                            <div class="col-md-6">
                                <input id="company" type="text" class="form-control @error('company') is-invalid @enderror" name="company" value="{{  $jobs->company_name  }}"  autocomplete="company" autofocus>

                                @error('company')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="job_type" class="col-md-4 col-form-label text-md-end">{{ __('Job Type') }}</label>

                            <div class="col-md-6">
                            <select name="job_type" class="form-control" id="job_type">
                                <option value="">SELECT Job Type</option>
                                @foreach($jobtype as $val)
                                <option value="{{$val->id}}" @if($jobs->job_type==$val->id) selected="selected" @endif>{{$val->title}}</option>

                                @endforeach
                            </select>
                                @error('emirates')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                     <div class="row mb-3">
                            <label for="till_date" class="col-md-4 col-form-label text-md-end">{{ __('Till Date') }}</label>

                            <div class="col-md-6">
                                <input id="till_date" type="text" class="form-control @error('till_date') is-invalid @enderror" name="till_date" value="{{ date('m/d/Y',strtotime($jobs->till_date)) }}" >
                                @error('till_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('description') }}</label>

                            <div class="col-md-6">
                            <textarea id="description" name="description" rows="5" cols="5"class="form-control">{{ $jobs->description }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Image') }}</label>

                            <div class="col-md-6">
                            <img src="{{asset('/storage/job-images/'.$jobs->image)}}" data-placeholder="Image" width="100"/>
                                 <input type="file" class="upload-file" data-height="1921" data-width="186" accept="image/jfif, image/jpeg, image/png, image/jpg"
                                                                                name="image"/>
                                            <p> * <b>Image format</b> - <i class="text-light-blue">allowed image format
                                                    .jpeg,.png,.jpg,.jfif</i></p>
                                            {!! $errors->first('image', '<p class="help-block" style="color: red;">:message</p>') !!}
                                            {{-- <p> * <b>Image Size</b> - <i class="text-light-blue">allowed image size
                                                    [500*500] pixel</i></p> --}}
                                        </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                                <a href="{{route('create')}}" type="button " class="btn btn-danger">
                                    {{ __('Back') }}
                                    </a>

                             
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
  $( function() {
    $( "#till_date" ).datepicker();
  } );
  </script>
@endsection

