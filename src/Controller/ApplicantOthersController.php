<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ApplicantOthers Controller
 *
 * @property \App\Model\Table\ApplicantOthersTable $ApplicantOthers
 */
class ApplicantOthersController extends AppController
{

    public function isAuthorized($user = null){
        // Only the owner can edit and view
        if (in_array($this->request->action, ['edit', 'view'])) {
            $applicanOtherId = (int)$this->request->params['pass'][0];
            if ($this->ApplicantOthers->isOwnedBy($applicanOtherId, $user['id'])) {
                return true;
            }
        }
        // user can add if no applicantEducation exists already for that user
        if (in_array($this->request->action, ['add'])) {
            if($this->ApplicantOthers->find('ownedBy', ['user_id' => $this->Auth->user('id')])->first() == null){
                return true;
            }   
        }
        return parent::isAuthorized($user);
    }


    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    // public function index()
    // {
    //     $this->paginate = [
    //         'contain' => ['Users', 'Countries', 'InstitutionHigherEducations', 'EducationFieldOfStudyCores']
    //     ];
    //     $applicantOthers = $this->paginate($this->ApplicantOthers);

    //     $this->set(compact('applicantOthers'));
    //     $this->set('_serialize', ['applicantOthers']);
    // }

    /**
     * View method
     *
     * @param string|null $id Applicant Other id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userId = $this->Auth->user('id');
        $applicantOther = $this->ApplicantOthers->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('applicantOther', $applicantOther);
        $this->set('_serialize', ['applicantOther']);

        $ApplicantMenu = $this->MenuBuilder->buildApplicantMenu('applicant_menu_other', $userId);
        $this->set('menu_tabs_builder', $ApplicantMenu);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userId = $this->Auth->user('id');
        $applicantOther = $this->ApplicantOthers->newEntity();
        if ($this->request->is('post')) {
            $applicantOther = $this->ApplicantOthers->patchEntity($applicantOther, $this->request->data);
            $applicantOther['user_id'] = $userId;
            if ($this->ApplicantOthers->save($applicantOther)) {
                $this->Flash->success(__('The record has been saved.'));
                return $this->redirect(['action' => 'view', $applicantOther->id]);
            } else {
                $this->Flash->error(__('The record could not be saved. Please, try again.'));
            }
        }
        //$users = $this->ApplicantOthers->Users->find('list', ['limit' => 200]);
        $this->set(compact('applicantOther'));
        $this->set('_serialize', ['applicantOther']);

        $ApplicantMenu = $this->MenuBuilder->buildApplicantMenu('applicant_menu_other', $userId);
        $this->set('menu_tabs_builder', $ApplicantMenu);

    }

    /**
     * Edit method
     *
     * @param string|null $id Applicant Other id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userId = $this->Auth->user('id');
        $applicantOther = $this->ApplicantOthers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $applicantOther = $this->ApplicantOthers->patchEntity($applicantOther, $this->request->data);
            $applicantOther['user_id'] = $userId;
            if ($this->ApplicantOthers->save($applicantOther)) {
                $this->Flash->success(__('The record has been saved.'));
                return $this->redirect(['action' => 'view', $applicantOther->id]);
            } else {
                $this->Flash->error(__('The record could not be saved. Please, try again.'));
            }
        }
        //$users = $this->ApplicantOthers->Users->find('list', ['limit' => 200]);
        $this->set(compact('applicantOther'));
        $this->set('_serialize', ['applicantOther']);

        $ApplicantMenu = $this->MenuBuilder->buildApplicantMenu('applicant_menu_other', $userId);
        $this->set('menu_tabs_builder', $ApplicantMenu);
    }

    /**
     * Delete method
     *
     * @param string|null $id Applicant Other id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $applicantOther = $this->ApplicantOthers->get($id);
        if ($this->ApplicantOthers->delete($applicantOther)) {
            $this->Flash->success(__('The record has been deleted.'));
        } else {
            $this->Flash->error(__('The record could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
