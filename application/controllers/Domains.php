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

	function records($page = null)
	{
		//var_dump($domain);
		$domain=null;
		$cari = null;
		$get = '';
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
			// if($this->input->get('page') != null){
			// 	$page = $this->input->get('page');
			// }
		}
		if($cari != null){
			$get='?';
			foreach ($cari as $key => $value) {
				$get = $get.$key.'='.$value.'&';
			}
		}
		$jumlah = $this->M_db->hitung_records($cari);
		
		$konfig['base_url'] = base_url().'domains/records'.$get;
		$konfig['total_rows'] = $jumlah;
		$konfig['per_page'] = 10;
		$from = $page;
		$this->pagination->initialize($konfig);
		$data['records'] = $this->M_db->get_data_records($konfig['per_page'],$from,$cari);

		$data['domain'] = $domain;
		$data['domain_list'] = $this->M_db->cari_domain();
		//$rec = $this->M_db->get_records($cari);
		//var_dump($rec);
		//$data['records'] = $rec['result'];
		$data['page'] = 'Records';
		$data['title'] = $this->config->item('title').' '.$data['page'];
		$this->load->view('header', $data);
		$this->load->view('navbar', $data);
		$this->load->view('records', $data);
		$this->load->view('Footer');
	}
}
