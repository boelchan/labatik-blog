<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Blog - Labatik ID</title>

    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Blog - Labatik ID">
    <meta name="author" content="SW-THEMES">
        
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo base_url() ?>assets/front/images/icons/favicon.ico">
    
    <script type="text/javascript">
        
    </script>
    
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/css/bootstrap.min.css">

    <!-- Main CSS File -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/css/style.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/css/custom.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/front/vendor/fontawesome-free/css/all.min.css">
</head>
<body>
    <div class="page-wrapper">
        <header class="header">
            <div class="header-middle sticky-header">
                <div class="container">
                    <div class="header-center">
                        <a href="<?php echo site_url() ?>" class="logo">
                            <img src="<?php echo base_url() ?>uploads/logo/logo-2.png" width="200px" alt="labatik Logo">
                        </a>
                    </div><!-- End .header-left -->

                </div><!-- End .container -->
            </div><!-- End .header-middle -->
        </header><!-- End .header -->

        <main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo site_url() ?>"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $this->title ?></li>
                    </ol>
                </div><!-- End .container -->
            </nav>

            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <?php echo $page_content ?>
                    </div><!-- End .col-lg-9 -->

                    <aside class="sidebar col-lg-3">
                        <div class="sidebar-wrapper">
                            <div class="widget widget-search">
                                <form role="search" method="get" class="search-form" action="#">
                                    <input type="search" class="form-control" placeholder="Search posts here..." name="s" required>
                                    <button type="submit" class="search-submit" title="Search">
                                        <i class="icon-search"></i>
                                        <span class="sr-only">Search</span>
                                    </button>
                                </form>
                            </div><!-- End .widget -->


                            <div class="widget">
                                <h4 class="widget-title">Artikel Terbaru</h4>

                                <ul class="simple-entry-list">
                                    <?php if ($populer) : ?>
                                    <?php foreach ($populer as $po) : ?>
                                        <li>
                                            <!-- <div class="entry-media">
                                                <a href="<?php echo site_url('artikel/'.$po->judul_seo) ?>">
                                                    <img src="<?php echo load_image("blog_post_banner/".$po->banner_img, 'thumb')  ?>" alt="Post">
                                                </a>
                                            </div> -->
                                            <div class="entry-info">
                                                <a href="<?php echo site_url('artikel/'.$po->judul_seo) ?>"><?php echo ellipsize($po->judul, 50) ?></a>
                                                <div class="entry-meta">
                                                <?php echo convertDate($po->status_date) ?>
                                                </div><!-- End .entry-meta -->
                                            </div><!-- End .entry-info -->
                                        </li>
                                    <?php endforeach ?>
                                    <?php endif ?>
                                </ul>
                            </div><!-- End .widget -->
<!-- 
                            <div class="widget">
                                <h4 class="widget-title">Tagcloud</h4>

                                <div class="tagcloud">
                                    <a href="#">Fashion</a>
                                    <a href="#">Shoes</a>
                                    <a href="#">Skirts</a>
                                    <a href="#">Dresses</a>
                                    <a href="#">Bags</a>
                                </div>
                            </div>

                            <div class="widget">
                                <h4 class="widget-title">Archive</h4>

                                <ul class="list">
                                    <li><a href="#">April 2018</a></li>
                                    <li><a href="#">March 2018</a></li>
                                    <li><a href="#">February 2018</a></li>
                                </ul>
                            </div> -->


                           
                        </div><!-- End .sidebar-wrapper -->
                    </aside><!-- End .col-lg-3 -->
                </div><!-- End .row -->
            </div><!-- End .container -->

            <div class="mb-6"></div><!-- margin -->
        </main><!-- End .main -->

        <footer class="footer">
            <div class="footer-middle">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="widget">
                                <h4 class="widget-title">MITRA</h4>
                                <ul class="links">
                                    <li><a href="https://labatik.id" target="_blank">Labatik Store</a></li>
                                </ul>
                            </div><!-- End .widget -->
                        </div><!-- End .col-lg-4 -->

                        <div class="col-lg-3">
                            <div class="widget widget-social">
                                <h4 class="widget-title">Ikuti kami</h4>
                                <a href="https://www.facebook.com/<?php echo $this->page_c['facebook'] ?>" class="social-icon" target="_blank"><i class="icon-facebook"></i></a>
                                <a href="https://www.instagram.com/<?php echo $this->page_c['instagram'] ?>" class="social-icon" target="_blank"><i class="icon-instagram"></i></a>
                                <a href="https://www.youtube.com/channel/<?php echo $this->page_c['youtube'] ?>" class="social-icon" target="_blank"><i class="fab fa-youtube"></i></a>
                            </div><!-- End .widget -->
                        </div><!-- End .col-lg-2 -->


                        
                        <div class="col-lg-6 col-md-4 col-sm-6">
                            <div class="footer-left widget-newsletter">
                                <div class="widget-newsletter-info">
                                    <h4 class="widget-title">Belangganan Artikel</h4>
                                    <p class="widget-newsletter-content">Dapatkan semua informasi terbaru tentang Acara, Penjualan, dan Promo.</p>
                                </div>
                                <form action="#">
                                    <div class="footer-submit-wrapper">
                                        <input type="email" class="form-control" placeholder="Email address..." required="">
                                        <button type="submit" class="btn">Langganan</button>
                                    </div>
                                </form>
                            </div>
                            
                        </div><!-- End .col-lg-6 -->

                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .footer-middle -->


            <div class="footer-bottom">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-4">
                            <p class="footer-copyright">Labatik.id &copy;  2020.  All Rights Reserved</p>
                        </div><!-- End .col-lg-4 -->

                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .footer-bottom -->
        </footer><!-- End .footer -->
    </div><!-- End .page-wrapper -->

    <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->


    <style>
            .float{
                position:fixed;
                width:50px;
                height:50px;
                bottom:45px;
                right:10px;
                background-color:#25d366;
                color:#FFF;
                border-radius:50px;
                text-align:center;
                font-size:30px;
                /* box-shadow: 1px 1px 1px #999; */
                z-index:100;
            }

    </style>
    <a href="https://api.whatsapp.com/send?phone=<?php echo $this->page_c['wa'] ?>&text=Halo%20Labatik" class="float" target="_blank">
        <i class="fab fa-whatsapp my-float"></i> 
    </a>

    <a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>

    <!-- Plugins JS File -->
    <script src="<?php echo base_url() ?>assets/front/js/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/front/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url() ?>assets/front/js/plugins.min.js"></script>

    <!-- Main JS File -->
    <script src="<?php echo base_url() ?>assets/front/js/main.min.js"></script>
</body>
</html>