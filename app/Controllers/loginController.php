<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;


class loginController extends BaseController
{


    public function index()
    {

        echo view('login.php');
    }


    public function login()
    {


        $session = session();
        $session1 = session();
        $model1 = new UserModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $data = $model1->where('username', $username)->first();

        if ($data) {

            $pass = $data['password'];
            $verifyPass = password_verify($password, $pass);

            if ($verifyPass) {
                $sesData = [
                    'id' => $data['id'],
                    'username' => $data['username'],
                    'firstname' => $data['firstname'],
                    'lastname' => $data['lastname'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'logged_in' => true,
                ];
                $session1->setFlashdata('msg', 'you have loged in successfully');
                $session->set($sesData);
                return redirect()->to('/dashboardController/index');
            } else {
                $session->setFlashdata('msg', 'username or password is invalid');
                return redirect()->to('/loginController/index');
            }

        } else {
            $session->setFlashdata('msg', 'username or password is invalid');
            return redirect()->to('/loginController/index');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/registerController/index');

    }

    public function forgotPassword()
    {

        if ($this->request->getMethod() == 'post') {

            $error = $this->validate([
                'email' => [
                    'rules' => 'required|valid_email',
                    'label' => 'Email Address',
                    'errors' => [
                        'required' => '{field} is necessary',
                        'valid_email' => 'please insert a valid {field}',
                    ]
                ]
            ]);
            if ($error) {
                $model1 = new UserModel();
                $email = $this->request->getPost('email', FILTER_SANITIZE_EMAIL);
                $data = $model1->where('email', $email)->first();

                if ($data) {
                    $token = rand(1000, 9999);
                    $to = $data['email'];
                    $subject = 'reset password';
                    $message = 'please click on the link of reset password' . '<br>' . '<a href="http://localhost:8080/loginController/reset/' . $data['id'] . '">reset password</a>';

                    $email1 = \Config\Services::email();

                    $email1->setTo($to);

                    $email1->setFrom('info@test.com', 'testphp');

                    $email1->setSubject($subject);

                    $email1->setMessage($message);

                    $email2 = $email1->send();

                    if ($email2) {
                        $session = session();
                        $session->setFlashdata('msg', 'email reset password link sent to your email address');
                        return redirect()->to(current_url());
                    } else {
                        $session = session();
                        $session->setFlashdata('msg', 'email reset password link did not sent to your email address please try again later');
                        return redirect()->to(current_url());
                    }
                } else {
                    $session = session();
                    $session->setFlashdata('msg', 'email entered dosn\'t exist');
                    return redirect()->to('/loginController/forgotPassword');

                }

            } else {
                return view('forgotPassword.php');
            }
        }

        return view('forgotPassword.php');
    }

    public function reset($id = null)
    {

        $model = new UserModel();
        $data['users'] = $model->where('id', $id)->first();

        echo view('resetPassword.php', $data);

    }

    public function updateresetpassword()
    {

        helper(['form', 'url']);
        $error = $this->validate([
            'password' => 'required',
            'password_confirm' => 'required|matches[password]',
        ]);
        if ($error) {
            $id1 = $this->request->getPost('id');
            $data = [
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'password_confirm' => password_hash($this->request->getPost('password_confirm'), PASSWORD_DEFAULT),
            ];
            $model = new UserModel();

            $model->update($id1, $data);
            $session = session();
            $session->setFlashdata('msg', 'password updated successfully');
            return redirect()->to('/loginController/index');
        } else {
            echo view('resetPassword');
        }
    }

}
