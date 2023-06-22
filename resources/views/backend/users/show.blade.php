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
                    <h3 class="card-title">View Employee </h3>

                    <div class="card-tools">
                        <a href="{{ route('employee.index') }}" class="btn btn-sm btn-success">List</a>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>

                        {{--                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>--}}
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST" action="{{ route('employee.store') }}" role="form" enctype="multipart/form-data">
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
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">First Name</label>
                                                <input type="text" readonly name ="first_name" class="form-control" value="{{ $data->first_name }}" placeholder="Enter Name">
                                                <small class="text-danger">{{ $errors->first('first_name') }}</small>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Full Name</label>
                                                <input type="text" readonly name ="full_name" class="form-control" value="{{ $data->full_name }}" placeholder="Enter valid email address">
                                                <small class="text-danger">{{ $errors->first('full_name') }}</small>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email</label>
                                                <input type="text" readonly name ="email" class="form-control" value="{{ $data->email }}" placeholder="Enter valid email address">
                                                <small class="text-danger">{{ $errors->first('email') }}</small>
                                            </div>
                                        </div>

                                    </div>
                                        @if(count($contacts))
                                    <section id="c_parent">
                                        @foreach($contacts as $key=> $con)
                                        <div class="row" id="contactInfo">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Contact Name</label>
                                                    <input type="text" required name ="contact_name[]" value="{{ $con->contact_name }}" class="form-control" placeholder="Enter contact_name">
                                                    <small class="text-danger">{{ $errors->first('contact_name') }}</small>
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Contact Email</label>
                                                    <input type="email" required name ="contact_email[]" value="{{ $con->contact_email }}" class="form-control" placeholder="Enter contact_email">
                                                    <small class="text-danger">{{ $errors->first('contact_email') }}</small>
                                                </div>
                                            </div>

                                        </div>
                                        @endforeach
                                    </section>
                                        @endif

                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Address</label>
                                                <input type="text" readonly name ="address" class="form-control" value="{{ $address->address }}" placeholder="Enter address">
                                                <small class="text-danger">{{ $errors->first('address') }}</small>
                                            </div>
                                        </div>

                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select readonly="" name="status" class="form-control">
                                                    <option value="1">Active</option>
                                                    <option value="0">Deactive</option>
                                                </select>
                                                <small class="text-danger">{{ $errors->first('status') }}</small>
                                            </div>
                                        </div>
                                        @if($address->photo)
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <img style="width: 100px; height: 100px" src="{{ asset($address->photo) }}" alt="">
                                                </div>
                                            </div>
                                        @endif

                                    </div>

                                </div>

{{--                                <div class="card-footer text-right">--}}
{{--                                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>--}}
{{--                                </div>--}}
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
