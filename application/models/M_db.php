<?php
class M_db extends CI_model
{
	public function get_records($where=null, $start = 0,$lim = 20)
	{
		//var_dump($where);
		if($where==null){
			$this->db->limit($lim,$start);
			$result = $this->db->get('records');
			return $result->result();
		}
		else{
			$this->db->limit($lim,$start);
			$this->db->like($where);
			$res = $this->db->get('records')->result();
			return $res;
		}
	}

	function cari_domain($domain=null, $start=0, $lim = 100)
	{
		if($domain != null){
			$this->db->where($domain);
		}
		$this->db->limit($lim, $start);
		$result = $this->db->get('domains')->result();
		return $result;
	}
}