<?php
class Contacto extends CI_Controller{

  /* Función ReCaptcha */
  function _captcha($s)
  {
    if(isset($_POST['g-recaptcha-response'])){
			if (trim($this->input->post("g-recaptcha-response")) == "")
			return false;
			$this->form_validation->set_message("_captcha", "No has superado el reto antispam");
			
			$captcha_answer = $this->input->post('g-recaptcha-response');
			$response = $this->recaptcha->verifyResponse($captcha_answer);			
			
			if ($response['success']) {
				return true;
			} else {
				return false;
			}
		}
  }

  function index()
  {

    $this->load->library('recaptcha');
    $this->load->library("form_validation");
      $config = array(
                     array(
                            "field" => "nombre",
                            "label" => "Nombre y Apellidos",
                            "rules" => "trim|required"
                          ),
                     array(
                            "field" => "empresa",
                            "label" => "Empresa",
                            "rules" => "trim"
                          ),
                     array(
                            "field" => "telefono",
                            "label" => "Tel&eacute;fono",
                            "rules" => "trim|required"
                          ),
                     array(
                            "field" => "email",
                            "label" => "E-mail",
                            "rules" => "trim|required|valid_email"
                          ),
                     array(
                            "field" => "localidad",
                            "label" => "Localidad",
                            "rules" => "trim"
                          ),
                     array(
                            "field" => "cp",
                            "label" => "C.P.",
                            "rules" => "trim"
                          ),
                     array(
                            "field" => "mensaje",
                            "label" => "Mensaje",
                            "rules" => "trim|required"
                          ),
                     array(
                            "field"   => "politica",
                            "label"   => "Pol&iacute;tica de Privacidad",
                            "rules"   => "trim|required"
                          ),
                     array(
                            "field" => "g-recaptcha-response",
                            "label" => "texto de la imagen",
                            "rules" => "trim|required|callback__captcha"
                          )
                   );

    $this->form_validation->set_rules($config);

    if ($this->form_validation->run())
    {
    
      $this->load->library("email");

      $config['mailtype'] = 'html';
      $this->email->initialize($config);
      
      if (strpos($_SERVER["HTTP_HOST"], "vlx.es") === false){
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = ''; /* mail.dominio.com */
        $config['smtp_port'] = '25';
        $config['smtp_user'] = ''; /* web@dominio.com */
        $config['smtp_pass'] = '';
      }

      $this->email->from($this->config->config['contacta_from'], $this->config->item('nombre_web'));
      $this->email->to($this->config->config['contacta_to']);
      $this->email->cc(set_value("email"));
      $this->email->subject('Formulario de Consulta de '.$this->config->item('nombre_web'));
      $emailbody = $this->load->view('emails/contacto_email','',true);
      $this->email->message($emailbody);
      $this->email->send();

      redirect("contacto/enviado");
    }


		$data['title'] = "Contacto | " .$this->config->item('nombre_web');
		$data['description'] = '';
    $data['keywords'] = '';

    $data['main'] = "contacto";
    $this->load->vars($data);
    $this->load->view("template");
  }

  function enviado(){
		$data['title'] = "Contacto Enviado | " .$this->config->item('nombre_web');
		$data['description'] = '';
    $data['keywords'] = '';

    $data['main'] = "enviado";
    $this->load->vars($data);
    $this->load->view("template");
  }

}