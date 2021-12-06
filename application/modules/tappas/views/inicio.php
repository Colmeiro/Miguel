
<div class="app-content content">
    <div class="content-overlay"></div>
        <div class="content-wrapper">

            <div>
                <img src="app-assets\images\logoTapas.jpg" alt="" width="40%" height="150px" style="margin:60px" class="logo">
            </div>

            <a href="<?= site_url('tappas/tappas/view') ?>">Ver todos los locales</a> <br>

            <!-- barra de búsqueda -->
            <div>
                <form action="<?= site_url('tappas/tappas/search') ?>" method="post">
                    <input id="barrabusqueda" type="text" name="barrabusqueda" placeholder="Buscar por ciudad, o pueblo, o pueblecito..."
                    size="50%" height="150px" style="margin:40px">
                    <input type="submit" value="Buscar mi tapa!">
                </form> 
            </div>

            <div>
                <img src="app-assets\images\fotos_pinchos\pincho_torti.jpg" alt="" class="image_left" width="500px"> 

                <img src="app-assets\images\fotos_pinchos\pincho_ensaladilla.jpg" alt="" class="image_right" width="500px">
            </div>

        </div>
    </div>
</div>
<br><br><br>
<!-- BEGIN: Footer-->
<?php $this->load->view('footer'); ?>
    <!-- END: Footer-->