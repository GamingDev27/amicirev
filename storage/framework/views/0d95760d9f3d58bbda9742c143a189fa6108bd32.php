<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    
	<head>
		<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="Bryan Victoria" />
        
		<!-- CSRF Token -->
		<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

		<title><?php echo e(config('app.name', 'Laravel')); ?></title>

		<link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        
		<!-- Scripts 
			<script src="<?php echo e(asset('js/app.js')); ?>" defer></script>
		-->
		
		<script src="<?php echo e(asset('js/vendor/jquery.min.js')); ?>" ></script>
		<script src="<?php echo e(asset('js/vendor/bootstrap.bundle.min.js')); ?>" defer></script>
		<script src="<?php echo e(asset('js/vendor/jquery.easing.min.js')); ?>" defer></script>
		
		<script src="<?php echo e(asset('js/template.js')); ?>" defer></script>
		<script src="<?php echo e(asset('js/common.js')); ?>" ></script>
        
		<!-- Fonts -->
		<link rel="dns-prefetch" href="//fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        
		<script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
        
		<!-- Styles 
		<link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">-->
		<link href="<?php echo e(asset('css/template.css')); ?>" rel="stylesheet">
		<link href="<?php echo e(asset('css/sticky-footer-navbar.css')); ?>" rel="stylesheet">
	
	</head>
	
    <body id="page-top" style="background:#212529;">
		<!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav" style="padding:0px !important;">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="/"><img src="/assets/img/logo.png" style="width: 300px;height: 80px;" alt="ARC Logo" /></a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ml-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ml-auto">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="/">Home</a></li>
                        
						<?php if(auth()->guard()->guest()): ?>
                            <?php if(Route::has('login')): ?>
                                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="<?php echo e(route('login')); ?>"><?php echo e(__('LOGIN')); ?></a></li>
                            <?php endif; ?>
                            
                            <?php if(Route::has('register')): ?>
                                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="<?php echo e(route('register')); ?>"><?php echo e(__('JOIN US')); ?></a></li>
                            <?php endif; ?>
                        <?php else: ?>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <?php if(Auth::user()->student): ?>
                                        <?php echo e(Auth::user()->student->last_name); ?>, <?php echo e(Auth::user()->student->first_name); ?>

                                    <?php else: ?>
                                        <?php echo e(Auth::user()->name); ?>

                                    <?php endif; ?>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
        <main h-100>
            <?php echo $__env->yieldContent('content'); ?>
        </main>
        <!-- Footer-->
        <footer class="footer">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 text-lg-left">Copyright © amicirc.edu 2021</div>
                    <div class="col-lg-4 my-3 my-lg-0">
                        <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
			
        </footer>
		<?php echo $__env->yieldPushContent('scripts'); ?>
    </body>
</html>
<?php /**PATH /home2/amicirev/public_html/resources/views/layouts/app.blade.php ENDPATH**/ ?>