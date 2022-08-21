<?php

namespace App\Controllers;

use App\Models\BenevolesModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\CLI\Console;

class AuthController extends BaseController {
    use ResponseTrait;

    public function login() {
        $session = \Config\Services::session();
        $mail = $this->request->getPost('mail');
        $pwd = $this->request->getPost('password');
        $BenevolesModel =  new BenevolesModel();

        $Benevoles = $BenevolesModel->where('mail', $mail)->first();

        if($Benevoles){
            if($Benevoles['valided']==1){
                if(sha1($pwd)==$Benevoles['password']){
                    $ses_data = [
                        'id' => $Benevoles['id'],
                        'lastname' => $Benevoles['lastname'],
                        'firstname' => $Benevoles['firstname'],
                        'mail' => $Benevoles['mail'],
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
                return $this->fail('votre compte n\'est pas activé');
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
