<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * ApplicantEducations Controller
 *
 * @property \App\Model\Table\ApplicantEducationsTable $ApplicantEducations
 */
class ApplicantEducationsController extends AppController
{

    public function isAuthorized($user = null){
        // Only the owner can edit and view
        if (in_array($this->request->action, ['edit', 'view'])) {
            $applicantEducationId = (int)$this->request->params['pass'][0];
            if ($this->ApplicantEducations->isOwnedBy($applicantEducationId, $user['id'])) {
                return true;
            }
        }
        // user can add if no applicantEducation exists already for that user
        if (in_array($this->request->action, ['add'])) {
            if($this->ApplicantEducations->find('ownedBy', ['user_id' => $this->Auth->user('id')])->first() == null){
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
    //         'contain' => ['InstitutionHigherEducations', 'EducationLevels', 'EducationIscedNarrowFields', 'Countries', 'Languages', 'Users', 'InstitutionHigherEducationFaculties', 'InstitutionHigherEducationCourses']
    //     ];
    //     $applicantEducations = $this->paginate($this->ApplicantEducations);

    //     $this->set(compact('applicantEducations'));
    //     $this->set('_serialize', ['applicantEducations']);
    // }

    /**
     * View method
     *
     * @param string|null $id Applicant Education id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userId = $this->Auth->user('id');
        $applicantEducation = $this->ApplicantEducations->get($id, [
            'contain' => ['InstitutionHigherEducations', 'EducationLevels', 'EducationIscedNarrowFields', 'Countries', 'Languages', 'Users', 'InstitutionHigherEducationFaculties', 'InstitutionHigherEducationCourses']
        ]);

        $this->set('applicantEducation', $applicantEducation);
        $this->set('_serialize', ['applicantEducation']);

        $ApplicantMenu = $this->MenuBuilder->buildApplicantMenu('applicant_menu_education', $userId);
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

        $applicantEducation = $this->ApplicantEducations->newEntity();
        if ($this->request->is('post')) {
            $applicantEducation = $this->ApplicantEducations->patchEntity($applicantEducation, $this->request->data);
            $applicantEducation['user_id'] = $userId;
            //if education level is high school, we dont save the institution, faculty and courses
            if($this->request->data['education_level_id'] == 1){
                $applicantEducation['institution_higher_education_id'] = null;
                $applicantEducation['institution_higher_education_faculty_id'] = null;
                $applicantEducation['institution_higher_education_course_id'] = null;
            }
            // else, we find the narrow field of study matching with the course
            else {
                $institutionHigherEducationCourse = TableRegistry::get('InstitutionHigherEducationCourses')->find()
                    ->where(['id' => $this->request->data['institution_higher_education_course_id']])
                    ->first();
                $applicantEducation['education_isced_narrow_field_id'] = $institutionHigherEducationCourse->education_isced_narrow_field_id;
            }


            if ($this->ApplicantEducations->save($applicantEducation)) {
                $this->Flash->success(__('The applicant education has been saved.'));
                return $this->redirect(['action' => 'view', $applicantEducation->id]);
            } else {
                $this->Flash->error(__('The applicant education could not be saved. Please, try again.'));
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
            $languages = TableRegistry::get('Languages')->find('list', [
                'keyField' => 'id', 
                'valueField' => 'name_en', 
                'order' => array('name_en' => 'ASC')
                ])->toArray();
            $educationLevels = TableRegistry::get('EducationLevels')->find('list', [
                'keyField' => 'id', 
                'valueField' => 'name_en', 
                'order' => array('id' => 'ASC')
                ])->toArray();
        }
        else {
            $countries = TableRegistry::get('Countries')->find('list', [
                'keyField' => 'id',
                'valueField' => 'name_ara',
                'order' => array('name_ara' => 'ASC')
                ])->toArray();
            $languages = TableRegistry::get('Languages')->find('list', [
                'keyField' => 'id', 
                'valueField' => 'name_ara', 
                'order' => array('name_en' => 'ASC')
                ])->toArray();
            $educationLevels = TableRegistry::get('EducationLevels')->find('list', [
                'keyField' => 'id', 
                'valueField' => 'name_ara', 
                'order' => array('id' => 'ASC')
                ])->toArray();
        }
        $institutionHigherEducations = $this->ApplicantEducations->InstitutionHigherEducations->find('list', ['limit' => 200]);
        //$educationLevels = $this->ApplicantEducations->EducationLevels->find('list', ['limit' => 200]);
        //$educationIscedNarrowFields = $this->ApplicantEducations->EducationIscedNarrowFields->find('list', ['limit' => 200]);
        //$countries = $this->ApplicantEducations->Countries->find('list', ['limit' => 200]);
        //$languages = $this->ApplicantEducations->Languages->find('list', ['limit' => 200]);
        //$users = $this->ApplicantEducations->Users->find('list', ['limit' => 200]);
        $institutionHigherEducationFaculties = $this->ApplicantEducations->InstitutionHigherEducationFaculties->find('list', ['limit' => 200]);
        $institutionHigherEducationCourses = $this->ApplicantEducations->InstitutionHigherEducationCourses->find('list', ['limit' => 200]);
        $this->set(compact('applicantEducation', 'institutionHigherEducations', 'educationLevels', 'educationIscedNarrowFields', 'countries', 'languages', 'institutionHigherEducationFaculties', 'institutionHigherEducationCourses'));
        $this->set('_serialize', ['applicantEducation']);

        $ApplicantMenu = $this->MenuBuilder->buildApplicantMenu('applicant_menu_education', $userId);
        $this->set('menu_tabs_builder', $ApplicantMenu);
    }

    /**
     * Edit method
     *
     * @param string|null $id Applicant Education id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userId = $this->Auth->user('id');
        $applicantEducation = $this->ApplicantEducations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $applicantEducation = $this->ApplicantEducations->patchEntity($applicantEducation, $this->request->data);
            $applicantEducation['user_id'] = $userId;
            //if education level is high school, we dont save the institution, faculty and courses
            if($this->request->data['education_level_id'] == 1){
                $applicantEducation['institution_higher_education_id'] = null;
                $applicantEducation['institution_higher_education_faculty_id'] = null;
                $applicantEducation['institution_higher_education_course_id'] = null;
            }
            // else, we find the narrow field of study matching with the course
            else {
                $institutionHigherEducationCourse = TableRegistry::get('InstitutionHigherEducationCourses')->find()
                    ->where(['id' => $this->request->data['institution_higher_education_course_id']])
                    ->first();
                $applicantEducation['education_isced_narrow_field_id'] = $institutionHigherEducationCourse->education_isced_narrow_field_id;
            }

            if ($this->ApplicantEducations->save($applicantEducation)) {
                $this->Flash->success(__('The applicant education has been saved.'));
                return $this->redirect(['action' =>  'view', $applicantEducation->id]);
            } else {
                $this->Flash->error(__('The applicant education could not be saved. Please, try again.'));
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
            $languages = TableRegistry::get('Languages')->find('list', [
                'keyField' => 'id', 
                'valueField' => 'name_en', 
                'order' => array('name_en' => 'ASC')
                ])->toArray();
            $educationLevels = TableRegistry::get('EducationLevels')->find('list', [
                'keyField' => 'id', 
                'valueField' => 'name_en', 
                'order' => array('id' => 'ASC')
                ])->toArray();
        }
        else {
            $countries = TableRegistry::get('Countries')->find('list', [
                'keyField' => 'id',
                'valueField' => 'name_ara',
                'order' => array('name_ara' => 'ASC')
                ])->toArray();
            $languages = TableRegistry::get('Languages')->find('list', [
                'keyField' => 'id', 
                'valueField' => 'name_ara', 
                'order' => array('name_en' => 'ASC')
                ])->toArray();
            $educationLevels = TableRegistry::get('EducationLevels')->find('list', [
                'keyField' => 'id', 
                'valueField' => 'name_ara', 
                'order' => array('id' => 'ASC')
                ])->toArray();
        }

        $institutionHigherEducations = $this->ApplicantEducations->InstitutionHigherEducations->find('list')
            ->where(['country_id' => $applicantEducation->country_id])->order(['name' => 'ASC']);
        //$educationLevels = $this->ApplicantEducations->EducationLevels->find('list', ['limit' => 200]);
        //$educationIscedNarrowFields = $this->ApplicantEducations->EducationIscedNarrowFields->find('list', ['limit' => 200]);
        //$countries = $this->ApplicantEducations->Countries->find('list', ['limit' => 200]);
        //$languages = $this->ApplicantEducations->Languages->find('list', ['limit' => 200]);
        //$users = $this->ApplicantEducations->Users->find('list', ['limit' => 200]);
        $institutionHigherEducationFaculties = $this->ApplicantEducations->InstitutionHigherEducationFaculties->find('list')
            ->where(['institution_higher_education_id' => $applicantEducation->institution_higher_education_id]);
        $institutionHigherEducationCourses = $this->ApplicantEducations->InstitutionHigherEducationCourses->find('list')
            ->where(['institution_higher_education_faculty_id' => $applicantEducation->institution_higher_education_faculty_id ]);
        $this->set(compact('applicantEducation', 'institutionHigherEducations', 'educationLevels', 'educationIscedNarrowFields', 'countries', 'languages', 'users', 'institutionHigherEducationFaculties', 'institutionHigherEducationCourses'));
        $this->set('_serialize', ['applicantEducation']);

        $ApplicantMenu = $this->MenuBuilder->buildApplicantMenu('applicant_menu_education', $userId);
        $this->set('menu_tabs_builder', $ApplicantMenu);
    }

    /**
     * Delete method
     *
     * @param string|null $id Applicant Education id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $applicantEducation = $this->ApplicantEducations->get($id);
        if ($this->ApplicantEducations->delete($applicantEducation)) {
            $this->Flash->success(__('The applicant education has been deleted.'));
        } else {
            $this->Flash->error(__('The applicant education could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
