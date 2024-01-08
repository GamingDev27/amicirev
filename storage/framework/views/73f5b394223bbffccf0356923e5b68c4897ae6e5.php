<?php $__env->startSection('content'); ?>
	<h1 class="mt-4">Messages</h1>
	<table class="table table-bordered table-condensed data-tbl" id="dataTable" width="100%" cellspacing="0">
		<thead>
			<tr>
				<th>No</th>
				<th>Date</th>
				<th>Name</th>
				<th>Email</th>
				<th>Mobile</th>
				<th>Message</th>
				<th>Action</th>
			</tr>
		</thead>
		
		<tbody>
			<?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e($message->id); ?></td>
					<td><?php echo e($message->created_at); ?></td>
					<td><?php echo e($message->name); ?></td>
					<td><?php echo e($message->email); ?></td>
					<td><?php echo e($message->phone); ?></td>
					<td><?php echo $message->message; ?></td>
					<td>
						<button class="btn btn-outline-primary" onclick="window.location.href = 'mailto: <?php echo e($message->email); ?>'"> <i class="fas fa-reply"></i> Reply</button> 
					</td>
				</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tbody>
	</table>
	<?php echo e($messages->links()); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/amicirev/public_html/resources/views/admin/messages/index.blade.php ENDPATH**/ ?>