@extends('layouts.admin')

@section('content')

<div class="mt-4 mb-4">

    <div class="form-row gy-2">
        <div class="col-12">
            <h1 class="border-bottom pb-3 mb-4">Add New Live Stream Link</h1>
        </div>
    </div>    
	
	<form method="POST" id="contentForm" action="{{ route('admin_live_save') }}" >
		@csrf
		<div class="row align-items-stretch mb-5">
			<div class="col-md-12">
				<div class="form-group">
					<input placeholder="Name*" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
					@error('name')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
				<div class="form-group mb-md-0">
					
					<div class="form-group form-group-textarea mb-md-0">
						<textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Description *" required autocomplete="description"></textarea>
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
                        <option value="{{ $branch->id }}" {{ request('branch')==$branch->id ? 'selected' :
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
					<input placeholder="Stream Date" id="date_stream" type="datetime-local" class="form-control @error('date_stream') is-invalid @enderror" name="date_stream" value="{{ old('date_stream') }}" required autocomplete="date_stream" autofocus>
					@error('date_stream')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
                <div class="form-group">
					<input placeholder="Link" id="link" type="text" class="form-control @error('link') is-invalid @enderror" name="link" value="{{ old('link') }}" required autocomplete="link" autofocus>
					@error('link')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
				<hr />
				<button class="btn btn-primary btn-xl text-uppercase" id="sendMessageButton" type="submit">SUBMIT</button>
			</div>
		</div>
		
	</form>
	
@endsection