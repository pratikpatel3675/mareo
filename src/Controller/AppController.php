<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\I18n\I18n;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    public $_productName = 'Jami3ti Initiative';

    public $helpers = [
        'Form' => [
            'className' => 'Bootstrap.BootstrapForm' // instead of 'Bootstrap3.BootstrapForm'
        ]
    ];


    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('MenuBuilder');

        $this->loadComponent('Auth', [
            'authorize' => ['Controller'], // deleguates isAuthorised to the controllers
            'authenticate' => [
                'Form' => [
                    'finder' => 'auth',
                    'fields' => [
                        'username' => 'email',
                        'password' => 'password'
                    ]
                ]
            ],
           'loginAction' => [
              'controller' => 'Home',
              'action' => 'index'
             ],
            //'loginAction' => [
            //  'controller' => 'Users',
            //  'action' => 'login'
            //],
            'logoutRedirect' => [
              'plugin' => false,
              'controller' => 'Home',
              'action' => 'index'
            ],
            'unauthorizedRedirect' => [
              'plugin' => false,
              'controller' => 'Home',
              'action' => 'index'
            ]

        ]);

        $this->Auth->allow(['changeLanguage']);


    }

    public function isAuthorized($user)
    {
      // Admin can access every action
      if (isset($user['role']) && $user['role'] === 'admin') {
        return true;
      }
      // Default deny (unless there is an isAuthorized in a given controller)
      return false;
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event)
    {
        $cakeDescription = 'UNESCO Jami3ti Helps Bridging the Higher Education Gap';
        $this->set('cakeDescription', $cakeDescription);

        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }

        $session = $this->request->session();
        if (!$session->check('System.home')) {
          $session->write('System.home', ['plugin' => '', 'controller' => '', 'action' => '']);
        }

        if (!$session->check('System.language')) {
          $session->write('System.language.code', 'en_US' );
          $session->write('System.language.direction', 'ltr');
        }

        $lang = $session->read('System.language.code');
        $langDirection = $session->read('System.language.direction');
        //debug($lang);
        I18n::locale($lang);

        $homeUrl = ['plugin' => false, 'controller' => 'Home', 'action' => 'index'];
        $session->write('System.home', $homeUrl);

        $this->set('_productName', $this->_productName);
        $this->set('_language', $lang);
        $this->set ('_languageDirection', $langDirection);
        $this->set('_authUser', $this->Auth->user());

        if ($session->check('System.showLoginMenu')) {
          $_showLoginMenu = $session->read('System.showLoginMenu');
          $this->set('_showLoginMenu', $_showLoginMenu);
          $session->write('System.showLoginMenu', false );
        }


        $mainMenu = $this->MenuBuilder->buildMainMenu();
        $myProfileMenu = $this->MenuBuilder->buildMyProfileMenu();
        $this->set('_mainMenu', $mainMenu);
        $this->set('_myProfileMenu', $myProfileMenu);
        
    }

    public function changeLanguage($lang){
      $session = $this->request->session();
      if(!empty($lang)){
          if($lang == 'en_US'){
              $session->write('System.language.code', 'en_US');
              $session->write('System.language.direction', 'ltr');
              I18n::locale('en_US');
          }
          else if($lang == 'ar_JO'){
              $session->write('System.language.code', 'ar_JO');
              $session->write('System.language.direction', 'rtl');
              I18n::locale('ar_JO');
          }
          //in order to redirect the user to the page from which it was called
          $this->redirect($this->referer());
        }
    }
    
    public function upload(){
    
    if(!empty($this->requst->data)){

   $this->Upload->send($this->requst->data['uploadfile']);
     }



    }



  
  
}
