<?php if ($post) : ?>
    <?php foreach ($post as $p ) : ?>
    <article class="entry">
        <div class="entry-media">
            <a href="<?php echo site_url('blog/'.$p->blog_kategori_id.'/'.$p->id_blog_post) ?>">
                <div class="entry-slider owl-carousel owl-theme owl-theme-light">
                    <img src="<?php echo base_url() ?>assets/front/images/blog/post-1.jpg" alt="Post">
                    <img src="<?php echo base_url() ?>assets/front/images/blog/post-2.jpg" alt="Post">
                    <img src="<?php echo base_url() ?>assets/front/images/blog/post-3.jpg" alt="Post">
                </div><!-- End .entry-slider -->
            </a>
        </div><!-- End .entry-media -->

        <div class="entry-body">
            <div class="entry-date">
                <span class="day">29</span>
                <span class="month">Jun</span>
            </div><!-- End .entry-date -->

            <h2 class="entry-title">
                <a href="<?php echo site_url('blog/'.$p->blog_kategori_id.'/'.$p->id_blog_post) ?>"><?php echo $p->judul ?></a>
            </h2>

            <div class="entry-content">
                <p><?php echo ellipsize($p->konten, 200) ?></p>

                <a href="<?php echo site_url('blog/'.$p->blog_kategori_id.'/'.$p->id_blog_post) ?>" class="read-more">Read More <i class="icon-angle-double-right"></i></a>
            </div><!-- End .entry-content -->

            <div class="entry-meta">
                <span><i class="icon-calendar"></i>June 29, 2018</span>
                <span><i class="icon-user"></i>By <a href="#">Admin</a></span>
                <span><i class="icon-folder-open"></i>
                    <a href="<?php echo site_url('blog/'.$p->blog_kategori_id) ?>"><?php echo $p->kategori->kategori ?></a>
                </span>
            </div><!-- End .entry-meta -->
        </div><!-- End .entry-body -->
    </article><!-- End .entry -->

<?php endforeach ?>
<?php else: ?>
    Belum ada artikel pada kategori ini.
<?php endif ?>