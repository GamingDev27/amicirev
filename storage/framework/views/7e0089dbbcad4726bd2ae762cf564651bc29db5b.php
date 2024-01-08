

<?php $__env->startSection('content'); ?>
	<h1 class="mt-4">Courses
	<a class="btn btn-outline-primary float-right" href="<?php echo e(route('admin_course_add')); ?>"> <i class="fas fa-plus"></i> ADD</a> 
	</h1>
	<table class="table table-bordered table-condensed data-tbl" id="dataTable" width="100%" cellspacing="0">
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Description</th>
				<th>Subjects</th>
				<th>Created Date</th>
				<th>Action</th>
			</tr>
		</thead>
		
		<tbody>
			<?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e($course->id); ?></td>
					<td><?php echo e($course->code); ?> - <?php echo e($course->name); ?></td>
					<td><?php echo e($course->description); ?></td>
					<td width="25%">
						<ul>
							<?php $__currentLoopData = $course->subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li><?php echo e(Str::limit($subject->name,20)); ?> <a class="btn btn-outline-primary m-0 p-0 px-1" href="<?php echo e(route('admin_subject_edit',$subject->id)); ?>"> <i class="fas fa-pencil-alt"></i> Edit</a> </li>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</ul>
					</td>
					<td><?php echo e($course->created_at); ?></td>
					<td>
						<a class="btn btn-outline-primary m-0 p-0 px-1" href="<?php echo e(route('admin_course_edit',$course->id)); ?>"> <i class="fas fa-pencil-alt"></i> Edit</a> 
						<a class="btn btn-outline-primary m-0 p-0 px-1" href="<?php echo e(route('admin_subject_add',$course->id)); ?>"> <i class="fas fa-pencil-alt"></i> Add Subject</a> 
					</td>
				</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tbody>
	</table>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Dir\laravel\amici\resources\views/admin/courses/index.blade.php ENDPATH**/ ?>