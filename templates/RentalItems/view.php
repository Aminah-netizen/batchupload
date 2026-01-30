<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RentalItem $rentalItem
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Rental Item'), ['action' => 'edit', $rentalItem->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Rental Item'), ['action' => 'delete', $rentalItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rentalItem->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Rental Items'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Rental Item'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="rentalItems view content">
            <h3><?= h($rentalItem->reference) ?></h3>
            <table>
                <tr>
                    <th><?= __('Rental') ?></th>
                    <td><?= $rentalItem->hasValue('rental') ? $this->Html->link($rentalItem->rental->reference, ['controller' => 'Rentals', 'action' => 'view', $rentalItem->rental->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Reference') ?></th>
                    <td><?= h($rentalItem->reference) ?></td>
                </tr>
                <tr>
                    <th><?= __('Doc Text') ?></th>
                    <td><?= h($rentalItem->doc_text) ?></td>
                </tr>
                <tr>
                    <th><?= __('Order Number') ?></th>
                    <td><?= h($rentalItem->order_number) ?></td>
                </tr>
                <tr>
                    <th><?= __('Description') ?></th>
                    <td><?= h($rentalItem->description) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($rentalItem->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Amount') ?></th>
                    <td><?= $this->Number->format($rentalItem->amount) ?></td>
                </tr>
                <tr>
                    <th><?= __('Line No') ?></th>
                    <td><?= $this->Number->format($rentalItem->line_no) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $this->Number->format($rentalItem->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($rentalItem->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($rentalItem->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>