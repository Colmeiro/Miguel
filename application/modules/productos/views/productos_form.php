<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
            <!-- TITLE + BREADCRUMB -->
            <div class="content-header row">
                <div class="content-header-left col-12 mb-1 mb-sm-2 mt-1">                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12 d-xl-none">
                            <ol class="breadcrumb br">
                                <li class="breadcrumb-item"><a href="<?= base_url() ?>"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active text-capitalize"><?= $titulo ?>
                                </li>
                            </ol>
                        </div>
                        <div class="col-12">
                            <h4 class="content-header-title float-left no-border mb-0 text-capitalize"><i class="bx bx-group"></i><?= $titulo ?></h4>
                        </div>
                    </div>
                </div>
            </div>
<div class="content-body">
	<section id="basic-vertical-layouts">
		<div class="row match-height">
			<div class="col-md-6 col-12">
				<div class="card">
					<? if (isset($subtitulo) && $subtitulo=='Añadir') {
					    $bg_card="bg-light-blue";
					    $dots="";
					} else{
					    $bg_card="bg-light-green";
					    $dots=": ";
					}?>
					<div class="card-header <?=$bg_card?> mb-2">
						<h4 class="card-title color-white"><?=isset($subtitulo) ? $subtitulo : ''?><?=$dots;?> <?php echo daFormato($data_fields['nombre'], 'varchar', '0-#ffffff', '') ?></h4>
					</div>
					<div class="card-content">
						<div class="card-body card-body-xs">
						<? if(isset($data_fields)) extract($data_fields); //Provisional ?>

						    <form class="form form-vertical form-edit" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
						        <div class="form-body">
						            <div class="row">

	    <input type="hidden" name="producto_id" value="<?php echo $producto_id; ?>" /> 						            <div class="col-6 d-flex justify-content-start">

	                                    <a href="<?php echo site_url('productos') ?>" class="btn btn-light-secondary ml-0"><i class="bx bx-chevrons-left"></i>Volver</a>						            </div>
						            <div class="col-6 d-flex justify-content-end">

	                                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 						            </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
</div>
</div>
