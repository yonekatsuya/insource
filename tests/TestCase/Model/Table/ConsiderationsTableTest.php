<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ConsiderationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ConsiderationsTable Test Case
 */
class ConsiderationsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ConsiderationsTable
     */
    public $Considerations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Considerations',
        'app.Users',
        'app.Seminars',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Considerations') ? [] : ['className' => ConsiderationsTable::class];
        $this->Considerations = TableRegistry::getTableLocator()->get('Considerations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Considerations);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
