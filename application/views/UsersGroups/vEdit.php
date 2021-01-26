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
                                    <label class='col-md-3 control-label'>User <span class="font-red">*</span> </label>
                                    <div class='col-md-9'>
                                        <?php
                                        $user_id = $row->user_id;
                                        $user_id_name = '';                                            
                                        if (!empty($user_id))
                                            $user_id_name = $this->UsersModel->get($user_id)->{$this->UsersModel->label};
                                        ?>
                                        <select name='user_id' class='form-control select2-ajax' data-url='<?php echo site_url('form/dd/UsersModel') ?>'>
                                            <option value="<?php echo $user_id ?>" selected="selected"><?php echo $user_id_name ?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label class='col-md-3 control-label'>Group <span class="font-red">*</span> </label>
                                    <div class='col-md-9'>
                                        <?php
                                        $group_id = $row->group_id;
                                        $group_id_name = '';                                            
                                        if (!empty($group_id))
                                            $group_id_name = $this->GroupsModel->get($group_id)->{$this->GroupsModel->label};
                                        ?>
                                        <select name='group_id' class='form-control select2-ajax' data-url='<?php echo site_url('form/dd/GroupsModel') ?>'>
                                            <option value="<?php echo $group_id ?>" selected="selected"><?php echo $group_id_name ?></option>
                                        </select>
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