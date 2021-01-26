<div class='row'>
    <div class='col-md-12'>
        <div class='portlet light'>
            <div class='portlet-title'>
                <div class='caption'>
                    <?php echo btnBack() ?>
                    <span class='caption-subject bold '>Edit <?php echo strtoupper($row->page) ?></span>
                </div>
            </div>
            <div class='portlet-body form'>
            
                <?= form_open($action, 'id="input-form" class="form-horizontal"'); ?>
                    
                    <div class='form-body'> 

                        <div class='row'>
                        
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label class='col-md-2 control-label'>Konten <span class="font-red">*</span> </label>
                                    <?php if ($row->page == 'about') : ?>
                                        <div class='col-md-8'>
                                            <textarea class="form-control summernote" rows="3" name="content" id="content" placeholder="Content"><?php echo $row->content ?></textarea>
                                        </div>
                                    <?php endif ?>
                                    <?php if ($row->page == 'alamat') : ?>
                                        <div class='col-md-9'>
                                            <textarea class="form-control" rows="5" name="content" id="content" placeholder="Content"><?php echo $row->content ?></textarea>
                                            <span class="help-block">Alamat bisa diisi dengan <i>embed google map</i> atau alamat biasa </span>
                                        </div>
                                    <?php endif ?>
                                    <?php if ($row->page == 'telepon') : ?>
                                        <div class='col-md-5'>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-call"></i>
                                                </span>
                                                <input type="text" class="form-control" placeholder="" value="<?php echo $row->content ?>"> 
                                            </div>
                                            <span class="help-block"> Masukkan nomor telepon yang digunakan </span>
                                        </div>
                                    <?php endif ?>
                                    <?php if ($row->page == 'wa') : ?>
                                        <div class='col-md-5'>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-whatsapp"></i>
                                                </span>
                                                <input type="text" class="form-control" placeholder="" value="<?php echo $row->content ?>"> 
                                            </div>
                                            <span class="help-block"> Masukkan nomor WhatsApp yang digunakan </span>
                                        </div>
                                    <?php endif ?>
                                    <?php if ($row->page == 'facebook') : ?>
                                        <div class='col-md-5'>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    facebook.com/
                                                </span>
                                                <input type="text" class="form-control" placeholder="" value="<?php echo $row->content ?>"> 
                                            </div>
                                            <span class="help-block"> Masukkan username/akun facebook yang digunakan </span>
                                        </div>
                                    <?php endif ?>
                                    <?php if ($row->page == 'instagram') : ?>
                                        <div class='col-md-5'>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    instagram.com/
                                                </span>
                                                <input type="text" class="form-control" placeholder="" value="<?php echo $row->content ?>"> 
                                            </div>
                                            <span class="help-block"> Masukkan Akun IG yang digunakan </span>
                                        </div>
                                    <?php endif ?>
                                    <?php if ($row->page == 'youtube') : ?>
                                        <div class='col-md-5'>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    youtube.com/channel/
                                                </span>
                                                <input type="text" class="form-control" placeholder="" value="<?php echo $row->content ?>"> 
                                            </div>
                                            <span class="help-block"> Masukkan Akun Youtube Channel yang digunakan </span>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                            
                        </div>

                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <input type="hidden" name="page" value="<?php echo $row->page; ?>" />
            
                    </div>
            
                    <div class='form-actions'>
                        <div class='row'>
                            <div class='col-md-offset-2 col-md-7'>
                                <button type='submit' class='btn blue btn-circle btn-outline' > Simpan Perubahan  </button>
                            </div>
                        </div>
                    </div>
                        
                <?= form_close() ?>
                    
            </div>
        </div>
    </div>
</div>