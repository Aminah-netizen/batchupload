<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DepositItemsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DepositItemsTable Test Case
 */
class DepositItemsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DepositItemsTable
     */
    protected $DepositItems;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.DepositItems',
        'app.Deposits',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('DepositItems') ? [] : ['className' => DepositItemsTable::class];
        $this->DepositItems = $this->getTableLocator()->get('DepositItems', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->DepositItems);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\DepositItemsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\DepositItemsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
