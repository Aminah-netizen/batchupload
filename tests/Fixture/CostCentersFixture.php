<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CostCentersFixture
 */
class CostCentersFixture extends TestFixture
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
                'created' => '2026-01-27 02:25:06',
                'modified' => '2026-01-27 02:25:06',
            ],
        ];
        parent::init();
    }
}
