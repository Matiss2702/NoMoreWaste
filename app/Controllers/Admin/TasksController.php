<?php

namespace App\Controllers\Admin;

use CodeIgniter\RESTful\ResourcePresenter;
use CodeIgniter\API\ResponseTrait;
use App\Models\BenevolesModel;
use CodeIgniter\I18n\Time;

class TasksController extends ResourcePresenter
{
    protected $modelName = 'App\Models\TasksModel';
    use ResponseTrait;
    /**
     * Present a view of resource objects
     *
     * @return mixed
     */
    public function index()
    {
        $BenevolesModel = new BenevolesModel();
        $session = \Config\Services::session();
        $data = [
            'title' => 'Tasks',
            'Tasks' => $this->model->findAll(),
            'id_benevoles' => $BenevolesModel->findAll(),
            'is_login' => $session->get('isLoggedIn'),
        ];
        return view('admin/tasks', $data);
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
        $data = [
            'title'=> 'Tasks',
            'Tasks' => $this->model->find($id),
            'id_benevoles' => $BenevolesModel->find($this->model->find($id)['id_benevoles'],),
            'is_login' => $session->get('isLoggedIn'),
        ];

        return view('admin/show_tasks', $data);
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
            'start' => $this->request->getVar('start'),
            'end' => $this->request->getVar('end'),
            'place_start' => $this->request->getVar('place_start'),
            'description' => $this->request->getVar('description'),
            'id_benevoles' => $this->request->getVar('id_benevoles'),
        ];
        $rules = [
            'start' => [
                'rules' => 'required|apha_numeric_spaces|min_length[3]|max_length[30]',
                'errors' => [
                    'required' => 'le debut est requis',
                    'apha_numeric_spaces' => 'le debut doit contenir des lettres espace et nombre',
                    'min_length' => 'le debut doit contenir 3 caractere minimun',
                    'max_length' => ' le debut doit contenir 30 caractere maximun',
                ]
            ],
            'end' => [
                'rules' => 'required|apha_numeric_spaces|min_length[3]|max_length[30]',
                'errors' =>  [
                    'required' => 'la fin est requis',
                    'apha_numeric_spaces' => 'la fin doit contenir que des lettres espace et nombre',
                    'min_length' => 'la fin doit contenir 3 caractere minimun',
                    'max_length' => ' la fin doit contenir 30 caractere maximun',
                ]
            ],
            'place_start' => [
                'rules' => 'required|alpha|min_length[3]|max_length[10]',
                'errors' => [
                    'required' => 'le nom est requis',
                    'alpha' => 'le nom doit contenir que des lettres',
                    'min_length' => 'le nom doit contenir 3 caractere minimun',
                    'max_length' => ' le nom doit contenir 10 caractere maximun',
                ]
            ],
            'description' => [
                'rules' => 'required|alpha|min_length[3]|max_length[10]',
                'errors' => [
                    'required' => 'le nom est requis',
                    'alpha' => 'le nom doit contenir que des lettres',
                    'min_length' => 'le nom doit contenir 3 caractere minimun',
                    'max_length' => ' le nom doit contenir 10 caractere maximun',
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

        $this->model->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'tache creer avec success'
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
            'start' => $this->request->getVar('start'),
            'end' => $this->request->getVar('end'),
            'place_start' => $this->request->getVar('place_start'),
            'description' => $this->request->getVar('description'),
            'id_benevoles' => $this->request->getVar('id_benevoles'),
            // 'modified_at' => Time::now()->toDateTimeString(),
        ];
        $rules = [
            'start' => [
                'rules' =>'required|alpha_numeric_space|min_length[3]|max_length[30]',
                'errors' => [
                    'required' => 'le debut est requis',
                    'alpha_numeric_space' => 'le debut ne doit pas contenir de caractere spéciaux',
                    'min_length' => 'le debut doit contenir 3 caractere minimun',
                    'max_length' => ' le debut doit contenir 30 caractere maximun',
                ]
            ],
            'end' => [
                'rules' =>'required|alpha_numeric_space|min_length[3]|max_length[30]',
                'errors' =>  [
                    'required' => 'la fin est requis',
                    'alpha_numeric_space' => 'la fin ne doit pas contenir de caractere spéciaux' ,
                    'min_length' => 'la fin doit contenir 3 caractere minimun',
                    'max_length' => 'la fin doit contenir 30 caractere maximun',
                ]
            ],
            'place_start' => [
                'rules' =>'required|alpha_numeric_space|min_length[3]|max_length[10]',
                'errors' => [
                    'required' => 'le nom est requis',
                    'alpha_numeric_space' => 'le nom ne doit pas contenir de caractere spéciaux',
                    'min_length' => 'le nom doit contenir 3 caractere minimun',
                    'max_length' => ' le nom doit contenir 10 caractere maximun',
                ]
            ],
            'description' => [
                'rules' =>'required|alpha_numeric_space|min_length[3]|max_length[10]',
                'errors' => [
                    'required' => 'le nom est requis',
                    'alpha_numeric_space' => 'le nom ne doit pas contenir de caractere spéciaux',
                    'min_length' => 'le nom doit contenir 3 caractere minimun',
                    'max_length' => ' le nom doit contenir 10 caractere maximun',
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
                'success' => 'tache modifier avec succès'
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
                    'success' => 'tache supprimé avec success'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('aucun tache trouver');
        }
    }
}
