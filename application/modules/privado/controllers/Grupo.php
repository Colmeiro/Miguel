<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Grupo extends MX_Controller
{
	private $tienePermiso;

	function __construct()
	{
		parent::__construct();
		$this->load->model('MGrupo');
		$this->load->model('MUsuario_grupo');
		$this->load->library('form_validation');
		$this->load->helper('formatos');

		modules::run('auth/is_loggedin');

		$this->tienePermiso = modules::run('security/check_admin');
	}

	public function index()
	{
		$this->session->set_userdata(array('grupo.q' => ''));
		//$this->session->set_userdata(array('od' => '', 'oc' => ''));
		redirect(current_url() . '/view', 'location');
	}


	public function view($page = 1)
	{
		if($this->input->get('p', TRUE)) {
            $page = $this->input->get('p', TRUE);
        }

		if (intval($page) <= 0) {

			$this->session->set_userdata(array('grupo.q' => ''));
			redirect(base_url() . $this->uri->segment(1) . '/' . $this->uri->segment(2) . '/view', 'location');
			redirect(current_url(), 'location');
		}
		if (count($_POST) > 0)
			$this->session->set_userdata(array('grupo.q' => $this->input->post('q')));

		$q = $this->session->userdata('grupo.q');

		$ob = urldecode($this->input->get('ob', TRUE));
		$nr = urldecode($this->input->get('nr', TRUE));

		if ($ob != '') {
			$orddir = substr($ob, 0, 1);
			$ordencampo = substr($ob, 1);
			switch ($orddir) {
				case 'a':
					$ordendir = 'ASC';
					break;
				case 'd':
					$ordendir = 'DESC';
					break;
			}
			$this->session->set_userdata(array('grupo.od' => $ordendir, 'grupo.oc' => $ordencampo));
		}

		$oc = $this->session->userdata('grupo.oc');
		$od = $this->session->userdata('grupo.od');

		if ($nr != '') {
			$config['per_page'] = $nr;
			$this->session->set_userdata(array('grupo.nr' => $nr));
		}

		$nr = $this->session->userdata('grupo.nr');

		if ($nr != '') {
			$config['per_page'] = $nr;
		} else {
			$config['per_page'] = 10;
			$this->session->set_userdata(array('grupo.nr' => 10));
		}




		$config['base_url'] = current_url() . '/';
		$config['first_url'] = current_url() . '/';




		$config['uri_segment'] = 4;
		$config['use_page_numbers'] = TRUE;
		$config['total_rows'] = $this->MGrupo->total_rows($q);

		$start = $config['per_page'] * ($page - 1);

		$grupo = $this->MGrupo->get_limit_data($config['per_page'], $start, $q, $oc, $od);

		$this->load->library('pagination');
		$this->pagination->initialize($config);

		$data = array(
			'grupo_data' => $grupo,
			'q' => $q,
			'pagination' => $this->pagination->create_links(),
			'total_rows' => $config['total_rows'],
			'start' => $start,
		);

		if ($this->tienePermiso) {
			$data['titulo'] = 'Gestión de Grupos';
		} else {
			$data['titulo'] = 'Ver Grupos';
		}

		$data['seccion'] = 'admin-grupos';
		$data['main'] = 'grupo_list';
		$this->load->view('template', $data);
	}

	public function read($id)
	{
		$row = $this->MGrupo->get_by_id($id);
		if ($row) {
			$data = array(
				'data_fields' => array(
					'grupo_id' => $row->grupo_id,
					'nombre' => $row->nombre,
					// 'cif' => $row->cif,
					// 'sociedad' => $row->sociedad,
					// 'direccion' => $row->direccion,
					// 'codigo_postal' => $row->codigo_postal,
					// 'poblacion' => $row->poblacion,
					// 'provincia' => $row->provincia,
					// 'telefono' => $row->telefono,
					// 'email' => $row->email,
					// 'email_pedidos' => $row->email_pedidos,
					// 'franquiciado' => $row->franquiciado,
					// 'propietario' => $row->propietario,
					// 'telefono_propietario' => $row->telefono_propietario,
					// 'metros_cuadrados' => $row->metros_cuadrados,
					// 'aforo' => $row->aforo,
					// 'terraza' => $row->terraza,
					// 'josper' => $row->josper,
					// 'partner_delivery_id' => $row->partner_delivery_id,
					'activo' => $row->activo,
					'orden' => $row->orden,
				)
			);
			// $this->db->order_by('orden', 'ASC');
			// $data['s_partner_delivery_id'] = $this->db->get('partner_delivery')->result();

			$data['usuario_grupo'] = $this->MUsuario_grupo->get_by_grupo_id($row->grupo_id);

			$data['seccion'] = 'admin-grupos';
			$data['main'] = 'grupo_read';

			if ($this->tienePermiso) {
				$data['titulo'] = 'Gestión de Grupos';
			} else {
				$data['titulo'] = 'Ver Grupos';
			}
			$data['subtitulo'] = 'Grupo';
			$this->load->view('template', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('privado/grupo'));
		}
	}


	public function create()
	{
		if (!$this->tienePermiso) {
			redirect(site_url('privado/grupo'));
		}

		$data = array(
			'button' => 'Añadir',
			'action' => site_url('privado/grupo/create_action'),
			'data_fields' => array(
				'nombre' => set_value('nombre'),
				// 'cif' => set_value('cif'),
				// 'sociedad' => set_value('sociedad'),
				// 'direccion' => set_value('direccion'),
				// 'codigo_postal' => set_value('codigo_postal'),
				// 'poblacion' => set_value('poblacion'),
				// 'provincia' => set_value('provincia'),
				// 'telefono' => set_value('telefono'),
				// 'email' => set_value('email'),
				// 'email_pedidos' => set_value('email_pedidos'),
				// 'franquiciado' => set_value('franquiciado') ? set_value('franquiciado') : 0,
				// 'propietario' => set_value('propietario'),
				// 'telefono_propietario' => set_value('telefono_propietario'),
				// 'metros_cuadrados' => set_value('metros_cuadrados'),
				// 'aforo' => set_value('aforo'),
				// 'terraza' => set_value('terraza') ? set_value('terraza') : 0,
				// 'josper' => set_value('josper') ? set_value('josper') : 0,
				// 'partner_delivery_id' => set_value('partner_delivery_id'),
				'activo' => set_value('activo') ? set_value('activo') : 0,
				'orden' => set_value('orden') ? set_value('orden') : 0,
				'grupo_id' => set_value('grupo_id'),
			)
		);
		// $this->db->order_by('orden', 'ASC');
		// $data['s_partner_delivery_id'] = $this->db->get('partner_delivery')->result();
		$data['seccion'] = 'admin-grupos';
		$data['main'] = 'grupo_form';

		$data['titulo'] = 'Gestión de Grupos';
		$data['subtitulo'] = 'Añadir Grupo';
		$this->load->view('template', $data);
	}


	public function create_action()
	{
		if (!$this->tienePermiso) {
			redirect(site_url('privado/grupo'));
		}

		$this->_rules('create');

		if ($this->form_validation->run() == FALSE) {
			$this->create();
		} else {
			$data = array(
				'nombre' => $this->input->post('nombre', TRUE),
				// 'cif' => $this->input->post('cif', TRUE),
				// 'sociedad' => $this->input->post('sociedad', TRUE),
				// 'direccion' => $this->input->post('direccion', TRUE),
				// 'codigo_postal' => $this->input->post('codigo_postal', TRUE),
				// 'poblacion' => $this->input->post('poblacion', TRUE),
				// 'provincia' => $this->input->post('provincia', TRUE),
				// 'telefono' => $this->input->post('telefono', TRUE),
				// 'email' => $this->input->post('email', TRUE),
				// 'email_pedidos' => $this->input->post('email_pedidos', TRUE),
				// 'franquiciado' => $this->input->post('franquiciado', TRUE) ? $this->input->post('franquiciado', TRUE) : 0,
				// 'propietario' => $this->input->post('propietario', TRUE),
				// 'telefono_propietario' => $this->input->post('telefono_propietario', TRUE),
				// 'metros_cuadrados' => $this->input->post('metros_cuadrados', TRUE),
				// 'aforo' => $this->input->post('aforo', TRUE),
				// 'terraza' => $this->input->post('terraza', TRUE) ? $this->input->post('terraza', TRUE) : 0,
				// 'josper' => $this->input->post('josper', TRUE) ? $this->input->post('josper', TRUE) : 0,
				// 'partner_delivery_id' => $this->input->post('partner_delivery_id', TRUE),
				'activo' => $this->input->post('activo', TRUE) ? $this->input->post('activo', TRUE) : 0,
				'orden' => $this->input->post('orden', TRUE) ? $this->input->post('orden', TRUE) : 0,
			);

			$this->MGrupo->insert($data);
			$this->session->set_flashdata('message', 'Grupo creado correctamente');
			redirect(site_url('privado/grupo'));
		}
	}


	public function update($id)
	{
		if (!$this->tienePermiso) {
			redirect(site_url('privado/grupo'));
		}

		$row = $this->MGrupo->get_by_id($id);
		if ($row) {
			$data = array(
				'button' => 'Modificar',
				'action' => site_url('privado/grupo/update_action'),
				'data_fields' => array(
					'nombre' => set_value('nombre', $row->nombre),
					// 'cif' => set_value('cif', $row->cif),
					// 'sociedad' => set_value('sociedad', $row->sociedad),
					// 'direccion' => set_value('direccion', $row->direccion),
					// 'codigo_postal' => set_value('codigo_postal', $row->codigo_postal),
					// 'poblacion' => set_value('poblacion', $row->poblacion),
					// 'provincia' => set_value('provincia', $row->provincia),
					// 'telefono' => set_value('telefono', $row->telefono),
					// 'email' => set_value('email', $row->email),
					// 'email_pedidos' => set_value('email_pedidos', $row->email_pedidos),
					// 'franquiciado' => set_value('franquiciado', $row->franquiciado),
					// 'propietario' => set_value('propietario', $row->propietario),
					// 'telefono_propietario' => set_value('telefono_propietario', $row->telefono_propietario),
					// 'metros_cuadrados' => set_value('metros_cuadrados', $row->metros_cuadrados),
					// 'aforo' => set_value('aforo', $row->aforo),
					// 'terraza' => set_value('terraza', $row->terraza),
					// 'josper' => set_value('josper', $row->josper),
					// 'partner_delivery_id' => set_value('partner_delivery_id', $row->partner_delivery_id),
					'activo' => set_value('activo', $row->activo),
					'orden' => set_value('orden', $row->activo),
					'grupo_id' => set_value('grupo_id', $row->grupo_id),
				)
			);

			// $this->db->order_by('orden', 'ASC');
			// $data['s_partner_delivery_id'] = $this->db->get('partner_delivery')->result();
			$data['seccion'] = 'admin-grupos';
			$data['main'] = 'grupo_form';

			$data['titulo'] = 'Gestión de Grupos';
			$data['subtitulo'] = 'Modificar Grupo';
			$this->load->view('template', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('privado/grupo'));
		}
	}

	public function update_action()
	{
		if (!$this->tienePermiso) {
			redirect(site_url('privado/grupo'));
		}

		$this->_rules('update');

		if ($this->form_validation->run() == FALSE) {
			$this->update($this->input->post('grupo_id', TRUE));
		} else {
			$data = array(
				'nombre' => $this->input->post('nombre', TRUE),
				// 'cif' => $this->input->post('cif', TRUE),
				// 'sociedad' => $this->input->post('sociedad', TRUE),
				// 'direccion' => $this->input->post('direccion', TRUE),
				// 'codigo_postal' => $this->input->post('codigo_postal', TRUE),
				// 'poblacion' => $this->input->post('poblacion', TRUE),
				// 'provincia' => $this->input->post('provincia', TRUE),
				// 'telefono' => $this->input->post('telefono', TRUE),
				// 'email' => $this->input->post('email', TRUE),
				// 'email_pedidos' => $this->input->post('email_pedidos', TRUE),
				// 'franquiciado' => $this->input->post('franquiciado', TRUE) ? $this->input->post('franquiciado', TRUE) : 0,
				// 'propietario' => $this->input->post('propietario', TRUE),
				// 'telefono_propietario' => $this->input->post('telefono_propietario', TRUE),
				// 'metros_cuadrados' => $this->input->post('metros_cuadrados', TRUE),
				// 'aforo' => $this->input->post('aforo', TRUE),
				// 'terraza' => $this->input->post('terraza', TRUE) ? $this->input->post('terraza', TRUE) : 0,
				// 'josper' => $this->input->post('josper', TRUE) ? $this->input->post('josper', TRUE) : 0,
				// 'partner_delivery_id' => $this->input->post('partner_delivery_id', TRUE),
				'activo' => $this->input->post('activo', TRUE) ? $this->input->post('activo', TRUE) : 0,
				'orden' => $this->input->post('orden', TRUE) ? $this->input->post('orden', TRUE) : 0,
			);

			$this->MGrupo->update($this->input->post('grupo_id', TRUE), $data);
			$this->session->set_flashdata('message', 'Grupo modificado correctamente');
			redirect(site_url('privado/grupo'));
		}
	}

	public function delete($id)
	{
		if (!$this->tienePermiso) {
			redirect(site_url('privado/grupo'));
		}

		$row = $this->MGrupo->get_by_id($id);

		if ($row) {
			$this->MGrupo->delete($id);
			$this->session->set_flashdata('message', 'Grupo eliminado correctamente');
			redirect(site_url('privado/grupo'));
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('privado/grupo'));
		}
	}

	public function _rules($raction)
	{
		$this->form_validation->set_rules('nombre', 'nombre', 'trim|required');
		// $this->form_validation->set_rules('cif', 'cif', 'trim|required');
		// $this->form_validation->set_rules('sociedad', 'sociedad', 'trim|required');
		// $this->form_validation->set_rules('direccion', 'direccion', 'trim|required');
		// $this->form_validation->set_rules('codigo_postal', 'codigo postal', 'trim|required');
		// $this->form_validation->set_rules('poblacion', 'poblacion', 'trim|required');
		// $this->form_validation->set_rules('provincia', 'provincia', 'trim|required');
		// $this->form_validation->set_rules('telefono', 'telefono', 'trim|required');
		// $this->form_validation->set_rules('email', 'email', 'trim|required');
		// $this->form_validation->set_rules('email_pedidos', 'email pedidos', 'trim|required');
		// $this->form_validation->set_rules('franquiciado', 'franquiciado', 'trim');
		// $this->form_validation->set_rules('propietario', 'propietario', 'trim|required');
		// $this->form_validation->set_rules('telefono_propietario', 'telefono propietario', 'trim|required');
		// $this->form_validation->set_rules('metros_cuadrados', 'metros cuadrados', 'trim');
		// $this->form_validation->set_rules('aforo', 'aforo', 'trim');
		// $this->form_validation->set_rules('terraza', 'terraza', 'trim');
		// $this->form_validation->set_rules('josper', 'josper', 'trim');
		// $this->form_validation->set_rules('partner_delivery_id', 'partner delivery id', 'trim|required');
		$this->form_validation->set_rules('activo', 'activo', 'trim');
		$this->form_validation->set_rules('orden', 'orden', 'trim');

		$this->form_validation->set_rules('grupo_id', 'grupo_id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}

/* End of file Grupo.php */
/* Location: ./application/controllers/Grupo.php */
/* Please DO NOT modify this information : */
/* Generated by CRUZ Codeigniter CRUD Generator 2021-01-28 10:32:40 */
