<?php
	class Channel_model extends CI_Model{

		public function add_channel($data){
			$this->db->insert('ci_channels', $data);
			return true;
		}

		//---------------------------------------------------
		// get all channels for server-side datatable processing (ajax based)
		public function get_all_channels(){
			$wh =array();
			$SQL ='SELECT * FROM ci_channels';
			$wh[] = " is_admin = 0";
			if(count($wh)>0)
			{
				$WHERE = implode(' and ',$wh);
				return $this->datatable->LoadJson($SQL,$WHERE);
			}
			else
			{
				return $this->datatable->LoadJson($SQL);
			}
		}


		//---------------------------------------------------
		// Get channel detial by ID
		public function get_channel_by_id($id){
			$query = $this->db->get_where('ci_channels', array('id' => $id));
			return $result = $query->row_array();
		}

		//---------------------------------------------------
		// Edit channel Record
		public function edit_channel($data, $id){
			$this->db->where('id', $id);
			$this->db->update('ci_channels', $data);
			return true;
		}

		//---------------------------------------------------
		// Change channel status
		//-----------------------------------------------------
		function change_status()
		{		
			$this->db->set('is_active', $this->input->post('status'));
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('ci_channels');
		} 

	}

?>