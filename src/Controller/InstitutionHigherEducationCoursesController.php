<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * InstitutionHigherEducationCourses Controller
 *
 * @property \App\Model\Table\InstitutionHigherEducationCoursesTable $InstitutionHigherEducationCourses
 */
class InstitutionHigherEducationCoursesController extends AppController
{
    public function beforeFilter(\Cake\Event\Event $event)
    {
        $this->Auth->allow(['getNamesByFaculty']);
    }

    public function getNamesByFaculty($facultyId = null)
    { 
        $data = array();
        $this->viewBuilder()->layout('ajax');
        $this->response->type('application/json');

        $data = $this->InstitutionHigherEducationCourses->find()
            ->select(['name', 'id'])
            ->where(['institution_higher_education_faculty_id' => $facultyId])
            ->order(['name' => 'ASC']);

        $this->set('data',$data);
        $this->render('/Element/ajaxreturn');
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['InstitutionHigherEducationFaculities', 'EducationIscedNarrowFields']
        ];
        $institutionHigherEducationCourses = $this->paginate($this->InstitutionHigherEducationCourses);

        $this->set(compact('institutionHigherEducationCourses'));
        $this->set('_serialize', ['institutionHigherEducationCourses']);
    }

    /**
     * View method
     *
     * @param string|null $id Institution Higher Education Course id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $institutionHigherEducationCourse = $this->InstitutionHigherEducationCourses->get($id, [
            'contain' => ['InstitutionHigherEducationFaculities', 'EducationIscedNarrowFields', 'ApplicantEducations']
        ]);

        $this->set('institutionHigherEducationCourse', $institutionHigherEducationCourse);
        $this->set('_serialize', ['institutionHigherEducationCourse']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $institutionHigherEducationCourse = $this->InstitutionHigherEducationCourses->newEntity();
        if ($this->request->is('post')) {
            $institutionHigherEducationCourse = $this->InstitutionHigherEducationCourses->patchEntity($institutionHigherEducationCourse, $this->request->data);
            if ($this->InstitutionHigherEducationCourses->save($institutionHigherEducationCourse)) {
                $this->Flash->success(__('The institution higher education course has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The institution higher education course could not be saved. Please, try again.'));
            }
        }
        $institutionHigherEducationFaculities = $this->InstitutionHigherEducationCourses->InstitutionHigherEducationFaculities->find('list', ['limit' => 200]);
        $educationIscedNarrowFields = $this->InstitutionHigherEducationCourses->EducationIscedNarrowFields->find('list', ['limit' => 200]);
        $this->set(compact('institutionHigherEducationCourse', 'institutionHigherEducationFaculities', 'educationIscedNarrowFields'));
        $this->set('_serialize', ['institutionHigherEducationCourse']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Institution Higher Education Course id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $institutionHigherEducationCourse = $this->InstitutionHigherEducationCourses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $institutionHigherEducationCourse = $this->InstitutionHigherEducationCourses->patchEntity($institutionHigherEducationCourse, $this->request->data);
            if ($this->InstitutionHigherEducationCourses->save($institutionHigherEducationCourse)) {
                $this->Flash->success(__('The institution higher education course has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The institution higher education course could not be saved. Please, try again.'));
            }
        }
        $institutionHigherEducationFaculities = $this->InstitutionHigherEducationCourses->InstitutionHigherEducationFaculities->find('list', ['limit' => 200]);
        $educationIscedNarrowFields = $this->InstitutionHigherEducationCourses->EducationIscedNarrowFields->find('list', ['limit' => 200]);
        $this->set(compact('institutionHigherEducationCourse', 'institutionHigherEducationFaculities', 'educationIscedNarrowFields'));
        $this->set('_serialize', ['institutionHigherEducationCourse']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Institution Higher Education Course id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $institutionHigherEducationCourse = $this->InstitutionHigherEducationCourses->get($id);
        if ($this->InstitutionHigherEducationCourses->delete($institutionHigherEducationCourse)) {
            $this->Flash->success(__('The institution higher education course has been deleted.'));
        } else {
            $this->Flash->error(__('The institution higher education course could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
