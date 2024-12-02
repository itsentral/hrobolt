<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * @author Yunas Handra
 * @copyright Copyright (c) 2018, Yunas Handra
 *
 * This is model class for table "Customer"
 */

class Jurnal_model extends CI_Model
{


    /**
     * Function construct used to load some library, do some actions, etc.
     */
    public function __construct()
    {
        parent::__construct();
    }

	public function get_coa_Bank_Cabang($Cabang)
	{
		//$db2=$this->load->database('accounting', TRUE);
		//TEST CABANG
		//$Cabang		= '102';
		$Arr_coa	= $det_coa	= array();
		$Bulan_Now	= date('n');
		$Tahun_Now	= date('Y');
		$Bulan_Lalu	= 1;
		$Tahun_Lalu	= $Tahun_Now;
		if($Bulan_Now == 1){
		  $Bulan_Lalu	= 12;
		  $Tahun_Lalu	= $Tahun_Now - 1;
		}
		$Kode_Cab		= 'A';
		$Query_Cabang	= $this->db->get_where(DBACC.'.pastibisa_tb_cabang',array('nocab'=>$Cabang))->result();
		if($Query_Cabang){
		  $Kode_Cab	= $Query_Cabang[0]->subcab;
		}
		$Cab_Kode		= $Cabang.'-'.$Kode_Cab;
		$Query_coa	= "SELECT * FROM ".DBACC.".coa WHERE bln='$Bulan_Now' AND thn='$Tahun_Now' AND `level`='5' AND SUBSTRING(no_perkiraan,1,4) IN ('1103','1102','1101') AND kdcab='$Cab_Kode'";
		$Pros_coa		= $this->db->query($Query_coa);
		$Num_coa		= $Pros_coa->num_rows();
		if($Num_coa > 0){
		   $det_coa	= $Pros_coa->result();
		}else{
		   $Query_coa	= "SELECT * FROM ".DBACC.".coa WHERE bln='$Bulan_Lalu' AND thn='$Tahun_Lalu' AND `level`='5' AND SUBSTRING(no_perkiraan,1,4) IN ('1103','1102','1101') AND kdcab='$Cab_Kode'";
		  $Pros_coa		= $this->db->query($Query_coa);
		  $Num_coa		= $Pros_coa->num_rows();
		  if($Num_coa > 0){
			  $det_coa	= $Pros_coa->result();
		  }
		}
		if($det_coa){
			foreach($det_coa as $key=>$vals){
				$Name_coa		= $vals->nama;
				$Kode_coa		= $vals->no_perkiraan;
				$Arr_coa[$Kode_coa]	= $Name_coa;
			}
		}

		return $Arr_coa;
	}
	
