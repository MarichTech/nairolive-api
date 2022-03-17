<?php
    class Auth_model extends CI_Model{

        public function _construct(){
            $this->load->database();
        }

        public function verify_email($email){
            //Check if email exists
          $query = $this->db->get_where('creator', array('email' => $email));
          if(!empty($query->row_array())){
              //Return true if email exists
              return true;
          } else {
               //Return false if email doesnt exist
              return false;
          }
        }

        public function verify_username($username){
            //check if username exists
            $query = $this->db->get_where('creator', array('username' => $username));
            if(!empty($query->row_array())){
                //Return true if email exists
                return true;
            } else {
                 //Return false if email doesnt exist
                return false;
            }
        }

        public function register_creator($data){
             //Insert $data into the creator table
             return $this->db->insert('creator', $data);
        }

        public function login_creator($username, $password){

        $this->db->select('email,password, username,profile_pic,id_pic,IsVerified,creator_id');
		$this->db->from('creator');
		$this->db->where('username',$username);
		$query = $this->db->get()->row();
		if ($this->bcrypt->compare($password, $query->password)) {
			#Get User data
			
			return $query;
		}else{
			return false;
		}

        }

       
        

        public function user_accounts($id){
            //Get all user accounts
            $query = $this->db->get_where('accounts', array('user_id' => $id));
            return $query->result_array();
        }

        public function insert_account($data){
            //Insert $data into the db
            return $this->db->insert('accounts', $data);
        }

        public function delete_account($id){
            //Delete an account from db using passed id
            return $this->db->delete('accounts', ['id' => $id]);
        }

         public function update_account($data, $id){
           //Update $data in the db
           //Update data by the use of passed id
           $this->db->where('id', $id);
           return $this->db->update('accounts', $data);
        }



    }
    ?>