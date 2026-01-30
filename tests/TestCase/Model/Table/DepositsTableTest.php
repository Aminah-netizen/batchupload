<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DepositsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DepositsTable Test Case
 */
class DepositsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DepositsTable
     */
    protected $Deposits;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Deposits',
        'app.CostCenters',
        'app.Taxes',
        'app.DepositItems',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Deposits') ? [] : ['className' => DepositsTable::class];
        $this->Deposits = $this->getTableLocator()->get('Deposits', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Deposits);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\DepositsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\DepositsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
