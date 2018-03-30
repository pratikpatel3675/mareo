<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;


/**
 * Faqs Controller
 *
 * @property \App\Model\Table\FaqsTable $Faqs
 */
class FaqsController extends AppController
{



   public function beforeFilter(\Cake\Event\Event $event)
    {
        $this->Auth->allow(['index']);

   
 $session = $this->request->session();
 $lang=$session->read('System.language.code');
        if($lang=='en_US'){
            \Cake\I18n\I18n::locale('en_US');
        }else{
            \Cake\I18n\I18n::locale('ar_JO');
        }
    }



    

public function isAuthorized($user = null){
         $userId = $this->Auth->user('id');

        if (in_array($this->request->action, ['view'])) {
            $faqid = (int)$this->request->params['pass'][0];
        if ($this->Auth->user('role') == 'applicant' && TableRegistry::get('Faqs')->isOwnedBy($faqid, $this->Auth->user('id'))) {
                return true;
            }
        }
        if (in_array($this->request->action, ['add']) && $this->Auth->user('role') == 'applicant') {
            return true;
        }
       
       

        if (in_array($this->request->action,['delete','viewAdmin','edit','action']) && $this->Auth->user('role') == 'admin' && $this->Auth->user('id') == '2861' ) {
            
        return true;
        }
        return parent::isAuthorized($userId);



    }

/*
    public function isAuthorized($user = null){
        // Only the owner can edit and view
        if (in_array($this->request->action, ['add'])) {
            $faqid = (int)$this->request->params['pass'][0];
            if ($this->Faqs->isOwnedBy($faqid, $user['id'])) {
                return true;
            }
        }
        // user can add if no applicantAdress exists already for that user
        if (in_array($this->request->action, [''])) {
            if($this->Faqs->find('ownedBy', ['user_id' => $user['id']])->first() == null){
                return true;
            }   
        }

        return parent::isAuthorized($user);
    }

*/

