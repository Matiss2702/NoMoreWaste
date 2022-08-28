<?php

namespace App\Controllers;

use App\Models\AdminsModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\CLI\Console;

class AdminAuthController extends BaseController {
    use ResponseTrait;

    public function administrator() {
        return view('admin/administrator');
    }

    public function login() {
        $session = \Config\Services::session();
        $mail = $this->request->getPost('mail');
        $pwd = $this->request->getPost('password');
        $AdminsModel =  new AdminsModel();
        $Admins = $AdminsModel->where('mail', $mail)->first();

        if($Admins){
           if(sha1($pwd)==$Admins['password']){
                    $ses_data = [
                        'id' => $Admins['id'],
                        'mail' => $Admins['mail'],
                        'isLoggedIn' => TRUE
                    ];
                    $session->set($ses_data);
                    $response = [
                        'status'   => 200,
                        'error'    => null,
                        'message' =>  'connexion réussi'
                    ];
                    return $this->respond($response);
                }else{
                    return $this->fail('mauvais mot de passe');
                }
        }else{
            return $this->failNotFound('t\'existe pas mec');
        }
    }

    public function logout() {
        $session = \Config\Services::session();
        $session->destroy();
        return redirect('/');
    }
}
