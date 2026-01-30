<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RentalItem Entity
 *
 * @property int $id
 * @property int $rental_id
 * @property string $reference
 * @property string $doc_text
 * @property int $amount
 * @property string $order_number
 * @property string $description
 * @property int $line_no
 * @property int $status
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\Rental $rental
 */
class RentalItem extends Entity
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
        'rental_id' => true,
        'reference' => true,
        'doc_text' => true,
        'amount' => true,
        'order_number' => true,
        'description' => true,
        'line_no' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'rental' => true,
    ];
}
