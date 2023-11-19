<?php
namespace App\Controllers;
use CodeIgniter\Email\Email;

class Reset extends BaseController
{
    public function index()
    {
       echo view('template/header');
       echo view('forgot_password');
    }

    public function forgot_password()
    {
        $email = $this->request->getPost('forgot_password_email');
       
        $userModel = model('App\Models\User_model');
        $check = $userModel->checkEmailExists($email);

        $resetModel = model('App\Models\Reset_model');

        if ($check == null) {
            $data['notFoundError'] = 'Email not found, please sign up.';
            echo view('template/header');
            echo view('forgot_password', $data);
        } else {
            $token = bin2hex(random_bytes(16));
            $expirationTime = time() + (60 * 60);
            $resetModel->setToken($email, $token);

            $sender = 'yueqi.wang@uqconnect.edu.au';
            $subject = 'Reset your password';
            $message = 'Please click the following link to reset your password. This link expires in 24 hours.'. base_url() . "reset/verify_token/$token";

            $newEmail = new Email();

            $emailConf = [
                'protocol' => 'smtp',
                'wordWrap' => true,
                'SMTPHost' => 'mailhub.eait.uq.edu.au',
                'SMTPPort' => 25
            ];
            $newEmail->initialize($emailConf);   
                    
            $newEmail->setTo($email);
            $newEmail->setFrom($sender);
            $newEmail->setSubject($subject);
            $newEmail->setMessage($message);

            if ($newEmail->send()) {
                $data['isButtonDisabled'] = true;
                $data['success'] = 'Email sent successfully! Please follow the instruction in it to reset your password';
            } else {
                $data['error'] = 'Error sending email. Please try again later.';
            }
            echo view('template/header');
            echo view('forgot_password', $data);
        }
    } 
    
    public function verify_token($token)
    {
        $model = model('App\Models\Reset_model');
        $emailRow = $model->getEmailByToken($token);
        
        if ($emailRow == null) {
            echo view('template/header');
            $data['tokenError'] = 'Invalid or expired token';
            echo view('error', $data);
        } else {
            session()->set('reset_email', $emailRow->email);
            echo view('template/header');
            echo view('reset_password');
        }
    }

    public function reset_password()
    {
        $rules = [
            'new_password' => 'required|min_length[10]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])/]',
            'new_passconf' => 'required|matches[new_password]',
        ]; 

        $messages = [
            'new_password' => [
                'required' => 'The password field is required.',
                'min_length' => 'The password field must be at least 10 characters long.',
                'regex_match' => 'The password field must contain at least one uppercase and one lowercase letter.'
            ],
            'new_passconf' => [
                'required' => 'The password confirmation field is required.',
                'matches' => 'The password confirmation field must match the password field.'
            ],
        ];

        if (! $this->validate($rules, $messages)) {
            $data['invalid'] = implode('<br>', $this->validator->getErrors());
            echo view('template/header');
            echo view('reset_password', $data);
        } else {
            $model = model('App\Models\Reset_model');
            $email = session()->get('reset_email');
    
            $newPassword = $this->request->getPost('new_password');
            $check = $model->resetPassword($email, $newPassword);
            if ($check) {
                $model->removeToken($email);
                return redirect()->to(base_url('login'));
            } else {
                $data['error']= "<div class=\"alert alert-danger\" role=\"alert\"> Reset failed! </div> ";
                echo view('template/header');
                echo view('reset_password', $data);
            }            
        }
    }
}