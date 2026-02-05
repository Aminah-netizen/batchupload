<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\ConnectionManager;

class BusController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        // Load models in CakePHP 5 style
        $this->Deposits = $this->getTableLocator()->get('Deposits');
        $this->Rentals = $this->getTableLocator()->get('Rentals');
        $this->CostCenters = $this->getTableLocator()->get('CostCenters');
        $this->Taxes = $this->getTableLocator()->get('Taxes');
    }

public function index()
{
    $depositsQuery = $this->Deposits->find()
    ->select([
        'id',
        'description',
        'created',
        'source' => "'deposit'",
        'item_count' => '0'
    ]);

    $rentalsQuery = $this->Rentals->find()
    ->select([
        'id',   
        'description',
        'created',
        'source' => "'rental'",
        'item_count' => $rentalsQuery = $this->Rentals->find()
            ->select(['count' => 'COUNT(RentalItems.id)'])
            ->leftJoinWith('RentalItems')
            ->where(['RentalItems.rental_id = Rentals.id'])
    ])
    ->group(['Rentals.id']);


    // Merge both
    $busQuery = $depositsQuery
        ->unionAll($rentalsQuery)
        ->order(['created' => 'DESC']); 

    // Paginate
    $busEntries = $this->paginate($busQuery);

    $this->set(compact('busEntries'));
}

    public function add()
{
    $deposit = $this->Deposits->newEmptyEntity();
    $rental  = $this->Rentals->newEmptyEntity();

    $costCenters = $this->CostCenters->find('list')->all();
    $taxes       = $this->Taxes->find('list')->all();

    if ($this->request->is('post')) {

        $data = $this->request->getData();

        $deposit = $this->Deposits->newEntity($data['deposit']);
        $rental  = $this->Rentals->newEntity($data['rental']);

        $conn = ConnectionManager::get('default');

        try {
            $conn->transactional(function () use ($deposit, $rental) {
                $this->Deposits->saveOrFail($deposit);
                $this->Rentals->saveOrFail($rental);
            });

            // ✅ STORE BUS IDS IN SESSION
            $session = $this->request->getSession();

            $busIds = $session->read('Bus.ids') ?? [];
            $busIds[] = [
                'deposit_id' => $deposit->id,
                'rental_id'  => $rental->id,
            ];

            $session->write('Bus.ids', $busIds);

            $this->Flash->success('Deposit & Rental BU saved successfully');
            return $this->redirect(['action' => 'index']);

        } catch (\Exception $e) {
            $this->Flash->error('Failed to save Deposit & Rental');
        }
    }

    $this->set(compact('deposit', 'rental', 'costCenters', 'taxes'));
}

}
