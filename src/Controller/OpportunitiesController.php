<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Mailer\Email;

/**
 * Opportunities Controller
 *
 * @property \App\Model\Table\OpportunitiesTable $Opportunities
 * @property \App\Model\Table\AdminsTable $Admins
 */
class OpportunitiesController extends AppController {

    public function beforeFilter(\Cake\Event\Event $event) {
        $this->Auth->allow(['index', 'view', 'search','action']);


        $session = $this->request->session();
        $lang = $session->read('System.language.code');
        if ($lang == 'en_US') {
            \Cake\I18n\I18n::locale('en_US');
        } else {
            \Cake\I18n\I18n::locale('ar_JO');
        }
    }

    public function isAuthorized($user) {
     
      if (in_array($this->request->action,['action','viewAdmin']) && $this->Auth->user('role') == 'admin' && $this->Auth->user('id') == '2861' ) {
            
        return true;
        }


        if (in_array($this->request->action, ['viewProvider', 'edit', 'delete','viewMessage','sendEmailToRecommendedUsers','addRecommandedApplicant'])) {
            $opportuntyId = (int) $this->request->params['pass'][0];

            $authorisedOpportunities = $this->Opportunities
                    ->find('ownedBy', ['user_id' => $this->Auth->user('id')])
                    ->where(['Opportunities.id' => $opportuntyId])
                    ->first();
           
            if ($authorisedOpportunities != null || $this->Auth->user('role') == 'admin') {
            if ($this->Auth->user('role') == 'provider' || $this->Auth->user('role') == 'subprovider') {
                    return true;
                }
}
   



   }
        if (in_array($this->request->action, ['add'])) {
            $office = (int)$this->request->params['pass'][0];
             if( TableRegistry::get('ProviderOfficeUsers')->isOwnedBy($office, $this->Auth->user('id'))  || $this->Auth->user('role') == 'admin') {
                if ($this->Auth->user('role') == 'provider' || $this->Auth->user('role') == 'subprovider' )
                {
                 return true;
                 }
                }
             }
        
        return parent::isAuthorized($user);
    }

