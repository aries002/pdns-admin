<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tes extends CI_Controller {

	function __construct()
	{
		// header('location:');
	}

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



	function add_domain()
	{
		$pesan = 'success';
		if ($this->input->post() === null) {
			header("location: ".base_url());
			//echo 1;
		}
		if ($this->input->post('domain') === null) {
			header("location: ".base_url());
			//echo 2;
		}

		$in = $this->input->post();

		if ($in['ip'] === '') {
			$in['ip'] = $this->M_db->konfig('def-ip');
		}
		if ($in['ip-ns1'] === '') {
			$in['ip-ns1'] = $this->M_db->konfig('def-ip-ns1');
		}
		if ($in['ip-ns2'] === '') {
			$in['ip-ns2'] = $this->M_db->konfig('def-ip-ns2');
		}
		//var_dump($in);

		$domain_id = null;

		$add_domain = array('name' => $in['domain'], 'type' => 'NATIVE');
		$a = $this->M_db->cari_domain($add_domain);

		if($a == null){
			// echo 'bisa';
			$this->M_db->add_domain($add_domain);
			// var_dump($b);
			// echo '<br>';
			$get_domain = $this->M_db->cari_domain($add_domain);
			foreach ($get_domain as $domain);
			// var_dump($domain);
			$domain_id = $domain->id;
		}
		else{
			$pesan = "error_domain_exist";
		}
		if ($domain_id != null) {
			$add[] = array(
						'domain_id'	=> $domain_id,
						'name' 			=> $in['domain'],
						'type' 			=> 'SOA',
						'content' 		=> "ns1.".$in['domain']." ns2.".$in['domain']." 1 10800 3600 604800 3600",
						'ttl' 			=> 3600,
						'prio' 			=> 0,
						'disabled'		=> 0,
						'auth'			=> 1
					);
			$add[] = array(
						'domain_id'	=> $domain_id,
						'name' 			=> $in['domain'],
						'type' 			=> 'NS',
						'content' 		=> "ns1.".$in['domain'],
						'ttl' 			=> 3600,
						'prio' 			=> 0,
						'disabled'		=> 0,
						'auth'			=> 1
					);
			$add[] = array(
						'domain_id'	=> $domain_id,
						'name' 			=> $in['domain'],
						'type' 			=> 'NS',
						'content' 		=> "ns2.".$in['domain'],
						'ttl' 			=> 3600,
						'prio' 			=> 0,
						'disabled'		=> 0,
						'auth'			=> 1
					);
			$add[] = array(
						'domain_id'	=> $domain_id,
						'name' 			=> $in['domain'],
						'type' 			=> 'A',
						'content' 		=> $in['ip'],
						'ttl' 			=> 3600,
						'prio' 			=> 0,
						'disabled'		=> 0,
						'auth'			=> 1
					);
			$add[] = array(
						'domain_id'	=> $domain_id,
						'name' 			=> 'ns1'.$in['domain'],
						'type' 			=> 'A',
						'content' 		=> $in['ip-ns1'],
						'ttl' 			=> 3600,
						'prio' 			=> 0,
						'disabled'		=> 0,
						'auth'			=> 1
					);
			$add[] = array(
						'domain_id'	=> $domain_id,
						'name' 			=> 'ns2'.$in['domain'],
						'type' 			=> 'A',
						'content' 		=> $in['ip-ns2'],
						'ttl' 			=> 3600,
						'prio' 			=> 0,
						'disabled'		=> 0,
						'auth'			=> 1
					);
			// $c = [];
			foreach ($add as $insert) {
				$this->M_db->add_record($insert);
			}
			
			// echo '<br>';
			// var_dump($c);
		}
		header('location:'.base_url().'domains?pesan='.$pesan);
		//echo(json_encode($add));
	}

	function delete_domain()
	{
		$pesan = [];
		if ($this->input->post() != null) {
			if (($this->input->post('konfirm') === 'yes') && ($this->input->post('id') != null)) {
				$id = $this->input->post('id');
				if($id === '*'){
					// header('location:'.base_url());
					$pesan['status'] = 'error';
					$pesan['cause'] = 'ilegal input';
				}
				else{
					$where['domain_id'] = $id;
					$db_record = $this->M_db->get_records($where);
					foreach ($db_record['get'] as $key){
						$pesan['record'][$key->id] = $this->M_db->delete_record($key->id);
					}
					$cek = $this->M_db->get_records($where);
					if ($cek['num'] === 0) {
						$pesan['domain_delete'] = $this->M_db->rem_domain($id);
					}
					
					$pesan['record_delete'] = $db_record['num'];
					$pesan['status'] = 'success';
					$pesan['cause'] = 'data deleted';
				}
			}
			else{
				$pesan['status'] = 'error';
				$pesan['cause'] = 'ilegal input';
			}
		}
		else{
			$pesan['status'] = 'error';
			$pesan['cause'] = 'ilegal input';
		}
		echo json_encode($pesan);
		header('location:'.base_url().'domains');
	}
}