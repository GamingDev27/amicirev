<div class="row mb-2 justify-content-around card-deck">

    <div class="card bg-success text-white" style="width: 36rem;">
        <div class="card-body">
            <div class="card-subtitle m-0">Student</div>
            <div class="h5 card-title m-0">Verified</div>
            <div class="display-4 m-0">{{$students['verified']}}</div>
        </div>
    </div>
    <div class="card bg-secondary text-white" style="width: 36rem;">
        <div class="card-body">
            <div class="card-subtitle m-0">Student</div>
            <div class="h5 card-title m-0">Unverified</div>
            <div class="display-4 m-0">{{$students['notyet']}}</div>
        </div>
    </div>
    <div class="card bg-primary text-white" style="width: 36rem;">
        <div class="card-body">
            <div class="card-subtitle m-0">Student</div>
            <div class="h5 card-title m-0">Total</div>
            <div class="display-4 m-0">{{$students['notyet']}}</div>
        </div>
    </div>
</div>