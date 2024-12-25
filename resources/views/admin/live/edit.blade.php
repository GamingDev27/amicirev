@extends('layouts.admin')

@section('content')

<div class="mt-4 mb-4">

    <div class="form-row gy-2">
        <div class="col-12">
            <h1 class="border-bottom pb-3 mb-4">Edit Live Stream Link</h1>
        </div>
    </div>    
	
	<form method="POST" id="contentForm" action="{{ route('admin_live_update') }}" >
		@csrf
        <input type="hidden" name="id" value="{{ $livestream->id }}">
		<div class="row align-items-stretch mb-5">
			<div class="col-md-12">
				<div class="form-group">
					<input placeholder="Name*" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $livestream->name }}" required autocomplete="name" autofocus>
					@error('name')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
				<div class="form-group mb-md-0">
					<div class="form-group form-group-textarea mb-md-0">
						<textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Description *" required autocomplete="description">{{ $livestream->description }}</textarea>
						<p class="help-block text-danger"></p>
					</div>
					@error('description')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
                <div class="form-group">
                    <select type="text" class="form-control form-select-clear" name="branch">
                        <option value="0"><em>All Branches</em></option>
                        @foreach($seasons as $branch)
                        <option value="{{ $branch->id }}" {{ $livestream->season_id==$branch->id ? 'selected' :
                            '' }}>{{ $branch->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('branch')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
                </div>
				<div class="form-group">
					<input placeholder="Stream Date" id="date_stream" type="datetime" class="form-control @error('date_stream') is-invalid @enderror" name="date_stream" value="{{ $livestream->date_stream }}" required autocomplete="date_stream" autofocus>
					@error('date_stream')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
                <div class="form-group">
					<input placeholder="Link" id="link" type="text" class="form-control @error('link') is-invalid @enderror" name="link" value="{{ $livestream->link }}" required autocomplete="link" autofocus>
					@error('link')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
                <label class="col-form-label text-md-right">Status</label>
                <div class="form-group col-4 d-inline">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" {{ $livestream->is_active ?'checked="checked"':'' }} required name="is_active" value="1">
                        <label class="form-check-label" for="sexM"> Active </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" {{ !$livestream->is_active?'checked="checked"':'' }} required name="is_active" value="0">
                        <label class="form-check-label" for="sexF"> Inactive </label>
                    </div>
                    @error('is_active')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
				<hr />
                <div>
                    <a class="btn btn-outline-secondary btn-xl text-uppercase" href="{{ route('admin_live_setup')}}"> <i class="fas fa-reply"></i> Cancel </a>   
                    <button class="btn btn-warning btn-xl text-uppercase" id="sendMessageButton" type="submit"><i class="fa fa-edit"></i> update</button>
                </div>
				
			</div>
		</div>
		
	</form>
	
@endsection

@push('scripts')
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()  
    })    
</script>
@endpush
