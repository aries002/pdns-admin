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

	function records($domain = '')
	{
		//var_dump($domain);
		$cari = null;
		if($this->input->get()){
			if($this->input->get('cari') != null){
				$cari['name'] = $this->input->get('cari');
			}
			if($this->input->get('cari2') != null){
				$cari['content'] = $this->input->get('cari2');
			}
			if($this->input->get('tipe') != null){
				$cari['type'] = $this->input->get('tipe');
			}
			if ($this->input->get('_domain') != null) {
				//var_dump($this->input->get('_domain'));
				$cari['domain_id'] = $this->input->get('_domain');
				$domain = $this->input->get('_domain');
			}
		}

		$data['domain'] = $domain;
		$data['domain_list'] = $this->M_db->cari_domain();
		$data['records'] = $this->M_db->get_records($cari);
		$data['page'] = 'Records';
		$data['title'] = $this->config->item('title').' '.$data['page'];
		$this->load->view('header', $data);
		$this->load->view('navbar', $data);
		$this->load->view('records', $data);
		$this->load->view('Footer');
	}
}
