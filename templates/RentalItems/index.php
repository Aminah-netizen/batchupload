<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\RentalItem> $rentalItems
 */
?>
<div class="rentalItems index content">
    <?= $this->Html->link(__('New Rental Item'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Rental Items') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('rental_id') ?></th>
                    <th><?= $this->Paginator->sort('reference') ?></th>
                    <th><?= $this->Paginator->sort('doc_text') ?></th>
                    <th><?= $this->Paginator->sort('amount') ?></th>
                    <th><?= $this->Paginator->sort('order_number') ?></th>
                    <th><?= $this->Paginator->sort('description') ?></th>
                    <th><?= $this->Paginator->sort('line_no') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rentalItems as $rentalItem): ?>
                <tr>
                    <td><?= $this->Number->format($rentalItem->id) ?></td>
                    <td><?= $rentalItem->hasValue('rental') ? $this->Html->link($rentalItem->rental->reference, ['controller' => 'Rentals', 'action' => 'view', $rentalItem->rental->id]) : '' ?></td>
                    <td><?= h($rentalItem->reference) ?></td>
                    <td><?= h($rentalItem->doc_text) ?></td>
                    <td><?= $this->Number->format($rentalItem->amount) ?></td>
                    <td><?= h($rentalItem->order_number) ?></td>
                    <td><?= h($rentalItem->description) ?></td>
                    <td><?= $this->Number->format($rentalItem->line_no) ?></td>
                    <td><?= $this->Number->format($rentalItem->status) ?></td>
                    <td><?= h($rentalItem->created) ?></td>
                    <td><?= h($rentalItem->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $rentalItem->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $rentalItem->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $rentalItem->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $rentalItem->id),
                            ]
                        ) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>