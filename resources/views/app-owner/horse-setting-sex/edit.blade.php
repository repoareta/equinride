<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    EDIT SEX
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" id="formHorseSex">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="id" id="idData">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Horse Sex</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Horse Sex">
                            </div>
                        </div>												
                    </div>
                    <button type="submit" class="btn btn-primary font-weight-bold float-right">UPDATE</button>
                </form>
            </div>
        </div>
    </div>
</div>

