<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * EducationFieldOfStudySubs Controller
 *
 * @property \App\Model\Table\EducationFieldOfStudySubsTable $EducationFieldOfStudySubs
 */
class EducationFieldOfStudySubsController extends AppController
{

    public function beforeFilter(\Cake\Event\Event $event)
    {
        $this->Auth->allow(['getNamesEnByNarrowField', 'getNamesAraByNarrowField']);
    }

    public function getNamesEnByNarrowField($educationIscedNarrowFieldId = null)
    { 
        $data = array();
        $this->viewBuilder()->layout('ajax');
        $this->response->type('application/json');

        $data = $this->EducationFieldOfStudySubs->find()
            ->select(['name_en', 'id'])
            ->where(['education_isced_narrow_field_id' => $educationIscedNarrowFieldId])
            ->order(['name_en' => 'ASC']);

        $this->set('data',$data);
        $this->render('/Element/ajaxreturn');   
    }

    public function getNamesAraByNarrowField($educationIscedNarrowFieldId = null)
    { 
        $data = array();
        $this->viewBuilder()->layout('ajax');
        $this->response->type('application/json');

        $data = $this->EducationFieldOfStudySubs->find()
            ->select(['name_ara', 'id'])
            ->where(['education_isced_narrow_field_id' => $educationIscedNarrowFieldId])
            ->order(['name_ara' => 'ASC']);

        $this->set('data',$data);
        $this->set('_serialize', ['data']);
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
            'contain' => ['EducationFieldOfStudyCores', 'EducationIscedNarrowFields']
        ];
        $educationFieldOfStudySubs = $this->paginate($this->EducationFieldOfStudySubs);

        $this->set(compact('educationFieldOfStudySubs'));
        $this->set('_serialize', ['educationFieldOfStudySubs']);
    }

    /**
     * View method
     *
     * @param string|null $id Education Field Of Study Sub id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $educationFieldOfStudySub = $this->EducationFieldOfStudySubs->get($id, [
            'contain' => ['EducationFieldOfStudyCores', 'EducationIscedNarrowFields', 'ApplicantDesiredEducations']
        ]);

        $this->set('educationFieldOfStudySub', $educationFieldOfStudySub);
        $this->set('_serialize', ['educationFieldOfStudySub']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $educationFieldOfStudySub = $this->EducationFieldOfStudySubs->newEntity();
        if ($this->request->is('post')) {
            $educationFieldOfStudySub = $this->EducationFieldOfStudySubs->patchEntity($educationFieldOfStudySub, $this->request->data);
            if ($this->EducationFieldOfStudySubs->save($educationFieldOfStudySub)) {
                $this->Flash->success(__('The education field of study sub has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The education field of study sub could not be saved. Please, try again.'));
            }
        }
        $educationFieldOfStudyCores = $this->EducationFieldOfStudySubs->EducationFieldOfStudyCores->find('list', ['limit' => 200]);
        $educationIscedNarrowFields = $this->EducationFieldOfStudySubs->EducationIscedNarrowFields->find('list', ['limit' => 200]);
        $this->set(compact('educationFieldOfStudySub', 'educationFieldOfStudyCores', 'educationIscedNarrowFields'));
        $this->set('_serialize', ['educationFieldOfStudySub']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Education Field Of Study Sub id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $educationFieldOfStudySub = $this->EducationFieldOfStudySubs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $educationFieldOfStudySub = $this->EducationFieldOfStudySubs->patchEntity($educationFieldOfStudySub, $this->request->data);
            if ($this->EducationFieldOfStudySubs->save($educationFieldOfStudySub)) {
                $this->Flash->success(__('The education field of study sub has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The education field of study sub could not be saved. Please, try again.'));
            }
        }
        $educationFieldOfStudyCores = $this->EducationFieldOfStudySubs->EducationFieldOfStudyCores->find('list', ['limit' => 200]);
        $educationIscedNarrowFields = $this->EducationFieldOfStudySubs->EducationIscedNarrowFields->find('list', ['limit' => 200]);
        $this->set(compact('educationFieldOfStudySub', 'educationFieldOfStudyCores', 'educationIscedNarrowFields'));
        $this->set('_serialize', ['educationFieldOfStudySub']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Education Field Of Study Sub id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $educationFieldOfStudySub = $this->EducationFieldOfStudySubs->get($id);
        if ($this->EducationFieldOfStudySubs->delete($educationFieldOfStudySub)) {
            $this->Flash->success(__('The education field of study sub has been deleted.'));
        } else {
            $this->Flash->error(__('The education field of study sub could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
