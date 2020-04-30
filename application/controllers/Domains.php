<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Domains extends CI_Controller {
	public function index($id=null)
	{
		$data['page'] = 'Domains';
		$data['title'] = $this->config->item('title');
		$data['db_domain'] = $this->M_db->cari_domain();
		$this->load->view('header', $data);
		$this->load->view('navbar', $data);
		$this->load->view('domains', $data);
		$this->load->view('Footer');
	}

	function edit($id='')
	{
		if($id === ''){
			header("location: ".base_url().'domains');
		}
		$data['page'] = 'Domains';
		$data['title'] = $this->config->item('title');
		$cari['id'] = $id;
		foreach ($this->M_db->cari_domain($cari) as $key);
		$data['domain'] = $key;
		$this->load->view('header', $data);
		$this->load->view('navbar', $data);
		$this->load->view('domain_edit', $data);
		$this->load->view('Footer');
	}

	function tambah()
	{
		$data['page'] = 'Domains';
		$data['title'] = $this->config->item('title');
		$this->load->view('header', $data);
		$this->load->view('navbar', $data);
		$this->load->view('domain_add', $data);
		$this->load->view('Footer');
	}


	function records($page = null)
	{
		//var_dump($domain);
		$data['url'] = base_url().'domains/records';
		$data['tipe'] = null;
		$domain=null;
		$cari = null;
		if($this->input->get()){

			if($this->input->get('cari') != null){
				$cari['name'] = $this->input->get('cari');
			}
			if($this->input->get('cari2') != null){
				$cari['content'] = $this->input->get('cari2');
			}
			if($this->input->get('tipe') != null){
				$data['tipe'] = $cari['type'] = $this->input->get('tipe');
			}
			if ($this->input->get('_domain') != null) {
				//var_dump($this->input->get('_domain'));
				
				$domain = $cari['domain_id'] = $this->input->get('_domain');
			}
			// if($this->input->get('page') != null){
			// 	$page = $this->input->get('page');
			// }
		}
		$hitung = $this->M_db->hitung_records($cari);


		//pagignation
		$data_per_page = 20;
		$cfg = array(
		 
		'base_url'=>base_url().'domains/records',
		 	
		 
		'per_page'=> $data_per_page,
		 
		'total_rows' => $hitung
		 
		);
		if (count($_GET) > 0) $cfg['suffix'] = '?' . http_build_query($_GET, '', "&");
		$cfg['first_url'] = $cfg['base_url'].'?'.http_build_query($_GET);

		$cfg['next_link'] = 'Selanjutnya';
		$cfg['prev_link'] = 'Sebelumnya';
		$cfg['first_link'] = 'Awal';
		$cfg['last_link'] = 'Akhir';
		$cfg['full_tag_open'] = '<ul class="pagination">';
		$cfg['full_tag_close'] = '</ul>';
		$cfg['num_tag_open'] = '<li>';
		$cfg['num_tag_close'] = '</li>';
		$cfg['cur_tag_open'] = '<li class="active"><a href="#">';
		$cfg['cur_tag_close'] = '</a></li>';
		$cfg['prev_tag_open'] = '<li>';
		$cfg['prev_tag_close'] = '</li>';
		$cfg['next_tag_open'] = '<li>';
		$cfg['next_tag_close'] = '</li>';
		$cfg['last_tag_open'] = '<li>';
		$cfg['last_tag_open'] = '<li>';
		$cfg['first_tag_open'] = '<li>';
		$cfg['first_tag_open'] = '<li>';

		$data['url2'] = $cfg['first_url'];
		$this->pagination->initialize($cfg);	

		//end pagignationx

		$data['records'] = $this->M_db->get_data_records($cfg['per_page'],$page,$cari);
		$data['total'] = $hitung;
		$data['domain'] = $domain;
		$data['domain_list'] = $this->M_db->cari_domain();
		$data['page'] = 'Records';
		$data['title'] = $this->config->item('title').' '.$data['page'];
		$this->load->view('header', $data);
		$this->load->view('navbar', $data);
		$this->load->view('records', $data);
		//modal
		foreach ($data['records'] as $key2) {
			$data_modal = array('id' => "modal$key2->id",
								'name' => "$key2->name",
								'data' => $key2
								 );
			$data_modal['url2'] = $cfg['first_url'];
			$this->load->view('modal_records',$data_modal);
		}

		$this->load->view('Footer');
	}
}