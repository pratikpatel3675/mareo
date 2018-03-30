<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * InstitutionHigherEducationFaculties Controller
 *
 * @property \App\Model\Table\InstitutionHigherEducationFacultiesTable $InstitutionHigherEducationFaculties
 */
class InstitutionHigherEducationFacultiesController extends AppController
{
    public function beforeFilter(\Cake\Event\Event $event)
    {
        $this->Auth->allow(['getNamesByInstitution']);
    }

    /**
     * AJAX method
     *
     */
    public function getNamesByInstitution($institutionId = null)
    { 
        $data = array();
        $this->viewBuilder()->layout('ajax');
        $this->response->type('application/json');

        $data = $this->InstitutionHigherEducationFaculties->find()
            ->select(['name', 'id'])
            ->where(['institution_higher_education_id' => $institutionId])
            ->order(['name' => 'ASC']);

        $this->set('data',$data);
        $this->render('/Element/ajaxreturn');   
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['InstitutionHigherEducations']
        ];
        $institutionHigherEducationFaculties = $this->paginate($this->InstitutionHigherEducationFaculties);

        $this->set(compact('institutionHigherEducationFaculties'));
        $this->set('_serialize', ['institutionHigherEducationFaculties']);
    }

    /**
     * View method
     *
     * @param string|null $id Institution Higher Education Faculty id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $institutionHigherEducationFaculty = $this->InstitutionHigherEducationFaculties->get($id, [
            'contain' => ['InstitutionHigherEducations', 'ApplicantEducations']
        ]);

        $this->set('institutionHigherEducationFaculty', $institutionHigherEducationFaculty);
        $this->set('_serialize', ['institutionHigherEducationFaculty']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $institutionHigherEducationFaculty = $this->InstitutionHigherEducationFaculties->newEntity();
        if ($this->request->is('post')) {
            $institutionHigherEducationFaculty = $this->InstitutionHigherEducationFaculties->patchEntity($institutionHigherEducationFaculty, $this->request->data);
            if ($this->InstitutionHigherEducationFaculties->save($institutionHigherEducationFaculty)) {
                $this->Flash->success(__('The institution higher education faculty has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The institution higher education faculty could not be saved. Please, try again.'));
            }
        }
        $institutionHigherEducations = $this->InstitutionHigherEducationFaculties->InstitutionHigherEducations->find('list', ['limit' => 200]);
        $this->set(compact('institutionHigherEducationFaculty', 'institutionHigherEducations'));
        $this->set('_serialize', ['institutionHigherEducationFaculty']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Institution Higher Education Faculty id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $institutionHigherEducationFaculty = $this->InstitutionHigherEducationFaculties->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $institutionHigherEducationFaculty = $this->InstitutionHigherEducationFaculties->patchEntity($institutionHigherEducationFaculty, $this->request->data);
            if ($this->InstitutionHigherEducationFaculties->save($institutionHigherEducationFaculty)) {
                $this->Flash->success(__('The institution higher education faculty has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The institution higher education faculty could not be saved. Please, try again.'));
            }
        }
        $institutionHigherEducations = $this->InstitutionHigherEducationFaculties->InstitutionHigherEducations->find('list', ['limit' => 200]);
        $this->set(compact('institutionHigherEducationFaculty', 'institutionHigherEducations'));
        $this->set('_serialize', ['institutionHigherEducationFaculty']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Institution Higher Education Faculty id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $institutionHigherEducationFaculty = $this->InstitutionHigherEducationFaculties->get($id);
        if ($this->InstitutionHigherEducationFaculties->delete($institutionHigherEducationFaculty)) {
            $this->Flash->success(__('The institution higher education faculty has been deleted.'));
        } else {
            $this->Flash->error(__('The institution higher education faculty could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
