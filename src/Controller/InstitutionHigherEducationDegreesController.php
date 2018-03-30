<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * InstitutionHigherEducationDegrees Controller
 *
 * @property \App\Model\Table\InstitutionHigherEducationDegreesTable $InstitutionHigherEducationDegrees
 */
class InstitutionHigherEducationDegreesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['InstitutionHigherEducations']
        ];
        $institutionHigherEducationDegrees = $this->paginate($this->InstitutionHigherEducationDegrees);

        $this->set(compact('institutionHigherEducationDegrees'));
        $this->set('_serialize', ['institutionHigherEducationDegrees']);
    }

    /**
     * View method
     *
     * @param string|null $id Institution Higher Education Degree id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $institutionHigherEducationDegree = $this->InstitutionHigherEducationDegrees->get($id, [
            'contain' => ['InstitutionHigherEducations']
        ]);

        $this->set('institutionHigherEducationDegree', $institutionHigherEducationDegree);
        $this->set('_serialize', ['institutionHigherEducationDegree']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $institutionHigherEducationDegree = $this->InstitutionHigherEducationDegrees->newEntity();
        if ($this->request->is('post')) {
            $institutionHigherEducationDegree = $this->InstitutionHigherEducationDegrees->patchEntity($institutionHigherEducationDegree, $this->request->data);
            if ($this->InstitutionHigherEducationDegrees->save($institutionHigherEducationDegree)) {
                $this->Flash->success(__('The institution higher education degree has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The institution higher education degree could not be saved. Please, try again.'));
            }
        }
        $institutionHigherEducations = $this->InstitutionHigherEducationDegrees->InstitutionHigherEducations->find('list', ['limit' => 200]);
        $this->set(compact('institutionHigherEducationDegree', 'institutionHigherEducations'));
        $this->set('_serialize', ['institutionHigherEducationDegree']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Institution Higher Education Degree id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $institutionHigherEducationDegree = $this->InstitutionHigherEducationDegrees->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $institutionHigherEducationDegree = $this->InstitutionHigherEducationDegrees->patchEntity($institutionHigherEducationDegree, $this->request->data);
            if ($this->InstitutionHigherEducationDegrees->save($institutionHigherEducationDegree)) {
                $this->Flash->success(__('The institution higher education degree has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The institution higher education degree could not be saved. Please, try again.'));
            }
        }
        $institutionHigherEducations = $this->InstitutionHigherEducationDegrees->InstitutionHigherEducations->find('list', ['limit' => 200]);
        $this->set(compact('institutionHigherEducationDegree', 'institutionHigherEducations'));
        $this->set('_serialize', ['institutionHigherEducationDegree']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Institution Higher Education Degree id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $institutionHigherEducationDegree = $this->InstitutionHigherEducationDegrees->get($id);
        if ($this->InstitutionHigherEducationDegrees->delete($institutionHigherEducationDegree)) {
            $this->Flash->success(__('The institution higher education degree has been deleted.'));
        } else {
            $this->Flash->error(__('The institution higher education degree could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
