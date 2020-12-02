<div class="modal fade modal-hanlde" id="importData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('cities.import') }}"
                  enctype="multipart/form-data"
                  id="form-import-file">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Import danh sách huyện, xã</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 form-group">
                            <label for="">Chọn file excel</label>
                            <input type="file" class="" name="data_file" id="data_file">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="submit-data-file">Xử lý file</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Hủy bỏ</button>
                </div>
            </form>
        </div>
    </div>
</div>
