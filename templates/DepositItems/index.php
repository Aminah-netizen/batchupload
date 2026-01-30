<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\DepositItem> $depositItems
 */
?>
<div class="depositItems index content">
    <?= $this->Html->link(__('New Deposit Item'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Deposit Items') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('deposit_id') ?></th>
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
                <?php foreach ($depositItems as $depositItem): ?>
                <tr>
                    <td><?= $this->Number->format($depositItem->id) ?></td>
                    <td><?= $depositItem->hasValue('deposit') ? $this->Html->link($depositItem->deposit->reference, ['controller' => 'Deposits', 'action' => 'view', $depositItem->deposit->id]) : '' ?></td>
                    <td><?= h($depositItem->reference) ?></td>
                    <td><?= h($depositItem->doc_text) ?></td>
                    <td><?= $this->Number->format($depositItem->amount) ?></td>
                    <td><?= h($depositItem->order_number) ?></td>
                    <td><?= h($depositItem->description) ?></td>
                    <td><?= $this->Number->format($depositItem->line_no) ?></td>
                    <td><?= $this->Number->format($depositItem->status) ?></td>
                    <td><?= h($depositItem->created) ?></td>
                    <td><?= h($depositItem->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $depositItem->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $depositItem->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $depositItem->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $depositItem->id),
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