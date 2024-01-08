<?php $__env->startSection('content'); ?>

	<div class="mt-4 mb-1">
		<!--<form action="<?php echo e(route('admin_student_search')); ?>" method="POST" role="search">-->
		<form action="<?php echo e(route('admin_batch_student',$batch->id)); ?>" method="POST" role="search">
			<?php echo csrf_field(); ?>
			<div class="form-row ">
				<div class="col-2">
					<h4 class=""> Manage Students </h4>
				</div>
				<div class="col-2">
					<input type="text" class="form-control" name="search[first_name]" placeholder="FirstName" value="<?php echo e(isset($search['first_name'])?$search['first_name']:''); ?>"/>
				</div>
				<div class="col-2">
					<input type="text" class="form-control" name="search[last_name]" placeholder="LastName" value="<?php echo e(isset($search['last_name'])?$search['last_name']:''); ?>"/>
				</div>
				<div class="col-2">
					<select type="text" class="form-control" name="search[verified]"  value="<?php echo e(isset($search['verified'])?$search['verified']:''); ?>">
						<option value=""></option>
						<option value="1">VERIFIED</option>
						<option value="0">NOT YET</option>
					</select>
				</div>
				<div class="col-2">
					<button class="btn btn-outline-primary" type="submit"> <i class="fas fa-magnify"></i> SEARCH</button> 
				</div>
				
			</div>
		</form>
	</div>
	<form action="<?php echo e(route('admin_batch_student',$batch->id)); ?>" onsubmit="return confirm('Are you sure?');" method="POST" >
		<?php echo csrf_field(); ?>
		<table class="table table-bordered table-condensed data-tbl" id="dataTable" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th>ID</th>
					<th>
						<input type="checkbox" id="checkAllBelow()" />
					</th>
					<th width="100px">VERIFY</th>
					<th width="100px">PAID AMOUNT</th>
					<th width="150px">PAYMENT</th>
					<th width="100px">OUTCOME</th>
					<th>NAME</th>
					<th>BirthDate</th>
					<th>Sex</th>
					<th>Email</th>
					<th>Mobile</th>
					<th>Date Enrolled</th>
				</tr>
			</thead>
			<tbody>
				<?php if(isset($enrolledstudents)): ?>
					<?php $__currentLoopData = $enrolledstudents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $enrollment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td><?php echo e($enrollment->id); ?></td>
							<td>
								<input type="checkbox" name="enrollments[<?php echo e($index); ?>][checked]" id="enrollment_<?php echo e($enrollment->id); ?>_checked" />
								<input type="hidden" name="enrollments[<?php echo e($index); ?>][id]" value="<?php echo e($enrollment->id); ?>" id="enrollment_<?php echo e($enrollment->id); ?>_id" />
							</td>
							<td>
								<div class="form-group">
										
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" <?php echo e(($enrollment->verified == 1)?'checked="checked"':''); ?> required name="enrollments[<?php echo e($index); ?>][verified]" id="verified<?php echo e($index); ?>_1" value="1">
										<label class="form-check-label" for="verified<?php echo e($index); ?>_1"> VERIFY </label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" <?php echo e(($enrollment->verified == 0)?'checked="checked"':''); ?> required name="enrollments[<?php echo e($index); ?>][verified]" id="verified<?php echo e($index); ?>_0" value="0">
										<label class="form-check-label" for="verified<?php echo e($index); ?>_0"> NOTYET </label>
									</div>
									<?php $__errorArgs = ['sex'];
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
							</td>
							<td>
								<input type="number" class="form-control p-0"name="enrollments[<?php echo e($index); ?>][amount_paid]" value="<?php echo e($enrollment->amount_paid); ?>" id="enrollment_<?php echo e($enrollment->amount_paid); ?>" />
							</td>
							<td>
								<select class="form-control" name="enrollments[<?php echo e($index); ?>][payment_status]" >
									<?php $__currentLoopData = $paymentstatuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paymentstatusid => $paymentstatus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($paymentstatusid); ?>" <?php echo e(($enrollment->payment_status == $paymentstatusid)?'selected="selected"':''); ?>><?php echo e($paymentstatus); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
							</td>
							<td>
								<select class="form-control" name="enrollments[<?php echo e($index); ?>][passed]" >
									<option value="" ></option>
									<option value="1" <?php echo e(($enrollment->passed === 1)?'selected="selected"':''); ?>>PASSED</option>
									<option value="0" <?php echo e(($enrollment->passed === 0)?'selected="selected"':''); ?>>FAILED</option>
								</select>
							</td>
							<td>
								<?php echo e($enrollment->student->last_name); ?>, 
								<?php echo e($enrollment->student->first_name); ?> 
								<?php echo e($enrollment->student->middle_name); ?>

							</td>
							<td><?php echo e($enrollment->student->birthdate); ?></td>
							<td><?php echo e($enrollment->student->sex); ?></td>
							<td><?php echo e($enrollment->student->user->email); ?></td>
							<td><?php echo e($enrollment->student->mobile); ?></td>
							<td><?php echo e(date('m/d/Y H:i',strtotime($enrollment->created_at))); ?></td>
							
						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>
			</tbody>
			<tfoot>	
				<tr>
					<td colspan="11">
						<button class="btn btn-primary btn-xl text-uppercase" type="submit">SUBMIT</button>
					</td>
				</tr>
			</tfoot>
		</table>
	</form>
	<br />
	<?php echo e($enrolledstudents->links()); ?>

<?php $__env->stopSection(); ?>

<?php if (! $__env->hasRenderedOnce('c114e7df-47bb-47f7-8d3e-38274559d45d')): $__env->markAsRenderedOnce('c114e7df-47bb-47f7-8d3e-38274559d45d'); ?>
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/amicirev/public_html/resources/views/admin/batches/students.blade.php ENDPATH**/ ?>