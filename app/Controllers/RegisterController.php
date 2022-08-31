<?php

namespace App\Controllers;

use App\Models\BenevolesModel;
use App\Models\JobsModel;
use App\Models\Has_ConditionsModel;
use App\Models\ConditionsModel;

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
                'password' => sha1($this->request->getPost('password')),
                'id_jobs' => $this->request->getPost('job'),
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
            'rules' =>'required|valid_email|is_unique[benevoles.mail]',
            'errors' => [
              'required' => 'le mail est requis',
              'valid_email' => 'le mail doit etre valid',
              'is_unique' => 'le mail est déjà utilisé',
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
              'url' => 'confirm/'.$id.'a'.sha1($data['mail'])

          ];
          $email = \Config\Services::email(); // loading for use
          $email->setTo($data['mail']);
          $email->setSubject('Activation de Votre Compte Nomorewaste');
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
      if($Benevoles['valided'] == 0) {
        $data = [
          'valided' => '1'
        ];
        $BenevolesModel->update((int)$id,$data);
        $session->setFlashdata('activate', 'Votre compte a bien été activer');
        return redirect('/job/'.$id);
      } else {
        $session->setFlashdata('activate', 'Votre compte est déjà activer');
        return redirect('/');
      }
    }
    
    public function job($id){
      $jobs =  new BenevoleModel();
      $conditions = new ConditionsModel();
      $has_conditions = new Has_ConditionsModel();

      $data = [
        'title'=> 'Job',
        'has_conditions' => $has_conditions->findAll(),
        'jobs' => $jobs->where('id', $id)->first()['id_jobs'],
        'conditions' => $conditions->findAll(),
      ];

      return view('job', $data);

    }

    public function condition() {
      $email = \Config\Services::email(); // loading for use
      $BenevolesModel =  new BenevolesModel();
      $conditions = new ConditionM%odel();
      $Benevoles = $BenevolesModel->where('mail', $this->request->getPost('mail'))->first();
      $data = [
        "benevole" => $Benevoles,
        "job" => $this->request->getPost('job'),
        "questions" => $conditions->findAll(),
        "responses" => $this-> request->getPost('responses')
      ];

      $email->setTo('matiss.haillouy@gmail.com'); 
      $email->setSubject('Demande de vérification emplois Nomorewaste');
      // Using a custom template
      $template = view('mail/job-mail', $data);
      $email->setMessage($template);
      // Send email
      $reponse = [
        'message' => 'Nouvelle demande de vérification d\'emplois'
      ];
      
      if($this->validate($job_rules)){

        if ($email->send()) {
          $session->setFlashdata('job', 'vos informations ont bien été envoyé');
          return redirect('/');
        } else {
          $session->setFlashdata('job', 'vos informations n\'ont pas été envoyé');
          return redirect('/');
        }
      } else{
        $errors = $validation->getErrors();
        return $this->fail($errors);
      }
    }
}
