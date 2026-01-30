<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Deposit> $deposits
 */
?>

<div class="deposits index content-center">

    <h3 class="text-center text-decoration-underline mt-4 mb-4"><?= __('LIST OF DEPOSITS BATCH UPLOAD') ?></h3>

    <div class="row g-4">
        <?php foreach ($deposits as $deposit): ?>
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="shadow p-3 bg-body-tertiary rounded h-100">

                     <div>
                        <h5 class="fw-bold mb-2">
                            <?= h($deposit->description) ?>
                        </h5>
 
                    <p class="mb-1 text-muted small">
                            <strong>BU Created:</strong>
                            <?= h($deposit->created) ?>
                        </p>

                    <p class="mb-3 text-muted small">
                            <strong>Form Type:</strong>
                        </p>
                        </div>

                    <!-- Action Buttons -->
                    <div class="d-flex flex-wrap gap-2 justify-content-start mt-3">
                        <!-- Export Excel -->
                        <?= $this->Html->link(
                            '<i class="fa-solid fa-file-excel"></i>',
                            ['action' => 'exportDeposit', $deposit->id],
                            ['class' => 'btn btn-outline-success btn-sm', 'escapeTitle' => false, 'title' => 'Export Excel']
                        ) ?>

                        <!-- Send Email -->
                        <?= $this->Html->link(
                            '<i class="fa-solid fa-paper-plane"></i>',
                            ['action' => 'sendEmail', $deposit->id],
                            ['class' => 'btn btn-outline-info btn-sm', 'escapeTitle' => false, 'title' => 'Send Email']
                        ) ?>

                         <?= $this->Html->link(
                            '<i class="fa-solid fa-eye"></i>',
                            '#',
                            [
                                'class' => 'btn btn-outline-secondary btn-sm disabled',
                                'aria-disabled' => true,
                                'escapeTitle' => false,
                                'data-id' => $deposit->id,
                                'title' => 'Preview Excel'
                            ]
                        ) ?>

                        <!-- Edit -->
                        <?= $this->Html->link(
                            '<i class="fa-regular fa-pen-to-square"></i>',
                            ['action' => 'edit', $deposit->id],
                            ['class' => 'btn btn-outline-warning btn-sm', 'escapeTitle' => false, 'title' => 'Edit Deposit']
                        ) ?>

                        <!-- Delete -->
                        <?= $this->Form->postLink(
                            '<i class="fa-solid fa-trash-can"></i>',
                            ['action' => 'delete', $deposit->id],
                            [
                                'class' => 'btn btn-outline-danger btn-sm',
                                'escapeTitle' => false,
                                'confirm' => __('Are you sure you want to delete deposit # {0}?', $deposit->id),
                                'title' => 'Delete Deposit'
                            ]
                        ) ?>
                    </div>

                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Pagination -->
    <div aria-label="Page navigation" class="mt-3 px-2">
        <ul class="pagination justify-content-center flex-wrap">
            <?= $this->Paginator->first('<< ' . __('First')) ?>
            <?= $this->Paginator->prev('< ' . __('Previous')) ?>
            <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
            <?= $this->Paginator->next(__('Next') . ' >') ?>
            <?= $this->Paginator->last(__('Last') . ' >>') ?>
        </ul>
        <div class="text-center text-muted">
            <?= $this->Paginator->counter(
                __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')
            ) ?>
        </div>
    </div>

</div>
