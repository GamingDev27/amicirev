@extends('layouts.admin')

@section('content')
	<h3 class="mt-4">Manage Videos
		<a class="btn btn-outline-primary float-right" href="{{ route('admin_batch_view',$class->batch_id,$class->course_id,$class->subject_id) }}"> <i class="fas fa-reply"></i> BACK </a> 
	</h3>
	
	<div class="row mt-2 h-100 overflow-auto"  >
		<div class="col-5" style="background:lightgray;">
			<h4 class="">
				SERVER VIDEOS
			</h4>
			<p>REMOVED FOR NOW</p>
			@if(isset($videos['items']) )
				<ul class="list-group list-group-flush p-0 all-videos" style="max-height:500px;overflow-y:scroll;overflow-x:none;">
					@foreach($videos['body']['data'] as $video)
						<li class="list-group-item p-0" style="background: whitesmoke;" >
							<div class="row">
								
								<img src="{{ $video['pictures']['sizes'][0]['link']}}" alt="Barca" class="col-3" width="40%" />
								<div class="col-9">
									<small >{{ $video['name']}} [ {{ $video['status'] }} ]</small>
									<br />
									
									<small ><b>UPLOADED</b>:{{date("F d, Y H:i",strtotime($video['created_time']))}} <b>DURATION</b>:{{gmdate("H:i:s",$video['duration'])}}</small>
									<br />
									<button class="btn btn-outline-info m-0 mx-1 p-0 px-1" style="display:none;" onclick="playVid('{{ $class->id}}','{{ str_replace('/videos/','',$video['uri'])}}');">
										<small >Play</small>
									</button>
									<button class="btn btn-outline-success m-0 mx-1 p-0 px-1" onclick="addVideo(this);event.preventDefault();" >
										<small >Add</small>
									</button>
									<input type="hidden" name="newvideo[][id]" value="{{$video['uri']}}" />
								</div>
								
							</div>
						</li>
					@endforeach
				</ul>
			@endif
		</div>
		<div class="col-7" >
			<h4 class="">
				{{ $class->batch->name }}
			</h4>
			<h5 class="">
				{{ $class->course->name }}
			</h4>
			<h5 class="">
				{{ $class->subject->name }}
			</h5>
			<hr />
			<form method="POST" id="contentForm" action="{{ route('admin_batch_add_videos') }}" >
				@csrf
				<input type="hidden" name="album_id" value="{{ $class->vimeo_albumid }}" />
				<ul class="list-group list-group-flush p-0 " id="class-videos">
					@if(isset($albumvideos['body']) && isset($albumvideos['body']['data']))
						@foreach($albumvideos['body']['data'] as $video)
							<li class="list-group-item p-0" >
								<div class="row">
									
									<img src="{{ $video['pictures']['sizes'][0]['link']}}" alt="Barca" class="col-3" width="40%" />
									<div class="col-9">
										<small >{{ $video['name']}} [ {{ $video['status'] }} ]</small>
										<br />
										<small ><b>UPLOADED</b>:{{date("F d, Y H:i",strtotime($video['created_time']))}} <b>DURATION</b>:{{gmdate("H:i:s",$video['duration'])}}</small>
										<br />
										<button class="btn btn-outline-info m-0 mx-1 p-0 px-1" style="display:none;" onclick="playVid('{{ $class->id}}','{{ str_replace('/videos/','',$video['uri'])}}');">
											<small >Play</small>
										</button>
										<button class="btn btn-outline-danger m-0 mx-1 p-0 px-1" onclick="event.preventDefault(); removeVideo('{{$video['uri']}}');" >
											<small >Remove</small>
										</button>
									</div>
									@if(isset($video['download']))
										DOWNLOAD: 
										@foreach($video['download'] as $download)
										<a href="{{ $download['link'] }}">{{ $download['quality'] }} - {{ $download['rendition'] }} - {{ $download['size_short'] }}</a>
										@endforeach
									@endif
								</div>
							</li>
						@endforeach
					@endif
				</ul>
				<hr />
				<button class="btn btn-primary btn-xl text-uppercase" id="submitButton" style="display:none;" type="submit">SUBMIT</button>
			</form>
			
		</div>
	</div>
	
	<form id="remove-video-form" action="{{ route('admin_batch_remove_videos') }}" method="POST" class="d-none">
		@csrf
		<input type="hidden" name="album_id" value="{{ $class->vimeo_albumid }}" />
		<input id="remove_video_id" type="hidden" name="video_id" value="" />
				
	</form>
	
@endsection
@once
	@push('scripts')
		<script>
			$(document).ready(function(){
				
			});
			
			function addVideo(btn){
				jQuery(btn).closest('li').appendTo("#class-videos");
				jQuery('#submitButton').show();
				jQuery(btn).remove();
			}
			
			function removeVideo(videoid){
				if(confirm('Are you sure?')){
					document.getElementById('remove_video_id').value=videoid;
					document.getElementById('remove-video-form').submit();
				}
			}
		</script>
	@endpush
@endonce