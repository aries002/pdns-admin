<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tes extends CI_Controller {

	public function b($page=null)
	{
		$where['name']='';
		$jumlah_data = $this->M_db->hitung_records($where);
		$from = $page;
		$jml_data = 20;
		$cfg = array(
		 
		'base_url'=>base_url().'tes/b',
		 	
		 
		'per_page'=> $jml_data,
		 
		'total_rows' => $jumlah_data
		 
		);
		if (count($_GET) > 0) $cfg['suffix'] = '?' . http_build_query($_GET, '', "&");
		$cfg['first_url'] = $cfg['base_url'].'?'.http_build_query($_GET);

		$this->pagination->initialize($cfg);		
		$data['user'] = $this->M_db->get_data_records($jml_data,$from,$where);
		var_dump($jumlah_data);

		$this->load->view('v_data',$data);
	}

	function a()
	{
		$coba = array('satu' => 'data satu', 
						'dua' => 'data dua');
		foreach ($coba as $key => $value) {
			echo $key;
		}
	}


	function records($page = null)
	{
		//var_dump($domain);
		$data['url'] = base_url().'tes/records';
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
		$hitung = $this->M_db->hitung_records($cari);


		//pagignation
		$data_per_page = 20;
		$cfg = array(
		 
		'base_url'=>base_url().'tes/records',
		 	
		 
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


		$this->pagination->initialize($cfg);	

		//end pagignationx

		$data['records'] = $this->M_db->get_data_records($cfg['per_page'],$page,$cari);
		$data['domain'] = $domain;
		$data['domain_list'] = $this->M_db->cari_domain();
		$data['page'] = 'Records';
		$data['title'] = $this->config->item('title').' '.$data['page'];
		$this->load->view('header', $data);
		$this->load->view('navbar', $data);
		$this->load->view('tes/records', $data);
		$this->load->view('Footer');
	}
}