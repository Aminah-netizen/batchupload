<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * DepositItems Controller
 *
 * @property \App\Model\Table\DepositItemsTable $DepositItems
 */
class DepositItemsController extends AppController 
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->DepositItems->find()
            ->contain(['Deposits']);
        $depositItems = $this->paginate($query);

        $this->set(compact('depositItems'));
    }

    /**
     * View method
     *
     * @param string|null $id Deposit Item id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $depositItem = $this->DepositItems->get($id, contain: ['Deposits']);
        $this->set(compact('depositItem'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
     public function add()
{
    // ROOT ENTITY = Deposit (Invoice / Excel row 31)
    $deposit = $this->DepositItems->Deposits->newEmptyEntity();

    if ($this->request->is('post')) {

        $deposit = $this->DepositItems->Deposits->patchEntity(
            $deposit,
            $this->request->getData(),
            [
                'associated' => ['DepositItems']
            ]
        );

        if ($this->DepositItems->Deposits->save($deposit)) {
            $this->Flash->success(__('Invoice and deposit items saved successfully.'));

            return $this->redirect([
                'controller' => 'Deposits',
                'action' => 'index'
            ]);
        }

        // 🔍 DEBUG IF IT FAILS
        debug($deposit->getErrors());
        debug($deposit->deposit_items);
        die;
    }

    $costCenters = $this->DepositItems->Deposits->CostCenters->find('list')->all();
    $taxes = $this->DepositItems->Deposits->Taxes->find('list')->all();

    $this->set(compact('deposit', 'costCenters', 'taxes'));
}
    /**
     * Edit method
     *
     * @param string|null $id Deposit Item id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $depositItem = $this->DepositItems->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $depositItem = $this->DepositItems->patchEntity($depositItem, $this->request->getData());
            if ($this->DepositItems->save($depositItem)) {
                $this->Flash->success(__('The deposit item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The deposit item could not be saved. Please, try again.'));
        }
        $deposits = $this->DepositItems->Deposits->find('list', limit: 200)->all();
        $this->set(compact('depositItem', 'deposits'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Deposit Item id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $depositItem = $this->DepositItems->get($id);
        if ($this->DepositItems->delete($depositItem)) {
            $this->Flash->success(__('The deposit item has been deleted.'));
        } else {
            $this->Flash->error(__('The deposit item could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
