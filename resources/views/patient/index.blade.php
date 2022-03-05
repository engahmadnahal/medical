@extends('layouts.master')
@section('css')
    <style>
        tbody tr {
            height: 80px;
        }

    </style>
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">{{__('cms.all_pateins')}}</h2>

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
                        <h4 class="card-title mg-b-0">{{__('cms.all_pateins')}}</h4>
                        <div class="btn-group">
                            <button class="btn btn-light" onclick="document.location.reload()"><i class="bx bx-refresh"></i></button> <a
                                class="btn btn-light " href="{{route('patients.trash')}}"><i class="bx bx-archive"></i></a>
                        </div>
                        <div class="pr-1 mb-3 mb-xl-0">
                            <a href="{{route('patients.create')}}" class="btn btn-primary btn-icon ml-2"><i
                                    class="typcn typcn-edit"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive border-top userlist-table">
                        <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
                            <thead>

                                <tr>

                                    <th class="wd-lg-8p"><span>{{ __('cms.name_pateint') }}</span></th>
                                    <th class="wd-lg-20p"><span>{{ __('cms.join_date') }}</span></th>
                                    <th class="wd-lg-20p"><span>{{ __('cms.mobile') }}</span></th>
                                    <th class="wd-lg-20p"><span>{{ __('cms.email') }}</span></th>
                                    <th class="wd-lg-20p"><span>{{ __('cms.ensur_num') }}</span></th>
                                    <th class="wd-lg-20p"><span>{{ __('cms.national_number') }}</span></th>
                                    <th class="wd-lg-20p"><span>{{ __('cms.date_birth') }}</span></th>
                                    <th class="wd-lg-20p">{{ __('cms.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($patients as $patient)
                                    <tr>
                                        <td colspan="1">
                                            {{ $patient->first_name }} {{ $patient->last_name }}
                                        </td>
                                        <td>
                                            {{ $patient->toArray()['created_at'] }}
                                        </td>
                                       <td>
                                            {{ $patient->mobile }}
                                       </td>

                                       <td>
                                            {{ $patient->email }}
                                       </td>

                                       <td>
                                            {{ $patient->ensurance_num }}
                                       </td>

                                       <td>
                                            {{ $patient->national_num }}
                                       </td>
                                       <td>
                                           {{ $patient->birth_date }}
                                       </td>

                                        <td>
                                            <a href="{{ route('patients.show', $patient->id) }}"
                                                class="btn btn-sm btn-primary">
                                                <i class="far fa-eye"></i>
                                            </a>
                                            <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-sm btn-info">
                                                <i class="las la-pen"></i>
                                            </a>
                                            <form action="{{ route('patients.destroy', $patient->id) }}" method="post" class="btn btn-sm btn-danger">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style=" border: 0; background: transparent; color: #fff; font-size: 15px; ">
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
    <script>
        // $('#checkAll').on('click', function() {
        // 	if ($(this).is(':checked')) {
        // 		$('.ckbox input').each(function() {
        // 			$(this).attr('checked', true);
        // 		});
        // 	} else {
        // 		$('.ckbox input').each(function() {
        // 			$(this).attr('checked', false);
        // 		});
        // 	}
        // });
        // $('input').on('click', function() {
        // 	if ($(this).is(':checked')) {
        // 		$(this).attr('checked', false);
        // 	} else {
        // 		$(this).attr('checked', true);
        // 	}
        // });


        $('#checkAll').on('click', function() {
            if ($(this).is(':checked')) {
                $('tr .ckbox input').each(function() {
                    $(this).closest('tr').addClass('selected');
                    $(this).attr('checked', true);
                });
                $('.btn-group .btn:last-child').removeClass('disabled');
            } else {
                $('tbody .ckbox input').each(function() {
                    $(this).closest('tr').removeClass('selected');
                    $(this).attr('checked', false);
                });
                $('.btn-group .btn:last-child').addClass('disabled');
            }
        });
        $('tbody td input').on('click', function() {
            if ($(this).is(':checked')) {
                $(this).attr('checked', false);
                $(this).closest('tr').addClass('selected');
                $('.btn-group .btn:last-child').removeClass('disabled');
            } else {
                $(this).attr('checked', true);
                $(this).closest('tr').removeClass('selected');
                if (!$('tbody .selected').length) {
                    $('.btn-group .btn:last-child').addClass('disabled');
                }
            }
        });
    </script>
@endsection
