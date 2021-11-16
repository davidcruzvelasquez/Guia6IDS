<div class="container">
    <div class="mt-4">
        <?php if ($this->session->flashdata('success')) : ?>
            <p class="success"><strong><?php echo $this->session->flashdata('success'); ?></strong></p>
            <?php $this->session->set_flashdata('success', ""); ?>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')) : ?>
            <p class="error"><strong><?php echo $this->session->flashdata('error'); ?></strong></p>
            <?php $this->session->set_flashdata('error', ""); ?>
        <?php endif; ?>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <h4>Listado de carreras&nbsp;&nbsp;
                <a class="btn btn-success" href="<?= site_url('CarrerasController/insertar') ?>">Agregar&nbsp;</a>
                <a class="btn btn-danger" href="<?=site_url('CarrerasController/report_todas_las_carreras')?>">Reporte en PDF</a>
            </h4>
        </div>
    </div>
    <hr>
    <div class="row mt-4">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Id Carrera</th>
                    <th>Carrera</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody align="center">
                <?php foreach ($records as $item): ?>
                <tr>
                    <td><?php echo $item->idcarrera; ?></td>
                    <td><?php echo $item->carrera; ?></td>
                    <td>
                        <a class="btn btn-primary" href="<?=site_url('CarrerasController/modificar/' . $item->idcarrera)?>">Modificar</a>
                        <a class="btn btn-danger" href="<?=site_url('CarrerasController/eliminar/' . $item->idcarrera)?>"
                            onclick="return confirm('¿Está seguro?')">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
        <br>
    </div>
</div>