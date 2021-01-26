<div class='row'>
    <div class='col-md-12'>
        <div class='portlet light'>
            <div class='portlet-title'>
                <div class='caption'>
                    <?php echo btnBack() ?>
                    <span class='caption-subject bold '>Edit Data</span>
                </div>
            </div>
            <div class='portlet-body form'>
            
                <?= form_open($action, 'id="input-form" class="form-horizontal"'); ?>
                    
                    <div class='form-body'> 

                        <div class='row'>
                        
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label class='col-md-3 control-label'>Name <span class="required">*</span> </label>
                                    <div class='col-md-9'>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $row->name ?>" />
                                    </div>
                                </div>
                            </div>
                            
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label class='col-md-3 control-label'>Description <span class="required">*</span> </label>
                                    <div class='col-md-9'>
                                        <input type="text" class="form-control" name="description" id="description" placeholder="Description" value="<?php echo $row->description ?>" />
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
            
                    </div>
            
                    <div class='form-actions'>
                        <div class='row'>
                            <div class='col-md-offset-5 col-md-7'>
                                <button type='submit' class='btn blue btn-circle btn-outline' > Simpan Perubahan  </button>
                            </div>
                        </div>
                    </div>
                        
                <?= form_close() ?>
                    
            </div>
        </div>
    </div>
</div>