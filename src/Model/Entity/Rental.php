<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Rental Entity
 *
 * @property int $id
 * @property \Cake\I18n\Date $invoice_date
 * @property \Cake\I18n\Date $submit_date
 * @property string $reference
 * @property string $doc_text
 * @property int $account
 * @property int $amount
 * @property int $cost_center_id
 * @property int $tax_id
 * @property string $order_number
 * @property string $description
 * @property int $status
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\CostCenter $cost_center
 * @property \App\Model\Entity\Tax $tax
 * @property \App\Model\Entity\RentalItem[] $rental_items
 */
class Rental extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        '*' => true,
        'id' => false,
        'invoice_date' => true,
        'submit_date' => true,
        'reference' => true,
        'doc_text' => true,
        'account' => true,
        'amount' => true,
        'cost_center_id' => true,
        'tax_id' => true,
        'order_number' => true,
        'description' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'cost_center' => true,
        'tax' => true,
        'rental_items' => true,
    ];
}
