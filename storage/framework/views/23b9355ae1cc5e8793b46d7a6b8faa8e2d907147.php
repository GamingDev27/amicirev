

<?php $__env->startSection('content'); ?>
	<div class="mt-4 mb-1">
		<form action="<?php echo e(route('admin_student_search')); ?>" method="POST" role="search">
			<?php echo csrf_field(); ?>
			<div class="form-row ">
				<div class="col-2">
					<h4 class="">Search Students</h4>
				</div>
				<div class="col-2">
					<input type="text" class="form-control" name="first_name" placeholder="FirstName">
				</div>
				<div class="col-2">
					<input type="text" class="form-control" name="last_name" placeholder="LastName">
				</div>
				<div class="col-2">
					<select type="text" class="form-control" name="email" >
						<option value="" ><em>EMAIL</em></option>
						<option value="1">VERIFIED</option>
						<option value="2">NOT YET</option>
					</select>
				</div>
				<div class="col-2">
					<select type="text" class="form-control" name="manual" >
						<option value="" ><em>MANUAL</em></option>
						<option value="1">VERIFIED</option>
						<option value="2">NOT YET</option>
					</select>
				</div>
				<div class="col-2">
					<button class="btn btn-outline-primary float-right" type="submit"> <i class="fas fa-magnify"></i> SEARCH</button> 
				</div>
			</div>
		</form>
	</div>
	<form action="<?php echo e(route('admin_student_search')); ?>" onsubmit="return confirm('Are you sure?');" method="POST" role="search">
		<?php echo csrf_field(); ?>
		<table class="table table-bordered table-condensed data-tbl" id="dataTable" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th>ID</th>
					<th></th>
					<th>FirstName</th>
					<th>LastName</th>
					<th>BirthDate</th>
					<th>Sex</th>
					<th>Email</th>
					<th>Registered</th>
					<th>Email Verification</th>
					<th>Manual Verification</th>
				</tr>
			</thead>
			
			<tbody>
				<?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><?php echo e($student->id); ?></td>
						<td>
							<input type="checkbox" name="students[<?php echo e($index); ?>][checked]" id="student_<?php echo e($student->id); ?>_checked" />
							<input type="hidden" name="students[<?php echo e($index); ?>][id]" value="<?php echo e($student->id); ?>" id="student_<?php echo e($student->id); ?>_id" />
							<input type="hidden" name="students[<?php echo e($index); ?>][user_id]" value="<?php echo e($student->user->id); ?>" id="student_<?php echo e($student->id); ?>_user_id" />
						</td>
						<td><?php echo e($student->first_name); ?></td>
						<td><?php echo e($student->last_name); ?></td>
						<td><?php echo e($student->birthdate); ?></td>
						<td><?php echo e($student->sex); ?></td>
						<td><?php echo e($student->user->email); ?></td>
						<td><?php echo e($student->user->created_at); ?></td>
						<td><?php echo e(strlen($student->user->email_verified_at)?'VERIFIED':'NOT YET'); ?></td>
						<td><?php echo e($student->user->verified?'VERIFIED':'NOT YET'); ?></td>
						
					</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
			<tfoot>	
				<tr>
					<td></td>
					<td colspan="2"> 
						<select type="text" class="form-control" name="manual_verify" >
							<option value="0"></option>
							<option value="1">VERIFY</option>
							<option value="2">UNVERIFY</option>
						</select>
					</td>
					<td colspan="7">
						<button class="btn btn-primary btn-xl text-uppercase" type="submit">SUBMIT</button>
					</td>
				</tr>
			</tfoot>
		</table>
	</form>
	<?php echo e($students->links()); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Dir\laravel\amici\resources\views/admin/students/search.blade.php ENDPATH**/ ?>