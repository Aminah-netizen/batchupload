<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RentalItemsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RentalItemsTable Test Case
 */
class RentalItemsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RentalItemsTable
     */
    protected $RentalItems;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.RentalItems',
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
        $config = $this->getTableLocator()->exists('RentalItems') ? [] : ['className' => RentalItemsTable::class];
        $this->RentalItems = $this->getTableLocator()->get('RentalItems', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->RentalItems);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\RentalItemsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\RentalItemsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
