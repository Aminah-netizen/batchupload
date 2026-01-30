<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DepositItem $depositItem
 * @var string[]|\Cake\Collection\CollectionInterface $deposits
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $depositItem->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $depositItem->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Deposit Items'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="depositItems form content">
            <?= $this->Form->create($depositItem) ?>
            <fieldset>
                <legend><?= __('Edit Deposit Item') ?></legend>
                <?php
                    echo $this->Form->control('deposit_id', ['options' => $deposits]);
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
