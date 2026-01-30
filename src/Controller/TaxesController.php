<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Taxes Controller
 *
 * @property \App\Model\Table\TaxesTable $Taxes
 */
class TaxesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Taxes->find();
        $taxes = $this->paginate($query);

        $this->set(compact('taxes'));
    }

    /**
     * View method
     *
     * @param string|null $id Tax id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tax = $this->Taxes->get($id, contain: ['Deposits', 'Rentals']);
        $this->set(compact('tax'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tax = $this->Taxes->newEmptyEntity();
        if ($this->request->is('post')) {
            $tax = $this->Taxes->patchEntity($tax, $this->request->getData());
            if ($this->Taxes->save($tax)) {
                $this->Flash->success(__('The tax has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tax could not be saved. Please, try again.'));
        }
        $this->set(compact('tax'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tax id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tax = $this->Taxes->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tax = $this->Taxes->patchEntity($tax, $this->request->getData());
            if ($this->Taxes->save($tax)) {
                $this->Flash->success(__('The tax has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tax could not be saved. Please, try again.'));
        }
        $this->set(compact('tax'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tax id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tax = $this->Taxes->get($id);
        if ($this->Taxes->delete($tax)) {
            $this->Flash->success(__('The tax has been deleted.'));
        } else {
            $this->Flash->error(__('The tax could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
