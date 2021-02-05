<div class="header-navbar-shadow"></div>
<nav class="header-navbar main-header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top ">
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="navbar-collapse" id="navbar-mobile">
                <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                <div class="brand-logo-fish-tag d-xl-none"><a href="<?= base_url(); ?>"><img class="logo" src="<?= base_url() . $this->config->item('site_logo') ?>" /></a></div>

                <? if ($main!='inicio') { ?>
                <ol class="breadcrumb br-home d-none d-xl-flex">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active text-capitalize"><?= $titulo ?>
                    </li>
                </ol>
                <? } else {?>
                    <!--
                    <ul class="nav navbar-nav">
                        <li class="nav-item mobile-menu d-none d-xl-none d-lg-block d-md-block d-sm-block mr-auto"><a class="nav-link nav-menu-main menu-toggle" href="#"><i class="ficon bx bx-menu"></i></a></li>
                    </ul>-->
                     <!-- <ul class="nav navbar-nav bookmark-icons d-none d-xl-flex">
                        <li class="nav-item d-none d-lg-block"><a class="nav-link" href="#" data-toggle="tooltip" data-placement="top" title="Email"><i class="ficon bx bx-envelope"></i></a></li>
                        <li class="nav-item d-none d-lg-block"><a class="nav-link" href="#" data-toggle="tooltip" data-placement="top" title="Chat"><i class="ficon bx bx-chat"></i></a></li>
                        <li class="nav-item d-none d-lg-block"><a class="nav-link" href="#" data-toggle="tooltip" data-placement="top" title="Todo"><i class="ficon bx bx-check-circle"></i></a></li>
                        <li class="nav-item d-none d-lg-block"><a class="nav-link" href="#" data-toggle="tooltip" data-placement="top" title="Calendario"><i class="ficon bx bx-calendar-alt"></i></a></li>
                    </ul> -->
                    <!-- <ul class="nav navbar-nav d-none d-xl-flex">
                        <li class="nav-item d-none d-lg-block"><a class="nav-link bookmark-star"><i class="ficon bx bx-star warning"></i></a>
                            <div class="bookmark-input search-input">
                                <div class="bookmark-input-icon"><i class="bx bx-search primary"></i></div>
                                <input class="form-control input" type="text" placeholder="Explorar..." tabindex="0" data-search="template-search">
                                <ul class="search-list"></ul>
                            </div>
                        </li>
                    </ul>  -->
                <? } ?>
                </div>
                <ul class="nav navbar-nav float-right">
                    <!-- <li class="dropdown dropdown-language nav-item"><a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-us"></i><span class="selected-language">English</span></a>
                        <div class="dropdown-menu" aria-labelledby="dropdown-flag"><a class="dropdown-item" href="#" data-language="en"><i class="flag-icon flag-icon-us mr-50"></i> English</a><a class="dropdown-item" href="#" data-language="fr"><i class="flag-icon flag-icon-fr mr-50"></i> French</a><a class="dropdown-item" href="#" data-language="de"><i class="flag-icon flag-icon-de mr-50"></i> German</a><a class="dropdown-item" href="#" data-language="pt"><i class="flag-icon flag-icon-pt mr-50"></i> Portuguese</a></div>
                    </li>-->
                    <!-- <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon bx bx-fullscreen"></i></a></li> -->
            
                    <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <div class="user-nav d-sm-flex d-none">
                                <span class="user-name"><?=$this->session->userdata('nombre')?> (<?=$this->session->userdata('rol')?>)</span>
                                <!-- <span class="user-status text-muted">Available</span> -->
                            </div>
                            <!--<span class="hidden-xs"><img class="round" src="<?= base_url(); ?>app-assets/images/icon/user-icon.jpg" alt="avatar" height="40" width="40"></span>-->
                            <span><i class="bx bx-user mr-50 usericon"></i></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right pb-0 pt-0">
                            <a class="dropdown-item text-transform-initial d-block d-sm-none" href="<?=site_url('mi-perfil')?>"><i class="bx bx-user mr-50"></i> Hola <?=$this->session->userdata('name')?></a>
                            <a class="dropdown-item text-transform-initial" href="<?=site_url('mi-perfil')?>"><i class="bx bxs-user-detail mr-50"></i> Mi Perfil</a>
                            <a class="dropdown-item text-transform-initial" href="<?=site_url('auth/forgotpassword')?>"><i class="bx bx-lock-alt mr-50"></i> Cambiar Contraseña</a>
                            <div class="dropdown-divider mb-0"></div> 
                            <a class="dropdown-item text-transform-initial" href="<?=site_url('auth/logout')?>"><i class="bx bx-log-out mr-50"></i> Cerrar Sesión</a>
                        </div>
                    </li>


                    <li class="nav-item mobile-menu d-xl-none"><a class="nav-link nav-menu-main menu-toggle" href="#"><i class="ficon bx bx-menu"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>