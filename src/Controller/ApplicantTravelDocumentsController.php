<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * ApplicantTravelDocuments Controller
 *
 * @property \App\Model\Table\ApplicantTravelDocumentsTable $ApplicantTravelDocuments
 */
class ApplicantTravelDocumentsController extends AppController
{


    public function isAuthorized($user = null){
        // Only the owner can edit and view
        if (in_array($this->request->action, ['edit', 'delete'])) {
            $applicantTravelDocumentId = (int)$this->request->params['pass'][0];
            if ($this->ApplicantTravelDocuments->isOwnedBy($applicantTravelDocumentId, $user['id'])) {
                return true;
            }
        }

        if (in_array($this->request->action, ['add']) && $this->Auth->user('role') == 'applicant') {
            return true;
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
    //         'contain' => ['Users', 'Countries']
    //     ];
    //     $applicantTravelDocuments = $this->paginate($this->ApplicantTravelDocuments);

    //     $this->set(compact('applicantTravelDocuments'));
    //     $this->set('_serialize', ['applicantTravelDocuments']);
    // }

    /**
     * View method
     *
     * @param string|null $id Applicant Travel Document id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    // public function view($id = null)
    // {
    //     $applicantTravelDocument = $this->ApplicantTravelDocuments->get($id, [
    //         'contain' => ['Users', 'Countries']
    //     ]);

    //     $this->set('applicantTravelDocument', $applicantTravelDocument);
    //     $this->set('_serialize', ['applicantTravelDocument']);
    // }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        $userId = $this->Auth->user('id');
        $applicantTravelDocument = $this->ApplicantTravelDocuments->newEntity();
        
        if ($this->request->is('post')) {
            $applicantTravelDocument = $this->ApplicantTravelDocuments->patchEntity($applicantTravelDocument, $this->request->data);
            $applicantTravelDocument['user_id'] = $userId;
            //we need to check if a record with same user_id and country_id already exists
            if (!$this->ApplicantTravelDocuments->alreadyExists($applicantTravelDocument['country_id'], $applicantTravelDocument['user_id'])){
                if ($this->ApplicantTravelDocuments->save($applicantTravelDocument)) {
                    $applicantGenerals = TableRegistry::get('ApplicantGenerals');
                    $applicantGeneral = $applicantGenerals
                        ->find()
                        ->where(['user_id' => $userId])
                        ->first();

                    $this->Flash->success(__('The record has been saved.'));
                    return $this->redirect(['controller' => 'ApplicantGenerals','action' => 'view', $applicantGeneral->id ]);
                } else {
                    $this->Flash->error(__('The record could not be saved. Please, try again.'));
                }
            } else {
                    $this->Flash->error(__('The record already exists. Please, try again.'));
            }
        }
        
        $session = $this->request->session();
        $lang = $session->read('System.language.code');
        if ($lang == 'en_US'){
            $countries = TableRegistry::get('Countries')->find('list', [
                'keyField' => 'id', 
                'valueField' => 'name_en', 
                'order' => array('name_en' => 'ASC')
                ])->toArray();
        }
        else {
            $countries = TableRegistry::get('Countries')->find('list', [
                'keyField' => 'id',
                'valueField' => 'name_ara',
                'order' => array('name_ara' => 'ASC')
                ])->toArray();
        }

        $this->set(compact('applicantTravelDocument', 'countries'));
        $this->set('_serialize', ['applicantTravelDocument']);

        $ApplicantMenu = $this->MenuBuilder->buildApplicantMenu('applicant_menu_general', $userId);
        $this->set('menu_tabs_builder', $ApplicantMenu);
    }

    /**
     * Edit method
     *
     * @param string|null $id Applicant Travel Document id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userId = $this->Auth->user('id');
        $applicantTravelDocument = $this->ApplicantTravelDocuments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $applicantTravelDocument = $this->ApplicantTravelDocuments->patchEntity($applicantTravelDocument, $this->request->data);
            $applicantTravelDocument['user_id'] = $userId;
            if (!$this->ApplicantTravelDocuments->alreadyExists($applicantTravelDocument['country_id'], $applicantTravelDocument['user_id'])){
                if ($this->ApplicantTravelDocuments->save($applicantTravelDocument)) {
                    $applicantGenerals = TableRegistry::get('ApplicantGenerals');
                    $applicantGeneral = $applicantGenerals
                            ->find()
                            ->where(['user_id' => $userId])
                            ->first();
                    $this->Flash->success(__('The record has been saved.'));
                    return $this->redirect(['controller' => 'ApplicantGenerals','action' => 'view', $applicantGeneral->id ]);
                } else {
                    $this->Flash->error(__('The record could not be saved. Please, try again.'));
                }
            } else {
                $this->Flash->error(__('The record already exists. Please, try again.'));
            }
        }

        $session = $this->request->session();
        $lang = $session->read('System.language.code');
        if ($lang == 'en_US'){
            $countries = TableRegistry::get('Countries')->find('list', [
                'keyField' => 'id', 
                'valueField' => 'name_en', 
                'order' => array('name_en' => 'ASC')
                ])->toArray();
        }
        else {
            $countries = TableRegistry::get('Countries')->find('list', [
                'keyField' => 'id',
                'valueField' => 'name_ara',
                'order' => array('name_ara' => 'ASC')
                ])->toArray();
        }
        
        //$countries = $this->ApplicantTravelDocuments->Countries->find('list', ['limit' => 200]);
        $this->set(compact('applicantTravelDocument', 'countries'));
        $this->set('_serialize', ['applicantTravelDocument']);

        $ApplicantMenu = $this->MenuBuilder->buildApplicantMenu('applicant_menu_general', $userId);
        $this->set('menu_tabs_builder', $ApplicantMenu);
    }

    /**
     * Delete method
     *
     * @param string|null $id Applicant Travel Document id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $userId = $this->Auth->user('id');
        $this->request->allowMethod(['post', 'delete']);
        $applicantTravelDocument = $this->ApplicantTravelDocuments->get($id);
        if ($this->ApplicantTravelDocuments->delete($applicantTravelDocument)) {
            $this->Flash->success(__('The record has been deleted.'));
        } else {
            $this->Flash->error(__('The record could not be deleted. Please, try again.'));
        }
        $applicantGenerals = TableRegistry::get('ApplicantGenerals');
        $applicantGeneral = $applicantGenerals
                ->find()
                ->where(['user_id' => $userId])
                ->first();
        return $this->redirect(['controller' => 'ApplicantGenerals','action' => 'view', $applicantGeneral->id ]);
    }


}
