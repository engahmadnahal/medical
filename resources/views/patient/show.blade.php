@extends('layouts.master')
@section('css')
    <link href="{{ asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <style>
        tbody tr {
            height: 80px;
        }

        .dropify-wrapper {
            display: none;
        }

    </style>
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
            </div>
        </div>
    </div>
    <!-- /breadcrumb -->
@endsection
@section('content')
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body h-100">
                    <div class="row row-sm ">
                        <div class="col-sm-12 col-xl-12 col-lg-12">
                            <div class="card user-wideget user-wideget-widget widget-user">
                                <div class="widget-user-header bg-primary">
                                    <h3 class="widget-user-username">{{$pateint->first_name}} {{$pateint->last_name}}</h3>
                                </div>

                                <div class="user-wideget-footer">
                                    <div class="row">
                                        <div class="col-sm-3 border-left">
                                            <div class="description-block">
                                                <h5 class="description-header">{{__('cms.city_name')}}</h5>
                                                <span class="description-text">{{$pateint->city->name_ar}}</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 border-left">
                                            <div class="description-block">
                                                <h5 class="description-header">{{__('cms.age')}}</h5>
                                                <span class="description-text">{{$pateint->age_pateint}}</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 border-left">
                                            <div class="description-block">
                                                <h5 class="description-header">{{__('cms.national_number')}}</h5>
                                                <span class="description-text">{{$pateint->national_num}}</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="description-block">
                                                <h5 class="description-header">{{__('cms.ensur_num')}}</h5>
                                                <span class="description-text">{{$pateint->ensurance_num}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-sm row-deck">
        <div class="col-md-12 col-lg-4 col-xl-4">
            <div class="card card-dashboard-eight pb-2">
                <h6 class="card-title">{{__('cms.all_doctor')}}</h6><span class="d-block mg-b-10 text-muted tx-12">{{__('cms.show_doctors')}}</span>
                <div class="list-group">
                    @foreach ($pateint->doctors as $doctor)


                        <div class="list-group-item ">
                        <p>{{$doctor->first_name}} {{$doctor->last_name}}</p><span><a href="{{route('doctors.show',$doctor->id)}}"><i class="far fa-eye"></i></a></span>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-8 col-xl-8">
            <div class="card card-table-two">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mb-1">{{__('cms.all_appointments')}}</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
                <span class="tx-12 tx-muted mb-3 ">{{__('cms.show_appointments')}}.</span>
                <div class="table-responsive country-table">
                    <table class="table table-striped table-bordered mb-0 text-sm-nowrap text-lg-nowrap text-xl-nowrap">
                        <thead>
                            <tr>
                                <th class="wd-lg-25p">{{__('cms.date')}}</th>
                                <th class="wd-lg-25p tx-right">{{__('cms.time')}}</th>
                                <th class="wd-lg-25p tx-right">{{__('cms.status_patients')}}</th>
                                <th class="wd-lg-25p tx-right">{{__('cms.patient')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pateint->appointments as $appoinment)
                            <tr>
                                <td>{{$appoinment->date}}</td>
                                <td class="tx-right tx-medium tx-inverse">{{$appoinment->toArray()['time']}}</td>
                                <td class="tx-right tx-medium tx-inverse "><span class="@if($appoinment->status == 1) text-danger @else text-warning @endif">{{$appoinment->status_patient}}</span></td>
                                <td class="tx-right tx-medium tx-inverse">{{$appoinment->doctor->first_name}} {{$appoinment->doctor->last_name}} (USERID#{{$appoinment->doctor_id}})</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Chart -->

    <!-- Container closed -->
@endsection
@section('js')
    <script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>

    <script src="{{ asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


@endsection
