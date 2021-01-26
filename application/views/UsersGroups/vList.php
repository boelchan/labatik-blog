<div class='row'>
    <div class='col-md-12'>
        <div class='portlet light bordered'>
            <div class='portlet-title'>
                <div class="caption">
                    <span class="caption-subject font-dark sbold">Data</span>
                </div>
                <div class="actions">
                    <a class="accordion-toggle accordion-toggle-styled collapsed btn btn-circle btn-outline blue" data-toggle="collapse" data-parent="#accordion3" href="#collapse_filter" title="filter pencaran"> <i class="fa fa-search"></i> </a>
                    <?php echo btnCreate() ?>
                </div>
            </div>
            <div class='portlet-body'>
                <div class="panel-group accordion" id="accordion3">
                    <div class="panel panel-default">
                        <div id="collapse_filter" class="panel-collapse collapse">       
                            <div class="panel-body">             
                                <div class="row">
                                    <div class="form-group form-horizontal filter">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">User</label>
                                                <div class="col-md-8">
                                                    <select name='user_id' class='form-control form-filter select2-ajax' data-url='<?php echo site_url('form/dd/UsersModel') ?>'></select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Group</label>
                                                <div class="col-md-8">
                                                    <select name='group_id' class='form-control form-filter select2-ajax' data-url='<?php echo site_url('form/dd/GroupsModel') ?>'></select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-6">
                                                <button class="btn btn-sm blue btn-outline btn-circle filter-submit pull-right"> <i class="fa fa-search fa-lg"></i> Cari</button> </div>
                                            <div class="col-md-6 no-space">
                                                <button class="btn btn-sm red btn-outline btn-circle filter-cancel pull-left"> <i class="fa fa-refresh fa-lg"></i> Reset</button> </div>
                                        </div>
                                    </div>  
                                </div>  
                            </div>  
                        </div>
                    </div>
                </div>
                <div class='table-container'>
                    <div class="table-actions-wrapper">
                        <select class="table-group-action-input form-control input-inline input-small input-sm">
                            <option value="">Pilih</option>
                            <?php echo btnDestroyTable() ?>
                        </select>
                        <button class="btn btn-sm blue btn-icon-only btn-circle btn-outline table-group-action-submit">
                            <i class="fa fa-check fa-lg"> </i> </button>
                            <span> </span>
                    </div>
                    <table class="table table-bordered table-hover" id="tableUsersGroups">
                        <thead>
                            <tr role="row" class="heading" id="tableHeader">
                                <th width="2%"> 
                                    <label class="mt-checkbox mt-checkbox-outline">
                                        <input type="checkbox" class="group-checkable">
                                        <span></span>
                                    </label>    
                                </th>
                        
                                <th>User</th>
                                <th>Group</th>
                                
                                <th width="3%"></th>
                            </tr>
                        </thead>
                        <tbody> </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var datatableAjax = new Datatable();

    datatableAjax.setDefaultParam('<?= $this->security->get_csrf_token_name() ?>', '<?= $this->security->get_csrf_hash() ?>');
    datatableAjax.init({
        src: $("#tableUsersGroups"),
        dataTable: {
            "ajax": {
                "url": "<?php echo site_url('UsersGroups/getDatatable/') ?>"
            },
            "order": [
                [1, "asc"]
            ]
        }
    });
</script>