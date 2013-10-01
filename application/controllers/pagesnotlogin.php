<?php

class Pages extends CI_Controller {

//MAINCONTROLLER FOR STATIC PAGES
public function view($page = 'home')
{

	if ( ! file_exists('application/views/pages/'.$page.'.php'))
	{
		// Whoops, we don't have a page for that!
		show_404();
	}

	$data['title'] = ucfirst($page); // Capitalize the first letter

	$this->load->view('include/header', $data);
	$this->load->view('pages/'.$page, $data);
	$this->load->view('include/footer', $data);
		$this->load->view('include/fb', $data);

}

public function login(){


$this->load->library('fbconnect');

		$this->load->view('login');


	}

	public function about(){


if ($this->session->userdata('is_logged_in')){

	$data = $this->session->all_userdata();


$this->load->view('pages/about', $data);



}else{

	redirect('main/login');
}
	}

	public function facebook_request(){


$this->load->library('fbconnect');
$data = array(
'redirect_uri' => site_url('pages/handle_facebook_login'),

'scope' => 'email'
	
	);
		redirect($this->fbconnect->getLoginUrl($data));



	}

	public function handle_facebook_login(){

$this->load->library('fbconnect');
$this->load->model('users');
$facebook_user = $this->fbconnect->user;



if ($this->fbconnect->user){

if ($this->users->is_member($facebook_user)){
$this->users->log_in($facebook_user);
redirect('pages/about');
}else {

$this->users->sign_up_from_facebook($facebook_user);
$this->users->log_in($facebook_user);

redirect('pages/about');


}



	/*
echo "<pre>";
print_r($this->fbconnect->user);
echo "</pre>";

*/


}else{

echo "notlogin";


}

	}




public function logout(){


	$this->session->sess_destroy();
redirect('main/login');
}
}

?>
