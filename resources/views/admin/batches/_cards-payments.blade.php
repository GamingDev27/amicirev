<div class="row justify-content-around card-deck">
	<div class="card bg-success text-white" style="width: 36rem;">
		<div class="card-body">
			<div class="card-subtitle m-0">Payments</div>
			<div class="h5 card-title m-0">Fully Paid</div>
			<div class="display-4 m-0">Php {{ $payments['paid'] }}</div>
		</div>
	</div>
	<div class="card bg-secondary text-white" style="width: 36rem;">
		<div class="card-body">
			<div class="card-subtitle m-0">Payments</div>
			<div class="h5 card-title m-0">Partial</div>
			<div class="display-4 m-0">Php {{ $payments['partial'] }}</div>
		</div>
	</div>
	<div class="card bg-light text-dark" style="width: 36rem;">
		<div class="card-body">
			<div class="card-subtitle m-0">Payments</div>
			<div class="h5 card-title m-0">Others</div>
			<div class="display-4 m-0">Php {{ $payments['others'] }}</div>
		</div>
	</div>
	<div class="card bg-primary text-white" style="width: 36rem;">
		<div class="card-body">
			<div class="card-subtitle m-0">Payments</div>
			<div class="h5 card-title m-0">Total</div>
			<div class="display-4 m-0">Php {{ number_format($totalpayments->total,2) }}</div>
		</div>
	</div>
</div>