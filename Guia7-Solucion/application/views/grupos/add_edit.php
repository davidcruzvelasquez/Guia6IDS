<?php if ($this->session->flashdata('success')) : ?>
    <p class="success"><strong><?php echo $this->session->flashdata('success'); ?></strong></p>
<?php endif; ?>
<?php if ($this->session->flashdata('error')) : ?>
    <p class="error"><strong><?php echo $this->session->flashdata('error'); ?></strong></p>
<?php endif; ?>

<div class="container-fluid">

    <div class="ml-md-4 mr-md-4">
        <div class="row">
            <div class="offset-md-2 col-md-4 col-sm-12">
                <form action="<?= site_url("GruposController"); ?>/<?= isset($grupo) ? "update" : 'add'; ?>" method="POST" class="form-ajax">
                    <br>
                    <div class="form">
                        <div class="form-group">
                            <input class="form-control" type="hidden" name="PK_grupo" value="<?= isset($grupo) ? $grupo->idgrupo : ""; ?>">
                        </div>
                        <h3><?php echo isset($grupo) ? "Modificar" : "Agregar"; ?></h3>
                        <br>
                        <div class="form-group">
                            <label>Id Grupo:</label>
                            <input readonly class="form-control" type="text" name="idgrupo" value="<?= isset($grupo) ? $grupo->idgrupo : ""; ?>">
                        </div>

                        <div class="form-group">
                            <label>Número de Grupo:</label>
                            <input class="form-control" type="text" name="num_grupo" value="<?= isset($grupo) ? $grupo->num_grupo : ""; ?>">
                        </div>

                        <div class="form-group">
                            <label>Año:</label>
                            <input class="form-control" type="text" name="anio" value="<?= isset($grupo) ? $grupo->anio : ""; ?>">
                        </div>

                        <div class="form-group">
                            <label>Ciclo:</label>
                            <input class="form-control" type="text" name="ciclo" value="<?= isset($grupo) ? $grupo->ciclo : ""; ?>">
                        </div>

                        <div class="form-group">
                            <label>Materia:</label>
                            <select class="form-control" name="idmateria">
                                <?php foreach ($materias as $item) : ?>

                                    <option value="<?= $item->idmateria ?>" <?= isset($grupo) && $item->idmateria == $grupo->idmateria ? "selected='selected'" : ""; ?>>

                                        <?= $item->materia ?>

                                    </option>

                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Profesor:</label>
                            <select class="form-control" name="idprofesor">
                                <?php foreach ($profesores as $item) : ?>

                                    <option value="<?= $item->idprofesor ?>" <?= isset($grupo) && $item->idprofesor == $grupo->idprofesor ? "selected='selected'" : ""; ?>>

                                        <?= $item->nombre ?> <?= $item->apellido ?>

                                    </option>

                                <?php endforeach; ?>
                            </select>
                        </div>

                        <br>
                        <div class="form-group">
                            <input class="btn btn-success" type="submit" value="Guardar"> <a class='btn btn-danger' href="<?= site_url('GruposController') ?>">Volver</a>
                        </div>
                    </div>
                </form>
                <br>
            </div>
        </div>
    </div>
</div>