<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * EducationIscedNarrowFields Controller
 *
 * @property \App\Model\Table\EducationIscedNarrowFieldsTable $EducationIscedNarrowFields
 */
class EducationIscedNarrowFieldsController extends AppController
{

    public function beforeFilter(\Cake\Event\Event $event)
    {
        $this->Auth->allow(['getNamesEnByCores', 'getNamesAraByCores']);
    }

    public function getNamesEnByCores($educationFieldOfStudyCoreId = null)
    { 
        $data = array();
        $this->viewBuilder()->layout('ajax');
        $this->response->type('application/json');

        $data = $this->EducationIscedNarrowFields->find()
            ->select(['name_en', 'id'])
            ->where(['education_field_of_study_core_id' => $educationFieldOfStudyCoreId])
            ->order(['name_en' => 'ASC']);

        $this->set('data',$data);
        $this->set('_serialize', ['data']);
        $this->render('/Element/ajaxreturn');   
    }

    public function getNamesAraByCores($educationFieldOfStudyCoreId = null)
    { 
        $data = array();
        $this->viewBuilder()->layout('ajax');
        $this->response->type('application/json');

        $data = $this->EducationIscedNarrowFields->find()
            ->select(['name_ara', 'id'])
            ->where(['education_field_of_study_core_id' => $educationFieldOfStudyCoreId])
            ->order(['name_ara' => 'ASC']);

        $this->set('_serialize', ['data']);
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
            'contain' => ['EducationFieldOfStudyCores']
        ];
        $educationIscedNarrowFields = $this->paginate($this->EducationIscedNarrowFields);

        $this->set(compact('educationIscedNarrowFields'));
        $this->set('_serialize', ['educationIscedNarrowFields']);
    }

    /**
     * View method
     *
     * @param string|null $id Education Isced Narrow Field id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $educationIscedNarrowField = $this->EducationIscedNarrowFields->get($id, [
            'contain' => ['EducationFieldOfStudyCores', 'ApplicantEducations', 'EducationFieldOfStudySubs', 'EducationIscedDetailedFields', 'InstitutionHigherEducationCourses']
        ]);

        $this->set('educationIscedNarrowField', $educationIscedNarrowField);
        $this->set('_serialize', ['educationIscedNarrowField']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $educationIscedNarrowField = $this->EducationIscedNarrowFields->newEntity();
        if ($this->request->is('post')) {
            $educationIscedNarrowField = $this->EducationIscedNarrowFields->patchEntity($educationIscedNarrowField, $this->request->data);
            if ($this->EducationIscedNarrowFields->save($educationIscedNarrowField)) {
                $this->Flash->success(__('The education isced narrow field has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The education isced narrow field could not be saved. Please, try again.'));
            }
        }
        $educationFieldOfStudyCores = $this->EducationIscedNarrowFields->EducationFieldOfStudyCores->find('list', ['limit' => 200]);
        $this->set(compact('educationIscedNarrowField', 'educationFieldOfStudyCores'));
        $this->set('_serialize', ['educationIscedNarrowField']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Education Isced Narrow Field id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $educationIscedNarrowField = $this->EducationIscedNarrowFields->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $educationIscedNarrowField = $this->EducationIscedNarrowFields->patchEntity($educationIscedNarrowField, $this->request->data);
            if ($this->EducationIscedNarrowFields->save($educationIscedNarrowField)) {
                $this->Flash->success(__('The education isced narrow field has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The education isced narrow field could not be saved. Please, try again.'));
            }
        }
        $educationFieldOfStudyCores = $this->EducationIscedNarrowFields->EducationFieldOfStudyCores->find('list', ['limit' => 200]);
        $this->set(compact('educationIscedNarrowField', 'educationFieldOfStudyCores'));
        $this->set('_serialize', ['educationIscedNarrowField']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Education Isced Narrow Field id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $educationIscedNarrowField = $this->EducationIscedNarrowFields->get($id);
        if ($this->EducationIscedNarrowFields->delete($educationIscedNarrowField)) {
            $this->Flash->success(__('The education isced narrow field has been deleted.'));
        } else {
            $this->Flash->error(__('The education isced narrow field could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
