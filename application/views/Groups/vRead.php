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
                            <td>Name</td>
                            <td><?php echo $row->name; ?></td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td><?php echo $row->description; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>