<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Deposit> $deposits
 */
?>

<div class="deposits index content">

    <h3 class="text-center text-decoration-underline mt-4 mb-4">
        <?= __('LIST OF DEPOSITS BATCH UPLOAD') ?>
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
                <?php foreach ($deposits as $deposit): ?> 

                    <?php
                        // Determine form type
                        $isMultiple = !empty($deposit->deposit_items);
                        $formType = $isMultiple ? 'Multiple Items' : 'Single Item';

                        // Edit URL
                        $editUrl = $isMultiple
                            ? ['controller' => 'DepositItems', 'action' => 'edit', $deposit->id]
                            : ['controller' => 'Deposits', 'action' => 'edit', $deposit->id];
                    ?>

                    <tr>
                        <td class="text-start"><?= h($deposit->description) ?></td>
                        <td class="text-center"><?= h($deposit->created) ?></td>
                        <td class="text-center">
                            <span class="badge <?= $isMultiple ? 'bg-primary' : 'bg-info' ?>">
                                <?= $formType ?>
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm">

                                <?= $this->Html->link(
                                    '<i class="fa-solid fa-file-excel"></i>',
                                    ['action' => 'exportDeposit', $deposit->id],
                                    ['class' => 'btn btn-outline-success', 'escapeTitle' => false, 'title' => 'Export Excel']
                                ) ?>

                                <?= $this->Html->link(
                                    '<i class="fa-solid fa-paper-plane"></i>',
                                    ['action' => 'sendEmail', $deposit->id],
                                    ['class' => 'btn btn-outline-info', 'escapeTitle' => false, 'title' => 'Send Email']
                                ) ?>

                                <?= $this->Html->link(
                                    '<i class="fa-regular fa-pen-to-square"></i>',
                                    $editUrl,
                                    ['class' => 'btn btn-outline-warning', 'escapeTitle' => false, 'title' => 'Edit']
                                ) ?>

                                <?= $this->Form->postLink(
                                    '<i class="fa-solid fa-trash-can"></i>',
                                    ['action' => 'delete', $deposit->id],
                                    [
                                        'class' => 'btn btn-outline-danger',
                                        'escapeTitle' => false,
                                        'confirm' => __('Are you sure you want to delete this deposit?'),
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
    max-height: 500px;   /* adjust height as you like */
    overflow-y: auto;
}
</style>