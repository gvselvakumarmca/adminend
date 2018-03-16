<?php
/***********************************************************************
          Galaxy Web Links Ltd.        
************************************************************************
Filename : libraries/Access_library.php
* Description : Library for manage admin's login status
* Modification Log
* Date Author Description
* ---------------------------------------------------------------------------------------------------------
* Jul,04 2017 Ramesh Kumar - Developing the page
**********************************************************************************************************/
class Access_library
{
	// Constructor
	public function __construct()
	{
		if(!isset($this->CI))
		{
			$this->CI =& get_instance();
		}
	}

	public function is_admin_logged_in()
	{
		if($this->CI->session->email != '' && $this->CI->session->username != '' && $this->CI->session->userid != '')
		{
			// check current user valid one / not
			$cdt = array(
						'email' => $this->CI->session->email,
						'username' => $this->CI->session->username,
						'id' => $this->CI->session->userid
					);

			$user = $this->CI->admin_model->getRecords('tp_user', '*', $cdt, '', TRUE);

			if(empty($user))
			{
				redirect('admin');
			}
			return TRUE;
		}
		else
		{
			redirect('admin');
		}
	}

	public function login_status()
	{
		// check current user valid one / not
		$cdt = array(
					'email' => $this->CI->session->email,
					'username' => $this->CI->session->username,
					'id' => $this->CI->session->userid
				);

		$user = $this->CI->admin_model->getRecords('tp_user', '*', $cdt, '', TRUE);

		if(empty($user))
		{
			return FALSE;
		}
		return TRUE;		
	}
}