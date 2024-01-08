<?php $__env->startSection('content'); ?>
	<h3 class="mt-4">
		<?php echo e($class->batch->name); ?> - <?php echo e($class->course->name); ?> - <?php echo e($class->subject->name); ?>

		<a class="btn btn-outline-primary float-right" href="<?php echo e(route('admin_batch_view',$class->batch_id,$class->course_id,$class->subject_id)); ?>"> <i class="fas fa-reply"></i> BACK </a> 
	</h3>
	
	
	<?php if($bunnyerror):?>
		<p> 
			COLLECTION NOT FOUND 
		</p>
		<p>
			<em>Please select from unassigned collections or select 'CREATE NEW COLLECTION' to create a new one.</em>
		</p>
		<br />
		<form method="POST" id="contentForm" action="<?php echo e(route('admin_batch_update_collection')); ?>" >
			<?php echo csrf_field(); ?>
			<input type="hidden" name="class_id" value="<?php echo e($class->id); ?>" />
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
				
				<form method="POST" id="contentForm" action="<?php echo e(route('admin_batch_update_videos')); ?>" >
					<?php echo csrf_field(); ?>
					<input type="hidden" name="album_id" value="<?php echo e($class->vimeo_albumid); ?>" />
					<?php if(isset($albumvideos['items']) ): ?>
						<ul class="list-group list-group-flush p-0 all-videos" style="">
							<?php $__currentLoopData = $albumvideos['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li class="list-group-item p-0" style="border-width: 0 0 1px;
									border: solid 1px gray;
									border-radius: 5px;
									margin: 5px;
									padding: 5px !important;
									background: whitesmoke;
									" 
								>
									<div class="row">
										
										<img src="<?php echo e($pullzone); ?>/<?php echo e($video['guid']); ?>/<?php echo e($video['thumbnailFileName']); ?>" alt="Barca" class="col-3" width="100%" />
										<table class="col-9">
											<tr>
												<td width="20%">
													<b>TITLE:</b>
												</td>
												<td>
													<input type="text" name="newvideo[<?php echo $index;?>][title]" value="<?php echo e($video['title']); ?>" style="width:100%;" />
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
													<small ><b>UPLOADED</b>:<?php echo e(date("F d, Y H:i",strtotime($video['dateUploaded']))); ?> <b>DURATION</b>:<?php echo e(gmdate("H:i:s",$video['length'])); ?></small>
													<input type="hidden" name="newvideo[<?php echo $index;?>][id]" value="<?php echo e($video['guid']); ?>" />
												</td>
											</tr>
										</table>
										
									</div>
								</li>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</ul>
					<?php endif; ?>
					<hr />
					<button class="btn btn-primary btn-xl text-uppercase" id="submitButton" style="display:none;" type="submit">SUBMIT</button>
				</form>
			</div>
		</div>
	<?php endif;?>
	
<?php $__env->stopSection(); ?>
<?php if (! $__env->hasRenderedOnce('6017078c-f280-474d-8704-0bacc877272f')): $__env->markAsRenderedOnce('6017078c-f280-474d-8704-0bacc877272f'); ?>
	<?php $__env->startPush('scripts'); ?>
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
	<?php $__env->stopPush(); ?>
<?php endif; ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/amicirev/public_html/resources/views/admin/batches/videosv2.blade.php ENDPATH**/ ?>