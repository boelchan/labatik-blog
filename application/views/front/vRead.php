<article class="entry single">
    <div class="entry-media">
        <div class="entry-slider owl-carousel owl-theme owl-theme-light">
            <img src="<?php echo load_image("blog_post_banner/".$artikel->banner_img) ?>" alt="Post">
        </div><!-- End .entry-slider -->
    </div><!-- End .entry-media -->

    <div class="entry-body">
        <?php $tgl = convertDate($artikel->status_date, true) ?>
        <div class="entry-date">
            <span class="day"><?php echo $tgl[2] ?></span>
            <span class="month"><?php echo $tgl[3] ?></span>
        </div><!-- End .entry-date -->

        <h2 class="entry-title">
            <?php echo $artikel->judul ?>
        </h2>

        <div class="entry-meta">
            <span><i class="icon-calendar"></i><?php echo convertDate($artikel->status_date) ?></span>
            <span><i class="icon-user"></i>By <a href="#">Admin</a></span>
        </div><!-- End .entry-meta -->

        <div class="entry-content">
            <?php echo $artikel->konten ?>
        </div><!-- End .entry-content -->

        <div class="entry-share">
            <h3>
                <i class="icon-forward"></i>
                Share this post
            </h3>

            <div class="social-icons">
                <a href="#" class="social-icon social-facebook" target="_blank" title="Facebook">
                    <i class="icon-facebook"></i>
                </a>
                <a href="#" class="social-icon social-twitter" target="_blank" title="Twitter">
                    <i class="icon-twitter"></i>
                </a>
                <a href="#" class="social-icon social-linkedin" target="_blank" title="Linkedin">
                    <i class="icon-linkedin"></i>
                </a>
                <a href="#" class="social-icon social-gplus" target="_blank" title="Google +">
                    <i class="icon-gplus"></i>
                </a>
                <a href="#" class="social-icon social-mail" target="_blank" title="Email">
                    <i class="icon-mail-alt"></i>
                </a>
            </div><!-- End .social-icons -->
        </div><!-- End .entry-share -->


    <?php if (false) : ?>

        <div class="entry-author">
            <h3><i class="icon-user"></i>Author</h3>

            <figure>
                <a href="#">
                    <img src="assets/images/blog/author.jpg" alt="author">
                </a>
            </figure>

            <div class="author-content">
                <h4><a href="#">John Doe</a></h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab officia culpa corporis, quidem placeat minima unde vel veniam laboriosam et animi, inventore delectus, officiis doloribus ex amet illum ea suscipit!</p>
            </div><!-- End .author.content -->
        </div><!-- End .entry-author -->

        <div class="comment-respond">
            <h3>Leave a Reply</h3>
            <p>Your email address will not be published. Required fields are marked *</p>

            <form action="#">
                <div class="form-group required-field">
                    <label>Comment</label>
                    <textarea cols="30" rows="1" class="form-control" required></textarea>
                </div><!-- End .form-group -->

                <div class="form-group required-field">
                    <label>Name</label>
                    <input type="text" class="form-control" required>
                </div><!-- End .form-group -->

                <div class="form-group required-field">
                    <label>Email</label>
                    <input type="email" class="form-control" required>
                </div><!-- End .form-group -->

                <div class="form-group">
                    <label>Website</label>
                    <input type="url" class="form-control">
                </div><!-- End .form-group -->
                
                <div class="form-group-custom-control mb-3">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="save-name">
                        <label class="custom-control-label" for="save-name">Save my name, email, and website in this browser for the next time I comment.</label>
                    </div><!-- End .custom-checkbox -->
                </div><!-- End .form-group-custom-control -->

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary">Post Comment</button>
                </div><!-- End .form-footer -->
            </form>
        </div><!-- End .comment-respond -->
        <?php endif ?>

    </div><!-- End .entry-body -->
</article><!-- End .entry -->

<div class="related-posts">
    <h4 class="light-title"> Artikel <strong>Terbaru</strong></h4>

    <div class="owl-carousel owl-theme related-posts-carousel">
        <?php foreach ( $terbaru as $baru) : ?>
            <article class="entry">
                <div class="entry-media">
                    <a href="<?php echo site_url('artikel/'.$baru->judul_seo) ?>">
                        <img src="<?php echo load_image("blog_post_banner/".$baru->banner_img, 'thumb')  ?>" alt="Post">
                    </a>
                </div><!-- End .entry-media -->

                <div class="entry-body">
                    <?php $tgl = convertDate($baru->status_date, true) ?>
                    <div class="entry-date">
                        <span class="day"><?php echo $tgl[2] ?></span>
                        <span class="month"><?php echo $tgl[3] ?></span>
                    </div><!-- End .entry-date -->

                    <h2 class="entry-title">
                        <a href="<?php echo site_url('artikel/'.$baru->judul_seo) ?>"><?php echo ellipsize($baru->judul,50) ?></a>
                    </h2>

                    <div class="entry-content">
                        <p><?php echo ellipsize($baru->konten, 100) ?></p>

                        <a href="<?php echo site_url('artikel/'.$baru->judul_seo) ?>" class="read-more">Read More <i class="icon-angle-double-right"></i></a>
                    </div><!-- End .entry-content -->
                </div><!-- End .entry-body -->
            </article>
        <?php endforeach ?>

    </div><!-- End .owl-carousel -->
</div><!-- End .related-posts -->