<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Mailer\Email;
/**
 * FoundItems Controller
 *
 * @property \App\Model\Table\FoundItemsTable $FoundItems
 */
class FoundItemsController extends AppController
{
    


    public function beforeFilter(\Cake\Event\Event $event) {
        $this->Auth->allow(['add', 'view','viewProvider']);
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Countries', 'ItemTypes']
        ];
        $foundItems = $this->paginate($this->FoundItems);

        $this->set(compact('foundItems'));
        $this->set('_serialize', ['foundItems']);
    }

    /**
     * View method
     *
     * @param string|null $id Found Item id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $foundItem = $this->FoundItems->get($id, [
            'contain' => ['Users', 'Countries', 'ItemTypes']
        ]);

        $this->set('foundItem', $foundItem);
        $this->set('_serialize', ['foundItem']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        
        $userId=$this->Auth->user('id');        
        $foundItem = $this->FoundItems->newEntity();
        if ($this->request->is('post')) {
            $foundItem = $this->FoundItems->patchEntity($foundItem, $this->request->data);
            $foundItem['user_id']=$userId;
            


            if ($this->FoundItems->save($foundItem)) {
                $this->Flash->success(__('The found item has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The found item could not be saved. Please, try again.'));
            }
        }
        $users = $this->FoundItems->Users->find('list', ['limit' => 200]);
        $countries = $this->FoundItems->Countries->find('list', ['limit' => 200]);
        $itemTypes = $this->FoundItems->ItemTypes->find('list', ['limit' => 200]);
        $this->set(compact('foundItem', 'users', 'countries', 'itemTypes'));
        $this->set('_serialize', ['foundItem']);
        
        $ApplicantMenu = $this->MenuBuilder->buildApplicantMenu('Found items', $userId);
        $this->set('MenuItems', $ApplicantMenu);
    }

    /**
     * Edit method
     *
     * @param string|null $id Found Item id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $foundItem = $this->FoundItems->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $foundItem = $this->FoundItems->patchEntity($foundItem, $this->request->data);
            if ($this->FoundItems->save($foundItem)) {
                $this->Flash->success(__('The found item has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The found item could not be saved. Please, try again.'));
            }
        }
        $users = $this->FoundItems->Users->find('list', ['limit' => 200]);
        $countries = $this->FoundItems->Countries->find('list', ['limit' => 200]);
        $itemTypes = $this->FoundItems->ItemTypes->find('list', ['limit' => 200]);
        $this->set(compact('foundItem', 'users', 'countries', 'itemTypes'));
        $this->set('_serialize', ['foundItem']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Found Item id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $foundItem = $this->FoundItems->get($id);
        if ($this->FoundItems->delete($foundItem)) {
            $this->Flash->success(__('The found item has been deleted.'));
        } else {
            $this->Flash->error(__('The found item could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function viewProvider($id = null)
     {
      
        $userId=$this->Auth->user('id');

        $foundtems = $this->FoundItems->get($id, [
            'contain' => [
                     'Users',
                     'Countries', 
                     'ItemTypes',
                     'ItemFoundedApplications'
                     
                         ]
                ]);

        $this->set('foundtems', $foundtems);
        $this->set('_serialize', ['foundtems']);

        $nbApplicantSeekers = TableRegistry::get('ItemFoundedApplications')->find()
                ->where(['found_item_id' => $id])
                ->andWhere(['status' => 1])
                ->count();

        $nbApplicantAccepted = TableRegistry::get('ItemFoundedApplications')->find()
                ->Where(['status' => 2])
                ->orWhere(['status' => 4])
                ->andwhere(['found_item_id' => $id])
                ->count();

        

        $this->set('nbApplicantSeekers', $nbApplicantSeekers);
        $this->set('nbApplicantAccepted', $nbApplicantAccepted);
    


         $ApplicantMenu = $this->MenuBuilder->buildApplicantMenu('Found items', $userId);
          $this->set('MenuItems', $ApplicantMenu);
////////////////////////////////////// Upload Pictures/////////////////
       // $authorisedOpportunities = TableRegistry::get('Opportunities')

           $uploadData = '';
        if ($this->request->is('post')) {
            if(!empty($this->request->data['file']['name'])){
                $fileName = $this->request->data['file']['name'];
                $uploadPath = 'uploads/founded/';
                $uploadFile = WWW_ROOT.$uploadPath.$fileName;
                if(move_uploaded_file($this->request->data['file']['tmp_name'],$uploadFile)){
                    $uploadData = TableRegistry::get('ApplicantFoundPictures')->newEntity();
                    $uploadData->name = $fileName;
                    $uploadData->path = $uploadPath;
                    $uploadData->created = date("Y-m-d H:i:s");
                    $uploadData->modified = date("Y-m-d H:i:s");
                    $uploadData->found_item_id = $id;


                    if (TableRegistry::get('ApplicantFoundPictures')->save($uploadData)) {
                        $this->Flash->success(__('File has been uploaded and inserted successfully.'));
                    }else{
                        $this->Flash->error(__('Unable to upload file, please try again.'));
                    }
                }else{
                    $this->Flash->error(__('Unable to upload file, please try again.'));
                }
            }
            
        }
        $this->set('uploadData', $uploadData);
        
        $files = TableRegistry::get('ApplicantFoundPictures')->find('all', ['order' => ['ApplicantFoundPictures.created' => 'DESC']])
        ->where(['found_item_id' => $id]);
        $filesRowNum = $files->count();
        $this->set('files',$files);
        $this->set('filesRowNum',$filesRowNum); 




    }
    












}
