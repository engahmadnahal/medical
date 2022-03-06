@extends('layouts.master')
@section('css')
    <link href="{{ asset('assets/plugins/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <style>
        .ql-tooltip {
            display: none;
        }

        span.select2 {
            width: 100% !important;
        }

        .input-group {

            width: 100% !important;
            padding: 0;
        }

    </style>
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">{{ __('cms.add_pateint') }}</h2>
            </div>
        </div>


    </div>
    @if ($errors->any() || session()->has('error'))
        <div class="row row-sm">
            <div class="col-12">
                <div class="alert alert-outline-danger mg-b-0" role="alert">
                    <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                        <span aria-hidden="true">×</span></button>
                    <ul>
                        @if (session()->has('error'))
                            <li>{{ session('error') }}</li>
                        @endif
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <br>
            </div>
        </div>
    @endif
    <!-- /breadcrumb -->
@endsection

@section('content')
    <!-- Row Content -->
    {{-- action="{{ route('doctors.store') }}" method="post" --}}
    <form action="{{ route('patients.store') }}" method="post">
        @csrf
        <div class="row row-sm">
            <div class="col-xl-3 col-lg-3 col-md-12 mb-3 mb-md-0">

                <div class="card">
                    <div class="card-header border-bottom pt-3 pb-3 mb-0 font-weight-bold text-uppercase">
                        {{ __('cms.setting') }}</div>
                    <div class="card-body pb-0">
                        <div class="form-group">
                            <label class="form-label">{{ __('cms.city') }}</label>
                            <select name="city" id="city" class="form-control select2 select2-hidden-accessible"
                                data-select2-id="1" tabindex="-1" aria-hidden="true">
                                <option>{{ __('cms.select') }}</option>
                                @foreach ($cities as $citie)
                                    <option value="{{ $citie->id }}" @if ($citie->id == old('city')) selected @endif>
                                        {{ $citie->name_ar }}</option>
                                @endforeach
                            </select>




                        </div>

                        <div class="form-group">
                            <input type="checkbox" id="active_pateint" style="display: none" name="active">
                            <div class="active-pateint main-toggle main-toggle-success">
                                <span></span>
                            </div>
                        </div>

                    </div>

                    <div class="py-2 px-3">
                        <button class="btn btn-primary-gradient mt-2 mb-2 pb-2" type="submit"
                            id="add">{{ __('cms.save') }}</button>
                    </div>
                </div>


            </div>

            <div class="col-xl-9 col-lg-9 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-body">
                            <div class="main-content-label mg-b-5">
                                {{ __('cms.info_pateint') }}
                            </div>
                            <div class="row row-sm">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('cms.fname') }} : </label>
                                        <input class="form-control" name="fname" type="text" id="fname"
                                            placeholder="{{ __('cms.fname') }} " value="{{ old('fname') }}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('cms.lname') }} : </label>
                                        <input class="form-control" name="lname" type="text" id="lname"
                                            placeholder="{{ __('cms.lname') }}" value="{{ old('lname') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row row-sm">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('cms.email') }} : </label>
                                        <input class="form-control" name="email" type="text" id="email"
                                            placeholder="{{ __('cms.email') }}" value="{{ old('email') }}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('cms.mobile') }} : </label>
                                        <input class="form-control" name="mobile" type="text" id="mobile"
                                            placeholder="{{ __('cms.mobile') }} " value="{{ old('mobile') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row row-sm">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('cms.date_birth') }} : </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    Date:
                                                </div>
                                            </div>
                                            <input class="form-control" name="date_birth" id="dateMask"
                                                placeholder="YYYY-MM-DD" value="{{ old('date_birth') }}" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row row-sm">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('cms.ensur_num') }} : </label>
                                        <input class="form-control" name="ensurance_num" type="text" id="ensurance_num"
                                            placeholder="{{ __('cms.ensur_num') }} "
                                            value="{{ old('ensurance_num') }}">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('cms.national_number') }} : </label>
                                        <input class="form-control" name="national_num" type="text" id="national_num"
                                            placeholder="{{ __('cms.national_number') }} "
                                            value="{{ old('national_num') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('cms.password') }} : </label>
                                        <input class="form-control" name="password" type="text" id="password"
                                            placeholder="{{ __('cms.password') }} "
                                            value="{{ old('password') }}">
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>


                </div>
            </div>

        </div>
    </form>
    </div>
    <!-- Container closed -->
@endsection
@section('js')
    <script src="{{ asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js') }}"></script>
    <script src="{{ asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>

    <script src="{{ asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    {{-- <script src="{{ asset('js/main.js') }}"></script> --}}

    <script>
        (function($) {
            "use strict";

            // ______________Nice Select
            $('select.nice-select').niceSelect();
        })(jQuery);

        $('.cv').dropify({
            messages: {
                'default': '{{ __('cms.upload_cv') }}',
                'replace': '{{ __('cms.upload_cv') }}',
                'remove': '{{ __('cms.delete') }}',
                'error': '{{ __('cms.oops') }}'
            },
            error: {
                'fileSize': '{{ __('cms.size_error') }}.'
            }
        });

        $('.avater').dropify({
            messages: {
                'default': '{{ __('cms.upload_cv') }}',
                'replace': '{{ __('cms.upload_cv') }}',
                'remove': '{{ __('cms.delete') }}',
                'error': '{{ __('cms.oops') }}'
            },
            error: {
                'fileSize': '{{ __('cms.size_error') }}.'
            }
        });

        // Update avater user
        $("#avater").click(function() {

            $(".dropify-wrapper,.saveImg").show();

        });

        $(document).ready(function() {
            $('.select2').select2({
                placeholder: 'Choose one',
                searchInputPlaceholder: 'Search'
            });
            $('.select2-no-search').select2({
                minimumResultsForSearch: Infinity,
                placeholder: 'Choose one'
            });
        });



        //____________________________________
        $('#dateMask').mask('9999-99-99');

        $('.active-pateint').on('click', function() {
            $(this).toggleClass('on');
            let attr = $("#active_pateint").attr('checked');

            if (attr == undefined) {
                console.log(true);
                $("#active_pateint").attr('checked', 'checked');
            } else {

                $("#active_pateint").removeAttr('checked');
                console.log(false);


            }
        })
    </script>
@endsection
