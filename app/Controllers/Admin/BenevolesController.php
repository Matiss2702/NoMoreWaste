<?php

namespace App\Controllers\Admin;

use CodeIgniter\RESTful\ResourcePresenter;
use CodeIgniter\API\ResponseTrait;
use App\Models\JobsModel;
use CodeIgniter\I18n\Time;

class BenevolesController extends ResourcePresenter
{
    protected $modelName = 'App\Models\BenevolesModel';
    use ResponseTrait;
    /**
     * Present a view of resource objects
     *
     * @return mixed
     */
    public function index()
    {
        $session = \Config\Services::session();
        $JobsModel = new JobsModel();
        $data = [
            'title' => 'benevoles',
            'benevoles' => $this->model->findAll(),
            'id_jobs' => $JobsModel->findAll(),
            'is_login' => $session->get('isLoggedIn'),
        ];
        return view('admin/benevoles', $data);
    }

    /**
     * Present a view to present a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $session = \Config\Services::session();
        $JobsModel = new JobsModel();
        $data = [
            'title'=> 'benevoles',
            'benevoles' => $this->model->find($id),
            'id_jobs' => $JobsModel->find($this->model->find($id)['id_jobs'],),
            'is_login' => $session->get('isLoggedIn'),
        ];

        return view('admin/show_benevoles', $data);
    }

    /**
     * Process the creation/insertion of a new resource object.
     * This should be a POST.
     *
     * @return mixed
     */
    public function create()
    {
        $session = \Config\Services::session();
        $validation = \Config\Services::validation();
        $data = [
            'password' => sha1($this->request->getVar('password')),
            'lastname' => $this->request->getVar('lastname'),
            'firstname' => $this->request->getVar('firstname'),
            'mail' => $this->request->getVar('mail'),
            'address' => $this->request->getVar('address'),
            'city' => $this->request->getVar('city'),
            'zipcode' => $this->request->getVar('zipcode'),
            'country' => $this->request->getVar('country'),
            'id_jobs' => $this->request->getVar('id_jobs'),
            'phone' => $this->request->getVar('phone'),
            'valided' => $this->request->getVar('valided'),
        ];
        $rules = [

            'lastname' => [
                'rules' => 'required|alpha|min_length[3]|max_length[10]',
                'errors' => [
                    'required' => 'le nom est requis',
                    'alpha' => 'le nom doit contenir que des lettres',
                    'min_length' => 'le nom doit contenir 3 caractere minimun',
                    'max_length' => ' le nom doit contenir 10 caractere maximun',
                ]
            ],
            'firstname' => [
                'rules' => 'required|alpha|min_length[3]|max_length[10]',
                'errors' =>  [
                    'required' => 'le prenom est requis',
                    'alpha' => 'le prenom doit contenir que des lettres',
                    'min_length' => 'le prenom doit contenir 3 caractere minimun',
                    'max_length' => ' le prenom doit contenir 10 caractere maximun',
                ]
            ],
           'password' => [
                'rules' =>'required|min_length[8]',
                'errors' =>  [
                  'required' =>'le mot de passe est requis',
                  'min_length' => 'le mot de passe doit contenir 8 caractere minimun',
                ]
            ],
            'mail' => [
                'rules' => 'required|valid_email|is_unique[users.mail]',
                'errors' => [
                    'required' => 'le mail est requis',
                    'valid_email' => 'le mail doit etre valid',
                    'is_unique' => 'le mail est déjà utilisé',
                ]
            ],
            'address' => [
                'rules' => 'alpha_dash|required',
                'errors' => [
                    'required' => 'l\'adresse doit etre',
                   'alpha_dash' => 'l\'adresse doit contenir que des lettres, des chiffres et des tirets bas',
                ]
            ],
            'country' => [
                'rules' => 'alpha|required',
                'errors' => [
                    'alpha' => 'il doit contenir que des caractere',
                    'required' => 'le pats doit etre donnée'
                ]
            ],
            'city' => [
                'rules' => 'alpha|required',
                'errors' => [
                    'required' => 'la ville doit etre donnée',
                    'alpha' => 'il doit contenir que des caractere',
                ]
            ],
            'zipcode' => [
                'rules' => 'numeric|required',
                'errors' => [
                    'required' => 'le code postale doit etre donnée',
                    'numeric' => 'il doit contenir que des chiffres',
                ]
            ],
            'id_jobs' => [
                'rules' => 'numeric|required',
                'errors' => [
                    'required' => 'le code postale doit etre donnée',
                    'numeric' => 'il doit contenir que des chiffres',
                ]
            ],
            'phone' => [
                'rules' => 'numeric',
                'errors' => [
                    'numeric' => 'il doit contenir que des chiffres',
                ]
            ],
            'valided' => [
                'rules' => 'numeric|required|max_length[1]|min_length[0]',
                'errors' => [
                    'required' => 'le code postale doit etre donnée',
                    'max_length' => 'la taille doit etre inferieur a 1',
                    'min_length' => 'la taille doit etre superieur a 0',
                    'numeric' => 'il doit contenir que des chiffres',
                ]
            ],
        ];     
        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        }

