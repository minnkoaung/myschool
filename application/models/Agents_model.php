<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Agents_model extends CI_Model {

    /**
     * @vars
     */
    private $_db;


    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // define primary table
        $this->_db = 'agents';
    }



    /**
     * Save and email contact message
     *
     * @param  array $data
     * @param  array $settings
     * @return boolean
     */
    public function create($data, $settings=array())
    {
            // build query
            $this->db->insert($this->_db, $data);//$this->_db mean ($this->_db = 'properties');

            // execute query

            if ($this->db->insert_id()) //latest insert is ok or not ok,ok show id
            {
                return TRUE;
            }
        

        return FALSE;
    }


/**
     * Update a properties
     *
     * @param  array $data
     * @param  array $settings
     * @return boolean
     */
    public function update($data, $id)
    {
            // build query
            $ok=$this->db->update($this->_db, $data, array("id"=>$id));//$this->_db mean ($this->_db = 'properties');
            // execute query
           
            if ($ok) //latest insert is ok or not ok,ok show id
            {
                return TRUE;
            }
        return FALSE;
    }

/**
     * Delete a properties
     *
     * @param  array $data
     * @param  array $settings
     * @return boolean
     */
    public function delete($id)
    {
            // build query
            $ok=$this->db->delete($this->_db, array("id"=>$id));
            //$this->_db mean ($this->_db = 'properties');
            // execute query
           
            if ($ok)
            {
                return TRUE;
            }
        return FALSE;
    }


    /**
     * Get list of non-deleted users
     *
     * @param  int $limit
     * @param  int $offset
     * @param  array $filters
     * @param  string $sort
     * @param  string $dir
     * @return array|boolean
     */
    function get_all($limit = 0, $offset = 0, $filters = array(), $sort = 'created_at', $dir = 'DESC')
    {
        // start building query
        $sql = "
            SELECT SQL_CALC_FOUND_ROWS *
            FROM {$this->_db}
            INNER JOIN users
            ON users.id ={$this->_db}.user_id
            WHERE 1 = 1
        ";

        // apply filters
        if ( ! empty($filters))
        {
            foreach ($filters as $key=>$value)
            {
                $value = $this->db->escape('%' . $value . '%');
                $sql .= " AND {$key} LIKE {$value}";
            }
        }

        // continue building query
        $sql .= " ORDER BY {$sort} {$dir}";

        // add limit and offset
        if ($limit)
        {
            $sql .= " LIMIT {$offset}, {$limit}";
        }

        // execute query
        $query = $this->db->query($sql);

        // define results
        if ($query->num_rows() > 0)
        {
            $results['results'] = $query->result_array();
        }
        else
        {
            $results['results'] = NULL;
        }

        // get total count
        $sql = "SELECT FOUND_ROWS() AS total";
        $query = $this->db->query($sql);
        $results['total'] = $query->row()->total;

        // return results
        return $results;
    }


    public function get($id){

        return $this->db->get($this->_db, array("id"=>$id));
    }

    /**
     * Set email message as read
     *
     * @param  int $id
     * @param  int $read_by
     * @return boolean
     */
    public function read($id = NULL, $read_by = NULL)
    {
        // data required
       
    }

}
