<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TaxesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TaxesTable Test Case
 */
class TaxesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TaxesTable
     */
    protected $Taxes;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Taxes',
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
        $config = $this->getTableLocator()->exists('Taxes') ? [] : ['className' => TaxesTable::class];
        $this->Taxes = $this->getTableLocator()->get('Taxes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Taxes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\TaxesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