	public function get_Coa_Bank_Aja($Cabang)
	{
		//$db2=$this->load->database('accounting', TRUE);
		//TEST CABANG
		//$Cabang		= '102';
		$Arr_Coa	= $det_COA	= array();
		$Bulan_Now	= date('n');
		$Tahun_Now	= date('Y');
		$Bulan_Lalu	= 1;
		$Tahun_Lalu	= $Tahun_Now;
		if($Bulan_Now == 1){
		  $Bulan_Lalu	= 12;
		  $Tahun_Lalu	= $Tahun_Now - 1;
		}
		$Kode_Cab		= 'A';
		$Query_Cabang	= $this->db->get_where(DBACC.'.pastibisa_tb_cabang',array('nocab'=>$Cabang))->result();
		if($Query_Cabang){
		  $Kode_Cab	= $Query_Cabang[0]->subcab;
		}
		$Cab_Kode		= $Cabang.'-'.$Kode_Cab;

		$sqladd=" AND `level`='5' AND SUBSTRING(no_perkiraan,1,7) IN ('1102-01') AND kdcab='$Cab_Kode'";
		$Query_Coa	= "SELECT * FROM ".DBACC.".coa WHERE bln='$Bulan_Now' AND thn='$Tahun_Now' ".$sqladd;
		$Pros_Coa		= $this->db->query($Query_Coa);
		$Num_Coa		= $Pros_Coa->num_rows();
		if($Num_Coa > 0){
		   $det_coa	= $Pros_Coa->result();
		}else{ 
		   $Query_Coa	= "SELECT * FROM ".DBACC.".coa WHERE bln='$Bulan_Lalu' AND thn='$Tahun_Lalu' ".$sqladd;
		  $Pros_Coa		= $this->db->query($Query_Coa);
		  $Num_Coa		= $Pros_Coa->num_rows();
		  if($Num_Coa > 0){
			  $det_coa	= $Pros_Coa->result();
		  }
		}
		if($det_coa){
			foreach($det_coa as $key=>$vals){
				$Name_Coa		= $vals->nama;
				$Kode_Coa		= $vals->no_perkiraan;
				$Arr_Coa[$Kode_Coa]	= $Name_Coa;
			}
		}

		return $Arr_Coa;
	}
	
	
	public function get_coa_Pph_Cabang($Cabang)
	{
		//$db2=$this->load->database('accounting', TRUE);
		//TEST CABANG
		//$Cabang		= '102';
		$Arr_coa	= $det_coa	= array();
		$Bulan_Now	= date('n');
		$Tahun_Now	= date('Y');
		$Bulan_Lalu	= 1;
		$Tahun_Lalu	= $Tahun_Now;
		if($Bulan_Now == 1){
		  $Bulan_Lalu	= 12;
		  $Tahun_Lalu	= $Tahun_Now - 1;
		}
		$Kode_Cab		= 'A';
		$Query_Cabang	= $this->db->get_where(DBACC.'.pastibisa_tb_cabang',array('nocab'=>$Cabang))->result();
		if($Query_Cabang){
		  $Kode_Cab	= $Query_Cabang[0]->subcab;
		}
		$Cab_Kode		= $Cabang.'-'.$Kode_Cab;
		$Query_coa	= "SELECT * FROM ".DBACC.".coa WHERE bln='$Bulan_Now' AND thn='$Tahun_Now' AND `level`='5' AND SUBSTRING(no_perkiraan,1,4) IN ('1105','2106') AND kdcab='$Cab_Kode'";
		$Pros_coa		= $this->db->query($Query_coa);
		$Num_coa		= $Pros_coa->num_rows();
		if($Num_coa > 0){
		   $det_coa	= $Pros_coa->result();
		}else{
		   $Query_coa	= "SELECT * FROM ".DBACC.".coa WHERE bln='$Bulan_Lalu' AND thn='$Tahun_Lalu' AND `level`='5' AND SUBSTRING(no_perkiraan,1,4) IN ('1105','2106') AND kdcab='$Cab_Kode'";
		  $Pros_coa		= $this->db->query($Query_coa);
		  $Num_coa		= $Pros_coa->num_rows();
		  if($Num_coa > 0){
			  $det_coa	= $Pros_coa->result();
		  }
		}
		if($det_coa){
			foreach($det_coa as $key=>$vals){
				$Name_coa		= $vals->nama;
				$Kode_coa		= $vals->no_perkiraan;
				$Arr_coa[$Kode_coa]	= $Name_coa;
			}
		}

		return $Arr_coa;
	}

	function get_Nomor_Jurnal_Pembelian($Cabang='',$Tgl_Inv=''){
		$nocab			= 'A';
		$bulan_Proses	= date('Y',strtotime($Tgl_Inv));
		$Urut			= 1;
		$Query_Cab		= "SELECT subcab,nomorJP FROM gl_prisma.pastibisa_tb_cabang WHERE nocab='".$Cabang."'";
		$Pros_Cab		= $db2->query($Query_Cab);
		$det_Cab		= $Pros_Cab->result_array();
		if($det_Cab){
			$nocab		= $det_Cab[0]['subcab'];
			$Urut		= intval($det_Cab[0]['nomorJP']) + 1;
		}
		$Format			= $Cabang.'-'.$nocab.'-JP'.date('y',strtotime($Tgl_Inv));

		$Nomor_JP		= $Format.str_pad($Urut, 5, "0", STR_PAD_LEFT);

		return $Nomor_JP;
	}

