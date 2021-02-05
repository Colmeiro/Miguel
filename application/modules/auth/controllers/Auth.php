<?php
class Auth extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('authentication');
        $this->load->model('MUsuario');
    }

    public function index()
    {
        if (!$this->authentication->is_loggedin()) {
            redirect('login');
        } else {
            redirect($this->config->item('home_controller'));
        }
    }

    public function is_loggedin($esAuth = FALSE)
    {
        if($esAuth) {
            if ($this->authentication->is_loggedin()) {
                redirect($this->config->item('home_controller'));
            }
        } else {
            if (!$this->authentication->is_loggedin()) {
                redirect('auth/login');
            }
        }
    }

    public function login()
    {
        $this->is_loggedin(TRUE);

        if ($this->input->post('username')) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $result_login = $this->authentication->login($username, $password);
            $tiene_acceso = modules::run('security/check_acceso');

            if ($result_login && $tiene_acceso) {
                redirect($this->config->item('home_controller'));
            } else {
                $this->session->set_flashdata('msg_login', 'Usuario o clave incorrectos');
            }
        }

        $data['title'] = "Acceso a Fish-tag";
        $data['description'] = 'Accede al área de usuario';

        $data['main'] = 'login';
        $this->load->vars($data);
        $this->load->view('template');
    }

    function logout()
    {
        $this->authentication->logout();
        redirect("/auth/login");
    }

    function forgotpassword()
    {

        if ($this->input->post('username')) {
            $username = $this->input->post('username');
            $fecha = date('Y-m-d H:i:s');

            if ($user_details = $this->authentication->forgotpassword($username)) {
                $usuario = $this->MUsuario->getDatos($user_details->identifier);

                $codigoverificacion = encrypt($user_details->identifier . '|' . $usuario->email . '|' . $fecha);
                //Lo preparamos para la url para evitar problemas con los caracteres permitidos.
                $codigoverificacion = urlencode($codigoverificacion);

                $enlace = site_url("auth/changepassword/" . '?h=' . $codigoverificacion);
                $mensaje = "Has recibido este email, porque hemos recibido una solicitud para establecer la contraseña. \n\nSi realmente deseas restablecer tu contraseña, haz clic en el siguiente enlace:\n\n$enlace
    En el caso de que no funcione, puedes copiar el enlace y pegarlo en la barra de direcciones del navegador.\n\n
    Si por el contrario, no has solicitado que se restablezca tu contraseña, por favor, omite este email.";

                $this->load->library('email');
                $config['charset'] = 'utf-8';
                $config['wordwrap'] = TRUE;
                $config['mailtype'] = 'text';
                $this->email->initialize($config);
                $this->email->from($this->config->config["contacta_from"]);
                $this->email->reply_to($this->config->config["contacta_from"]);

                $this->email->to($usuario->email);

                $this->email->subject('Reestablecimiento contraseña de acceso');

                $this->email->message($mensaje);
                $this->email->send();


                $this->session->set_flashdata('msg_forgot_right', 'Se ha enviado un email a su cuenta para poder cambiar la contraseña');
                $data['ok'] = true;
            } else {
                $this->session->set_flashdata('msg_forgot_wrong', 'Email incorrecto');
            }
        }

        $data['title'] = "Acceso | " . $this->config->item('nombre_web');
        $data['description'] = '';

        $data['main'] = 'forgotpasswd';
        $this->load->vars($data);
        $this->load->view('template');
    }

    function changepassword()
    {
        //Lo mandamos como parámetro get, porque al decodificar la url routes, puede haber "/" que impliquen un error 404 de página no encontrada.
        $hash = $this->input->get('h', TRUE);

        if ($hash != '') {
            //Decodificamos primero los caracteres que fueron adaptados para la url.
            // $hash = urldecode($hash);
            /**
             * Ya llega el hash con un urldecode hecho, seguramente por algún proceso de routes o algo similar. Si volvemos a hacer un urldecode, se va a cambiar el encriptado, ya que va a decodificar caracteres que no tendría que decodificar.
             */
            $hash = explode('|', decrypt($hash), 3);
            $iduser = $hash[0];
            $email = $hash[1];
            $time = $hash[2];
            $fecha_actual = date('Y-m-d H:i:s');
            $fecha1 = strtotime($fecha_actual);
            $fecha2 = strtotime($time);
            $dif = $fecha1 - $fecha2;
            if ($this->input->post('password') && $this->input->post('password2')) {
                if ($this->input->post('password') != $this->input->post('password2')) {
                    $this->session->set_flashdata('msg_change_wrong', 'Las contraseñas no coinciden');
                } else if ($dif > 86400) {
                    $this->session->set_flashdata('msg_change_wrong', 'El enlace ha caducado, puedes volver a solicitarlo pinchando <a href="' . site_url("auth/forgotpassword") . '">aqui</a>');
                } else {
                    $this->authentication->changepassword($iduser, $this->input->post('password'));
                    $data['ok'] = true;
                    // $this->authentication->logout();
                    $this->session->set_flashdata('msg_change_right', 'Contraseña cambiada correctamente');
                }
            } else if($this->input->post('btn_change')) {
                $this->session->set_flashdata('msg_change_wrong', 'Debes introducir la nueva contraseña (dos veces)');
            }
        } else {
            $this->session->set_flashdata('msg_change_wrong', 'No se accedido a esta página de manera segura');
        }

        $data['title'] = "Acceso | " . $this->config->item('nombre_web');
        $data['description'] = '';

        $data['main'] = 'changepasswd';
        $this->load->vars($data);
        $this->load->view('template');
    }
}
