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
                                    <label class='col-md-3 control-label'>User <span class="font-red">*</span> </label>
                                    <div class='col-md-9'>
                                        <select name='user_id' class='form-control select2-ajax' data-url='<?php echo site_url('form/dd/UsersModel') ?>'> </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label class='col-md-3 control-label'>Group <span class="font-red">*</span> </label>
                                    <div class='col-md-9'>
                                        <select name='group_id' class='form-control select2-ajax' data-url='<?php echo site_url('form/dd/GroupsModel') ?>'> </select>
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