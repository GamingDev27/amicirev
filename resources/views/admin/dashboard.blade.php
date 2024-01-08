@extends('layouts.admin')

@section('content')

    <h5>{{ __('Amici Review Center Dashboard') }}</h5>

    <div class="card-body">

        <div class="row">
            <div class="col-6">
                <canvas id="passratelinechart" width="450px" height="200px"></canvas>
            </div>
            <div class="col-6">
                <canvas id="studentllinechart" width="450px" height="200px"></canvas>
            </div>
        </div>
        @php
            $passingratelabels = [];
            $enrollmentratelabels = [];
            $batchlabels = [];
        @endphp
        @foreach($seasons as $season)
            <div class="jumbotron m-0 p-1 " style="border-radius:5px;background:whitesmoke;">
                <p class="w-100 m-1 p-1 align-right" >
                    <b>{{strtoupper($season->name)}}</b>
                </p>
                @foreach($season->batches as $batch)
                    @php
                        $batchlabels[$batch->id] = $season->name."-".$batch->name;
                    @endphp
                    <div class="row m-2 p-1" style="border:2px solid #e9ecef;background:white;border-radius:5px;">
                        <div class="col-12">
                            <p class="w-100 align-center p-0 m-0">
                                <b>{{ strtoupper($batch->name) }}</b>
                            </p>
                            <hr />
                            <div class="row m-0 p-0">
                            <div class="col-4 m-0 p-0">
                                    <canvas id="passingTallyPie{{ $batch->id }}"></canvas>
                                </div>
                                <div class="col-4 m-0 p-0">
                                    <table class="table w-100 data-tbl">
                                    <tr>
                                            <td colspan="2">
                                                {{ $batch->description }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>START:</td>
                                            <td >
                                                {{ date('F d,y',strtotime($batch->date_start)) }} 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>END:</td>
                                            <td >
                                                {{ date('F d,y',strtotime($batch->date_end)) }} 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>STUDENTS:</td>
                                            <td>
                                                @if(isset($students[$batch->id]) && isset($students[$batch->id]['verified']))
                                                    {{ $students[$batch->id]['verified'] }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>FOR VERIFICATION:</td>
                                            <td>
                                                @if(isset($students[$batch->id]) && isset($students[$batch->id]['notyet']))
                                                    {{ $students[$batch->id]['notyet'] }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>TOTAL COLLECTED:</td>
                                            <td>
                                                @if(isset($collections[$batch->id]))
                                                    Php {{ number_format($collections[$batch->id],2) }}
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-4 m-0 p-0">
                                    <canvas id="paymentBar{{ $batch->id }}"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach 
            </div>   
        @endforeach
        @foreach($enrollmentrate as $batchid => $passingrat)
            @php
                $enrollmentratelabels[] = isset($batchlabels[$batchid])?$batchlabels[$batchid]:'';
            @endphp
        @endforeach
        @foreach($passingrate as $batchid => $passingrat)
            @php
                $passingratelabels[] = isset($batchlabels[$batchid])?$batchlabels[$batchid]:'';
            @endphp
        @endforeach
    </div>
    <canvas id="mixed-chart"></canvas>
@endsection

@once
    @push('scripts')

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
                @if($passingrate)
                    var chartInstance = new Chart("passratelinechart", {
                        type: 'line',
                        data: {
                            labels: @json($passingratelabels),
                            datasets: [{
                                label: 'PASSING RATE TREND',
                                data: @json(array_values($passingrate)),
                                borderColor: "green",
                                backgroundColor: 'rgb(0,128,0,0.7)'
                            }]
                        },
                        options:options
                    });
                @endif
                @if($enrollmentrate)
                    var chartInstance = new Chart("studentllinechart", {
                        type: 'line',
                        data: {
                            labels: @json($enrollmentratelabels),
                            datasets: [{
                                label: 'ENROLMENT TREND',
                                data: @json(array_values($enrollmentrate)),
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
                @endif
                @foreach($seasons as $season)
                    @foreach($season->batches as $batch)
                        @if(isset($passingtally[$batch->id]))
                            var myChart = new Chart('passingTallyPie{{ $batch->id }}',{
                                type: 'doughnut',
                                data: {
                                    labels: ['PASSED', 'FAILED','UNKNOWN'],
                                    datasets: [{
                                    label: 'OUTCOME',
                                    data: @json([$passingtally[$batch->id]['passed'],$passingtally[$batch->id]['failed'],$passingtally[$batch->id]['notyet']]),
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
                        @endif
                        @if(isset($payments[$batch->id]))
                            new Chart('paymentBar{{ $batch->id }}', {
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
                                            data: @json([$payments[$batch->id]['paid'],$payments[$batch->id]['partial'],$payments[$batch->id]['others']]),
                                            backgroundColor: ["blue", "yellow", "gray"],
                                            hoverBackgroundColor: ["blue", "yellow", "gray"]
                                        }]
                                }
                            });
                        @endif
                    @endforeach
                @endforeach

                
            });
		</script>
	@endpush
@endonce