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
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">{{ __('cms.add_role') }}</h2>
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
    {{-- action="{{ route('roles.store') }}" method="post" --}}
    <form id="form">
        @csrf
        <div class="row row-sm">
            <div class="col-xl-3 col-lg-3 col-md-12 mb-3 mb-md-0">

                <div class="card">
                    <div class="card-header border-bottom pt-3 pb-3 mb-0 font-weight-bold text-uppercase">
                        {{ __('cms.setting') }}</div>
                    <div class="card-body pb-0">

                        <div class="form-group">
                            <label class="form-label">{{ __('cms.name_guard') }}</label>
                            <select name="guard_name" id="guard_name" class="form-control nice-select custom-select"
                                style="display: none;">
                                <option value="0">{{ __('cms.select') }}</option>
                                <option value="admin" @if (old('guard_name') == 'admin') selected @endif>admin</option>
                                <option value="user" @if (old('guard_name') == 'user') selected @endif>user</option>
                            </select>

                        </div>


                    </div>

                    <div class="py-2 px-3">
                        <button class="btn btn-primary-gradient mt-2 mb-2 pb-2" type="button" onclick="performStore()"
                            id="add">{{ __('cms.save') }}</button>
                    </div>
                </div>


            </div>

            <div class="col-xl-9 col-lg-9 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-body">
                            <div class="main-content-label mg-b-5">
                                {{ __('cms.info_role') }}
                            </div>
                            <div class="row row-sm">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('cms.name_role') }} : </label>
                                        <input class="form-control" name="name" type="text" id="name"
                                            placeholder="{{ __('cms.name_role') }} " value="{{ old('name') }}">
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


    <script>
        function performStore() {

            let name = document.getElementById("name").value;
            let guard_name = document.getElementById("guard_name").value;
            axios.post('/roles', {
                name: name,
                guard_name: guard_name
            }).then(function(response) {
                notif({
                    msg: "<b>Success:</b> " + response.data.msg,
                    type: "success"
                });
                document.getElementById('form').reset();
            }).catch(function(error) {
                console.log(error.response.data.msg);
                notif({
                    msg: "<b>Oops! </b>" + error.response.data.msg,
                    type: "error",
                    position: "center"
                });
            });
        }
        //-----

        (function($) {
            "use strict";

            // ______________Nice Select
            $('select.nice-select').niceSelect();
        })(jQuery);
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
