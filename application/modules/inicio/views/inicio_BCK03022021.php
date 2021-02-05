<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        
        <div class="content-header row">
            <div class="content-header-left col-12 mb-2 mt-1">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                    <?/*<h5 class="content-header-title float-left pr-1 mb-0 no-dash">Dashboard Fish-tag</h5>*/?>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="content-body">
            <!-- Dashboard Ecommerce Starts -->
            <section id="dashboard-ecommerce">
                <div class="row">
                    <?
                    if (modules::run('security/check_gestion_usuarios')) {
                    ?>
                        <!-- Multi Radial Chart Starts -->
                        <div class="col-xl-4 col-lg-6 col-md-6 col-12"><!-- dashboard-visit -->
                            <div class="card card-dashboard">
                                <a href="<?= site_url('privado/usuario') ?>">
                                    <div class="card-content n-mt-mvl">
                                        <div class="row no-gutters">
                                            <div class="col-md-12 col-lg-3 icon-box-card bg-light-green d-none d-sm-flex">
                                                <i class="bx bx-group"></i>
                                            </div>
                                            <div class="col-md-12 col-lg-9">
                                                <div class="card-body border-xs border-color-light-green">
                                                    <h3 class="greeting-text">
                                                        <i class="bx bx-group d-inline-flex icon-xs-mvl d-sm-none color-light-green"></i>
                                                        Gestión de Usuarios</h3>
                                                    <p class="card-text text-ellipsis color-theme">
                                                        Puedes crear, modificar y ver los datos de los usuarios.
                                                    </p>
                                                    <button class="btn btn-fish-tag d-none d-sm-inline-block">Acceder</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Flecha XS -->
                                    <span class="arrow-xs d-flex d-sm-none"><i class="bx bx-chevron-right"></i></span>
                                </a>
                            </div>
                        </div>
                    <?
                    }
                    if (modules::run('security/check_gestion_roles')) {
                    ?>
                        <div class="col-xl-4 col-lg-6 col-md-6 col-12"><!-- dashboard-users -->
                            <div class="card card-dashboard">
                                <a href="<?= site_url('privado/rol') ?>">
                                    <div class="card-content n-mt-mvl">
                                        <div class="row no-gutters">
                                            <div class="col-md-12 col-lg-3 icon-box-card bg-light-orange d-none d-sm-flex">
                                                <i class="bx bx-user-plus"></i>
                                            </div>
                                            <div class="col-md-12 col-lg-9">
                                                <div class="card-body border-xs border-color-light-orange">
                                                    <h3 class="greeting-text">
                                                        <i class="bx bx-user-plus d-inline-flex icon-xs-mvl d-sm-none color-light-orange"></i>
                                                        Gestión de Roles
                                                    </h3>
                                                    <p class="card-text text-ellipsis color-theme">
                                                        Puedes crear, modificar y ver los roles actuales que se le asignan a los usuarios.
                                                    </p>
                                                    <button class="btn btn-fish-tag d-none d-sm-inline-block">Acceder</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Flecha XS -->
                                    <span class="arrow-xs d-flex d-sm-none"><i class="bx bx-chevron-right"></i></span>
                                </a>
                            </div>
                        </div>
                    <?
                    }
                    ?>

                    <div class="col-xl-4 col-lg-6 col-md-6 col-12">
                            <div class="card card-dashboard">
                                <a href="<?= site_url('privado/grupo') ?>">
                                    <div class="card-content n-mt-mvl">
                                        <div class="row no-gutters">
                                            <div class="col-md-12 col-lg-3 icon-box-card bg-light d-none d-sm-flex">
                                                <i class="bx bx-building"></i>
                                            </div>
                                            <div class="col-md-12 col-lg-9">
                                                <div class="card-body border-xs border-color-light">
                                                    <h3 class="greeting-text">
                                                        <i class="bx bx-building d-inline-flex icon-xs-mvl d-sm-none color-light"></i>
                                                        <?= modules::run('security/check_admin') ? 'Gestión de ' : 'Ver ' ?>Grupos
                                                    </h3>
                                                    <p class="card-text text-ellipsis color-theme">
                                                        <?= modules::run('security/check_admin') ? 'Puedes crear, modificar y ver los datos de los grupos.' : 'Puedes ver los datos de los grupos.' ?>
                                                    </p>
                                                    <button class="btn btn-fish-tag d-none d-sm-inline-block">Acceder</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Flecha XS -->
                                    <span class="arrow-xs d-flex d-sm-none"><i class="bx bx-chevron-right"></i></span>
                                </a>
                            </div>
                        </div>

                    <!-- Mi Perfil -->
                    <div class="col-xl-4 col-lg-6 col-md-6 col-12"><!-- dashboard-users -->
                            <div class="card card-dashboard mb-xs-15">
                                <a href="<?=site_url('mi-perfil')?>">
                                    <div class="card-content n-mt-mvl">
                                        <div class="row no-gutters">
                                            <div class="col-md-12 col-lg-3 icon-box-card bg-light-blue d-none d-sm-flex">
                                                <i class="bx bxs-user-detail"></i>
                                            </div>
                                            <div class="col-md-12 col-lg-9">
                                                <div class="card-body border-xs border-color-light-blue">
                                                    <h3 class="greeting-text">
                                                        <i class="bx bxs-user-detail d-inline-flex icon-xs-mvl d-sm-none color-light-blue"></i>
                                                        Mi Perfil
                                                    </h3>
                                                    <p class="card-text text-ellipsis color-theme">
                                                        Consulta todos tus datos personales así como tu rol asignado.
                                                    </p>
                                                    <button class="btn btn-fish-tag d-none d-sm-inline-block">Acceder</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Flecha XS -->
                                    <span class="arrow-xs d-flex d-sm-none"><i class="bx bx-chevron-right"></i></span>
                                </a>
                            </div>
                        </div>                
                    </div>

            </section>
            <!-- Dashboard Ecommerce ends -->

        </div>
    </div>
</div>