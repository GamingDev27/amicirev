<?php $__env->startSection('content'); ?>
	<h4 class="mt-4">
		Add Batch for <?php echo e($season->name); ?>

		<span class="badge badge-light float-right" style="font-weight:normal;">
			<input type="checkbox" id="all" onclick="checkAll(this);" />
			<label for="all" > CHECK/UNCHECK ALL </label>
		</span>
	</h4>
	
	<form method="POST" id="contentForm" action="<?php echo e(route('admin_batch_save')); ?>" >
		<?php echo csrf_field(); ?>
		<div class="row align-items-stretch mb-5">
			<div class="col-md-6">
				<div class="form-group">
					<input id="season_id" type="hidden" name="season_id" value="<?php echo e($season->id); ?>">
					<input placeholder="Name*" id="name" type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="name" value="<?php echo e(old('name')); ?>" required autocomplete="name" autofocus>
					<?php $__errorArgs = ['name'];
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
						<textarea rows="5" class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="description" name="description" placeholder="Description *" required autocomplete="description"></textarea>
						<p class="help-block text-danger"></p>
					</div>
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
				<div class="form-group">
					<input placeholder="Slot*" id="maximum" type="number" class="form-control <?php $__errorArgs = ['maximum'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="maximum" value="<?php echo e(old('maximum')); ?>" required autocomplete="maximum">
					<?php $__errorArgs = ['maximum'];
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
					<input placeholder="Sections*" id="sections" type="number" class="form-control <?php $__errorArgs = ['sections'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="sections" value="<?php echo e(old('sections')); ?>" required autocomplete="sections">
					<?php $__errorArgs = ['sections'];
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
					<input placeholder="Registration Start Date*" id="date_start" type="date" class="form-control <?php $__errorArgs = ['date_start'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="date_start" value="<?php echo e(old('date_start')); ?>" required autocomplete="date_start" >
					<?php $__errorArgs = ['date_start'];
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
					<input placeholder="Registration End Date*" id="date_end" type="date" class="form-control <?php $__errorArgs = ['date_end'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="date_end" value="<?php echo e(old('date_end')); ?>" required autocomplete="date_end" >
					<?php $__errorArgs = ['date_end'];
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
			</div>
			<div class="col-md-6 courses_subjects">
				<ul class="list-group list-group-flush">
					<?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<li class="list-group-item">
							<input type="checkbox" name="courses[<?php echo e($index); ?>][checked]" id="course_<?php echo e($course->id); ?>_checked" />
							<input type="hidden" name="courses[<?php echo e($index); ?>][id]" value="<?php echo e($course->id); ?>" id="course_<?php echo e($course->id); ?>_id" />
							<label for="course_<?php echo e($course->id); ?>_checked" > <b><?php echo e($course->name); ?></b> </label>
							<br />
							<?php $__currentLoopData = $course->subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index2 => $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<span class="badge badge-light" style="font-weight:normal;">
									<input type="checkbox" name="courses[<?php echo e($index); ?>][subjects][<?php echo e($index2); ?>][checked]" id="course_<?php echo e($course->id); ?>_subject_<?php echo e($subject->id); ?>_checked" />
									<input type="hidden" name="courses[<?php echo e($index); ?>][subjects][<?php echo e($index2); ?>][id]" value="<?php echo e($subject->id); ?>" id="course_<?php echo e($course->id); ?>_subject_<?php echo e($subject->id); ?>_id" />
									<label for="course_<?php echo e($course->id); ?>_subject_<?php echo e($subject->id); ?>_checked" > <?php echo e($subject->name); ?> </label>
								</span>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</li>	
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</ul>
			</div>
		</div>
		<hr />
		<button class="btn btn-primary btn-xl text-uppercase" id="sendMessageButton" type="submit">SUBMIT</button>
	
	</form>
	
<?php $__env->stopSection(); ?>



<?php if (! $__env->hasRenderedOnce('3acb261c-bab6-4d75-8963-5a452ae64cd6')): $__env->markAsRenderedOnce('3acb261c-bab6-4d75-8963-5a452ae64cd6'); ?>
    <?php $__env->startPush('scripts'); ?>

		<script>
			function checkAll(input) {
				current = jQuery(input).prop("checked");
				console.log('checked');
				console.log(current);
				jQuery(".courses_subjects input[type=checkbox]").each(function() {
					jQuery(this).prop("checked", current);
				});
			}
			
		</script>
	<?php $__env->stopPush(); ?>
<?php endif; ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/amicirev/public_html/resources/views/admin/batches/add.blade.php ENDPATH**/ ?>