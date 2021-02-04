<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    ADD BREED
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('app_owner.horse.horse_breed.store') }}" method="POST" id="formHorseBreed">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Horse Breed</label>
                                <input type="text" class="form-control" name="name" placeholder=" Enter Horse Breed">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary font-weight-bold float-right">SAVE</button>
                </form>
            </div>
        </div>
    </div>
</div>