        $this->model->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'utilisateur creer avec success'
            ]
        ];
        return $this->respondCreated($response);
    
    }

    /**
     * Process the updating, full or partial, of a specific resource object.
     * This should be a POST.
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $data = [
            'password' => sha1($this->request->getVar('password')),
            'lastname' => $this->request->getVar('lastname'),
            'firstname' => $this->request->getVar('firstname'),
            'mail' => $this->request->getVar('mail'),
            'address' => $this->request->getVar('address'),
            'city' => $this->request->getVar('city'),
            'zipcode' => $this->request->getVar('zipcode'),
            'country' => $this->request->getVar('country'),
            'id_jobs' => $this->request->getVar('id_jobs'),
            'phone' => $this->request->getVar('phone'),
            'valided' => $this->request->getVar('valided'),
            'modified_at' => Time::now()->toDateTimeString(),
        ];
        $rules = [
            'password' => [
                'rules' =>'required|min_length[8]',
                'errors' =>  [
                    'required' =>'le mot de passe est requis',
                    'min_length' => 'le mot de passe doit contenir 8 caractere minimun',
                ]
            ],
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
                'rules' => 'required|valid_email|is_unique[users.mail]',
                'errors' => [
                    'required' => 'le mail est requis',
                    'valid_email' => 'le mail doit etre valid',
                    'is_unique' => 'le mail est déjà utilisé',
                ]
            ],
            'address'=>[
                'rules'=>'alpha_numeric_space|required',
                'errors'=>[
                    'required'=>'l\'adresse doit etre',
                    'alpha_numeric_space'=>'il ne doit pas contenir des caractere spéciaux'
                ]
            ],
            'country'=>[
              'rules'=>'alpha|required',
              'errors'=>[
                  'alpha'=>'il doit contenir que des caractere',
                  'required'=>'le pats doit etre donnée'
             ]
            ],
            'city'=>[
                'rules'=>'alpha|required',
                'errors'=>[
                    'required'=>'la ville doit etre donnée',
                    'alpha'=>'il doit contenir que des caractere',
                ]
            ],
            'zipcode'=>[
                'rules'=>'numeric|required',
                'errors'=>[
                    'required'=>'le code postale doit etre donnée',
                    'numeric'=>'il doit contenir que des chiffres',
                ]
            ],
            'id_jobs' => [
                'rules' => 'numeric|required',
                'errors' => [
                    'required' => 'le code postale doit etre donnée',
                    'numeric' => 'il doit contenir que des chiffres',
                ]
            ],
            'phone' => [
                'rules' => 'numeric',
                'errors' => [
                    'numeric' => 'il doit contenir que des chiffres',
                ]
            ],
            'valided' => [
                'rules' => 'numeric|required|max_length[1]|min_length[0]',
                'errors' => [
                    'required' => 'le code postale doit etre donnée',
                    'max_length' => 'la taille doit etre inferieur a 1',
                    'min_length' => 'la taille doit etre superieur a 0',
                    'numeric' => 'il doit contenir que des chiffres',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        }

        $this->model->update($id, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'utilisateur modifier avec succès'
            ]
        ];
        return $this->respond($response);
    }
    
    /**
     * Process the deletion of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $data = $this->model->where('id', $id)->delete($id);
        if ($data) {
            $this->model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'utilisateur supprimé avec success'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('aucun utilisateur trouver');
        }
    }
}
