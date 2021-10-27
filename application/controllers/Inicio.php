<?php
class Inicio extends CI_Controller{

  function index()
  {
    $data['title'] = 'Dashboard | Fish-tag';
	  $data['description'] = '';
    $data['keywords'] = '';
    $data['main'] = 'inicio';
    $this->load->vars($data);
    $this->load->view('template');
  }
}