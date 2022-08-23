<?php

namespace App\Controllers\Admin;

use CodeIgniter\RESTful\ResourcePresenter;
use CodeIgniter\API\ResponseTrait;
use App\Models\JobsModel;
use App\Models\ConditionsModel;
use CodeIgniter\I18n\Time;

class Has_ConditionsController extends ResourcePresenter
{
    protected $modelName = 'App\Models\Has_ConditionsModel';
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
        $ConditionsModel = new ConditionsModel();
        $data = [
            'title' => 'Has_Conditions',
            'Has_Conditions' => $this->model->findAll(),
            'id_jobs' => $JobsModel->findAll(),
            'id_conditions' => $ConditionsModel->findAll(),
            'is_login' => $session->get('isLoggedIn'),
        ];
        return view('admin/has_conditions', $data);
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
        $ConditionsModel = new ConditionsModel();
        $JobsModel = new JobsModel();
        $data = [
            'title'=> 'Has_Conditions',
            'Has_Conditions' => $this->model->find($id),
            'id_conditions' => $ConditionsModel->find($this->model->find($id)['id_conditions'],),
            'id_jobs' => $JobsModel->find($this->model->find($id)['id_jobs'],),
            'is_login' => $session->get('isLoggedIn'),
        ];

        return view('admin/show_has_conditions', $data);
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
            'id_conditions' => $this->request->getVar('id_conditions'),
            'id_jobs' => $this->request->getVar('id_jobs'),
        ];
        $rules = [
            'id_jobs' => [
                'rules' => 'numeric|required',
                'errors' => [
                    'required' => 'le code postale doit etre donnée',
                    'numeric' => 'il doit contenir que des chiffres',
                ]
            ],
            'id_conditions' => [
                'rules' => 'numeric|required',
                'errors' => [
                    'required' => 'le code postale doit etre donnée',
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
            'id_conditions' => $this->request->getVar('id_conditions'),
            'id_jobs' => $this->request->getVar('id_jobs'),
        ];
        $rules = [
            'id_conditions' => [
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
