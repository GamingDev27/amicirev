<!-- Store Devices Modal -->
<div class="modal fade" id="storeDevicesModal" data-backdrop="static" tabindex="-1"
    aria-labelledby="storeDevicesModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <form action="{{ route('store.device', ['userid' => auth()->user()->id]) }}" method="POST" role="dialog">
                @csrf
                <div class="modal-header">
                    <input type="hidden" id="modal-user-id" value="">
                    <h5 class="modal-title" id="storeDevicesModalLabel">New device found</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Do you want to store this device as your <strong class="">primary device</strong> when accessing
                        Amici Review Center? </p>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary btn-xl text-uppercase">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--Store Devices Modal -->