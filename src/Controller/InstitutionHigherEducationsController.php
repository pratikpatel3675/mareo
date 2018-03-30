<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * InstitutionHigherEducations Controller
 *
 * @property \App\Model\Table\InstitutionHigherEducationsTable $InstitutionHigherEducations
 */
class InstitutionHigherEducationsController extends AppController
{

    public function beforeFilter(\Cake\Event\Event $event)
    {
        $this->Auth->allow(['getNamesByCountry']);
    }


    /**
     * AJAX getByCountry method
     *
     * @param string|null $id Country id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function getNamesByCountry($countryId = null)
    { 
        $data = array();
        $this->viewBuilder()->layout('ajax');
        //$this->layout='ajax';
        $this->response->type('application/json');

        $data = $this->InstitutionHigherEducations->find()
            ->select(['name', 'id'])
            ->contain(['InstitutionHigherEducationFaculties' => function ($q) {
                    return $q
                    ->select(['name', 'institution_higher_education_id']);
            }
            ])
            ->where(['country_id' => $countryId])
            ->andWhere(['institution_type_id' => 1])
            ->andWhere(['status' => 1])
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
            'contain' => ['Countries', 'InstitutionTypes']
        ];
        $institutionHigherEducations = $this->paginate($this->InstitutionHigherEducations);

        $this->set(compact('institutionHigherEducations'));
        $this->set('_serialize', ['institutionHigherEducations']);
    }

    /**
     * View method
     *
     * @param string|null $id Institution Higher Education id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $institutionHigherEducation = $this->InstitutionHigherEducations->get($id, [
            'contain' => ['Countries', 'InstitutionTypes', 'ApplicantEducations', 'ApplicantOthers', 'InstitutionHigherEducationDegrees', 'InstitutionHigherEducationFaculties']
        ]);

        $this->set('institutionHigherEducation', $institutionHigherEducation);
        $this->set('_serialize', ['institutionHigherEducation']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $institutionHigherEducation = $this->InstitutionHigherEducations->newEntity();
        if ($this->request->is('post')) {
            $institutionHigherEducation = $this->InstitutionHigherEducations->patchEntity($institutionHigherEducation, $this->request->data);
            if ($this->InstitutionHigherEducations->save($institutionHigherEducation)) {
                $this->Flash->success(__('The institution higher education has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The institution higher education could not be saved. Please, try again.'));
            }
        }
        $countries = $this->InstitutionHigherEducations->Countries->find('list', ['limit' => 200]);
        $institutionTypes = $this->InstitutionHigherEducations->InstitutionTypes->find('list', ['limit' => 200]);
        $this->set(compact('institutionHigherEducation', 'countries', 'institutionTypes'));
        $this->set('_serialize', ['institutionHigherEducation']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Institution Higher Education id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $institutionHigherEducation = $this->InstitutionHigherEducations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $institutionHigherEducation = $this->InstitutionHigherEducations->patchEntity($institutionHigherEducation, $this->request->data);
            if ($this->InstitutionHigherEducations->save($institutionHigherEducation)) {
                $this->Flash->success(__('The institution higher education has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The institution higher education could not be saved. Please, try again.'));
            }
        }
        $countries = $this->InstitutionHigherEducations->Countries->find('list', ['limit' => 200]);
        $institutionTypes = $this->InstitutionHigherEducations->InstitutionTypes->find('list', ['limit' => 200]);
        $this->set(compact('institutionHigherEducation', 'countries', 'institutionTypes'));
        $this->set('_serialize', ['institutionHigherEducation']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Institution Higher Education id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $institutionHigherEducation = $this->InstitutionHigherEducations->get($id);
        if ($this->InstitutionHigherEducations->delete($institutionHigherEducation)) {
            $this->Flash->success(__('The institution higher education has been deleted.'));
        } else {
            $this->Flash->error(__('The institution higher education could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
