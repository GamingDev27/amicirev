<!DOCTYPE html>
<html lang="en">
   <head>
		<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="Bryan Victoria" />
        
		<!-- CSRF Token -->
		<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

		<title><?php echo e(config('app.name', 'Laravel')); ?></title>

		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        
		<script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
        
		<link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
		<link href="<?php echo e(asset('css/admin.css')); ?>" rel="stylesheet">
		<link href="<?php echo e(asset('css/student.css')); ?>" rel="stylesheet">
		<link href="<?php echo e(asset('css/b4vtabs.min.css')); ?>" rel="stylesheet">
		
		<script src="<?php echo e(asset('js/vendor/jquery.min.js')); ?>" ></script>
		<script src="<?php echo e(asset('js/vendor/ckeditor5-build-classic/ckeditor.js')); ?>" ></script>
		<script src="<?php echo e(asset('js/vendor/bootstrap.bundle.min.js')); ?>" ></script>
		<script src="<?php echo e(asset('js/admin.js')); ?>" ></script>
        <script src="<?php echo e(asset('js/vendor/jquery.min.js')); ?>" ></script>
        <script src="<?php echo e(asset('js/vendor/jquery.blockUI.js')); ?>" ></script>
        <script src="<?php echo e(asset('js/vendor/player/dist/player.js')); ?>" ></script>
        <script src="<?php echo e(asset('js/common.js')); ?>" ></script>
        
        
        
    
    </head>
    <body class="sb-nav-fixed">
		<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand js-scroll-trigger" href="/"><img src="/assets/img/logo.png" style="width: 150px;height: 40px;" alt="ARC Logo" /></a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <div class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            </div>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            <?php echo e(__('Logout')); ?>

                        </a>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                            <?php echo csrf_field(); ?>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">STUDENT</div>
                            <a class="nav-link" href="<?php echo e(route('student_profile')); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                ACCOUNT
                            </a>
                            <div class="sb-sidenav-menu-heading">
                                SEASONS
                            </div>
                            <?php if(isset($admin_seasons)): ?>
                                <?php $__currentLoopData = $admin_seasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $season): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts<?php echo e($season->id); ?>" aria-expanded="false" aria-controls="collapseLayouts<?php echo e($season->id); ?>">
                                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                        <?php echo e($season->name); ?>

                                    </a>
                                    <div class="collapse" id="collapseLayouts<?php echo e($season->id); ?>" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <?php $__currentLoopData = $season->batches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $batch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <a class="nav-link" href="<?php echo e(route('student_portal_showv3',$batch->id)); ?>"> <?php echo e($batch->name); ?> </a>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </nav>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php if(Auth::user()->student): ?>
                            <?php echo e(Auth::user()->student->last_name); ?>, <?php echo e(Auth::user()->student->first_name); ?>

                        <?php else: ?>
                            <?php echo e(Auth::user()->name); ?>

                        <?php endif; ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <?php echo $__env->make('flash-message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->yieldContent('content'); ?>
                    </div>
                </main>

                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
                <?php echo $__env->yieldPushContent('scripts'); ?>
            </div>
        </div>
        
    </body>
</html>
<?php /**PATH /home2/amicirev/public_html/resources/views/layouts/student.blade.php ENDPATH**/ ?>