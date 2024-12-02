<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Master_customer extends Admin_Controller
{
	//Permission
	protected $viewPermission   = "Customers.View";
	protected $addPermission    = "Customers.Add";
	protected $managePermission = "Customers.Manage";
	protected $deletePermission = "Customers.Delete";

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array(
			'Master_customer/Customer_model',
			'Aktifitas/aktifitas_model',
		));
		$this->template->title('Customer');

		date_default_timezone_set("Asia/Bangkok");

		$this->id_user  = $this->auth->user_id();
		$this->datetime = date('Y-m-d H:i:s');
	}

	public function index()
	{
		$this->auth->restrict($this->viewPermission);
		$where = [
			'deleted_date' => NULL
		];
		$listData = $this->Customer_model->get_data($where);

		$data = [
			'result' =>  $listData
		];

		history("View data customer");
		$this->template->set($data);
		$this->template->title('Master Customer');
		$this->template->render('index');
	}

	public function add($id = null, $tanda = null)
	{
		if (empty($id)) {
			$this->auth->restrict($this->addPermission);
		} else {
			$this->auth->restrict($this->managePermission);
		}
		if ($this->input->post()) {
			$Arr_Kembali			= array();
			$data					= $this->input->post();
			$data_session			= $this->session->userdata;

			$Ymonth	= date('ym');

			if (empty($data['id_customer'])) {
				//Urutan Customer
				$qCust 			= "SELECT MAX(id_customer) AS maxP FROM master_customers WHERE kdcab='100' AND id_customer LIKE 'C100-" . $Ymonth . "%' ";
				$numRowCust		= $this->db->query($qCust)->num_rows();
				$resultPlant	= $this->db->query($qCust)->result_array();
				$angkaUrut2		= $resultPlant[0]['maxP'];
				$urutan2		= (int)substr($angkaUrut2, 9, 3);
				$urutan2++;
				$urut2			= sprintf('%03s', $urutan2);
				$kodeCust		= "C100-" . $Ymonth . $urut2;


				//Urutan PIC
				$qPIC 			= "SELECT MAX(id_pic) AS maxPC FROM customer_pic WHERE id_pic LIKE 'PIC-" . $Ymonth . "%' ";
				$resultPIC		= $this->db->query($qPIC)->result_array();
				$angkaUrut2x	= $resultPIC[0]['maxPC'];
				$urutan2x		= (int)substr($angkaUrut2x, 8, 3);
				$urutan2x++;
				$urut2x			= sprintf('%03s', $urutan2x);
				$kodePIC		= "PIC-" . $Ymonth . $urut2x;
			}

			if (!empty($data['id_customer'])) {
				//Check PIC
				$qCheckPIC		= "SELECT * FROM customer_pic WHERE hp = '" . $data['hp'] . "' ";
				$NumCheckPIC	= $this->db->query($qCheckPIC)->num_rows();
				$dataPIC		= $this->db->query($qCheckPIC)->result_array();

				if ($NumCheckPIC > 0) {
					$kodePIC		= $dataPIC[0]['id_pic'];
				}

				$kodeCust	= $data['id_customer'];
			}

			$ArrCust = array(
				'id_customer'		=> $kodeCust,
				'nm_customer' 		=> trim($data['nm_customer']),
				'kdcab' 			=> '100',
				'bidang_usaha' 		=> $data['bidang_usaha'],
				'produk_jual' 		=> ucwords(strtolower($data['produk_jual'])),
				'kredibilitas' 		=> $data['kredibilitas'],
				'alamat' 			=> ucwords($data['alamat']),
				'country_code' 		=> $data['country_code'],
				'provinsi' 			=> $data['provinsi'],
				'kota' 				=> $data['kota'],
				'kode_pos' 			=> $data['kode_pos'],
				'telpon' 			=> str_replace('-', '', $data['telpon']),
				'fax' 				=> str_replace('-', '', $data['fax']),
				'npwp' 				=> $data['npwp'],
				'alamat_npwp' 		=> $data['alamat_npwp'],
				'ktp' 				=> "",
				'alamat_ktp' 		=> "",
				'sts_aktif' 		=> $data['sts_aktif'],
				'id_marketing' 		=> $data['id_marketing'],
				'id_pic' 			=> $kodePIC,
				'referensi' 		=> ucwords(strtolower($data['reference_by'])),
				'website' 			=> $data['website'],
				'foto' 				=> "",
				'diskon_toko' 		=> $data['diskon_toko'],
				'created_on' 		=> $this->datetime,
				'created_by' 		=> $this->id_user
			);

			$ArrPICUpdate	= array(
				'id_pic' 			=> $kodePIC,
				'nm_pic' 			=> ucwords(strtolower($data['nm_pic'])),
				'divisi' 			=> strtolower($data['divisi']),
				'jabatan' 			=> NULL,
				'hp' 				=> str_replace('-', '', $data['hp']),
				'email_pic' 		=> trim(strtolower($data['email_pic'])),
				'customer_id'		=> $kodeCust,
				'modified_on' 		=> $this->datetime,
				'modified_by' 		=> $this->id_user
			);

			$this->db->trans_start();
			if (empty($data['id_customer'])) {
				$this->db->insert('master_customers', $ArrCust);
			} else {
				$this->db->where('id_customer', $kodeCust);
				$this->db->update('master_customers', $ArrCust);
			}

			if (empty($data['id_customer'])) {
				$this->db->insert('customer_pic', $ArrPICUpdate);
			} else {
				$this->db->where('customer_id', $kodeCust);
				$this->db->update('customer_pic', $ArrPICUpdate);
			}

			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				$Arr_Kembali	= array(
					'pesan'		=> 'Process data failed. Please try again later ...',
					'status'	=> 2
				);
			} else {
				$this->db->trans_commit();
				$Arr_Kembali	= array(
					'pesan'		=> 'Process data Success. Thank you & have a nice day ...',
					'status'	=> 1
				);
				history('Add/Edit Customer ' . $kodeCust);
			}
			
			echo json_encode($Arr_Kembali);
		} else {

			$det_Province	= $this->db->order_by('id_prov')->get_where('provinsii', array('country_code' => 'IDN'))->result_array();
			$det_Bidang		= $this->db->order_by('bidang_usaha')->get_where('bidang_usaha', array('deleted' => 'N'))->result_array();
			$restContry		= $this->db->order_by('country_name', 'asc')->get('country')->result_array();
			$restMkt		= $this->db->order_by('nm_karyawan')->get_where('ms_employee', array('department' => 1))->result_array();
			$restHeader		= $this->db->get_where('master_customers', array('id_customer' => $id))->result_array();
			$restReff		= $this->db->order_by('id_reff', 'desc')->limit(1)->get_where('customer_referensi', array('id_customer' => $id))->result_array();

			$id_pic 		= (!empty($restHeader[0]['id_pic'])) ? $restHeader[0]['id_pic'] : 'X';
			$restPIC		= $this->db->get_where('customer_pic', array('id_pic' => $id_pic))->result_array();
			$restAddress	= $this->db->get_where('customer_address_invoice', array('id_customer' => $id, 'deleted_date' => NULL))->result_array();

			$data = [
				'restHeader' =>  $restHeader,
				'restReff' =>  $restReff,
				'restPIC' =>  $restPIC,
				'restAddress' =>  $restAddress,
				'rows_province' =>  $det_Province,
				'rows_marketing' =>  $restMkt,
				'CountryName' =>  $restContry,
				'rows_bidang' =>  $det_Bidang,
				'tanda' =>  $tanda,
			];

			$this->template->set($data);
			$this->template->title('Add Customer');
			$this->template->render('add');
		}
	}

	public function savePIC()
	{
		$data = $this->input->post();
		$customerId = $data['customer_id'];

		$this->db->trans_start();

		foreach ($data['nm_pic']['form'] AS $key => $value) {
			if (isset($data['id_pic']['form'][$key])) {
				$customerPIC = $this->db->query("SELECT * FROM customer_pic WHERE id_pic = '" . $data['id_pic']['form'][$key] . "'")->row();

				if (!empty($customerPIC)) {
					$dataUpdate = [
						// 'id_pic' 			=> $kodePIC,
						'nm_pic' 			=> ucwords(strtolower($value)),
						'divisi' 			=> strtolower($data['divisi']['form'][$key]),
						'jabatan' 			=> NULL,
						'hp' 				=> str_replace('-', '', $data['hp']['form'][$key]),
						'email_pic' 		=> trim(strtolower($data['email_pic']['form'][$key])),
						'customer_id'		=> $customerId,
						'modified_on' 		=> $this->datetime,
						'modified_by' 		=> $this->id_user
					];
	
					$this->db->where('id_pic', $customerPIC->id_pic);
					$this->db->update('customer_pic', $dataUpdate);
				}
			} else {
				$Ymonth	= date('ym');

				$qPIC 			= "SELECT MAX(id_pic) AS maxPC FROM customer_pic WHERE id_pic LIKE 'PIC-" . $Ymonth . "%' ";
				$resultPIC		= $this->db->query($qPIC)->result_array();
				$angkaUrut2x	= $resultPIC[0]['maxPC'];
				$urutan2x		= (int)substr($angkaUrut2x, 8, 3);
				$urutan2x++;
				$urut2x			= sprintf('%03s', $urutan2x);
				$kodePIC		= "PIC-" . $Ymonth . $urut2x;

				$dataInsert = [
					'id_pic' 			=> $kodePIC,
					'nm_pic' 			=> ucwords(strtolower($value)),
					'divisi' 			=> strtolower($data['divisi']['form'][$key]),
					'jabatan' 			=> NULL,
					'hp' 				=> str_replace('-', '', $data['hp']['form'][$key]),
					'email_pic' 		=> trim(strtolower($data['email_pic']['form'][$key])),
					'customer_id'		=> $customerId,
					'modified_on' 		=> $this->datetime,
					'modified_by' 		=> $this->id_user
				];

				$this->db->insert('customer_pic', $dataInsert);
			}
		}

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$data	= array(
				'code'		=> 404,
				'pesan'		=> 'Process data failed. Please try again later ...',
				'status'	=> 'NOK'
			);
		} else {
			$this->db->trans_commit();
			$data	= array(
				'code'		=> 200,
				'pesan'		=> 'Process data Success. Thank you & have a nice day ...',
				'status'	=> 'OK'
			);
		}

		return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function getFormPIC()
	{
		$idCustomer = $this->input->post("idcustomer");

		if (!empty($idCustomer)) {
			$dataPIC = $this->db->query("SELECT * FROM customer_pic WHERE customer_id = '$idCustomer'")->result();

			$dataPIC = [
				'dataPIC' => $dataPIC
			];

			$form = $this->template->render('addpic', $dataPIC);

			$data = [
				'code' => 200,
				'form' => $form
			];
		} else {
			$data = [
				'code' => 200,
				'form' => $this->template->render('addpic')
			];
		}

		return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function getDistrict()
	{
		$id_Dist 	= $this->input->post('id_prov');
		$sqlDist	= "SELECT * FROM kabupaten WHERE id_prov='" . $id_Dist . "' ORDER BY nama ASC";
		$restDist	= $this->db->query($sqlDist)->result_array();

		$option	= "<option value='0'>Select An District</option>";
		foreach ($restDist as $val => $valx) {
			$option .= "<option value='" . $valx['id_kab'] . "'>" . $valx['nama'] . "</option>";
		}
		if (COUNT($restDist)) {
			$option .= "<option value=''>Data is empty, skip this input</option>";
		}

		$ArrJson	= array(
			'option' => $option
		);
		echo json_encode($ArrJson);
	}

	public function delete()
	{
		$this->auth->restrict($this->deletePermission);

		$id = $this->input->post('id');
		$data = [
			'deleted_by' 	  => $this->id_user,
			'deleted_date' 	=> $this->datetime
		];

		$this->db->trans_begin();
		$this->db->where('id_customer', $id)->update("master_customers", $data);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$status	= array(
				'pesan'		=> 'Failed process data!',
				'status'	=> 0
			);
		} else {
			$this->db->trans_commit();
			$status	= array(
				'pesan'		=> 'Success process data!',
				'status'	=> 1
			);
			history("Delete customer master : " . $id);
		}
		echo json_encode($status);
	}
}
