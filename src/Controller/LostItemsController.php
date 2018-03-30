<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Mailer\Email;
/**
 * LostItems Controller
 *
 * @property \App\Model\Table\LostItemsTable $LostItems
 */
class LostItemsController extends AppController
{

        public function beforeFilter(\Cake\Event\Event $event) {
        $this->Auth->allow(['add', 'view','viewProvider','edit','index','search','delete']);
    }

    
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
 
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {

      
       $lostItems = $this->LostItems->find()->where(['LostItems.is_active' => 1])->contain(['Countries','Users','ItemTypes'])->toArray();


        $this->set(compact('lostItems'));
        $this->set('_serialize', ['lostItems']);



    }

    /**
     * View method
     *
     * @param string|null $id Lost Item id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lostItems = $this->LostItems->get($id, [
            'contain' => ['Users', 'Countries', 'ItemTypes']
        ]);
        $this->set('lostItems', $lostItems);
        $this->set('_serialize', ['lostItem']);
   
        $files = TableRegistry::get('ApplicantLostPictures')->find('all', ['order' => ['ApplicantLostPictures.created' => 'DESC']])->where(['lost_item_id' => $id]);
       


        $filesRowNum = $files->count();
        //debug($filesRowNum);die;
        
        $this->set('files',$files);
        $this->set('filesRowNum',$filesRowNum);


    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        
        $userId=$this->Auth->user('id');
        $lostItem = $this->LostItems->newEntity();
        if ($this->request->is('post')) {
            $lostItem = $this->LostItems->patchEntity($lostItem, $this->request->data);
            $lostItem['user_id']=$userId;
            $lostItem['is_active']=1;


            if ($this->LostItems->save($lostItem)) {
                $this->Flash->success(__('The lost item has been saved.'));
                return     $this->redirect(['controller' => 'LostItemManager', 'action' => 'viewLostItem',$userId]);

            } else {
                $this->Flash->error(__('The lost item could not be saved. Please, try again.'));
            }
        }
        $users = $this->LostItems->Users->find('list', ['limit' => 200]);
        $countries = $this->LostItems->Countries->find('list', ['limit' => 200]);
        $itemTypes = $this->LostItems->ItemTypes->find('list', ['limit' => 200]);
        $this->set(compact('lostItem', 'users', 'countries', 'itemTypes'));
        $this->set('_serialize', ['lostItem']);
        
        $ApplicantMenu = $this->MenuBuilder->buildApplicantMenu('Lost items', $userId);
        $this->set('MenuItems', $ApplicantMenu);



    }

    /**
     * Edit method
     *
     * @param string|null $id Lost Item id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lostItem = $this->LostItems->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lostItem = $this->LostItems->patchEntity($lostItem, $this->request->data);
            if ($this->LostItems->save($lostItem)) {
                $this->Flash->success(__('The lost item has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The lost item could not be saved. Please, try again.'));
            }
        }
        $users = $this->LostItems->Users->find('list', ['limit' => 200]);
        $countries = $this->LostItems->Countries->find('list', ['limit' => 200]);
        $itemTypes = $this->LostItems->ItemTypes->find('list', ['limit' => 200]);
        $this->set(compact('lostItem', 'users', 'countries', 'itemTypes'));
        $this->set('_serialize', ['lostItem']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Lost Item id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $userId=$this->Auth->user('id');
        $this->request->allowMethod(['post', 'delete']);
        $lostItem = $this->LostItems->get($id);
        if ($this->LostItems->delete($lostItem)) {
            $this->Flash->success(__('The lost item has been deleted.'));
        } else {
            $this->Flash->error(__('The lost item could not be deleted. Please, try again.'));
        }
        return     $this->redirect(['controller' => 'LostItemManager', 'action' => 'viewLostItem',$userId]);
    }





    public function viewProvider($id = null) {
      
        $userId=$this->Auth->user('id');

        $lostitems = $this->LostItems->get($id, [
            'contain' => [
                     'Users',
                     'Countries', 
                     'ItemTypes',
                     'ItemApplications',
                     'ApplicantLostMaps',
                     'ApplicantLostPictures'
                         ]
                ]);

        $this->set('lostitems', $lostitems);
        $this->set('_serialize', ['lostitems']);


        $nbApplicantSeekers = TableRegistry::get('ItemApplications')->find()
                ->where(['lost_item_id' => $id])
                ->andWhere(['status' => 1])
                ->count();

        $nbApplicantAccepted = TableRegistry::get('ItemApplications')->find()
                ->Where(['status' => 2])
                ->orWhere(['status' => 4])
                ->andwhere(['lost_item_id' => $id])
                ->count();

        

        $this->set('nbApplicantSeekers', $nbApplicantSeekers);
        $this->set('nbApplicantAccepted', $nbApplicantAccepted);
        $this->set('userId', $userId);



         $ApplicantMenu = $this->MenuBuilder->buildApplicantMenu('Lost items', $userId);
          $this->set('MenuItems', $ApplicantMenu);
////////////////////////////////////// Upload Pictures/////////////////
       // $authorisedOpportunities = TableRegistry::get('Opportunities')

         $uploadData = '';
        if ($this->request->is('post')) {
            if(!empty($this->request->data['file']['name'])){
                $fileName = $this->request->data['file']['name'];
                $uploadPath = 'uploads/files/';
                $uploadFile = WWW_ROOT.$uploadPath.$fileName;
                if(move_uploaded_file($this->request->data['file']['tmp_name'],$uploadFile)){
                    $uploadData = TableRegistry::get('ApplicantLostPictures')->newEntity();
                    $uploadData->name = $fileName;
                    $uploadData->path = $uploadPath;
                    $uploadData->created = date("Y-m-d H:i:s");
                    $uploadData->modified = date("Y-m-d H:i:s");
                    $uploadData->lost_item_id = $id;


                    if (TableRegistry::get('ApplicantLostPictures')->save($uploadData)) {
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
        
        $files = TableRegistry::get('ApplicantLostPictures')->find('all', ['order' => ['ApplicantLostPictures.created' => 'DESC']])->where(['lost_item_id' => $id]);
       


        $filesRowNum = $files->count();
        $this->set('files',$files);
        $this->set('filesRowNum',$filesRowNum);
    }
    



    



}
