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
            <h4>Listado de grupos&nbsp;&nbsp;
                <a class="btn btn-success" href="<?= site_url('GruposController/insertar') ?>">Agregar&nbsp;</a>
                <a class="btn btn-danger" href="<?=site_url('GruposController/report_todos_los_grupos')?>">Reporte en PDF</a>
            </h4>
        </div>
    </div>
    <hr>
    <div class="row mt-4">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Id Grupo</th>
                    <th>Número de Grupo</th>
                    <th>Año</th>
                    <th>Ciclo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody align="center">
                <?php foreach ($records as $item) : ?>
                    <tr>
                        <td><?php echo $item->idgrupo; ?></td>
                        <td><?php echo $item->num_grupo; ?></td>
                        <td><?php echo $item->anio; ?></td>
                        <td><?php echo $item->ciclo; ?></td>
                        <td>
                            <a class="btn btn-primary" href="<?= site_url('GruposController/modificar/' . $item->idgrupo) ?>">Modificar</a>
                            <a class="btn btn-danger" href="<?= site_url('GruposController/eliminar/' . $item->idgrupo) ?>" onclick="return confirm('¿Está seguro?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <br>
    </div>
</div>