<?php 
	class paws_model extends CI_Model{
		function getData($email, $pass){
			return $this->db->get_where('profil', array('email'=>$email, 'password'=>$pass))->row();
		}
		function getNama($email, $pass){
			$this->db->select('nama');
			$this->db->where(array('email'=>$email, 'password'=>$pass));
			$q=$this->db->get('profil');
			$data=$q->result_array();
			return $data[0]['nama'];
		}
		function getSaldo($email, $pass){
			$this->db->select('saldo');
			$this->db->where(array('email'=>$email, 'password'=>$pass));
			$q=$this->db->get('profil');
			$data=$q->result_array();
			return $data[0]['saldo'];
		}
		function tambahSaldo($email, $pass, $duit){
			$this->db->where(array('email'=>$email, 'password'=>$pass));
			$this->db->update('profil', $duit);
			return true;
		}
		function tambahRiwayat($data, $table){
			$this->db->insert($table, $data);
		}
		function outProfile($nama){
			$this->db->where(array('nama'=>$nama));
			return $this->db->get('riwayat');
		}
	}
?>