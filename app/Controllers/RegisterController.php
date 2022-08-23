<?php

namespace App\Controllers;

use App\Models\BenevolesModel;
use CodeIgniter\API\ResponseTrait;


class RegisterController extends BaseController {
    use ResponseTrait;

    public function register() {
        $BenevolesModel =  new BenevolesModel();
        $validation = \Config\Services::validation();
        $data = [
                'lastname' => $this->request->getPost('lastname'),
                'firstname' => $this->request->getPost('firstname'),
                'mail' => $this->request->getPost('mail'),
                'address' => $this->request->getPost('address'),
                'city' => $this->request->getPost('city'),
                'zipcode' => $this->request->getPost('zipcode'),
                'country' => $this->request->getPost('country'),
                'phone' => $this->request->getPost('phone'),
                'password' => sha1($this->request->getPost('password')),
        ];

        $register_rules = [
          'lastname' => [
            'rules' =>'required|alpha_numeric_space|min_length[3]|max_length[10]',
            'errors' => [
              'required' => 'le nom est requis',
              'alpha_numeric_space' => 'le nom ne doit pas contenir de caractere spéciaux',
              'min_length' => 'le nom doit contenir 3 caractere minimun',
              'max_length' => ' le nom doit contenir 10 caractere maximun',
            ]
          ],
          'firstname' => [
            'rules' =>'required|alpha_numeric_space|min_length[3]|max_length[10]',
            'errors' =>  [
              'required' => 'le prenom est requis',
              'alpha_numeric_space' => 'le prenom ne doit pas contenir de caractere spéciaux' ,
              'min_length' => 'le prenom doit contenir 3 caractere minimun',
              'max_length' => ' le prenom doit contenir 10 caractere maximun',
            ]
          ],
          'mail' => [
            'rules' =>'required|valid_email|is_unique[users.mail]',
            'errors' => [
              'required' => 'le mail est requis',
              'valid_email' => 'le mail doit etre valid',
              'is_unique' => 'le mail est déjà utilisé',
            ]
          ],
          'address' => [
            'rules' =>'required|alpha_numeric_space|min_length[3]|max_length[10]',
            'errors' =>  [
              'required' => 'l\'adresse est requis',
              'alpha_numeric_space' => 'l\'adresse ne doit pas contenir de caractere spéciaux' ,
              'min_length' => 'l\'adresse doit contenir 3 caractere minimun',
              'max_length' => ' l\'adresse doit contenir 10 caractere maximun',
            ]
          ],
          'city' => [
            'rules' =>'required|alpha_numeric_space|min_length[3]|max_length[10]',
            'errors' =>  [
              'required' => 'la ville est requis',
              'alpha_numeric_space' => 'la ville ne doit pas contenir de caractere spéciaux' ,
              'min_length' => 'la ville doit contenir 3 caractere minimun',
              'max_length' => ' la ville doit contenir 10 caractere maximun',
            ]
          ],
          'zipcode' => [
            'rules' =>'required|numeric|min_length[5]|max_length[5]',
            'errors' =>  [
              'required' => 'le code postal est requis',
              'numeric' => 'le code postal ne doit que des nombres' ,
              'min_length' => 'le code postal doit contenir 5 caractere minimun',
              'max_length' => ' le code postal doit contenir 5 caractere maximun',
            ]
          ],
          'country' => [
            'rules' =>'required|alpha_numeric_space|min_length[3]|max_length[20]',
            'errors' =>  [
              'required' => 'le pays est requis',
              'alpha_numeric_space' => 'le pays ne doit pas contenir de caractere spéciaux' ,
              'min_length' => 'le pays doit contenir 3 caractere minimun',
              'max_length' => ' le pays doit contenir 10 caractere maximun',
            ]
          ],
          'phone' => [
            'rules' =>'required|numeric|min_length[10]|max_length[10]',
            'errors' =>  [
              'required' => 'le telephone est requis',
              'numeric' => 'le telephone ne doit que des nombres' ,
              'min_length' => 'le telephone doit contenir 10 caractere minimun',
              'max_length' => ' le telephone doit contenir 10 caractere maximun',
            ]
          ],
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

        if($this->validate($register_rules)){
          $BenevolesModel = new BenevolesModel();
          $Benevoles = $BenevolesModel->insert($data);
          $id = $BenevolesModel->insertID;
          $BenevolesInfo = [
              'lastname' => $data['lastname'],
              'firstname' => $data['firstname'],
              'city' => $data['city'],
              'zipcode' => $data['zipcode'],
              'country' => $data['country'],
              'phone' => $data['phone'],
              'url' => 'confirm/'.$id.'a'.sha1($data['mail'])

          ];
          $email = \Config\Services::email(); // loading for use
          $email->setTo($data['mail']);
          $email->setSubject('Activation de Votre Compte NoMoreWaste');
          // Using a custom template
          $template = view('mail/activate-mail', $BenevolesInfo);
          $email->setMessage($template);
          // Send email
          $reponse = [
            'message' => 'votre compte à bien été crée. Vous allez recevoir un email pour valider votre compte.'
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

    public function confirm($hash) {
      $session = \Config\Services::session();
      $BenevolesModel =  new BenevolesModel();
      $id = substr($hash, 0, strpos($hash, 'a'));
      $Benevoles = $BenevolesModel->where('id', $id)->first();
      if($user['valided'] == 0) {
        $data = [
          'valided' => '1'
        ];
        $BenevolesModel->update((int)$id,$data);
        $session->setFlashdata('activate', 'Votre compte a bien été activer');
        return redirect('/');
      } else {
        $session->setFlashdata('activate', 'Votre compte est déjà activer');
        return redirect('/');
      }
    }
}
