<?php $__env->startSection('content'); ?>
	<h3 class="mt-4">Change Password
		<a class="btn btn-outline-primary float-right" href="<?php echo e(route('student_profile')); ?>"> <i class="fas fa-reply"></i> BACK </a> 
	</h3>
	
	<form method="POST" id="contentForm" action="<?php echo e(route('student_profile_savep')); ?>" >
		<?php echo csrf_field(); ?>
			<div class="col-md-8">
				<div class="form-group row">
					<input id="id" type="hidden" class="form-control <?php $__errorArgs = ['id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="id" value="<?php echo e($user->id); ?>" required autocomplete="id">
					<label for="password" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Password')); ?></label>

					<div class="col-md-8">
						<input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required autocomplete="new-password">

						<?php $__errorArgs = ['password'];
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
					<label for="password-confirm" class="col-md-4 col-form-label text-md-right align-self-center"><?php echo e(__('Confirm')); ?></label>

					<div class="col-md-8">
						<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
					</div>
				</div>
				<hr />

				<button class="btn btn-primary btn-xl text-uppercase" id="sendMessageButton" type="submit">SUBMIT</button>
			</div>
		
	</form>
	
<?php $__env->stopSection(); ?>

<?php if (! $__env->hasRenderedOnce('22f5ddb3-8fe1-4de7-8cd1-da61a3dbd3af')): $__env->markAsRenderedOnce('22f5ddb3-8fe1-4de7-8cd1-da61a3dbd3af'); ?>
    <?php $__env->startPush('scripts'); ?>

		<script>
			function readURL(input) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();
				
					reader.onload = function(e) {
						jQuery('#imagePreview').attr('src', e.target.result);
						jQuery('#imagePreview').show();
					}
				
					reader.readAsDataURL(input.files[0]); 
				}
			}
			jQuery(document).ready(function(){
				jQuery("#imageInput").change(function() {
					readURL(this);
				});
			});
		</script>
	<?php $__env->stopPush(); ?>
<?php endif; ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/amicirev/public_html/resources/views/student/profile/changep.blade.php ENDPATH**/ ?>