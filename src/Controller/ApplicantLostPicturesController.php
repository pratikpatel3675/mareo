<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ApplicantLostPictures Controller
 *
 * @property \App\Model\Table\ApplicantLostPicturesTable $ApplicantLostPictures
 */
class ApplicantLostPicturesController extends AppController
{
            public function beforeFilter(\Cake\Event\Event $event) {
        $this->Auth->allow(['add']);}
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['LostItems']
        ];
        $applicantLostPictures = $this->paginate($this->ApplicantLostPictures);

        $this->set(compact('applicantLostPictures'));
        $this->set('_serialize', ['applicantLostPictures']);
    }

    /**
     * View method
     *
     * @param string|null $id Applicant Lost Picture id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $applicantLostPicture = $this->ApplicantLostPictures->get($id, [
            'contain' => ['LostItems']
        ]);

        $this->set('applicantLostPicture', $applicantLostPicture);
        $this->set('_serialize', ['applicantLostPicture']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
   /* public function add()
    {
        $applicantLostPicture = $this->ApplicantLostPictures->newEntity();
        if ($this->request->is('post')) {
            $applicantLostPicture = $this->ApplicantLostPictures->patchEntity($applicantLostPicture, $this->request->data);
            if ($this->ApplicantLostPictures->save($applicantLostPicture)) {
                $this->Flash->success(__('The applicant lost picture has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The applicant lost picture could not be saved. Please, try again.'));
            }
        }
        $lostItems = $this->ApplicantLostPictures->LostItems->find('list', ['limit' => 200]);
        $this->set(compact('applicantLostPicture', 'lostItems'));
        $this->set('_serialize', ['applicantLostPicture']);
    }
*/
    /**
     * Edit method
     *
     * @param string|null $id Applicant Lost Picture id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $applicantLostPicture = $this->ApplicantLostPictures->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $applicantLostPicture = $this->ApplicantLostPictures->patchEntity($applicantLostPicture, $this->request->data);
            if ($this->ApplicantLostPictures->save($applicantLostPicture)) {
                $this->Flash->success(__('The applicant lost picture has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The applicant lost picture could not be saved. Please, try again.'));
            }
        }
        $lostItems = $this->ApplicantLostPictures->LostItems->find('list', ['limit' => 200]);
        $this->set(compact('applicantLostPicture', 'lostItems'));
        $this->set('_serialize', ['applicantLostPicture']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Applicant Lost Picture id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $applicantLostPicture = $this->ApplicantLostPictures->get($id);
        if ($this->ApplicantLostPictures->delete($applicantLostPicture)) {
            $this->Flash->success(__('The applicant lost picture has been deleted.'));
        } else {
            $this->Flash->error(__('The applicant lost picture could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

public function add()
   {
        $uploadData = '';
        if ($this->request->is('post')) {
            if(!empty($this->request->data['file']['name'])){
                $fileName = $this->request->data['file']['name'];
                $uploadPath = 'uploads/files/';
                $uploadFile = WWW_ROOT.$uploadPath.$fileName;
                if(move_uploaded_file($this->request->data['file']['tmp_name'],$uploadFile)){
                    $uploadData = $this->ApplicantLostPictures->newEntity();
                    $uploadData->name = $fileName;
                    $uploadData->path = $uploadPath;
                    $uploadData->created = date("Y-m-d H:i:s");
                    $uploadData->modified = date("Y-m-d H:i:s");
                    if ($this->ApplicantLostPictures->save($uploadData)) {
                        $this->Flash->success(__('File has been uploaded and inserted successfully.'));
                    }else{
                        $this->Flash->error(__('Unable to upload file, please try again.'));
                    }
                }else{
                    $this->Flash->error(__('Unable to upload file, please try again.'));
                }
            }else{
                $this->Flash->error(__('Please choose a file to upload.'));
            }
            
        }
        $this->set('uploadData', $uploadData);
        
        $files = $this->ApplicantLostPictures->find('all', ['order' => ['ApplicantLostPictures.created' => 'DESC']]);
        $filesRowNum = $files->count();
        $this->set('files',$files);
        $this->set('filesRowNum',$filesRowNum);
    }

 











}
