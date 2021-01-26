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
                        <?php echo btnEdit($row->id_kategori) ?>
                    </div>
                </div>
                <div class='portlet-body'>
                    <table class="table">
                        <tr>
                            <td>Kategori Seo</td>
                            <td><?php echo $row->kategori_seo; ?></td>
                        </tr>
                        <tr>
                            <td>Kategori</td>
                            <td><?php echo $row->kategori; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>