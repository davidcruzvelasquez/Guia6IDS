<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GruposController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
        if (!isset($this->session->userdata['logged_in'])) { 
            redirect("/");
        }
    }

    // FUNCIONES QUE CARGAN VISTAS /////////////////////////////////////////////////////////
    public function index()
    {
        $this->load->model('GruposModel');
        $data = array(
            "records" => $this->GruposModel->getAll(),
            "title" => "Grupos",
        );
        $this->load->view("shared/header", $data);
        $this->load->view("grupos/index", $data);
        $this->load->view("shared/footer");
    }

    public function insertar()
    {
        $this->load->model('MateriasModel');
        $this->load->model('ProfesoresModel');
        $data = array(
            "materias" => $this->MateriasModel->getAll(),
            "profesores" => $this->ProfesoresModel->getAll(),
            "title" => "Insertar grupo",
        );
        $this->load->view("shared/header", $data);
        $this->load->view("grupos/add_edit", $data);
        $this->load->view("shared/footer");
    }

    public function modificar($id)
    {
        $this->load->model('MateriasModel');
        $this->load->model('ProfesoresModel');
        $this->load->model('GruposModel');
        $grupo = $this->GruposModel->getById($id);
        $data = array(
            "materias" => $this->MateriasModel->getAll(),
            "profesores" => $this->ProfesoresModel->getAll(),
            "grupo" => $grupo,
            "title" => "Modificar grupo",
        );
        $this->load->view("shared/header", $data);
        $this->load->view("grupos/add_edit", $data);
        $this->load->view("shared/footer");
    }
    // FIN - FUNCIONES QUE CARGAN VISTAS /////////////////////////////////////////////////////////

    // FUNCIONES QUE REALIZAN OPERACIONES /////////////////////////////////////////////////////////
    public function add()
    {

        // Reglas de validaci??n del formulario
        /*
        required: indica que el campo es obligatorio.
        min_length: indica que la cadena debe tener al menos una cantidad determinada de caracteres.
        max_length: indica que la cadena debe tener como m??ximo una cantidad determinada de caracteres.
        valid_email: indica que el valor debe ser un correo con formato v??lido.
         */
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules("idgrupo", "Id Grupo", "");
        $this->form_validation->set_rules("num_grupo", "Numero de Grupo", "required|min_length[3]|max_length[3]");
        $this->form_validation->set_rules("anio", "A??o", "required|max_length[4]");
        $this->form_validation->set_rules("ciclo", "Ciclo", "required|min_length[2]|max_length[2]");
        $this->form_validation->set_rules("idmateria", "Materia", "required");
        $this->form_validation->set_rules("idprofesor", "Profesor", "required");

        // Modificando el mensaje de validaci??n para los errores
        $this->form_validation->set_message('required', 'El campo %s es requerido.');
        $this->form_validation->set_message('min_length', 'El campo %s debe tener al menos %s caracteres.');
        $this->form_validation->set_message('max_length', 'El campo %s debe tener como m??ximo %s caracteres.');
        $this->form_validation->set_message('valid_email', 'El campo %s no es un correo v??lido.');
        $this->form_validation->set_message('is_unique', 'El campo %s ya existe.');

        // Par??metros de respuesta
        header('Content-type: application/json');
        $statusCode = 200;
        $msg = "";

        // Se ejecuta la validaci??n de los campos
        if ($this->form_validation->run()) {
            // Si la validaci??n es correcta entra ac??
            try {
                $this->load->model('GruposModel');
                $data = array(
                    "idgrupo" => $this->input->post("idgrupo"),
                    "num_grupo" => $this->input->post("num_grupo"),
                    "anio" => $this->input->post("anio"),
                    "ciclo" => $this->input->post("ciclo"),
                    "idmateria" => $this->input->post("idmateria"),
                    "idprofesor" => $this->input->post("idprofesor"),
                );
                $rows = $this->GruposModel->insert($data);
                if ($rows > 0) {
                    $msg = "Informaci??n guardada correctamente.";
                } else {
                    $statusCode = 500;
                    $msg = "No se pudo guardar la informaci??n.";
                }
            } catch (Exception $ex) {
                $statusCode = 500;
                $msg = "Ocurri?? un error." . $ex->getMessage();
            }
        } else {
            // Si la validaci??n da error, entonces se ejecuta ac??
            $statusCode = 400;
            $msg = "Ocurrieron errores de validaci??n.";
            $errors = array();
            foreach ($this->input->post() as $key => $value) {
                $errors[$key] = form_error($key);
            }
            $this->data['errors'] = $errors;
        }
        // Se asigna el mensaje que llevar?? la respuesta
        $this->data['msg'] = $msg;
        // Se asigna el c??digo de Estado HTTP
        $this->output->set_status_header($statusCode);
        // Se env??a la respuesta en formato JSON
        echo json_encode($this->data);

    }

    public function update()
    {

        // Reglas de validaci??n del formulario
        $this->form_validation->set_error_delimiters('', '');
        /*
        required: indica que el campo es obligatorio.
        min_length: indica que la cadena debe tener al menos una cantidad determinada de caracteres.
        max_length: indica que la cadena debe tener como m??ximo una cantidad determinada de caracteres.
        valid_email: indica que el valor debe ser un correo con formato v??lido.
         */
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules("idgrupo", "Id Grupo", "");
        $this->form_validation->set_rules("num_grupo", "Numero de Grupo", "required|min_length[3]|max_length[3]");
        $this->form_validation->set_rules("anio", "A??o", "required|max_length[4]");
        $this->form_validation->set_rules("ciclo", "Ciclo", "required|min_length[2]|max_length[2]");
        $this->form_validation->set_rules("idmateria", "Materia", "required");
        $this->form_validation->set_rules("idprofesor", "Profesor", "required");

        // Modificando el mensaje de validaci??n para los errores, en este caso para
        // la regla required, min_length, max_length
        $this->form_validation->set_message('required', 'El campo %s es requerido.');
        $this->form_validation->set_message('min_length', 'El campo %s debe tener al menos %s caracteres.');
        $this->form_validation->set_message('max_length', 'El campo %s debe tener como m??ximo %s caracteres.');
        $this->form_validation->set_message('is_unique', 'El campo %s ya existe.');

        // Par??metros de respuesta
        header('Content-type: application/json');
        $statusCode = 200;
        $msg = "";

        // Se ejecuta la validaci??n de los campos
        if ($this->form_validation->run()) {
            // Si la validaci??n es correcta entra
            try {
                $this->load->model('GruposModel');
                $data = array(
                    "idgrupo" => $this->input->post("idgrupo"),
                    "num_grupo" => $this->input->post("num_grupo"),
                    "anio" => $this->input->post("anio"),
                    "ciclo" => $this->input->post("ciclo"),
                    "idmateria" => $this->input->post("idmateria"),
                    "idprofesor" => $this->input->post("idprofesor"),
                );
                $rows = $this->GruposModel->update($data, $this->input->post("PK_grupo"));
                $msg = "Informaci??n guardada correctamente.";
            } catch (Exception $ex) {
                $statusCode = 500;
                $msg = "Ocurri?? un error." . $ex->getMessage();
            }
        } else {
            // Si la validaci??n da error, entonces se ejecuta ac??
            $statusCode = 400;
            $msg = "Ocurrieron errores de validaci??n.";
            $errors = array();
            foreach ($this->input->post() as $key => $value) {
                $errors[$key] = form_error($key);
            }
            $this->data['errors'] = $errors;
        }
        // Se asigna el mensaje que llevar?? la respuesta
        $this->data['msg'] = $msg;
        // Se asigna el c??digo de Estado HTTP
        $this->output->set_status_header($statusCode);
        // Se env??a la respuesta en formato JSON
        echo json_encode($this->data);
    }

    public function eliminar($id)
    {
        $this->load->model('GruposModel');
        $result = $this->GruposModel->delete($id);
        if ($result) {
            $this->session->set_flashdata('success', "Registro borrado correctamente.");
        } else {
            $this->session->set_flashdata('error', "No se pudo borrar el registro.");
        }
        redirect("GruposController");
    }
    // FIN - FUNCIONES QUE REALIZAN OPERACIONES /////////////////////////////////////////////////////////

}
