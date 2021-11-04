<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <!-- TITLE + BREADCRUMB -->
        <div class="content-header row">
            <div class="content-header-left col-12 mb-1 mb-sm-2 mt-1">
                <div class="row breadcrumbs-top">

                    <div class="breadcrumb-wrapper col-12 d-xl-none">
                        <ol class="breadcrumb br">
                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active text-capitalize"><?= $titulo ?>
                            </li>
                        </ol>
                    </div>

                    <div class="col-12">
                        
                        <h4 class="content-header-title float-left no-border mb-0 text-capitalize"><i class="bx bxs-user-detail"></i><?= $titulo ?></h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-body">
            <!-- table Transactions start -->
            <section id="table-transactions">
                <div class="row match-height">
                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div class="card-header bg-light-blue">
                                <h4 class="card-title"><?= isset($subtitulo) ? $subtitulo : '' ?>: <?php echo daFormato($data_fields['nombre'], 'varchar', '0-#475F7B', '') ?> <?php echo daFormato($data_fields['apellidos'], 'varchar', '0-#475F7B', '') ?></h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body pr-0 pl-0">
                                    <!-- datatable start -->
                                    <div class="table-responsive">
                                        <table id="table-extended-transactions" class="table mb-2">

                                            <tr>
                                                <td class="font-weight-bold">Fecha Creacion</td>
                                                <td><?php echo daFormato($data_fields['fecha_creacion'], 'datetime', '0-#333333', '') ?></td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Nombre</td>
                                                <td><?php echo daFormato($data_fields['nombre'], 'varchar', '0-#333333', '') ?></td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Apellidos</td>
                                                <td><?php echo daFormato($data_fields['apellidos'], 'varchar', '0-#333333', '') ?></td>
                                            </tr>
                                            <!-- <?/*<tr>
                                                <td class="font-weight-bold">DNI</td>
                                                <td><?php echo daFormato($data_fields['dni'], 'varchar', '0-#333333', '') ?></td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Ciudad</td>
                                                <td><?php echo daFormato($data_fields['ciudad'], 'varchar', '0-#333333', '') ?></td>
                                            </tr>*/?> -->
                                            <tr>
                                                <td class="font-weight-bold">Email</td>
                                                <td><?php echo daFormato($data_fields['email'], 'email', '0-#333333', '') ?></td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Rol</td>
                                                <td><?php foreach ($s_rol_id as $c) {
                                                        if ($c->rol_id == $data_fields['rol_id']) {
                                                            echo $c->nombre;
                                                        }
                                                    }; ?></td>
                                            </tr>
                                        <?php if(!empty($usuario_grupo)) { ?>
                                            <tr>
                                                <td class="font-weight-bold">Grupos</td>
                                                <td>
                                                    <div class="display-inline-block">
                                                    <?php
                                                        $str_usuario_grupo = '';
                                                        foreach($usuario_grupo as $ind => $grupo){
                                                            if($ind > 0) {
                                                                $str_usuario_grupo .= '<br>';
                                                            }

                                                            $str_usuario_grupo .=  $grupo->nombre;
                                                        }
                                                        echo $str_usuario_grupo;
                                                    ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php }; ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>