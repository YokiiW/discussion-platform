<?php
namespace App\Controllers;

require_once APPPATH. '../vendor/autoload.php';
use Twilio\Rest\Client;

use Config\Services;

class Sign_up extends BaseController
{	
	public function index()
 	{
        echo view('template/header');
 		echo view('sign_up');
 	}

	public function check_sign_up()
	{
        $rules = [
            'name' => 'required|alpha_numeric|is_unique[Users.name]',
            'password' => 'required|min_length[10]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])/]',
            'passconf' => 'required|matches[password]',
            'email'    => 'required|valid_email|is_unique[Users.email]',
            'phone'    => 'required|regex_match[/^[0-9]{9}$/]'
        ]; 

        $messages = [
            'name' => [
                'required' => 'The name field is required.',
                'alpha_numeric' => 'The name field must be alphanumeric.',
                'is_unique' => 'This name is already registered.'
            ],
            'password' => [
                'required' => 'The password field is required.',
                'min_length' => 'The password field must be at least 10 characters long.',
                'regex_match' => 'The password field must contain at least one uppercase and one lowercase letter.'
            ],
            'passconf' => [
                'required' => 'The password confirmation field is required.',
                'matches' => 'The password confirmation field must match the password field.'
            ],
            'email' => [
                'required' => 'The email field is required.',
                'valid_email' => 'The email field must contain a valid email address.',
                'is_unique' => 'This email is already registered.'
            ],
            'phone' => [
                'required' => 'The phone field is required.',
                'regex_match' => 'The phone field must be an Australian phone number.'
            ]
        ];

        if (! $this->validate($rules, $messages)) {
            $data['invalid'] = implode('<br>', $this->validator->getErrors());
            echo view('template/header');
            echo view('sign_up', $data);
        } else {
            $data['errors'] = "";
            $name = $this->request->getPost('name');
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $phone = $this->request->getPost('phone');

            $model = model('App\Models\Sign_up_model');
            $check = $model->sign_up($name, $email, $password, $phone);
            if ($check) {
                //Send SMS message using Twilio
                $sid = 'AC557c1f2e9e8ee474f8f5f88359a0653e';
                $token = '838928c3cc4d7a75335da2bbef7d608a';
                $client = new Client($sid, $token);
                $client->messages->create(
                    '+61'.$phone, // To number
                    array(
                        'from' => '+19033428171', // Twilio phone number
                        'body' => 'Thank you for signing up!'
                    )
                );

                $session = session();
                $session->set('email', $email);
                $session->set('type', 'signUp');

                return redirect()->to(base_url('verification'));
            } else {
                $data['errors'] = "<div class=\"alert alert-danger\" role=\"alert\"> Sign up failed!! </div> ";
                return view('template/header') . view('sign_up', $data);
            }
        }
	}
}