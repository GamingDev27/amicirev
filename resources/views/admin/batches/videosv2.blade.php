@extends('layouts.admin')

@section('content')
	<h3 class="mt-4">
		{{ $class->batch->name }} - {{ $class->course->name }} - {{ $class->subject->name }}
		<a class="btn btn-outline-primary float-right" href="{{ route('admin_batch_view',$class->batch_id,$class->course_id,$class->subject_id) }}"> <i class="fas fa-reply"></i> BACK </a> 
	</h3>
	
	
	<?php if($bunnyerror):?>
		<p> 
			COLLECTION NOT FOUND 
		</p>
		<p>
			<em>Please select from unassigned collections or select 'CREATE NEW COLLECTION' to create a new one.</em>
		</p>
		<br />
		<form method="POST" id="contentForm" action="{{ route('admin_batch_update_collection') }}" >
			@csrf
			<input type="hidden" name="class_id" value="{{ $class->id }}" />
			<select name="new_collection_id" style="width:100%;" >
				<option value="NEWCOLLECTION" >CREATE NEW COLLECTION</option>
				<?php foreach($collections as $colid => $colname):?>
					<option value="<?php echo $colid;?>" ><?php echo $colname;?></option>
				<?php endforeach;?>
			</select>
			<br />
			<button class="btn btn-primary btn-xl text-uppercase" type="submit">SUBMIT</button>
		</form>
		
	<?php else:?>
		<div class="row mt-2 h-100 overflow-auto"  >
			<div class="col-8" style="">
				<h4 class="">
					BUNNY.NET VIDEOS
				</h4>
				
				<form method="POST" id="contentForm" action="{{ route('admin_batch_update_videos') }}" >
					@csrf
					<input type="hidden" name="album_id" value="{{ $class->vimeo_albumid }}" />
					@if(isset($albumvideos['items']) )
						<ul class="list-group list-group-flush p-0 all-videos" style="">
							@foreach($albumvideos['items'] as $index => $video)
								<li class="list-group-item p-0" style="border-width: 0 0 1px;
									border: solid 1px gray;
									border-radius: 5px;
									margin: 5px;
									padding: 5px !important;
									background: whitesmoke;
									" 
								>
									<div class="row">
										
										<img src="{{ $pullzone }}/{{ $video['guid'] }}/{{ $video['thumbnailFileName'] }}" alt="Barca" class="col-3" width="100%" />
										<table class="col-9">
											<tr>
												<td width="20%">
													<b>TITLE:</b>
												</td>
												<td>
													<input type="text" name="newvideo[<?php echo $index;?>][title]" value="{{$video['title']}}" style="width:100%;" />
												</td>
											</tr>
											<tr>
												<td>
													<b>COLLECTION:</b>
												</td>
												<td>
													<select name="newvideo[<?php echo $index;?>][collectionId]" style="width:100%;" onchange="jQuery('#submitButton').show();">
														<?php foreach($collections as $colid => $colname):?>
															<option value="<?php echo $colid;?>" <?php echo ($colid == $video['collectionId'])?'selected':'';?> ><?php echo $colname;?></option>
														<?php endforeach;?>
													</select>
												</td>
											</tr>
											<tr>
												<td colspan="2">
													<small ><b>UPLOADED</b>:{{date("F d, Y H:i",strtotime($video['dateUploaded']))}} <b>DURATION</b>:{{gmdate("H:i:s",$video['length'])}}</small>
													<input type="hidden" name="newvideo[<?php echo $index;?>][id]" value="{{$video['guid']}}" />
												</td>
											</tr>
										</table>
										
									</div>
								</li>
							@endforeach
						</ul>
					@endif
					<hr />
					<button class="btn btn-primary btn-xl text-uppercase" id="submitButton" style="display:none;" type="submit">SUBMIT</button>
				</form>
			</div>
		</div>
	<?php endif;?>
	
@endsection
@once
	@push('scripts')
		<script>
			$(document).ready(function(){
				
			});
			
			function addVideo(btn){
				jQuery(btn).closest('li').clone(true).appendTo("#class-videos");
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