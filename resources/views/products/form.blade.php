<div class="modal fade" id="modal-form" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog"><!-- Log on to codeastro.com for more projects! -->
        <div class="modal-content">
            <form  id="form-item" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data" >
                {{ csrf_field() }} {{ method_field('POST') }}

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title"></h3>
                </div>


                <div class="modal-body">
                    <input type="hidden" id="id" name="id">

                    <div class="box-body">

                    <div class="form-group">
                        <label>Category</label>
                        {!! Form::select('category_id', $category, null, [
                            'class' => 'form-control select',
                            'placeholder' => '-- Choose Category --',
                            'id' => 'category_id',
                            'required'
                        ]) !!}
                        <span class="help-block with-errors"></span>
                    </div>


                        <div class="form-group">
                            <label >Name</label>
                            <input type="text" class="form-control" id="nama" name="nama"  autofocus required>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Quantity</label>
                            <input type="text" class="form-control" id="qty" name="qty"   required>
                            <span class="help-block with-errors"></span>
                        </div>

                        <!-- <div class="form-group">
                            <label >Image</label>
                            <input type="file" class="form-control" id="image" name="image" >
                            <span class="help-block with-errors"></span>
                        </div> -->

                        <div class="form-group">
                            <label >Spec</label>
                            <input type="text" class="form-control" id="spec" name="spec" >
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Barcode</label>
                            <input type="number" class="form-control" id="barcode" name="barcode"  required>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Date</label>
                            <input type="date" class="form-control" id="date" name="date"  required>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Posisi</label>
                            <input type="text" class="form-control" id="Posisi" name="posisi"  required>
                            <span class="help-block with-errors"></span>
                        </div>

                    </div>
                    <!-- /.box-body -->

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>

            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- Log on to codeastro.com for more projects! -->
<!-- /.modal -->
