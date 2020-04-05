<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function index()
	{
		$data['title'] = $this->config->item('title');
		$this->load->view('header', $data);
		$this->load->view('navbar', $data);
		$this->load->view('home', $data);
		$this->load->view('Footer');
	}

	function records()
	{
		$data['title'] = $this->config->item('title').' records';
		$this->load->view('header', $data);
		$this->load->view('navbar', $data);
		$this->load->view('records', $data);
		$this->load->view('Footer');
	}
}
