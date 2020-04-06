<?php
class M_db extends CI_model
{
	public function get_records($domain_id='', $start = 0,$lim = 20)
	{
		if($domain_id==''){
			$this->db->limit($lim,$start);
			$result = $this->db->get('records');
			return $result->result();
		}
		else{
			$cari['domain_id'] = $domain_id;
			$this->db->limit($lim,$start);
			$this->db->where($cari);
			$res = $this->db->get('records')->result();
			return $res;
		}
	}
}