<?php
/**
 * @var \App\View\AppView $this
 * @var iterable $busEntries
 */
?>

<div class="bus index content">
    <h3 class="text-center text-decoration-underline mt-4 mb-4">
        <?= __('LIST OF DEPOSITS AND RENTALS') ?>
    </h3>

       <?= $this->Form->create(null, [
    'type' => 'get',
    'class' => 'row g-3 mb-4 align-items-end'
]) ?>

<div class="col-md-4">
    <?= $this->Form->control('description', [
        'label' => 'Description',
        'value' => $this->request->getQuery('description'),
        'class' => 'form-control',
        'placeholder' => 'Search description'
    ]) ?>
</div>

<div class="col-md-3">
    <?= $this->Form->control('created_date', [
        'label' => 'Created Date',
        'type' => 'date',
        'value' => $this->request->getQuery('created_date'),
        'class' => 'form-control'
    ]) ?>
</div>

<div class="col-md-3">
    <?= $this->Form->control('form_type', [
        'label' => 'Form Type',
        'type' => 'select',
        'options' => [
            '' => 'All',
            'single' => 'Single Item',
            'multiple' => 'Multiple Items'
        ],
        'value' => $this->request->getQuery('form_type'),
        'class' => 'form-select'
    ]) ?>
</div>

<div class="col-md-2">
    <?= $this->Form->button('Filter', [
        'class' => 'btn btn-primary'
    ]) ?>

    <?= $this->Html->link(
        'Reset',
        ['action' => 'index'],
        ['class' => 'btn btn-outline-warning'] 
    ) ?>
</div>

<?= $this->Form->end() ?>

    <div class="table-responsive table-scroll">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark text-center sticky-top">
                <tr>
                    <th>Form Description</th>
                    <th>BU Created</th>
                    <th>Form Type</th>
                    <th style="width: 180px;">Actions</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($busEntries as $entry): ?>

                    <?php
                        if ($entry->source === 'deposit') {
                            $exportUrl = ['controller' => 'Deposits', 'action' => 'exportDeposit', $entry->id];
                            $editUrl   = ['controller' => 'Deposits', 'action' => 'edit', $entry->id];
                            $deleteUrl = ['controller' => 'Deposits', 'action' => 'delete', $entry->id];
                        } else {
                            $exportUrl = ['controller' => 'Rentals', 'action' => 'exportRental', $entry->id];
                            $editUrl   = ['controller' => 'Rentals', 'action' => 'edit', $entry->id];
                            $deleteUrl = ['controller' => 'Rentals', 'action' => 'delete', $entry->id];
                        }
                    ?>

                    <tr>
                        <td class="text-start"><?= h($entry->description) ?></td>
                        <td class="text-center"><?= h($entry->created) ?></td>
                        <td class="text-center">
                <td class="text-center">
                            <!-- BUS context -->
                            <span class="badge bg-primary">Deposits + Rentals</span>

                            <!-- Form structure -->
                            <?php if ($entry->source === 'deposit'): ?>
                                <span class="badge bg-info ms-1">Single Item</span>
                            <?php else: ?>
                                <span class="badge bg-secondary ms-1">Single Item</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm">

                                <?= $this->Html->link(
                                    '<i class="fa-solid fa-file-excel"></i>',
                                    $exportUrl,
                                    ['class' => 'btn btn-outline-success', 'escapeTitle' => false, 'title' => 'Export Excel']
                                ) ?>

                                <?= $this->Html->link(
                                    '<i class="fa-regular fa-pen-to-square"></i>',
                                    $editUrl,
                                    ['class' => 'btn btn-outline-warning', 'escapeTitle' => false, 'title' => 'Edit']
                                ) ?>

                                <?= $this->Form->postLink(
                                    '<i class="fa-solid fa-trash-can"></i>',
                                    $deleteUrl,
                                    [
                                        'class' => 'btn btn-outline-danger',
                                        'escapeTitle' => false,
                                        'confirm' => __('Are you sure you want to delete this record?'),
                                        'title' => 'Delete'
                                    ]
                                ) ?>

                            </div>
                        </td>
                    </tr>

                <?php endforeach; ?>

            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-3">
        <ul class="pagination justify-content-center">
            <?= $this->Paginator->first('<<') ?>
            <?= $this->Paginator->prev('<') ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next('>') ?>
            <?= $this->Paginator->last('>>') ?>
        </ul>
    </div>
</div>

<style>
.table-scroll {
    max-height: 500px;
    overflow-y: auto;
}
</style>
