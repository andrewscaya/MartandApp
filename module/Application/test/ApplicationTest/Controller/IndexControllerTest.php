<?php

namespace ApplicationTest\Controller;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use Application\Controller\IndexController;

/**
 * IndexController test case.
 */
class IndexControllerTest extends AbstractHttpControllerTestCase
{

    protected $traceError = true;


    /**
     * Prepares the environment before running tests.
     */
    protected function setUp()
    {
        $this->setApplicationConfig(
            include __DIR__
                    . DIRECTORY_SEPARATOR
                    . '..'
                    . DIRECTORY_SEPARATOR
                    . '..'
                    . DIRECTORY_SEPARATOR
                    . '..'
                    . DIRECTORY_SEPARATOR
                    . '..'
                    . DIRECTORY_SEPARATOR
                    . '..'
                    . DIRECTORY_SEPARATOR
                    . 'config'
                    . DIRECTORY_SEPARATOR
                    . 'application.config.test.php'
        );

        parent::setUp();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * Tests IndexController->indexAction()
     */
    public function testIndexActionCanBeAccessed()
    {
        $this->dispatch('/');
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Application');
        $this->assertControllerName('application-controller-index');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('home');
    }

    /**
     * Tests IndexController->formAction()
     */
    public function testFormActionReturnsEmptyDataArrayWithGetMethod()
    {
        $controller = new IndexController();
        $viewModel = $controller->formAction();
        $this->assertEmpty($viewModel->getVariable('data'));
    }
}
