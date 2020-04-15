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
	function hit_halaman($data_halaman=null)
	{
		# code...
	}

	function cari_domain($domain=null, $start=0, $lim = 100)
	{
		if($domain != null){
			$this->db->where($domain);
		}
		$this->db->limit($lim, $start);
		return $this->db->get('domains')->result();
	}


}