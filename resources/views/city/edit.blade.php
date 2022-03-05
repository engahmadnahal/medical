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
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">{{ __('cms.add_city') }}</h2>
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
    <form action="{{ route('cities.update',$city->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="row row-sm">
            <div class="col-xl-3 col-lg-3 col-md-12 mb-3 mb-md-0">

                <div class="card">
                    <div class="card-header border-bottom pt-3 pb-3 mb-0 font-weight-bold text-uppercase">
                        {{ __('cms.setting') }}</div>
                    <div class="card-body pb-0">


                        <div class="form-group">
                            <label class="form-label">{{ __('cms.activation') }}</label>
                            <input type="checkbox" id="active_pateint" style="display: none" name="active" @if($city->active == 1) checked @endif>
                            <div class="active-pateint main-toggle main-toggle-success @if($city->active == 1) on @endif">
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
                                {{ __('cms.info_city') }}
                            </div>
                            <div class="row row-sm">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('cms.name_city_ar') }} : </label>
                                        <input class="form-control" name="name_ar" type="text" id="name_ar"
                                            placeholder="{{ __('cms.name_city_ar') }} " value="{{ old('name_ar')??$city->name_ar }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row row-sm">
                                 <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('cms.name_city_en') }} : </label>
                                        <input class="form-control" name="name_en" type="text" id="name_en"
                                            placeholder="{{ __('cms.name_city_en') }}" value="{{ old('name_en')??$city->name_en }}">
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
