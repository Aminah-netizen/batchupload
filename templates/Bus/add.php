<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Deposit $deposit
 * @var \App\Model\Entity\Rental $rental
 * @var \Cake\Collection\CollectionInterface|string[] $costCenters
 * @var \Cake\Collection\CollectionInterface|string[] $taxes
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
                '<i class="fa-solid fa-list me-2"></i> List of Deposits & Rentals',
                ['controller' => 'Bus', 'action' => 'index'],
                ['class' => 'list-group-item list-group-item-action', 'escape' => false]
            ) ?>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="col-md-9">
        <?= $this->Form->create(null, ['type' => 'post']) ?>

        <!-- ==================== DEPOSIT SECTION ==================== -->
        <div class="card border-dark shadow-sm mb-5">
            <div class="card-body">
                <h4 class="mb-4">DEPOSIT</h4>
                <div class="row g-3">
    <div class="col-md-6">
        <?= $this->Form->control('deposit.doc_date', [
            'type' => 'date',      // <-- calendar popup
            'label' => 'Invoice Date',
            'required' => true,
            'class' => 'form-control'
        ]) ?>
    </div>
    <div class="col-md-6">
        <?= $this->Form->control('deposit.psoting_date', [
            'type' => 'date',      // <-- calendar popup
            'label' => 'BU Submit Date',
            'required' => true,
            'class' => 'form-control'
        ]) ?>
    </div>
</div>
                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <?= $this->Form->control('deposit.reference', ['label'=>'Reference','class'=>'form-control', 'maxlength' => 16,     
                        'required' => true, 'placeholder'=>'Example: DEPO7000P']) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('deposit.doc_text', ['label'=>'Document Text','class'=>'form-control', 'maxlength' => 25,     
                        'required' => true, 'placeholder'=>'Example: DEPO_DEC 2025 - JAN 2026']) ?>
                    </div>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <?= $this->Form->control('deposit.account', ['label'=>'Vendor ID','class'=>'form-control','required' => true,'placeholder'=>'Example: 806311']) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('deposit.amount', ['label'=>'Total Deposit Amount','class'=>'form-control','required' => true,'placeholder'=>'Example: 2400']) ?>
                    </div>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <?= $this->Form->control('deposit.cost_center_id', ['type'=>'select','options'=>$costCenters,'empty'=>'-- Select Cost Center --','required' => true,'class'=>'form-select']) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('deposit.tax_id', ['type'=>'select','options'=>$taxes,'empty'=>'-- Select Tax --','required' => true,'class'=>'form-select']) ?>
                    </div>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <?= $this->Form->control('deposit.order_number', ['label'=>'Location ID','class'=>'form-control', 'maxlength' => 12,     // max length like original
                        'required' => true, 'placeholder'=>'Example: A02211']) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('deposit.description', ['label'=>'Description', 'maxlength' => 50,     // max length like original
                        'required' => true, 'class'=>'form-control','placeholder'=>'Example: DEPOSIT_KG. BATU 3_8099P']) ?>
                    </div>
                </div>

                <?= $this->Form->hidden('deposit.status', ['value'=>1]) ?>
            </div>
        </div>

        <!-- ==================== RENTAL SECTION ==================== -->
        <div class="card border-dark shadow-sm mb-3">
            <div class="card-body">
                <h4 class="mb-4">RENTAL</h4>

                <div class="row g-3">
                     <div class="col-md-6">
            <?= $this->Form->control('rental.invoice_date', [
            'type' => 'date',      // <-- calendar popup
            'label' => 'Invoice Date',
            'required' => true,
            'class' => 'form-control'
                ]) ?>
            </div>
            <div class="col-md-6">
                <?= $this->Form->control('rental.submit_date', [
                    'type' => 'date',      // <-- calendar popup
                    'label' => 'BU Submit Date',
                    'required' => true,
                    'class' => 'form-control'
                ]) ?>
            </div>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <?= $this->Form->control('rental.reference', ['label'=>'Reference', 'maxlength' => 16,'required' => true, 'class'=>'form-control','placeholder'=>'Example: SR7000P']) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('rental.doc_text', ['label'=>'Document Text','class'=>'form-control','maxlength' => 25,'required' => true, 'placeholder'=>'Example: SR_DEC 2025 - JAN 2026']) ?>
                    </div>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <?= $this->Form->control('rental.account', ['label'=>'Vendor ID','class'=>'form-control','required' => true,'placeholder'=>'Example: 806311']) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('rental.amount', ['label'=>'Total Rental Amount','class'=>'form-control','required' => true,'placeholder'=>'Example: 1200']) ?>
                    </div>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <?= $this->Form->control('rental.cost_center_id', ['type'=>'select','options'=>$costCenters,'empty'=>'-- Select Cost Center --','required' => true,'class'=>'form-select']) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('rental.tax_id', ['type'=>'select','options'=>$taxes,'empty'=>'-- Select Tax --','required' => true,'class'=>'form-select']) ?>
                    </div>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <?= $this->Form->control('rental.order_number', ['label'=>'Location ID','class'=>'form-control','maxlength' => 12,'required' => true, 'placeholder'=>'Example: A02211']) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('rental.description', ['label'=>'Description','class'=>'form-control','maxlength' => 50,'required' => true, 'placeholder'=>'Example: RENTAL_KG. BATU 3_8099P']) ?>
                    </div>
                </div>

                <?= $this->Form->hidden('rental.status', ['value'=>1]) ?>
            </div>
        </div>

        <!-- ==================== SINGLE SUBMIT BUTTON ==================== -->
        <div class="d-flex justify-content-end mb-5">
            <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary']) ?>
        </div>

        <?= $this->Form->end() ?>
    </div>
</div>
