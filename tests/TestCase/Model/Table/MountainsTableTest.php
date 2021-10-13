<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MountainsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MountainsTable Test Case
 */
class MountainsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MountainsTable
     */
    protected $Mountains;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Mountains',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Mountains') ? [] : ['className' => MountainsTable::class];
        $this->Mountains = $this->getTableLocator()->get('Mountains', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Mountains);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\MountainsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
