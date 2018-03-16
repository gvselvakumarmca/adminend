<?php
/**
* 
*/
class Admin_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function getuserscount()
	{
		$this->db->select('sf.id');
		$this->db->from('tp_user sf');
		$this->db->join('tp_user_profile up', 'sf.id = up.user_id');
		$this->db->where("up.is_lawyer = 0");
		$query 	= $this->db->get();

		return $query->num_rows();

	}

	
	/*
	* function for get records from table
	*/
	function getRecords($table, $fields = "*", $condition = "", $orderby = "", $single_row = false) //$condition is array 
	{	
		if(trim($fields) != "")
		{
			$this->db->select('*');
		}

		if($orderby != "")
		{
			$this->db->order_by($orderby);
		}

		if($condition != "")
		{
			$rs = $this->db->where($condition);
		}
		$rs = $this->db->get($table);
		
		if($single_row)
		{  
			return $rs->row_array();
		}
		return $rs->result_array();

	}

	/*
	* function validate admin login details
	*/
	public function validate_admin_login()
	{
		$username	= $this->input->post('username');
		$password	= $this->input->post('password');

		$username_str = $this->db->escape_str($username);
		$password_str = $this->db->escape_str($password);

		// get user details
		$where_case	= "(username = '{$username_str}' OR email = '{$username_str}') AND is_super_admin = 1";
		$users	= $this->getRecords('tp_user', '*', $where_case);

		if(!empty($users))
		{
			if (!function_exists('do_hash'))
			{
				$this->load->helper('security');
			}
			foreach($users as $user)
			{
				$user_salt = $user['salt'];

				if(sha1($user_salt.$password) != $user['password'])
				{
					$response = 'Incorrect Password';
				}
				else
				{
					// set user session values
					$this->session->set_userdata('email',$user['email']);
					$this->session->set_userdata('userid',$user['id']);
					$this->session->set_userdata('username',$user['username']);
					redirect(base_url('admin/dashboard'));
				}
			}
		}
		else
		{
			$response = 'Incorrect Username/Password';
		}
		return $response;
	}

	/* function for getting static pages details*/
	public function getPages($page = '')
	{
		$this->db->select('p.id as page_id, p.name as page_name, p.content, p.language_id, l.name as language');
		$this->db->from('page p');
		$this->db->join('language l', 'l.id = p.language_id', 'left');

		if($page != '')
			$this->db->where('p.id', $page);

		$this->db->order_by('p.name');
		$page_query = $this->db->get();

		if($page_query->num_rows() > 0)
			return $page_query->result_array();
		else
			return FALSE;
	}

	/* function for save / update plan */
	public function savePage($page_id = '')
	{
		$page_name	= $this->input->post('pagename');
		$page_content = $this->input->post('pagecontent');
		$language =	$this->input->post('language');

		$update_data	= array(
				'name'	=> $page_name,
				'content'	=> $page_content,
				'language_id'	=> $language
			);

		if($page_id != '')
		{
			$this->db->where('id', $page_id);
			$this->db->set($update_data);
			$this->db->update('page');

			$this->session->set_flashdata('page_msg', 'Page has been updated successfully.');
		}
		else
		{
			$this->db->set($update_data);
			$this->db->insert('page');

			$this->session->set_flashdata('page_msg', 'Page has been created successfully.');
		}
		redirect('admin/page/');
	}

	/*
	* function for find count of law firms
	*/
	public function count_generalsettings($search = '')
	{
		$this->db->select('id, name');
		$this->db->from('general_settings');

		
		if($search != '')
			$this->db->where("(name LIKE '%$search%')");

		$query 	= $this->db->get();

		return $query->num_rows();
	}
	
	/*
	* function for fetch general settings
	*/
	public function get_generalsettings()
	{
		$this->db->select('gs.*');
		$this->db->from('general_settings gs');

	
		$sort_by	= 'gs.id asc';

		$this->db->order_by($sort_by);

		
		$query 	= $this->db->get();

		if($query->num_rows())
			return $query->result_array();
		else
			return FALSE;
	}

	/* function for save / update plan */
	public function saveSetting($id = '')
	{
		
		$values = $this->input->post('values');
		$message = $this->input->post('message');
		$update_data	= array(
				'value'	=> $values,
				'message'	=> $message,
			);

		if($id != '')
		{
			$this->db->where('id', $id);
			$this->db->set($update_data);
			$this->db->update('general_settings');
			$this->session->set_flashdata('settings_msg', 'Settings has been updated successfully.');
		}
		else
		{
			$this->db->set($update_data);
			$this->db->insert('page');
			$this->session->set_flashdata('settings_msg', 'Settings has been created successfully.');
		}
		redirect('manageprices');
	}

	/*
	* function for find count of users
	*/
	public function count_users($search = '', $advance_search = array())
	{
		$this->db->select('sf.id');
		$this->db->from('tp_user sf');
		$this->db->join('tp_user_profile up', 'sf.id = up.user_id');
		$this->db->where("up.is_lawyer = 0");

		if(isset($advance_search['username']) && $advance_search['username'] != '')
		{
			$search = $advance_search['username'];
			$this->db->where("sf.username LIKE '%$search%'");
		}

		if(isset($advance_search['email']) && $advance_search['email'] != '')
		{
			$search = $advance_search['email'];
			$this->db->where("sf.email LIKE '%$search%'");
		}

		if(isset($advance_search['date']) && $advance_search['date'] != '')
		{
			$this->db->where('date(sf.created_at) = ', date('Y-m-d', strtotime($advance_search['date'])));
		}

		
		if($search != '')
			$this->db->where("(sf.username LIKE '%$search%' OR sf.email LIKE '%$search%'  OR up.referrer
			 LIKE '%$search%')");
		

		$query 	= $this->db->get();

		return $query->num_rows();
	}

	public function getuser($user_id = '')
	{
		$this->db->select('sf.username,sf.email,up.name,up.is_lawyer');
		$this->db->from('tp_user sf');
		$this->db->join('tp_user_profile up', 'sf.id = up.user_id');
		$this->db->where('sf.id', $user_id);
		$query 	= $this->db->get();

		if($query->num_rows())
		{
			return $query->result_array();
		}
		else
		{
			return FALSE;
		}
	}

	/*
	* function for fetch users list
	*/
	public function users($search = '', $per_page = 0, $start_limit = 0, $sort_column = "", $sort_dir = "asc", $advance_search = array())
	{
		$this->db->select('sf.*,up.referrer,up.balance');
		$this->db->from('tp_user sf');
		$this->db->join('tp_user_profile up', 'sf.id = up.user_id');
		$this->db->where("up.is_lawyer = 0");
		
		

		if(isset($advance_search['username']) && $advance_search['username'] != '')
		{
			$search = $advance_search['username'];
			$this->db->where("sf.username LIKE '%$search%'");
		}

		if(isset($advance_search['email']) && $advance_search['email'] != '')
		{
			$search = $advance_search['email'];
			$this->db->where("sf.email LIKE '%$search%'");
		}

		if(isset($advance_search['date']) && $advance_search['date'] != '')
		{
			$this->db->where('date(sf.created_at) = ', date('Y-m-d', strtotime($advance_search['date'])));
		}

		
		if($search != '')
			$this->db->where("(sf.username LIKE '%$search%' OR sf.email LIKE '%$search%' OR up.referrer
			 LIKE '%$search%')");
		if($sort_column == 0)
			$sort_by = 'sf.username';
		else if($sort_column == 1)
			$sort_by = 'date(sf.created_at)';
		else if($sort_column == 2)
			$sort_by = 'date(sf.last_login)';
		else if($sort_column == 4)
			$sort_by = 'q.is_active';
		else
			$sort_by = 'date(sf.created_at)';

		$this->db->order_by($sort_by, $sort_dir);

		if($per_page && !$start_limit)
			$this->db->limit($per_page);
		if($per_page && $start_limit)
			$this->db->limit($per_page, $start_limit);

		$query 	= $this->db->get();

		if($query->num_rows())
		{
			return $query->result_array();
		}
		else
		{
			return FALSE;
		}
	}

	/* function for save / update plan */
	public function saveUserStatus($id,$val)
	{
		
		if($id != '')
		{
			$update_data	= array(
				'is_active'	=> $val,
			);
			$this->db->where('id', $id);
			$this->db->set($update_data);
			$this->db->update('tp_user');
		}
		
	}

	/*
	* function for fetch general settings
	*/
	public function get_topics()
	{
		$this->db->select('t.*,ca.name as category');
		$this->db->from('topic t');
		$this->db->join('category ca', 'ca.id = t.category_id');
		
		$sort_by	= 't.id asc';

		$this->db->order_by($sort_by);

		$query 	= $this->db->get();

		if($query->num_rows())
			return $query->result_array();
		else
			return FALSE;
	}

	/*
	* function for fetch general settings
	*/
	public function deletetopic($id)
	{
		
		$this->db->where('id', $id);
      	$this->db->delete('topic'); 
      	$this->session->set_flashdata('add_topic_message','Topic has been successfully deleted.');
      	//redirect(base_url('admin/topics'));
	}

	/* function for save / update plan */
	public function saveTopic($id = '')
	{
		$category	= $this->input->post('category');
		$topic_name = $this->input->post('topic_name');
		$url =	$this->input->post('url');
		$seo_text =	$this->input->post('seo_text');
		$search_keywords =	$this->input->post('search_keywords');
		$description =	$this->input->post('description');

		$update_data	= array(
				'name'	=> $topic_name,
				'url'	=> $url,
				'category_id'	=> $category,
				'seo_text'	=> $seo_text,
				'description'	=> $description,
				'search_keywords'	=> $search_keywords,
			);

		if($id != '')
		{
			$this->db->where('id', $id);
			$this->db->set($update_data);
			$this->db->update('topic');

			$this->session->set_flashdata('add_topic_message', 'Topic has been successfully updated.');
		}
		else
		{
			$this->db->set($update_data);
			$this->db->insert('topic');
			$id = $this->db->insert_id();
			$this->session->set_flashdata('add_topic_message', 'Topic has been successfully created.');
		}
		if($this->input->post('save')){
			
			redirect(base_url('admin/edittopic/'.$id));
		}
		else{

			redirect(base_url('admin/edittopic'));
		}
	}

	/*  function to fetch news */
	public function get_news()
	{
		$this->db->select('n.*');
		$this->db->from('news n');
		$this->db->join('tp_user_profile sg', 'sg.user_id = n.lawyer_id');
		
		
		$sort_by	= 'n.id desc';

		$this->db->order_by($sort_by);

		$query 	= $this->db->get();

		if($query->num_rows())
			return $query->result_array();
		else
			return FALSE;
	}

	public function deletenews($id)
	{
		
		$this->db->where('id', $id);
      	$this->db->delete('news'); 
      	$this->session->set_flashdata('add_news_message','News has been successfully deleted.');
      	
	}

	public function saveNews($id = '')
	{
		$lawyer	= $this->input->post('lawyer');
		$title = $this->input->post('title');
		$content =	$this->input->post('content');
		$notify = $this->input->post('notify');
		if($notify == '') $notify = 0;
		$strippedname = str_replace(" ","-",strtolower($title));
		$update_data	= array(
				'lawyer_id'	=> $lawyer,
				'headline'	=> $title,
				'content'	=> $content,
				'notify'	=> $notify,
				'stripped_name'	=> $strippedname,
				'created_at'	=> (new \DateTime())->format('Y-m-d H:i:s')
			);

		if($id != '')
		{
			$this->db->where('id', $id);
			$this->db->set($update_data);
			$this->db->update('news');

			$this->session->set_flashdata('add_news_message', 'News has been successfully updated.');
		}
		else
		{
			$this->db->set($update_data);
			$this->db->insert('news');
			$id = $this->db->insert_id();
			$this->session->set_flashdata('add_news_message', 'News has been successfully created.');
		}
		if($this->input->post('save')){
			
			redirect(base_url('admin/editnews/'.$id));
		}
		else{

			redirect(base_url('admin/editnews'));
		}
	}
	
}
?>