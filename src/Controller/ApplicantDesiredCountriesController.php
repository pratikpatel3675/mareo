<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * ApplicantDesiredCountries Controller
 *
 * @property \App\Model\Table\ApplicantDesiredCountriesTable $ApplicantDesiredCountries
 */
class ApplicantDesiredCountriesController extends AppController
{

    public function isAuthorized($user = null){
        // Only the owner can edit and view
        if (in_array($this->request->action, ['delete'])) {
            $applicantDesiredCountryId = (int)$this->request->params['pass'][0];
            if ($this->ApplicantDesiredCountries->isOwnedBy($applicantDesiredCountryId, $user['id'])) {
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
        $applicantDesiredCountry = $this->ApplicantDesiredCountries->newEntity();
        if ($this->request->is('post')) {
            $applicantDesiredCountry = $this->ApplicantDesiredCountries->patchEntity($applicantDesiredCountry, $this->request->data);
            $applicantDesiredCountry['user_id'] = $userId;
            //we need to check if a record with same user_id and country_id already exists
            if (!$this->ApplicantDesiredCountries->alreadyExists($applicantDesiredCountry['country_id'], $applicantDesiredCountry['user_id'])){
                //Then we only authorize if there are less than 5 countries already saved
                if ($this->ApplicantDesiredCountries->find()->where(['user_id' => $userId])->count() < 5) {
                    if ($this->ApplicantDesiredCountries->save($applicantDesiredCountry)) {
                        $this->Flash->success(__('The record has been saved.'));
                        return $this->redirect(['controller' => 'ApplicantEducationNeeds','action' => 'view', $applicantDesiredCountry['user_id'] ]);
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

        $this->set(compact('applicantDesiredCountry', 'countries'));
        $this->set('_serialize', ['applicantDesiredCountry']);

        $ApplicantMenu = $this->MenuBuilder->buildApplicantMenu('applicant_menu_education_needs', $userId);
        $this->set('menu_tabs_builder', $ApplicantMenu);
    }

    /**
     * Delete method
     *
     * @param string|null $id Applicant Desired Country id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $userId = $this->Auth->user('id');
        $this->request->allowMethod(['post', 'delete']);
        $applicantDesiredCountry = $this->ApplicantDesiredCountries->get($id);
        if ($this->ApplicantDesiredCountries->delete($applicantDesiredCountry)) {
            $this->Flash->success(__('The record has been deleted.'));
        } else {
            $this->Flash->error(__('The record could not be deleted. Please, try again.'));
        }
        return $this->redirect(['controller' => 'ApplicantEducationNeeds','action' => 'view', $userId]);
    }
}
