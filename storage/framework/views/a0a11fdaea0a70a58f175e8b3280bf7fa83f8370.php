<?php $__env->startSection('content'); ?>
	<h4 class="mt-2">
		<?php echo e($batch->name); ?>

		<span class="float-right"><?php echo e($batch->season->name); ?></span>
	</h4>
	<div class="row">
		<div class="col-10">
			<b>DATE:</b> <em><?php echo e(date('F d,Y',strtotime($batch->date_start))); ?> to <?php echo e(date('F d,Y',strtotime($batch->date_end))); ?></em>
		</div>
		
	</div>
	<?php //var_dump($albums);?>
	
	<div class="blackred" width="100%">
		<nav >
			<div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
				<?php
					$firstcourse = true;
				?>
				<?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as &$course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php $__currentLoopData = $classes[$course->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php if($class->coach): ?>
							<?php
								$course->hascoach = true;
							?>
							<?php break; ?>
						<?php endif; ?>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php if(isset($course->hascoach) && $course->hascoach): ?>
						<a class="nav-item nav-link <?php echo e($firstcourse?'active':''); ?>" <?php echo e($firstcourse?'aria-selected="true"':''); ?> id="nav-<?php echo e($course->code); ?>-tab" data-toggle="tab" href="#nav-<?php echo e($course->code); ?>" role="tab" aria-controls="nav-<?php echo e($course->code); ?>">
							<?php echo e($course->code); ?>

						</a>
						<?php
							$firstcourse = false;
						?>
					<?php endif; ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
		</nav>
		<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
			<?php
				$firstcourse = true;
			?>
			<?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php if(isset($course->hascoach) && $course->hascoach): ?>
					<div class="tab-pane fade <?php echo e($firstcourse?'active show':''); ?>" id="nav-<?php echo e($course->code); ?>" role="tabpanel" aria-labelledby="nav-<?php echo e($course->code); ?>-tab">
						<?php
							$firstcourse = false;
						?>
						<p class="m-0 p-0 text-center" style="border-bottom:solid 5px lightgray"><?php echo e($course->code); ?> - <?php echo e($course->name); ?></p>
						<div class="row">
							<div class="col-sm-5 col-lg-3">
								<div class="nav subjects-tab flex-column nav-pills p-1" id="v-pills-tab" role="tablist" aria-orientation="vertical">
									<?php $__currentLoopData = $classes[$course->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php if($class->coach): ?>
											<a class="nav-link subject-pill" id="v-pills-<?php echo e($class->subject_id); ?>-tab" data-coach-id="<?php echo e($class->id); ?>-<?php echo e($class->coach->id); ?>" data-toggle="pill" href="#v-pills-<?php echo e($class->subject_id); ?>" role="tab" aria-controls="v-pills-<?php echo e($class->subject_id); ?>" aria-selected="true">
												<?php echo e($class->subject->code); ?>	
											</a>
										<?php endif; ?>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</div>
								<div>
									<?php $__currentLoopData = $classes[$course->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php if($class->coach): ?>
											<div class="card coaches-dv shadow m-2 bg-white rounded" style="display:none;" id="coach-<?php echo e($class->id); ?>-<?php echo e($class->coach->id); ?>-dv">
												<img class="card-img-top" src="/images/<?php echo e($class->coach->image); ?>" alt="Coach Image">
												<div class="card-body p-1">
													<div class="card-title" align="center" >
														<h5 style="color:#FF5722;font-size:24; margin:0px;" >
															<?php echo e($class->coach->salutation); ?>	
															<?php echo e($class->coach->first_name); ?>	
															<?php echo e($class->coach->middle_name); ?>	
															<?php echo e($class->coach->last_name); ?>

														</h5>
														<b><?php echo e($class->coach->title); ?></b>
													</div>
													<div class="card-text" style="font-size:10px;border-top:solid lightgray 1px">
														<p style="margin:2px 0px;font-size:16px;"></p>
													
														<p style="margin:2px 0px;font-size:10px;">
															<?php echo $class->coach->accomplishments; ?>

														</p>
													</div>
												</div>
											</div>
										<?php endif; ?>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</div>
							</div>
							<div class="col-sm-7 col-lg-9">
								<div class="tab-content highlight h-100 p-1" id="v-pills-tabContent">
									<?php $__currentLoopData = $classes[$course->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<div class="tab-pane fade" id="v-pills-<?php echo e($class->subject_id); ?>" role="tabpanel" aria-labelledby="v-pills-<?php echo e($class->subject_id); ?>-tab">
											
											<div class="">
												<h5><?php echo e($class->subject->name); ?></h5>

												<div class="row align-items-stretch mb-5">
													<div class="col-md-12">
														<small>
															<?php if($class->date_start && $class->date_end): ?>
																<?php echo e(date('F d, Y', strtotime($class->date_start))); ?> to <?php echo e(date('F d, Y', strtotime($class->date_end))); ?>

															<?php endif; ?>
															
														</small>
														<div class="form-group mb-md-0">
															<?php echo $class->remarks; ?>

														</div>
														<hr />
														<?php if(strtotime($batch->date_end) > time()): ?>
															<?php if($enrollment && $enrollment->verified == 1): ?>
																<?php if($class->vimeo_albumid): ?>
																	<?php if(isset($albums[$class->id])): ?>
																		
																		<div class="embed-container" id="video_<?php echo e($class->id); ?>" ></div>
																		<div class="container-fluid p-0" >
																			<ul class="list-unstyled video-list-thumbs row  flex-row flex-nowrap overflow-auto m-0 p-1" style="background:white;border:solid 1px #212529;border-bottom:solid 4px #212529;">
																				<?php if(isset($albums[$class->id]["items"]) && count($albums[$class->id]["items"])): ?>
																					<?php $__currentLoopData = $albums[$class->id]["items"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																						<li class="col-lg-3 col-sm-4 col-xs-6 col-6 p-0">
																							<a onclick="playVid('<?php echo e($class->id); ?>','<?php echo e($video['guid']); ?>');" title="<?php echo e($video['title']); ?>" >
																								<?php
																									$link = "";
																									
																								?>
																								<img src="<?php echo e($pullzone); ?>/<?php echo e($video['guid']); ?>/<?php echo e($video['thumbnailFileName']); ?>" alt="Barca" class="img-responsive" width="100%" />
																								<h2><?php echo e(strtoupper($video['title'])); ?></h2>
																								<i class="glyphicon-play-circle fa fa-play-circle"></i>
																								<span class="duration"><?php echo e(gmdate("H:i:s",$video['length'])); ?></span>
																							</a>
																						</li>
																					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
																				<?php endif; ?>
																			</ul>
																		</div>
																	<?php endif; ?>
																<?php endif; ?>
																<?php if(isset($class->attachments)): ?>
																	<div class="m-2 p-1 border rounded" >
																		<div class="buttonshere">
																			<?php $__currentLoopData = $class->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																				<button class="btn btn-primary m-1" onclick="readp(this,'<?php echo e($attachment->token); ?>')" >
																					<i class="fa fa-file-pdf"></i>
																					<?php echo e($attachment->name); ?>

																				</button>
																			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
																		</div>
																		<div id="pdfhere">
																		</div>
																	</div>
																<?php endif; ?>
															<?php else: ?>
																<span class="alert alert-info m-2 p-0"> Please enroll to view Videos and PDFs</span>
															<?php endif; ?>
														<?php else: ?>
															<span class="alert alert-info m-2 p-0">Course was finished</span>
														<?php endif; ?>
													</div>
												</div>
											</div>
										</div>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</div>
							</div>
						</div>
					</div>
				<?php endif; ?>													
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
		<?php if(strtotime($batch->date_end) > time()): ?> 
			<div class="p-1">
				<?php if($enrollment): ?>
					<?php if($enrollment->verified != 1): ?>
						<span class="alert alert-info m-2 p-0">PLEASE WAIT WHILE OUR ADMIN VERIFY YOUR PAYMENT</span>
					<?php endif; ?>
				<?php else: ?>
					<a class="btn btn-success w-25 m-1 p-0"
						onclick="event.preventDefault();
										document.getElementById('join-batch-form').submit();">
						<?php echo e(__('JOIN')); ?>

					</a>
					<form id="join-batch-form" action="<?php echo e(route('student_portal_join')); ?>" method="POST" class="d-none">
						<?php echo csrf_field(); ?>
						<input type="hidden" name="student_id" value="<?php echo e($student->id); ?>" />
						<input type="hidden" name="batch_id" value="<?php echo e($batch->id); ?>" />
					</form>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
<?php $__env->stopSection(); ?>
<?php if (! $__env->hasRenderedOnce('48768d4d-afa4-4bb9-9b8d-1fe6ede15125')): $__env->markAsRenderedOnce('48768d4d-afa4-4bb9-9b8d-1fe6ede15125'); ?>
	<?php $__env->startPush('scripts'); ?>

		
		<script>
			var video01Player;
			var iframeElm;
			jQuery(document).ready(function(){
				jQuery('.subjects-tab .nav-link').click(function(){
					console.log('clicked');
					console.log(jQuery(this).attr('data-coach-id'));
					jQuery('.embed-container').empty();
					jQuery('.coaches-dv').hide();
					jQuery('#coach-'+jQuery(this).attr('data-coach-id')+'-dv').show();
				});
				
				/*
					Carousel
				*/
				$('#carousel-example').on('slide.bs.carousel', function (e) {
					/*
						CC 2.0 License Iatek LLC 2018 - Attribution required
					*/
					var $e = $(e.relatedTarget);
					var idx = $e.index();
					var itemsPerSlide = 5;
					var totalItems = $('.carousel-item').length;

					if (idx >= totalItems-(itemsPerSlide-1)) {
						var it = itemsPerSlide - (totalItems - idx);
						for (var i=0; i<it; i++) {
							// append slides to end
							if (e.direction=="left") {
								$('.carousel-item').eq(i).appendTo('.carousel-inner');
							}
							else {
								$('.carousel-item').eq(0).appendTo('.carousel-inner');
							}
						}
					}
				});
				
				iframeElm = document.createElement('iframe');
				iframeElm.id="iframePDF";
				iframeElm.width="100%";
				iframeElm.height="600px";
			});
			function readp(btn,id){
				btn.parentNode.nextElementSibling.innerHTML = '';
				btn.parentNode.nextElementSibling.appendChild(iframeElm);
				iframeElm.src = "/laraview/#../student/attachment/stream/"+id;
			}
			function playVid(classid,videoid){
				//jQuery('#video_'+classid).html('<iframe src="https://iframe.mediadelivery.net/embed/<?php echo $libid;?>/'+videoid+'" />');
				let vid = '<div ><iframe src="https://iframe.mediadelivery.net/embed/<?php echo $libid;?>/'+videoid+'?autoplay=true" loading="lazy" style="border: none; position: absolute; top: 0; height: 100%; width: 100%;" allow="accelerometer; gyroscope; autoplay; encrypted-media; picture-in-picture;" allowfullscreen="true" referrerpolicy="strict-origin-when-cross-origin"></iframe></div>';
				jQuery('#video_'+classid).html(vid);
			}
		</script>
	<?php $__env->stopPush(); ?>
<?php endif; ?>
<?php echo $__env->make('layouts.student', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/amicirev/public_html/resources/views/student/portal/showv3.blade.php ENDPATH**/ ?>