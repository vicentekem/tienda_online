<div class="modal fade" id="modal_crud_curso" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="emodal_title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

            <form class="row" action="" id="frm_crud_curso">

                <input type="hidden" id="txt_crud_id">
                <input type="hidden" id="txt_crud_action">

                <div class="form-group col-12">
                    <label  for="txt_crud_descripcion"> Descripcion <span class="text-danger">*</span> </label>
                    <input id="txt_crud_descripcion" class="form-control text-uppercase" />
                </div>

            </form>
                            
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>                
                <button type="button" id="btn_save_curso" form="frm_crud_curso" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>