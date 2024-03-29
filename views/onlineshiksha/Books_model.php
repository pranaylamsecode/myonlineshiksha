<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Books_model extends CI_Model
{

	var $column_order = array(null,'b.name','b.author','c.name','b.price','b.total_copies','b.issued_copies','b.rack_no',null); //set column field database for datatable orderable
    var $column_search = array('b.name','b.author','c.name','b.price'); //set column field database for datatable searchable 
    var $order = array('b.book_id' => 'DESC'); 

    function __construct()
    {
        parent::__construct();
    }
	
	private function _get_datatables_query()
	{
		$this->db->select('b.book_id, b.name as book_name, b.author, b.price, b.class_id, b.total_copies, b.issued_copies, b.rack_no, c.name as class_name');
        $this->db->from('book b');
        $this->db->join('class c','c.class_id = b.class_id',"left");
        $this->db->where('b.is_delete = "no"');
		$i = 0;
     
        if($_POST['search']['value']) // if datatable send POST for search
            {
                $explode_string = explode(' ', $_POST['search']['value']);
                foreach ($explode_string as $show_string) 
                {  
                    $cond  = " ";
                    $cond.=" ( b.name LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR b.author LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR b.price LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR c.name LIKE '%".trim($show_string)."%') ";
                    $this->db->where($cond);
                }
            }
        $i++;
        
        if(isset($_POST['order'])) // here order processing
        {
            //print_r($this->column_order);exit;
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

	function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

	 public function count_all()
    {    
        $this->_get_datatables_query();
        return $this->db->count_all_results();
    }

	function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_bookDetails($con){
        return $this->db->select('b.*, c.name as class_name')
        ->from('book b')
        ->join('class c','c.class_id = b.class_id',"left")
        ->where($con)
        ->get()->row();
    }
}