<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * DepositsFixture
 */
class DepositsFixture extends TestFixture
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
                'doc_date' => '2026-01-27',
                'psoting_date' => '2026-01-27',
                'reference' => 'Lorem ipsum do',
                'doc_text' => 'Lorem ipsum dolor sit a',
                'account' => 1,
                'amount' => 1,
                'cost_center_id' => 1,
                'tax_id' => 1,
                'order_number' => 'Lorem ipsu',
                'description' => 'Lorem ipsum dolor sit amet',
                'status' => 1,
                'created' => '2026-01-27 02:25:23',
                'modified' => '2026-01-27 02:25:23',
            ],
        ];
        parent::init();
    }
}
