<?php

namespace App\Controllers\Admin;

use CodeIgniter\RESTful\ResourcePresenter;
use CodeIgniter\API\ResponseTrait;
use App\Models\TasksModel;
use App\Models\JobsModel;
use CodeIgniter\I18n\Time;

class NecessitysController extends ResourcePresenter
{
    protected $modelName = 'App\Models\NecessitysModel';
    use ResponseTrait;
    /**
     * Present a view of resource objects
     *
     * @return mixed
     */
    public function index()
    {
        $TasksModel = new TasksModel();
        $JobsModel = new JobsModel();
        $session = \Config\Services::session();
        $data = [
            'title' => 'Necessitys',
            'necessitys' => $this->model->findAll(),
            'id_tasks' => $TasksModel->findAll(),
            'id_jobs' => $JobsModel->findAll(),
            'is_login' => $session->get('isLoggedIn'),
        ];
        return view('admin/necessitys', $data);
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
        $TasksModel = new TasksModel();
        $JobsModel = new JobsModel();
        $data = [
            'title'=> 'Necessitys',
            'necessitys' => $this->model->find($id),
            'id_tasks' => $TasksModel->find($this->model->find($id)['id_tasks'],),
            'id_jobs' => $JobsModel->find($this->model->find($id)['id_jobs'],),
            'is_login' => $session->get('isLoggedIn'),
        ];

        return view('admin/show_necessitys', $data);
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
            'id_tasks' => $this->request->getVar('id_tasks'),
            'id_jobs' => $this->request->getVar('id_jobs'),
        ];
        $rules = [
            'id_jobs' => [
                'rules' => 'numeric|required',
                'errors' => [
                    'required' => 'l\'id du metierdoit etre donnée',
                    'numeric' => 'il doit contenir que des chiffres',
                ]
            ],
            'id_tasks' => [
                'rules' => 'numeric|required',
                'errors' => [
                    'required' => 'l\' de la tache  doit etre donnée',
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
                'success' => 'necessité creer avec success'
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
            'id_tasks' => $this->request->getVar('id_tasks'),
            'id_jobs' => $this->request->getVar('id_jobs'),
        ];
        $rules = [
            'id_jobs' => [
                'rules' => 'numeric|required',
                'errors' => [
                    'required' => 'l\'id du metier doit etre donnée',
                    'numeric' => 'il doit contenir que des chiffres',
                ]
            ],
            'id_tasks' => [
                'rules' => 'numeric|required',
                'errors' => [
                    'required' => 'l\' de la tache doit etre donnée',
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
                'success' => 'necessité modifier avec succès'
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
                    'success' => 'necessité supprimé avec success'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('aucun necessité trouver');
        }
    }
}
