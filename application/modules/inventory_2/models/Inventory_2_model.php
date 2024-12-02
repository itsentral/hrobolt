<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * @author Yunas Handra
 * @copyright Copyright (c) 2018, Yunas Handra
 *
 * This is model class for table "Customer"
 */

class Inventory_2_model extends BF_Model
{

    /**
     * @var string  User Table Name
     */
    protected $table_name = 'ms_inventory_category1';
    protected $key        = 'id';

    /**
     * @var string Field name to use for the created time column in the DB table
     * if $set_created is enabled.
     */
    protected $created_field = 'created_on';

    /**
     * @var string Field name to use for the modified time column in the DB
     * table if $set_modified is enabled.
     */
    protected $modified_field = 'modified_on';

    /**
     * @var bool Set the created time automatically on a new record (if true)
     */
    protected $set_created = true;

    /**
     * @var bool Set the modified time automatically on editing a record (if true)
     */
    protected $set_modified = true;
    /**
     * @var string The type of date/time field used for $created_field and $modified_field.
     * Valid values are 'int', 'datetime', 'date'.
     */
    /**
     * @var bool Enable/Disable soft deletes.
     * If false, the delete() method will perform a delete of that row.
     * If true, the value in $deleted_field will be set to 1.
     */
    protected $soft_deletes = true;

    protected $date_format = 'datetime';

    /**
     * @var bool If true, will log user id in $created_by_field, $modified_by_field,
     * and $deleted_by_field.
     */
    protected $log_user = true;

    /**
     * Function construct used to load some library, do some actions, etc.
     */
    public function __construct()
    {
        parent::__construct();
    }
	
	
    function generate_id($kode='') 
    {
        $query = $this->db->query("SELECT MAX(id_category1) as max_id FROM ms_inventory_category1");
        $row = $query->row_array();
        $thn = date('y');
        $max_id = $row['max_id'];
        $max_id1 =(int) substr($max_id,4,5);
        $counter = $max_id1 +1;
        $idcust = "LVL2".str_pad($counter, 5, "0", STR_PAD_LEFT);
        return $idcust;
	}

    function generateSKU($idInventoryType) 
    {
        $data = $this->db->query("SELECT * FROM app_parameter WHERE CODE='BP' AND id_jenis_produk = '$idInventoryType'")->row();
        if ($data->value <= $data->range_end) {
            $query =  $this->db->query("UPDATE app_parameter SET VALUE=RIGHT(CONCAT('00',CAST(VALUE AS UNSIGNED)+1),2) WHERE CODE='BP' AND id_jenis_produk = '$idInventoryType'");
            $seq = $this->db->query("SELECT value FROM app_parameter WHERE CODE='BP' AND id_jenis_produk = '$idInventoryType'")->row();
            $data = $seq->value;
        }

        return $data;
    }

    function regenerateSKU($idInventoryType) 
    {
        $data = $this->db->query("SELECT * FROM app_parameter WHERE CODE='BP' AND id_jenis_produk = '$idInventoryType'")->row();
        if ($data->value > $data->range_start && $data->value < $data->range_end) {
            $query =  $this->db->query("UPDATE app_parameter SET VALUE=RIGHT(CONCAT('00',CAST(VALUE AS UNSIGNED)-1),2) WHERE CODE='BP' AND id_jenis_produk = '$idInventoryType'");
            $seq = $this->db->query("SELECT value FROM app_parameter WHERE CODE='BP' AND id_jenis_produk = '$idInventoryType'")->row();
            $data = $seq->value;
        }

        return $data;
    }

 	public function get_data($table, $where_field='', $where_value='')
    {
		if($where_field !='' && $where_value!=''){
			$query = $this->db->get_where($table, array($where_field=>$where_value));
		}else{
			$query = $this->db->get($table);
		}
		
		return $query->result();
	}

    public function get_data_single($table, $where_field='', $where_value='')
    {
		if($where_field !='' && $where_value!=''){
			$query = $this->db->get_where($table, array($where_field=>$where_value), 1, 0);
		}else{
			$query = $this->db->get($table);
		}
		
		return $query->row();
	}
	
	public function get_data_category1()
    {
		$this->db->select('a.*, b.nama as nama_type');
		$this->db->from('ms_inventory_category1 a');
		$this->db->join('ms_inventory_type b','b.id=a.id_type');
		$this->db->where('a.deleted','0');
		$this->db->order_by('a.id','ASC');
		$query = $this->db->get();		
		return $query->result_array();
	}

	public function getKomposisi($id)
    {
		$search = "deleted='0' and id_category1='$id'";
		$this->db->select('*');
		$this->db->from('ms_compotition');
		$this->db->where($search);
		$query = $this->db->get();		
		return $query->result();
	}
	
    function getById($id)
    {
       return $this->db->get_where('ms_inventory_category1',array('id_category1' => $id))->row_array();
    }
}
