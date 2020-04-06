<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Domains extends CI_Controller {
	public function index()
	{
		$data['page'] = 'Domains';
		$data['title'] = $this->config->item('title');
		$this->load->view('header', $data);
		$this->load->view('navbar', $data);
		$this->load->view('domains', $data);
		$this->load->view('Footer');
	}

	function records($domain = '',$action = '', $record = '')
	{
		//var_dump($domain);
		$data['records'] = $this->M_db->get_records($domain);
		$data['page'] = 'Records';
		$data['title'] = $this->config->item('title').' '.$data['page'];
		$this->load->view('header', $data);
		$this->load->view('navbar', $data);
		$this->load->view('records', $data);
		$this->load->view('Footer');
	}
}
