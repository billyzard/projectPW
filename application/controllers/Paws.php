<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
	class Paws extends CI_Controller{
		function __construct(){
			parent::__construct();
			$this->load->model('paws_model');
			$this->load->helper('url');
		}
		public function home(){
			$this->load->view('home');
		}
		public function about(){
			$this->load->view('about');
		}
		public function topup(){
			if($this->session->userdata('logged_in')=='true'){
				$this->load->view('topup');	
			}
			else{
				$this->session->set_userdata('hrs_login', 'belom');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
		public function register(){
			$this->load->view('register');
		}
		public function riwayat(){
			if($this->session->userdata('logged_in')=='true'){
				$data['riwayat']=$this->paws_model->outProfile($this->session->userdata('nama'))->result();
				$this->load->view('riwayat', $data);
			}
			else{
				$this->session->set_userdata('hrs_login', 'belom');
				redirect($_SERVER['HTTP_REFERER']);	
			}
		}
		public function tambahProfil(){
			$nama=$this->input->post('nama');
			$email=$this->input->post('email');
			$pass=$this->input->post('pass');
			$repass=$this->input->post('repass');
			$saldo=0;
			if($pass!=$repass){
				$this->session->set_userdata('beda', 'benar');
				redirect($_SERVER['HTTP_REFERER']);
			}
			else{
				$data=array('nama'=>$nama, 'email'=>$email, 'password'=>$pass, 'saldo'=>$saldo);
				$this->paws_model->tambahRiwayat($data, 'profil');
				redirect('Paws/home');
			}
		}
		public function caratopup(){
			$this->load->view('caratopup');
		}
		public function caramembeli(){
			$this->load->view('caramembeli');
		}
		public function isiSaldo(){
			$this->load->helper('date');
			date_default_timezone_set('Asia/Jakarta');
			$duit=$this->input->post('duit');
			$this->session->set_userdata('tambah', $duit);
			$duit=$duit+$this->paws_model->getSaldo($this->session->userdata('email'), $this->session->userdata('pass'));
			$data=array('saldo'=>$duit);
			$this->session->set_userdata('saldo', $duit);
			if($this->paws_model->tambahSaldo($this->session->userdata('email'), $this->session->userdata('pass'), $data)){
				$this->session->set_userdata('isiSaldo', 'sukses');
				$data=array('nama'=>$this->session->userdata('nama'), 'portal'=>'-', 'saldo'=>$this->session->userdata('tambah'), 'date'=>date('Y-m-d H:i:s', now()), 'ket'=>'Isi saldo');
				$this->paws_model->tambahRiwayat($data, 'riwayat');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
		public function login(){
			$email=$this->input->post('email');
			$pass=$this->input->post('pwd');
			$this->session->set_userdata('email', $email);
			$this->session->set_userdata('pass', $pass);
			if($this->paws_model->getData($email, $pass)){
				$this->session->set_userdata('logged_in', 'true');
				$this->session->set_userdata('nama', $this->paws_model->getNama($email, $pass));
				$this->session->set_userdata('saldo', $this->paws_model->getSaldo($email, $pass));
				redirect($_SERVER['HTTP_REFERER']);
			}
			else{
				$this->session->set_userdata('salah', 'gagal');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
		public function logout(){
			$data=array('logged_in', 'nama', 'saldo', 'email', 'pass');
			$this->session->unset_userdata($data);
			redirect('Paws/home');
		}
		public function western(){
			$this->load->view('western');
		}
		public function beliwestern(){
			$this->load->helper('date');
			date_default_timezone_set('Asia/Jakarta');
			if($this->session->userdata('logged_in')!='true'){
				$this->session->set_userdata('hrs_login', 'belom');
				redirect($_SERVER['HTTP_REFERER']);
			}
			else{
				if(isset($_POST["western1"])){
					$saldo=$this->paws_model->getSaldo($this->session->userdata('email'), $this->session->userdata('pass'));
					$harga=45000;
					$this->session->set_userdata('harga', $harga);
					$saldo=$saldo-$harga;
					if($saldo<0){
						$this->session->set_userdata('beli', 'kurang');
						redirect($_SERVER['HTTP_REFERER']);
					}
					else{
						$this->session->set_userdata('saldo', $saldo);
						$data=array('saldo'=>$saldo);
						if($this->paws_model->tambahSaldo($this->session->userdata('email'), $this->session->userdata('pass'), $data)){
							$this->session->set_userdata('beli', 'mantap');
						}
						$data=array('nama'=>$this->session->userdata('nama'), 'portal'=>'western', 'saldo'=>$this->session->userdata('harga'), 'date'=>date('Y-m-d H:i:s', now()), 'ket'=>'Beli');
						$this->paws_model->tambahRiwayat($data, 'riwayat');
						redirect($_SERVER['HTTP_REFERER']);
					}
				}
				else if(isset($_POST["western2"])){
					$saldo=$this->paws_model->getSaldo($this->session->userdata('email'), $this->session->userdata('pass'));
					$harga=60000;
					$this->session->set_userdata('harga', $harga);
					$saldo=$saldo-$harga;
					if($saldo<0){
						$this->session->set_userdata('beli', 'kurang');
						redirect($_SERVER['HTTP_REFERER']);
					}
					else{
						$this->session->set_userdata('saldo', $saldo);
						$data=array('saldo'=>$saldo);
						if($this->paws_model->tambahSaldo($this->session->userdata('email'), $this->session->userdata('pass'), $data)){
							$this->session->set_userdata('beli', 'mantap');
						}
						$data=array('nama'=>$this->session->userdata('nama'), 'portal'=>'western', 'saldo'=>$this->session->userdata('harga'), 'date'=>date('Y-m-d H:i:s', now()), 'ket'=>'Beli');
						$this->paws_model->tambahRiwayat($data, 'riwayat');
						redirect($_SERVER['HTTP_REFERER']);
					}
				}
				else if(isset($_POST["western3"])){
					$saldo=$this->paws_model->getSaldo($this->session->userdata('email'), $this->session->userdata('pass'));
					$harga=120000;
					$this->session->set_userdata('harga', $harga);
					$saldo=$saldo-$harga;
					if($saldo<0){
						$this->session->set_userdata('beli', 'kurang');
						redirect($_SERVER['HTTP_REFERER']);
					}
					else{
						$this->session->set_userdata('saldo', $saldo);
						$data=array('saldo'=>$saldo);
						if($this->paws_model->tambahSaldo($this->session->userdata('email'), $this->session->userdata('pass'), $data)){
							$this->session->set_userdata('beli', 'mantap');
						}
						$data=array('nama'=>$this->session->userdata('nama'), 'portal'=>'western', 'saldo'=>$this->session->userdata('harga'), 'date'=>date('Y-m-d H:i:s', now()), 'ket'=>'Beli');
						$this->paws_model->tambahRiwayat($data, 'riwayat');
						redirect($_SERVER['HTTP_REFERER']);
					}
				}
				else if(isset($_POST["western4"])){
					$saldo=$this->paws_model->getSaldo($this->session->userdata('email'), $this->session->userdata('pass'));
					$harga=250000;
					$this->session->set_userdata('harga', $harga);
					$saldo=$saldo-$harga;
					if($saldo<0){
						$this->session->set_userdata('beli', 'kurang');
						redirect($_SERVER['HTTP_REFERER']);
					}
					else{
						$this->session->set_userdata('saldo', $saldo);
						$data=array('saldo'=>$saldo);
						if($this->paws_model->tambahSaldo($this->session->userdata('email'), $this->session->userdata('pass'), $data)){
							$this->session->set_userdata('beli', 'mantap');
						}
						$data=array('nama'=>$this->session->userdata('nama'), 'portal'=>'western', 'saldo'=>$this->session->userdata('harga'), 'date'=>date('Y-m-d H:i:s', now()), 'ket'=>'Beli');
						$this->paws_model->tambahRiwayat($data, 'riwayat');
						redirect($_SERVER['HTTP_REFERER']);
					}
				}
			}
		}
		public function minang(){
			$this->load->view('minang');
		}
		public function beliMega(){
			$this->load->helper('date');
			date_default_timezone_set('Asia/Jakarta');
			if($this->session->userdata('logged_in')!='true'){
				$this->session->set_userdata('hrs_login', 'belom');
				redirect($_SERVER['HTTP_REFERER']);
			}
			else{
				if(isset($_POST["mega1"])){
					$saldo=$this->paws_model->getSaldo($this->session->userdata('email'), $this->session->userdata('pass'));
					$harga=10000;
					$this->session->set_userdata('harga', $harga);
					$saldo=$saldo-$harga;
					if($saldo<0){
						$this->session->set_userdata('beli', 'kurang');
						redirect($_SERVER['HTTP_REFERER']);
					}
					else{
						$this->session->set_userdata('saldo', $saldo);
						$data=array('saldo'=>$saldo);
						if($this->paws_model->tambahSaldo($this->session->userdata('email'), $this->session->userdata('pass'), $data)){
							$this->session->set_userdata('beli', 'mantap');
						}
						$data=array('nama'=>$this->session->userdata('nama'), 'portal'=>'minang', 'saldo'=>$this->session->userdata('harga'), 'date'=>date('Y-m-d H:i:s', now()), 'ket'=>'Beli');
						$this->paws_model->tambahRiwayat($data, 'riwayat');
						redirect($_SERVER['HTTP_REFERER']);
					}
				}
				else if(isset($_POST["mega2"])){
					$saldo=$this->paws_model->getSaldo($this->session->userdata('email'), $this->session->userdata('pass'));
					$harga=20000;
					$this->session->set_userdata('harga', $harga);
					$saldo=$saldo-$harga;
					if($saldo<0){
						$this->session->set_userdata('beli', 'kurang');
						redirect($_SERVER['HTTP_REFERER']);
					}
					else{
						$this->session->set_userdata('saldo', $saldo);
						$data=array('saldo'=>$saldo);
						if($this->paws_model->tambahSaldo($this->session->userdata('email'), $this->session->userdata('pass'), $data)){
							$this->session->set_userdata('beli', 'mantap');
						}
						$data=array('nama'=>$this->session->userdata('nama'), 'portal'=>'minang', 'saldo'=>$this->session->userdata('harga'), 'date'=>date('Y-m-d H:i:s', now()), 'ket'=>'Beli');
						$this->paws_model->tambahRiwayat($data, 'riwayat');
						redirect($_SERVER['HTTP_REFERER']);
					}
				}
				else if(isset($_POST["mega3"])){
					$saldo=$this->paws_model->getSaldo($this->session->userdata('email'), $this->session->userdata('pass'));
					$harga=50000;
					$this->session->set_userdata('harga', $harga);
					$saldo=$saldo-$harga;
					if($saldo<0){
						$this->session->set_userdata('beli', 'kurang');
						redirect($_SERVER['HTTP_REFERER']);
					}
					else{
						$this->session->set_userdata('saldo', $saldo);
						$data=array('saldo'=>$saldo);
						if($this->paws_model->tambahSaldo($this->session->userdata('email'), $this->session->userdata('pass'), $data)){
							$this->session->set_userdata('beli', 'mantap');
						}
						$data=array('nama'=>$this->session->userdata('nama'), 'portal'=>'minang', 'saldo'=>$this->session->userdata('harga'), 'date'=>date('Y-m-d H:i:s', now()), 'ket'=>'Beli');
						$this->paws_model->tambahRiwayat($data, 'riwayat');
						redirect($_SERVER['HTTP_REFERER']);
					}
				}
				else if(isset($_POST["mega4"])){
					$saldo=$this->paws_model->getSaldo($this->session->userdata('email'), $this->session->userdata('pass'));
					$harga=100000;
					$this->session->set_userdata('harga', $harga);
					$saldo=$saldo-$harga;
					if($saldo<0){
						$this->session->set_userdata('beli', 'kurang');
						redirect($_SERVER['HTTP_REFERER']);
					}
					else{
						$this->session->set_userdata('saldo', $saldo);
						$data=array('saldo'=>$saldo);
						if($this->paws_model->tambahSaldo($this->session->userdata('email'), $this->session->userdata('pass'), $data)){
							$this->session->set_userdata('beli', 'mantap');
						}
						$data=array('nama'=>$this->session->userdata('nama'), 'portal'=>'minang', 'saldo'=>$this->session->userdata('harga'), 'date'=>date('Y-m-d H:i:s', now()), 'ket'=>'Beli');
						$this->paws_model->tambahRiwayat($data, 'riwayat');
						redirect($_SERVER['HTTP_REFERER']);
					}
				}
			}
		}
		public function japan(){
			$this->load->view('japan');
		}
		public function beliOri(){
			$this->load->helper('date');
			date_default_timezone_set('Asia/Jakarta');
			if($this->session->userdata('logged_in')!='true'){
				$this->session->set_userdata('hrs_login', 'belom');
				redirect($_SERVER['HTTP_REFERER']);
			}
			else{
				if(isset($_POST["ori1"])){
					$saldo=$this->paws_model->getSaldo($this->session->userdata('email'), $this->session->userdata('pass'));
					$harga=10000;
					$this->session->set_userdata('harga', $harga);
					$saldo=$saldo-$harga;
					if($saldo<0){
						$this->session->set_userdata('beli', 'kurang');
						redirect($_SERVER['HTTP_REFERER']);
					}
					else{
						$this->session->set_userdata('saldo', $saldo);
						$data=array('saldo'=>$saldo);
						if($this->paws_model->tambahSaldo($this->session->userdata('email'), $this->session->userdata('pass'), $data)){
							$this->session->set_userdata('beli', 'mantap');
						}
						$data=array('nama'=>$this->session->userdata('nama'), 'portal'=>'japan', 'saldo'=>$this->session->userdata('harga'), 'date'=>date('Y-m-d H:i:s', now()), 'ket'=>'Beli');
						$this->paws_model->tambahRiwayat($data, 'riwayat');
						redirect($_SERVER['HTTP_REFERER']);
					}
				}
				else if(isset($_POST["ori2"])){
					$saldo=$this->paws_model->getSaldo($this->session->userdata('email'), $this->session->userdata('pass'));
					$harga=20000;
					$this->session->set_userdata('harga', $harga);
					$saldo=$saldo-$harga;
					if($saldo<0){
						$this->session->set_userdata('beli', 'kurang');
						redirect($_SERVER['HTTP_REFERER']);
					}
					else{
						$this->session->set_userdata('saldo', $saldo);
						$data=array('saldo'=>$saldo);
						if($this->paws_model->tambahSaldo($this->session->userdata('email'), $this->session->userdata('pass'), $data)){
							$this->session->set_userdata('beli', 'mantap');
						}
						$data=array('nama'=>$this->session->userdata('nama'), 'portal'=>'japan', 'saldo'=>$this->session->userdata('harga'), 'date'=>date('Y-m-d H:i:s', now()), 'ket'=>'Beli');
						$this->paws_model->tambahRiwayat($data, 'riwayat');
						redirect($_SERVER['HTTP_REFERER']);
					}
				}
				else if(isset($_POST["ori3"])){
					$saldo=$this->paws_model->getSaldo($this->session->userdata('email'), $this->session->userdata('pass'));
					$harga=50000;
					$this->session->set_userdata('harga', $harga);
					$saldo=$saldo-$harga;
					if($saldo<0){
						$this->session->set_userdata('beli', 'kurang');
						redirect($_SERVER['HTTP_REFERER']);
					}
					else{
						$this->session->set_userdata('saldo', $saldo);
						$data=array('saldo'=>$saldo);
						if($this->paws_model->tambahSaldo($this->session->userdata('email'), $this->session->userdata('pass'), $data)){
							$this->session->set_userdata('beli', 'mantap');
						}
						$data=array('nama'=>$this->session->userdata('nama'), 'portal'=>'japan', 'saldo'=>$this->session->userdata('harga'), 'date'=>date('Y-m-d H:i:s', now()), 'ket'=>'Beli');
						$this->paws_model->tambahRiwayat($data, 'riwayat');
						redirect($_SERVER['HTTP_REFERER']);
					}
				}
				else if(isset($_POST["ori4"])){
					$saldo=$this->paws_model->getSaldo($this->session->userdata('email'), $this->session->userdata('pass'));
					$harga=100000;
					$this->session->set_userdata('harga', $harga);
					$saldo=$saldo-$harga;
					if($saldo<0){
						$this->session->set_userdata('beli', 'kurang');
						redirect($_SERVER['HTTP_REFERER']);
					}
					else{
						$this->session->set_userdata('saldo', $saldo);
						$data=array('saldo'=>$saldo);
						if($this->paws_model->tambahSaldo($this->session->userdata('email'), $this->session->userdata('pass'), $data)){
							$this->session->set_userdata('beli', 'mantap');
						}
						$data=array('nama'=>$this->session->userdata('nama'), 'portal'=>'japan', 'saldo'=>$this->session->userdata('harga'), 'date'=>date('Y-m-d H:i:s', now()), 'ket'=>'Beli');
						$this->paws_model->tambahRiwayat($data, 'riwayat');
						redirect($_SERVER['HTTP_REFERER']);
					}
				}
			}
		}
		public function sunda(){
			$this->load->view('sunda');
		}
		public function beliGar(){
			$this->load->helper('date');
			date_default_timezone_set('Asia/Jakarta');
			if($this->session->userdata('logged_in')!='true'){
				$this->session->set_userdata('hrs_login', 'belom');
				redirect($_SERVER['HTTP_REFERER']);
			}
			else{
				if(isset($_POST["gare1"])){
					$saldo=$this->paws_model->getSaldo($this->session->userdata('email'), $this->session->userdata('pass'));
					$harga=10000;
					$this->session->set_userdata('harga', $harga);
					$saldo=$saldo-$harga;
					if($saldo<0){
						$this->session->set_userdata('beli', 'kurang');
						redirect($_SERVER['HTTP_REFERER']);
					}
					else{
						$this->session->set_userdata('saldo', $saldo);
						$data=array('saldo'=>$saldo);
						if($this->paws_model->tambahSaldo($this->session->userdata('email'), $this->session->userdata('pass'), $data)){
							$this->session->set_userdata('beli', 'mantap');
						}
						$data=array('nama'=>$this->session->userdata('nama'), 'portal'=>'sunda', 'saldo'=>$this->session->userdata('harga'), 'date'=>date('Y-m-d H:i:s', now()), 'ket'=>'Beli');
						$this->paws_model->tambahRiwayat($data, 'riwayat');
						redirect($_SERVER['HTTP_REFERER']);
					}
				}
				else if(isset($_POST["gare2"])){
					$saldo=$this->paws_model->getSaldo($this->session->userdata('email'), $this->session->userdata('pass'));
					$harga=20000;
					$this->session->set_userdata('harga', $harga);
					$saldo=$saldo-$harga;
					if($saldo<0){
						$this->session->set_userdata('beli', 'kurang');
						redirect($_SERVER['HTTP_REFERER']);
					}
					else{
						$this->session->set_userdata('saldo', $saldo);
						$data=array('saldo'=>$saldo);
						if($this->paws_model->tambahSaldo($this->session->userdata('email'), $this->session->userdata('pass'), $data)){
							$this->session->set_userdata('beli', 'mantap');
						}
						$data=array('nama'=>$this->session->userdata('nama'), 'portal'=>'sunda', 'saldo'=>$this->session->userdata('harga'), 'date'=>date('Y-m-d H:i:s', now()), 'ket'=>'Beli');
						$this->paws_model->tambahRiwayat($data, 'riwayat');
						redirect($_SERVER['HTTP_REFERER']);
					}
				}
				else if(isset($_POST["gare3"])){
					$saldo=$this->paws_model->getSaldo($this->session->userdata('email'), $this->session->userdata('pass'));
					$harga=50000;
					$this->session->set_userdata('harga', $harga);
					$saldo=$saldo-$harga;
					if($saldo<0){
						$this->session->set_userdata('beli', 'kurang');
						redirect($_SERVER['HTTP_REFERER']);
					}
					else{
						$this->session->set_userdata('saldo', $saldo);
						$data=array('saldo'=>$saldo);
						if($this->paws_model->tambahSaldo($this->session->userdata('email'), $this->session->userdata('pass'), $data)){
							$this->session->set_userdata('beli', 'mantap');
						}
						$data=array('nama'=>$this->session->userdata('nama'), 'portal'=>'sunda', 'saldo'=>$this->session->userdata('harga'), 'date'=>date('Y-m-d H:i:s', now()), 'ket'=>'Beli');
						$this->paws_model->tambahRiwayat($data, 'riwayat');
						redirect($_SERVER['HTTP_REFERER']);
					}
				}
				else if(isset($_POST["gare4"])){
					$saldo=$this->paws_model->getSaldo($this->session->userdata('email'), $this->session->userdata('pass'));
					$harga=100000;
					$this->session->set_userdata('harga', $harga);
					$saldo=$saldo-$harga;
					if($saldo<0){
						$this->session->set_userdata('beli', 'kurang');
						redirect($_SERVER['HTTP_REFERER']);
					}
					else{
						$this->session->set_userdata('saldo', $saldo);
						$data=array('saldo'=>$saldo);
						if($this->paws_model->tambahSaldo($this->session->userdata('email'), $this->session->userdata('pass'), $data)){
							$this->session->set_userdata('beli', 'mantap');
						}
						$data=array('nama'=>$this->session->userdata('nama'), 'portal'=>'sunda', 'saldo'=>$this->session->userdata('harga'), 'date'=>date('Y-m-d H:i:s', now()), 'ket'=>'Beli');
						$this->paws_model->tambahRiwayat($data, 'riwayat');
						redirect($_SERVER['HTTP_REFERER']);
					}
				}
			}
		}
		public function drink(){
			$this->load->view('drink');
		}
		public function beliGems(){
			$this->load->helper('date');
			date_default_timezone_set('Asia/Jakarta');
			if($this->session->userdata('logged_in')!='true'){
				$this->session->set_userdata('hrs_login', 'belom');
				redirect($_SERVER['HTTP_REFERER']);
			}
			else{
				if(isset($_POST["gems1"])){
					$saldo=$this->paws_model->getSaldo($this->session->userdata('email'), $this->session->userdata('pass'));
					$harga=10000;
					$this->session->set_userdata('harga', $harga);
					$saldo=$saldo-$harga;
					if($saldo<0){
						$this->session->set_userdata('beli', 'kurang');
						redirect($_SERVER['HTTP_REFERER']);
					}
					else{
						$this->session->set_userdata('saldo', $saldo);
						$data=array('saldo'=>$saldo);
						if($this->paws_model->tambahSaldo($this->session->userdata('email'), $this->session->userdata('pass'), $data)){
							$this->session->set_userdata('beli', 'mantap');
						}
						$data=array('nama'=>$this->session->userdata('nama'), 'portal'=>'Drink', 'saldo'=>$this->session->userdata('harga'), 'date'=>date('Y-m-d H:i:s', now()), 'ket'=>'Beli');
						$this->paws_model->tambahRiwayat($data, 'riwayat');
						redirect($_SERVER['HTTP_REFERER']);
					}
				}
				else if(isset($_POST["gems2"])){
					$saldo=$this->paws_model->getSaldo($this->session->userdata('email'), $this->session->userdata('pass'));
					$harga=20000;
					$this->session->set_userdata('harga', $harga);
					$saldo=$saldo-$harga;
					if($saldo<0){
						$this->session->set_userdata('beli', 'kurang');
						redirect($_SERVER['HTTP_REFERER']);
					}
					else{
						$this->session->set_userdata('saldo', $saldo);
						$data=array('saldo'=>$saldo);
						if($this->paws_model->tambahSaldo($this->session->userdata('email'), $this->session->userdata('pass'), $data)){
							$this->session->set_userdata('beli', 'mantap');
						}
						$data=array('nama'=>$this->session->userdata('nama'), 'portal'=>'Drink', 'saldo'=>$this->session->userdata('harga'), 'date'=>date('Y-m-d H:i:s', now()), 'ket'=>'Beli');
						$this->paws_model->tambahRiwayat($data, 'riwayat');
						redirect($_SERVER['HTTP_REFERER']);
					}
				}
				else if(isset($_POST["gems3"])){
					$saldo=$this->paws_model->getSaldo($this->session->userdata('email'), $this->session->userdata('pass'));
					$harga=50000;
					$this->session->set_userdata('harga', $harga);
					$saldo=$saldo-$harga;
					if($saldo<0){
						$this->session->set_userdata('beli', 'kurang');
						redirect($_SERVER['HTTP_REFERER']);
					}
					else{
						$this->session->set_userdata('saldo', $saldo);
						$data=array('saldo'=>$saldo);
						if($this->paws_model->tambahSaldo($this->session->userdata('email'), $this->session->userdata('pass'), $data)){
							$this->session->set_userdata('beli', 'mantap');
						}
						$data=array('nama'=>$this->session->userdata('nama'), 'portal'=>'Drink', 'saldo'=>$this->session->userdata('harga'), 'date'=>date('Y-m-d H:i:s', now()), 'ket'=>'Beli');
						$this->paws_model->tambahRiwayat($data, 'riwayat');
						redirect($_SERVER['HTTP_REFERER']);
					}
				}
				else if(isset($_POST["gems4"])){
					$saldo=$this->paws_model->getSaldo($this->session->userdata('email'), $this->session->userdata('pass'));
					$harga=100000;
					$this->session->set_userdata('harga', $harga);
					$saldo=$saldo-$harga;
					if($saldo<0){
						$this->session->set_userdata('beli', 'kurang');
						redirect($_SERVER['HTTP_REFERER']);
					}
					else{
						$this->session->set_userdata('saldo', $saldo);
						$data=array('saldo'=>$saldo);
						if($this->paws_model->tambahSaldo($this->session->userdata('email'), $this->session->userdata('pass'), $data)){
							$this->session->set_userdata('beli', 'mantap');
						}
						$data=array('nama'=>$this->session->userdata('nama'), 'portal'=>'Drink', 'saldo'=>$this->session->userdata('harga'), 'date'=>date('Y-m-d H:i:s', now()), 'ket'=>'Beli');
						$this->paws_model->tambahRiwayat($data, 'riwayat');
						redirect($_SERVER['HTTP_REFERER']);
					}
				}
			}
		}
		public function jawa(){
			$this->load->view('jawa');
		}
		public function belijawa(){
			$this->load->helper('date');
			date_default_timezone_set('Asia/Jakarta');
			if($this->session->userdata('logged_in')!='true'){
				$this->session->set_userdata('hrs_login', 'belom');
				redirect($_SERVER['HTTP_REFERER']);
			}
			else{
				if(isset($_POST["jawa1"])){
					$saldo=$this->paws_model->getSaldo($this->session->userdata('email'), $this->session->userdata('pass'));
					$harga=10000;
					$this->session->set_userdata('harga', $harga);
					$saldo=$saldo-$harga;
					if($saldo<0){
						$this->session->set_userdata('beli', 'kurang');
						redirect($_SERVER['HTTP_REFERER']);
					}
					else{
						$this->session->set_userdata('saldo', $saldo);
						$data=array('saldo'=>$saldo);
						if($this->paws_model->tambahSaldo($this->session->userdata('email'), $this->session->userdata('pass'), $data)){
							$this->session->set_userdata('beli', 'mantap');
						}
						$data=array('nama'=>$this->session->userdata('nama'), 'portal'=>'jawa', 'saldo'=>$this->session->userdata('harga'), 'date'=>date('Y-m-d H:i:s', now()), 'ket'=>'Beli');
						$this->paws_model->tambahRiwayat($data, 'riwayat');
						redirect($_SERVER['HTTP_REFERER']);
					}
				}
				else if(isset($_POST["jawa2"])){
					$saldo=$this->paws_model->getSaldo($this->session->userdata('email'), $this->session->userdata('pass'));
					$harga=20000;
					$this->session->set_userdata('harga', $harga);
					$saldo=$saldo-$harga;
					if($saldo<0){
						$this->session->set_userdata('beli', 'kurang');
						redirect($_SERVER['HTTP_REFERER']);
					}
					else{
						$this->session->set_userdata('saldo', $saldo);
						$data=array('saldo'=>$saldo);
						if($this->paws_model->tambahSaldo($this->session->userdata('email'), $this->session->userdata('pass'), $data)){
							$this->session->set_userdata('beli', 'mantap');
						}
						$data=array('nama'=>$this->session->userdata('nama'), 'portal'=>'jawa', 'saldo'=>$this->session->userdata('harga'), 'date'=>date('Y-m-d H:i:s', now()), 'ket'=>'Beli');
						$this->paws_model->tambahRiwayat($data, 'riwayat');
						redirect($_SERVER['HTTP_REFERER']);
					}
				}
				else if(isset($_POST["jawa3"])){
					$saldo=$this->paws_model->getSaldo($this->session->userdata('email'), $this->session->userdata('pass'));
					$harga=50000;
					$this->session->set_userdata('harga', $harga);
					$saldo=$saldo-$harga;
					if($saldo<0){
						$this->session->set_userdata('beli', 'kurang');
						redirect($_SERVER['HTTP_REFERER']);
					}
					else{
						$this->session->set_userdata('saldo', $saldo);
						$data=array('saldo'=>$saldo);
						if($this->paws_model->tambahSaldo($this->session->userdata('email'), $this->session->userdata('pass'), $data)){
							$this->session->set_userdata('beli', 'mantap');
						}
						$data=array('nama'=>$this->session->userdata('nama'), 'portal'=>'jawa', 'saldo'=>$this->session->userdata('harga'), 'date'=>date('Y-m-d H:i:s', now()), 'ket'=>'Beli');
						$this->paws_model->tambahRiwayat($data, 'riwayat');
						redirect($_SERVER['HTTP_REFERER']);
					}
				}
				else if(isset($_POST["jawa4"])){
					$saldo=$this->paws_model->getSaldo($this->session->userdata('email'), $this->session->userdata('pass'));
					$harga=100000;
					$this->session->set_userdata('harga', $harga);
					$saldo=$saldo-$harga;
					if($saldo<0){
						$this->session->set_userdata('beli', 'kurang');
						redirect($_SERVER['HTTP_REFERER']);
					}
					else{
						$this->session->set_userdata('saldo', $saldo);
						$data=array('saldo'=>$saldo);
						if($this->paws_model->tambahSaldo($this->session->userdata('email'), $this->session->userdata('pass'), $data)){
							$this->session->set_userdata('beli', 'mantap');
						}
						$data=array('nama'=>$this->session->userdata('nama'), 'portal'=>'jawa', 'saldo'=>$this->session->userdata('harga'), 'date'=>date('Y-m-d H:i:s', now()), 'ket'=>'Beli');
						$this->paws_model->tambahRiwayat($data, 'riwayat');
						redirect($_SERVER['HTTP_REFERER']);
					}
				}
			}
		}
	}
?>