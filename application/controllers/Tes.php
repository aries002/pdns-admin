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


	
}