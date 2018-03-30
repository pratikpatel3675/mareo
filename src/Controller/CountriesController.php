<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Countries Controller
 *
 * @property \App\Model\Table\CountriesTable $Countries
 */
class CountriesController extends AppController
{

    public function beforeFilter(\Cake\Event\Event $event)
    {
                       $this->Auth->allow(['listCountryPages', 'view']);

    }

    public function isAuthorized($user)
    {
        // All registered users can do the following
        if (in_array($this->request->action, ['listCountryPages', 'view'])) {
            return true;
        }

        return parent::isAuthorized($user);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $countries = $this->paginate($this->Countries);

        $this->set(compact('countries'));
        $this->set('_serialize', ['countries']);
    }

    public function listCountryPages()
    {
        $country_pages = $this->Countries->find('all')
            ->where(['Countries.has_homepage = ' => 1])
            ->contain([])
            ->all();
        $this->set('country_pages', $country_pages);

        // define a zoom level, a latitude and longitude to the js map
        $zoomLevel = 1;
        $this->set('zoomLevel', $zoomLevel);
        $latitude = 30;
        $this->set('latitude', $latitude);
        $longitude = 40;
        $this->set('longitude', $longitude);

    }


    /**
     * View method
     *
     * @param string|null $code Country id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($code = null)
    {
        //$country = $this->Countries->get($code, [
        //    'contain' => []
        //]);
        $query = $this->Countries->find('all')
            ->where(['Countries.code = ' => $code])
            ->contain([])
            ->limit(1);

        $country = $query->first();
        
        $this->set('country', $country);
        $this->set('_serialize', ['country']);

        // find the number of higher education institutions in the country
        $institutions = TableRegistry::get('InstitutionHigherEducations');
        $nb_institutions = $institutions
            ->find()
            ->where(['country_id' => $country->id])
            ->count();

        $this->set('nb_institutions', $nb_institutions);

        // find the number of applicants hosted in the country
        $applicants = TableRegistry::get('ApplicantAddresses');
        $nb_hosted_applicants = $applicants
            ->find()
            ->where(['country_id' => $country->id])
            ->count();

        $this->set('nb_hosted_applicants', $nb_hosted_applicants);

        // find the number of applicants hosted in the country
        $applicants = TableRegistry::get('ApplicantDesiredCountries');
        $nb_opportunity_seekers = $applicants
            ->find()
            ->where(['country_id' => $country->id])
            ->count();

        $this->set('nb_opportunity_seekers', $nb_opportunity_seekers);

        // define a zoom level to the js map
        $zoomLevel = 7;
        $this->set('zoomLevel', $zoomLevel);
        $latitude = $country->latitude;
        $this->set('latitude', $latitude);
        $longitude = $country->longitude;
        $this->set('longitude', $longitude);


        //Pass the Flag file name to the view
        $flagfile = $country['flag_file_name.png'];
        $this->set('flagfile', $flagfile);

        $session = $this->request->session();
        $lang = $session->read('System.language.code');
        if ($lang == 'en_US'){
            $country['name'] = $country->name_en;
            $country['title1'] = $country->title1_en;
            $country['text1'] = $country->text1_en;
            $country['title2'] = $country->title2_en;
            $country['text2'] = $country->text2_en;
            $country['title3'] = $country->title3_en;
            $country['text3'] = $country->text3_en;

        }
        else{
            $country['name'] = $country->name_ara;
            $country['title1'] = $country->title1_ara;
            $country['text1'] = $country->text1_ara;
            $country['title2'] = $country->title2_ara;
            $country['text2'] = $country->text2_ara;
            $country['title3'] = $country->title3_ara;
            $country['text3'] = $country->text3_ara;

        }


        //testting associations
        //$test = $this->Countries->find()
        //    ->where(['Countries.code = ' => $code])
        //    ->contain(['ProviderOffices', 'ProviderOfficesWithOpportunities', 'Opportunities'])
        //    ->first();

        //$this->set('test', $test);

    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $country = $this->Countries->newEntity();
        if ($this->request->is('post')) {
            $country = $this->Countries->patchEntity($country, $this->request->data);
            if ($this->Countries->save($country)) {
                $this->Flash->success(__('The country has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The country could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('country'));
        $this->set('_serialize', ['country']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Country id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $country = $this->Countries->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $country = $this->Countries->patchEntity($country, $this->request->data);
            if ($this->Countries->save($country)) {
                $this->Flash->success(__('The country has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The country could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('country'));
        $this->set('_serialize', ['country']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Country id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $country = $this->Countries->get($id);
        if ($this->Countries->delete($country)) {
            $this->Flash->success(__('The country has been deleted.'));
        } else {
            $this->Flash->error(__('The country could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
