<div class="app-content content">
    <div class="content-overlay"></div>
        <div class="content-wrapper">

            <div>
                <img src="app-assets\images\logoTapas.jpg" alt="" width="40%" height="150px" style="margin:60px" class="logo">
            </div>

            <a href="<?= site_url('tappas/tappas/view') ?>">hey</a>
            <a href="<?= site_url('privado/rol') ?>">hey</a>

            <!-- barra de búsqueda -->
            <div>
                <form action="localescontroller/view" method="get">
                    <input id="barraBusqueda" type="text" name="barraBusqueda" placeholder="Busca por locales o por ciudades..."
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