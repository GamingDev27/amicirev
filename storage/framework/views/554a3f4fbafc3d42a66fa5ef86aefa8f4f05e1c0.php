<?php $__env->startSection('content'); ?>
	<h1 class="mt-4">Edit Contact Page</h1>

	<form method="POST" id="contentForm" action="<?php echo e(route('admin_save_content')); ?>">
		<?php echo csrf_field(); ?>
		<div class="form-group">
			<input id="id" type="hidden"  name="id" value="<?php echo e($about->id); ?>" />
			<input id="type" type="hidden"  name="type" value="<?php echo e($type); ?>" />
			<input id="redirectTo" type="hidden"  name="redirectTo" value="admin_contact" />
			<input id="description" type="hidden"  name="description" value="<?php echo e($about->description); ?>" />
			<input placeholder="Title*" id="title" type="text" class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="title" value="<?php echo e($about->title); ?>" required autocomplete="title" autofocus>
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
			<input placeholder="Subtitle*" id="description" type="text"  name="description" value="<?php echo e($about->description); ?>" />
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
unset($__errorArgs, $__bag); ?>" id="details" name="details" rows="10" placeholder="Description *" required autocomplete="details"><?php echo e($about->details); ?></textarea>
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
		<hr />
		<button class="btn btn-primary btn-xl text-uppercase" id="sendMessageButton" type="submit">SUBMIT</button>
	</form>
	
<?php $__env->stopSection(); ?>

<?php if (! $__env->hasRenderedOnce('a67e84bb-f820-4195-bcdf-24fc842a2119')): $__env->markAsRenderedOnce('a67e84bb-f820-4195-bcdf-24fc842a2119'); ?>
    <?php $__env->startPush('scripts'); ?>

		<script>
			
			jQuery(document).ready(function(){
				ClassicEditor
				.create( document.querySelector( '#details' ), {
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


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/amicirev/public_html/resources/views/admin/contents/contact.blade.php ENDPATH**/ ?>