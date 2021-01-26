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
                        <tr>
                            <td>Ip Address</td>
                            <td><?php echo $row->ip_address; ?></td>
                        </tr>
                        <tr>
                            <td>Username</td>
                            <td><?php echo $row->username; ?></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td><?php echo $row->password; ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?php echo $row->email; ?></td>
                        </tr>
                        <tr>
                            <td>Activation Selector</td>
                            <td><?php echo $row->activation_selector; ?></td>
                        </tr>
                        <tr>
                            <td>Activation Code</td>
                            <td><?php echo $row->activation_code; ?></td>
                        </tr>
                        <tr>
                            <td>Forgotten Password Selector</td>
                            <td><?php echo $row->forgotten_password_selector; ?></td>
                        </tr>
                        <tr>
                            <td>Forgotten Password Code</td>
                            <td><?php echo $row->forgotten_password_code; ?></td>
                        </tr>
                        <tr>
                            <td>Forgotten Password Time</td>
                            <td><?php echo $row->forgotten_password_time; ?></td>
                        </tr>
                        <tr>
                            <td>Remember Selector</td>
                            <td><?php echo $row->remember_selector; ?></td>
                        </tr>
                        <tr>
                            <td>Remember Code</td>
                            <td><?php echo $row->remember_code; ?></td>
                        </tr>
                        <tr>
                            <td>Created On</td>
                            <td><?php echo $row->created_on; ?></td>
                        </tr>
                        <tr>
                            <td>Last Login</td>
                            <td><?php echo $row->last_login; ?></td>
                        </tr>
                        <tr>
                            <td>Active</td>
                            <td><?php echo $row->active; ?></td>
                        </tr>
                        <tr>
                            <td>First Name</td>
                            <td><?php echo $row->first_name; ?></td>
                        </tr>
                        <tr>
                            <td>Last Name</td>
                            <td><?php echo $row->last_name; ?></td>
                        </tr>
                        <tr>
                            <td>Company</td>
                            <td><?php echo $row->company; ?></td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td><?php echo $row->phone; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>