	function get_Nomor_Jurnal_Sales($Cabang='',$Tgl_Inv=''){
		// $db2 = $this->load->database('accounting', TRUE);
		$nocab			= 'A';
		$bulan_Proses	= date('Y',strtotime($Tgl_Inv));
		$Urut			= 1;
		$Query_Cab		= "SELECT subcab,nomorJC FROM ".DBACC.".pastibisa_tb_cabang WHERE nocab='".$Cabang."'";
		$Pros_Cab		= $this->db->query($Query_Cab);
		$det_Cab		= $Pros_Cab->result_array();
		if($det_Cab){
			$nocab		= $det_Cab[0]['subcab'];
			$Urut		= intval($det_Cab[0]['nomorJC']) + 1;
		}
		$Format			= $Cabang.'-'.$nocab.'JV'.date('y',strtotime($Tgl_Inv));

		$Nomor_JS		= $Format.str_pad($Urut, 5, "0", STR_PAD_LEFT);

		return $Nomor_JS;
	}


	function get_Nomor_Jurnal_Sales_close($Cabang='',$Tgl_Inv=''){
		$db2 = $this->load->database('accounting', TRUE);
		$nocab			= 'A';
		$bulan_Proses	= date('Y',strtotime($Tgl_Inv));
		$Urut			= 1;
		$Query_Cab		= "SELECT subcab,nomorJC FROM gl_prisma.pastibisa_tb_cabang WHERE nocab='".$Cabang."'";
		$Pros_Cab		= $db2->query($Query_Cab);
		$det_Cab		= $Pros_Cab->result_array();
		if($det_Cab){
			$nocab		= $det_Cab[0]['subcab'];
			$Urut		= intval($det_Cab[0]['nomorJC']) + 1;
		}
		$Format			= $Cabang.'-'.$nocab.'JV'.date('y',strtotime($Tgl_Inv));

		$Nomor_JS		= $Format.str_pad($Urut, 5, "0", STR_PAD_LEFT);

		return $Nomor_JS;
	}


	function get_Nomor_Jurnal_Memorial($Cabang='',$Tgl_Inv=''){
		$db2 = $this->load->database('accounting', TRUE);
		$nocab			= 'A';
		$bulan_Proses	= date('Y',strtotime($Tgl_Inv));
		$Urut			= 1;
		$Query_Cab		= "SELECT subcab,nomorJM FROM pastibisa_tb_cabang WHERE nocab='".$Cabang."'";
		$Pros_Cab		= $db2->query($Query_Cab);
		$det_Cab		= $Pros_Cab->result_array();
		if($det_Cab){
			$nocab		= $det_Cab[0]['subcab'];
			$Urut		= intval($det_Cab[0]['nomorJM']) + 1;
		}
		$Format			= $Cabang.'-'.$nocab.'-JM'.date('y',strtotime($Tgl_Inv));

		$Nomor_JM		= $Format.str_pad($Urut, 5, "0", STR_PAD_LEFT);

		return $Nomor_JM;
	}

	function get_Nomor_Jurnal_BUK($Cabang='',$Tgl_Inv='',$tipe='KAS'){
		$nocab			= 'A';
		$kdcab			= 'YOG';
		$prefix			= '';
		$bulan_Proses	= date('Y',strtotime($Tgl_Inv));
		$Urut			= 1;
		$Query_Cab		= "SELECT kdcab,subcab FROM pastibisa_tb_cabang WHERE nocab='".$Cabang."'";
		$Pros_Cab		= $db2->query($Query_Cab);
		$det_Cab		= $Pros_Cab->result_array();
		if($det_Cab){
			$nocab		= $det_Cab[0]['subcab'];
			$kdcab		= $det_Cab[0]['kdcab'];
		}
		$Query_Kode		= "SELECT prefik,nobuk FROM konter_bumbuk WHERE kdcab='$kdcab' AND LOWER(kasbank)='".strtolower($tipe)."'";
		$Pros_Kode		= $db2->query($Query_Kode);
		$det_Kode		= $Pros_Kode->result_array();
		if($det_Kode){
			$prefix		= $det_Kode[0]['prefik'];
			$Urut		= intval($det_Kode[0]['nobuk']) + 1;
		}
		$Format			= $Cabang.'BK'.$prefix.date('y',strtotime($Tgl_Inv));

		$Nomor_BUK		= $Format.str_pad($Urut, 5, "0", STR_PAD_LEFT);

		return $Nomor_BUK;
	}

