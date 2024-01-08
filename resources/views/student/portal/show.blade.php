@extends('layouts.student')

@section('content')
	<h4 class="mt-2">
		{{ $batch->name }}
		<span class="float-right">{{ $batch->season->name }}</span>
	</h4>
	<div class="row">
		<div class="col-10">
			<b>DATE:</b> <em>{{ date('F d,Y',strtotime($batch->date_start)) }} to {{ date('F d,Y',strtotime($batch->date_end)) }}</em>
		</div>
		
	</div>
	<div class="blackred" width="100%">
		<nav >
			<div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
				@foreach($courses as $course)
					<a class="nav-item nav-link" id="nav-{{$course->code}}-tab" data-toggle="tab" href="#nav-{{$course->code}}" role="tab" aria-controls="nav-{{$course->code}}">
						{{$course->code}}
					</a>
				@endforeach
			</div>
		</nav>
		<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
			@foreach($courses as $course)
				<div class="tab-pane fade show" id="nav-{{$course->code}}" role="tabpanel" aria-labelledby="nav-{{$course->code}}-tab">
					<p class="m-0 p-0 text-center" style="border-bottom:solid 5px lightgray">{{$course->code}} - {{$course->name}}</p>
					<div class="row">
						<div class="col-3">
							<div class="nav flex-column nav-pills p-1" id="v-pills-tab" role="tablist" aria-orientation="vertical">
								@foreach($classes[$course->id] as $class)
									<a class="nav-link" id="v-pills-{{$class->subject_id}}-tab" data-toggle="pill" href="#v-pills-{{$class->subject_id}}" role="tab" aria-controls="v-pills-{{$class->subject_id}}" aria-selected="true">
										{{$class->subject->code}}	
									</a>
								@endforeach
							</div>
						</div>
						<div class="col-9">
							<div class="tab-content highlight h-100 p-1" id="v-pills-tabContent">
								@foreach($classes[$course->id] as $class)
									<div class="tab-pane fade" id="v-pills-{{$class->subject_id}}" role="tabpanel" aria-labelledby="v-pills-{{$class->subject_id}}-tab">
										<div class="row" >
											<div class="col-5 " align="center">
												@if($class->coach)
													<img style="width:70%;" src="/images/{{ $class->coach->image}}">
													<br />
													<b>
														{{ $class->coach->salutation }}	
														{{ $class->coach->first_name }}	
														{{ $class->coach->middle_name }}	
														{{ $class->coach->last_name }}	
													</b>
													<br />
													<em>{{ $class->coach->title }}</em>	
													<br />
													{!! $class->coach->accomplishments !!}
												@endif
											</div>	
											<div class="col-7">
												<h5>{{$class->subject->name}}</h5>

												<div class="row align-items-stretch mb-5">
													<div class="col-md-12">
														<div class="form-group-row row">
															@if($class->date_start && $class->date_end)
																{{ date('F d, Y', strtotime($class->date_start)) }} to {{ date('F d, Y', strtotime($class->date_end)) }}
															@endif
														</div>
														<div class="form-group mb-md-0">
															{!! $class->remarks !!}
														</div>
													</div>
												</div>
											</div>
										</div>
										@if (strtotime($batch->date_end) > time())
											@if($enrollment && $enrollment->verified == 1)
												<div style="border:solid 2px white;border-radius:5px;">
													<div class="row" >
														<div class="col-12">
															<p class="p-0 m-0" style="border-bottom:solid 3px lightgray;" >
																<b><em>ATTACHMENTS</em></b>
															</p>
														</div>	
														<div class="col-12  col-xl-5  col-lg-5 col-md-5">
															<ul class="list-group list-group-flush">
																@foreach($class->attachments as $attachment)
																	<li class="list-group-item" style="background: none;"> 
																		{{ $attachment->name }} 
																		@if($attachment->type == 1)
																			<button class="btn btn-primary float-right p-0 m-0 px-1" onclick="pm(this,{{$attachment->id}});" ><i class="fa fa-play"></i> PLAY</button>
																		@elseif($attachment->type == 2)
																			<button class="btn btn-primary float-right p-0 m-0 px-1" onclick="rp(this,{{$attachment->id}});" ><i class="fa fa-book-open"></i> READ </button>
																		@endif
																	</li>
																@endforeach
															</ul>
														</div>	
														<div class="col-12  col-xl-7  col-lg-7 col-md-7">
															
															<div class="viewAttachment">
																
															</div>
															
														</div>
													</div>
												</div>
											@endif
										@endif
									</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
																	
			@endforeach
		</div>
		@if (strtotime($batch->date_end) > time()) 
			<div class="p-1">
				@if($enrollment)
					@if($enrollment->verified != 1)
						<span class="alert alert-info m-2 p-0">PLEASE WAIT WHILE OUR ADMIN VERIFY YOUR PAYMENT</span>
					@endif
				@else
					<a class="btn btn-success w-25 m-1 p-0"
						onclick="event.preventDefault();
										document.getElementById('join-batch-form').submit();">
						{{ __('JOIN') }}
					</a>
					<form id="join-batch-form" action="{{ route('student_portal_join') }}" method="POST" class="d-none">
						@csrf
						<input type="hidden" name="student_id" value="{{$student->id}}" />
						<input type="hidden" name="batch_id" value="{{$batch->id}}" />
					</form>
				@endif
			</div>
		@endif
	</div>
				
@endsection
@once
	@push('scripts')

		
		<script>
			jQuery(document).ready(function(){
				@if($tokens)
					lib('{{ $tokens }}');
				@endif
			});
		</script>
	@endpush
@endonce