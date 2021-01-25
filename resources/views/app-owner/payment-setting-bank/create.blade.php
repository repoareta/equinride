<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    ADD Bank Payment
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" id="formBank" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-6 mb-3">
                            <label>Account Number</label>
                            <input type="number" class="form-control" name="account_number" placeholder="Account Number">
                        </div>												
                        <div class="col-md-6 mb-3">
                            <label>Account Name</label>
                            <input type="text" class="form-control" name="account_name" placeholder="Account Name">
                        </div>												
                        <div class="col-md-6 mb-3">
                            <label>Branch</label>
                            <input type="text" class="form-control" name="branch" placeholder="Branch">
                        </div>								
                        <div class="col-md-6 mb-3">
                            <label>Photo</label>
                            <input type="file" class="form-control" name="photo">
                        </div>								
                    </div>
                    <button type="submit" class="btn btn-primary font-weight-bold float-right">SAVE</button>
                </form>
            </div>
        </div>
    </div>
</div>