<?php $__env->startSection('content'); ?>
	<h1 class="mt-4">Edit Team Member
		<a class="btn btn-outline-primary float-right" href="<?php echo e(route('admin_team')); ?>"> <i class="fas fa-reply"></i> BACK </a> 
	</h1>
	
	<form method="POST" id="contentForm" action="<?php echo e(route('admin_save_content')); ?>" enctype="multipart/form-data">
		<?php echo csrf_field(); ?>
		<div class="row align-items-stretch mb-5">
			<div class="col-md-4" >
				<?php if(isset($content->image) && strlen($content->image)): ?>
					<input type="file" id="imageInput" name="image" >
					<img class="mx-auto rounded-circle" id="imagePreview" alt="Image Preview Here" src="/images/<?php echo e($content->image); ?>" style="max-width:80%;" />
				<?php else: ?>
					<input type="file" id="imageInput" required name="image" >
					<img class="mx-auto rounded-circle" id="imagePreview" alt="Image Preview Here" style="max-width:80%;display:none;" />
				<?php endif; ?>
				<?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
					<span class="invalid-feedback" role="alert">
						<strong><?php echo e($message); ?></strong>
					</span>
				<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
			</div>
			<div class="col-md-8">
				<div class="form-group">
					<input placeholder="Name*" id="title" type="text" class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="title" value="<?php echo e($content->title); ?>" required autocomplete="title" autofocus>
					<?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
						<span class="invalid-feedback" role="alert">
							<strong><?php echo e($message); ?></strong>
						</span>
					<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
				</div>
				<div class="form-group">
					<input id="id" type="hidden"  name="id" value="<?php echo e($content->id); ?>"  >
					<input id="type" type="hidden"  name="type" value="<?php echo e($type); ?>"  >
					<input id="redirectTo" type="hidden"  name="redirectTo" value="admin_team" />
					<input placeholder="Title*" id="description" type="text" class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="description" value="<?php echo e($content->description); ?>" required autocomplete="description" >

					<?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
						<span class="invalid-feedback" role="alert">
							<strong><?php echo e($message); ?></strong>
						</span>
					<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
					
				</div>
				<div class="form-group mb-md-0">
					
					<div class="form-group form-group-textarea mb-md-0">
						<textarea class="form-control <?php $__errorArgs = ['details'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="details" name="details" placeholder="Description *" required autocomplete="details"><?php echo e($content->details); ?></textarea>
						<p class="help-block text-danger"></p>
					</div>
					<?php $__errorArgs = ['details'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
						<span class="invalid-feedback" role="alert">
							<strong><?php echo e($message); ?></strong>
						</span>
					<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
				</div>
				<div class="form-check">
					<input type="hidden" name="enabled" value="0" />
					<input class="form-check-input" type="checkbox" name="enabled" id="enabled" value="1" <?php echo e($content->enabled ? 'checked' : ''); ?>>

					<label class="form-check-label" for="enabled">
						<?php echo e(__('Enabled')); ?>

					</label>
				</div>
				<hr />
				<button class="btn btn-primary btn-xl text-uppercase" id="sendMessageButton" type="submit">SUBMIT</button>
			</div>
		</div>
		
	</form>
	
<?php $__env->stopSection(); ?>

<?php if (! $__env->hasRenderedOnce('60bc8500-19fc-4356-9903-fbc1a00e6a87')): $__env->markAsRenderedOnce('60bc8500-19fc-4356-9903-fbc1a00e6a87'); ?>
    <?php $__env->startPush('scripts'); ?>

		<script>
			function readURL(input) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();
				
					reader.onload = function(e) {
						jQuery('#imagePreview').attr('src', e.target.result);
						jQuery('#imagePreview').show();
						//console.log(e.target.filesize);
						//console.log(e.target);
					}
				
					reader.readAsDataURL(input.files[0]); 
				}
			}
			jQuery(document).ready(function(){
				console.log('here is thes');
				jQuery("#imageInput").change(function() {
					console.log('here is this');
					readURL(this);
				});
			});
		</script>
	<?php $__env->stopPush(); ?>
<?php endif; ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/amicirev/public_html/resources/views/admin/contents/team_edit.blade.php ENDPATH**/ ?>