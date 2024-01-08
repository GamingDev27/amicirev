

<?php $__env->startSection('content'); ?>
	<h3 class="mt-4">Import Google Drive Videos</h3>
	<?php if(isset($errormessage) && strlen($errormessage)): ?>
		<p class="alert alert-danger">
			SignIn to Google Again. Your token is iether invalid or expired. ( <?php echo e($errormessage); ?> )
		</p>
	<?php endif; ?>
	
	<?php if(!$noauth && isset($code) && strlen($code)): ?>
		<div class="row mt-2 h-100 overflow-auto"  >
			<div class="col-5" style="background:lightgray;">
				<h4 class="">
					GOOGLE DRIVE VIDEOS
				</h4>
				<?php if(isset($videos)): ?>
					<ul class="list-group list-group-flush p-0 all-videos" style="max-height:500px;overflow-y:scroll;overflow-x:none;">
						<?php $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<li class="list-group-item p-0" style="background: whitesmoke;" >
								<div class="row">
									
									<img src="<?php echo e($video['thumbnail']); ?>" alt="Barca" class="col-3 my-1" width="40%" />
									<div class="col-9">
										<small ><?php echo e($video['name']); ?> </small>
										<br />
										<small ><b>TYPE</b>:<?php echo e($video['mime']); ?> <b>SIZE</b>:<?php echo e($video['size']); ?></small>
										<br />
										<button class="btn btn-outline-success m-0 mx-1 p-0 px-1" onclick="addVideo(this);event.preventDefault();" >
											<small >Import</small>
										</button>
										<input type="hidden" name="importvideo[index][id]" value="<?php echo e($video['id']); ?>" />
										<input type="hidden" name="importvideo[index][link]" value="<?php echo e($video['link']); ?>" />
										<input type="hidden" name="importvideo[index][name]" value="<?php echo e($video['name']); ?>" />
										
									</div>
									
								</div>
							</li>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</ul>
				<?php endif; ?>
			</div>
			<div class="col-7" >
				<h4> FILES TO BE IMPORTED TO VIDEO SERVER:</h4>
				<form method="POST" id="contentForm" action="<?php echo e(route('admin_gdrive_import_videos')); ?>" >
					<?php echo csrf_field(); ?>
					<ul class="list-group list-group-flush p-0 " id="import-videos">
						
					</ul>
					<hr />
					<button class="btn btn-primary btn-xl text-uppercase" id="submitButton" style="display:none;" type="submit">SUBMIT</button>
				</form>
			</div>
		</div>
	<?php else: ?>
		<a class="btn btn-primary m-1 p-1 " href='<?php echo e($gsigninlink); ?>'>SignIn to Google</a>
		
	<?php endif; ?>
	
<?php $__env->stopSection(); ?>
<?php if (! $__env->hasRenderedOnce('ade6c800-c592-44e8-88cf-618c4c867cb9')): $__env->markAsRenderedOnce('ade6c800-c592-44e8-88cf-618c4c867cb9'); ?>
	<?php $__env->startPush('scripts'); ?>
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
	<?php $__env->stopPush(); ?>
<?php endif; ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Dir\laravel\amici\resources\views/admin/gdrive/videos.blade.php ENDPATH**/ ?>