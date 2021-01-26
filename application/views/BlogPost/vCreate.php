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
            
                <?php echo form_open_multipart($action, 'id="input-form" class="form-horizontal"'); ?>

                    <div class='form-body'> 

                        <div class='row'>
                        
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label class='col-md-2 control-label'> Banner</label>
                                    <div class='col-md-9'>
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                            </div>
                                            <div>
                                                <span class="btn blue btn-outline btn-file">
                                                    <span class="fileinput-new"> Select image </span>
                                                    <span class="fileinput-exists"> Change </span>
                                                    <input type="file" name="image" value=""> </span>
                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label class='col-md-2 control-label'>Judul <span class="font-red">*</span> </label>
                                    <div class='col-md-4'>
                                        <input type="text" class="form-control" name="judul" id="judul" placeholder="Judul" value="" />
                                    </div>
                                </div>
                            </div>
                            
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label class='col-md-2 control-label'>Konten <span class="font-red">*</span> </label>
                                    <div class='col-md-9'>
                                        <textarea class="form-control summernote" rows="3" name="konten" id="konten" placeholder="Konten"></textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label class='col-md-2 control-label'>Status</label>
                                    <div class='col-md-4'>
                                        <?php echo form_dropdown('status', $optionStatus, null, 'class="form-control"'); ?>
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
                        
                <?php echo form_close() ?>
                
            </div>
        </div>
    </div>
</div> 