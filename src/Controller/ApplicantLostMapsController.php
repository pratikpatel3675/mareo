<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ApplicantLostMaps Controller
 *
 * @property \App\Model\Table\ApplicantLostMapsTable $ApplicantLostMaps
 */
class ApplicantLostMapsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['LostItems', 'Countries', 'Maps']
        ];
        $applicantLostMaps = $this->paginate($this->ApplicantLostMaps);

        $this->set(compact('applicantLostMaps'));
        $this->set('_serialize', ['applicantLostMaps']);
    }

    /**
     * View method
     *
     * @param string|null $id Applicant Lost Map id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $applicantLostMap = $this->ApplicantLostMaps->get($id, [
            'contain' => ['LostItems', 'Countries', 'Maps']
        ]);

        $this->set('applicantLostMap', $applicantLostMap);
        $this->set('_serialize', ['applicantLostMap']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $applicantLostMap = $this->ApplicantLostMaps->newEntity();
        if ($this->request->is('post')) {
            $applicantLostMap = $this->ApplicantLostMaps->patchEntity($applicantLostMap, $this->request->data);
            if ($this->ApplicantLostMaps->save($applicantLostMap)) {
                $this->Flash->success(__('The applicant lost map has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The applicant lost map could not be saved. Please, try again.'));
            }
        }
        $lostItems = $this->ApplicantLostMaps->LostItems->find('list', ['limit' => 200]);
        $countries = $this->ApplicantLostMaps->Countries->find('list', ['limit' => 200]);
        $maps = $this->ApplicantLostMaps->Maps->find('list', ['limit' => 200]);
        $this->set(compact('applicantLostMap', 'lostItems', 'countries', 'maps'));
        $this->set('_serialize', ['applicantLostMap']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Applicant Lost Map id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $applicantLostMap = $this->ApplicantLostMaps->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $applicantLostMap = $this->ApplicantLostMaps->patchEntity($applicantLostMap, $this->request->data);
            if ($this->ApplicantLostMaps->save($applicantLostMap)) {
                $this->Flash->success(__('The applicant lost map has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The applicant lost map could not be saved. Please, try again.'));
            }
        }
        $lostItems = $this->ApplicantLostMaps->LostItems->find('list', ['limit' => 200]);
        $countries = $this->ApplicantLostMaps->Countries->find('list', ['limit' => 200]);
        $maps = $this->ApplicantLostMaps->Maps->find('list', ['limit' => 200]);
        $this->set(compact('applicantLostMap', 'lostItems', 'countries', 'maps'));
        $this->set('_serialize', ['applicantLostMap']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Applicant Lost Map id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $applicantLostMap = $this->ApplicantLostMaps->get($id);
        if ($this->ApplicantLostMaps->delete($applicantLostMap)) {
            $this->Flash->success(__('The applicant lost map has been deleted.'));
        } else {
            $this->Flash->error(__('The applicant lost map could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
