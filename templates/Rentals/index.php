<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Rental> $rentals
 */
?>

<div class="rentals index content-center">

    <h3 class="text-center text-decoration-underline mt-4 mb-4"><?= __('LIST OF RENTALS BATCH UPLOAD') ?></h3>

    <div class="row g-4">
        <?php foreach ($rentals as $rental): ?>
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="shadow p-3 bg-body-tertiary rounded h-100">

                     <div>
                        <h5 class="fw-bold mb-2">
                            <?= h($rental->description) ?>
                        </h5>
 
                    <p class="mb-1 text-muted small">
                            <strong>BU Created:</strong>
                            <?= h($rental->created) ?>
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
                            ['action' => 'exportRental', $rental->id],
                            ['class' => 'btn btn-outline-success btn-sm', 'escapeTitle' => false, 'title' => 'Export Excel']
                        ) ?>

                        <!-- Send Email -->
                        <?= $this->Html->link(
                            '<i class="fa-solid fa-paper-plane"></i>',
                            ['action' => 'sendEmail', $rental->id],
                            ['class' => 'btn btn-outline-info btn-sm', 'escapeTitle' => false, 'title' => 'Send Email']
                        ) ?>

                         <?= $this->Html->link(
                            '<i class="fa-solid fa-eye"></i>',
                            '#',
                            [
                                'class' => 'btn btn-outline-secondary btn-sm disabled',
                                'aria-disabled' => true,
                                'escapeTitle' => false,
                                'data-id' => $rental->id,
                                'title' => 'Preview Excel'
                            ]
                        ) ?>

                        <!-- Edit -->
                        <?= $this->Html->link(
                            '<i class="fa-regular fa-pen-to-square"></i>',
                            ['action' => 'edit', $rental->id],
                            ['class' => 'btn btn-outline-warning btn-sm', 'escapeTitle' => false, 'title' => 'Edit Rental']
                        ) ?>

                        <!-- Delete -->
                        <?= $this->Form->postLink(
                            '<i class="fa-solid fa-trash-can"></i>',
                            ['action' => 'delete', $rental->id],
                            [
                                'class' => 'btn btn-outline-danger btn-sm',
                                'escapeTitle' => false,
                                'confirm' => __('Are you sure you want to delete rental # {0}?', $rental->id),
                                'title' => 'Delete Rental'
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
