<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">

        <div class="content-header row">
            <div class="content-header-left col-12 mb-2 mt-1">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h5 class="content-header-title float-left pr-1 mb-0 no-dash">Panel de control</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-body">
            <!-- Dashboard Ecommerce Starts -->
            <section id="dashboard-ecommerce">
                <div class="row">

                    <?php
                    if (modules::run('security/check_gestion_usuarios')) {
                    ?>
                        <div class="col-md-4 col-sm-6 kb-search-content">
                            <div class="card kb-hover-1">
                                <div class="card-content">
                                    <div class="card-body text-center">
                                        <a href="<?= site_url('privado/usuario') ?>">
                                            <div class="icon-dash mb-1">
                                                <i class="bx bx-user"></i>
                                            </div>
                                            <h5>Gestión de Usuarios</h5>
                                            <p class=" text-muted">Puedes crear, modificar y ver los datos de los usuarios.</p>
                                            <button class="btn btn-primary btn-sm d-none d-sm-inline-block">Acceder</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php
                    if (modules::run('security/check_gestion_roles')) {
                    ?>
                        <div class="col-md-4 col-sm-6 kb-search-content">
                            <div class="card kb-hover-1">
                                <div class="card-content">
                                    <div class="card-body text-center">
                                        <a href="<?= site_url('privado/rol') ?>">
                                            <div class="icon-dash mb-1">
                                                <i class="bx bx-user-plus"></i>
                                            </div>
                                            <h5>Gestión de Roles</h5>
                                            <p class=" text-muted">Crea y modifica los roles actuales que se le asignan a los usuarios.</p>
                                            <button class="btn btn-primary btn-sm d-none d-sm-inline-block">Acceder</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php
                    if (modules::run('security/check_gestion_roles')) {
                    ?>
                    <div class="col-md-4 col-sm-6 kb-search-content">
                        <div class="card kb-hover-1">
                            <div class="card-content">
                                <div class="card-body text-center">
                                    <a href="<?= site_url('privado/grupo') ?>">
                                        <div class="icon-dash mb-1">
                                            <i class="bx bx-group"></i>
                                        </div>
                                        <h5><?= modules::run('security/check_admin') ? 'Gestión de ' : 'Ver ' ?>Grupos</h5>
                                        <p class=" text-muted"><?= modules::run('security/check_admin') ? 'Puedes crear, modificar y ver los datos de los grupos.' : 'Puedes ver los datos de los grupos.' ?></p>
                                        <button class="btn btn-primary btn-sm d-none d-sm-inline-block">Acceder</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                    <?php
                    //if (modules::run('security/check_gestion_roles')) {
                    ?>
                    <!-- <div class="col-md-4 col-sm-6 kb-search-content">
                        <div class="card kb-hover-1">
                            <div class="card-content">
                                <div class="card-body text-center">
                                    <a href="<?= site_url('privado/almacen') ?>">
                                        <div class="icon-dash mb-1">
                                        <i class="bx bx-buildings"></i>
                                        </div>
                                        <h5>Almacén</h5>
                                        <p class=" text-muted"><?='Puedes ver los datos de Almacén.' ?></p>
                                        <button class="btn btn-secondary btn-sm d-none d-sm-inline-block">Acceder</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <?php //} ?>

                    <!-- Mi Perfil -->
                    <div class="col-md-4 col-sm-6 kb-search-content">
                        <div class="card kb-hover-1">
                            <div class="card-content">
                                <div class="card-body text-center">
                                    <a href="<?= site_url('mi-perfil') ?>">
                                        <div class="icon-dash mb-1">
                                            <i class="bx bx-id-card"></i>
                                        </div>
                                        <h5>Mi Perfil</h5>
                                        <p class=" text-muted">Consulta tus datos personales y rol asignado.</p>
                                        <button class="btn btn-primary btn-sm d-none d-sm-inline-block">Acceder</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Contactos -->
                    <div class="col-md-4 col-sm-6 kb-search-content">
                        <div class="card kb-hover-1">
                            <div class="card-content">
                                <div class="card-body text-center">
                                    <a href="<?= site_url('privado/contacto') ?>">
                                        <div class="icon-dash mb-1">
                                            <i class="bx bx-user"></i>
                                        </div>
                                        <h5>Contactos</h5>
                                        <p class=" text-muted">Consulta y edita los contactos guardados.</p>
                                        <button class="btn btn-primary btn-sm d-none d-sm-inline-block">Acceder</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Productos -->
                    <div class="col-md-4 col-sm-6 kb-search-content">
                        <div class="card kb-hover-1">
                            <div class="card-content">
                                <div class="card-body text-center">
                                    <a href="<?= site_url('privado/producto') ?>">
                                        <div class="icon-dash mb-1">
                                            <i class="bx bx-user"></i>
                                        </div>
                                        <h5>Productos</h5>
                                        <p class=" text-muted">Gestiona los productos guardados.</p>
                                        <button class="btn btn-primary btn-sm d-none d-sm-inline-block">Acceder</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

            </section>
            <!-- Dashboard Ecommerce ends -->

        </div>
    </div>
</div>