<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Deposit $deposit
 * @var \Cake\Collection\CollectionInterface|string[] $costCenters
 * @var \Cake\Collection\CollectionInterface|string[] $taxes
 */
?>

<div class="row mt-4">
    <!-- Sidebar -->
    <aside class="col-md-3 mb-4">
        <div class="list-group card border-dark shadow-sm">
            <?= $this->Html->link(
                '<i class="fa-solid fa-house me-2"></i> Back to Home',
                ['controller' => 'Pages', 'action' => 'home'],
                ['class' => 'list-group-item list-group-item-action', 'escape' => false]
            ) ?>
            <?= $this->Html->link(
                '<i class="fa-solid fa-list me-2"></i> List of Deposits',
                ['controller' => 'Deposits', 'action' => 'index'],
                ['class' => 'list-group-item list-group-item-action', 'escape' => false]
            ) ?>
        </div>
    </aside> 

    <!-- Main Content -->
    <div class="col-md-9">
        <div class="card border-dark shadow-sm mb-5">
            <div class="card-body">

                <?= $this->Form->create($deposit, ['type' => 'post']) ?>

                <h4 class="mb-4">EDIT DEPOSIT FORM</h4>

                <!-- DEPOSIT HEADER -->
                <div class="row g-3">
                    <div class="col-md-6">
                        <?= $this->Form->control('doc_date', [
                            'label' => 'Invoice Date',
                            'class' => 'form-control'
                        ]) ?>
                    </div>

                    <div class="col-md-6">
                        <?= $this->Form->control('psoting_date', [
                            'label' => 'BU Submit Date',
                            'class' => 'form-control'
                        ]) ?>
                    </div>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-4">
                        <?= $this->Form->control('reference', [
                            'label' => 'Reference',
                            'class' => 'form-control',
                            'placeholder' => 'Example: DEPO7000P'
                        ]) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $this->Form->control('amount', [
                            'label' => 'Total Invoice Amount',
                            'class' => 'form-control',
                            'placeholder' => 'Example: 2400'
                        ]) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $this->Form->control('account', [
                            'label' => 'Vendor ID',
                            'class' => 'form-control',
                            'placeholder' => 'Example: 808080'
                        ]) ?>
                    </div>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <?= $this->Form->control('cost_center_id', [
                            'options' => $costCenters,
                            'empty' => '-- Select Cost Center --',
                            'class' => 'form-select'
                        ]) ?>
                    </div>

                    <div class="col-md-6">
                        <?= $this->Form->control('tax_id', [
                            'options' => $taxes,
                            'empty' => '-- Select Tax --',
                            'class' => 'form-select'
                        ]) ?>
                    </div>
                </div>

                <div class="row g-3 mt-1">
                     <div class="col-md-6">
                        <?= $this->Form->control('doc_text', [
                            'label' => 'Document Text',
                            'class' => 'form-control',
                            'placeholder' => 'Example: DEPO_DEC 2025 - JAN 2026'
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('description', [
                            'label' => ['text' => 'Description'],
                            'class' => 'form-control',
                            'placeholder' => 'Example: DEPO_DEC 2025 - JAN 2026_8099P'
                        ]) ?>
                    </div>
                </div>

                <?= $this->Form->hidden('status', ['value' => 1]) ?>

                <hr class="my-4">

                <!-- DEPOSIT ITEMS -->
                <h5 class="mb-3">Deposit Items</h5>

                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr class="text-center">
                                <th>Reference</th>
                                <th>Document Text</th>
                                <th>Amount</th>
                                <th>Location ID</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="items">
                            <?php foreach ($deposit->deposit_items as $i => $item): ?>
                                <tr class="item-row">
                                    <td><?= $this->Form->control("deposit_items.$i.reference", ['label' => false, 'class' => 'form-control', 'value' => $item->reference]) ?></td>
                                    <td><?= $this->Form->control("deposit_items.$i.doc_text", ['label' => false, 'class' => 'form-control', 'value' => $item->doc_text]) ?></td>
                                    <td><?= $this->Form->control("deposit_items.$i.amount", ['label' => false, 'class' => 'form-control', 'value' => $item->amount]) ?></td>
                                    <td><?= $this->Form->control("deposit_items.$i.order_number", ['label' => false, 'class' => 'form-control', 'value' => $item->order_number]) ?></td>
                                    <td><?= $this->Form->control("deposit_items.$i.description", ['label' => false, 'class' => 'form-control', 'value' => $item->description]) ?></td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-danger remove-item">✕</button>
                                    </td>

                                    <?= $this->Form->hidden("deposit_items.$i.id", ['value' => $item->id]) ?>
                                    <?= $this->Form->hidden("deposit_items.$i.line_no", ['value' => $item->line_no]) ?>
                                    <?= $this->Form->hidden("deposit_items.$i.status", ['value' => $item->status]) ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center">
                    <button type="button" id="add-item" class="btn btn-outline-success mb-3">
                        + Add Deposit Line
                    </button>
                </div>

                <!-- SUBMIT -->
                <div class="d-flex justify-content-end mt-4">
                    <?= $this->Form->button(__('Update'), ['class' => 'btn btn-primary px-4']) ?>
                </div>

                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

<script>
let index = <?= count($deposit->deposit_items) ?>; // start after existing rows

document.getElementById('add-item')?.addEventListener('click', function () {
    const tbody = document.getElementById('items');

    const row = document.createElement('tr');
    row.classList.add('item-row');

    row.innerHTML = `
        <td><input class="form-control" name="deposit_items[${index}][reference]" required></td>
        <td><input class="form-control" name="deposit_items[${index}][doc_text]" required></td>
        <td><input class="form-control" type="number" step="0.01" name="deposit_items[${index}][amount]" required></td>
        <td><input class="form-control" name="deposit_items[${index}][order_number]"></td>
        <td><input class="form-control" name="deposit_items[${index}][description]" required></td>
        <td class="text-center">
            <button type="button" class="btn btn-sm btn-danger remove-item">✕</button>
        </td>

        <input type="hidden" name="deposit_items[${index}][line_no]" value="${index + 1}">
        <input type="hidden" name="deposit_items[${index}][status]" value="1">
    `;

    tbody.appendChild(row);
    index++;
});

document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-item')) {
        e.target.closest('.item-row').remove();
    }
});
</script>
