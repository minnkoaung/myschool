<?php
class Type_Model extends CI_Model {

    public $id;
	public $name;
	public $parent;
	public $updated_at;
	public $updated_by; 

	public function __construct(){

		parent::__construct();
	}

	   public function get_last_ten_type()
        {
                $query = $this->db->get('type', 10);
                return $query->result();
        }

	public function insert_type(){

		$this->name = $_POST['name'];
		$this->parent = $_POST['parent'];
		$this->updated_at = time();
		$this->updated_by = time();

		$this->db->insert('type', $this);
	}

	public function update_type($id){

		$this->name = $_POST['name'];
		$this->parent = $_POST['parent'];
		$this->updated_at = $_POST['updated_at'];
		$this->updated_by = $_POST['updated_by'];

		$this->db->update('type', $this, array('id' => $id));
	}
}