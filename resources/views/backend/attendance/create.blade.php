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
                    <h3 class="card-title">Add Employee </h3>

                    <div class="card-tools">
                        <a href="{{ route('admin.attendance.index') }}" class="btn btn-sm btn-success">List</a>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>

                        {{--                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>--}}
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    Attendance

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

            //Date picker
            $('#reservationdate').datetimepicker({
                format: 'L'
            });
            $(document).ready(function(){
                $('#clone_btn').click(function(){
                    $("#c_parent").append($("#contactInfo").clone());
                });
            });

        })

    </script>
@endpush
