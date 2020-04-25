<?php
class M_db extends CI_model
{
	public function get_records($where=null, $start = 0,$lim = 20)
	{
		//var_dump($where);
		if($where==null){
			$this->db->limit($lim,$start);
			$res = $this->db->get('records');
		}
		else{
			$this->db->limit($lim,$start);
			$this->db->like($where);
			$res = $this->db->get('records');
		}
		$ret['total_row'] = $res->num_rows();
		$ret['result'] = $res->result();
		return $ret;
	}

	function hitung_records($where=null)
	{
		if ($where != null) {
			$this->db->like($where);
		}
		return $this->db->get('records')->num_rows();
	}

	function get_data_records($number, $offset, $where=null)
	{
		if($where != null){
			$this->db->like($where);
		}
		return $this->db->get('records', $number, $offset)->result();
	}

	function cari_domain($domain=null, $start=0, $lim = 100)
	{
		if($domain != null){
			$this->db->where($domain);
		}
		$this->db->limit($lim, $start);
		return $this->db->get('domains')->result();
	}

	function add_record($insert=null)
	{
		if ($this->db->insert('records',$insert)) {
			return true;
		}
		else {
			return false;
		}
	}

	function edit_record($edit=null,$where=null)
	{
		if (($where === null) && ($edit === null)) {
			return 'error';
		}
		$this->db->where($where);
		if ($this->db->update('records',$edit)) {
			return 'success';
		}
		else{
			return 'failed';
		}
	}

	function delete_record($id='')
	{
		if ($id === '') {
			return 'error';
		}
		else{
			$this->db->where('id',$id);
			if($this->db->delete('records')){
				return 'success';
			}
			else{
				return 'failed';
			}
		}
	}

	function disable_record($id='')
	{
		if ($id === '') {
			return 'error';
		}
		$this->db->where('id', $id);
		$cek = $this->db->get('records')->result();
		foreach ($cek as $key);
		if ($key->disabled === '1') {
			$edit = array('disabled' => '0');
		}
		else{
			$edit = array('disabled' => '1');
		}
		// var_dump($edit);
		$this->db->where('id', $id);
		if ($this->db->update('records',$edit)) {
			return 'success';
		}
		else{
			return 'failed';
		}
	}


}