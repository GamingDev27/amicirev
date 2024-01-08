<?php $__env->startSection('content'); ?>
	<h4 class="mt-2">
		Account
	</h4>
	<hr />
	<div class="row">
		<div class="col-12  col-xl-3  col-lg-3 col-md-3" align="center">
			<?php if($user->student->image): ?>
				<img style="width:90%;" src="/images/<?php echo e($user->student->image); ?>">
			<?php endif; ?>
		</div>	
		<div class="col-12  col-xl-9  col-lg-9 col-md-9">
			<table class="table no-border">
				<tr>
					<td colspan="2">
						<h5>
							<?php echo e(strtoupper($user->student->last_name)); ?>,
							<?php echo e(strtoupper($user->student->first_name)); ?>

							<?php echo e(strtoupper($user->student->middle_name)); ?>

						</h5>
					</td>
				</tr>
				<tr>
					<td width="20%"><b>BIRTHDATE:</b></td>
					<td ><?php echo e(date('F d, Y',strtotime($user->student->birthdate))); ?></td>
				</tr>
				<tr>
					<td><b>GENDER:</b></td>
					<td ><?php echo e($user->student->sex); ?></td>
				</tr>
				<tr>
					<td><b>ADDRESS:</b></td>
					<td >
						<?php if($user->student->address): ?>
							<?php echo e($user->student->address->house_lot); ?>,
							<?php echo e($user->student->address->street); ?>,
							<?php echo e($user->student->address->barangay->name); ?>,
							<?php echo e($user->student->address->city->name); ?>,
							<?php echo e($user->student->address->province->name); ?>

						<?php endif; ?>
					</td>
				</tr>
				<tr>
					<td><b>EMAIL:</b></td>
					<td ><?php echo e($user->email); ?></td>
				</tr>
				<tr>
					<td><b>MOBILE:</b></td>
					<td ><?php echo e($user->student->mobile); ?></td>
				</tr>
				<tr>
					<td><b>SCHOOL:</b></td>
					<td >
						<?php if($user->student->school): ?>
							<?php echo e($user->student->school->name); ?>

						<?php endif; ?>
					</td>
				</tr>
				<tr>
					<td><b>YEAR GRADUATED:</b></td>
					<td >
						<?php echo e($user->student->year_graduated); ?>

					</td>
				</tr>
				<tr>
					<td colspan="2">
						<a class="btn btn-outline-primary" href="<?php echo e(route('student_profile_edit')); ?>">
							EDIT ACCOUNT
						</a>
						<a class="btn btn-outline-primary" href="<?php echo e(route('student_profile_changep')); ?>">
							CHANGE PASSWORD
						</a>
					</td>
				</tr>
			</table>
			
		</div>
	</div>
	
<?php $__env->stopSection(); ?>
<?php if (! $__env->hasRenderedOnce('2159621d-87b7-446e-91ef-985b29c708ec')): $__env->markAsRenderedOnce('2159621d-87b7-446e-91ef-985b29c708ec'); ?>
	<?php $__env->startPush('scripts'); ?>

		<script>
			$(document).ready(function(){
				
			});


			
		</script>

		
	<?php $__env->stopPush(); ?>
<?php endif; ?>
<?php echo $__env->make('layouts.student', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/amicirev/public_html/resources/views/student/profile/index.blade.php ENDPATH**/ ?>