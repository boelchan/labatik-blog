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
                        <?php echo btnEdit($row->id_post) ?>
                    </div>
                </div>
                <div class='portlet-body'>
                    <table class="table">
                        <tr>
                            <td>Judul Seo</td>
                            <td><?php echo $row->judul_seo; ?></td>
                        </tr>
                        <tr>
                            <td>Judul</td>
                            <td><?php echo $row->judul; ?></td>
                        </tr>
                        <?php
                            $blog_kategori_id = $row->blog_kategori_id;
                            if (!empty($blog_kategori_id)) 
                            {
                                $blog_kategori_id_name = $this->BlogKategoriModel->get($blog_kategori_id)->{$this->blogKategoriModel->label};
                            }
                            else
                            {
                                $blog_kategori_id_name = '';
                            }
                        ?>
                        <tr>
                            <td>Blog Kategori</td>
                            <td><?php echo $blog_kategori_id_name; ?></td>
                        </tr>
                        <tr>
                            <td>Konten</td>
                            <td><?php echo $row->konten; ?></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td><?php echo $row->status; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>