	function get_Nomor_Jurnal_BUM($Cabang='',$Tgl_Inv=''){
		$nocab			= 'A';
		$bulan_Proses	= date('Y',strtotime($Tgl_Inv));
		$Urut			= 1;
		$Query_Cab		= "SELECT subcab,nobum FROM ".DBACC.".pastibisa_tb_cabang WHERE nocab='".$Cabang."'";
		$Pros_Cab		= $this->db->query($Query_Cab);
		$det_Cab		= $Pros_Cab->result_array();
		if($det_Cab){
			$nocab		= $det_Cab[0]['subcab'];
			$Urut		= intval($det_Cab[0]['nobum']) + 1;
		}
		$Format			= $Cabang.'BM'.date('y',strtotime($Tgl_Inv));

		$Nomor_BUM		= $Format.str_pad($Urut, 5, "0", STR_PAD_LEFT);

		return $Nomor_BUM;
	}

	function update_Nomor_Jurnal($Cabang='',$tipe='BUM'){
		$db2 = $this->load->database('accounting', TRUE);
		if(strtolower($tipe)=='bum'){
			$fields		= "nobum";
		}else if(strtolower($tipe)=='jp'){
			$fields		= "noJP";
		}else if(strtolower($tipe)=='jm'){
			$fields		= "noJM";
		}else if(strtolower($tipe)=='js'){
			$fields		= "noJS";
		}

		$nocab			= 'A';

		$Urut			= 1;
		$Query_Cab		= "UPDATE pastibisa_tb_cabang SET ".$fields."=".$fields." + 1 WHERE nocab='".$Cabang."'";
		$Pros_Cab		= $db2->query($Query_Cab);

	}

	function update_Nomor_Jurnal_BUK($Cabang='',$tipe='KAS'){
		$Query_Cab		= "SELECT kdcab,subcab FROM pastibisa_tb_cabang WHERE nocab='".$Cabang."'";
		$Pros_Cab		= $db2->query($Query_Cab);
		$det_Cab		= $Pros_Cab->result_array();
		if($det_Cab){
			$kdcab		= $det_Cab[0]['kdcab'];
		}
		$Query_Kode		= "UPDATE konter_bumbuk SET nobuk=nobuk + 1 WHERE kdcab='$kdcab' AND LOWER(kasbank)='".strtolower($tipe)."'";
		$Pros_Kode		= $db2->query($Query_Kode);

	}

	function get_coa_Piutang($Cabang){
		$accid			= '1104-01-01';
		$Urut			= 1;
		$Query_Cab		= "SELECT * FROM pastibisa_tb_cabang WHERE nocab='".$Cabang."'";
		$Pros_Cab		= $db2->query($Query_Cab);
		$det_Cabang		= $Pros_Cab->result_array();
		if($det_Cabang){
			$accid		= $det_Cabang[0]['coa_piutang_ho'];
		}
		return $accid;
	}

