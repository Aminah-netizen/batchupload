<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TaxesFixture
 */
class TaxesFixture extends TestFixture
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
                'name' => 'Lorem ip',
                'status' => 1,
                'created' => '2026-01-27 02:26:07',
                'modified' => '2026-01-27 02:26:07',
            ],
        ];
        parent::init();
    }
}
