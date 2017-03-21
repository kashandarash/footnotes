<?php

/**
 * @file
 * Contains \Drupal\module_test\Plugin\CKEditorPlugin\FootnotesCKEditorButton.
 */

namespace Drupal\module_test\Plugin\CKEditorPlugin;

use Drupal\ckeditor\CKEditorPluginBase;
use Drupal\editor\Entity\Editor;

/**
 * Defines the "footnotes" plugin.
 *
 * NOTE: The plugin ID ('id' key) corresponds to the CKEditor plugin name.
 * It is the first argument of the CKEDITOR.plugins.add() function in the
 * plugin.js file.
 *
 * @CKEditorPlugin(
 *   id = "footnotes",
 *   label = @Translation("Footnotes ckeditor button")
 * )
 */
class FootnotesCKEditorButton extends CKEditorPluginBase {

  /**
   * {@inheritdoc}
   *
   * NOTE: The keys of the returned array corresponds to the CKEditor button
   * names. They are the first argument of the editor.ui.addButton() or
   * editor.ui.addRichCombo() functions in the plugin.js file.
   */
  public function getButtons() {
    // Make sure that the path to the image matches the file structure of
    // the CKEditor plugin you are implementing.
    $path = drupal_get_path('module', 'module_test');
    return array(
      'Footnotes' => array(
        'label' => t('Footnotes ckeditor button'),
        'image' => $path . '/js/icons/footnotes.png',
      ),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFile() {
      return drupal_get_path('module', 'module_test') . '/js/plugin.js';
  }

  /**
   * {@inheritdoc}
   */
  function isInternal() {
    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  function getDependencies(Editor $editor) {
    return array();
  }

  /**
   * {@inheritdoc}
   */
  function getLibraries(Editor $editor) {
      return array(
         'module_test/footnotes',
      );
  }

  /**
   * {@inheritdoc}
   */
  public function getConfig(Editor $editor) {
    $config = \Drupal::config('footnotes_settings.test');
    return array(
      'footnotesTitle' => $config->get('title'),
    );
  }

}
