@extends('layouts.master')
@section('css')
    <link href="{{ asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/jqvmap/jqvmap.min.css') }}" rel="stylesheet">
    <style>
        .fontSvg svg {
            width: 100%;
            fill: #fff;
        }

    </style>
@endsection

@if (session('type') == 'doctor')
    )
    @section('user_profile_head', route('doctors.show', $data->id))
@elseif(session('type') == 'patient')
    )
    @section('user_profile_head', route('patients.show', $data->id))
@endif
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">{{ __('cms.welcome') }} {{ $data->first_name }}
                    {{ $data->last_name }}</h2>
                <p class="mg-b-0">{{ __('cms.note_hello') }} .</p>
            </div>
        </div>

    </div>
    <!-- /breadcrumb -->
@endsection
@section('content')
    <!-- row -->

    <!-- row closed -->

    <!-- row opened IF DOCTOR -->
    @if(session('type') == 'doctor')
    <div class="row row-sm row-deck">
        <div class="col-md-12 col-lg-4 col-xl-4">
            <div class="card card-dashboard-eight pb-2">
                <h6 class="card-title">{{ __('cms.patients') }}</h6><span
                    class="d-block mg-b-10 text-muted tx-12">{{ __('cms.show_patients') }}</span>
                <div class="list-group">
                    @foreach ($data->pateins as $pateint)
                        <div class="list-group-item ">
                            <p>{{ $pateint->first_name }} {{ $pateint->last_name }}</p><span><a
                                    href="{{ route('patients.show', $pateint->id) }}"><i
                                        class="far fa-eye"></i></a></span>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-8 col-xl-8">
            <div class="card card-table-two">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mb-1">{{ __('cms.time_today') }}</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
                <span class="tx-12 tx-muted mb-3 ">{{ __('cms.show_time') }}.</span>
                <div class="table-responsive country-table">
                    <table class="table table-striped table-bordered mb-0 text-sm-nowrap text-lg-nowrap text-xl-nowrap">
                        <thead>
                            <tr>
                                <th class="wd-lg-25p">{{ __('cms.date') }}</th>
                                <th class="wd-lg-25p tx-right">{{ __('cms.time') }}</th>
                                <th class="wd-lg-25p tx-right">{{ __('cms.status_patients') }}</th>
                                <th class="wd-lg-25p tx-right">{{ __('cms.patient') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data->appointments as $appoinment)
                                <tr>
                                    <td>{{ $appoinment->date }}</td>
                                    <td class="tx-right tx-medium tx-inverse">{{ $appoinment->toArray()['time'] }}</td>
                                    <td class="tx-right tx-medium tx-inverse "><span
                                            class="@if ($appoinment->status == 1) text-danger @else text-warning @endif">{{ $appoinment->status_patient }}</span>
                                    </td>
                                    <td class="tx-right tx-medium tx-inverse">{{ $appoinment->patient->first_name }}
                                        {{ $appoinment->patient->last_name }} (USERID#{{ $appoinment->patient_id }})</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if(session('type') == 'patient')
    <!-- row opened IF Patient -->
    <div class="row row-sm row-deck">
        <div class="col-md-12 col-lg-4 col-xl-4">
            <div class="card card-dashboard-eight pb-2">
                <h6 class="card-title">{{__('cms.all_doctor')}}</h6><span class="d-block mg-b-10 text-muted tx-12">{{__('cms.show_doctors')}}</span>
                <div class="list-group">
                    @foreach ($data->doctors as $doctor)


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
                            @foreach ($data->appointments as $appoinment)
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
    @endif
    <!-- /row -->
    </div>
    </div>
    <!-- Container closed -->
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Moment js -->
    <script src="{{ URL::asset('assets/plugins/raphael/raphael.min.js') }}"></script>
    <!--Internal  Flot js-->
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js') }}"></script>
    <script src="{{ URL::asset('assets/js/dashboard.sampledata.js') }}"></script>
    <script src="{{ URL::asset('assets/js/chart.flot.sampledata.js') }}"></script>

    <!-- Internal Map -->
    <script src="{{ URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <script src="{{ URL::asset('assets/js/modal-popup.js') }}"></script>
    <!--Internal  index js -->
    <script src="{{ URL::asset('assets/js/index.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.vmap.sampledata.js') }}"></script>

    <!--Internal Counters -->
    <script src="{{ asset('assets/plugins/counters/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/counters/counterup.min.js') }}"></script>
    <!--Internal Time Counter -->
    <script src="{{ asset('assets/plugins/counters/jquery.missofis-countdown.js') }}"></script>
    <script src="{{ asset('assets/plugins/counters/counter.js') }}"></script>

@endsection
