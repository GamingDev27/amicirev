<!-- View Devices Modal -->
<div class="modal fade" id="viewDevicesModal" tabindex="-1" aria-labelledby="viewDevicesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="{{ route('tag_devices') }}" onsubmit="return confirm('Tag these devices?');" method="POST"
                role="search">
                @csrf
                <div class="modal-header">
                    <input type="hidden" id="modal-user-id" value="">
                    <h5 class="modal-title" id="viewDevicesModalLabel">View Devices for</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-responsive-sm data-tbl table-striped table-hover"
                        id="dataTable" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="text-center d-none">ID</th>
                                <th class="text-center">
                                    <input type="checkbox" class="check-all-devices" id="check-all-user-devices" />
                                </th>
                                <th scope="col" class="text-center">IP Address</th>
                                <th scope="col" class="text-center text-nowrap">Platform</th>
                                <th scope="col" class="text-center text-nowrap">Device</th>
                                <th scope="col" class="text-center text-nowrap">Browser</th>
                                <th scope="col" class="text-center text-nowrap">Status</th>
                            </tr>
                        </thead>
                        <tbody class="devices" id="modalTableRow">
                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td colspan="2">
                                    <select type="text" class="form-control" name="is_disabled">
                                        <option value="x" selected>--DEVICE STATUS--</option>
                                        <option value="0">ALLOWED</option>
                                        <option value="1">DISABLED</option>
                                    </select>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-xl text-uppercase">SAVE</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--View Devices Modal -->