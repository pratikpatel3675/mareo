<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ApplicantDesiredEducationTypes Controller
 *
 * @property \App\Model\Table\ApplicantDesiredEducationTypesTable $ApplicantDesiredEducationTypes
 */
class ApplicantDesiredEducationTypesController extends AppController
{

    public function isAuthorized($user = null){
        // Only the owner can edit and view
        if (in_array($this->request->action, ['delete'])) {
            $applicantDesiredEducationTypeId = (int)$this->request->params['pass'][0];
            if ($this->ApplicantDesiredEducationTypes->isOwnedBy($applicantDesiredEducationTypeId, $user['id'])) {
                return true;
            }
        }
        if (in_array($this->request->action, ['add']) && $this->Auth->user('role') == 'applicant') {
            return true;
        }
        return parent::isAuthorized($user);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userId = $this->Auth->user('id');
        $applicantDesiredEducationType = $this->ApplicantDesiredEducationTypes->newEntity();
        if ($this->request->is('post')) {
            $applicantDesiredEducationType = $this->ApplicantDesiredEducationTypes->patchEntity($applicantDesiredEducationType, $this->request->data);
            $applicantDesiredEducationType['user_id'] = $userId;
            if (!$this->ApplicantDesiredEducationTypes->alreadyExists($applicantDesiredEducationType['education_desired_type_id'], $applicantDesiredEducationType['user_id'])) {
                if ($this->ApplicantDesiredEducationTypes->save($applicantDesiredEducationType)) {
                    $this->Flash->success(__('The record type has been saved.'));
                    return $this->redirect(['controller' => 'ApplicantEducationNeeds','action' => 'view', $applicantDesiredEducationType['user_id']]);
                } else {
                    $this->Flash->error(__('The record could not be saved. Please, try again.'));
                }
            } else {
                $this->Flash->error(__('The record already exists. Please, try again.'));
            }
        }
        
        $educationDesiredTypes = $this->ApplicantDesiredEducationTypes->EducationDesiredTypes->find('list', ['limit' => 200]);
        $this->set(compact('applicantDesiredEducationType', 'educationDesiredTypes'));
        $this->set('_serialize', ['applicantDesiredEducationType']);

        $ApplicantMenu = $this->MenuBuilder->buildApplicantMenu('applicant_menu_education_needs', $userId);
        $this->set('menu_tabs_builder', $ApplicantMenu);
    }

    /**
     * Delete method
     *
     * @param string|null $id Applicant Desired Education Type id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $userId = $this->Auth->user('id');
        $this->request->allowMethod(['post', 'delete']);
        $applicantDesiredEducationType = $this->ApplicantDesiredEducationTypes->get($id);
        if ($this->ApplicantDesiredEducationTypes->delete($applicantDesiredEducationType)) {
            $this->Flash->success(__('The applicant desired education type has been deleted.'));
        } else {
            $this->Flash->error(__('The record could not be deleted. Please, try again.'));
        }
        return $this->redirect(['controller' => 'ApplicantEducationNeeds','action' => 'view', $userId]);
    }
}
