

<?php $__env->startSection('content'); ?>

    <h5><?php echo e(__('Amici Review Center Dashboard')); ?></h5>

    <div class="card-body">

        <div class="row">
            <div class="col-6">
                <canvas id="passratelinechart" width="450px" height="200px"></canvas>
            </div>
            <div class="col-6">
                <canvas id="studentllinechart" width="450px" height="200px"></canvas>
            </div>
        </div>
        <?php
            $passingratelabels = [];
            $enrollmentratelabels = [];
            $batchlabels = [];
        ?>
        <?php $__currentLoopData = $seasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $season): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="jumbotron m-0 p-1 " style="border-radius:5px;background:whitesmoke;">
                <p class="w-100 m-1 p-1 align-right" >
                    <b><?php echo e(strtoupper($season->name)); ?></b>
                </p>
                <?php $__currentLoopData = $season->batches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $batch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $batchlabels[$batch->id] = $season->name."-".$batch->name;
                    ?>
                    <div class="row m-2 p-1" style="border:2px solid #e9ecef;background:white;border-radius:5px;">
                        <div class="col-12">
                            <p class="w-100 align-center p-0 m-0">
                                <b><?php echo e(strtoupper($batch->name)); ?></b>
                            </p>
                            <hr />
                            <div class="row m-0 p-0">
                            <div class="col-4 m-0 p-0">
                                    <canvas id="passingTallyPie<?php echo e($batch->id); ?>"></canvas>
                                </div>
                                <div class="col-4 m-0 p-0">
                                    <table class="table w-100 data-tbl">
                                    <tr>
                                            <td colspan="2">
                                                <?php echo e($batch->description); ?>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>START:</td>
                                            <td >
                                                <?php echo e(date('F d,y',strtotime($batch->date_start))); ?> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>END:</td>
                                            <td >
                                                <?php echo e(date('F d,y',strtotime($batch->date_end))); ?> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>STUDENTS:</td>
                                            <td>
                                                <?php if(isset($students[$batch->id]) && isset($students[$batch->id]['verified'])): ?>
                                                    <?php echo e($students[$batch->id]['verified']); ?>

                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>FOR VERIFICATION:</td>
                                            <td>
                                                <?php if(isset($students[$batch->id]) && isset($students[$batch->id]['notyet'])): ?>
                                                    <?php echo e($students[$batch->id]['notyet']); ?>

                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>TOTAL COLLECTED:</td>
                                            <td>
                                                <?php if(isset($collections[$batch->id])): ?>
                                                    Php <?php echo e(number_format($collections[$batch->id],2)); ?>

                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-4 m-0 p-0">
                                    <canvas id="paymentBar<?php echo e($batch->id); ?>"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
            </div>   
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php $__currentLoopData = $enrollmentrate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $batchid => $passingrat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $enrollmentratelabels[] = isset($batchlabels[$batchid])?$batchlabels[$batchid]:'';
            ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php $__currentLoopData = $passingrate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $batchid => $passingrat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $passingratelabels[] = isset($batchlabels[$batchid])?$batchlabels[$batchid]:'';
            ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <canvas id="mixed-chart"></canvas>
<?php $__env->stopSection(); ?>

<?php if (! $__env->hasRenderedOnce('2cefd8e0-a8e9-4f64-bd8c-7f0b9661efea')): $__env->markAsRenderedOnce('2cefd8e0-a8e9-4f64-bd8c-7f0b9661efea'); ?>
    <?php $__env->startPush('scripts'); ?>

		<script>
			jQuery(document).ready(function(){

                var options = {
                    responsive: true,
                    scales: {
                        yAxes: [{
                            display: true,
                            ticks: {
                                beginAtZero: true,
                                max: 100,
                                min: 0,
                                stepSize: 25
                            }
                        }]
                    },
                    title: {
                        display: true,
                        text: name
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false,
                    },
                    hover: {
                        mode: 'nearest',
                        intersect: true
                    },

                };
                <?php if($passingrate): ?>
                    var chartInstance = new Chart("passratelinechart", {
                        type: 'line',
                        data: {
                            labels: <?php echo json_encode($passingratelabels, 15, 512) ?>,
                            datasets: [{
                                label: 'PASSING RATE TREND',
                                data: <?php echo json_encode(array_values($passingrate), 15, 512) ?>,
                                borderColor: "green",
                                backgroundColor: 'rgb(0,128,0,0.7)'
                            }]
                        },
                        options:options
                    });
                <?php endif; ?>
                <?php if($enrollmentrate): ?>
                    var chartInstance = new Chart("studentllinechart", {
                        type: 'line',
                        data: {
                            labels: <?php echo json_encode($enrollmentratelabels, 15, 512) ?>,
                            datasets: [{
                                label: 'ENROLMENT TREND',
                                data: <?php echo json_encode(array_values($enrollmentrate), 15, 512) ?>,
                                borderColor: "blue",
                                backgroundColor: 'rgb(0,0,255,0.7)'
                            }]
                        },
                        options:{
                            responsive: true,
                            scales: {
                                yAxes: [{
                                    display: true,
                                    ticks: {
                                        beginAtZero: true,
                                        min: 0,
                                        step: 5
                                    }
                                }]
                            },
                            title: {
                                display: true,
                                text: name
                            },
                            tooltips: {
                                mode: 'index',
                                intersect: false,
                            },
                            hover: {
                                mode: 'nearest',
                                intersect: true
                            },

                        }
                    });
                <?php endif; ?>
                <?php $__currentLoopData = $seasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $season): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $__currentLoopData = $season->batches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $batch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(isset($passingtally[$batch->id])): ?>
                            var myChart = new Chart('passingTallyPie<?php echo e($batch->id); ?>',{
                                type: 'doughnut',
                                data: {
                                    labels: ['PASSED', 'FAILED','UNKNOWN'],
                                    datasets: [{
                                    label: 'OUTCOME',
                                    data: <?php echo json_encode([$passingtally[$batch->id]['passed'], $passingtally[$batch->id]['failed'], $passingtally[$batch->id]['notyet']]) ?>,
                                    backgroundColor: [
                                        'green',
                                        'red',
                                        'gray',
                                    ],
                                    borderColor: [
                                        'green',
                                        'red',
                                        'gray',
                                    ],
                                    borderWidth: 1
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    legend: {
                                        position: 'left',
                                        labels: {
                                            boxWidth: 20,
                                            padding: 2
                                        }
                                    }
                                }
                            });
                        <?php endif; ?>
                        <?php if(isset($payments[$batch->id])): ?>
                            new Chart('paymentBar<?php echo e($batch->id); ?>', {
                                type: 'horizontalBar',
                                data: {
                                    labels: [
                                        "FULLYPAID",
                                        "PARTIAL",
                                        "OTHERS",
                                    ],
                                    datasets: [
                                        {
                                            label: "PAYMENT",
                                            data: <?php echo json_encode([$payments[$batch->id]['paid'], $payments[$batch->id]['partial'], $payments[$batch->id]['others']]) ?>,
                                            backgroundColor: ["blue", "yellow", "gray"],
                                            hoverBackgroundColor: ["blue", "yellow", "gray"]
                                        }]
                                }
                            });
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                
            });
		</script>
	<?php $__env->stopPush(); ?>
<?php endif; ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Dir\laravel\amici\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>