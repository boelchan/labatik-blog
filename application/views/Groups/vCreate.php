<div class='row'>
    <div class='col-md-12'>
        <div class='portlet light'>
            <div class='portlet-title'>
                <div class='caption'>
                    <?php echo btnBack() ?>
                    <span class='caption-subject bold '>Tambah Data</span>
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
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="" />
                                    </div>
                                </div>
                            </div>
                            
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label class='col-md-3 control-label'>Description <span class="required">*</span> </label>
                                    <div class='col-md-9'>
                                        <input type="text" class="form-control" name="description" id="description" placeholder="Description" value="" />
                                    </div>
                                </div>
                            </div>
                            
                        </div>
              
                    </div>
            
                    <div class='form-actions'>
                        <div class='row'>
                            <div class='col-md-offset-5 col-md-7'>
                                <button type='submit' class='btn blue btn-circle btn-outline'>Simpan Data Baru</button>
                            </div>
                        </div>
                    </div>
                        
                </form>
                
            </div>
        </div>
    </div>
</div> 