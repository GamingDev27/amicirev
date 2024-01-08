@extends('layouts.admin')
@section('content')
	<h1 class="mt-4">Edit Abous Page</h1>

	<form method="POST" id="contentForm" action="{{ route('admin_save_content') }}">
		@csrf
		<div class="form-group">
			<input id="id" type="hidden"  name="id" value="{{ $about->id }}" />
			<input id="type" type="hidden"  name="type" value="{{ $type }}" />
			<input id="redirectTo" type="hidden"  name="redirectTo" value="admin_about" />
			<input id="description" type="hidden"  name="description" value="{{ $about->description }}" />
			<input placeholder="Title*" id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $about->title }}" required autocomplete="title" autofocus>
			@error('title')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
			@enderror
		</div>
		<div class="form-group">
			<input placeholder="Subtitle*" id="description" type="text"  name="description" value="{{ $about->description }}" />
			@error('description')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
			@enderror
		</div>
		<div class="form-group mb-md-0">
			<div class="form-group form-group-textarea mb-md-0">
				<textarea class="form-control @error('details') is-invalid @enderror" id="details" name="details" rows="10" placeholder="Description *" required autocomplete="details">{{ $about->details }}</textarea>
			</div>
			@error('details')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
			@enderror
		</div>
		<hr />
		<button class="btn btn-primary btn-xl text-uppercase" id="sendMessageButton" type="submit">SUBMIT</button>
	</form>
	
@endsection

@once
    @push('scripts')

		<script>
			
			jQuery(document).ready(function(){
				ClassicEditor
				.create( document.querySelector( '#details' ), {
					// toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
				} )
				.then( editor => {
					editor.ui.view.editable.element.style.height = '300px';
					window.editor = editor;
				} )
				.catch( err => {
					console.error( err.stack );
				} );
			});
		</script>
	@endpush
@endonce

