<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Deposit $deposit
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Deposit'), ['action' => 'edit', $deposit->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Deposit'), ['action' => 'delete', $deposit->id], ['confirm' => __('Are you sure you want to delete # {0}?', $deposit->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Deposits'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Deposit'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="deposits view content">
            <h3><?= h($deposit->reference) ?></h3>
            <table>
                <tr>
                    <th><?= __('Reference') ?></th>
                    <td><?= h($deposit->reference) ?></td>
                </tr>
                <tr>
                    <th><?= __('Doc Text') ?></th>
                    <td><?= h($deposit->doc_text) ?></td>
                </tr>
                <tr>
                    <th><?= __('Cost Center') ?></th>
                    <td><?= $deposit->hasValue('cost_center') ? $this->Html->link($deposit->cost_center->name, ['controller' => 'CostCenters', 'action' => 'view', $deposit->cost_center->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Tax') ?></th>
                    <td><?= $deposit->hasValue('tax') ? $this->Html->link($deposit->tax->name, ['controller' => 'Taxes', 'action' => 'view', $deposit->tax->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Order Number') ?></th>
                    <td><?= h($deposit->order_number) ?></td>
                </tr>
                <tr>
                    <th><?= __('Description') ?></th>
                    <td><?= h($deposit->description) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($deposit->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Account') ?></th>
                    <td><?= $this->Number->format($deposit->account) ?></td>
                </tr>
                <tr>
                    <th><?= __('Amount') ?></th>
                    <td><?= $this->Number->format($deposit->amount) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $this->Number->format($deposit->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Doc Date') ?></th>
                    <td><?= h($deposit->doc_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Psoting Date') ?></th>
                    <td><?= h($deposit->psoting_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($deposit->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($deposit->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Deposit Items') ?></h4>
                <?php if (!empty($deposit->deposit_items)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Reference') ?></th>
                            <th><?= __('Doc Text') ?></th>
                            <th><?= __('Amount') ?></th>
                            <th><?= __('Order Number') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Line No') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($deposit->deposit_items as $depositItem) : ?>
                        <tr>
                            <td><?= h($depositItem->id) ?></td>
                            <td><?= h($depositItem->reference) ?></td>
                            <td><?= h($depositItem->doc_text) ?></td>
                            <td><?= h($depositItem->amount) ?></td>
                            <td><?= h($depositItem->order_number) ?></td>
                            <td><?= h($depositItem->description) ?></td>
                            <td><?= h($depositItem->line_no) ?></td>
                            <td><?= h($depositItem->status) ?></td>
                            <td><?= h($depositItem->created) ?></td>
                            <td><?= h($depositItem->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'DepositItems', 'action' => 'view', $depositItem->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'DepositItems', 'action' => 'edit', $depositItem->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'DepositItems', 'action' => 'delete', $depositItem->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $depositItem->id),
                                    ]
                                ) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>