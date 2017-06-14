<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsersFieldsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersFieldsTable Test Case
 */
class UsersFieldsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UsersFieldsTable
     */
    public $UsersFields;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.users_fields',
        'app.users',
        'app.fields',
        'app.users_games'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('UsersFields') ? [] : ['className' => 'App\Model\Table\UsersFieldsTable'];
        $this->UsersFields = TableRegistry::get('UsersFields', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UsersFields);

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
