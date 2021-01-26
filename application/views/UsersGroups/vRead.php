<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='portlet light'>
                <div class='portlet-title'>
                    <div class='caption'>
                        <?php echo btnBack() ?>
                        <span class='caption-subject bold'></span>
                    </div>
                    <div class="actions">
                        <?php echo btnEdit($row->id) ?>
                    </div>
                </div>
                <div class='portlet-body'>
                    <table class="table">
                        <?php
                            $user_id = $row->user_id;
                            if (!empty($user_id)) 
                            {
                                $user_id_name = $this->UsersModel->get($user_id)->{$this->UsersModel->label};
                            }
                            else
                            {
                                $user_id_name = '';
                            }
                        ?>
                        <tr>
                            <td>User</td>
                            <td><?php echo $user_id_name; ?></td>
                        </tr>
                        <?php
                            $group_id = $row->group_id;
                            if (!empty($group_id)) 
                            {
                                $group_id_name = $this->GroupsModel->get($group_id)->{$this->GroupsModel->label};
                            }
                            else
                            {
                                $group_id_name = '';
                            }
                        ?>
                        <tr>
                            <td>Group</td>
                            <td><?php echo $group_id_name; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>