<?php

namespace Drupal\module_test\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Tests module_test module functionality
 *
 * @group Footnotes
 */
class ModuleTestTest extends WebTestBase {

  /**
   * Modules to install.
   *
   * @var array
   */
  public static $modules = array('module_test');

  /**
   * A simple user with 'administer site configuration' permission
   */
  private $user;

  /**
   * Perform any initial set up tasks that run before every test method
   */
  public function setUp() {
    parent::setUp();
    $this->user = $this->drupalCreateUser(array('administer site configuration'));

  }


  /**
   * Tests the custom form
   */
  public function testCustomFormWorks() {
    // Login
    $this->drupalLogin($this->user);
    // Test the form page shows.
    $this->drupalGet('admin/config/content/footnones');
    $this->assertResponse(200);

    // Test the form submission works.
    $this->drupalPostForm(NULL, array(
      'title' => 'Some title'
    ), t('Save configuration'));
    $this->assertText('The configuration options have been saved.', 'The form was saved correctly.');

    // Test form saved.
    $this->drupalGet('admin/config/content/footnones');
    $this->assertResponse(200);
    $this->assertFieldByName('title', 'Some title', 'The field was found with the correct value.');
  }

}