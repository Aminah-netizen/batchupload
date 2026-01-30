<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Deposit $deposit
 * @var string[]|\Cake\Collection\CollectionInterface $costCenters
 * @var string[]|\Cake\Collection\CollectionInterface $taxes
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $deposit->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $deposit->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Deposits'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="deposits form content">
            <?= $this->Form->create($deposit) ?>
            <fieldset>
                <legend><?= __('Edit Deposit') ?></legend>
                <?php
                    echo $this->Form->control('doc_date');
                    echo $this->Form->control('psoting_date');
                    echo $this->Form->control('reference');
                    echo $this->Form->control('doc_text');
                    echo $this->Form->control('account');
                    echo $this->Form->control('amount');
                    echo $this->Form->control('cost_center_id', ['options' => $costCenters]);
                    echo $this->Form->control('tax_id', ['options' => $taxes]);
                    echo $this->Form->control('order_number');
                    echo $this->Form->control('description');
                    echo $this->Form->control('status');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
