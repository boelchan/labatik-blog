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
                                    <label class='col-md-3 control-label'>Kategori Seo</label>
                                    <div class='col-md-9'>
                                        <input type="text" class="form-control" name="kategori_seo" id="kategori_seo" placeholder="Kategori Seo" value="<?php echo $row->kategori_seo ?>" />
                                    </div>
                                </div>
                            </div>
                            
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label class='col-md-3 control-label'>Kategori <span class="font-red">*</span> </label>
                                    <div class='col-md-9'>
                                        <input type="text" class="form-control" name="kategori" id="kategori" placeholder="Kategori" value="<?php echo $row->kategori ?>" />
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <input type="hidden" name="id_kategori" value="<?php echo $id_kategori; ?>" />
            
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