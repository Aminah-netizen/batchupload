<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CostCentersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CostCentersTable Test Case
 */
class CostCentersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CostCentersTable
     */
    protected $CostCenters;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.CostCenters',
        'app.Deposits',
        'app.Rentals',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('CostCenters') ? [] : ['className' => CostCentersTable::class];
        $this->CostCenters = $this->getTableLocator()->get('CostCenters', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->CostCenters);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\CostCentersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
