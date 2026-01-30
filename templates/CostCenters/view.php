<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CostCenter $costCenter
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Cost Center'), ['action' => 'edit', $costCenter->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Cost Center'), ['action' => 'delete', $costCenter->id], ['confirm' => __('Are you sure you want to delete # {0}?', $costCenter->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Cost Centers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Cost Center'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="costCenters view content">
            <h3><?= h($costCenter->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($costCenter->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($costCenter->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $this->Number->format($costCenter->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($costCenter->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($costCenter->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Deposits') ?></h4>
                <?php if (!empty($costCenter->deposits)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Doc Date') ?></th>
                            <th><?= __('Psoting Date') ?></th>
                            <th><?= __('Reference') ?></th>
                            <th><?= __('Doc Text') ?></th>
                            <th><?= __('Account') ?></th>
                            <th><?= __('Amount') ?></th>
                            <th><?= __('Tax Id') ?></th>
                            <th><?= __('Order Number') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($costCenter->deposits as $deposit) : ?>
                        <tr>
                            <td><?= h($deposit->id) ?></td>
                            <td><?= h($deposit->doc_date) ?></td>
                            <td><?= h($deposit->psoting_date) ?></td>
                            <td><?= h($deposit->reference) ?></td>
                            <td><?= h($deposit->doc_text) ?></td>
                            <td><?= h($deposit->account) ?></td>
                            <td><?= h($deposit->amount) ?></td>
                            <td><?= h($deposit->tax_id) ?></td>
                            <td><?= h($deposit->order_number) ?></td>
                            <td><?= h($deposit->description) ?></td>
                            <td><?= h($deposit->status) ?></td>
                            <td><?= h($deposit->created) ?></td>
                            <td><?= h($deposit->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Deposits', 'action' => 'view', $deposit->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Deposits', 'action' => 'edit', $deposit->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'Deposits', 'action' => 'delete', $deposit->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $deposit->id),
                                    ]
                                ) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Rentals') ?></h4>
                <?php if (!empty($costCenter->rentals)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Invoice Date') ?></th>
                            <th><?= __('Submit Date') ?></th>
                            <th><?= __('Reference') ?></th>
                            <th><?= __('Doc Text') ?></th>
                            <th><?= __('Account') ?></th>
                            <th><?= __('Amount') ?></th>
                            <th><?= __('Tax Id') ?></th>
                            <th><?= __('Order Number') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($costCenter->rentals as $rental) : ?>
                        <tr>
                            <td><?= h($rental->id) ?></td>
                            <td><?= h($rental->invoice_date) ?></td>
                            <td><?= h($rental->submit_date) ?></td>
                            <td><?= h($rental->reference) ?></td>
                            <td><?= h($rental->doc_text) ?></td>
                            <td><?= h($rental->account) ?></td>
                            <td><?= h($rental->amount) ?></td>
                            <td><?= h($rental->tax_id) ?></td>
                            <td><?= h($rental->order_number) ?></td>
                            <td><?= h($rental->description) ?></td>
                            <td><?= h($rental->status) ?></td>
                            <td><?= h($rental->created) ?></td>
                            <td><?= h($rental->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Rentals', 'action' => 'view', $rental->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Rentals', 'action' => 'edit', $rental->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'Rentals', 'action' => 'delete', $rental->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $rental->id),
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