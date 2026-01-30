<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * CostCenters Controller
 *
 * @property \App\Model\Table\CostCentersTable $CostCenters
 */
class CostCentersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->CostCenters->find();
        $costCenters = $this->paginate($query);

        $this->set(compact('costCenters'));
    }

    /**
     * View method
     *
     * @param string|null $id Cost Center id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $costCenter = $this->CostCenters->get($id, contain: ['Deposits', 'Rentals']);
        $this->set(compact('costCenter'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $costCenter = $this->CostCenters->newEmptyEntity();
        if ($this->request->is('post')) {
            $costCenter = $this->CostCenters->patchEntity($costCenter, $this->request->getData());
            if ($this->CostCenters->save($costCenter)) {
                $this->Flash->success(__('The cost center has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cost center could not be saved. Please, try again.'));
        }
        $this->set(compact('costCenter'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Cost Center id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $costCenter = $this->CostCenters->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $costCenter = $this->CostCenters->patchEntity($costCenter, $this->request->getData());
            if ($this->CostCenters->save($costCenter)) {
                $this->Flash->success(__('The cost center has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cost center could not be saved. Please, try again.'));
        }
        $this->set(compact('costCenter'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Cost Center id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $costCenter = $this->CostCenters->get($id);
        if ($this->CostCenters->delete($costCenter)) {
            $this->Flash->success(__('The cost center has been deleted.'));
        } else {
            $this->Flash->error(__('The cost center could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
