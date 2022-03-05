@extends('layouts.master')
@section('css')
    <style>
        tbody tr {
            height: 80px;
        }
form {
    display: inline;
}
    </style>
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">{{ __('cms.all_appointment') }}</h2>
                <p class="mg-b-0">{{ __('cms.show_appointment') }}</p>
            </div>
        </div>

    </div>
    <!-- /breadcrumb -->
@endsection
@section('content')
    <!-- Row Content -->
    <div class="row row-sm">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">{{ __('cms.all_appointment') }}</h4>
                        <div class="btn-group">
                            <button class="btn btn-light" onclick="document.location.reload()"><i
                                    class="bx bx-refresh"></i></button>
                                    <a href="{{route('appointment.trash')}}" class="btn btn-light "><i
                                    class="bx bx-archive"></i></a>
                        </div>
                        <div class="pr-1 mb-3 mb-xl-0">
                            <a href="{{route('appointment.create')}}" class="btn btn-primary btn-icon ml-2"><i
                                    class="typcn typcn-edit"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive border-top userlist-table">
                        <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
                            <thead>

                                <tr>

                                    <th class="wd-lg-8p"><span>{{__('cms.date')}}</span></th>
                                    <th class="wd-lg-20p"><span>{{__('cms.name_doctor')}}</th>
                                    <th class="wd-lg-20p"><span>{{__('cms.name_pateint')}}</span></th>
                                    <th class="wd-lg-20p"><span>{{__('cms.status_patients')}}</span></th>
                                    <th class="wd-lg-20p"><span>{{__('cms.status_appointment')}}</span></th>
                                    <th class="wd-lg-20p"><span>{{__('cms.time')}}</span></th>
                                    <th class="wd-lg-20p">{{__('cms.action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($appointments as $appointment )
                                <tr>
                                    <td>
                                    </td>
                                    <td>
                                        <a href="{{route('doctors.show',$appointment->doctor->id)}}">{{$appointment->doctor->first_name}} {{$appointment->doctor->last_name}}</a>
                                    </td>
                                    <td>
                                        <a href="{{route('patients.show',$appointment->patient->id)}}">{{$appointment->patient->first_name}} {{$appointment->patient->last_name}}</a>
                                    </td>
                                    <td >
                                        <span class="label @if($appointment->status == 1) text-danger @elseif($appointment->status == 2) text-warning @endif d-flex">
                                            <div class="dot-label @if($appointment->status == 1) bg-danger @elseif($appointment->status == 2) bg-warning @endif ml-1"></div>
                                            {{$appointment->status_patient}}
                                        </span>
                                    </td>
                                    <td >
                                        <span class="label @if($appointment->urgent) text-danger @endif d-flex">
                                            <div class="dot-label @if($appointment->urgent)bg-danger  @endif ml-1"></div>
                                            {{$appointment->status_appointment}}
                                        </span>
                                    </td>
                                    <td >
                                        {{$appointment->toArray()['time']}}
                                    </td>
                                    <td>
                                        <a href="{{route('appointment.show',$appointment->id)}}" class="btn btn-sm btn-primary">
                                            <i class="far fa-eye"></i>
                                        </a>
                                        <a href="{{route('appointment.edit',$appointment->id)}}" class="btn btn-sm btn-info">
                                            <i class="las la-pen"></i>
                                        </a>
                                        <form action="{{route('appointment.destroy',$appointment->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="las la-trash"></i>
                                        </button>
                                        </form>

                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div><!-- COL END -->
    </div>
    <!-- End Row Contetnt -->
    </div>
    <!-- Container closed -->
@endsection
@section('js')

@endsection
