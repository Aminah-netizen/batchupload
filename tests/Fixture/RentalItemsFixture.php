<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RentalItemsFixture
 */
class RentalItemsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'rental_id' => 1,
                'reference' => 'Lorem ipsum do',
                'doc_text' => 'Lorem ipsum dolor sit a',
                'amount' => 1,
                'order_number' => 'Lorem ipsu',
                'description' => 'Lorem ipsum dolor sit amet',
                'line_no' => 1,
                'status' => 1,
                'created' => '2026-01-27 02:25:59',
                'modified' => '2026-01-27 02:25:59',
            ],
        ];
        parent::init();
    }
}
