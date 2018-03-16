<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/***********************************************************************
          Galaxy Web Links Ltd.        
************************************************************************
Filename : controllers/Admin.php
* Description : Controller for manage admin end
* Modification Log
* Date Author Description
* ---------------------------------------------------------------------------------------------------------
* Jul,03 2017 Ramesh Kumar - Developing the page
**********************************************************************************************************/


class Admin extends CI_Controller {

	public function __Construct()
	{
		parent::__construct();
		ini_set('memory_limit', '-1');


	}

	/*
	* function for admin login screen
	*/
	public function index()
	{

		if($this->access_library->login_status() == TRUE)
		{
			redirect('admin/dashboard');
		}

		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		$this->form_validation->set_message('required', 'The %s field cannot be left blank');
		$this->form_validation->set_error_delimiters('','');

		$data['login_error']	= '';
		if($this->form_validation->run() == TRUE)
		{
			$response = $this->admin_model->validate_admin_login();
			$data['login_error']	= $response;
		}

		$data['title']	= 'Admin Login';
		$this->load->view('header', $data);
		$this->load->view('login', $data);
	}

	/*
	* function for admin logout
	*/
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('admin');
	}

	/*
	* function for admin dashboard screen
	*/
	public function dashboard()
	{
		$this->access_library->is_admin_logged_in();
		$data['users']	= $this->admin_model->getuserscount();
		
		$data['page_name']	= 'dashboard';
		$data['title']	= 'Admin Dashboard';
		$this->load->view('header', $data);
		$this->load->view('dashboard');
		$this->load->view('footer');
	}

	/*
	* function for manage static pages
	*/
	public function page()
	{
		$this->access_library->is_admin_logged_in();

		/* Get pages lists*/
		$pages 	= $this->admin_model->getPages();
		$data['pages']	= $pages;

		$data['page_name']	= 'page';
		$data['title']	= 'Manage Static Pages';
		$this->load->view('header', $data);
		$this->load->view('pages');
		$this->load->view('footer');
	}

	/*
	* function for add / edit static pages
	*/
	public function addEditPages($page_id = "")
	{
		$this->access_library->is_admin_logged_in();

		$data['page_name']	= 'page';
		$languages	= $this->admin_model->getRecords('language', '*');
		$data['languages']	= $languages;

		$this->load->library('form_validation');
		if($page_id == '')
		{
			$data['title']	= 'Create Static Page';
			$this->load->view('header', $data);
			$this->load->view('add-page');
			$this->load->view('footer');
		}
		else
		{
			$page_details	= $this->admin_model->getRecords('page', '*', array('id' => $page_id), '', TRUE);
			
			if(empty($page_details))
			{

			}
			else
			{
				$data['title']	= 'Edit Static Page';
				$data['page']	= $page_details;
				$this->load->view('header', $data);
				$this->load->view('edit-page');
				$this->load->view('footer');
			}
		}
	}

	/*
	* function for validate & save existing plans
	*/
	public function savePage($page_id = '')
	{
		$this->access_library->is_admin_logged_in();

		$this->load->library('form_validation');
		$this->form_validation->set_rules('pagename', 'Name', 'trim|required');
		$this->form_validation->set_rules('pagecontent', 'Content', 'trim|required');
		$this->form_validation->set_rules('language', 'Language', 'trim');

		$this->form_validation->set_message('required', 'The %s field cannot be left blank');
		$this->form_validation->set_error_delimiters('','');

		if($this->form_validation->run() == TRUE)
		{
			$this->admin_model->savePage($page_id);
		}
		else
		{
			$this->addEditPages($page_id);
			return;
		}
	}

	/*
	* function for display 404 error message
	*/
	public function error_404()
	{
		$data['title']	= '404 Page Not Found';
		$data['page_name']	= 'error_404';
		$this->load->view('header', $data);

		$this->load->view('error_404');
		$this->load->view('footer');
	}

	/*
	* function for display general settings 
	*/
	public function GeneralSettings()
	{
		$this->access_library->is_admin_logged_in();

		$data['page_name']	= 'admin';
		$data['sub_page'] 	= 'general_settings';
		$data['title']	= 'Manage General Settings';
		$general_settings 	= $this->admin_model->get_generalsettings();
		$data['general_settings']	= $general_settings;
		$this->load->view('header', $data);
		$this->load->view('general_settings');
		$this->load->view('footer');		
	}

	/*
	* function for display Users
	*/
	public function UserManagement()
	{
		$this->access_library->is_admin_logged_in();

		//get list of law firm
		$users = $this->admin_model->getRecords('tp_user', 'id, username,last_login,is_active,created_at', '', 'id asc');
		$data['users']	= $users;

		$data['page_name']	= 'admin';
		$data['sub_page'] 	= 'users';
		$data['title']	= 'User Management';
		$this->load->view('header', $data);
		$this->load->view('user_list');
		$this->load->view('footer');
	}

	/*
	* function for fetch & display Answered Question list with pagination
	*/
	public function UserManagementList()
	{
		$search	= $this->input->get("sSearch");
		$search = trim($search);
		$search	= $this->db->escape_str($search);

		/*additonal search fields*/
		$advance_search	= array(
				'username' 	=> $this->input->get('username'),
				'email' 	=> $this->input->get('email'),
				'date' => $this->input->get('date')
			);

		$sort_column 	= $this->input->get("iSortCol_0");
		$sort_dir 		= $this->input->get("sSortDir_0");
		
		//find total count of question asked
		$question_counts	= $this->admin_model->count_users($search, $advance_search);
		$recordsTotal	= $question_counts;
		$recordsFiltered	= $recordsTotal;

		$per_page	= $this->input->get("iDisplayLength");
		$start_limit	= $this->input->get("iDisplayStart");

		$users 	= $this->admin_model->users($search, $per_page, $start_limit, $sort_column, $sort_dir, $advance_search);

		$data = array();

		if(!empty($users))
		{
			foreach($users as $user)
			{
				$row	= array();
				$row[]	=  $user['id'];
				$row[]	= '<a href="'.base_url('admin/viewuser/'.$user['id']).'">'. $user['username'] .'</a>';
				$row[]	= '<a href="'.base_url('admin/viewuser/'.$user['id']).'">'. $user['email'] .'</a>';
				

				$row[]	= date('d M Y H:i', strtotime($user['created_at']));
				$row[]	= date('d M Y H:i', strtotime($user['last_login']));
					 if($user['referrer']) $row[] = $user['referrer']; else $row[] = 'none';
				 $row[] = '<input type="text" class="balance-text text-right" maxlength=9 id="id_'.$user['id'].'" value="'.$user['balance'].'"/><font class="pull-left balance-label">'.$user['balance'].'</font><i class="fa fa-pencil curpoint pull-right edit-balance"></i>';
				$checked = '';
				if($user['is_active'] == 1) $checked = "checked";
				$row[]	= '<label class="middle">
								<input class="ace is_active" type="checkbox" name="lbl" '.$checked.' value="'.$user['id'].'">
										<span class="lbl">&nbsp;</span>
								</label>';

				$data[]	= $row;
			}
		}

		$json	= array(
			"draw"            => intval( $this->input->get('sEcho') ),
			"recordsTotal"    => intval( $recordsTotal ),
			"recordsFiltered" => intval( $recordsFiltered ),
			"data"            => $data
		);

		echo json_encode($json);
	}

	public function UserActive()
	{
		$id = $_REQUEST['id'];$val = $_REQUEST['val'];
		$this->admin_model->saveUserStatus($id,$val);
	}

	

	public function viewuser($id = "")
	{

		$this->access_library->is_admin_logged_in();

		$data['page_name']	= 'admin';
		$data['sub_page'] 	= 'users';
		$user_details	= $this->admin_model->getuser($id);
			
		if(!empty($user_details))
		{
			$data['title']	= 'View User Profile';
			$data['user']	= $user_details;
			$this->load->view('header', $data);
			$this->load->view('view-user');
			$this->load->view('footer');
		}else{
			redirect(base_url('UserManagement'));
		}
		
		
	}

	
	/*
	* function for display topics
	*/
	public function topics()
	{
		$this->access_library->is_admin_logged_in();

		$data['page_name']	= 'admin';
		$data['sub_page'] 	= 'topics';
		$data['title']	= 'Manage Topics';
		$topics 	= $this->admin_model->get_topics();
		$data['topics']	= $topics;
		
		$this->load->view('header', $data);
		$this->load->view('topics');
		$this->load->view('footer');		
	}

	public function topicdelete()
	{
		$id = $_REQUEST['id'];
		$this->admin_model->deletetopic($id);
	}

	
	/*
	* function for add / edit static pages
	*/
	public function createtopic()
	{
		$this->access_library->is_admin_logged_in();

		$data['page_name']	= 'topics';
		$category	= $this->admin_model->getRecords('category', '*');
		$data['categories']	= $category;

		$this->load->library('form_validation');
		
			$data['page_name']	= 'admin';
			$data['sub_page'] 	= 'topics';
			$data['title']	= 'Create Topic';
			$this->load->view('header', $data);
			$this->load->view('add-topic');
			$this->load->view('footer');
		
	}
	public function edittopic($id = "")
	{
		$this->access_library->is_admin_logged_in();

		$data['page_name']	= 'topics';
		$category	= $this->admin_model->getRecords('category', '*');
		$data['categories']	= $category;

		$this->load->library('form_validation');
		if($id == '')
		{
			redirect(base_url('admin/createtopic'));
		}
		else
		{
			$topic_details	= $this->admin_model->getRecords('topic', '*', array('id' => $id), '', TRUE);
			
			if(empty($topic_details))
			{

			}
			else
			{
				$data['page_name']	= 'admin';
				$data['sub_page'] 	= 'topics';
				$data['title']	= 'Edit Topic';
				$data['topic']	= $topic_details;
				$this->load->view('header', $data);
				$this->load->view('edit-topic');
				$this->load->view('footer');
			}
		}
	}

	/*
	* function for validate & save existing plans
	*/
	public function saveTopic($id = '')
	{
		$this->access_library->is_admin_logged_in();

		$this->load->library('form_validation');
		$this->form_validation->set_rules('category', 'Category', 'trim|required');
		$this->form_validation->set_rules('topic_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('url', 'Topic URL', 'trim|required');
		$this->form_validation->set_rules('seo_text', 'Topic SEO Text', 'trim|required');

		$this->form_validation->set_message('required', 'The %s field cannot be left blank');
		$this->form_validation->set_error_delimiters('','');

		if($this->form_validation->run() == TRUE)
		{
			$this->admin_model->saveTopic($id);

		}
		else
		{
			$this->edittopic($id);
			return;
		}
	}

	

	/*
	* function for display news
	*/
	public function news()
	{
		$this->access_library->is_admin_logged_in();

		$data['page_name']	= 'admin';
		$data['sub_page'] 	= 'news';
		$data['title']	= 'Manage News';
		$news 	= $this->admin_model->get_news();
		$data['news']	= $news;
		
		$this->load->view('header', $data);
		$this->load->view('news');
		$this->load->view('footer');		
	}

	public function newsdelete()
	{
		$id = $_REQUEST['id'];
		$this->admin_model->deletenews($id);
	}

	/*
	* function for add / edit news
	*/
	public function createnews()
	{
		$this->access_library->is_admin_logged_in();

		$data['page_name']	= 'news';
		$lawfirm	= $this->admin_model->getlawyer();
		$data['lawfirm']	= $lawfirm;

		$this->load->library('form_validation');
		
			$data['page_name']	= 'admin';
			$data['sub_page'] 	= 'news';
			$data['title']	= 'Create News';
			$this->load->view('header', $data);
			$this->load->view('add-news');
			$this->load->view('footer');
		
	}

	public function editnews($id = "")
	{
		$this->access_library->is_admin_logged_in();

		$data['page_name']	= 'news';
		$lawfirm	= $this->admin_model->getlawyer();
		$data['lawfirm']	= $lawfirm;

		$this->load->library('form_validation');
		if($id == '')
		{
			redirect(base_url('admin/createnews'));
		}
		else
		{
			$news_details	= $this->admin_model->getRecords('news', '*', array('id' => $id), '', TRUE);
			
			
			if(empty($news_details))
			{

			}
			else
			{
				$data['page_name']	= 'admin';
				$data['sub_page'] 	= 'news';
				$data['title']	= 'Edit News';
				$data['news']	= $news_details;
				$this->load->view('header', $data);
				$this->load->view('edit-news');
				$this->load->view('footer');
			}
		}
	}

	/*
	* function for validate & save existing news
	*/
	public function saveNews($id = '')
	{
		$this->access_library->is_admin_logged_in();

		$this->load->library('form_validation');
		$this->form_validation->set_rules('lawyer', 'Lawyer', 'trim|required');
		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_rules('content', 'The Article', 'trim|required');
		

		$this->form_validation->set_message('required', 'The %s field cannot be left blank');
		$this->form_validation->set_error_delimiters('','');

		if($this->form_validation->run() == TRUE)
		{
			$this->admin_model->saveNews($id);

		}
		else
		{
			$this->editnews($id);
			return;
		}
	}
	
	

	 /*
	* function for display contact
	*/
	public function contact()
	{
		$this->access_library->is_admin_logged_in();

		$data['page_name']	= 'admin';
		$data['sub_page'] 	= 'contact';
		$data['title']	= 'Contact Form list';
		$contact = $this->admin_model->getRecords('contact', '', '', 'id desc');
		$data['contact']	= $contact;
		$this->load->view('header', $data);
		$this->load->view('contact');
		$this->load->view('footer');		
	}

	
}

