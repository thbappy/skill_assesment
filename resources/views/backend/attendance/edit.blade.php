@extends('backend.layout.master')

@section('title', $title)
@section('page_name', $page_name)
@section('page_title', $page_title)

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Update User </h3>

                    <div class="card-tools">
                        <a href="{{ route('admin.user.index') }}" class="btn btn-sm btn-success">List</a>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>

                        {{--                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>--}}
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST" action="{{ route('admin.user.update',$data->id) }}" role="form" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
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
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Name</label>
                                                    <input type="text" name ="name" class="form-control" value="{{ $data->name }}" placeholder="Enter User Name">
                                                    <small class="text-danger">{{ $errors->first('name') }}</small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Email</label>
                                                    <input type="text" name ="email" class="form-control" value="{{ $data->email }}" placeholder="Enter valid email address">
                                                    <small class="text-danger">{{ $errors->first('email') }}</small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Role</label>
                                                    <select name="role" class="form-control">
                                                        <option value="">--- Select Role ---</option>
                                                        @foreach($roles as $key=> $role)
                                                            <option {{ (count($data->roles) && $data->roles[0]->id == $role->id) ? 'selected' : '' }} value="{{ $role->id }}">{{ $role->name }}</option>
                                                        @endforeach

                                                    </select>
                                                    <small class="text-danger">{{ $errors->first('role') }}</small>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">Image</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input accept="image/*" type="file" name="image" class="custom-file-input" id="exampleInputFile">
                                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                        </div>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Upload</span>
                                                        </div>
                                                    </div>
                                                    @if($data->image)
                                                        <img style="width: 100px; height: 50px" src="{{ asset($data->image) }}" alt="{{ $data->image }}">
                                                    @endif
                                                    <small class="text-danger">{{ $errors->first('image') }}</small>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select name="status" class="form-control">
                                                        <option value="1" {{ $data->status == 1 ? "selected" : "" }}>Active</option>
                                                        <option value="0" {{ $data->status == 0 ? "selected" : "" }}>Deactive</option>
                                                    </select>
                                                    <small class="text-danger">{{ $errors->first('status') }}</small>
                                                </div>
                                            </div>
                                        </div>

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.col -->
                    </div>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection

@push('header_style')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('backend/assets')}}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{asset('backend/assets')}}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('backend/assets')}}/plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="{{asset('backend/assets')}}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">


    @push('footer_script')
        <!-- Select2 -->
        <script src="{{asset('backend/assets')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="{{asset('backend/assets')}}/plugins/select2/js/select2.full.min.js"></script>
        <script src="{{asset('backend/assets')}}/plugins/summernote/summernote-bs4.min.js"></script>
        <script src="{{asset('backend/assets')}}/plugins/moment/moment.min.js"></script>
        <script src="{{asset('backend/assets')}}/plugins/inputmask/jquery.inputmask.min.js"></script>
        <!-- date-range-picker -->
        <script src="{{asset('backend/assets')}}/plugins/daterangepicker/daterangepicker.js"></script>

        <script src="{{asset('backend/assets')}}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
        <script>
            $(function () {
                //Initialize Select2 Elements
                $('.select2').select2()

                //Initialize Select2 Elements
                $('.select2bs4').select2({
                    theme: 'bootstrap4'
                })

                $('#summernote').summernote({
                    height: 100
                })

                //Date picker
                $('#reservationdate').datetimepicker({
                    format: 'L'
                });


            })

        </script>
    @endpush
