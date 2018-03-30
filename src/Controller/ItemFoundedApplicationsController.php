<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ItemFoundedApplications Controller
 *
 * @property \App\Model\Table\ItemFoundedApplicationsTable $ItemFoundedApplications
 */
class ItemFoundedApplicationsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'FoundItems', 'Countries']
        ];
        $itemFoundedApplications = $this->paginate($this->ItemFoundedApplications);

        $this->set(compact('itemFoundedApplications'));
        $this->set('_serialize', ['itemFoundedApplications']);
    }

    /**
     * View method
     *
     * @param string|null $id Item Founded Application id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $itemFoundedApplication = $this->ItemFoundedApplications->get($id, [
            'contain' => ['Users', 'FoundItems', 'Countries']
        ]);

        $this->set('itemFoundedApplication', $itemFoundedApplication);
        $this->set('_serialize', ['itemFoundedApplication']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $itemFoundedApplication = $this->ItemFoundedApplications->newEntity();
        if ($this->request->is('post')) {
            $itemFoundedApplication = $this->ItemFoundedApplications->patchEntity($itemFoundedApplication, $this->request->data);
            if ($this->ItemFoundedApplications->save($itemFoundedApplication)) {
                $this->Flash->success(__('The item founded application has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The item founded application could not be saved. Please, try again.'));
            }
        }
        $users = $this->ItemFoundedApplications->Users->find('list', ['limit' => 200]);
        $foundItems = $this->ItemFoundedApplications->FoundItems->find('list', ['limit' => 200]);
        $countries = $this->ItemFoundedApplications->Countries->find('list', ['limit' => 200]);
        $this->set(compact('itemFoundedApplication', 'users', 'foundItems', 'countries'));
        $this->set('_serialize', ['itemFoundedApplication']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Item Founded Application id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $itemFoundedApplication = $this->ItemFoundedApplications->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $itemFoundedApplication = $this->ItemFoundedApplications->patchEntity($itemFoundedApplication, $this->request->data);
            if ($this->ItemFoundedApplications->save($itemFoundedApplication)) {
                $this->Flash->success(__('The item founded application has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The item founded application could not be saved. Please, try again.'));
            }
        }
        $users = $this->ItemFoundedApplications->Users->find('list', ['limit' => 200]);
        $foundItems = $this->ItemFoundedApplications->FoundItems->find('list', ['limit' => 200]);
        $countries = $this->ItemFoundedApplications->Countries->find('list', ['limit' => 200]);
        $this->set(compact('itemFoundedApplication', 'users', 'foundItems', 'countries'));
        $this->set('_serialize', ['itemFoundedApplication']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Item Founded Application id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $itemFoundedApplication = $this->ItemFoundedApplications->get($id);
        if ($this->ItemFoundedApplications->delete($itemFoundedApplication)) {
            $this->Flash->success(__('The item founded application has been deleted.'));
        } else {
            $this->Flash->error(__('The item founded application could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
