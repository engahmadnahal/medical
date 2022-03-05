@extends('layouts.master')
@section('css')
    <link href="{{ asset('assets/plugins/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/quill/quill.bubble.css') }}" rel="stylesheet">
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

    </style>
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">{{ __('cms.show_appointment') }}</h2>
            </div>
        </div>
    </div>
    <!-- /breadcrumb -->
@endsection
@section('content')
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
    <!-- Row Content -->
    <form action="{{ route('appointment.store') }}" method="post" readonly>
        @csrf
        <div class="row row-sm">

            <div class="col-xl-3 col-lg-3 col-md-12 mb-3 mb-md-0">
                <div class="card">
                    <div class="card-header border-bottom pt-3 pb-3 mb-0 font-weight-bold text-uppercase">الاعدادات</div>
                    <div class="card-body pb-0">
                        <div class="form-group">
                            <label class="form-label">{{ __('cms.name_doctor') }}</label>
                            <input class="form-control" name="doctor_id" type="text" id="date" readonly
                                placeholder="{{ __('cms.status_patients') }} " value="{{ $appointment->doctor->first_name }} {{ $appointment->doctor->last_name }}" readonly>

                            <label class="form-label">{{ __('cms.name_pateint') }}</label>
                            <input class="form-control" name="pateint_id" type="text" id="date" readonly
                                placeholder="{{ __('cms.status_patients') }} " value="{{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}" readonly>


                            <label class="form-label">{{ __('cms.status_patients') }}</label>
                            <input class="form-control" name="status" type="text" id="date" readonly
                                placeholder="{{ __('cms.status_patients') }} " value="{{ $appointment->status_patient }}"
                                readonly>

                            <label class="form-label">{{ __('cms.status_appointment') }}</label>
                            <input class="form-control" name="urgent" type="text" id="date" readonly
                                placeholder="{{ __('cms.status_appointment') }} "
                                value="{{ $appointment->status_appointment }}" readonly>


                            <div class="form-group">
                                <label class="form-label">{{ __('cms.time') }} : </label>
                                <input class="form-control" name="time" type="text" id="time"
                                    placeholder="{{ __('cms.time') }} " value="{{ $appointment->format_time }}" readonly>
                            </div>

                            <div class="form-group">
                                <label class="form-label">{{ __('cms.date') }} : </label>
                                <input class="form-control" name="date" type="text" id="date"
                                    placeholder="{{ __('cms.date') }} " value="{{ $appointment->format_date }}" readonly>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-12">
                <div class="card">
                    <div class="card-body">

                        <div class="wd-xl-100p ht-350">
                            <div class="ql-scrolling-demo bg-gray-100 ps" id="scrolling-container">
                                <textarea name="report" cols="30" rows="10" class="ql-container ql-bubble rtl"
                                    placeholder="{{ __('cms.report') }}"
                                    style="font-family: inherit; background: transparent; width: 100%; height: 100%; outline: 0;font-size: 19px; "
                                    readonly>{{ $appointment->report }}</textarea>
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
    <script src="{{ asset('assets/plugins/quill/quill.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js') }}"></script>
    <!-- For Upload Inputs -->


    <script src="{{ asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script>
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
    </script>
@endsection
