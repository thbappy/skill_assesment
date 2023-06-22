@extends('backend.layout.master')

@section('title', $title)
@section('page_name', $page_name)
@section('page_title', $page_title)

@section('content')

    <div class="card card-default card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">Update Profile Information</h3>

            <div class="card-tools">
                <a href="{{ route('admin.profile') }}" class="btn btn-sm btn-success">View Profile</a>
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>

                {{--                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>--}}
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form method="POST" action="{{ route('admin.profile.update',Auth::user()->id) }}" role="form" enctype="multipart/form-data">
                @csrf

                @if ($message = Session::get('success'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                @if ($message = Session::get('failed'))
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-6">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">First Name:</label>
                                <input type="text" name ="first_name" class="form-control" value="{{ $user->first_name }}" placeholder="Enter Your First Name">
                                <small class="text-danger">{{ $errors->first('first_name') }}</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email </label>
                                <input type="text" name ="email" class="form-control" value="{{ $user->email }}" placeholder="Enter your email">
                                <small class="text-danger">{{ $errors->first('email') }}</small>
                            </div>

{{--                            <div class="form-group">--}}
{{--                                <label for="exampleInputEmail1">Designation </label>--}}
{{--                                <input type="text" name ="designation" class="form-control" value="{{ $user->designation }}" placeholder="Enter Your Designation ">--}}
{{--                                <small class="text-danger">{{ $errors->first('designation') }}</small>--}}
{{--                            </div>--}}

                            <div class="form-group">
                                <label for="exampleInputFile">Profile Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="img" class="custom-file-input" id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="">Upload</span>
                                    </div>
                                </div>

                                <small class="text-danger">{{ $errors->first('img') }}</small>

                                <img src="{{asset("")}}{{ $user->photo }}" width="100" height="100"
                                     style =" border-radius: 10% " border="0" title="Employee Image" class="img-employee"/>
                            </div>

                        </div>
                        <!-- /.card-body -->

                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Last Name:</label>
                                        <input type="text" name ="last_name" class="form-control" value="{{ $user->last_name }}" placeholder="Enter Your Last Name">
                                        <small class="text-danger">{{ $errors->first('last_name') }}</small>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Phone </label>
                                <input type="text" name ="phone" class="form-control" value="{{ $user->phone }}" placeholder="Enter Your Phone">
                                <small class="text-danger">{{ $errors->first('phone') }}</small>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Address </label>
                                <textarea type="text" rows="4" name ="address" class="form-control" placeholder="Enter Your Address ">{{ $user->address }}</textarea>
                                <small class="text-danger">{{ $errors->first('address') }}</small>
                            </div>
{{--                            <div class="form-group">--}}
{{--                                <label for="exampleInputEmail1"> Permanent Address </label>--}}
{{--                                <textarea type="text" rows="4" name ="permanent_address" class="form-control" placeholder="Enter Your Permanent Address ">{{ $user->permanent_address }}</textarea>--}}
{{--                                <small class="text-danger">{{ $errors->first('permanent_address') }}</small>--}}
{{--                            </div>--}}
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>

                    </div>
                    <!-- /.col -->

                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>

@endsection
