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
.previewAvater {
    margin: 14px 0;
    padding: 8px;
    border-bottom: 1px solid #ddd;
}
    </style>
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">{{ __('cms.edit_doctor') }}</h2>
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

    <form action="{{ route('doctors.update',$doctor->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
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
                                    <option value="{{ $citie->id }}" @if ($citie->id == old('city') || $doctor->city->id == $citie->id) selected @endif>
                                        {{ $citie->name_ar }}</option>
                                @endforeach
                            </select>




                        </div>
                        <div class="form-group">
                            <label class="form-label">{{ __('cms.specialite') }}</label>
                            <select name="specialite" class="form-control select2 select2-hidden-accessible"
                                data-select2-id="2" id="specialite" tabindex="-1" aria-hidden="true">
                                <option>{{ __('cms.select') }}</option>
                                @foreach ($specialites as $specialite)
                                    <option value="{{ $specialite->id }}"
                                        @if ($specialite->id == old('city') || $doctor->specialite->id == $specialite->id) selected @endif>{{ $specialite->name_ar }}
                                    </option>
                                @endforeach
                            </select>


                        </div>
                        <div class="form-group">
                            <label class="form-label">{{ __('cms.degree') }}</label>
                            <select name="degree" id="degree" class="form-control nice-select custom-select"
                                style="display: none;">
                                <option value="">{{ __('cms.select') }}</option>
                                <option value="doctors" @if (old('degree') == 'doctors' || $doctor->degree == 'doctors') selected @endif>دكتوراه</option>
                                <option value="master" @if (old('degree') == 'master' || $doctor->degree == 'master') selected @endif>ماجيستير</option>

                            </select>


                        </div>
                        <div class="form-group">
                            <label class="form-label">{{ __('cms.gender') }}</label>
                            <select name="gender" id="gender" class="form-control nice-select custom-select"
                                style="display: none;">
                                <option value="0">{{ __('cms.select') }}</option>
                                <option value="M" @if (old('gender') == 'M' || $doctor->gender == 'M') selected @endif>ذكر</option>
                                <option value="F" @if (old('gender') == 'F' || $doctor->gender == 'F') selected @endif>اثنى</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">{{ __('cms.roles') }}</label>
                            <select name="role" id="role" class="form-control select2 select2-hidden-accessible"
                                data-select2-id="1" tabindex="-1" aria-hidden="true">
                                <option>{{ __('cms.select') }}</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" @if ($role->id == $doctor->roles[0]->id) selected @endif>
                                        {{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">{{ __('cms.avater') }}</label>
                            <div class="previewAvater">
                                <img src="{{asset('upload/files/'.$doctor->avater)}}" alt="">
                            </div>
                            <input type="file" class="avater" data-height="200" id="avater" name="avater" >
                        </div>


                    </div>

                    <div class="py-2 px-3">
                        <button class="btn btn-primary-gradient mt-2 mb-2 pb-2" type="submit" id="add">{{ __('cms.save') }}</button>
                    </div>
                </div>


            </div>

            <div class="col-xl-9 col-lg-9 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-body">
                            <div class="main-content-label mg-b-5">
                                {{ __('cms.info_doctor') }}
                            </div>
                            <div class="row row-sm">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('cms.fname') }} : </label>
                                        <input class="form-control" name="fname" type="text" id="fname"
                                            placeholder="{{ __('cms.fname') }} " value="{{ old('fname') ??$doctor->first_name}}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('cms.lname') }} : </label>
                                        <input class="form-control" name="lname" type="text" id="lname"
                                            placeholder="{{ __('cms.lname') }}" value="{{ old('lname') ??$doctor->last_name}}" >
                                    </div>
                                </div>
                            </div>

                            <div class="row row-sm">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('cms.email') }} : </label>
                                        <input class="form-control" name="email" type="text" id="email"
                                            placeholder="{{ __('cms.email') }}" value="{{ old('email')??$doctor->email }}" >
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('cms.mobile') }} : </label>
                                        <input class="form-control" name="mobile" type="text" id="mobile"
                                            placeholder="{{ __('cms.mobile') }} " value="{{ old('mobile') ??$doctor->mobile}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row row-sm">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('cms.worked_id') }} : </label>
                                        <input class="form-control" name="work_id" type="text" id="work_id"
                                            placeholder="{{ __('cms.worked_id') }} " value="{{ old('work_id')??$doctor->work_id}}" >
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('cms.date_birth') }} : </label>
                                        <input class="form-control" name="date_birth" type="text" id="date_birth"
                                            placeholder="{{ __('cms.date_birth') }} " value="{{ old('date_birth')??$doctor->birth_date }}">
                                    </div>
                                </div>
                            </div>


                            <div class="row row-sm">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('cms.password') }} : </label>
                                        <input class="form-control" name="password" type="password" id="password"
                                            placeholder="{{ __('cms.password') }}" value="{{ old('password')??$doctor->password }}" >
                                    </div>
                                </div>

                            </div>

                            <div class="row row-sm">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('cms.start_work') }} : </label>
                                        <input class="form-control" name="start_time" type="text" id="start_time"
                                            placeholder="{{ __('cms.start_work') }} " value="{{ old('start_time')??$doctor->start_time }}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('cms.end_work') }} : </label>
                                        <input class="form-control" name="end_time" type="text" id="end_time"
                                            placeholder="{{ __('cms.end_work') }}" value="{{ old('end_time')??$doctor->end_time }}" >
                                    </div>
                                </div>

                            </div>
                            <div class="row row-sm">
                                <div class='col-12'>
                                    {{-- data-default-file="{{asset('upload/files/'.$doctor->cv)}}" --}}
                                    <input type="file" class="cv" data-height="200" id="cv" name="cv" data-default-file="{{asset('upload/files/'.$doctor->cv)}}">
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
                'default': '{{ __('cms.upload_avater') }}',
                'replace': '{{ __('cms.upload_avater') }}',
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

        // Set img is dropify


    </script>
@endsection
