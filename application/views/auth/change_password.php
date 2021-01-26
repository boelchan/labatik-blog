<div class='row'>
    <div class='col-md-12'>
        <div class='portlet light'>
            <div class='portlet-body form'>
                <?= form_open($action, 'id="input-form" class="form-horizontal" role="form"'); ?>
                    <div class='form-body'>
                        <div class='row'>
                        
                            <div class="col-md-12">
                                <div class='form-group'>
                                    <label class='col-md-3 control-label'>Kata sandi lama <span class="required">*</span></label>
                                    <div class='col-md-4'>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-key"></i>
                                            </span>
                                        <input type="password" class="form-control" name="old_password" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <hr>
                            <div class="form-group">
                                <label class='col-md-3 control-label'>Kata sandi baru <span class="required">*</span></label>
                                <div class='col-md-4'>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-key font-green"></i>
                                        </span>
                                        <input type="password" class="form-control" name="password" required/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class='col-md-3 control-label'>Ulangi Kata sandi <span class="required">*</span></label>
                                <div class='col-md-4'>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-key font-green"></i>
                                        </span>
                                        <input type="password" class="form-control" name="rpassword" required/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='form-actions'>
                        <div class="col-md-offset-4">
                            <button type="submit" class="btn btn-outline btn-circle blue">Simpan</button>
                        </div>
                    </div>
                <?=form_close();?>
            </div>
        </div>
    </div>
</div>