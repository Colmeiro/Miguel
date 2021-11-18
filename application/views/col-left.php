<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow expanded" data-scroll-to-active="true">
    <div class="navbar-header d-none d-xl-block">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="<?= base_url(); ?>">
                    <div class="brand-logo">
                        <img class="logo" src="<?= base_url() . $this->config->item('site_logo') ?>" />
                        <!-- <span class="title-logo">Seg. OPPF-4</span> -->
                    </div>
                    <div class="brand-logo brand-expand"><img class="logo" src="<?= base_url() . $this->config->item('site_logosmall') ?>" /></div>
                    
                    <!-- <h2 class="brand-text mb-0">Frest</h2> -->
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="bx bx-x d-block d-xl-none font-medium-4 primary"></i><i class="toggle-icon bx bx-disc font-medium-4 d-none d-xl-block primary" data-ticon="bx-disc"></i></a></li> 
        </ul>
    </div>
    <div class="shadow-bottom"></div>

    <? 
    if(!isset($seccion)) {
        $seccion = '';
    }
    ?>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="lines">
            <li class="nav-item<?= $main == 'inicio' ? ' active' : '' ?>">
                <a href="<?= site_url() ?>"><i class="bx bx-pie-chart-alt-2"></i><span class="menu-title" data-i18n="Dashboard">Página principal</span>
                    <!-- <span class="badge badge-light-danger badge-pill badge-round float-right mr-2">2</span> -->
                </a>
            </li>

        <?
        if(modules::run('security/check_admin')) {
        ?>
            <li class="nav-item has-sub<? $seccion == 'admin-users' ? ' open' : '' ?>">
                <a href="<?= base_url() ?>"><i class="bx bx-user"></i><span class="menu-title" data-i18n="Users">Administrar Usuarios</span>
                    <!-- <span class="badge badge-light-danger badge-pill badge-round float-right mr-2">2</span> -->
                </a>
                <ul class="menu-content">
                <?
                if(modules::run('security/check_gestion_usuarios')) {
                ?>
                    <li class="<?= strpos($main,'usuario_') !== FALSE ? ' active' : '' ?>"><a href="<?=site_url('privado/usuario')?>"><i class="bx bx-user"></i><span class="menu-item" data-i18n="Analytics">Gestión de Usuarios</span></a>
                    </li>
                <?
                }
                if(modules::run('security/check_gestion_roles')) {
                ?>
                    <li class="<?= strpos($main,'rol_') !== FALSE ? ' active' : '' ?>"><a href="<?=site_url('privado/rol')?>"><i class="bx bx-user-plus"></i><span class="menu-item" data-i18n="Analytics">Gestión de Roles</span></a>
                    </li>
                <?
                }
                ?>
                    <li class="<? $seccion == 'admin-grupos' ? ' active' : '' ?>">
                        <a href="<?=site_url('privado/grupo')?>"><i class="bx bx-group"></i><?= modules::run('security/check_admin') ? 'Gestión de ' : 'Ver ' ?>Grupos</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item<? $seccion == 'admin-grupos' ? ' active' : '' ?>">
                <a href="<?=site_url('privado/grupo')?>"><i class="bx bx-group"></i><span class="menu-title" data-i18n="Grupos"><?= modules::run('security/check_admin') ? 'Gestión de ' : 'Ver ' ?>Grupos</span></a>
            </li>
            

            <li class="nav-item<? $seccion == 'admin-contactos' ? ' active' : '' ?>">
                <a href="<?=site_url('privado/contacto')?>"><i class="bx bx-buildings"></i><span class="menu-title" data-i18n="Contactos">Gestión de Contactos</span></a>
            </li>

        <!-- si no es administrador, solo tiene acceso a los siguientes apartados de col-left -->
        <? }else {?>

            <li class="nav-item<? $seccion == 'admin-contactos' ? ' active' : '' ?>">
                <a href="<?=site_url('privado/contacto')?>"><i class="bx bx-buildings"></i><span class="menu-title" data-i18n="Contactos">Gestión de Contactos</span></a>
            </li>
        <? } ?>

        </ul>
    </div>
</div>