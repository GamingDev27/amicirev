<?php $__env->startSection('content'); ?>
	<h1 class="mt-4">Team Members
		<a class="btn btn-outline-primary float-right" href="<?php echo e(route('admin_team_add')); ?>"> <i class="fas fa-plus"></i> ADD</a> 
	</h1>
	
	<table class="table table-bordered table-condensed data-tbl" id="dataTable" width="100%" cellspacing="0">
		<thead>
			<tr>
				<th>No</th>
				<th>Picture</th>
				<th>Name</th>
				<th>Title</th>
				<th>Description</th>
				<th>Status</th>
				<th>Date Added</th>
				<th>Action</th>
			</tr>
		</thead>
		
		<tbody>
			<?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e($member->id); ?></td>
					<td>
						<img class="mx-auto rounded-circle" src="/images/<?php echo e($member->image); ?>" style="max-width:150px;" />
					</td>
					<td><?php echo e($member->title); ?></td>
					<td><?php echo e($member->description); ?></td>
					<td><?php echo $member->details; ?></td>
					<td><?php echo e($member->enabled ? 'enabled':'disabled'); ?></td>
					<td><?php echo e($member->created_at); ?></td>
					<td>
						<a class="btn btn-outline-primary" href="<?php echo e(route('admin_team_edit',$member->id)); ?>"> <i class="fas fa-pencil"></i> Edit</button> 
					
					</td>
				</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tbody>
	</table>
	
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/amicirev/public_html/resources/views/admin/contents/team.blade.php ENDPATH**/ ?>