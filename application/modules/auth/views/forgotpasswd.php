<body class="vertical-layout vertical-menu-modern 1-column  navbar-sticky footer-static bg-light-yellow  blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
  <!-- BEGIN: Content-->
  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
        <!-- login page start -->
        <section id="auth-login" class="row flexbox-container fpass bg-fish-tag-img">
          <div class="col-md-8 col-xl-4 col-10">
            <div class="card bg-authentication mb-0">
              <div class="row m-0">
                <!-- left section-login -->
                <div class="col-12 px-0">
                  <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center">
                    <div class="card-header pb-1">
                      <div class="card-title text-center">
                        <!-- <h4 class="text-center mb-2">Welcome Back</h4> -->
                        <a href="<?=site_url('')?>">
                          <img class="logo logo-login" src="<?= base_url() . $this->config->item('site_logo') ?>" />
                          <!-- <p class="logo-text">Seguimiento OPPF-4</p> -->
                        </a>
                      </div>
                    </div>
                    <div class="card-content">
                      <div class="card-body">
                        <div class="divider">
                          <div class="divider-text text-uppercase font-weigth-500 fs-20">RESTABLECER CONTRASEÑA</div>
                        </div>
                        <div class="text-center mb-2">Introduce tu email para cambiar la contraseña</div>

                        <?
                        if ($this->session->flashdata('msg_forgot_right')) {
                        ?>
                          <div class="alert alert-success">
                            <?= $this->session->flashdata('msg_forgot_right') ?>
                          </div>
                        <? 
                        } else if ($this->session->flashdata('msg_forgot_wrong')) {
                        ?>
                          <div class="alert alert-danger">
                            <?= $this->session->flashdata('msg_forgot_wrong') ?>
                          </div>
                        <? 
                        } 
                        ?>

                        <form action="<?= site_url('auth/forgotpassword') ?>" method="post">
                          <!-- <div class="form-group mb-50">
                            <input type="email" class="form-control" name="username" placeholder="Email de Acceso">
                          </div> -->

                          <div class="form-label-group position-relative has-icon-left mb-50">
                              <input type="email" class="form-control" name="username" placeholder="Email de Acceso">
                              <div class="form-control-position">
                                  <i class="bx bx-user"></i>
                              </div>
                          </div>

                          <div class="form-group d-flex flex-md-row flex-column justify-content-center align-items-center">
                              <div><a href="<?= site_url('auth/login') ?>" class="card-link"><small><- Volver a Pantalla de Login</small></a></div>
                          </div>

                          <button type="submit" class="btn btn-fish-tag glow w-100 position-relative text-uppercase">Restablecer Constraseña<i id="icon-arrow" class="bx bx-right-arrow-alt"></i></button>

                        </form>

                      </div>
                    </div>
                  </div>
                </div>
                <!-- right section image -->
                <?/*
                <div class="col-md-6 d-md-block d-none text-center align-self-center p-3 bg-fish-tag">
                  <div class="card-content">
                    <img class="img-fluid" src="<?= base_url(); ?>app-assets/images/pages/fish-tag-background-2.jpg" alt="Fish-tag Background">
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