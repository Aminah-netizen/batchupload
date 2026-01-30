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
            <?= $this->Html->link(__('List Cost Centers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="costCenters form content">
            <?= $this->Form->create($costCenter) ?>
            <fieldset>
                <legend><?= __('Add Cost Center') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('status');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
