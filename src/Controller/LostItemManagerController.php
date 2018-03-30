<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * OpportunityManager Controller
 *
 * @property \App\Model\Table\OpportunityManagerTable $OpportunityManager
 */
class LostItemManagerController extends AppController
{


     
    public function isAuthorized($user = null){
        // Only the owner can edit and view
        if (in_array($this->request->action, ['viewLostItem'])) {
            $userId = (int)$this->request->params['pass'][0];
            if($this->Auth->user('id') == $userId) {
                return true;
            }
        }
        return parent::isAuthorized($user);
    }




  public function viewLostItem($id = null)
    {   

        $userId = $this->Auth->user('id');

        $lostitems = TableRegistry::get('LostItems')->find()->where(['user_id'=>$userId])
             ->contain(['Users',
                     'Countries', 
                      'ItemTypes']);
           
             

       //  debug($lostitems->toArray());die;



        $ApplicantMenu = $this->MenuBuilder->buildApplicantMenu('Lost items', $userId);
        $this->set('MenuItems', $ApplicantMenu);
        
        $this->set('lostitems', $lostitems);
        $this->set('_serialize', ['lostitems']);
    }


}
