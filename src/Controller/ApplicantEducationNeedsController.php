<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * ApplicantEducationNeeds Controller
 *
 * @property \App\Model\Table\ApplicantEducationNeedsTable $ApplicantEducationNeeds
 */
class ApplicantEducationNeedsController extends AppController
{
    public function isAuthorized($user = null){
        // Only the owner can edit and view
        if (in_array($this->request->action, ['view'])) {
            $userId = (int)$this->request->params['pass'][0];
            if($this->Auth->user('id') == $userId) {
                return true;
            }
        }
        return parent::isAuthorized($user);
    }


    /**
     * View method
     *
     * @param string|null $id Applicant user id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($user_id = null)
    {
        $applicantDesiredCountries = TableRegistry::get('ApplicantDesiredCountries')
            ->find()
            ->contain(['Countries'])
            ->where(['user_id' => $user_id]);
        $this->set('applicantDesiredCountries', $applicantDesiredCountries); 

        $applicantDesiredEducations = TableRegistry::get('ApplicantDesiredEducations')
            ->find()
            ->contain(['EducationFieldOfStudySubs'])
            ->where(['user_id' => $user_id]);
        $this->set('applicantDesiredEducations', $applicantDesiredEducations); 

        $applicantDesiredEducationTypes = TableRegistry::get('ApplicantDesiredEducationTypes')
            ->find()
            ->contain(['EducationDesiredTypes'])
            ->where(['user_id' => $user_id]);
        $this->set('applicantDesiredEducationTypes', $applicantDesiredEducationTypes); 

        $applicantDesiredInstitutions = TableRegistry::get('ApplicantDesiredInstitutions')
            ->find()
            ->contain(['Countries', 'InstitutionHigherEducations', 'InstitutionHigherEducationFaculties', 'InstitutionHigherEducationCourses'])
            ->where(['user_id' => $user_id]);
        $this->set('applicantDesiredInstitutions', $applicantDesiredInstitutions); 

        $ApplicantMenu = $this->MenuBuilder->buildApplicantMenu('applicant_menu_education_needs', $user_id);
        $this->set('menu_tabs_builder', $ApplicantMenu);
    }


}
