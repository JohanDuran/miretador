<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsersGamesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersGamesTable Test Case
 */
class UsersGamesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UsersGamesTable
     */
    public $UsersGames;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.users_games',
        'app.users',
        'app.fields',
        'app.users_fields'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('UsersGames') ? [] : ['className' => 'App\Model\Table\UsersGamesTable'];
        $this->UsersGames = TableRegistry::get('UsersGames', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UsersGames);

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
