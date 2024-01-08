<?php $__env->startSection('content'); ?>
	<h3 class="mt-4">Manage Videos
		<a class="btn btn-outline-primary float-right" href="<?php echo e(route('admin_batch_view',$class->batch_id,$class->course_id,$class->subject_id)); ?>"> <i class="fas fa-reply"></i> BACK </a> 
	</h3>
	
	<div class="row mt-2 h-100 overflow-auto"  >
		<div class="col-5" style="background:lightgray;">
			<h4 class="">
				SERVER VIDEOS
			</h4>
			<p>REMOVED FOR NOW</p>
			<?php if(isset($videos['items']) ): ?>
				<ul class="list-group list-group-flush p-0 all-videos" style="max-height:500px;overflow-y:scroll;overflow-x:none;">
					<?php $__currentLoopData = $videos['body']['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<li class="list-group-item p-0" style="background: whitesmoke;" >
							<div class="row">
								
								<img src="<?php echo e($video['pictures']['sizes'][0]['link']); ?>" alt="Barca" class="col-3" width="40%" />
								<div class="col-9">
									<small ><?php echo e($video['name']); ?> [ <?php echo e($video['status']); ?> ]</small>
									<br />
									
									<small ><b>UPLOADED</b>:<?php echo e(date("F d, Y H:i",strtotime($video['created_time']))); ?> <b>DURATION</b>:<?php echo e(gmdate("H:i:s",$video['duration'])); ?></small>
									<br />
									<button class="btn btn-outline-info m-0 mx-1 p-0 px-1" style="display:none;" onclick="playVid('<?php echo e($class->id); ?>','<?php echo e(str_replace('/videos/','',$video['uri'])); ?>');">
										<small >Play</small>
									</button>
									<button class="btn btn-outline-success m-0 mx-1 p-0 px-1" onclick="addVideo(this);event.preventDefault();" >
										<small >Add</small>
									</button>
									<input type="hidden" name="newvideo[][id]" value="<?php echo e($video['uri']); ?>" />
								</div>
								
							</div>
						</li>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</ul>
			<?php endif; ?>
		</div>
		<div class="col-7" >
			<h4 class="">
				<?php echo e($class->batch->name); ?>

			</h4>
			<h5 class="">
				<?php echo e($class->course->name); ?>

			</h4>
			<h5 class="">
				<?php echo e($class->subject->name); ?>

			</h5>
			<hr />
			<form method="POST" id="contentForm" action="<?php echo e(route('admin_batch_add_videos')); ?>" >
				<?php echo csrf_field(); ?>
				<input type="hidden" name="album_id" value="<?php echo e($class->vimeo_albumid); ?>" />
				<ul class="list-group list-group-flush p-0 " id="class-videos">
					<?php if(isset($albumvideos['body']) && isset($albumvideos['body']['data'])): ?>
						<?php $__currentLoopData = $albumvideos['body']['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<li class="list-group-item p-0" >
								<div class="row">
									
									<img src="<?php echo e($video['pictures']['sizes'][0]['link']); ?>" alt="Barca" class="col-3" width="40%" />
									<div class="col-9">
										<small ><?php echo e($video['name']); ?> [ <?php echo e($video['status']); ?> ]</small>
										<br />
										<small ><b>UPLOADED</b>:<?php echo e(date("F d, Y H:i",strtotime($video['created_time']))); ?> <b>DURATION</b>:<?php echo e(gmdate("H:i:s",$video['duration'])); ?></small>
										<br />
										<button class="btn btn-outline-info m-0 mx-1 p-0 px-1" style="display:none;" onclick="playVid('<?php echo e($class->id); ?>','<?php echo e(str_replace('/videos/','',$video['uri'])); ?>');">
											<small >Play</small>
										</button>
										<button class="btn btn-outline-danger m-0 mx-1 p-0 px-1" onclick="event.preventDefault(); removeVideo('<?php echo e($video['uri']); ?>');" >
											<small >Remove</small>
										</button>
									</div>
									<?php if(isset($video['download'])): ?>
										DOWNLOAD: 
										<?php $__currentLoopData = $video['download']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $download): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<a href="<?php echo e($download['link']); ?>"><?php echo e($download['quality']); ?> - <?php echo e($download['rendition']); ?> - <?php echo e($download['size_short']); ?></a>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<?php endif; ?>
								</div>
							</li>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php endif; ?>
				</ul>
				<hr />
				<button class="btn btn-primary btn-xl text-uppercase" id="submitButton" style="display:none;" type="submit">SUBMIT</button>
			</form>
			
		</div>
	</div>
	
	<form id="remove-video-form" action="<?php echo e(route('admin_batch_remove_videos')); ?>" method="POST" class="d-none">
		<?php echo csrf_field(); ?>
		<input type="hidden" name="album_id" value="<?php echo e($class->vimeo_albumid); ?>" />
		<input id="remove_video_id" type="hidden" name="video_id" value="" />
				
	</form>
	
<?php $__env->stopSection(); ?>
<?php if (! $__env->hasRenderedOnce('1f461c3d-b7ab-4e06-88f5-79926875d0ff')): $__env->markAsRenderedOnce('1f461c3d-b7ab-4e06-88f5-79926875d0ff'); ?>
	<?php $__env->startPush('scripts'); ?>
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
	<?php $__env->stopPush(); ?>
<?php endif; ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/amicirev/public_html/resources/views/admin/batches/videos.blade.php ENDPATH**/ ?>