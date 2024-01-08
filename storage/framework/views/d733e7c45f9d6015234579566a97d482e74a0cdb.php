

<?php $__env->startSection('content'); ?>
	<h3 class="mt-4">Coaches
		<a class="btn btn-outline-primary float-right" href="<?php echo e(route('admin_coach_add')); ?>"> <i class="fas fa-plus"></i> ADD</a> 
	</h3>
	
	<table class="table table-bordered table-condensed data-tbl" id="dataTable" width="100%" cellspacing="0">
		<thead>
			<tr>
				<th>ID</th>
				<th>Picture</th>
				<th>Name</th>
				<th>Title</th>
				<th>PRC License</th>
				<th>Accomplishments</th>
				<th>Status</th>
				<th>Date Added</th>
				<th>Action</th>
			</tr>
		</thead>
		
		<tbody>
			<?php $__currentLoopData = $coachs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $coach): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e($coach->id); ?></td>
					<td>
						<img class="mx-auto rounded-circle" src="/images/<?php echo e($coach->image); ?>" style="max-width:150px;" />
					</td>
					<td> <?php echo e($coach->salutation); ?> <?php echo e($coach->first_name); ?> <?php echo e($coach->middle_name); ?> <?php echo e($coach->last_name); ?></td>
					<td><?php echo e($coach->title); ?></td>
					<td><?php echo e($coach->license); ?></td>
					<td><?php echo $coach->accomplishments; ?></td>
					<td><?php echo e($coach->enabled ? 'enabled':'disabled'); ?></td>
					<td><?php echo e($coach->created_at); ?></td>
					<td>
						<a class="btn btn-outline-primary" href="<?php echo e(route('admin_coach_edit',$coach->id)); ?>"> <i class="fas fa-pencil"></i> Edit</button> 
					
					</td>
				</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tbody>
	</table>
	
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Dir\laravel\amici\resources\views/admin/coaches/index.blade.php ENDPATH**/ ?>