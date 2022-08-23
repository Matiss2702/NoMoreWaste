<?php

namespace App\Controllers\Admin;

use CodeIgniter\RESTful\ResourcePresenter;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\I18n\Time;

class AdminsController extends ResourcePresenter
{
    protected $modelName = 'App\Models\AdminsModel';
    use ResponseTrait;
    /**
     * Present a view of resource objects
     *
     * @return mixed
     */
    public function index()
    {
        $session = \Config\Services::session();
        $data = [
            'title' => 'Admins',
            'Admins' => $this->model->findAll(),
            'is_login' => $session->get('isLoggedIn'),
        ];
        return view('admin/Admins', $data);
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
        $data = [
            'title'=> 'Admins',
            'Admins' => $this->model->find($id),
            'is_login' => $session->get('isLoggedIn'),
        ];

        return view('admin/show_Admins', $data);
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
            'mail' => $this->request->getVar('mail'),
        ];
        $rules = [

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
            ]
        ];     
        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        }

        $this->model->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Admins creer avec success'
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
            'mail' => $this->request->getVar('mail'),
        ];
        $rules = [
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
            ]
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
                    'success' => 'Admins supprimé avec success'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('aucun Admins trouver');
        }
    }
}