	function proses_calc_piutang($kode_Inv='',$kode_Reff='',$tgl_Proses='',$Jumlah=0){
		$Bulan_Now		= date('n');
		$Tahun_Now		= date('Y');
		$Bulan_Proses	= date('n',strtotime($tgl_Proses));
		$Tahun_Proses	= date('Y',strtotime($tgl_Proses));
		$det_Data		= $db2->get_where('pembayaran_piutang',array('kd_pembayaran'=>$kode_Reff,'no_invoice'=>$kode_Inv))->result();

		$Selisih		= (($Tahun_Now - $Tahun_Proses) * 12) + ($Bulan_Now - $Bulan_Proses);

		if($Selisih > 0){
			if($Jumlah > 0){
				$Nominal		= $Jumlah;
				$Ambil_AR		= $db2->get_where('ar',array('bln'=>$Bulan_Proses,'thn'=>$Tahun_Proses,'no_invoice'=>$kode_Inv,'kdcab'=>$det_Data[0]->kdcab))->result();
				$Saldo_Awal		= $Ambil_AR[0]->saldo_akhir;
				$Debet			= $Kredit = $Saldo_Akhir	= 0;
				for($x=1;$x<=$Selisih;$x++){
					$Bulan_Next		= date('n',mktime(0,0,0,$Bulan_Proses + $x,1,$Tahun_Proses));
					$Tahun_Next		= date('Y',mktime(0,0,0,$Bulan_Proses + $x,1,$Tahun_Proses));
					$Pros_Cek_Data	= $db2->get_where('ar',array('bln'=>$Bulan_Next,'thn'=>$Tahun_Next,'no_invoice'=>$kode_Inv,'kdcab'=>$det_Data[0]->kdcab));
					$Num_Cek		= $Pros_Cek_Data->num_rows();
					//echo"<br> masuk data : ".$Num_Cek."<br>";
					if($Num_Cek > 0){
						$det_Cek_Data	= $Pros_Cek_Data->result();
						$Debet			= ($det_Cek_Data[0]->debet > 0)?$det_Cek_Data[0]->debet:0;
						$Kredit			= ($det_Cek_Data[0]->kredit > 0)?$det_Cek_Data[0]->kredit:0;
						$Saldo_Akhir	= $Saldo_Awal + $Debet - $Kredit;
						if($Debet > 0 || $Kredit > 0){
							$Query_Proses	= "UPDATE ar SET saldo_awal='$Saldo_Awal',debet='$Debet',kredit='$Kredit',saldo_akhir='$Saldo_Akhir' WHERE no_invoice='$kode_Inv' AND kdcab='".$det_Data[0]->kdcab."' AND bln='$Bulan_Next' AND thn='$Tahun_Next'";
						}else{
							if($Saldo_Awal==0){
								$Query_Proses	= "DELETE FROM ar WHERE no_invoice='$kode_Inv' AND kdcab='".$det_Data[0]->kdcab."' AND bln='$Bulan_Next' AND thn='$Tahun_Next'";
							}else{
								$Query_Proses	= "UPDATE ar SET saldo_awal='$Saldo_Awal',debet='$Debet',kredit='$Kredit',saldo_akhir='$Saldo_Akhir' WHERE no_invoice='$kode_Inv' AND kdcab='".$det_Data[0]->kdcab."' AND bln='$Bulan_Next' AND thn='$Tahun_Next'";
							}
						}


					}else{
						if($Saldo_Awal !=0){
							$Debet			= 0;
							$Kredit			= 0;
							$Saldo_Akhir	= $Saldo_Awal + $Debet - $Kredit;
							$Query_Proses	= "INSERT INTO ar (
													no_invoice,
													tgl_invoice,
													no_so,
													tgl_terima_invoice,
													tgl_jatuh_tempo,
													customer_code,
													customer,
													bln,
													thn,
													saldo_awal,
													debet,
													kredit,
													saldo_akhir,
													kdcab
												)
												VALUES
													(
														'".$kode_Inv."',
														'".$Ambil_AR[0]->tgl_invoice."',
														'".$Ambil_AR[0]->no_so."',
														'".$Ambil_AR[0]->tgl_terima_invoice."',
														'".$Ambil_AR[0]->tgl_jatuh_tempo."',
														'".$Ambil_AR[0]->customer_code."',
														'".$Ambil_AR[0]->customer."',
														'$Bulan_Next',
														'$Tahun_Next',
														'$Saldo_Awal',
														'$Debet',
														'$Kredit',
														'$Saldo_Akhir',
														'".$det_Data[0]->kdcab."'
													)";
						}
					}
					//echo"<br> Qry : ".$Query_Proses;
					$Proses_Piutang	= $db2->query($Query_Proses);
					$Saldo_Awal		= $Saldo_Akhir;
				}
			}else{
				$Nominal		= abs($Jumlah);
				$Query_JARH 	= "SELECT * FROM jarh WHERE kd_pembayaran='$kode_Reff'";
				$det_JARH		= $db2->get_where('jarh',array('kd_pembayaran'=>$kode_Reff))->result();
				if($det_JARH){
					$Kode_Jurnal	= $det_JARH[0]->nomor;
					$Upd_Jurnal		= "UPDATE jurnal SET debet=0,kredit=0 WHERE nomor='$Kode_Jurnal' AND tipe='BUM'";
					$Pros_Jurnal	= $db2->query($Upd_Jurnal);

					$Update_JARH	= "Update jarh SET jml=0,batal=1 WHERE nomor='$Kode_Jurnal'";
					$Pros_JARH		= $db2->query($Update_JARH);
				}
				$Ambil_AR		= $db2->get_where('ar',array('bln'=>$Bulan_Proses,'thn'=>$Tahun_Proses,'no_invoice'=>$kode_Inv,'kdcab'=>$det_Data[0]->kdcab))->result();
				$Update_AR		= "UPDATE ar SET kredit=kredit - $Nominal,  saldo_akhir=saldo_akhir + $Nominal WHERE no_invoice='$kode_Inv' AND kdcab='".$det_Data[0]->kdcab."' AND bln='$Bulan_Proses' AND thn='$Tahun_Proses'";
				$Pros_Upd_AR	= $db2->query($Update_AR);
				$Saldo_Awal		= $Ambil_AR[0]->saldo_akhir + $Nominal;
				$Debet			= $Kredit = $Saldo_Akhir	= 0;
				for($x=1;$x<=$Selisih;$x++){
					$Bulan_Next		= date('n',mktime(0,0,0,$Bulan_Proses + $x,1,$Tahun_Proses));
					$Tahun_Next		= date('Y',mktime(0,0,0,$Bulan_Proses + $x,1,$Tahun_Proses));
					$Pros_Cek_Data	= $db2->get_where('ar',array('bln'=>$Bulan_Next,'thn'=>$Tahun_Next,'no_invoice'=>$kode_Inv,'kdcab'=>$det_Data[0]->kdcab));
					$Num_Cek		= $Pros_Cek_Data->num_rows();
					if($Num_Cek > 0){
						$det_Cek_Data	= $Pros_Cek_Data->result();
						$Debet			= $det_Cek_Data[0]->debet;
						$Kredit			= $det_Cek_Data[0]->kredit;
						$Saldo_Akhir	= $Saldo_Awal + $Debet - $Kredit;
						$Query_Proses	= "UPDATE ar SET saldo_awal='$Saldo_Awal',debet='$Debet',kredit='$Kredit',saldo_akhir='$Saldo_Akhir' WHERE no_invoice='$kode_Inv' AND kdcab='".$det_Data[0]->kdcab."' AND bln='$Bulan_Next' AND thn='$Tahun_Next'";
					}else{
						if($Saldo_Awal !=0){
							$Debet			= 0;
							$Kredit			= 0;
							$Saldo_Akhir	= $Saldo_Awal + $Debet - $Kredit;
							$Query_Proses	= "INSERT INTO ar (
													no_invoice,
													tgl_invoice,
													no_so,
													tgl_terima_invoice,
													tgl_jatuh_tempo,
													customer_code,
													customer,
													bln,
													thn,
													saldo_awal,
													debet,
													kredit,
													saldo_akhir,
													kdcab
												)
												VALUES
													(
														'".$kode_Inv."',
														'".$Ambil_AR[0]->tgl_invoice."',
														'".$Ambil_AR[0]->no_so."',
														'".$Ambil_AR[0]->tgl_terima_invoice."',
														'".$Ambil_AR[0]->tgl_jatuh_tempo."',
														'".$Ambil_AR[0]->customer_code."',
														'".$Ambil_AR[0]->customer."',
														'$Bulan_Next',
														'$Tahun_Next',
														'$Saldo_Awal',
														'$Debet',
														'$Kredit',
														'$Saldo_Akhir',
														'".$det_Data[0]->kdcab."'
													)";
						}
					}
					echo"<br>".$Query_Proses."<br>"; exit;
					$Proses_Piutang	= $db2->query($Query_Proses);
					$Saldo_Awal		= $Saldo_Akhir;
				}


			}
		}else{

			//echo "<br> masuk bro".$Selisih." Tahun ".$Tahun_Now." - ".$Tahun_Proses." Bulan : ".$Bulan_Now." - ".$Bulan_Proses." = ".$Jumlah;exit;

			if($Jumlah < 0){
				$Nominal		= abs($Jumlah);
				$Query_JARH 	= "SELECT * FROM jarh WHERE kd_pembayaran='$kode_Reff'";
				$det_JARH		= $db2->get_where('jarh',array('kd_pembayaran'=>$kode_Reff))->result();
				if($det_JARH){
					$Kode_Jurnal	= $det_JARH[0]->nomor;
					$Upd_Jurnal		= "UPDATE jurnal SET debet=0,kredit=0 WHERE nomor='$Kode_Jurnal' AND tipe='BUM'";
					$Pros_Jurnal	= $db2->query($Upd_Jurnal);

					$Update_JARH	= "Update jarh SET jml=0,batal=1 WHERE nomor='$Kode_Jurnal'";
					$Pros_JARH		= $db2->query($Update_JARH);
				}

				$Update_AR		= "UPDATE ar SET kredit=kredit - $Nominal,  saldo_akhir=saldo_akhir + $Nominal WHERE no_invoice='$kode_Inv' AND kdcab='".$det_Data[0]->kdcab."' AND bln='$Bulan_Proses' AND thn='$Tahun_Proses'";
				$Pros_Upd_AR	= $db2->query($Update_AR);

			}
		}


	}

	public function get_no_buk($cabang) //modelnya
	{
		//$db2=$this->load->database('accounting', TRUE);
		//$no_cab		= '101';
		$ambil 	= "SELECT nocab,subcab,nobuk from ".DBACC.".pastibisa_tb_cabang where nocab='$cabang' order by id";
		$q 		= $this->db->query($ambil);

		if ($q->num_rows() > 0) {
			$ret =  $q->result();
			$kd_cab = $ret[0]->nocab;
			$min = "B";
			$sub_cab = "K";

			$kdadd			= "";
			$kd_buk		= $ret[0]->nobuk + 1;
			if (strlen($kd_buk) == 1) {
				$kdadd		= "0000";
			} else if (strlen($kd_buk) == 2) {
				$kdadd		= "000";
			} else if (strlen($kd_buk) == 3) {
				$kdadd		= "00";
			} else if (strlen($kd_buk) == 4) {
				$kdadd		= "0";
			} else {
				$kdadd		= '0';
			}
			$thn			= date("y");

			$id = $kd_cab . $min . $sub_cab . $thn . $kdadd . $kd_buk;
			//$kodebuk = $qkd_cbg.$id;
			return $id;
		} else {
			return Null;
		}
	}

	public function get_detail_jurnal($filter_noreff,$tipe,$jenis)
	{
		$kode_cabang = $this->session->userdata('kode_cabang');
		$query 	= "SELECT jurnal.*, jurnal.no_perkiraan, coa_master.nama
		FROM jurnal
		INNER JOIN ".DBACC.".coa_master ON coa_master.no_perkiraan=jurnal.no_perkiraan
		WHERE jurnal.no_reff = '$filter_noreff'
		AND jurnal.tipe = '$tipe'
		AND jurnal.jenis_jurnal = '$jenis'
		AND jurnal.stspos !=1
		ORDER BY jurnal.debet DESC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	
	function generate_noinv($tgl){
      $arr_tgl = array(1=>'A',2=>'B',3=>'C',4=>'D',5=>'E',6=>'F',
                       7=>'G',8=>'H',9=>'I',10=>'J',11=>'K',12=>'L'
                      );
      $bln_now = date('m',strtotime($tgl));
      $kode_bln = '';
      foreach($arr_tgl as $k=>$v){
          if($k == $bln_now){
              $kode_bln = $v;
          }
      }
      $cek ='CON-'.date('y').$kode_bln;
      /*$query_cek = $this->db->query("SELECT MAX(no_so) as max_id FROM trans_so_header
      WHERE no_so LIKE '%$cek%'")->num_rows();*/
      $this->db->select("MAX(no_invoice) as max_id");
      $this->db->like('no_invoice', $cek);
      $this->db->from('tr_konfirm_do');
      $query_cek = $this->db->count_all_results();
      if ($query_cek == 0) {
        $kode = 1;
        $next_kode = str_pad($kode, 5, "0", STR_PAD_LEFT);
        $fin ='CON-'.date('y').$kode_bln.$next_kode;
      }else {
        $query = "SELECT MAX(no_invoice) as max_id
        FROM
        tr_konfirm_do WHERE no_invoice LIKE '%$cek%'";
        $q = $this->db->query($query);
        $r = $q->row();
        $kode = (int)substr($r->max_id,7)+1;
        $next_kode = str_pad($kode, 5, "0", STR_PAD_LEFT);
        $fin ='CON-'.date('y').$kode_bln.$next_kode;
      }

      return $fin;
    }
	
}
