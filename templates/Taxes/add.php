<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tax $tax
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Taxes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="taxes form content">
            <?= $this->Form->create($tax) ?>
            <fieldset>
                <legend><?= __('Add Tax') ?></legend>
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