    public function search($key) {

        $this->viewBuilder()->layout('ajax');
        $this->response->type('application/json');

        $opportunities = [];

        $session = $this->request->session();
        $lang = $session->read('System.language.code');
        if ($lang == 'en_US') {
            $sql = "
                select distinct
                    o.id `id`, o.name_en `opportunity_name`, o.description_en `opportunity_desc`, o.application_end_date `opportunity_end_date`, o.seats `opportunity_seats`, 
                    od.name_en `opportunity_duration`,
                    os.name_en `opportunity_scope`,
                    c.name_en `country`,
                    ofoss.name_en `education_field_of_study_sub`,
                    ofosc.name_en `education_field_of_study_core`,
                    iscedn.name_en `education_isced_narrow`,
                    odt.name_en `education_desired_type`,
                    po.name `provider_office`
                from opportunities as o
                left join donation_campaign_providers dcp on dcp.id = o.donation_campaign_provider_id
                left join provider_offices po on po.id = dcp.provider_office_id
                left join opportunity_durations as od on od.id = o.opportunity_duration_id
                left join opportunity_scopes as os on os.id = o.opportunity_scope_id 
                left join opportunity_countries as oc on o.id = oc.opportunity_id
                left join countries as c on c.id = oc.country_id 
                left join opportunity_educations as oe on o.id = oe.opportunity_id
                left join education_field_of_study_subs as ofoss on ofoss.id = oe.education_field_of_study_sub_id
                left join education_field_of_study_cores as ofosc on ofoss.education_field_of_study_core_id = ofosc.id
                left join education_isced_narrow_fields as iscedn on iscedn.id = ofoss.education_isced_narrow_field_id
                left join opportunity_education_types as oet on o.id = oet.opportunity_id
                left join education_desired_types as odt on oet.education_desired_type_id = odt.id
                left join opportunity_institutions as oinst on oinst.opportunity_id = o.id
                left join institution_higher_educations as inst on inst.id = oinst.institution_higher_education_id
                where o.name_en like :key  
                or o.description_en like :key 
                or po.name like :key 
                or c.name_en like :key   
                or ofoss.name_en like :key 
                or ofosc.name_en like :key 
                or iscedn.name_en like :key  
                or odt.name_en like :key 
                or inst.name like :key 
                group by o.id
            ";
        } else {
            $sql = "
                select distinct
                    o.id `id`, o.name_ara `opportunity_name`, o.description_ara `opportunity_desc`, o.application_end_date `opportunity_end_date`, o.seats `opportunity_seats`, 
                    od.name_ara `opportunity_duration`,
                    os.name_ara `opportunity_scope`,
                    c.name_ara `country`,
                    ofoss.name_ara `education_field_of_study_sub`,
                    ofosc.name_ara `education_field_of_study_core`,
                    iscedn.name_ara `education_isced_narrow`,
                    odt.name_ara `education_desired_type`,
                    po.name `provider_office`
                from opportunities as o
                left join donation_campaign_providers dcp on dcp.id = o.donation_campaign_provider_id
                left join provider_offices po on po.id = dcp.provider_office_id
                left join opportunity_durations as od on od.id = o.opportunity_duration_id
                left join opportunity_scopes as os on os.id = o.opportunity_scope_id 
                left join opportunity_countries as oc on o.id = oc.opportunity_id
                left join countries as c on c.id = oc.country_id 
                left join opportunity_educations as oe on o.id = oe.opportunity_id
                left join education_field_of_study_subs as ofoss on ofoss.id = oe.education_field_of_study_sub_id
                left join education_field_of_study_cores as ofosc on ofoss.education_field_of_study_core_id = ofosc.id
                left join education_isced_narrow_fields as iscedn on iscedn.id = ofoss.education_isced_narrow_field_id
                left join opportunity_education_types as oet on o.id = oet.opportunity_id
                left join education_desired_types as odt on oet.education_desired_type_id = odt.id
                left join opportunity_institutions as oinst on oinst.opportunity_id = o.id
                left join institution_higher_educations as inst on inst.id = oinst.institution_higher_education_id
                where o.name_ara like :key  
                or o.description_ara like :key 
                or po.name like :key 
                or c.name_ara like :key   
                or ofoss.name_ara like :key  
                or ofosc.name_ara like :key  
                or iscedn.name_ara like :key  
                or odt.name_ara like :key 
                or inst.name like :key 
                group by o.id
            ";
        }

        $connection = ConnectionManager::get('default');
        $opportunities = $connection
                ->execute($sql, ['key' => "%" . $key . "%"], ['key' => 'string'])
                ->fetchAll('assoc');


        $this->set('data', $opportunities);
        $this->render('/Element/ajaxreturn');
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $this->paginate = [
            'contain' => ['OpportunityDurations', 'DonationCampaignProviders', 'DonationCampaignProviders.ProviderOffices', 'OpportunityScopes',
                'OpportunityCountries', 'OpportunityCountries.Countries', 'OpportunityInstitutions',
                'OpportunityEducations', 'OpportunityEducationTypes'
            ]
        ];
        //$faqs = $this->paginate($faq->find()->where(['Faqs.is_active' => 0]));

        $search = $this->request->data;

        //debug($search);
        // Create a complex search on many to many linked tables....
        if ($search != null) {
            $key = $search['keyword'];
        } else {
            $key = '';
        }


        $session = $this->request->session();
        $lang = $session->read('System.language.code');
        if ($lang == 'en_US') {
            $sql = "
                select distinct
                    o.id `id`, o.name_en `opportunity_name`, o.description_en `opportunity_desc`, o.application_end_date `opportunity_end_date`, o.seats `opportunity_seats`, 
                    od.name_en `opportunity_duration`,
                    os.name_en `opportunity_scope`,
                    c.name_en `country`,
                    ofoss.name_en `education_field_of_study_sub`,
                    ofosc.name_en `education_field_of_study_core`,
                    iscedn.name_en `education_isced_narrow`,
                    odt.name_en `education_desired_type`,
                    po.name `provider_office`
                from opportunities as o
                left join donation_campaign_providers dcp on dcp.id = o.donation_campaign_provider_id
                left join provider_offices po on po.id = dcp.provider_office_id
                left join opportunity_durations as od on od.id = o.opportunity_duration_id
                left join opportunity_scopes as os on os.id = o.opportunity_scope_id 
                left join opportunity_countries as oc on o.id = oc.opportunity_id
                left join countries as c on c.id = oc.country_id 
                left join opportunity_educations as oe on o.id = oe.opportunity_id
                left join education_field_of_study_subs as ofoss on ofoss.id = oe.education_field_of_study_sub_id
                left join education_field_of_study_cores as ofosc on ofoss.education_field_of_study_core_id = ofosc.id
                left join education_isced_narrow_fields as iscedn on iscedn.id = ofoss.education_isced_narrow_field_id
                left join opportunity_education_types as oet on o.id = oet.opportunity_id
                left join education_desired_types as odt on oet.education_desired_type_id = odt.id
                left join opportunity_institutions as oinst on oinst.opportunity_id = o.id
                left join institution_higher_educations as inst on inst.id = oinst.institution_higher_education_id
                where (o.name_en like :key  
                or o.description_en like :key 
                or po.name like :key 
                or c.name_en like :key   
                or ofoss.name_en like :key 
                or ofosc.name_en like :key 
                or iscedn.name_en like :key  
                or odt.name_en like :key 
                or inst.name like :key ) and o.is_active='1'

                group by o.id
            ";
        } else {
            $sql = "
                select distinct
                    o.id `id`, o.name_ara `opportunity_name`, o.description_ara `opportunity_desc`, o.application_end_date `opportunity_end_date`, o.seats `opportunity_seats`, 
                    od.name_ara `opportunity_duration`,
                    os.name_ara `opportunity_scope`,
                    c.name_ara `country`,
                    ofoss.name_ara `education_field_of_study_sub`,
                    ofosc.name_ara `education_field_of_study_core`,
                    iscedn.name_ara `education_isced_narrow`,
                    odt.name_ara `education_desired_type`,
                    po.name `provider_office`
                from opportunities as o
                left join donation_campaign_providers dcp on dcp.id = o.donation_campaign_provider_id
                left join provider_offices po on po.id = dcp.provider_office_id
                left join opportunity_durations as od on od.id = o.opportunity_duration_id
                left join opportunity_scopes as os on os.id = o.opportunity_scope_id 
                left join opportunity_countries as oc on o.id = oc.opportunity_id
                left join countries as c on c.id = oc.country_id 
                left join opportunity_educations as oe on o.id = oe.opportunity_id
                left join education_field_of_study_subs as ofoss on ofoss.id = oe.education_field_of_study_sub_id
                left join education_field_of_study_cores as ofosc on ofoss.education_field_of_study_core_id = ofosc.id
                left join education_isced_narrow_fields as iscedn on iscedn.id = ofoss.education_isced_narrow_field_id
                left join opportunity_education_types as oet on o.id = oet.opportunity_id
                left join education_desired_types as odt on oet.education_desired_type_id = odt.id
                left join opportunity_institutions as oinst on oinst.opportunity_id = o.id
                left join institution_higher_educations as inst on inst.id = oinst.institution_higher_education_id
                where (o.name_ara like :key  
                or o.description_ara like :key 
                or po.name like :key 
                or c.name_ara like :key   
                or ofoss.name_ara like :key  
                or ofosc.name_ara like :key  
                or iscedn.name_ara like :key  
                or odt.name_ara like :key 
                or inst.name like :key ) and o.is_active='1'
                group by o.id
            ";
        }

        $connection = ConnectionManager::get('default');
        $opportunities = $connection
                ->execute($sql, ['key' => "%" . $key . "%"], ['key' => 'string'])
                ->fetchAll('assoc');

        //debug($opportunities);




        $this->set(compact('opportunities'));
        $this->set('_serialize', ['opportunities']);


        /* OLD cakephp way...
          if ($search == null || $search['keyword'] == null ) {
          $opportunities = $this->paginate($this->Opportunities);
          } else {
          $keyword = $search['keyword'];
          $session = $this->request->session();
          $lang = $session->read('System.language.code');
          if ($lang == 'en_US'){
          $opportunities = $this->paginate(
          $this->Opportunities->find()
          ->where(function ($exp, $q) use ($keyword) {
          return $exp->like('Opportunities.name_en', '%'.h($keyword).'%');
          })
          ->orwhere(function ($exp, $q) use ($keyword) {
          return $exp->like('Opportunities.description_en', '%'.h($keyword).'%');
          })
          ->orwhere(function ($exp, $q) use ($keyword) {
          return $exp->like('OpportunityDurations.name_en', '%'.h($keyword).'%');
          })
          ->orwhere(function ($exp, $q) use ($keyword) {
          return $exp->like('OpportunityScopes.name_en', '%'.h($keyword).'%');
          })
          );
          }
          else{
          $opportunities = $this->paginate(
          $this->Opportunities->find()
          ->where(function ($exp, $q) use ($keyword) {
          return $exp->like('Opportunities.name_ara', '%'.h($keyword).'%');
          })
          ->orwhere(function ($exp, $q) use ($keyword) {
          return $exp->like('Opportunities.description_ara', '%'.h($keyword).'%');
          })
          ->orwhere(function ($exp, $q) use ($keyword) {
          return $exp->like('OpportunityDurations.name_ara', '%'.h($keyword).'%');
          })
          ->orwhere(function ($exp, $q) use ($keyword) {
          return $exp->like('OpportunityScopes.name_ara', '%'.h($keyword).'%');
          })
          );
          }

          }

          //debug($opportunities);

          $this->set(compact('opportunities'));
          $this->set('_serialize', ['opportunities']);
         */
    }

