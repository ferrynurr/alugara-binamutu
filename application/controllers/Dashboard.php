<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	    function __construct() {
	        parent::__construct();

	        if($this->session->userdata('status') == null ) {
	           
	            redirect('auth');

	        }
			

			$this->load->model('m_dashboard','dash');
	
	    }

	    public function index() {

	    	$data = array(	'header_judul' => 'Dashboard',
	    					'jum_user' => $this->db->count_all('user'),
	    					'jum_upi' => $this->db->count_all('upi'),
	    					'jum_produk'=> $this->db->count_all('produk'),
	    					'jum_olahan' => $this->db->count_all('olahan'),
	    					'jum_akhabis' => $this->dash->count_akhabis(),
	    					'jum_habis' => $this->dash->count_habis(),
	    					'report'    => $this->dash->graph_report()
	    				);
						
            $this->load->view('v_dashboard', $data);

	    }



		public function ajax_pegawai()
			    	{
			    		$list = $this->pegawai->get_datatables();
			    		$data = array();
			    		$no = $_POST['start'];
			    		foreach ($list as $pegawai) {
			    			$no++;
			    			$row = array();

			        		$row[] = $no;
			    			$row[] = $pegawai->nippos;
			    			$row[] = $pegawai->nama;
			    			$row[] = $pegawai->alamat;
			                $row[] = $pegawai->ttl;
			    			$row[] = $pegawai->jkl;
			    			$row[] = $pegawai->status_pg;
				            $row[] = $pegawai->jabatan;
				            $row[] = $pegawai->no_hp;
				            $row[] = $pegawai->email;
			         // $row[] = $pegawai->foto;
			         if($pegawai->photo)
			 				$row[] = '<a href="'.base_url('upload/pegawai/'.$pegawai->photo).'" target="_blank"><img src="'.base_url('upload/pegawai/'.$pegawai->photo).'" class="img-responsive" /></a>';
			 			else
			 				$row[] = '(No photo)';

			    			//add html for action

			    			$data[] = $row;
			    		}

							$output = array(
											"draw" => $_POST['draw'],
											"recordsTotal" => $this->pegawai->count_all(),
											"recordsFiltered" => $this->pegawai->count_filtered(),
											"data" => $data,
									);
			    		//output to json format
			    		echo json_encode($output);
			    	}

			public function ajax_user()
								{
									$list = $this->user->get_datatables();
									$data = array();
									$no = $_POST['start'];
									foreach ($list as $user) {
										$no++;
										$row = array();

										$row[] = $no;
										$row[] = $user->nippos;
										$row[] = $user->username;
										$row[] = $user->password;
									 $row[] = $user->login_terakhir;
									 $row[] = $user->ip_address;
										$row[] = $user->level;


										//add html for action

										$data[] = $row;
									}

									$output = array(
													"draw" => $_POST['draw'],
													"recordsTotal" => $this->user->count_all(),
													"recordsFiltered" => $this->user->count_filtered(),
													"data" => $data,
											);
									//output to json format
									echo json_encode($output);
								}

				public function ajax_agen()
							    	{

							    		$list = $this->kantor->get_datatables();
							    		$data = array();
							    		$no = $_POST['start'];
							    		foreach ($list as $kantor) {
							    			$no++;
							    			$row = array();
							          $row[] = $no;
							    			$row[] = $kantor->nopen;
							    			$row[] = $kantor->nama_kantor;
							    			$row[] = $kantor->alamat;
							          $row[] = $kantor->email_kantor;
							          $row[] = $kantor->no_telp;
							          $row[] = $kantor->kode_pos;

							    			$data[] = $row;
							    		}

							    		$output = array(
							    						"draw" => $_POST['draw'],
							    						"recordsTotal" => $this->kantor->count_all(),
							    						"recordsFiltered" => $this->kantor->count_filtered(),
							    						"data" => $data,
							    				);
							    		//output to json format
							    		echo json_encode($output);
							}

			  public function ajax_kpc()
							    	{
							      $this->load->helper('url');

							    		$list = $this->kpc->get_datatables();
							    		$data = array();
							    		$no = $_POST['start'];
							    		foreach ($list as $kpc) {
							    			$no++;
							    			$row = array();

							          $row[] = $no;
							    			$row[] = $kpc->nopen;
							    			$row[] = $kpc->nama_pos;
							    			$row[] = $kpc->singkatan;
							          $row[] = $kpc->no_telp;
							    			$row[] = $kpc->no_hp;
							    			$row[] = $kpc->alamat;
							          $row[] = $kpc->kode_pos;
							          $row[] = $kpc->nama;


							    			$data[] = $row;
							    		}

							    		$output = array(
							    						"draw" => $_POST['draw'],
							    						"recordsTotal" => $this->kpc->count_all(),
							    						"recordsFiltered" => $this->kpc->count_filtered(),
							    						"data" => $data,
							    				);
							    		//output to json format
							    		echo json_encode($output);
							    	}

				  public function ajax_upload()
										    	{

										    		$list = $this->bagi->get_datatables();
										    		$data = array();
										    		$no = $_POST['start'];
										    		foreach ($list as $bagi) {
										    			$no++;
										    			$row = array();
										          $row[] = $no;
										        //  $row[] = $bagi->no;
										    			$row[] = $bagi->nama;
										          $row[] = $bagi->date;
										          $row[] = $bagi->hak_akses;

										          $row[] = $bagi->keterangan;

										          if($bagi->file){
										            $row[] = '<i>'. $bagi->file .'</i>';
										          }else{
										            $row[] = '(No File)';
										          }
										    			//add html for action

										    			$data[] = $row;
										    		}

										    		$output = array(
										    						"draw" => $_POST['draw'],
										    						"recordsTotal" => $this->bagi->count_all(),
										    						"recordsFiltered" => $this->bagi->count_filtered(),
										    						"data" => $data,
										    				);
										    		//output to json format
										    		echo json_encode($output);
										}
	}
