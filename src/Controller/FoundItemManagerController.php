<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * OpportunityManager Controller
 *
 * @property \App\Model\Table\OpportunityManagerTable $OpportunityManager
 */
class FoundItemManagerController extends AppController
{


     
    public function isAuthorized($user = null){
        // Only the owner can edit and view
        if (in_array($this->request->action, ['viewFoundItem'])) {
            $userId = (int)$this->request->params['pass'][0];
            if($this->Auth->user('id') == $userId) {
                return true;
            }
        }
        return parent::isAuthorized($user);
    }




  public function viewFoundItem($id = null)
    {   

        $userId = $this->Auth->user('id');

        $founditems = TableRegistry::get('FoundItems')->find()->where(['user_id'=>$userId])
             ->contain(['Users',
                        'Countries', 
                        'ItemTypes']);
           
             

       // debug($founditems->toArray());die;



        $ApplicantMenu = $this->MenuBuilder->buildApplicantMenu('Found items', $userId);
        $this->set('MenuItems', $ApplicantMenu);
        
        $this->set('founditems', $founditems);
        $this->set('_serialize', ['founditems']);
    }


}
