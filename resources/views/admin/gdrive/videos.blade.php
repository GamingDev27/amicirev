@extends('layouts.admin')

@section('content')
	<h3 class="mt-4">Import Google Drive Videos</h3>
	@if(isset($errormessage) && strlen($errormessage))
		<p class="alert alert-danger">
			SignIn to Google Again. Your token is iether invalid or expired. ( {{ $errormessage }} )
		</p>
	@endif
	
	@if(!$noauth && isset($code) && strlen($code))
		<div class="row mt-2 h-100 overflow-auto"  >
			<div class="col-5" style="background:lightgray;">
				<h4 class="">
					GOOGLE DRIVE VIDEOS
				</h4>
				@if(isset($videos))
					<ul class="list-group list-group-flush p-0 all-videos" style="max-height:500px;overflow-y:scroll;overflow-x:none;">
						@foreach($videos as $video)
							<li class="list-group-item p-0" style="background: whitesmoke;" >
								<div class="row">
									
									<img src="{{ $video['thumbnail']}}" alt="Barca" class="col-3 my-1" width="40%" />
									<div class="col-9">
										<small >{{ $video['name']}} </small>
										<br />
										<small ><b>TYPE</b>:{{ $video['mime'] }} <b>SIZE</b>:{{$video['size']}}</small>
										<br />
										<button class="btn btn-outline-success m-0 mx-1 p-0 px-1" onclick="addVideo(this);event.preventDefault();" >
											<small >Import</small>
										</button>
										<input type="hidden" name="importvideo[index][id]" value="{{$video['id']}}" />
										<input type="hidden" name="importvideo[index][link]" value="{{$video['link']}}" />
										<input type="hidden" name="importvideo[index][name]" value="{{$video['name']}}" />
										
									</div>
									
								</div>
							</li>
						@endforeach
					</ul>
				@endif
			</div>
			<div class="col-7" >
				<h4> FILES TO BE IMPORTED TO VIDEO SERVER:</h4>
				<form method="POST" id="contentForm" action="{{ route('admin_gdrive_import_videos') }}" >
					@csrf
					<ul class="list-group list-group-flush p-0 " id="import-videos">
						
					</ul>
					<hr />
					<button class="btn btn-primary btn-xl text-uppercase" id="submitButton" style="display:none;" type="submit">SUBMIT</button>
				</form>
			</div>
		</div>
	@else
		<a class="btn btn-primary m-1 p-1 " href='{{ $gsigninlink }}'>SignIn to Google</a>
		
	@endif
	
@endsection
@once
	@push('scripts')
		<script>
			$(document).ready(function(){
				
			});
			
			function addVideo(btn){
				jQuery(btn).closest('li').find('input').each(function(){
					jQuery(this).attr('name', jQuery(this).attr('name').replace('index',jQuery("#import-videos > li").length));
				});
				jQuery(btn).closest('li').appendTo("#import-videos");
				
				jQuery(btn).remove();
				jQuery('#submitButton').show();
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