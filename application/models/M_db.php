<?php
class M_db extends CI_model
{
	public function get_records($where=null)
	{
		//var_dump($where);
		if ($where === null) {
			return false;
		}
		$this->db->where($where);
		$get = $this->db->get('records');
		$ret['get'] = $get->result();
		$ret['num'] = $get->num_rows();
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

	function cari_domain($domain=null, $start=null, $lim = null)
	{
		if($domain != null){
			$this->db->where($domain);
		}
		if($start != null){
			$this->db->limit($lim, $start);
		}
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

	function konfig($item='',$change='')
	{
		if ($item === '') {
			return 'error';
		}
		elseif ($change != '') {
			$this->db->where('item',$item);
			$update = array('value' => $change);
			$this->db->update('konfig', $update);
			return TRUE;
		}
		else{
			$this->db->where('item',$item);
			foreach ($this->db->get('konfig')->result() as $key);
			return $key->value;
		}
	}

	function add_domain($upload=null)
	{
		return $this->db->insert('domains',$upload);
	}

	function rem_domain($id='')
	{
		if ($id === '') {
			return 'error';
		}
		else{
			$this->db->where('id',$id);
			if($this->db->delete('domains')){
				return 'success';
			}
			else{
				return 'failed';
			}
		}
	}

}