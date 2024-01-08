<?php $__env->startSection('content'); ?>
	<h1 class="mt-4">Batchs</h1>
	<table class="table table-bordered table-condensed data-tbl" id="dataTable" width="100%" cellspacing="0">
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Description</th>
				<th>Enabled</th>
				<th>Created Date</th>
				<th>Action</th>
			</tr>
		</thead>
		
		<tbody>
			<?php $__currentLoopData = $batchs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $batch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e($batch->id); ?></td>
					<td><?php echo e($batch->name); ?></td>
					<td><?php echo e($batch->description); ?></td>
					<td><?php echo e($batch->enabled?'YES':'NO'); ?></td>
					<td><?php echo e($batch->created_at); ?></td>
					<td>
						<a class="btn btn-outline-primary" href="<?php echo e(route('admin_batch_edit',$batch->id)); ?>"> <i class="fas fa-pencil-alt"></i> Edit</a> 
					</td>
				</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tbody>
	</table>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/amicirev/public_html/resources/views/admin/batches/index.blade.php ENDPATH**/ ?>