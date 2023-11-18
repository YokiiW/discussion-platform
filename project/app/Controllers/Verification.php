<?php
namespace App\Controllers;
use CodeIgniter\Email\Email;

class Verification extends BaseController
{	
	public function index()
 	{
        $verificationCode = mt_rand(100000, 999999);
        session()->set('verification_code', $verificationCode);
        $verificationCode = session()->get('verification_code');
        $receiver = session()->get('email');
        $sender = 'yueqi.wang@uqconnect.edu.au';
        $subject = 'Verification';
        $message = 'Your verification code is '.$verificationCode;

        $email = new Email();

        $emailConf = [
            'protocol' => 'smtp',
            'wordWrap' => true,
            'SMTPHost' => 'mailhub.eait.uq.edu.au',
            'SMTPPort' => 25
        ];
        $email->initialize($emailConf);   
                  
        $email->setTo($receiver);
        $email->setFrom($sender);
        $email->setSubject($subject);
        $email->setMessage($message);

        if ($email->send()) {
            echo view('template/header');
            echo view('email_verification');
        } else {
            echo view('template/header');
            $data['sendingError'] = 'Error sending email. Please try again later.';
            echo view('error', $data);
        }
 	}

    public function verify()
    {
        $data['error'] = '';
        $data['success'] = '';
        $verificationCode = session()->get('verification_code');
        $inputCode = $this->request->getPost('verification_code');
        if (session()->get('type') == 'signUp') {
            if ($verificationCode == $inputCode) {
                $data['isButtonDisabled'] = true;
                $data['success'] = 'Verification successful! You will be redirected to the login page in 3 seconds.';
                session()->remove('verification_code');
                session()->remove('email');
                header("refresh:3;url=/project/login");
            } else {
                $data['error'] = 'Incorrect verification code. Please try again.';
            }
            echo view('template/header');
            echo view('email_verification', $data);
        }
        if (session()->get('type') == 'update') {
            if ($verificationCode == $inputCode) {
                $data['isButtonDisabled'] = true;
                $data['success'] = 'Verification successful! You will be redirected to the profile page in 3 seconds.';
                session()->remove('verification_code');
                session()->remove('email');
                header("refresh:3;url=/project/login/profile");
            } else {
                $data['error'] = 'Incorrect verification code. Please try again.';
            }
            echo view('template/header');
            echo view('email_verification', $data);
        }
    }
}