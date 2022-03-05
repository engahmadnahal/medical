@extends('layouts.master')
@section('css')
<style>
    tbody tr {
    height: 80px;
}
form {display: inline}
</style>
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="left-content">
						<div>
						  <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">{{__('cms.deleted_appointment')}}</h2>
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
									<h4 class="card-title mg-b-0">{{__('cms.trash')}}</h4>


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
                                        {{$appointment->date}}
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
                                        <form action="{{route('appointment.restore',$appointment->id)}}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-primary"><i class="icon ion-ios-share-alt"></i></button>
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
