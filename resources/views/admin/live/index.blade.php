@extends('layouts.admin')

@section('content')
<div class="mt-4 mb-4">

    <div class="form-row gy-2">
        <div class="col-12">
            <h4 class="border-bottom pb-3 mb-4">Live Stream Setup</h4>
        </div>
        <!-- Card Header -->

        <div class="accordion px-2 col-12" id="filterMain">
            <form action="{{ route('admin_live_search')}}" method="GET" role="search">
                <div class="card">
                    {{-- Header --}}
                    <div class="card-header p" id="filterHeader">
                        <h2 class="m-0">
                            <span class="btn btn-link btn-block text-left font-weight-bold text-dark">
                                Filters
                            </span>
                        </h2>
                    </div>
                    {{-- BODY --}}
                    <div class="card-body ">
                        <div class="d-flex flex-column flex-lg-column-reverse">
                            <div class="form-row">
                                <div class="input-group col-12 col-md-6 col-lg-4 mb-1">
                                    <input type="text" class="form-control" name="stream_name" id="stream_name"
                                        placeholder="Stream Name" value="{{request('stream_name') }}">
                                </div>
                                <div class="col-12 col-md-6 col-lg-4 mb-1">
                                    <select type="text" class="form-control form-select-clear col-6 col-md-12"
                                        name="is_active">
                                        <option value="all">Status</option>
                                        <option value="1" {{ request('is_active')=='1' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="0" {{ request('is_active')=='0' ? 'selected' : '' }}>Inactive
                                        </option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4 mb-1">
                                    <select type="text" class="form-control form-select-clear col-6 col-md-12"
                                        name="branch">
                                        <option value=""><em>All Branches</em></option>
                                        @foreach($seasons as $branch)
                                        <option value="{{ $branch->id }}" {{ request('branch')==$branch->id ? 'selected'
                                            :
                                            '' }}>{{ $branch->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row justify-content-end mb-lg-2">
                                <div class="col-12 col-lg-2 col-xl-1 mb-1">
                                    <button type="submit" class="btn btn-primary btn-block" id="filterBtn"><i
                                            class="fas fa-filter"></i>
                                        Filter</button>
                                </div>
                                <div class="col-12 col-lg-2 col-xl-1 mb-1">
                                    <button type="button" class="btn btn-outline-secondary btn-block"
                                        id="clearFilter"><i class="far fa-times-circle"></i>
                                        Clear</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
    <div class="my-2 col-12 mb-1">
        <a href="{{ route('admin_live_add') }}" class="btn btn-primary btn-block" id="filterBtn"><i
                class="fa fa-plus"></i>
            Add Link</a>
    </div>
</div>

<div class="d-flex justify-content-center">
    <div class="container-fluid mt-4">

        <div class="row g-4">
            @foreach($livestream as $live)
            <div class="col-12">
                <div class="card h-100">
                    <div class="row g-0">
                        <div class="col-12 col-md-4">
                            <div class="icon-placeholder">
                                <i class="fas fa-video"></i>
                            </div>
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="card-body">
                                <div class="d-flex justify-content-between flex-column flex-md-row">
                                    <div class="d-flex flex-column flex-md-row">
                                        <h5 class="card-title mr-3">{{ $live->name }}</h5>
                                        <h5 class="card-text"><span class="badge badge-primary">{{ $live->season_id ==
                                                0? 'All Branches' : $live->season->name
                                                }}</span></h5>
                                    </div>
                                    <div class="d-flex mt-2 mt-md-0 md:flex-grow-1">
                                        <a href="{{ route('admin_live_edit',['liveid' => $live->id]) }}"
                                            class="btn btn-warning mr-2 px-4 flex-grow-1"><i class="fa fa-edit"></i></a>
                                        <form action="{{ route('admin_live_delete') }}" method="POST"
                                            class="flex-fill flex-grow-1">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $live->id }}">
                                            <button type="submit" class="btn btn-danger px-4 w-100"><i
                                                    class="fa fa-trash"></i></button>
                                        </form>
                                    </div>
                                </div>
                                <p class="card-text"><small class="text-muted">{{ $live->date_stream_human }}</small>
                                    @if(!$live->is_active) <span class="badge badge-danger">inactive</span>@endif</p>
                                <p class="card-text">{{ $live->description}}</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>

    @foreach($livestream as $live)
    {{-- <div class="card">
        <iframe class="card-img-top" src="{{ $live->link }}"></iframe>
        <div class="card-body">
            <h5 class="card-title">{{ $live->name }}</h5>
            <h5 class="card-title">Special title treatment</h5>
            <p class="card-text">{{ $live->description}}</p>
            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
        </div>
    </div> --}}
    @endforeach

    {{-- @foreach($livestreamlinks as $livelink)

    @endforeach
    {{ $livestreamlinks->links() }} --}}
</div>
@endsection

@once
@push('scripts')
<script>
    $("#clearFilter").on("click", function(){
		$("#stream_name").val('');
		$(".form-select-clear option:selected").removeAttr('selected');
		$("#filterBtn").click();
	});
   
</script>
@endpush
@endonce