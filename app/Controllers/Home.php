<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function __construct()
	{
		helper('form');
		helper(['url', 'Login_helper']);
	}

	public function index()
	{
		if(session()->get('user_id')!= null){
			if(session()->get('user_type') == "employer") {
				return redirect()->to('EmployerHome/index');
			}
			else if(session()->get('user_type') == "applicant") {
				return redirect()->to('ApplicantHome/index');
			}
			
		}
		return view('Home/index');
	}

	public function login()
	{
		if(session()->get('user_id')!= null){
			if(session()->get('user_type') == "employer") {
				return redirect()->to('EmployerHome/index');
			}
			else if(session()->get('user_type') == "applicant") {
				return redirect()->to('ApplicantHome/index');
			}
			
		}
		$validation = $this->validate([
			'username' => [
				'rules' => 'required|is_not_unique[user_account.username]',
				'errors' => [
					'required' => 'Username is required',
					'is_not_unique' => 'This username does not exist'
				]
			],
			'password' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Password is Required'
				]
			]
		]);

		// $username = $this->request->getPost('username');
		// 	$password = $this->request->getPost('password');

		// 	$userAccountModel = new \App\Models\userAccountModel();
		// 	$user_info = $userAccountModel->where('username', $username)->first();

		// 	if($user_info != null && $user_info['password'] == $password) {
		// 		$session=session();
		// 		$session->regenerate();
		// 		$session->set('user_id', $user_info['id']);

		// 		return redirect()->to("/Home/loginSuccess")->with('info', 'Login Successful');
		// 	} else {
		// 		return redirect()->to("/Home/loginFailed")->with('info', 'Given Name or Password is not correct, try again');
		// 	}

		if (!$validation) {
			return view('/Home/index', ['validation' => $this->validator]);
		} else {
			$username = $this->request->getPost('username');
			$password = $this->request->getPost('password');

			$userAccountModel = new \App\Models\userAccountModel();
			$user_info = $userAccountModel->where('username', $username)->first();

			if ($user_info != null && $user_info['password'] == $password) {
				// $session = session();
				// $session->regenerate();
				session()->set('user_id', $user_info['id']);
				session()->set('user_type', $user_info['type']);
			

				$user_id = session()->get('user_id');
				$userAccountModel = new \App\Models\userAccountModel();
				$user_type = $userAccountModel->where('id', $user_id)->first();
				if ($user_type['type'] == "employer") {
					return redirect()->to("//EmployerHome/index")->with('info', 'Login Successful');
				} elseif ($user_type['type'] == "applicant") {
					return redirect()->to("//ApplicantHome/index")->with('info', 'Login Successful');
				} else {
					return view('Home/index');
					session()->setFlashdata('fail', 'Incorrect Password!');
				}
			} else {
				session()->setFlashdata('fail', 'Incorrect Password!');
				return redirect()->to('/Home')->withInput();
				//return redirect()->to("/Home/loginFailed")->with('info', 'Given Name or Password is not correct, try again');
			}
		}
	}

	// public function loginFailed()
	// {
	// 	$session = session();
	// 	$session->setFlashdata('fail', 'Incorrect Password!');
	// }

	public function logout()
	{
		if (session()->has('user_id')) {
			session()->remove('user_id');
			session()->remove('user_type');
			return redirect()->to('Home/index')->with('fail', 'You are Logged out');
		  }
		// $session = session();
		// $session->destroy();
		// return redirect()->to('Home/index')->with('fail', 'You are Logged out');
	}
}