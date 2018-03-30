<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ApplicantFoundPictures Controller
 *
 * @property \App\Model\Table\ApplicantFoundPicturesTable $ApplicantFoundPictures
 */
class ApplicantFoundPicturesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['FoundItems']
        ];
        $applicantFoundPictures = $this->paginate($this->ApplicantFoundPictures);

        $this->set(compact('applicantFoundPictures'));
        $this->set('_serialize', ['applicantFoundPictures']);
    }

    /**
     * View method
     *
     * @param string|null $id Applicant Found Picture id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $applicantFoundPicture = $this->ApplicantFoundPictures->get($id, [
            'contain' => ['FoundItems']
        ]);

        $this->set('applicantFoundPicture', $applicantFoundPicture);
        $this->set('_serialize', ['applicantFoundPicture']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $applicantFoundPicture = $this->ApplicantFoundPictures->newEntity();
        if ($this->request->is('post')) {
            $applicantFoundPicture = $this->ApplicantFoundPictures->patchEntity($applicantFoundPicture, $this->request->data);
            if ($this->ApplicantFoundPictures->save($applicantFoundPicture)) {
                $this->Flash->success(__('The applicant found picture has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The applicant found picture could not be saved. Please, try again.'));
            }
        }
        $foundItems = $this->ApplicantFoundPictures->FoundItems->find('list', ['limit' => 200]);
        $this->set(compact('applicantFoundPicture', 'foundItems'));
        $this->set('_serialize', ['applicantFoundPicture']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Applicant Found Picture id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $applicantFoundPicture = $this->ApplicantFoundPictures->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $applicantFoundPicture = $this->ApplicantFoundPictures->patchEntity($applicantFoundPicture, $this->request->data);
            if ($this->ApplicantFoundPictures->save($applicantFoundPicture)) {
                $this->Flash->success(__('The applicant found picture has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The applicant found picture could not be saved. Please, try again.'));
            }
        }
        $foundItems = $this->ApplicantFoundPictures->FoundItems->find('list', ['limit' => 200]);
        $this->set(compact('applicantFoundPicture', 'foundItems'));
        $this->set('_serialize', ['applicantFoundPicture']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Applicant Found Picture id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $applicantFoundPicture = $this->ApplicantFoundPictures->get($id);
        if ($this->ApplicantFoundPictures->delete($applicantFoundPicture)) {
            $this->Flash->success(__('The applicant found picture has been deleted.'));
        } else {
            $this->Flash->error(__('The applicant found picture could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
