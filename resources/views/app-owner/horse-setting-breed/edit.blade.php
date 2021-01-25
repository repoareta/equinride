<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-end">
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <h2 class="title-text ">
                    ADD SEX
                </h2>
                <form action="{{ route('owner.horse-sex.update')}}" method="POST" id="formHorseSex">
                    @method('PATCH')
                    @csrf
                    <input type="hidden" name="id" id="idData">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label>Horse Sex</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Horse Sex">
                        </div>												
                    </div>
                    <div class="modal-footer">											
                        <button class="btn btn-secondary">RESET</button>
                        <button type="submit" class="btn btn-add-new font-weight-bold">SAVE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

