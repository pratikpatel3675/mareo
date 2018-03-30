<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    public function beforeFilter(\Cake\Event\Event $event)
    {
        $this->Auth->allow(['login','logout','registerApplicant','viewProvider']);
                       $this->Auth->allow(['register']);

    }

    public function isAuthorized($user)
    {
        // All registered users can do the following
        if (in_array($this->request->action, ['logout'])) {
            return true;
        }

        if (in_array($this->request->action, ['editApplicant', 'viewApplicant'])) {
            $userId = (int)$this->request->params['pass'][0];
            if ($this->Auth->user('role') == 'applicant' && $this->Auth->user('id') == $userId) {
                return true;
            }
        }

        if (in_array($this->request->action, ['editProvider', 'viewProvider'])) {
            $userId = (int)$this->request->params['pass'][0];
            if ($this->Auth->user('role') == 'provider' && $this->Auth->user('id') == $userId) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $session = $this->request->session();
            $user = $this->Auth->identify();
         //   echo $user;die;
            if ($user) {
                $this->Auth->setUser($user);
                $session->write('System.showLoginMenu', false);
                $this->redirect(['controller' => 'Home', 'action' => 'index']);
                //return $this->redirect($this->Auth->redirectUrl());
            }
            else {
                $this->Flash->error('Your username or password is incorrect.');
                // if login error, display the login menu with the flash message
                $session->write('System.showLoginMenu', true);
            }
         
            $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }
    }

    public function logout()
    {   
        $session = $this->request->session();
        //$this->Flash->success('You are now logged out.');
        $this->Auth->logout();
        $this->redirect(['controller' => 'Home', 'action' => 'index']);

    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The record has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The record could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The record has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The record could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The record has been deleted.'));
        } else {
            $this->Flash->error(__('The record could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }


    public function viewApplicant($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['ApplicantGenerals']
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
        $ApplicantMenu = $this->MenuBuilder->buildApplicantMenu('applicant_menu_account', $id);
        $this->set('MenuItems', $ApplicantMenu);
    }

    public function viewProvider($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
        $ProviderMenu = $this->MenuBuilder->buildProviderMenu('provider_menu_account', $id);
        $this->set('MenuItems', $ProviderMenu);
    }

    public function editApplicant($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            $user['role'] = 'applicant';

            if($this->request->data['password'] == $this->request->data['confirm_password']){
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('The record has been saved.'));
                    return $this->redirect(['action' => 'viewApplicant', $user->id ]);
                } else {
                    $this->Flash->error(__('The record could not be saved. Please, try again.'));
                }
            }
            else{
                $this->Flash->error(__('The passwords are not matching. Please, retype passwords.'));
            }


        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
        $ApplicantMenu = $this->MenuBuilder->buildApplicantMenu('applicant_menu_account', $id);
        $this->set('MenuItems', $ApplicantMenu);
    }

    public function editProvider($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            $user['role'] = 'provider';

            if($this->request->data['password'] == $this->request->data['confirm_password']){
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('The record has been saved.'));
                    return $this->redirect(['action' => 'viewProvider', $user->id ]);
                } else {
                    $this->Flash->error(__('The record could not be saved. Please, try again.'));
                }
            }
            else{
                $this->Flash->error(__('The passwords are not matching. Please, retype passwords.'));
            }


        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
        $ProviderMenu = $this->MenuBuilder->buildProviderMenu('provider_menu_account', $id);
        $this->set('MenuItems', $ProviderMenu);
    }



    /**
     * registerApplicant method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function registerApplicant()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
             if($this->request->data['email'] == $this->request->data['confirm_email']){

            if($this->request->data['password'] == $this->request->data['confirm_password']){

            $user['role'] = 'applicant';
            $user['active'] = 1;



            if ($this->Users->save($user)) {
                $this->Flash->success(__('The record has been saved.'));
                return $this->redirect(['controller' => 'ApplicantGenerals', 'action' => 'add']);
            } else {
                $this->Flash->error(__('The record could not be saved. Please, try again.'));
            } 
             } 

             else{
                $this->Flash->error(__('The passwords are not matching. Please, retype passwords.'));
            } 
           }
           else{
                $this->Flash->error(__('The E-mails are not matching. Please, retype E-mail.'));
            } 



        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }
  



    public function register(){
        $user = $this->Users->newEntity();
        if($this->request->is('post')){
            $user = $this->Users->patchEntity($user, $this->request->data);
            if($this->Users->save($user)){
                $this->Flash->success('You are successfully registered');
                return $this->redirect(['controller' => 'Users', 'action' => 'viewApplicant', $user->id]);
            } else {
                $this->Flash->error('You are not registered');
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }
}
