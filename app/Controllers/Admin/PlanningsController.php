<?php

namespace App\Controllers\Admin;

use CodeIgniter\RESTful\ResourcePresenter;
use CodeIgniter\API\ResponseTrait;
use App\Models\BenevolesModel;
use App\Models\DisponibilitysModel;
use CodeIgniter\I18n\Time;

class PlanningsController extends ResourcePresenter
{
    protected $modelName = 'App\Models\PlanningsModel';
    use ResponseTrait;
    /**
     * Present a view of resource objects
     *
     * @return mixed
     */
    public function index()
    {
        $BenevolesModel = new BenevolesModel();
        $DisponibilitysModel = new DisponibilitysModel();
        $session = \Config\Services::session();
        $data = [
            'title' => 'utilisater',
            'plannings' => $this->model->findAll(),
            'id_benevoles' => $BenevolesModel->findAll(),
            'id_disponibilitys' => $DisponibilitysModel->findAll(),
            'is_login' => $session->get('isLoggedIn'),
        ];
        return view('admin/plannings', $data);
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
        $BenevolesModel = new BenevolesModel();
        $DisponibilitysModel = new DisponibilitysModel();
        $data = [
            'title'=> 'planning',
            'Plannings' => $this->model->find($id),
            'id_benevoles' => $BenevolesModel->find($this->model->find($id)['id_benevoles'],),
            'id_disponibilitys' => $DisponibilitysModel->find($this->model->find($id)['id_disponibilitys'],),
            'is_login' => $session->get('isLoggedIn'),
        ];

        return view('admin/show_plannnings', $data);
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
            'id_benevoles' => $this->request->getVar('id_benevoles'),
            'id_disponibilitys' => $this->request->getVar('id_disponibilitys'),
        ];
        $rules = [
            'id_benevoles' => [
                'rules' => 'numeric|required',
                'errors' => [
                    'required' => 'le code postale doit etre donnée',
                    'numeric' => 'il doit contenir que des chiffres',
                ]
            ],
            'id_disponibilitys' => [
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
                'success' => 'planning creer avec success'
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
            'id_disponibilitys' => $this->request->getVar('id_disponibilitys'),
            'id_benevoles' => $this->request->getVar('id_benevoles'),
        ];
        $rules = [
            'id_disponibilitys' => [
                'rules' => 'numeric|required',
                'errors' => [
                    'required' => 'le code postale doit etre donnée',
                    'numeric' => 'il doit contenir que des chiffres',
                ]
            ],
            'id_benevoles' => [
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
                'success' => 'planning modifier avec succès'
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
                    'success' => 'planning supprimé avec success'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('aucun planning trouver');
        }
    }
}
