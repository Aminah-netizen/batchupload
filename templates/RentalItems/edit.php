<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RentalItem $rentalItem
 * @var string[]|\Cake\Collection\CollectionInterface $rentals
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $rentalItem->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $rentalItem->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Rental Items'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="rentalItems form content">
            <?= $this->Form->create($rentalItem) ?>
            <fieldset>
                <legend><?= __('Edit Rental Item') ?></legend>
                <?php
                    echo $this->Form->control('rental_id', ['options' => $rentals]);
                    echo $this->Form->control('reference');
                    echo $this->Form->control('doc_text');
                    echo $this->Form->control('amount');
                    echo $this->Form->control('order_number');
                    echo $this->Form->control('description');
                    echo $this->Form->control('line_no');
                    echo $this->Form->control('status');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
