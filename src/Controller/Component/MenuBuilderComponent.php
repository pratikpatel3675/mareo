<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class MenuBuilderComponent extends Component
{
    public function buildMainMenu()
    {
    	$mainMenu = [];

    	$session = $this->request->session();

    	// If a user exists, provide a custom menu 
    	if ($session->check('Auth.User.role')){
    		
    		$role = $session->read('Auth.User.role');

    		$mainMenu = [
	          'navbar_home' => [
	            'url' => ['plugin' => false, 'controller' => 'Home', 'action' => 'index']
	          ],
	          'navbar_countries' => [
	            'url' => ['plugin' => false, 'controller' => 'Countries', 'action' => 'listCountryPages']
	          ],
	          'Lost Items' => [
	            'url' => ['plugin' => false, 'controller' => 'LostItems', 'action' => 'index']
	          ],
	          'Found Items' => [
	            'url' => ['plugin' => false, 'controller' => 'FoundItems', 'action' => 'index']
	          ],
	          'navbar_faqs' => [
	            'url' => ['plugin' => false, 'controller' => 'Faqs', 'action' => 'index']
	          ],
	          'navbar_contact' => [
	            'url' => ['plugin' => false, 'controller' => 'Pages', 'action' => 'contact']
	          ],
	          'navbar_about' => [
	            'url' => ['plugin' => false, 'controller' => 'Pages', 'action' => 'about']
	          ]
	        ];
    	}
    	// Else, provide the default menu
    	else {

    		$mainMenu = [
	          'navbar_home' => [
	            'url' => ['plugin' => false, 'controller' => 'Home', 'action' => 'index']
	          ],
	          'navbar_countries' => [
	            'url' => ['plugin' => false, 'controller' => 'Countries', 'action' => 'listCountryPages']
	          ],
	          'navbar_opportunities' => [
	            'url' => ['plugin' => false, 'controller' => 'LostItems', 'action' => 'index']
	          ],
	          'navbar_faqs' => [
	            'url' => ['plugin' => false, 'controller' => 'Faqs/index', 'action' => 'fags']
	          ],
	          'navbar_contact' => [
	            'url' => ['plugin' => false, 'controller' => '', 'action' => 'contact']
	          ],
	          'navbar_about' => [
	            'url' => ['plugin' => false, 'controller' => 'Pages', 'action' => 'about']
	          ]
	        ];

    	}

        return $mainMenu;
    }

    public function buildMyProfileMenu()
    {
    	$myProfileMenu = [];

    	$session = $this->request->session();

    	// If a user exists, provide a custom menu 
    	if ($session->check('Auth.User.role')){

    		$role = $session->read('Auth.User.role');
    		$user_id = $session->read('Auth.User.id');

    		switch ($role) {
    			//
    			//	ADMIN ROLE
    			//
			    case 'admin':
			    	$myProfileMenu = [
					  'navbar_my_profile' => [
					    'url' => ['plugin' => false, 'controller' => 'About', 'action' => 'index'], 
					    'icon' => 'fa-info-circle'
					  ],
					  '_divider',
					  'navbar_logout' => [
					    'url' => ['plugin' => false, 'controller' => 'Users', 'action' => 'logout'],
					    'icon' => 'fa-power-off'
					  ]
					];
			        
			        break;
    			//
    			//	APPLICANT ROLE
    			//
			    case 'applicant':
			    	$myProfileMenu = [
					  'navbar_my_profile' => [
					    'url' => [
					    	'plugin' => false,
					    	'controller' => 'Users', 
					    	'action' => 'viewApplicant',
					    	 $session->read('Auth.User.id')], 
					    'icon' => 'fa-info-circle'
					  ],
					  '_divider',
					  'navbar_logout' => [
					    'url' => ['plugin' => false, 'controller' => 'Users', 'action' => 'logout'],
					    'icon' => 'fa-power-off'
					    ]
					];
			        break;

    			//
    			//	PROVIDER ROLE
    			//
			    case 'provider':
			    	$myProfileMenu = [
					  'navbar_provider_profile' => [
					    'url' => ['plugin' => false, 'controller' => 'Users', 'action' => 'viewProvider', $user_id], 
					    'icon' => 'fa-info-circle'
					  ],
					  '_divider',
					  'navbar_logout' => [
					    'url' => ['plugin' => false, 'controller' => 'Users', 'action' => 'logout'],
					    'icon' => 'fa-power-off'
					  
					    ]
					];
			        
			        break;

			    case 'donor':
			    	$myProfileMenu = [
					  'navbar_my_profile' => [
					    'url' => ['plugin' => false, 'controller' => 'About', 'action' => 'index'], 
					    'icon' => 'fa-info-circle'
					  ],
					  '_divider',
					  'navbar_logout' => [
					    'url' => ['plugin' => false, 'controller' => 'Users', 'action' => 'logout'],
					    'icon' => 'fa-power-off'
					  ]
					];
			        
			        break;

			}
    	}
    	
        return $myProfileMenu;
    }

    public function buildApplicantMenu($selectedMenuItem = 'applicant_menu_overview', $userId)
    {
    	$myApplicantMenu = [];

        $myApplicantMenu['applicant_menu_account'] = [
			    'url' => ['plugin' => false, 'controller' => 'Users', 'action' => 'viewApplicant', $userId],
			    'class' => ''
			  ]; 

    	$applicantGenerals = TableRegistry::get('ApplicantGenerals');
        $applicantGeneral = $applicantGenerals
            ->find()
            ->where(['user_id' => $userId])
            ->first();
       //debug($applicantGeneral);die;
        if($applicantGeneral){
        	
        	$myApplicantMenu['applicant_menu_general'] = [
					    'url' => ['plugin' => false, 'controller' => 'ApplicantGenerals', 'action' => 'view', $applicantGeneral->id],
					    'class' => ''
					  ];
        } else {
        	$myApplicantMenu['applicant_menu_general'] = [
					    'url' => ['plugin' => false, 'controller' => 'ApplicantGenerals', 'action' => 'add'],
					    'class' => ''
					  ];        	
        }

       
        $faqs = TableRegistry::get('Faqs');
        $faq = $faqs
            ->find()
            ->where(['user_id' => $userId])
            ->first();
        if($faq){
           	$myApplicantMenu['Ask Question'] = [
					    'url' => ['plugin' => false, 'controller' => 'Faqs', 'action' => 'view', $faq->id],
					    'class' => ''
					  ]; 
             } else {
            $myApplicantMenu['Ask Question'] = [
					    'url' => ['plugin' => false, 'controller' => 'Faqs', 'action' => 'add'],
					    'class' => ''
					  ]; 	
             }

            $myApplicantMenu['Lost items'] = [
					    'url' => ['plugin' => false, 'controller' => 'LostItemManager', 'action' => 'viewLostItem', $userId],
					    'class' => ''
					  ]; 

            $myApplicantMenu['Found items'] = [
					    'url' => ['plugin' => false, 'controller' => 'FoundItemManager', 'action' => 'viewFoundItem', $userId],
					    'class' => ''
					  ]; 




    	$myApplicantMenu[$selectedMenuItem]['class'] = 'active';

        return $myApplicantMenu;
    }

public function buildProviderMenu($selectedMenuItem = 'provider_menu_account', $userId)
    {
    	$myProviderMenu = [];

        $myProviderMenu['provider_menu_account'] = [
			    'url' => ['plugin' => false, 'controller' => 'Users', 'action' => 'viewProvider', $userId],
			    'class' => ''
			  ]; 


		$myProviderMenu['provider_list_of_opportunities'] = [
			    'url' => ['plugin' => false, 'controller' => 'ProviderOfficesController', 'action' => 'index', $userId],
			    'class' => ''
			  ]; 

    	$myProviderMenu[$selectedMenuItem]['class'] = 'active';

        return $myProviderMenu;
    }
}