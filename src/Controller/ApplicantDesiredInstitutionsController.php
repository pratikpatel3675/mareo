<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * ApplicantDesiredInstitutions Controller
 *
 * @property \App\Model\Table\ApplicantDesiredInstitutionsTable $ApplicantDesiredInstitutions
 */
class ApplicantDesiredInstitutionsController extends AppController
{

    public function isAuthorized($user = null){
        // Only the owner can edit and view
        if (in_array($this->request->action, ['edit', 'delete'])) {
            $applicantDesiredInstitutionId = (int)$this->request->params['pass'][0];
            if ($this->ApplicantDesiredInstitutions->isOwnedBy($applicantDesiredInstitutionId, $user['id'])) {
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
        $applicantDesiredInstitution = $this->ApplicantDesiredInstitutions->newEntity();
        if ($this->request->is('post')) {
            $applicantDesiredInstitution = $this->ApplicantDesiredInstitutions->patchEntity($applicantDesiredInstitution, $this->request->data);
            $applicantDesiredInstitution['user_id'] = $userId;
            // we check if the same record already exists
            if (!$this->ApplicantDesiredInstitutions->alreadyExists(
                $applicantDesiredInstitution['country_id'],
                $applicantDesiredInstitution['user_id'],
                $applicantDesiredInstitution['institution_higher_education_id'],
                $applicantDesiredInstitution['institution_higher_education_faculty_id'],
                $applicantDesiredInstitution['institution_higher_education_course_id']
                )) {
                // we authorize 10 institutions only

                if ($this->ApplicantDesiredInstitutions->find()->where(['user_id' => $userId])->count() < 10) {

                    if ($this->ApplicantDesiredInstitutions->save($applicantDesiredInstitution)) {
                        $this->Flash->success(__('The record has been saved.'));
                        return $this->redirect(['controller' => 'ApplicantEducationNeeds','action' => 'view', $applicantDesiredInstitution['user_id'] ]);
                    } else {
                        $this->Flash->error(__('The record could not be saved. Please, try again.'));
                    }
                } else {
                    $this->Flash->error(__('You can not save more than 10 records.'));
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


        //$users = $this->ApplicantDesiredInstitutions->Users->find('list', ['limit' => 200]);
        //$countries = $this->ApplicantDesiredInstitutions->Countries->find('list', ['limit' => 200]);
        $institutionHigherEducations = $this->ApplicantDesiredInstitutions->InstitutionHigherEducations->find('list', ['limit' => 200]);
        $institutionHigherEducationFaculties = $this->ApplicantDesiredInstitutions->InstitutionHigherEducationFaculties->find('list', ['limit' => 200]);
        $institutionHigherEducationCourses = $this->ApplicantDesiredInstitutions->InstitutionHigherEducationCourses->find('list', ['limit' => 200]);
        $this->set(compact('applicantDesiredInstitution', 'countries', 'institutionHigherEducations', 'institutionHigherEducationFaculties', 'institutionHigherEducationCourses'));
        $this->set('_serialize', ['applicantDesiredInstitution']);

        $ApplicantMenu = $this->MenuBuilder->buildApplicantMenu('applicant_menu_education_needs', $userId);
        $this->set('menu_tabs_builder', $ApplicantMenu);
    }

    /**
     * Edit method
     *
     * @param string|null $id Applicant Desired Institution id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userId = $this->Auth->user('id');
        $applicantDesiredInstitution = $this->ApplicantDesiredInstitutions->get($id, [
            'contain' => ['InstitutionHigherEducations', 'InstitutionHigherEducationFaculties', 'InstitutionHigherEducationCourses']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $applicantDesiredInstitution = $this->ApplicantDesiredInstitutions->patchEntity($applicantDesiredInstitution, $this->request->data);
            $applicantDesiredInstitution['user_id'] = $userId;

            if ($this->ApplicantDesiredInstitutions->save($applicantDesiredInstitution)) {
                $this->Flash->success(__('The record has been saved.'));
                return $this->redirect(['controller' => 'ApplicantEducationNeeds','action' => 'view', $applicantDesiredInstitution['user_id'] ]);
            } else {
                $this->Flash->error(__('The record could not be saved. Please, try again.'));
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

        $institutionHigherEducations = $this->ApplicantDesiredInstitutions->InstitutionHigherEducations->find('list')
            ->where(['country_id' => $applicantDesiredInstitution->country_id])->order(['name' => 'ASC']);
        
        $institutionHigherEducationFaculties = $this->ApplicantDesiredInstitutions->InstitutionHigherEducationFaculties->find('list')
            ->where(['institution_higher_education_id' => $applicantDesiredInstitution->institution_higher_education_id]);
        
        $institutionHigherEducationCourses = $this->ApplicantDesiredInstitutions->InstitutionHigherEducationCourses->find('list')
            ->where(['institution_higher_education_faculty_id' => $applicantDesiredInstitution->institution_higher_education_faculty_id ]);
        
        //$users = $this->ApplicantDesiredInstitutions->Users->find('list', ['limit' => 200]);
        //$countries = $this->ApplicantDesiredInstitutions->Countries->find('list', ['limit' => 200]);
        //$institutionHigherEducations = $this->ApplicantDesiredInstitutions->InstitutionHigherEducations->find('list', ['limit' => 200]);
        //$institutionHigherEducationFaculties = $this->ApplicantDesiredInstitutions->InstitutionHigherEducationFaculties->find('list', ['limit' => 200]);
        //$institutionHigherEducationCourses = $this->ApplicantDesiredInstitutions->InstitutionHigherEducationCourses->find('list', ['limit' => 200]);
        $this->set(compact('applicantDesiredInstitution', 'countries', 'institutionHigherEducations', 'institutionHigherEducationFaculties', 'institutionHigherEducationCourses'));
        $this->set('_serialize', ['applicantDesiredInstitution']);

        $ApplicantMenu = $this->MenuBuilder->buildApplicantMenu('applicant_menu_education_needs', $userId);
        $this->set('menu_tabs_builder', $ApplicantMenu);
    }

    /**
     * Delete method
     *
     * @param string|null $id Applicant Desired Institution id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $userId = $this->Auth->user('id');
        $this->request->allowMethod(['post', 'delete']);
        $applicantDesiredInstitution = $this->ApplicantDesiredInstitutions->get($id);
        if ($this->ApplicantDesiredInstitutions->delete($applicantDesiredInstitution)) {
            $this->Flash->success(__('The record has been deleted.'));
        } else {
            $this->Flash->error(__('The record could not be deleted. Please, try again.'));
        }
        return $this->redirect(['controller' => 'ApplicantEducationNeeds','action' => 'view', $applicantDesiredInstitution['user_id'] ]);
    }
}
