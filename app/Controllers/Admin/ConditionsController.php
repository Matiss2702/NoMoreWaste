<?php

namespace App\Controllers\Admin;

use CodeIgniter\RESTful\ResourcePresenter;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\I18n\Time;

class ConditionsController extends ResourcePresenter
{
    protected $modelName = 'App\Models\ConditionsModel';
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
            'title' => 'Conditions',
            'Conditions' => $this->model->findAll(),
            'is_login' => $session->get('isLoggedIn'),
        ];
        return view('admin/conditions', $data);
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
            'title'=> 'Conditions',
            'Conditions' => $this->model->find($id),
            'is_login' => $session->get('isLoggedIn'),
        ];

        return view('admin/show_conditions', $data);
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
            'question' => $this->request->getVar('question'),
        ];
        $rules = [
            'question' => [
                'rules' => 'required|alpha|min_length[10]|max_length[100]',
                'errors' => [
                    'required' => 'le nom est requis',
                    'alpha' => 'le nom doit contenir que des lettres',
                    'min_length' => 'le nom doit contenir 3 caractere minimun',
                    'max_length' => ' le nom doit contenir 10 caractere maximun',
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
                'success' => 'Conditions creer avec success'
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
            'question' => $this->request->getVar('question'),
            'modified_at' => Time::now()->toDateTimeString(),
        ];
        $rules = [
            'question' => [
                'rules' =>'required|alpha_numeric_space|min_length[10]|max_length[100]',
                'errors' => [
                    'required' => 'le nom est requis',
                    'alpha_numeric_space' => 'le nom ne doit pas contenir de caractere spéciaux',
                    'min_length' => 'le nom doit contenir 10 caractere minimun',
                    'max_length' => ' le nom doit contenir 100 caractere maximun',
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
                'success' => 'Conditions modifier avec succès'
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
                    'success' => 'Conditions supprimé avec success'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('aucune Conditions trouver');
        }
    }
}