    public function add()
    {
         $userId = $this->Auth->user('id');

        $faq = $this->Faqs->newEntity();
        if ($this->request->is('post')) {
            $faq = $this->Faqs->patchEntity($faq, $this->request->data);
            $faq['user_id'] = $userId;
            $faq['is_active'] = 0;

            if ($this->Faqs->save($faq)) {
                $this->Flash->success(__('The Question has been saved.'));
                return $this->redirect(['action' => 'view', $faq->id ]);
            } else {
                $this->Flash->error(__('The Question could not be saved. Please, try again.'));
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

        $this->set(compact('faq', 'countries'));
        $this->set('_serialize', ['faq']);
          $ApplicantMenu = $this->MenuBuilder->buildApplicantMenu('Ask Question', $userId);
        $this->set('MenuItems', $ApplicantMenu);

    }


    public function index() {

        $countryConditions = [];
        if (isset($_POST['country_id']) && $_POST['country_id'] != "" && $this->request->is('post') && $_POST['country_id']!= 0 ){
            $countryConditions = ['Faqs.country_id' => $_POST['country_id']];
        }
        $faqs = $this->Faqs->find()->where(['Faqs.is_active' => 1, $countryConditions])->contain(['Countries'])->toArray();
        $session = $this->request->session();
        $lang = $session->read('System.language.code');

        foreach ($faqs as $faq) {

            if ($lang == 'en_US') {
                $faq['question'] = $faq->question_en;
                $faq['answer'] = $faq->answer_en;
            } else {
                $faq['question'] = $faq->question_ara;
                $faq['answer'] = $faq->answer_ara;
            }

        }
        $countries = TableRegistry::get('Countries')->find('list', [
                'keyField' => 'id', 
                'valueField' => 'name_en', 
              
                'order' => array('name_en' => 'ASC')
                ])->toArray();
      //  $countries = $this->Faqs->Countries->find('list')
                     //   ->where(['Countries.id IN' => [2384, 2314]])->toArray();
       // $countries['0'] = 'International';
        $this->set(compact('countries','faqs'));
        $this->set('_serialize', ['countries','faqs']);
    }

    /**
     * View method
     *
     * @param string|null $id Faq id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
   
   public function view($id = null)
    {

     /*   
        $applicantGeneral = $this->ApplicantGenerals->get($id, [
            'contain' => ['Users', 'Genders','Countries','Nationalities','Languages','LevelOfLanguages', 'Language2s' , 'LevelOfLanguage2s',  'Language3s'  , 'LevelOfLanguage3s']
        ]);

        $ApplicantMenu = $this->MenuBuilder->buildApplicantMenu('applicant_menu_general', $applicantGeneral->user->id);
        $this->set('MenuItems', $ApplicantMenu);
        $this->set('applicantGeneral', $applicantGeneral);
        $this->set('_serialize', ['applicantGeneral']);
       



*/

/*
      $applicantGeneral = $this->ApplicantGenerals->get($id, [
            'contain' => ['Users', 'Genders','Countries','Nationalities','Languages','LevelOfLanguages', 'Language2s' , 'LevelOfLanguage2s',  'Language3s'  , 'LevelOfLanguage3s']
        ]);

        $ApplicantMenu = $this->MenuBuilder->buildApplicantMenu('applicant_menu_general', $applicantGeneral->user->id);
        $this->set('MenuItems', $ApplicantMenu);
        $this->set('applicantGeneral', $applicantGeneral);
        $this->set('_serialize', ['applicantGeneral']);

        $applicantTravelDocuments = TableRegistry::get('ApplicantTravelDocuments');
        $travelDocuments = $applicantTravelDocuments
            ->find()
            ->contain('Countries')
            ->where(['user_id' => $applicantGeneral->user->id]);
        $this->set('travelDocuments', $travelDocuments);  



*/


         $userId = $this->Auth->user('id');

        $faqs = $this->Faqs->find()->where(['user_id' => $userId]);

        $session = $this->request->session();
        $lang = $session->read('System.language.code');
        
        foreach ($faqs as $faq) {

            if ($lang == 'en_US'){
                $faq['question'] = $faq->question_en;
                $faq['answer'] = $faq->answer_en;
            }
            else{
                $faq['question'] = $faq->question_ara;
                $faq['answer'] = $faq->answer_ara;
            }

            $this->set(compact('faqs'));
            $this->set('_serialize', ['faqs']);
         $ApplicantMenu = $this->MenuBuilder->buildApplicantMenu('Ask Question', $userId);
        $this->set('MenuItems', $ApplicantMenu);

        }
    

/*

         $userId = $this->Auth->user('id');


        $faq = $this->Faqs->get($id, [
            'contain' => ['Users']
        ]);

       // $faqlist = $this->MenuBuilder->buildApplicantMenu('Ask Question', $faq->user->id);
       // $this->set('MenuItems', $ApplicantMenu);
   

        $this->set('faq', $faq);
         //   $this->set(compact('faq'));
        $this->set('_serialize', ['faq']);
          $ApplicantMenu = $this->MenuBuilder->buildApplicantMenu('Ask Question', $userId);
        $this->set('MenuItems', $ApplicantMenu);


*/

    }
    
    public function delete($id=null)
    {
       // debug($id);die;
        $userId = $this->Auth->user('id');
        $this->request->allowMethod(['post', 'delete']);
        $faq = $this->Faqs->get($id);
        if ($this->Faqs->delete($faq)) {
            $this->Flash->success(__('This Question has been deleted by Admin.'));
        } else {
            $this->Flash->error(__('The Question could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'viewAdmin', $userId]);
    }
   
    public function viewAdmin($id = null) {


        $faq = TableRegistry::get('Faqs');
        $this->paginate = [
            'contain' => ['Users', 'Countries']
        ];

        $faqs = $this->paginate($faq->find()->where(['Faqs.is_active' => 0]));

        $this->set(compact('faqs'));
        $this->set('_serialize', ['faqs']);
        //debug($faqs);die;  

        $faq1 = TableRegistry::get('Faqs');
        $this->paginate = [
            'contain' => ['Users', 'Countries']
        ];

        $faqs1 = $this->paginate($faq1->find()->where(['Faqs.is_active' => 1]));
        $this->set('title', 'ADMIN');
        $myAdminMenu = $this->MenuBuilder->buildAdminMenu('FAQS request', $this->Auth->user('id'));
        $this->set('MenuItems', $myAdminMenu);
        $this->set(compact('faqs1'));
        $this->set('_serialize', ['faqs1']);
        //debug($faqs);die; 
    }
   

    public function action($id) {
        $faqs = TableRegistry::get('Faqs');
        $faq = $faqs->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $faq = $faqs->patchEntity($faq, $this->request->data);
            $faq['is_active'] = 1;

            if ($faqs->save($faq)) {
                $this->Flash->success(__('The Question has been saved.'));
                return $this->redirect(['action' => 'viewAdmin']);
            } else {
                $this->Flash->error(__('The Question could not be saved. Please, try again.'));
            }
        }
        $this->set('title', 'ADMIN');


        $myAdminMenu = $this->MenuBuilder->buildAdminMenu('FAQS request', $this->Auth->user('id'));
        $this->set('MenuItems', $myAdminMenu);
       
        $this->set(compact('faq'));
        $this->set('_serialize', ['faq']);
    }
    
    public function edit($id) {
        $faqs = TableRegistry::get('Faqs');
        $faq = $faqs->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $faq = $faqs->patchEntity($faq, $this->request->data);

            if ($faqs->save($faq)) {
                $this->Flash->success(__('The admin has been saved.'));
                return $this->redirect(['action' => 'viewAdmin']);
            } else {
                $this->Flash->error(__('The admin could not be saved. Please, try again.'));
            }
        }
        $this->set('title', 'ADMIN');


        $myAdminMenu = $this->MenuBuilder->buildAdminMenu('FAQS request', $this->Auth->user('id'));
        $this->set('MenuItems', $myAdminMenu);
        $this->set(compact('faq'));
        $this->set('_serialize', ['faq']);
    }
}
