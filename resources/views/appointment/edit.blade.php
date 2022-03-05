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
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">{{ __('cms.add_appointment') }}</h2>
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
    <form action="{{ route('appointment.store') }}" method="post">
        @csrf
        <div class="row row-sm">

            <div class="col-xl-3 col-lg-3 col-md-12 mb-3 mb-md-0">
                <div class="card">
                    <div class="card-header border-bottom pt-3 pb-3 mb-0 font-weight-bold text-uppercase">الاعدادات</div>
                    <div class="card-body pb-0">
                        <div class="form-group">
                            <label class="form-label">{{ __('cms.name_doctor') }}</label>
                            <select name="doctor_id" id="doctors" class="form-control select2 select2-hidden-accessible"
                                style="display: none;">
                                <option>{{ __('cms.select') }}</option>
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}" @if(old('doctor_id') == $doctor->id || $doctor->id == $appointment->doctor->id) selected @endif >{{ $doctor->first_name }}
                                        {{ $doctor->last_name }}
                                    </option>
                                @endforeach
                            </select>
                            <label class="form-label">{{ __('cms.name_pateint') }}</label>
                            <select name="pateint_id" id="pateint" class="form-control select2 select2-hidden-accessible"
                                style="display: none;">
                                <option>{{ __('cms.select') }}</option>
                                @foreach ($patients as $patient)
                                    <option value="{{ $patient->id }}" @if(old('pateint_id') == $patient->id || $appointment->patient->id == $patient->id) selected @endif>{{ $patient->first_name }}
                                        {{ $patient->last_name }}</option>
                                @endforeach
                            </select>
                            <label class="form-label">{{ __('cms.status_patients') }}</label>
                            <select name="status" id="status_patients"
                                class="form-control select2 select2-hidden-accessible" style="display: none;">
                                <option>{{ __('cms.select') }}</option>
                                <option value="1" @if(old('status') == 1 || $appointment->status == 1) selected @endif>خطير</option>
                                <option value="2" @if(old('status') == 2 || $appointment->status == 2) selected @endif>متوسط</option>
                                <option value="3" @if(old('status') == 3 || $appointment->status == 3) selected @endif>عادي</option>
                            </select>
                            <label class="form-label">{{ __('cms.status_appointment') }}</label>
                            <select name="urgent" id="status_appointment"
                                class="form-control select2 select2-hidden-accessible" style="display: none;">
                                <option>{{ __('cms.select') }}</option>
                                <option value="1" @if(old('urgent') == 1 || $appointment->urgent == 1) selected @endif>خطير</option>
                                <option value="0" @if(old('urgent') == 0 || $appointment->urgent == 0) selected @endif>عادي</option>
                            </select>

<div class="form-group">
                                        <label class="form-label">{{__('cms.time')}} : </label>
                                        <input class="form-control" name="time" type="text" id="time" placeholder="{{__('cms.time')}} " value="{{old('time')??$appointment->format_time}}">
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">{{__('cms.date')}} : </label>
                                        <input class="form-control" name="date" type="text" id="date" placeholder="{{__('cms.date')}} " value="{{old('date')??$appointment->format_date}}">
                                    </div>
                        </div>
                    </div>

                    <div class="py-2 px-3">
                        <button class="btn btn-primary-gradient mt-2 mb-2 pb-2"
                            type="submit">{{ __('cms.save') }}</button>
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
                                    style="font-family: inherit; background: transparent; width: 100%; height: 100%; outline: 0;font-size: 19px; ">{{old('report')??$appointment->report}}</textarea>
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
