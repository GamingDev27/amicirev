<?php $__env->startSection('content'); ?>
	<h1 class="mt-4">Edit Batch
	</h1>
	
	<form method="POST" id="contentForm" action="<?php echo e(route('admin_batch_save')); ?>" >
		<?php echo csrf_field(); ?>
		<div class="row align-items-stretch mb-5">
			<div class="col-md-6">
				<div class="form-group">
					<input id="id" type="hidden" name="id" value="<?php echo e($batch->id); ?>" required >
					<input id="season_id" type="hidden" name="season_id" value="<?php echo e($batch->season_id); ?>" required >
					<input placeholder="Name*" id="name" type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="name" value="<?php echo e($batch->name); ?>" required autocomplete="name" autofocus>
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
						<textarea class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="description" name="description" placeholder="Description *" required autocomplete="description"><?php echo e($batch->description); ?></textarea>
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
unset($__errorArgs, $__bag); ?>" name="maximum" value="<?php echo e($batch->maximum); ?>" required autocomplete="maximum">
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
unset($__errorArgs, $__bag); ?>" name="sections"  value="<?php echo e($batch->sections); ?>" required autocomplete="sections">
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
unset($__errorArgs, $__bag); ?>" name="date_start"  value="<?php echo e($batch->date_start); ?>" required autocomplete="date_start" >
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
unset($__errorArgs, $__bag); ?>" name="date_end"  value="<?php echo e($batch->date_end); ?>" required autocomplete="date_end" >
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
				<div class="form-check">
					<input type="hidden" name="enabled" value="0" />
					<input class="form-check-input" type="checkbox" name="enabled" id="enabled" value="1" <?php echo e($batch->enabled ? 'checked' : ''); ?>>

					<label class="form-check-label" for="enabled">
						<?php echo e(__('Enabled')); ?>

					</label>
				</div>
				
				<hr />
				<button class="btn btn-primary btn-xl text-uppercase" id="sendMessageButton" type="submit">SUBMIT</button>
			</div>
			<div class="col-md-6 courses_subjects">
				<ul class="list-group list-group-flush">
					<?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php
							$hassubj = false;
						?>
						<?php $__currentLoopData = $course->subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index2 => $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php if(!isset($classes[$course->id][$subject->id])): ?>
								<?php
									$hassubj = true;
									break;
								?>
							<?php endif; ?>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php if($hassubj): ?>
							<li class="list-group-item">
								<input type="checkbox" name="courses[<?php echo e($index); ?>][checked]" id="course_<?php echo e($course->id); ?>_checked" />
								<input type="hidden" name="courses[<?php echo e($index); ?>][id]" value="<?php echo e($course->id); ?>" id="course_<?php echo e($course->id); ?>_id" />
								<label for="course_<?php echo e($course->id); ?>_checked" > <b><?php echo e($course->name); ?></b> </label>
								<br />
								<?php $__currentLoopData = $course->subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index2 => $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php if(!isset($classes[$course->id][$subject->id])): ?>
										<span class="badge badge-light" style="font-weight:normal;">
											<input type="checkbox" name="courses[<?php echo e($index); ?>][subjects][<?php echo e($index2); ?>][checked]" id="course_<?php echo e($course->id); ?>_subject_<?php echo e($subject->id); ?>_checked" />
											<input type="hidden" name="courses[<?php echo e($index); ?>][subjects][<?php echo e($index2); ?>][id]" value="<?php echo e($subject->id); ?>" id="course_<?php echo e($course->id); ?>_subject_<?php echo e($subject->id); ?>_id" />
											<label for="course_<?php echo e($course->id); ?>_subject_<?php echo e($subject->id); ?>_checked" > <?php echo e($subject->name); ?>(<?php echo e($subject->code); ?>) </label>
										</span>
									<?php endif; ?>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</li>	
						<?php endif; ?>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</ul>
			</div>
		</div>
		
	</form>
	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/amicirev/public_html/resources/views/admin/batches/edit.blade.php ENDPATH**/ ?>