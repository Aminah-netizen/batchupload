<?php
declare(strict_types=1);

namespace App\Controller;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Html;
use Cake\Http\Response;

/**
 * Deposits Controller
 * 
 * @property \App\Model\Table\DepositsTable $Deposits
 */
class DepositsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
   public function index()
{
    $query = $this->Deposits->find()
        ->contain(['CostCenters', 'Taxes', 'DepositItems']);

    $request = $this->request->getQuery();

    /* =======================
     * Filter: Description
     * ======================= */
    if (!empty($request['description'])) {
        $query->where([
            'Deposits.description LIKE' => '%' . trim($request['description']) . '%'
        ]);
    }

    /* =======================
     * Filter: Created Date
     * ======================= */
    if (!empty($request['created_date'])) {
        $query->where(function ($exp) use ($request) {
            return $exp->between(
                'Deposits.created',
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
            // Single item = no deposit items
            $query->leftJoinWith('DepositItems')
                  ->where(['DepositItems.id IS' => null]);
        }

        if ($request['form_type'] === 'multiple') {
            // Multiple items = has deposit items
            $query->innerJoinWith('DepositItems');
        }
    }

    $deposits = $this->paginate($query);

    $this->set(compact('deposits'));
}
    /**
     * View method
     *
     * @param string|null $id Deposit id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $deposit = $this->Deposits->get($id, contain: ['CostCenters', 'Taxes', 'DepositItems']);
        $this->set(compact('deposit'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
       public function add()
{
    $deposit = $this->Deposits->newEmptyEntity();

    if ($this->request->is('post')) {

        $deposit = $this->Deposits->patchEntity(
            $deposit,
            $this->request->getData(),
            [
                'associated' => ['DepositItems']
            ]
        );

        if ($this->Deposits->save($deposit)) {
            $this->Flash->success(__('The deposit has been saved.'));
            return $this->redirect(['action' => 'index']);
        }

        // VERY IMPORTANT while debugging
        debug($deposit->getErrors());
        $this->Flash->error(__('The deposit could not be saved. Please, try again.'));
    }

    $costCenters = $this->Deposits->CostCenters->find('list')->all();
    $taxes = $this->Deposits->Taxes->find('list')->all();

    $this->set(compact('deposit', 'costCenters', 'taxes'));
}
    /**
     * Edit method
     *
     * @param string|null $id Deposit id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $deposit = $this->Deposits->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $deposit = $this->Deposits->patchEntity($deposit, $this->request->getData());
            if ($this->Deposits->save($deposit)) {
                $this->Flash->success(__('The deposit has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The deposit could not be saved. Please, try again.'));
        }
        $costCenters = $this->Deposits->CostCenters->find('list', limit: 200)->all();
        $taxes = $this->Deposits->Taxes->find('list', limit: 200)->all();
        $this->set(compact('deposit', 'costCenters', 'taxes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Deposit id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $deposit = $this->Deposits->get($id);
        if ($this->Deposits->delete($deposit)) {
            $this->Flash->success(__('The deposit has been deleted.'));
        } else {
            $this->Flash->error(__('The deposit could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

private function exportByType(int $id, string $glAccount, string $prefix)
{
    $deposit = $this->Deposits->get($id, [
        'contain' => ['Taxes', 'CostCenters', 'DepositItems']
    ]);

    $templatePath = WWW_ROOT . 'BU_TEMPLATE_DEPOSIT.xlsx';
    $spreadsheet  = IOFactory::load($templatePath);
    $sheet        = $spreadsheet->getActiveSheet();

    $currentRow = 6;
    $sequenceNo = 1;

    $postingPeriod = $deposit->psoting_date->format('m');

    $glAccounts = match ($prefix) {
        'deposit'         => ['50530200'],
        'rental'          => ['72410200'],
        'deposit_rental'  => ['50530200', '72410200'],
        default           => [$glAccount],
    };

    $items = $deposit->deposit_items;

    /* ======================
     * 31 – VENDOR LINE (ONCE)
     * ====================== */
    $sheet->setCellValue('A' . $currentRow, sprintf('%02d', $sequenceNo));
    $sheet->setCellValue('B' . $currentRow, $deposit->doc_date->format('dmY'));
    $sheet->setCellValue('C' . $currentRow, 'KR');
    $sheet->setCellValue('D' . $currentRow, 'MY03');
    $sheet->setCellValue('E' . $currentRow, $deposit->psoting_date->format('dmY'));
    $sheet->setCellValue('F' . $currentRow, $postingPeriod);
    $sheet->setCellValue('G' . $currentRow, 'MYR');
    $sheet->setCellValue('J' . $currentRow, $deposit->reference);
    $sheet->setCellValue('K' . $currentRow, $deposit->doc_text);

    $sheet->setCellValue('L' . $currentRow, 31);
    $sheet->setCellValue('M' . $currentRow, $deposit->account);
    $sheet->setCellValue('Q' . $currentRow, $deposit->amount);
    $sheet->setCellValue('R' . $currentRow, $deposit->tax->name ?? '');
    $sheet->setCellValue('V' . $currentRow, $deposit->cost_center->name ?? '');
    $sheet->setCellValue('X' . $currentRow, '');
    $sheet->setCellValue('AH' . $currentRow, $deposit->description);

    $sheet->getStyle("A{$currentRow}:AH{$currentRow}")
      ->getFont()
      ->setBold(true);

    $currentRow++;

    /* ======================
     * 40 – GL LINES
     * ====================== */

    // SPLIT ITEMS
    if (count($items) > 1) {

        foreach ($items as $item) {
            foreach ($glAccounts as $gl) {

                $sheet->setCellValue('A' . $currentRow, sprintf('%02d', $sequenceNo));
                $sheet->setCellValue('B' . $currentRow, $deposit->doc_date->format('dmY'));
                $sheet->setCellValue('C' . $currentRow, 'KR');
                $sheet->setCellValue('D' . $currentRow, 'MY03');
                $sheet->setCellValue('E' . $currentRow, $deposit->psoting_date->format('dmY'));
                $sheet->setCellValue('F' . $currentRow, $postingPeriod);
                $sheet->setCellValue('G' . $currentRow, 'MYR');
                $sheet->setCellValue('J' . $currentRow, $item->reference);
                $sheet->setCellValue('K' . $currentRow, $item->doc_text);

                $sheet->setCellValue('L' . $currentRow, 40);
                $sheet->setCellValue('M' . $currentRow, $gl);
                $sheet->setCellValue('Q' . $currentRow, $item->amount);
                $sheet->setCellValue('R' . $currentRow, $deposit->tax->name ?? '');
                $sheet->setCellValue('V' . $currentRow, $deposit->cost_center->name ?? '');
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
            $sheet->setCellValue('B' . $currentRow, $deposit->doc_date->format('dmY'));
            $sheet->setCellValue('C' . $currentRow, 'KR');
            $sheet->setCellValue('D' . $currentRow, 'MY03');
            $sheet->setCellValue('E' . $currentRow, $deposit->psoting_date->format('dmY'));
            $sheet->setCellValue('F' . $currentRow, $postingPeriod);
            $sheet->setCellValue('G' . $currentRow, 'MYR');
            $sheet->setCellValue('J' . $currentRow, $deposit->reference);
            $sheet->setCellValue('K' . $currentRow, $deposit->doc_text);

            $sheet->setCellValue('L' . $currentRow, 40);
            $sheet->setCellValue('M' . $currentRow, $gl);
            $sheet->setCellValue('Q' . $currentRow, $deposit->amount);
            $sheet->setCellValue('R' . $currentRow, $deposit->tax->name ?? '');
            $sheet->setCellValue('V' . $currentRow, $deposit->cost_center->name ?? '');
            $sheet->setCellValue('X' . $currentRow, $deposit->order_number . 'C');
            $sheet->setCellValue('AH' . $currentRow, $deposit->description);
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
        $sanitize($deposit->description)
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

    $deposit = $this->Deposits->get($id, [
        'contain' => ['DepositItems', 'CostCenters']
    ]);

    $recipient = '';
    $subject = '' . $deposit->description;
    $body = "Assalammualaikum,\n\nSeek your help to process BU above.\n\n[FO PIC] appreciate your assistant to create FO starting [mm/yy]. I already update the information in planner. \n\nThanks.";


    $mailto = 'mailto:' . $recipient
              . '?subject=' . rawurlencode($subject)
              . '&body=' . rawurlencode($body);

    return $this->redirect($mailto);
}
}
