<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;


class ForgotPasswordController extends BaseController {
    use ResponseTrait;

    public function forgot() {
        $BenevolesModel =  new UserModel();
        $validation = \Config\Services::validation();
        $data = [
            'mail' => $this->request->getPost('mail'),
        ];

        $reset_rules = [
          'mail' => [
            'rules' =>'required|valid_email',
            'errors' => [
              'required' => 'le mail est requis',
              'valid_email' => 'le mail doit etre valid',
            ]
          ],
        ];

        if($this->validate($reset_rules)){
          $BenevolesModel = new BenevolesModel();
          $Benevoles = $BenevolesModel->where('mail', $data['mail'])->first();
          $BenevolesInfo = [
              'lastname' => $Benevoles['lastname'],
              'firstname' => $Benevoles['firstname'],
              'url' => 'reset/'.$Benevoles['id'].'a'.sha1($uBenevolesser['mail'])

          ];
          $email = \Config\Services::email(); // loading for use
          $email->setTo($user['mail']);
          $email->setSubject('mots de passe oublié');
          // Using a custom template
          $template = view('mail/reset-mail', $BenevolesInfo);
          $email->setMessage($template);
          // Send email
          $reponse = [
            'message' => 'Vous allez recevoir un email pour changer votre mots de passe.'
          ];
          if ($email->send()) {
            return $this->respondCreated($reponse);
          } else {
            $data = $email->printDebugger(['headers']);
            print_r($data);
          }
          }else{
            $errors = $validation->getErrors();
            return $this->fail($errors);
          }
    }

    public function reset($hash) {
      $session = \Config\Services::session();
      $BenevolesModel =  new UserModel();
      $id = substr($hash, 0, strpos($hash, 'a'));
      $Benevoles = $BenevolesModel->where('id', $id)->first();
      $data = [
        'lastname' => $Benevoles['lastname'],
        'firstname' => $Benevoles['firstname'],
        'id' => $id,
        'title' => 'mots de passe oublié'
      ];
      return view('forgot',$data);
    }

    public function reset_confirm(){
         $data = [
            'id' => $this->request->getPost('id'),
            'password' => $this->request->getPost('password'),
            'pass_confirm' => $this->request->getPost('pass_confirm'),
        ];
        $forgot_rules = [
          'password' => [
            'rules' =>'required|min_length[8]',
            'errors' =>  [
              'required' =>'le mot de passe est requis',
              'min_length' => 'le mot de passe doit contenir 8 caractere minimun',
            ]
          ],
          'pass_confirm' => [
            'rules' =>'required_with[password]|matches[password]',
            'errors' => [
              'required_with' =>'le mot de passe doit etre remplis avant ',
              'matches' =>'le confirmation doit corespondre au mot de passe',
            ]
          ]
        ];
        $pwd =[
          'password'=> sha1($data['password'])
        ];
        if($this->validate($forgot_rules)){
          $BenevolesModel = new UserModel();
          $BenevolesModel->update((int)$data['id'],$pwd);
          $reponse = [
            'message' => 'Votre mots de passe à bien été modifié.'
          ];
           return $this->respond($reponse,200);
        }else{
            $errors = $validation->getErrors();
            return $this->fail($errors);
        }
    }
}
