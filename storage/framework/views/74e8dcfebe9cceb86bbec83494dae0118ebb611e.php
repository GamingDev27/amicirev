<?php $__env->startSection('content'); ?>
	<h3 class="mt-4">Edit Account
		<a class="btn btn-outline-primary float-right" href="<?php echo e(route('student_profile')); ?>"> <i class="fas fa-reply"></i> BACK </a> 
	</h3>
	
	<form method="POST" id="contentForm" action="<?php echo e(route('student_profile_save')); ?>" enctype="multipart/form-data">
		<?php echo csrf_field(); ?>
		<div class="row align-items-stretch mb-5">
			<div class="col-md-4">
				<?php if(isset($user->student->image) && strlen($user->student->image)): ?>
					<input type="file" id="imageInput" name="image" >
					<img class="mx-auto rounded-circle" id="imagePreview" alt="Image Preview Here" src="/images/<?php echo e($user->student->image); ?>" style="max-width:80%;" />
				<?php else: ?>
					<input type="file" id="imageInput" required name="image" >
					<img class="mx-auto rounded-circle" id="imagePreview" alt="Image Preview Here" style="max-width:80%;display:none;" />
				<?php endif; ?>
				<?php $__errorArgs = ['image'];
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
			<div class="col-md-8">
				<div class="form-group row">
					<label for="mobile" class="col-md-2 col-form-label text-md-right"><?php echo e(__('FIRSTNAME')); ?></label>
					<input id="id" type="hidden" name="id" value="<?php echo e($user->student->id); ?>" />
					<input id="first_name" type="text" class="form-control col-md-10  <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="first_name" value="<?php echo e($user->student->first_name); ?>" required autocomplete="first_name" autofocus>
					<?php $__errorArgs = ['first_name'];
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
				<div class="form-group row">
					<label for="mobile" class="col-md-2 col-form-label text-md-right"><?php echo e(__('MIDDLENAME')); ?></label>
					<input id="middle_name" type="text" class="form-control col-md-10 <?php $__errorArgs = ['middle_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="middle_name" value="<?php echo e($user->student->middle_name); ?>" required autocomplete="middle_name" >
					<?php $__errorArgs = ['middle_name'];
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
				<div class="form-group row">
				<label for="mobile" class="col-md-2 col-form-label text-md-right"><?php echo e(__('LASTNAME')); ?></label>
					<input id="last_name" type="text" class="form-control col-md-10 <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="last_name" value="<?php echo e($user->student->last_name); ?>" required autocomplete="last_name" >
					<?php $__errorArgs = ['last_name'];
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
				<div class="row">

					<label for="mobile" class="col-md-2 col-form-label text-md-right"><?php echo e(__('BIRTHDATE')); ?></label>
					<div class="form-group col-4">
						<input id="birthdate" type="date" class="form-control <?php $__errorArgs = ['birthdate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="birthdate" value="<?php echo e($user->student->birthdate); ?>" required autocomplete="birthdate" >
						<?php $__errorArgs = ['birthdate'];
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
					<label for="mobile" class="col-md-2 col-form-label text-md-right"><?php echo e(__('GENDER')); ?></label>
					<div class="form-group  col-4">
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" <?php echo e($user->student->sex =='M'?'checked="checked"':''); ?> required name="sex" id="sexM" value="M">
							<label class="form-check-label" for="sexM"> MALE </label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" <?php echo e($user->student->sex =='F'?'checked="checked"':''); ?> required name="sex" id="sexF" value="F">
							<label class="form-check-label" for="sexF"> FEMALE </label>
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
				</div>
				<hr />
				<div class="form-group row">
					<label for="mobile" class="col-md-2 col-form-label text-md-right"><?php echo e(__('SCHOOL')); ?></label>
					<div class="col-md-4">
						<select id="school_id" class="form-control <?php $__errorArgs = ['school_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="school_id" value="<?php echo e(old('school_id')); ?>" required >
							<?php $__currentLoopData = $schools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schoolid => $school): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($schoolid); ?>" <?php echo e($user->student->school_id ==$schoolid?'selected="selected"':''); ?>><?php echo e($school); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
						<?php $__errorArgs = ['school_id'];
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
					<label for="year_graduated" class="col-md-2 col-form-label text-md-right"><?php echo e(__('GRADUATED')); ?></label>
					<div class="col-md-4">
						<input id="year_graduated" type="number" min="2000" max="<?php echo e(date('Y')); ?>" step="1" class="form-control <?php $__errorArgs = ['year_graduated'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="year_graduated" value="<?php echo e($user->student->year_graduated); ?>" required autocomplete="year_graduated" >
						<?php $__errorArgs = ['year_graduated'];
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
				</div>
				<div class="form-group row">
					<input id="id" type="hidden" name="address_id" value="<?php echo e($user->student->address->id); ?>" />
					<label for="mobile" class="col-md-2 col-form-label text-md-right"><?php echo e(__('PROVINCE')); ?></label>
					<div class="col-md-4">
						<select id="province_id" onchange="setProvince(this);" class="form-control <?php $__errorArgs = ['province_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="province_id" required >
							<option value=""></option>
							<?php $__currentLoopData = $provinces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $provinceid => $province): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($provinceid); ?>" <?php echo e($user->student->address->province_id == $provinceid?'selected="selected"':''); ?>><?php echo e($province); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
						<?php $__errorArgs = ['province_id'];
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
					<label for="mobile" class="col-md-2 col-form-label text-md-right"><?php echo e(__('City')); ?></label>
					<div class="col-md-4">
						<select id="city_id" onchange="setCity(this);" class="form-control <?php $__errorArgs = ['city_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="city_id" required >
							<?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cityid => $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($cityid); ?>" <?php echo e($user->student->address->city_id ==$cityid?'selected="selected"':''); ?>><?php echo e($city); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
						<?php $__errorArgs = ['city_id'];
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
				</div>
				<div class="form-group row">
					<label for="mobile" class="col-md-2 col-form-label text-md-right"><?php echo e(__('Barangay')); ?></label>
					<div class="col-md-4">
						<select id="barangay_id" class="form-control <?php $__errorArgs = ['barangay_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="barangay_id" required >
							<?php $__currentLoopData = $barangays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $barangayid => $barangay): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($barangayid); ?>" <?php echo e($user->student->barangay_id ==$barangayid?'selected="selected"':''); ?> ><?php echo e($barangay); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
						<?php $__errorArgs = ['barangay_id'];
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
					<label for="street" class="col-md-2 col-form-label text-md-right"><?php echo e(__('Street')); ?></label>
					<div class="col-md-4">
						<input id="street" type="text" class="form-control <?php $__errorArgs = ['street'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="street" value="<?php echo e($user->student->address->street); ?>" autocomplete="street" >
						<?php $__errorArgs = ['street'];
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
				</div>
					
				<div class="form-group row">
					<label for="house_lot" class="col-md-2 col-form-label text-md-right"><?php echo e(__('House No.')); ?></label>
					<div class="col-md-4">
						<input id="house_lot" type="text" class="form-control <?php $__errorArgs = ['house_lot'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="house_lot" value="<?php echo e($user->student->address->house_lot); ?>" autocomplete="house_lot" >
						<?php $__errorArgs = ['house_lot'];
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
					<label for="mobile" class="col-md-2 col-form-label text-md-right"><?php echo e(__('Mobile No')); ?></label>
					<div class="col-md-4">
						<input id="mobile" type="text" class="form-control <?php $__errorArgs = ['mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="mobile" value="<?php echo e($user->student->mobile); ?>" required autocomplete="mobile" >
						<?php $__errorArgs = ['mobile'];
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
				</div>
				<hr />

				<button class="btn btn-primary btn-xl text-uppercase" id="sendMessageButton" type="submit">SUBMIT</button>
			</div>
		</div>
		
	</form>
	
<?php $__env->stopSection(); ?>

<?php if (! $__env->hasRenderedOnce('c9354f04-b488-4912-ba16-ee368ba04c6b')): $__env->markAsRenderedOnce('c9354f04-b488-4912-ba16-ee368ba04c6b'); ?>
    <?php $__env->startPush('scripts'); ?>

		<script>
			function readURL(input) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();
				
					reader.onload = function(e) {
						jQuery('#imagePreview').attr('src', e.target.result);
						jQuery('#imagePreview').show();
					}
				
					reader.readAsDataURL(input.files[0]); 
				}
			}
			jQuery(document).ready(function(){
				jQuery("#imageInput").change(function() {
					readURL(this);
				});
			});
		</script>
	<?php $__env->stopPush(); ?>
<?php endif; ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/amicirev/public_html/resources/views/student/profile/edit.blade.php ENDPATH**/ ?>