<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * ApplicantDesiredEducations Controller
 *
 * @property \App\Model\Table\ApplicantDesiredEducationsTable $ApplicantDesiredEducations
 */
class ApplicantDesiredEducationsController extends AppController
{

    public function isAuthorized($user = null){
        // Only the owner can edit and view
        if (in_array($this->request->action, ['delete'])) {
            $applicantDesiredEducationId = (int)$this->request->params['pass'][0];
            if ($this->ApplicantDesiredEducations->isOwnedBy($applicantDesiredEducationId, $user['id'])) {
                return true;
            }
        }
        if (in_array($this->request->action, ['add']) && $this->Auth->user('role') == 'applicant') {
            return true;
        }
        return parent::isAuthorized($user);
    }


    public function add()
    {
        $userId = $this->Auth->user('id');
        $applicantDesiredEducation = $this->ApplicantDesiredEducations->newEntity();
        if ($this->request->is('post')) {
            $applicantDesiredEducation = $this->ApplicantDesiredEducations->patchEntity($applicantDesiredEducation, $this->request->data);
            $applicantDesiredEducation['user_id'] = $userId;
            if (!$this->ApplicantDesiredEducations->alreadyExists($applicantDesiredEducation['education_field_of_study_sub_id'], $applicantDesiredEducation['user_id'])) {
                // we authorize 5 records only for this user
                if ($this->ApplicantDesiredEducations->find()->where(['user_id' => $userId])->count() < 5) {
                    if ($this->ApplicantDesiredEducations->save($applicantDesiredEducation)) {
                        $this->Flash->success(__('The record has been saved.'));
                        return $this->redirect(['controller' => 'ApplicantEducationNeeds','action' => 'view', $userId]);
                    } else {
                        $this->Flash->error(__('The record could not be saved. Please, try again.'));
                    }
                } else {
                    $this->Flash->error(__('You can not save more than 5 records.'));
                }

            } else {
                $this->Flash->error(__('The record already exists. Please, try again.'));
            }
        }
        
        $session = $this->request->session();
        $lang = $session->read('System.language.code');
        if ($lang == 'en_US'){
            $educationFieldOfStudyCores = TableRegistry::get('EducationFieldOfStudyCores')->find('list', [
                'keyField' => 'id', 
                'valueField' => 'name_en', 
                'order' => array('name_en' => 'ASC')
                ])->toArray();
            $educationIscedNarrowFields = TableRegistry::get('EducationIscedNarrowFields')->find('list', [
                'keyField' => 'id', 
                'valueField' => 'name_en', 
                'order' => array('name_en' => 'ASC')
                ])->toArray();
        }
        else {
            $educationFieldOfStudyCores = TableRegistry::get('EducationFieldOfStudyCores')->find('list', [
                'keyField' => 'id',
                'valueField' => 'name_ara',
                'order' => array('name_ara' => 'ASC')
                ])->toArray();
            $educationIscedNarrowFields = TableRegistry::get('EducationIscedNarrowFields')->find('list', [
                'keyField' => 'id', 
                'valueField' => 'name_en', 
                'order' => array('name_en' => 'ASC')
                ])->toArray();
        }

        //$users = $this->ApplicantDesiredEducations->Users->find('list', ['limit' => 200]);
        
        $educationFieldOfStudySubs = $this->ApplicantDesiredEducations->EducationFieldOfStudySubs->find('list', ['limit' => 200]);
        $this->set(compact('applicantDesiredEducation', 'users', 'educationFieldOfStudySubs', 'educationFieldOfStudyCores', 'educationIscedNarrowFields'));
        $this->set('_serialize', ['applicantDesiredEducation']);

        $ApplicantMenu = $this->MenuBuilder->buildApplicantMenu('applicant_menu_education_needs', $userId);
        $this->set('menu_tabs_builder', $ApplicantMenu);
    }


    /**
     * Delete method
     *
     * @param string|null $id Applicant Desired Education id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $userId = $this->Auth->user('id');
        $this->request->allowMethod(['post', 'delete']);
        $applicantDesiredEducation = $this->ApplicantDesiredEducations->get($id);
        if ($this->ApplicantDesiredEducations->delete($applicantDesiredEducation)) {
            $this->Flash->success(__('The record has been deleted.'));
        } else {
            $this->Flash->error(__('The record could not be deleted. Please, try again.'));
        }
        return $this->redirect(['controller' => 'ApplicantEducationNeeds','action' => 'view', $userId]);
    }
}
