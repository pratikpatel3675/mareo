<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ItemApplications Controller
 *
 * @property \App\Model\Table\ItemApplicationsTable $ItemApplications
 */
class ItemApplicationsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'LostItems', 'Countries']
        ];
        $itemApplications = $this->paginate($this->ItemApplications);

        $this->set(compact('itemApplications'));
        $this->set('_serialize', ['itemApplications']);
    }

    /**
     * View method
     *
     * @param string|null $id Item Application id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $itemApplication = $this->ItemApplications->get($id, [
            'contain' => ['Users', 'LostItems', 'Countries']
        ]);

        $this->set('itemApplication', $itemApplication);
        $this->set('_serialize', ['itemApplication']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $itemApplication = $this->ItemApplications->newEntity();
        if ($this->request->is('post')) {
            $itemApplication = $this->ItemApplications->patchEntity($itemApplication, $this->request->data);
            if ($this->ItemApplications->save($itemApplication)) {
                $this->Flash->success(__('The item application has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The item application could not be saved. Please, try again.'));
            }
        }
        $users = $this->ItemApplications->Users->find('list', ['limit' => 200]);
        $lostItems = $this->ItemApplications->LostItems->find('list', ['limit' => 200]);
        $countries = $this->ItemApplications->Countries->find('list', ['limit' => 200]);
        $this->set(compact('itemApplication', 'users', 'lostItems', 'countries'));
        $this->set('_serialize', ['itemApplication']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Item Application id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $itemApplication = $this->ItemApplications->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $itemApplication = $this->ItemApplications->patchEntity($itemApplication, $this->request->data);
            if ($this->ItemApplications->save($itemApplication)) {
                $this->Flash->success(__('The item application has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The item application could not be saved. Please, try again.'));
            }
        }
        $users = $this->ItemApplications->Users->find('list', ['limit' => 200]);
        $lostItems = $this->ItemApplications->LostItems->find('list', ['limit' => 200]);
        $countries = $this->ItemApplications->Countries->find('list', ['limit' => 200]);
        $this->set(compact('itemApplication', 'users', 'lostItems', 'countries'));
        $this->set('_serialize', ['itemApplication']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Item Application id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $itemApplication = $this->ItemApplications->get($id);
        if ($this->ItemApplications->delete($itemApplication)) {
            $this->Flash->success(__('The item application has been deleted.'));
        } else {
            $this->Flash->error(__('The item application could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
