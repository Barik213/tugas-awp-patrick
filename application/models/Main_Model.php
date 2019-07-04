<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_Model extends CI_Model {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function inputData($input)
	{
		$query = "INSERT INTO table_tugas (username,email,password,active,code) VALUES (?, ?, ? , ?, ?)";
		$sql = $this->db->query($query,$input);
		return $sql;
	}

	public function checkUser($id)
	{
		return $this->db->get_where('table_tugas',$id)->row_array();
	}

	public function changeActive($id){
  		$sql = "UPDATE table_tugas SET active = 1 WHERE email = ?";
  		$query = $this->db->query($sql, array($id));
  	return $query;
 	}

 	public function userName($username){
		return $this->db->get_where('table_tugas',$username)->row_array();
	}

	//Model for Ajax Get All Data
	public function getAllData(){
		$query = $this->db->get('table_tugas');
		//Check if Data Exists
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}

	public function addData(){
		$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$code = substr(str_shuffle($set), 0, 10);

		$field = [
			'username' => htmlspecialchars($this->input->post('username',true)),
			'email' => htmlspecialchars($this->input->post('email',true)),
			'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
			'active' => 1,
			'code' => $code
		];
		$this->db->insert('table_tugas',$field);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	public function editData(){
		$id = $this->input->get('id');
		$this->db->where('id',$id);
		$query = $this->db->get('table_tugas');

		if($query->num_rows() > 0){
			return $query->row();
		}else{
			return false;
		}
	}

	public function updateData(){
		$id = $this->input->post('detectId');
			$field = [
			'username' => htmlspecialchars($this->input->post('username',true)),
			'email' => htmlspecialchars($this->input->post('email',true)),
			'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
		];
		$this->db->where('id',$id);
		$this->db->update('table_tugas', $field);

		if($this->db->affected_rows() > 0 ){
			return true;
		}else{
			return false;
		}
	}

	function deleteData(){
		$id = $this->input->get('id');
		$this->db->where('id',$id);
		$this->db->delete('table_tugas');
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
}
