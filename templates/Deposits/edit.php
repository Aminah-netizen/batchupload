<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Deposit $deposit
 * @var string[]|\Cake\Collection\CollectionInterface $costCenters
 * @var string[]|\Cake\Collection\CollectionInterface $taxes 
 */
?>
<div class="row mt-4">
    <!-- Sidebar -->
    <aside class="col-md-3 mb-4">
        <div class="list-group card border-dark mb-5 shadow-sm">
            <?= $this->Html->link(
                '<i class="fa-solid fa-house me-2"></i> Back to Home',
                ['controller' => 'Pages', 'action' => 'home'],
                ['class' => 'list-group-item list-group-item-action', 'escape' => false]
            ) ?>
            <?= $this->Html->link(
                '<i class="fa-solid fa-list me-2"></i> List of Deposits',
                ['controller' => 'Deposits', 'action' => 'index'],
                ['class' => 'list-group-item list-group-item-action', 'escape' => false]
            ) ?>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="col-md-9">
        <div class="card border-dark shadow-sm mb-5">
            <div class="card-body">

                <?= $this->Form->create($deposit, ['type' => 'post']) ?>

                <h4 class="mb-4">ADD DEPOSIT</h4>

                <!-- Dates -->
                <div class="row g-3">
                    <div class="col-md-6">
                        <?= $this->Form->control('doc_date', [
                            'label' => 'Invoice Date',
                            'class' => 'form-control'
                        ]) ?>
                    </div>

                    <div class="col-md-6">
                        <?= $this->Form->control('psoting_date', [
                            'label' => 'BU Submit Date',
                            'class' => 'form-control'
                        ]) ?>
                    </div>
                </div>

                <!-- Reference / Doc Text -->
                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <?= $this->Form->control('reference', [
                            'label' => 'Reference',
                            'class' => 'form-control',
                            'placeholder' => 'Example: DEPO7000P'
                        ]) ?>
                    </div>

                    <div class="col-md-6">
                        <?= $this->Form->control('doc_text', [
                            'label' => 'Document Text',
                            'class' => 'form-control',
                            'placeholder' => 'Example: DEPO_DEC 2025 - JAN 2026'
                        ]) ?>
                    </div>
                </div>

                <!-- Vendor / Amount -->
                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <?= $this->Form->control('account', [
                            'label' => 'Vendor ID',
                            'class' => 'form-control',
                            'placeholder' => 'Example: 806311'
                        ]) ?>
                    </div>

                    <div class="col-md-6">
                        <?= $this->Form->control('amount', [
                            'label' => 'Total Deposit Amount',
                            'class' => 'form-control',
                            'placeholder' => 'Example: 2400'
                        ]) ?>
                    </div>
                </div>

                <!-- Selects -->
                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <?= $this->Form->control('cost_center_id', [
                            'type' => 'select',
                            'options' => $costCenters,
                            'empty' => '-- Select Cost Center --',
                            'label' => ['class' => 'form-label'],
                            'class' => 'form-select'
                        ]) ?>
                    </div>

                    <div class="col-md-6">
                        <?= $this->Form->control('tax_id', [
                            'type' => 'select',
                            'options' => $taxes,
                            'empty' => '-- Select Tax --',
                            'label' => ['class' => 'form-label'],
                            'class' => 'form-select'
                        ]) ?>
                    </div>
                </div>

                <!-- Order / Description -->
                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <?= $this->Form->control('order_number', [
                            'label' => 'Location ID',
                            'class' => 'form-control',
                            'placeholder' => 'Example: A02211' 
                        ]) ?>
                    </div> 

                    <div class="col-md-6">
                        <?= $this->Form->control('description', [
                            'label' => 'Description',
                            'class' => 'form-control',
                            'placeholder' => 'Example: DEPOSIT_KG. BATU 3_8099P'
                        ]) ?>
                    </div>
                </div>  

                <!-- Status -->
                <?= $this->Form->hidden('status', ['value' => 1]) ?>

                <!-- Submit -->
                <div class="d-flex justify-content-end mt-4">
                    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary px-4']) ?>
                </div>

                <?= $this->Form->end() ?>

            </div>
        </div>
    </div>
</div>
