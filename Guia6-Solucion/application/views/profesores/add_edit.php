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
                <form action="<?= site_url("ProfesoresController"); ?>/<?= isset($profesor) ? "update" : 'add'; ?>" method="POST" class="form-ajax">
                    <br>
                    <div class="form">
                        <div class="form-group">
                            <input class="form-control" type="hidden" name="PK_profesor" value="<?= isset($profesor) ? $profesor->idprofesor : ""; ?>">
                        </div>

                        <h3><?php echo isset($profesor) ? "Modificar" : "Agregar"; ?></h3>
                        <br>

                        <div class="form-group">
                            <label>Id Profesor:</label>
                            <input readonly class="form-control" type="text" name="idprofesor" value="<?= isset($profesor) ? $profesor->idprofesor : ""; ?>">
                        </div>

                        <div class="form-group">
                            <label>Nombre:</label>
                            <input class="form-control" type="text" name="nombre" value="<?= isset($profesor) ? $profesor->nombre : ""; ?>">
                        </div>

                        <div class="form-group">
                            <label>Apellido:</label>
                            <input class="form-control" type="text" name="apellido" value="<?= isset($profesor) ? $profesor->apellido : ""; ?>">
                        </div>

                        <div class="form-group">
                            <label>Fecha de Nacimiento:</label>
                            <input class="form-control" type="date" name="fecha_nacimiento" value="<?= isset($profesor) ? $profesor->fecha_nacimiento : ""; ?>">
                        </div>

                        <div class="form-group">
                            <label>Profesion:</label>
                            <input class="form-control" type="text" name="profesion" value="<?= isset($profesor) ? $profesor->profesion : ""; ?>">
                        </div>

                        <div class="form-group">
                            <label>Genero:</label>
                            <select class="form-control" name="genero">
                                    <option value="M" <?= isset($profesor) && $profesor->genero == 'M' ? "selected='selected'" : ""; ?>>M</option>
                                    <option value="F" <?= isset($profesor) && $profesor->genero == 'F'? "selected='selected'" : ""; ?>>F</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Email:</label>
                            <input class="form-control" type="email" name="email" value="<?= isset($profesor) ? $profesor->email : ""; ?>">
                        </div>

                        <br>
                        <div class="form-group">
                            <input class="btn btn-success" type="submit" value="Guardar"> <a class='btn btn-danger' href="<?= site_url('ProfesoresController') ?>">Volver</a>
                        </div>
                    </div>
                </form>
                <br>
            </div>
        </div>
    </div>
</div>