<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * RentalItems Controller
 *
 * @property \App\Model\Table\RentalItemsTable $RentalItems
 */
class RentalItemsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->RentalItems->find()
            ->contain(['Rentals']);
        $rentalItems = $this->paginate($query);

        $this->set(compact('rentalItems'));
    }

    /**
     * View method
     *
     * @param string|null $id Rental Item id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $rentalItem = $this->RentalItems->get($id, contain: ['Rentals']);
        $this->set(compact('rentalItem'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
   public function add()
{
    // ROOT ENTITY = Rental (Invoice / Excel row 31)
    $rental = $this->RentalItems->Rentals->newEmptyEntity(); 

    if ($this->request->is('post')) {

        $rental = $this->RentalItems->Rentals->patchEntity(
            $rental,
            $this->request->getData(),
            [
                'associated' => ['RentalItems']
            ]
        );

        if ($this->RentalItems->Rentals->save($rental)) {
            $this->Flash->success(__('Invoice and rental items saved successfully.'));

            return $this->redirect([
                'controller' => 'Rentals',
                'action' => 'index'
            ]);
        }

        // 🔍 DEBUG IF IT FAILS
        debug($rental->getErrors());
        debug($rental->rental_items);
        die;
    }

    $costCenters = $this->RentalItems->Rentals->CostCenters->find('list')->all();
    $taxes = $this->RentalItems->Rentals->Taxes->find('list')->all();

    $this->set(compact('rental', 'costCenters', 'taxes'));
}
    /**
     * Edit method
     *
     * @param string|null $id Rental Item id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
public function edit($rentalId = null)
{
    $rental = $this->RentalItems->Rentals->get($rentalId, [
        'contain' => ['RentalItems']
    ]);

    if ($this->request->is(['patch', 'post', 'put'])) {
        $rental = $this->RentalItems->Rentals->patchEntity($rental, $this->request->getData(), [
            'associated' => ['RentalItems']
        ]);
        if ($this->RentalItems->Rentals->save($rental)) {
            $this->Flash->success(__('The rental has been updated.'));
            return $this->redirect(['controller' => 'Rentals', 'action' => 'index']);
        }
        $this->Flash->error(__('The rental could not be updated. Please, try again.'));
    }

    $costCenters = $this->RentalItems->Rentals->CostCenters->find('list');
    $taxes = $this->RentalItems->Rentals->Taxes->find('list');

    $this->set(compact('rental', 'costCenters', 'taxes'));
}
    /**
     * Delete method
     *
     * @param string|null $id Rental Item id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $rentalItem = $this->RentalItems->get($id);
        if ($this->RentalItems->delete($rentalItem)) {
            $this->Flash->success(__('The rental item has been deleted.'));
        } else {
            $this->Flash->error(__('The rental item could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
