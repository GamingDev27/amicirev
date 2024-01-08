<?php $__env->startSection('content'); ?>
	<h1 class="mt-4">Seasons</h1>
	<table class="table table-bordered table-condensed data-tbl" id="dataTable" width="100%" cellspacing="0">
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Description</th>
				<th>Exam Date</th>
				<th>Created Date</th>
				<th>Action</th>
			</tr>
		</thead>
		
		<tbody>
			<?php $__currentLoopData = $seasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $season): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e($season->id); ?></td>
					<td><?php echo e($season->name); ?></td>
					<td><?php echo e($season->description); ?></td>
					<td><?php echo e($season->exam_date_start); ?></td>
					<td><?php echo e($season->created_at); ?></td>
					<td>
						<a class="btn btn-outline-primary" href="<?php echo e(route('admin_season_edit',$season->id)); ?>"> <i class="fas fa-pencil-alt"></i> Edit</a> 
						<a class="btn btn-outline-primary" href="<?php echo e(route('admin_batch_index',$season->id)); ?>"> <i class="fas fa-pencil-alt"></i> Batches</a> 
					</td>
				</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tbody>
	</table>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/amicirev/public_html/resources/views/admin/seasons/index.blade.php ENDPATH**/ ?>