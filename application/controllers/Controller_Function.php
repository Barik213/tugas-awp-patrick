<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Controller_Function extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Main_Model');
		$this->load->library('phpmailer_lib');
		$this->load->library('ciqrcode');
		$this->load->library('user_agent');
	}
	public function index(){
		$this->form_validation->set_rules('email','email','required|trim',
			['required' => 'This field cannot be empty'
		]
	);
		$this->form_validation->set_rules('password','Password','required|trim',
			['required' => 'This field cannot be empty'
		]
	);		
		if($this->form_validation->run() == false){
			$this->load->view('template/header');
			$this->load->view('login.php');
			$this->load->view('template/footer');
		}else{
			$data = ['email' => $this->input->post('email')];
			$password = $this->input->post('password');
			$user = $this->Main_Model->checkUser($data);
			if($user != null){
				if($user['active'] == 1){
					if(password_verify($password,$user['password'])){
						$data = ['username' => $user['username']];
						$this->session->set_userdata($data);
						redirect('Controller_Function/Login');
					}else{
						$this->session->set_flashdata('message','<small class="text-danger label-material" role="alert">Wrong Password</small>');
						redirect('Controller_Function');
					}
				}else{
					$this->session->set_flashdata('message','<small class="text-danger label-material" role="alert">Your email is not activated!</small>');
					redirect('Controller_Function');					
				}
			}else{
				$this->session->set_flashdata('message','<small class="text-danger label-material" role="alert">Email is not registered!</small>');
				redirect('Controller_Function');
			}
	}
}
	public function register(){
		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[table_tugas.username]', 
			['is_unique' => 'This username already exist!',
			 'required' => 'This field cannot be empty'
		] 
	);
		$this->form_validation->set_rules('email', 'Email', 'required|trim|is_unique[table_tugas.email]', 
			['is_unique' => 'This email already exist!',
			 'required' => 'This field cannot be empty'
		]
	);
		$this->form_validation->set_rules('password','password','required|trim|matches[retype-password]',
			['required' => 'This field cannot be empty',
			 'matches' => 'The password doesnt matches'
		]
	);
		$this->form_validation->set_rules('retype-password','password','required|trim',
			['required' => 'This field cannot be empty'
		]
	);		

		if($this->form_validation->run() == false){
			$this->load->view('template/header');
			$this->load->view('register.php');
			$this->load->view('template/footer');			
		}else{
			//Data Captcha
			$form_response=$this->input->post('g-recaptcha-response');
		   $url="https://www.google.com/recaptcha/api/siteverify";
		   $sitekey="6LcmPasUAAAAAGqycWEak0gDjM4XNtqHuKAAVMuU";
		   $response = file_get_contents($url."?secret=".$sitekey."&response=".$form_response."&remoteip=".$_SERVER["REMOTE_ADDR"]);
		   $data=json_decode($response);

		   	$email = $this->input->post('email');
			$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$code = substr(str_shuffle($set), 0, 10);
		   //Validasi Captcha
		   if(isset($data->success) && $data->success=="true"){
			$data = [
			'username' => htmlspecialchars($this->input->post('username',true)),
			'email' => htmlspecialchars($this->input->post('email',true)),
			'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
			'active' => 0,
			'code' => $code
			];

			//PHPMailer
			$mail = $this->phpmailer_lib->load();
				$mail->isSMTP();
				$mail->Host = 'smtp.gmail.com';
				$mail->SMTPAuth = true;
				$mail->Username = 'jonasganteng2@gmail.com';
				$mail->Password = 'jonasganteng123';
				$mail->SMTPSecure = 'tls';
				$mail->Port = 587;

				$mail->setFrom('bariklana41@gmail.com','Iqbal Ramadhan');
				$mail->addReplyTo('jonasariston998@gmail.com','Gilang Ramadhan');

				$mail->addAddress($email);

				$mail->Subject = 'Your Email Verification';

				$mail->isHTML(true);
				$mailContent = "<h1>Dear,</h1>
				<p>This is your email verification in order to activate your account. Best regards</p>"."<a href=".base_url()."Controller_Function/verify?email=".base64_encode($email).'&code='.$code.">Click Here To Activate</a>";
				$mail->Body = $mailContent;
				$mail->send();

			//Masukkin ke Database	
			$this->Main_Model->inputData($data);
				$this->session->set_flashdata('message','<label class="alert alert-success label-material" role="alert">Thanks for your registration! Please check your email in order to activate your account.</label>');
    			redirect('Controller_function');
			redirect('Controller_Function');
		   }else{
		   	    $this->session->set_flashdata('message','<small class="text-danger label-material" role="alert">Please fill the captcha!</small>');
    			redirect('Controller_function/register');
		   }
		}
	}

	public function login(){
		if($this->form_validation->run() == false){
			$data = ['username' => $this->session->userdata('username')];
			$user['data'] = $this->Main_Model->userName($data);
			$this->load->view('template/header');
			$this->load->view('home',$user);
			$this->load->view('template/footer');
		}

	}

	public function verify(){
		//Check apakah Emailnya Benar
		$id = $this->input->get('email');
		$id1 = base64_decode($id);
		$data = ['email' => $id1];
		$user = $this->Main_Model->checkUser($data);
			 		if($user){
			 				$token = $this->input->get('code');
			 				$check = ['code' => $token];
			 				$code = $this->Main_Model->checkUser($check);
			 			if($code){
							$this->Main_Model->changeActive($id1);
							$this->session->set_flashdata('message','<p class="alert alert-success label-material" role="alert">Activation Success</p>');
							redirect('Controller_Function');
			 			}else{
			 			$this->session->set_flashdata('message','<p class="alert alert-danger label-material" role="alert">Activation Failed! Invalid Token</p>');
			 			redirect('Controller_Function');
			 			}
			 		}else{
						$this->session->set_flashdata('message','<p class="alert alert-danger label-material" role="alert">Activation Failed! Invalid Email</p>');
			 			redirect('Controller_Function');			 			
			 		}
		
	}

	public function QRcode($kodenya = '123456'){
		QRcode::png(
		$kodenya,
		$outfile = false,
		$level = QR_ECLEVEL_H,
		$size = 5,
		$margin = 2
			);
	}

	public function logout(){
			$this->session->unset_userdata('email');
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				You have been Logged out!
				</div>');
		redirect('Controller_Function');
	}	

	//Ajax Controller Read Data
	public function showAllData(){
		$result = $this->Main_Model->getAllData();
		echo json_encode($result);
	}

	//Ajax Controller Add Data
	public function addNew(){
		$result = $this->Main_Model->addData();
		$msg['success'] = false;
		$msg['type'] = 'add';
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}

	//Ajax Controller Edit Data
	public function editData(){
		$result = $this->Main_Model->editData();
		echo json_encode($result);
	}

	public function updateData(){
		$result = $this->Main_Model->updateData();
		$msg['success'] = false;
		$msg['type'] = 'update';
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}

	public function deleteData(){
		$result = $this->Main_Model->deleteData();
		$msg['success'] = false;
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}
}