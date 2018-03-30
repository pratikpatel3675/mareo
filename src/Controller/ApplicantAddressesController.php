<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ApplicantAddresses Controller
 *
 * @property \App\Model\Table\ApplicantAddressesTable $ApplicantAddresses
 */
class ApplicantAddressesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function isAuthorized($user = null){
        // Only the owner can edit and view
        if (in_array($this->request->action, ['edit', 'view'])) {
            $applicantAddressId = (int)$this->request->params['pass'][0];
            if ($this->ApplicantAddresses->isOwnedBy($applicantAddressId, $user['id'])) {
                return true;
            }
        }
        // user can add if no applicantGeneral exists already for that user
        if (in_array($this->request->action, ['add'])) {
            if($this->ApplicantAddresses->find('ownedBy', ['user_id' => $this->Auth->user('id')])->first() == null){
                return true;
            }   
        }
        return parent::isAuthorized($user);
    }


    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Countries']
        ];
        $applicantAddresses = $this->paginate($this->ApplicantAddresses);

        $this->set(compact('applicantAddresses'));
        $this->set('_serialize', ['applicantAddresses']);
    }

    /**
     * View method
     *
     * @param string|null $id Applicant Address id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $applicantAddress = $this->ApplicantAddresses->get($id, [
            'contain' => ['Users', 'Countries']
        ]);

        $this->set('applicantAddress', $applicantAddress);
        $this->set('_serialize', ['applicantAddress']);
    
        $ApplicantMenu = $this->MenuBuilder->buildApplicantMenu('applicant_menu_address', $applicantAddress->user->id);
        $this->set('MenuItems', $ApplicantMenu);
 


    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $applicantAddress = $this->ApplicantAddresses->newEntity();
        if ($this->request->is('post')) {
            $applicantAddress = $this->ApplicantAddresses->patchEntity($applicantAddress, $this->request->data);
            if ($this->ApplicantAddresses->save($applicantAddress)) {
                $this->Flash->success(__('The applicant address has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The applicant address could not be saved. Please, try again.'));
            }
        }
        $users = $this->ApplicantAddresses->Users->find('list', ['limit' => 200]);
        $countries = $this->ApplicantAddresses->Countries->find('list', ['limit' => 200]);
        $this->set(compact('applicantAddress', 'users', 'countries'));
        $this->set('_serialize', ['applicantAddress']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Applicant Address id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $applicantAddress = $this->ApplicantAddresses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $applicantAddress = $this->ApplicantAddresses->patchEntity($applicantAddress, $this->request->data);
            if ($this->ApplicantAddresses->save($applicantAddress)) {
                $this->Flash->success(__('The applicant address has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The applicant address could not be saved. Please, try again.'));
            }
        }
        $users = $this->ApplicantAddresses->Users->find('list', ['limit' => 200]);
        $countries = $this->ApplicantAddresses->Countries->find('list', ['limit' => 200]);
        $this->set(compact('applicantAddress', 'users', 'countries'));
        $this->set('_serialize', ['applicantAddress']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Applicant Address id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $applicantAddress = $this->ApplicantAddresses->get($id);
        if ($this->ApplicantAddresses->delete($applicantAddress)) {
            $this->Flash->success(__('The applicant address has been deleted.'));
        } else {
            $this->Flash->error(__('The applicant address could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
