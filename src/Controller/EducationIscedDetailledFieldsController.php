<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * EducationIscedDetailledFields Controller
 *
 * @property \App\Model\Table\EducationIscedDetailledFieldsTable $EducationIscedDetailledFields
 */
class EducationIscedDetailledFieldsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $educationIscedDetailledFields = $this->paginate($this->EducationIscedDetailledFields);

        $this->set(compact('educationIscedDetailledFields'));
        $this->set('_serialize', ['educationIscedDetailledFields']);
    }

    /**
     * View method
     *
     * @param string|null $id Education Isced Detailled Field id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $educationIscedDetailledField = $this->EducationIscedDetailledFields->get($id, [
            'contain' => []
        ]);

        $this->set('educationIscedDetailledField', $educationIscedDetailledField);
        $this->set('_serialize', ['educationIscedDetailledField']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $educationIscedDetailledField = $this->EducationIscedDetailledFields->newEntity();
        if ($this->request->is('post')) {
            $educationIscedDetailledField = $this->EducationIscedDetailledFields->patchEntity($educationIscedDetailledField, $this->request->data);
            if ($this->EducationIscedDetailledFields->save($educationIscedDetailledField)) {
                $this->Flash->success(__('The education isced detailled field has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The education isced detailled field could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('educationIscedDetailledField'));
        $this->set('_serialize', ['educationIscedDetailledField']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Education Isced Detailled Field id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $educationIscedDetailledField = $this->EducationIscedDetailledFields->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $educationIscedDetailledField = $this->EducationIscedDetailledFields->patchEntity($educationIscedDetailledField, $this->request->data);
            if ($this->EducationIscedDetailledFields->save($educationIscedDetailledField)) {
                $this->Flash->success(__('The education isced detailled field has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The education isced detailled field could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('educationIscedDetailledField'));
        $this->set('_serialize', ['educationIscedDetailledField']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Education Isced Detailled Field id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $educationIscedDetailledField = $this->EducationIscedDetailledFields->get($id);
        if ($this->EducationIscedDetailledFields->delete($educationIscedDetailledField)) {
            $this->Flash->success(__('The education isced detailled field has been deleted.'));
        } else {
            $this->Flash->error(__('The education isced detailled field could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
