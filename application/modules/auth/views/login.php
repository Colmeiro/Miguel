<body class="vertical-layout vertical-menu-modern 1-column  navbar-sticky footer-static bg-light-yellow  blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- login page start -->
                <section id="auth-login" class="row flexbox-container bg-fish-tag-img">
                    <div class="col-md-8 col-xl-4 col-10">
                        <div class="card bg-authentication mb-0">
                            <div class="row m-0">
                                <!-- left section-login -->
                                <div class="col-12 px-0">
                                    <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center">
                                        <div class="card-header pb-1">
                                            <div class="card-title text-center">
                                                <!-- <h4 class="text-center mb-2">Welcome Back</h4> -->
                                                <img class="logo logo-login" src="<?= base_url() . $this->config->item('site_logo') ?>" />
                                                <!-- <p class="logo-text">Seguimiento OPPF-4</p> -->
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="divider">
                                                    <div class="divider-text text-uppercase font-weigth-500 fs-20">ÁREA PRIVADA</div>
                                                </div>
                                                <div class="text-center mb-2">Introduce tus datos a continuación para acceder al área privada.</div>

                                                <?
                                                if ($this->session->flashdata('msg_login')) {
                                                ?>
                                                    <div class="alert alert-danger">
                                                        <?= $this->session->flashdata('msg_login') ?>
                                                    </div>
                                                <?
                                                }
                                                ?>

                                                <form action="<?= site_url('auth/login') ?>" method="post">
                                                    <!-- <div class="form-group mb-50">
                                                        <input type="email" class="form-control" id="username" name="username" placeholder="Email">
                                                    </div> -->

                                                    <div class="form-label-group position-relative has-icon-left mb-50">
                                                        <input type="email" id="username" class="form-control" name="username" placeholder="Email">
                                                        <div class="form-control-position">
                                                            <i class="bx bx-user"></i>
                                                        </div>
                                                    </div>

                                                    <!-- <div class="form-group">
                                                        <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
                                                    </div> -->

                                                    <div class="form-group position-relative has-icon-left">
                                                        <input type="password" id="password" class="form-control" name="password" placeholder="Contraseña">
                                                        <div class="form-control-position">
                                                            <i class="bx bx-lock"></i>
                                                        </div>
                                                    </div>

                                                    <div class="form-group d-flex flex-md-row flex-column justify-content-center align-items-center">
                                                        <div><a href="<?= site_url('auth/forgotpassword') ?>" class="card-link"><small>¿Ha olvidado su clave de acceso?</small></a></div>
                                                    </div>
                                                    <button type="submit" class="btn btn-fish-tag glow w-100 position-relative">ENTRAR<i id="icon-arrow" class="bx bx-right-arrow-alt"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- right section image -->
                                <?/*
                                <div class="col-md-6 d-md-block d-none text-center align-self-center p-3 bg-fish-tag">
                                    <div class="card-content">
                                        <img class="img-fluid" src="<?= base_url(); ?>app-assets/images/pages/fish-tag-background.jpg" alt="Fish-tag Background">
                                    </div>
                                </div>
                                */?>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- login page ends -->

            </div>
        </div>
    </div>
    <!-- END: Content-->

</body>
<!-- END: Body-->

</html>