<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rental $rental
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Rental'), ['action' => 'edit', $rental->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Rental'), ['action' => 'delete', $rental->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rental->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Rentals'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Rental'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="rentals view content">
            <h3><?= h($rental->reference) ?></h3>
            <table>
                <tr>
                    <th><?= __('Reference') ?></th>
                    <td><?= h($rental->reference) ?></td>
                </tr>
                <tr>
                    <th><?= __('Doc Text') ?></th>
                    <td><?= h($rental->doc_text) ?></td>
                </tr>
                <tr>
                    <th><?= __('Cost Center') ?></th>
                    <td><?= $rental->hasValue('cost_center') ? $this->Html->link($rental->cost_center->name, ['controller' => 'CostCenters', 'action' => 'view', $rental->cost_center->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Tax') ?></th>
                    <td><?= $rental->hasValue('tax') ? $this->Html->link($rental->tax->name, ['controller' => 'Taxes', 'action' => 'view', $rental->tax->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Order Number') ?></th>
                    <td><?= h($rental->order_number) ?></td>
                </tr>
                <tr>
                    <th><?= __('Description') ?></th>
                    <td><?= h($rental->description) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($rental->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Account') ?></th>
                    <td><?= $this->Number->format($rental->account) ?></td>
                </tr>
                <tr>
                    <th><?= __('Amount') ?></th>
                    <td><?= $this->Number->format($rental->amount) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $this->Number->format($rental->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Invoice Date') ?></th>
                    <td><?= h($rental->invoice_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Submit Date') ?></th>
                    <td><?= h($rental->submit_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($rental->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($rental->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Rental Items') ?></h4>
                <?php if (!empty($rental->rental_items)) : ?>
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
                        <?php foreach ($rental->rental_items as $rentalItem) : ?>
                        <tr>
                            <td><?= h($rentalItem->id) ?></td>
                            <td><?= h($rentalItem->reference) ?></td>
                            <td><?= h($rentalItem->doc_text) ?></td>
                            <td><?= h($rentalItem->amount) ?></td>
                            <td><?= h($rentalItem->order_number) ?></td>
                            <td><?= h($rentalItem->description) ?></td>
                            <td><?= h($rentalItem->line_no) ?></td>
                            <td><?= h($rentalItem->status) ?></td>
                            <td><?= h($rentalItem->created) ?></td>
                            <td><?= h($rentalItem->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'RentalItems', 'action' => 'view', $rentalItem->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'RentalItems', 'action' => 'edit', $rentalItem->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'RentalItems', 'action' => 'delete', $rentalItem->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $rentalItem->id),
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