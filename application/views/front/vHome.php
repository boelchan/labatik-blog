<?php if ($artikel) : ?>
    <?php foreach ($artikel as $p ) : ?>
        <article class="entry">
            <div class="entry-media">
                <a href="<?php echo site_url('artikel/'.$p->judul_seo) ?>">
                    <div class="entry-slider owl-carousel owl-theme owl-theme-light">
                        <img src="<?php echo load_image("blog_post_banner/".$p->banner_img) ?>" alt="Post">
                    </div><!-- End .entry-slider -->
                </a>
            </div><!-- End .entry-media -->

            <div class="entry-body">
                <?php $tgl = convertDate($p->status_date, true) ?>
                <div class="entry-date">
                    <span class="day"><?php echo $tgl[2] ?></span>
                    <span class="month"><?php echo $tgl[3] ?></span>
                </div><!-- End .entry-date -->

                <h2 class="entry-title">
                    <a href="<?php echo site_url('artikel/'.$p->judul_seo) ?>"><?php echo $p->judul ?></a>
                </h2>

                <div class="entry-content">
                    <p><?php echo ellipsize($p->konten, 200) ?></p>

                    <a href="<?php echo site_url('artikel/'.$p->judul_seo) ?>" class="read-more">Baca <i class="icon-angle-double-right"></i></a>
                </div><!-- End .entry-content -->

                <div class="entry-meta">
                    <span><i class="icon-calendar"></i><?php echo convertDate($p->status_date) ?></span>
                    <span><i class="icon-user"></i>By <a href="#">Admin</a></span>

                </div><!-- End .entry-meta -->
            </div><!-- End .entry-body -->
        </article><!-- End .entry -->

    <?php endforeach ?>

    <nav class="toolbox toolbox-pagination">
        <ul class="pagination">
            <?php echo $pagination; ?>
        </ul>
    </nav>
<?php else: ?>
    Belum ada artikel pada halaman ini.
<?php endif ?>