    /**
     * View method
     *
     * @param string|null $id Opportunity id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $opportunity = $this->Opportunities->get($id, [
            'contain' => ['OpportunityDurations', 'DonationCampaignProviders', 'DonationCampaignProviders.ProviderOffices', 'OpportunityScopes', 'Currencies', 'Countries', 'Institutions', 'EducationTypes', 'EducationSubs', 'OpportunityApplications']
                ]);

        $this->set('opportunity', $opportunity);
        $this->set('_serialize', ['opportunity']);
    }

    public function viewProvider($id = null) {
        $opportunity = $this->Opportunities->get($id, [
            'contain' => [
                'OpportunityDurations',
                'DonationCampaignProviders',
                'DonationCampaignProviders.ProviderOffices',
                'DonationCampaignProviders.DonationCampaigns',
                'DonationCampaignProviders.DonationCampaigns.Donors',
                'OpportunityScopes',
                'OpportunityCountries',
                'OpportunityCountries.Countries',
                'OpportunityEducations',
                'OpportunityEducations.EducationFieldOfStudySubs',
                'OpportunityEducationTypes',
                'OpportunityEducationTypes.EducationDesiredTypes',
                'OpportunityInstitutions.InstitutionHigherEducations',
                'OpportunityInstitutions.InstitutionHigherEducations.Countries',
                'Currencies',
                'OpportunityApplications'
            ]
                ]);

        //debug($opportunity->toArray());
//       echo "<pre>";
//        print_r($opportunity->opportunity_countries);die;
        $this->set('opportunity', $opportunity);
        $this->set('_serialize', ['opportunity']);


        $nbApplicantSeekers = TableRegistry::get('OpportunityApplications')->find()
                ->where(['opportunity_id' => $id])
                ->andWhere(['opportunity_application_status_id' => 1])
                ->count();

        $nbApplicantAccepted = TableRegistry::get('OpportunityApplications')->find()
                ->Where(['opportunity_application_status_id' => 2])
                ->orWhere(['opportunity_application_status_id' => 4])
                ->andwhere(['opportunity_id' => $id])
                ->count();

        if ($opportunity->seats != null && $opportunity->seats != 0) {
            $percentage = $nbApplicantAccepted / $opportunity->seats * 100;
        } else {
            $percentage = 0;
        }

        $this->set('nbApplicantSeekers', $nbApplicantSeekers);
        $this->set('nbApplicantAccepted', $nbApplicantAccepted);
        $this->set('percentage', $percentage);

        $title = $opportunity->donation_campaign_provider->provider_office->name;
        $this->set('title', $title);

        $ProviderOfficeMenu = $this->MenuBuilder->buildProviderOfficeMenu('provider_office_opportunity_manager', $opportunity->donation_campaign_provider->provider_office_id);
        $this->set('MenuItems', $ProviderOfficeMenu);

        $userInformation = $this->getRecommededApplication($opportunity);
        $this->set('userInformation', $userInformation);
       
        //////////////////////////////////////////////////


/////////////////////////////////////////////

        $this->paginate = [
            'contain' => ['Opportunities','Users']
        ];
        $this->loadModel('Messages');

        $opportunityMessages = $this->paginate($this->Messages->find()->where(['Messages.opportunity_id' => $id, 'Messages.is_active' => 0]));
            $this->set(compact('opportunityMessages'));
            $this->set('_serialize', ['opportunityMessages']);


        $this->paginate = [
            'contain' => ['Opportunities','Users']
        ];
        $opportunityMessages1 = $this->paginate($this->Messages->find()->where(['Messages.opportunity_id' => $id, 'Messages.is_active' => 1]));
            $this->set(compact('opportunityMessages1'));
            $this->set('_serialize', ['opportunityMessages1']);



    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($providerOfficeId) {
        $opportunity = $this->Opportunities->newEntity();
        if ($this->request->is('post')) {
            $opportunity = $this->Opportunities->patchEntity($opportunity, $this->request->data);
            $opportunity['is_active'] = 0;

            if ($this->Opportunities->save($opportunity)) {
                $this->Flash->success(__('The opportunity has been saved.'));
                return $this->redirect(['controller' => 'Opportunities', 'action' => 'viewProvider', $opportunity->id]);
            } else {
                $this->Flash->error(__('The opportunity could not be saved. Please, try again.'));
            }
        }
        $opportunityDurations = $this->Opportunities->OpportunityDurations->find('list', ['limit' => 200]);
        $opportunityScopes = $this->Opportunities->OpportunityScopes->find('list', ['limit' => 200]);
        $currencies = $this->Opportunities->Currencies->find('list', ['limit' => 200]);



        $donationCampaignProviders = TableRegistry::get('DonationCampaignProviders')->find()
                ->contain(['DonationCampaigns', 'DonationCampaigns.Donors'])
                ->where(['provider_office_id' => $providerOfficeId])
                ->map(function ($row) { // map() is a collection method, it executes the query
                            $row->trimmedTitle = $row->donation_campaign->name . ' - ' . $row->donation_campaign->donor->name;
                            return $row;
                        })
                ->combine('id', 'trimmedTitle') // combine() is another collection method
                ->toArray(); // Also a collections library method
        //debug($donationCampaignProviders);

        $this->set(compact('opportunity', 'opportunityDurations', 'donationCampaignProviders', 'opportunityScopes', 'currencies'));
        $this->set('_serialize', ['opportunity']);


        $providerOffice = TableRegistry::get('ProviderOffices')->get($providerOfficeId);
        $this->set('title', $providerOffice->name);

        $ProviderOfficeMenu = $this->MenuBuilder->buildProviderOfficeMenu('provider_office_opportunity_manager', $providerOfficeId);
        $this->set('MenuItems', $ProviderOfficeMenu);
    }

    /**
     * Edit method
     *
     * @param string|null $id Opportunity id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $opportunity = $this->Opportunities->get($id, [
            'contain' => ['DonationCampaignProviders', 'DonationCampaignProviders.ProviderOffices']
                ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $opportunity = $this->Opportunities->patchEntity($opportunity, $this->request->data);
            if ($this->Opportunities->save($opportunity)) {
                $this->Flash->success(__('The opportunity has been saved.'));
                return $this->redirect(['action' => 'viewProvider', $opportunity->id]);
            } else {
                $this->Flash->error(__('The opportunity could not be saved. Please, try again.'));
            }
        }
        $opportunityDurations = $this->Opportunities->OpportunityDurations->find('list', ['limit' => 200]);
        $opportunityScopes = $this->Opportunities->OpportunityScopes->find('list', ['limit' => 200]);
        $currencies = $this->Opportunities->Currencies->find('list', ['limit' => 200]);

        $donationCampaignProviders = $this->Opportunities->DonationCampaignProviders->find()
                ->contain(['DonationCampaigns', 'DonationCampaigns.Donors'])
                ->where(['provider_office_id' => $opportunity->donation_campaign_provider->provider_office_id])
                ->map(function ($row) { // map() is a collection method, it executes the query
                            $row->trimmedTitle = $row->donation_campaign->name . ' - ' . $row->donation_campaign->donor->name;
                            return $row;
                        })
                ->combine('id', 'trimmedTitle') // combine() is another collection method
                ->toArray(); // Also a collections library method

        $this->set(compact('opportunity', 'opportunityDurations', 'donationCampaignProviders', 'opportunityScopes', 'currencies'));
        $this->set('_serialize', ['opportunity']);

        $providerOffice = $opportunity->donation_campaign_provider->provider_office;
        $this->set('title', $providerOffice->name);

        $ProviderOfficeMenu = $this->MenuBuilder->buildProviderOfficeMenu('provider_office_opportunity_manager', $opportunity->donation_campaign_provider->provider_office_id);
        $this->set('MenuItems', $ProviderOfficeMenu);
    }

    /**
     * Delete method
     *
     * @param string|null $id Opportunity id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $opportunity = $this->Opportunities->get($id);
        if ($this->Opportunities->delete($opportunity)) {
            $this->Flash->success(__('The opportunity has been deleted.'));
        } else {
            $this->Flash->error(__('The opportunity could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    /** This function is used for sending an email to recommeded applicant
     * 
     */
    public function sendEmailToRecommendedUsers() {
        $this->loadModel('Admins');
        $adminData = $this->Admins->newEntity();
        if ($this->request->is('post')) {
           $this->request->data['user_id'] = $this->Auth->user('id');
           $this->request->data['is_active'] = 0;
           $this->request->data['type'] = 1;
            $adminEntry = $this->Admins->patchEntity($adminData, $this->request->data);
            if ($this->Admins->save($adminEntry)) {
                  $this->Flash->success(__('Approval request has been sent'));
                  $this->redirect($this->referer());
            }
        }
    }

