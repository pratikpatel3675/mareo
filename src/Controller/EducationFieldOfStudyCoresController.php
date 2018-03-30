<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * EducationFieldOfStudyCores Controller
 *
 * @property \App\Model\Table\EducationFieldOfStudyCoresTable $EducationFieldOfStudyCores
 */
class EducationFieldOfStudyCoresController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $educationFieldOfStudyCores = $this->paginate($this->EducationFieldOfStudyCores);

        $this->set(compact('educationFieldOfStudyCores'));
        $this->set('_serialize', ['educationFieldOfStudyCores']);
    }

    /**
     * View method
     *
     * @param string|null $id Education Field Of Study Core id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $educationFieldOfStudyCore = $this->EducationFieldOfStudyCores->get($id, [
            'contain' => ['ApplicantOthers', 'EducationFieldOfStudySubs', 'EducationIscedDetailedFields', 'EducationIscedNarrowFields']
        ]);

        $this->set('educationFieldOfStudyCore', $educationFieldOfStudyCore);
        $this->set('_serialize', ['educationFieldOfStudyCore']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $educationFieldOfStudyCore = $this->EducationFieldOfStudyCores->newEntity();
        if ($this->request->is('post')) {
            $educationFieldOfStudyCore = $this->EducationFieldOfStudyCores->patchEntity($educationFieldOfStudyCore, $this->request->data);
            if ($this->EducationFieldOfStudyCores->save($educationFieldOfStudyCore)) {
                $this->Flash->success(__('The education field of study core has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The education field of study core could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('educationFieldOfStudyCore'));
        $this->set('_serialize', ['educationFieldOfStudyCore']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Education Field Of Study Core id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $educationFieldOfStudyCore = $this->EducationFieldOfStudyCores->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $educationFieldOfStudyCore = $this->EducationFieldOfStudyCores->patchEntity($educationFieldOfStudyCore, $this->request->data);
            if ($this->EducationFieldOfStudyCores->save($educationFieldOfStudyCore)) {
                $this->Flash->success(__('The education field of study core has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The education field of study core could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('educationFieldOfStudyCore'));
        $this->set('_serialize', ['educationFieldOfStudyCore']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Education Field Of Study Core id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $educationFieldOfStudyCore = $this->EducationFieldOfStudyCores->get($id);
        if ($this->EducationFieldOfStudyCores->delete($educationFieldOfStudyCore)) {
            $this->Flash->success(__('The education field of study core has been deleted.'));
        } else {
            $this->Flash->error(__('The education field of study core could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
