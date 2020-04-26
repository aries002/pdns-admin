<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class data_process extends CI_Controller {
///////////////////////////////////////////////////////////////////////
//					DATA PROCESSING

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

	

	public function add_record()
	{
		$add = null;
		$status = null;
		if ($this->input->post() != null) {
			if (($this->input->post('name') != null) && ($this->input->post('content') != null) && ($this->input->post('type') != null) && ($this->input->post('ttl') != null) && ($this->input->post('prio') != null) && ($this->input->post('domain') != null)) {
				$add['name'] 	= $this->input->post('name');
				$add['content'] = $this->input->post('content');
				$add['type'] 	= $this->input->post('type');
				$add['ttl'] 	= $this->input->post('ttl');
				$add['prio'] 	= $this->input->post('prio');
				$add['domain_id'] 	= $this->input->post('domain');
				$add['disabled'] = 0;
				if($this->M_db->add_record($add)){
					$status = 'success';
				}
			}
		}

		$link = base_url();
		if ($this->input->get('link') != null) {
			$link = $this->input->get('link');
		}
		header("location: ".$link);
	}

	public function edit_record()
	{
		$add = null;
		$status = null;
		if ($this->input->post() != null) {
			if (($this->input->post('name') != null) && ($this->input->post('content') != null) && ($this->input->post('type') != null) && ($this->input->post('ttl') != null) && ($this->input->post('prio') != null) && ($this->input->post('id') != null)) {
				$add['name'] 	= $this->input->post('name');
				$add['content'] = $this->input->post('content');
				$add['type'] 	= $this->input->post('type');
				$add['ttl'] 	= $this->input->post('ttl');
				$add['prio'] 	= $this->input->post('prio');
				$where['id'] 	= $this->input->post('id');
				if($this->M_db->edit_record($add,$where) == 'success'){
					$status = 'success';
				}
			}
		}
		$link = base_url();
		if ($this->input->get('link') != null) {
			$link = $this->input->get('link');
		}
		header("location: ".$link);
	}

	function delete_record($id='')
	{
		if ($this->input->get() === null) {
			header("location: ".base_url());
		}
		elseif ($this->input->get('link') != null) {
			$link = $this->input->get('link');
			$this->M_db->delete_record($id);
			header('location: '.$link);
		}
		else{
			header("location: ".base_url());
		}
	}

	function dissable_record($id='')
	{
		if ($this->input->get('link') != null) {
			$link = $this->input->get('link');
			$a = $this->M_db->disable_record($id);
			// var_dump($a);
			header('location: '.$link);
		}
		else{
			header("location: ".base_url());
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
		header('location:'.base_url().'domains/records?_domain='.$domain_id.'&pesan='.$pesan);
		//echo(json_encode($add));
	}
}