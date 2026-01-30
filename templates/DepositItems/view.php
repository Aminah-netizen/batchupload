<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DepositItem $depositItem
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Deposit Item'), ['action' => 'edit', $depositItem->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Deposit Item'), ['action' => 'delete', $depositItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $depositItem->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Deposit Items'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Deposit Item'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="depositItems view content">
            <h3><?= h($depositItem->reference) ?></h3>
            <table>
                <tr>
                    <th><?= __('Deposit') ?></th>
                    <td><?= $depositItem->hasValue('deposit') ? $this->Html->link($depositItem->deposit->reference, ['controller' => 'Deposits', 'action' => 'view', $depositItem->deposit->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Reference') ?></th>
                    <td><?= h($depositItem->reference) ?></td>
                </tr>
                <tr>
                    <th><?= __('Doc Text') ?></th>
                    <td><?= h($depositItem->doc_text) ?></td>
                </tr>
                <tr>
                    <th><?= __('Order Number') ?></th>
                    <td><?= h($depositItem->order_number) ?></td>
                </tr>
                <tr>
                    <th><?= __('Description') ?></th>
                    <td><?= h($depositItem->description) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($depositItem->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Amount') ?></th>
                    <td><?= $this->Number->format($depositItem->amount) ?></td>
                </tr>
                <tr>
                    <th><?= __('Line No') ?></th>
                    <td><?= $this->Number->format($depositItem->line_no) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $this->Number->format($depositItem->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($depositItem->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($depositItem->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>