  /**
     *
     * @param type $opportunity
     * @return type
     */

    public  function getRecommededApplication($opportunity = []) {

        $fieldOfstudyIds = $educationTypeIds = $countryIds = $institutionsIds = [];

        if (count($opportunity->opportunity_educations) > 0) {
            foreach ($opportunity->opportunity_educations as $educationSub) {
                $fieldOfstudyIds[] = $educationSub['education_field_of_study_sub_id'];
            }
        }

        if (count($opportunity->opportunity_education_types) > 0) {
            foreach ($opportunity->opportunity_education_types as $educationTypes) {
                $educationTypeIds[] = $educationTypes['education_desired_type_id'];
            }
        }

        if (count($opportunity->opportunity_countries) > 0) {
            foreach ($opportunity->opportunity_countries as $opportunityCountries) {
                $countryIds[] = $opportunityCountries['country_id'];
            }
        }
        if (count($opportunity->opportunity_institutions) > 0) {
            foreach ($opportunity->opportunity_institutions as $opportunityInstitutions) {
                $institutionsIds[] = $opportunityInstitutions['institution_higher_education_id'];
            }
        }

        $applicantDesiredEducations = $applicantDesiredEducationTypes = $applicantDesiredCountries = $applicantDesiredInstitution = [];

        if (!empty($fieldOfstudyIds)) {
            $this->loadModel('ApplicantDesiredEducations');
            $applicantDesiredEducations = $this->ApplicantDesiredEducations->find('list', array('keyField' => 'id', 'valueField' => 'user_id', 'conditions' => array('education_field_of_study_sub_id IN' => $fieldOfstudyIds),
                    ))->toArray();
        }
        if (!empty($educationTypeIds)) {
            $this->loadModel('ApplicantDesiredEducationTypes');
            $applicantDesiredEducationTypes = $this->ApplicantDesiredEducationTypes->find('list', array('keyField' => 'id', 'valueField' => 'user_id', 'conditions' => array('education_desired_type_id IN' => $educationTypeIds),
                    ))->toArray();
        }

        if (!empty($countryIds)) {
            $this->loadModel('ApplicantDesiredCountries');
            $applicantDesiredCountries = $this->ApplicantDesiredCountries->find('list', array('keyField' => 'id', 'valueField' => 'user_id', 'conditions' => array('country_id IN' => $countryIds),
                    ))->toArray();
        }
        if (!empty($institutionsIds)) {
            $this->loadModel('ApplicantDesiredInstitutions');
            $applicantDesiredInstitution = $this->ApplicantDesiredInstitutions->find('list', array('keyField' => 'id', 'valueField' => 'user_id', 'conditions' => array('institution_higher_education_id IN' => $institutionsIds),
                    ))->toArray();
        }

        if (!empty($applicantDesiredEducations) && !empty($applicantDesiredEducationTypes) && !empty($applicantDesiredCountries) && !empty($applicantDesiredInstitution)) {
            $commonUserIds = array_intersect($applicantDesiredEducations, $applicantDesiredEducationTypes, $applicantDesiredCountries, $applicantDesiredInstitution);
        } else if (!empty($applicantDesiredEducations) && !empty($applicantDesiredEducationTypes) && !empty($applicantDesiredCountries) && empty($applicantDesiredInstitution)) {
            $commonUserIds = array_intersect($applicantDesiredEducations, $applicantDesiredEducationTypes, $applicantDesiredCountries);
        } else if (!empty($applicantDesiredEducations) && !empty($applicantDesiredEducationTypes) && empty($applicantDesiredCountries) && !empty($applicantDesiredInstitution)) {
            $commonUserIds = array_intersect($applicantDesiredEducations, $applicantDesiredEducationTypes, $applicantDesiredInstitution);
        } else if (!empty($applicantDesiredEducations) && empty($applicantDesiredEducationTypes) && !empty($applicantDesiredCountries) && !empty($applicantDesiredInstitution)) {
            $commonUserIds = array_intersect($applicantDesiredEducations, $applicantDesiredCountries, $applicantDesiredInstitution);
        } else if (empty($applicantDesiredEducations) && !empty($applicantDesiredEducationTypes) && !empty($applicantDesiredCountries) && !empty($applicantDesiredInstitution)) {
            $commonUserIds = array_intersect($applicantDesiredEducationTypes, $applicantDesiredCountries, $applicantDesiredInstitution);
        } else if (!empty($applicantDesiredEducations) && !empty($applicantDesiredEducationTypes) && empty($applicantDesiredCountries) && empty($applicantDesiredInstitution)) {
            $commonUserIds = array_intersect($applicantDesiredEducations, $applicantDesiredEducationTypes);
        } else if (!empty($applicantDesiredEducations) && empty($applicantDesiredEducationTypes) && !empty($applicantDesiredCountries) && empty($applicantDesiredInstitution)) {
            $commonUserIds = array_intersect($applicantDesiredEducations, $applicantDesiredCountries);
        } else if (!empty($applicantDesiredEducations) && empty($applicantDesiredEducationTypes) && empty($applicantDesiredCountries) && !empty($applicantDesiredInstitution)) {
            $commonUserIds = array_intersect($applicantDesiredEducations, $applicantDesiredInstitution);
        } else if (empty($applicantDesiredEducations) && !empty($applicantDesiredEducationTypes) && !empty($applicantDesiredCountries) && empty($applicantDesiredInstitution)) {
            $commonUserIds = array_intersect($applicantDesiredEducationTypes, $applicantDesiredCountries);
        } else if (empty($applicantDesiredEducations) && !empty($applicantDesiredEducationTypes) && empty($applicantDesiredCountries) && !empty($applicantDesiredInstitution)) {
            $commonUserIds = array_intersect($applicantDesiredEducationTypes, $applicantDesiredInstitution);
        } else if (empty($applicantDesiredEducations) && empty($applicantDesiredEducationTypes) && !empty($applicantDesiredCountries) && !empty($applicantDesiredInstitution)) {
            $commonUserIds = array_intersect($applicantDesiredCountries, $applicantDesiredInstitution);
        } else if (!empty($applicantDesiredEducations) && empty($applicantDesiredEducationTypes) && empty($applicantDesiredCountries) && empty($applicantDesiredInstitution)) {
            $commonUserIds = $applicantDesiredEducations;
        } else if (empty($applicantDesiredEducations) && !empty($applicantDesiredEducationTypes) && empty($applicantDesiredCountries) && empty($applicantDesiredInstitution)) {
            $commonUserIds = $applicantDesiredEducationTypes;
        } else if (empty($applicantDesiredEducations) && empty($applicantDesiredEducationTypes) && !empty($applicantDesiredCountries) && empty($applicantDesiredInstitution)) {
            $commonUserIds = $applicantDesiredCountries;
        } else if (empty($applicantDesiredEducations) && empty($applicantDesiredEducationTypes) && empty($applicantDesiredCountries) && !empty($applicantDesiredInstitution)) {
            $commonUserIds = $applicantDesiredInstitution;
        } else if (empty($applicantDesiredEducations) && empty($applicantDesiredEducationTypes) && empty($applicantDesiredCountries) && empty($applicantDesiredInstitution)) {
            $commonUserIds = 0;
        } else {
            $this->loadModel('Users');
            $commonUserIds = $this->Users->find('list', array('keyField' => 'id', 'valueField' => 'id', 'conditions' => array('role' => 'applicant', 'active' => 1),
                    ))->toArray();
        }
        //$commonUserIds = array_intersect($applicantDesiredEducations, $applicantDesiredEducationTypes, $applicantDesiredCountries, $applicantDesiredInstitution);
        $userInformation = [];
        if (count($commonUserIds) > 0) {
            $userInformation = TableRegistry::get('Users')->find('all', array('conditions' => array('active' => 1, 'role' => 'applicant', 'id IN' => $commonUserIds),
                    ))
                    ->toArray();
        }
        return $userInformation;
    }
    public function viewMessage($id = null) {
        $opportunity = $this->Opportunities->get($id, [
            'contain' => [
                'OpportunityDurations',
                'DonationCampaignProviders',
                'DonationCampaignProviders.ProviderOffices',
                'DonationCampaignProviders.DonationCampaigns',
                'DonationCampaignProviders.DonationCampaigns.Donors',
                'OpportunityScopes',
                'OpportunityCountries',
                'OpportunityCountries.Countries',
                'OpportunityEducations',
                'OpportunityEducations.EducationFieldOfStudySubs',
                'OpportunityEducationTypes',
                'OpportunityEducationTypes.EducationDesiredTypes',
                'OpportunityInstitutions.InstitutionHigherEducations',
                'OpportunityInstitutions.InstitutionHigherEducations.Countries',
                'Currencies',
                'OpportunityApplications'
            ]
                ]);

        //debug($opportunity->toArray());
//       echo "<pre>";
//        print_r($opportunity->opportunity_countries);die;
        $this->set('opportunity', $opportunity);
        $this->set('_serialize', ['opportunity']);


        $nbApplicantSeekers = TableRegistry::get('OpportunityApplications')->find()
                ->where(['opportunity_id' => $id])
                ->andWhere(['opportunity_application_status_id' => 1])
                ->count();

        $nbApplicantAccepted = TableRegistry::get('OpportunityApplications')->find()
                ->Where(['opportunity_application_status_id' => 2])
                ->orWhere(['opportunity_application_status_id' => 4])
                ->andwhere(['opportunity_id' => $id])
                ->count();

        if ($opportunity->seats != null && $opportunity->seats != 0) {
            $percentage = $nbApplicantAccepted / $opportunity->seats * 100;
        } else {
            $percentage = 0;
        }

        $this->set('nbApplicantSeekers', $nbApplicantSeekers);
        $this->set('nbApplicantAccepted', $nbApplicantAccepted);
        $this->set('percentage', $percentage);

        $title = $opportunity->donation_campaign_provider->provider_office->name;
        $this->set('title', $title);

        $ProviderOfficeMenu = $this->MenuBuilder->buildProviderOfficeMenu('provider_office_opportunity_manager', $opportunity->donation_campaign_provider->provider_office_id);
        $this->set('MenuItems', $ProviderOfficeMenu);

        $userInformation = $this->getRecommededApplication($opportunity);
        $this->set('userInformation', $userInformation);
 
        $this->paginate = [
            'contain' => ['Opportunities','Users']
        ];
        $this->loadModel('Messages');

        $opportunityMessages = $this->paginate($this->Messages->find()->where(['Messages.opportunity_id' => $id, 'Messages.is_active' => 0]));
            $this->set(compact('opportunityMessages'));
            $this->set('_serialize', ['opportunityMessages']);


        $this->paginate = [
            'contain' => ['Opportunities','Users']
        ];
        $opportunityMessages1 = $this->paginate($this->Messages->find()->where(['Messages.opportunity_id' => $id, 'Messages.is_active' => 1]));
            $this->set(compact('opportunityMessages1'));
            $this->set('_serialize', ['opportunityMessages1']);



    }
 public function viewAdmin()
    {

      

        $this->paginate = [
            'contain' => ['OpportunityDurations',
                     'DonationCampaignProviders', 'DonationCampaignProviders.ProviderOffices',
                     'DonationCampaignProviders.DonationCampaigns',
                     'DonationCampaignProviders.DonationCampaigns.Donors',
                      'OpportunityScopes',
                      'Currencies']
        ];
        $opportunitiesLists = $this->paginate($this->Opportunities->find()->where(['Opportunities.is_active' => 0]));

        $this->set(compact('opportunitiesLists'));
        $this->set('_serialize', ['opportunitiesLists']);

       
//debug($messages);die;

         $this->paginate = [
            'contain' => ['OpportunityDurations',
                     'DonationCampaignProviders', 'DonationCampaignProviders.ProviderOffices',
                     'DonationCampaignProviders.DonationCampaigns',
                     'DonationCampaignProviders.DonationCampaigns.Donors',
                      'OpportunityScopes',
                      'Currencies']
        ];
        $opportunitiesLists1 = $this->paginate($this->Opportunities->find()->where(['Opportunities.is_active' => 1]));

        $this->set(compact('opportunitiesLists1'));
        $this->set('_serialize', ['opportunitiesLists1']);

       
        $this->set('title', 'ADMIN');


        $myAdminMenu = $this->MenuBuilder->buildAdminMenu('Opportunities request', $this->Auth->user('id'));
        $this->set('MenuItems', $myAdminMenu);







    }
    public function action($id = null) {
        $opportunity = $this->Opportunities->get($id, [
            'contain' => ['DonationCampaignProviders', 'DonationCampaignProviders.ProviderOffices']
                ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $opportunity = $this->Opportunities->patchEntity($opportunity, $this->request->data);
            $opportunity['is_active'] = 1;

            if ($this->Opportunities->save($opportunity)) {
                $this->Flash->success(__('The opportunity has been Published.'));
                return $this->redirect([   'action' => 'viewAdmin', $opportunity->id]);
            } else {
                $this->Flash->error(__('The opportunity could not be saved. Please, try again.'));
            }
        }
        $opportunityDurations = $this->Opportunities->OpportunityDurations->find('list', ['limit' => 200]);
        $opportunityScopes = $this->Opportunities->OpportunityScopes->find('list', ['limit' => 200]);
        $currencies = $this->Opportunities->Currencies->find('list', ['limit' => 200]);

        $donationCampaignProviders = $this->Opportunities->DonationCampaignProviders->find()
                ->contain(['DonationCampaigns', 'DonationCampaigns.Donors'])
                ->where(['provider_office_id' => $opportunity->donation_campaign_provider->provider_office_id])
                ->map(function ($row) { // map() is a collection method, it executes the query
                            $row->trimmedTitle = $row->donation_campaign->name . ' - ' . $row->donation_campaign->donor->name;
                            return $row;
                        })
                ->combine('id', 'trimmedTitle') // combine() is another collection method
                ->toArray(); // Also a collections library method

        $this->set(compact('opportunity', 'opportunityDurations', 'donationCampaignProviders', 'opportunityScopes', 'currencies'));
        $this->set('_serialize', ['opportunity']);

        $providerOffice = $opportunity->donation_campaign_provider->provider_office;
        $this->set('title', $providerOffice->name);

        $ProviderOfficeMenu = $this->MenuBuilder->buildProviderOfficeMenu('provider_office_opportunity_manager', $opportunity->donation_campaign_provider->provider_office_id);
        $this->set('MenuItems', $ProviderOfficeMenu);
    }










}