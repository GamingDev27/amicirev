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
	<?php //var_dump($albums);?>
	
	<div class="blackred" width="100%">
		<nav >
			<div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
				@php
					$firstcourse = true;
				@endphp
				@foreach($courses as &$course)
					@foreach($classes[$course->id] as $class)
						@if($class->coach)
							@php
								$course->hascoach = true;
							@endphp
							@break
						@endif
					@endforeach
					@if(isset($course->hascoach) && $course->hascoach)
						<a class="nav-item nav-link {{$firstcourse?'active':''}}" {{ $firstcourse?'aria-selected="true"':'' }} id="nav-{{$course->code}}-tab" data-toggle="tab" href="#nav-{{$course->code}}" role="tab" aria-controls="nav-{{$course->code}}">
							{{$course->code}}
						</a>
						@php
							$firstcourse = false;
						@endphp
					@endif
				@endforeach
			</div>
		</nav>
		<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
			@php
				$firstcourse = true;
			@endphp
			@foreach($courses as $course)
				@if(isset($course->hascoach) && $course->hascoach)
					<div class="tab-pane fade {{$firstcourse?'active show':''}}" id="nav-{{$course->code}}" role="tabpanel" aria-labelledby="nav-{{$course->code}}-tab">
						@php
							$firstcourse = false;
						@endphp
						<p class="m-0 p-0 text-center" style="border-bottom:solid 5px lightgray">{{$course->code}} - {{$course->name}}</p>
						<div class="row">
							<div class="col-sm-5 col-lg-3">
								<div class="nav subjects-tab flex-column nav-pills p-1" id="v-pills-tab" role="tablist" aria-orientation="vertical">
									@foreach($classes[$course->id] as $class)
										@if($class->coach)
											<a class="nav-link subject-pill" id="v-pills-{{$class->subject_id}}-tab" data-coach-id="{{$class->id}}-{{$class->coach->id}}" data-toggle="pill" href="#v-pills-{{$class->subject_id}}" role="tab" aria-controls="v-pills-{{$class->subject_id}}" aria-selected="true">
												{{$class->subject->code}}	
											</a>
										@endif
									@endforeach
								</div>
								<div>
									@foreach($classes[$course->id] as $class)
										@if($class->coach)
											<div class="card coaches-dv shadow m-2 bg-white rounded" style="display:none;" id="coach-{{$class->id}}-{{$class->coach->id}}-dv">
												<img class="card-img-top" src="/images/{{ $class->coach->image}}" alt="Coach Image">
												<div class="card-body p-1">
													<div class="card-title" align="center" >
														<h5 style="color:#FF5722;font-size:24; margin:0px;" >
															{{ $class->coach->salutation }}	
															{{ $class->coach->first_name }}	
															{{ $class->coach->middle_name }}	
															{{ $class->coach->last_name }}
														</h5>
														<b>{{ $class->coach->title }}</b>
													</div>
													<div class="card-text" style="font-size:10px;border-top:solid lightgray 1px">
														<p style="margin:2px 0px;font-size:16px;"></p>
													
														<p style="margin:2px 0px;font-size:10px;">
															{!! $class->coach->accomplishments !!}
														</p>
													</div>
												</div>
											</div>
										@endif
									@endforeach
								</div>
							</div>
							<div class="col-sm-7 col-lg-9">
								<div class="tab-content highlight h-100 p-1" id="v-pills-tabContent">
									@foreach($classes[$course->id] as $class)
										<div class="tab-pane fade" id="v-pills-{{$class->subject_id}}" role="tabpanel" aria-labelledby="v-pills-{{$class->subject_id}}-tab">
											
											<div class="">
												<h5>{{$class->subject->name}}</h5>

												<div class="row align-items-stretch mb-5">
													<div class="col-md-12">
														<small>
															@if($class->date_start && $class->date_end)
																{{ date('F d, Y', strtotime($class->date_start)) }} to {{ date('F d, Y', strtotime($class->date_end)) }}
															@endif
															
														</small>
														<div class="form-group mb-md-0">
															{!! $class->remarks !!}
														</div>
														<hr />
														@if (strtotime($batch->date_end) > time())
															@if($enrollment && $enrollment->verified == 1)
																@if($class->vimeo_albumid)
																	@if(isset($albums[$class->id]))
																		
																		<div class="embed-container" id="video_{{$class->id}}" ></div>
																		<div class="container-fluid p-0" >
																			<ul class="list-unstyled video-list-thumbs row  flex-row flex-nowrap overflow-auto m-0 p-1" style="background:white;border:solid 1px #212529;border-bottom:solid 4px #212529;">
																				@if(isset($albums[$class->id]["items"]) && count($albums[$class->id]["items"]))
																					@foreach($albums[$class->id]["items"] as $video)
																						<li class="col-lg-3 col-sm-4 col-xs-6 col-6 p-0">
																							<a onclick="playVid('{{ $class->id}}','{{$video['guid']}}');" title="{{ $video['title']}}" >
																								@php
																									$link = "";
																									
																								@endphp
																								<img src="{{ $pullzone }}/{{ $video['guid'] }}/{{ $video['thumbnailFileName'] }}" alt="Barca" class="img-responsive" width="100%" />
																								<h2>{{ strtoupper($video['title']) }}</h2>
																								<i class="glyphicon-play-circle fa fa-play-circle"></i>
																								<span class="duration">{{gmdate("H:i:s",$video['length'])}}</span>
																							</a>
																						</li>
																					@endforeach
																				@endif
																			</ul>
																		</div>
																	@endif
																@endif
																@if(isset($class->attachments))
																	<div class="m-2 p-1 border rounded" >
																		<div class="buttonshere">
																			@foreach($class->attachments as $attachment)
																				<button class="btn btn-primary m-1" onclick="readp(this,'{{ $attachment->token }}')" >
																					<i class="fa fa-file-pdf"></i>
																					{{ $attachment->name }}
																				</button>
																			@endforeach
																		</div>
																		<div id="pdfhere">
																		</div>
																	</div>
																@endif
															@else
																<span class="alert alert-info m-2 p-0"> Please enroll to view Videos and PDFs</span>
															@endif
														@else
															<span class="alert alert-info m-2 p-0">Course was finished</span>
														@endif
													</div>
												</div>
											</div>
										</div>
									@endforeach
								</div>
							</div>
						</div>
					</div>
				@endif													
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
			var video01Player;
			var iframeElm;
			jQuery(document).ready(function(){
				jQuery('.subjects-tab .nav-link').click(function(){
					console.log('clicked');
					console.log(jQuery(this).attr('data-coach-id'));
					jQuery('.embed-container').empty();
					jQuery('.coaches-dv').hide();
					jQuery('#coach-'+jQuery(this).attr('data-coach-id')+'-dv').show();
				});
				
				/*
					Carousel
				*/
				$('#carousel-example').on('slide.bs.carousel', function (e) {
					/*
						CC 2.0 License Iatek LLC 2018 - Attribution required
					*/
					var $e = $(e.relatedTarget);
					var idx = $e.index();
					var itemsPerSlide = 5;
					var totalItems = $('.carousel-item').length;

					if (idx >= totalItems-(itemsPerSlide-1)) {
						var it = itemsPerSlide - (totalItems - idx);
						for (var i=0; i<it; i++) {
							// append slides to end
							if (e.direction=="left") {
								$('.carousel-item').eq(i).appendTo('.carousel-inner');
							}
							else {
								$('.carousel-item').eq(0).appendTo('.carousel-inner');
							}
						}
					}
				});
				
				iframeElm = document.createElement('iframe');
				iframeElm.id="iframePDF";
				iframeElm.width="100%";
				iframeElm.height="600px";
			});
			function readp(btn,id){
				btn.parentNode.nextElementSibling.innerHTML = '';
				btn.parentNode.nextElementSibling.appendChild(iframeElm);
				iframeElm.src = "/laraview/#../student/attachment/stream/"+id;
			}
			function playVid(classid,videoid){
				//jQuery('#video_'+classid).html('<iframe src="https://iframe.mediadelivery.net/embed/<?php echo $libid;?>/'+videoid+'" />');
				let vid = '<div ><iframe src="https://iframe.mediadelivery.net/embed/<?php echo $libid;?>/'+videoid+'?autoplay=true" loading="lazy" style="border: none; position: absolute; top: 0; height: 100%; width: 100%;" allow="accelerometer; gyroscope; autoplay; encrypted-media; picture-in-picture;" allowfullscreen="true" referrerpolicy="strict-origin-when-cross-origin"></iframe></div>';
				jQuery('#video_'+classid).html(vid);
			}
		</script>
	@endpush
@endonce