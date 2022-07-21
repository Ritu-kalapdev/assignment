<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers_model extends CI_Model {

	var $table = 'number';
	var $column_order = array(null, 'country_name','created_on','name','total_test','failed','connected','diff_in_seconds'); //set column field database for datatable orderable

	var $column_search = array('company_id','country_code_id'); //set column field database for datatable searchable 
	var $order = array('id' => 'asc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	private function _get_datatables_query($search)
	{
		
		
		$company_id=$search['company'];
		$country_code_id=$search['country'];
		$to=$search['to'];
		$from=$search['from'];
		$this->db->select('job_processing.*,DATE_FORMAT(job_processing.created_on, "%D %b %Y") as day,country_code.country_name,company.name, count(job_processing.number_id) as total_test,SUM(CASE 
             WHEN job_processing.call_description_id IS NULL THEN 1
             ELSE 0
           END) AS connected,
        SUM(CASE 
             WHEN job_processing.call_description_id IS NOT NULL THEN 1
             ELSE 0
           END) AS failed,TIME_TO_SEC(TIMEDIFF(call_connect_time,call_start_time)) as diff_in_seconds');

		
		$this->db->from($this->table);
		$this->db->join('job_processing','job_processing.number_id = number.id');
		$this->db->join('company','company.id = number.company_id');
		$this->db->join('country_code','country_code.id = number.country_code_id');
		$this->db->where('number.company_id',$company_id);
		$this->db->where('number.country_code_id',$country_code_id);
		$this->db->where('created_on >=', $from);
        $this->db->where('created_on <=', $to);
		$this->db->group_by('DATE(job_processing.created_on)');
		$this->db->group_by('number.country_code_id');

		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}

	}
	private function _get_monthly_qry($search)
	{
		
		
		$company_id=$search['company'];
		$country_code_id=$search['country'];
		$to=$search['to'];
		$from=$search['from'];
		$this->db->select('job_processing.*, MONTHNAME(job_processing.created_on) as month,country_code.country_name,company.name, count(job_processing.number_id) as total_test,SUM(CASE 
             WHEN job_processing.call_description_id IS NULL THEN 1
             ELSE 0
           END) AS connected,
        SUM(CASE 
             WHEN job_processing.call_description_id IS NOT NULL THEN 1
             ELSE 0
           END) AS failed,TIME_TO_SEC(TIMEDIFF(call_connect_time,call_start_time)) as diff_in_seconds');

		
		$this->db->from($this->table);
		$this->db->join('job_processing','job_processing.number_id = number.id');
		$this->db->join('company','company.id = number.company_id');
		$this->db->join('country_code','country_code.id = number.country_code_id');
		$this->db->where('number.company_id',$company_id);
		$this->db->where('number.country_code_id',$country_code_id);
		$this->db->where('created_on >=', $from);
        $this->db->where('created_on <=', $to);
		$this->db->group_by('MONTH(job_processing.created_on)');
		$this->db->group_by('number.country_code_id');

		//$this->db->group_by('job_processing.number_id'); 
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}

	}

	
	function get_datatables($search)
	{
		$this->_get_datatables_query($search);
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		//echo $this->db->last_query(); die;

		return $query->result();
	}
	function get_monthly($search)
	{
		$this->_get_monthly_qry($search);
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		//echo $this->db->last_query(); die;

		return $query->result();
	}

	function count_filtered($search)
	{
		$this->_get_datatables_query($search);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}
	
	public function get_countries()
	{
		$this->db->from("country_code");
		$query = $this->db->get();
		return $query->result();
	}
	public function get_companies()
	{
		$this->db->from("company");
		$query = $this->db->get();
		return $query->result();
	}

}
