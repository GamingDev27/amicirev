

<?php $__env->startSection('content'); ?>
	<h1 class="mt-4">Courses
	<a class="btn btn-outline-primary float-right" href="<?php echo e(route('admin_user_add')); ?>"> <i class="fas fa-plus"></i> ADD</a> 
	</h1>
	<table class="table table-bordered table-condensed data-tbl" id="dataTable" width="100%" cellspacing="0">
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Email</th>
				<th>Enabled</th>
				<th>Created Date</th>
				<th>Action</th>
			</tr>
		</thead>
		
		<tbody>
			<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e($user->id); ?></td>
					<td><?php echo e($user->name); ?></td>
					<td><?php echo e($user->email); ?></td>
					<td>
						<?php echo e($user->verified ? 'YES':'NO'); ?>

					</td>
					<td><?php echo e($user->created_at); ?></td>
					<td>
						<a class="btn btn-outline-primary m-0 p-0 px-1" href="<?php echo e(route('admin_user_edit',$user->id)); ?>"> <i class="fas fa-pencil-alt"></i> Edit</a> 
					</td>
				</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tbody>
	</table>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Dir\laravel\amici\resources\views/admin/users/index.blade.php ENDPATH**/ ?>