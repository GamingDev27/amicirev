<?php $__env->startSection('content'); ?>
	<h3 class="mt-4">Edit Coach
		<a class="btn btn-outline-primary float-right" href="<?php echo e(route('admin_coaches')); ?>"> <i class="fas fa-reply"></i> BACK </a> 
	</h3>
	
	<form method="POST" id="contentForm" action="<?php echo e(route('admin_coach_save')); ?>" enctype="multipart/form-data">
		<?php echo csrf_field(); ?>
		<div class="row align-items-stretch mb-5">
			<div class="col-md-4">
				<?php if(isset($coach->image) && strlen($coach->image)): ?>
					<input type="file" id="imageInput" name="image" >
					<img class="mx-auto rounded-circle" id="imagePreview" alt="Image Preview Here" src="/images/<?php echo e($coach->image); ?>" style="max-width:80%;" />
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
					
					<select name="salutation"id="salutation" class="form-control <?php $__errorArgs = ['salutation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="salutation" value="<?php echo e($coach->salutation); ?>" required autocomplete="salutation" autofocus >
						<option value=""></option>
						<option value="MR" selected="<?php echo e(($coach->salutation == 'MR')?'selected':''); ?>">MR</option>
						<option value="MS" selected="<?php echo e(($coach->salutation == 'MS')?'selected':''); ?>">MS</option>
						<option value="MRS" selected="<?php echo e(($coach->salutation == 'MRS')?'selected':''); ?>">MRS</option>
						<option value="DR" selected="<?php echo e(($coach->salutation == 'DR')?'selected':''); ?>">DR</option>
						<option value="PROF" selected="<?php echo e(($coach->salutation == 'PROF')?'selected':''); ?>">PROF</option>
						<option value="OFFICER" selected="<?php echo e(($coach->salutation == 'OFFICER')?'selected':''); ?>">OFFICER</option>
					</select>
					<?php $__errorArgs = ['salutation'];
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
					<input id="id" type="hidden" name="id" value="<?php echo e($coach->id); ?>" />
					<input placeholder="FirstName*" id="first_name" type="text" class="form-control <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="first_name" value="<?php echo e($coach->first_name); ?>" required autocomplete="first_name" autofocus>
					<?php $__errorArgs = ['first_name'];
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
					<input placeholder="MiddleName*" id="middle_name" type="text" class="form-control <?php $__errorArgs = ['middle_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="middle_name" value="<?php echo e($coach->middle_name); ?>" required autocomplete="middle_name" >
					<?php $__errorArgs = ['middle_name'];
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
					<input placeholder="LastName*" id="last_name" type="text" class="form-control <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="last_name" value="<?php echo e($coach->last_name); ?>" required autocomplete="last_name" >
					<?php $__errorArgs = ['last_name'];
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
					<input placeholder="PRC LICENSE*" id="license" type="text" class="form-control <?php $__errorArgs = ['license'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="license" value="<?php echo e($coach->license); ?>" required autocomplete="license" >
					<?php $__errorArgs = ['license'];
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
					<input placeholder="Title*" id="title" type="text" class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="title" value="<?php echo e($coach->title); ?>" required autocomplete="title" >

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
				<div class="form-check">
					<input type="hidden" name="enabled" value="0" />
					<input class="form-check-input" type="checkbox" name="enabled" id="enabled" value="1" <?php echo e($coach->enabled ? 'checked' : ''); ?>>

					<label class="form-check-label" for="enabled">
						<?php echo e(__('Enabled')); ?>

					</label>
				</div>
				
				<div class="form-group mb-md-0">
					
					<div class="form-group form-group-textarea mb-md-0">
						<textarea class="form-control <?php $__errorArgs = ['accomplishments'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="accomplishments" name="accomplishments" placeholder="Accomplishments *" ><?php echo e($coach->accomplishments); ?></textarea>
					</div>
					<?php $__errorArgs = ['accomplishments'];
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
				<hr />
				<button class="btn btn-primary btn-xl text-uppercase" id="sendMessageButton" type="submit">SUBMIT</button>
			</div>
		</div>
		
	</form>
	
<?php $__env->stopSection(); ?>

<?php if (! $__env->hasRenderedOnce('9a63b798-f7a8-43fe-9027-6e00fdcc82b9')): $__env->markAsRenderedOnce('9a63b798-f7a8-43fe-9027-6e00fdcc82b9'); ?>
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
				ClassicEditor
					.create( document.querySelector( '#accomplishments' ), {
						// toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
					} )
					.then( editor => {
						editor.ui.view.editable.element.style.height = '300px';
						window.editor = editor;
					} )
					.catch( err => {
						console.error( err.stack );
					} );
			});
		</script>
	<?php $__env->stopPush(); ?>
<?php endif; ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/amicirev/public_html/resources/views/admin/coaches/edit.blade.php ENDPATH**/ ?>