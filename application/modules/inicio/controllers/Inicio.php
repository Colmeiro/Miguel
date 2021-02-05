<?php
class Inicio extends MX_Controller
{
    function index()
    {
        modules::run('auth/is_loggedin');

        $data['title'] = 'Fish-tag';
        $data['description'] = '';

        $data['seccion'] = 'inicio';
        $data['main'] = 'inicio';
        $this->load->vars($data);
        $this->load->view('template');
    }
}
