<?php
declare(strict_types=1);

namespace App\Controller;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Html;
use Cake\Http\Response;

/**
 * Rentals Controller
 *
 * @property \App\Model\Table\RentalsTable $Rentals
 */
class RentalsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
   public function index()
{
    $query = $this->Rentals->find()
        ->contain(['CostCenters', 'Taxes', 'RentalItems']);

    $request = $this->request->getQuery();

    /* =======================
     * Filter: Description
     * ======================= */
    if (!empty($request['description'])) {
        $query->where([
            'Rentals.description LIKE' => '%' . trim($request['description']) . '%'
        ]);
    }

    /* =======================
     * Filter: Created Date
     * ======================= */
    if (!empty($request['created_date'])) {
        $query->where(function ($exp) use ($request) {
            return $exp->between(
                'Rentals.created',
                $request['created_date'] . ' 00:00:00',
                $request['created_date'] . ' 23:59:59'
            );
        });
    }

    /* =======================
     * Filter: Form Type
     * ======================= */
    if (!empty($request['form_type'])) {
        if ($request['form_type'] === 'single') {
            // Single item = no rental items
            $query->leftJoinWith('RentalItems')
                  ->where(['RentalItems.id IS' => null]);
        }

        if ($request['form_type'] === 'multiple') {
            // Multiple items = has rental items
            $query->innerJoinWith('RentalItems');
        }
    }

    $rentals = $this->paginate($query);

    $this->set(compact('rentals'));
}
    /**
     * View method
     *
     * @param string|null $id Rental id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $rental = $this->Rentals->get($id, contain: ['CostCenters', 'Taxes', 'RentalItems']);
        $this->set(compact('rental'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
   public function add()
{
    $rental = $this->Rentals->newEmptyEntity();

    if ($this->request->is('post')) {

        $rental = $this->Rentals->patchEntity(
            $rental,
            $this->request->getData(),
            [
                'associated' => ['RentalItems']
            ]
        );

        if ($this->Rentals->save($rental)) {
            $this->Flash->success(__('The rental has been saved.'));
            return $this->redirect(['action' => 'index']);
        }

        // VERY IMPORTANT while debugging
        debug($rental->getErrors());
        $this->Flash->error(__('The rental could not be saved. Please, try again.'));
    }

    $costCenters = $this->Rentals->CostCenters->find('list')->all();
    $taxes = $this->Rentals->Taxes->find('list')->all();

    $this->set(compact('rental', 'costCenters', 'taxes'));
}

    /**
     * Edit method
     *
     * @param string|null $id Rental id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $rental = $this->Rentals->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rental = $this->Rentals->patchEntity($rental, $this->request->getData());
            if ($this->Rentals->save($rental)) {
                $this->Flash->success(__('The rental has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rental could not be saved. Please, try again.'));
        }
        $costCenters = $this->Rentals->CostCenters->find('list', limit: 200)->all();
        $taxes = $this->Rentals->Taxes->find('list', limit: 200)->all();
        $this->set(compact('rental', 'costCenters', 'taxes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Rental id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $rental = $this->Rentals->get($id);
        if ($this->Rentals->delete($rental)) {
            $this->Flash->success(__('The rental has been deleted.'));
        } else {
            $this->Flash->error(__('The rental could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

private function exportByType(int $id, string $glAccount, string $prefix)
{
    $rental = $this->Rentals->get($id, [
        'contain' => ['Taxes', 'CostCenters', 'RentalItems']
    ]);

    $templatePath = WWW_ROOT . 'BU_TEMPLATE_RENTAL.xlsx';
    $spreadsheet  = IOFactory::load($templatePath);
    $sheet        = $spreadsheet->getActiveSheet();

    $currentRow = 6;
    $sequenceNo = 1;

    $postingPeriod = $rental->submit_date->format('m');

    $glAccounts = match ($prefix) {
        'deposit'         => ['50530200'],
        'rental'          => ['72410200'],
        'deposit_rental'  => ['50530200', '72410200'],
        default           => [$glAccount],
    };

    $items = $rental->rental_items;

    /* ======================
     * 31 – VENDOR LINE (ONCE)
     * ====================== */
    $sheet->setCellValue('A' . $currentRow, sprintf('%02d', $sequenceNo));
    $sheet->setCellValue('B' . $currentRow, $rental->invoice_date->format('dmY'));
    $sheet->setCellValue('C' . $currentRow, 'KR');
    $sheet->setCellValue('D' . $currentRow, 'MY03');
    $sheet->setCellValue('E' . $currentRow, $rental->submit_date->format('dmY'));
    $sheet->setCellValue('F' . $currentRow, $postingPeriod);
    $sheet->setCellValue('G' . $currentRow, 'MYR');
    $sheet->setCellValue('J' . $currentRow, $rental->reference);
    $sheet->setCellValue('K' . $currentRow, $rental->doc_text);

    $sheet->setCellValue('L' . $currentRow, 31);
    $sheet->setCellValue('M' . $currentRow, $rental->account);
    $sheet->setCellValue('Q' . $currentRow, $rental->amount);
    $sheet->setCellValue('R' . $currentRow, $rental->tax->name ?? '');
    $sheet->setCellValue('V' . $currentRow, $rental->cost_center->name ?? '');
    $sheet->setCellValue('X' . $currentRow, '');
    $sheet->setCellValue('AH' . $currentRow, $rental->description);

    $sheet->getStyle("A{$currentRow}:AH{$currentRow}")
      ->getFont()
      ->setBold(true);

    $currentRow++;

    /* ======================
     * 40 – GL LINES
     * ====================== */

    // SPLIT ITEMS
    if (!empty($items)) {

        foreach ($items as $item) {
            foreach ($glAccounts as $gl) {

                $sheet->setCellValue('A' . $currentRow, sprintf('%02d', $sequenceNo));
                $sheet->setCellValue('B' . $currentRow, $rental->invoice_date->format('dmY'));
                $sheet->setCellValue('C' . $currentRow, 'KR');
                $sheet->setCellValue('D' . $currentRow, 'MY03');
                $sheet->setCellValue('E' . $currentRow, $rental->submit_date->format('dmY'));
                $sheet->setCellValue('F' . $currentRow, $postingPeriod);
                $sheet->setCellValue('G' . $currentRow, 'MYR');
                $sheet->setCellValue('J' . $currentRow, $item->reference);
                $sheet->setCellValue('K' . $currentRow, $item->doc_text);

                $sheet->setCellValue('L' . $currentRow, 40);
                $sheet->setCellValue('M' . $currentRow, $gl);
                $sheet->setCellValue('Q' . $currentRow, $item->amount);
                $sheet->setCellValue('R' . $currentRow, $rental->tax->name ?? '');
                $sheet->setCellValue('V' . $currentRow, $rental->cost_center->name ?? '');
                $sheet->setCellValue('X' . $currentRow, $item->order_number . 'C');
                $sheet->setCellValue('AH' . $currentRow, $item->description);

                $sheet->getStyle("A{$currentRow}:AH{$currentRow}")
                ->getFont()
                ->setBold(false);

                $currentRow++;
            }
        }

    }
    // NO SPLIT → SINGLE 40
    else {

        foreach ($glAccounts as $gl) {

            $sheet->setCellValue('A' . $currentRow, sprintf('%02d', $sequenceNo));
            $sheet->setCellValue('B' . $currentRow, $rental->invoice_date->format('dmY'));
            $sheet->setCellValue('C' . $currentRow, 'KR');
            $sheet->setCellValue('D' . $currentRow, 'MY03');
            $sheet->setCellValue('E' . $currentRow, $rental->submit_date->format('dmY'));
            $sheet->setCellValue('F' . $currentRow, $postingPeriod);
            $sheet->setCellValue('G' . $currentRow, 'MYR');
            $sheet->setCellValue('J' . $currentRow, $rental->reference);
            $sheet->setCellValue('K' . $currentRow, $rental->doc_text);

            $sheet->setCellValue('L' . $currentRow, 40);
            $sheet->setCellValue('M' . $currentRow, $gl);
            $sheet->setCellValue('Q' . $currentRow, $rental->amount);
            $sheet->setCellValue('R' . $currentRow, $rental->tax->name ?? '');
            $sheet->setCellValue('V' . $currentRow, $rental->cost_center->name ?? '');
            $sheet->setCellValue('X' . $currentRow, $rental->order_number . 'C');
            $sheet->setCellValue('AH' . $currentRow, $rental->description);

            $currentRow++;
        }
    }

    /* ======================
     * FILE OUTPUT
     * ====================== */
    $sanitize = fn($s) =>
        strtoupper(preg_replace('/[^A-Z0-9]+/', '_', (string)$s));

    $fileName = sprintf(
        'BU_%s_%s.xlsx',
        strtoupper($prefix),
        $sanitize($rental->description)
    );

    $tmpFile = TMP . $fileName;
    (new Xlsx($spreadsheet))->save($tmpFile);

    return $this->response->withFile(
        $tmpFile,
        ['download' => true, 'name' => $fileName]
    );
}

public function exportDeposit($id)
{
    return $this->exportByType(
        (int)$id,
        '50530200',
        'deposit'
    );
}

public function exportRental($id)
{
    return $this->exportByType(
        (int)$id,
        '72410200',
        'rental'
    );
}
public function addDeposit()
{
    return $this->addByType('deposit');
}

public function addRental()
{
    return $this->addByType('rental');
}
public function sendEmail($id = null)
{
    if (!$id) {
        $this->Flash->error(__('Invalid form ID.'));
        return $this->redirect(['action' => 'index']);
    }

    $rental = $this->Rentals->get($id);

    $recipient = '';
    $subject = '' . $rental->description;
    $body = "Assalammualaikum,\n\nSeek your help to process BU above.\n\n[FO PIC] appreciate your assistant to create FO starting [mm/yy]. I already update the information in planner. \n\nThanks.";

    $mailto = 'mailto:' . $recipient
              . '?subject=' . rawurlencode($subject)
              . '&body=' . rawurlencode($body);

    return $this->redirect($mailto);
}
}
