<?php

/**
 * @file
 * Contains \Drupal\Core\Render\Element\Email.
 */

namespace Drupal\Core\Render\Element;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element;

/**
 * Provides a form input element for entering an email address.
 *
 * Properties:
 * - #default_value: An RFC-compliant email address.
 *
 * Example usage:
 * @code
 * $form['email'] = array(
 *   '#type' => 'email',
 *   '#title' => t('Email'),
 * );
 * @end
 *
 * @see \Drupal\Core\Render\Element\Render\Textfield
 *
 * @FormElement("email")
 */
class Email extends FormElement {

  /**
   * Defines the max length for an email address
   *
   * The maximum length of an email address is 254 characters. RFC 3696
   * specifies a total length of 320 characters, but mentions that
   * addresses longer than 256 characters are not normally useful. Erratum
   * 1690 was then released which corrected this value to 254 characters.
   * @see http://tools.ietf.org/html/rfc3696#section-3
   * @see http://www.rfc-editor.org/errata_search.php?rfc=3696&eid=1690
   */
  const EMAIL_MAX_LENGTH = 254;

  /**
   * {@inheritdoc}
   */
  public function getInfo() {
    $class = get_class($this);
    return array(
      '#input' => TRUE,
      '#size' => 60,
      '#maxlength' => self::EMAIL_MAX_LENGTH,
      '#autocomplete_route_name' => FALSE,
      '#process' => array(
        array($class, 'processAutocomplete'),
        array($class, 'processAjaxForm'),
        array($class, 'processPattern'),
      ),
      '#element_validate' => array(
        array($class, 'validateEmail'),
      ),
      '#pre_render' => array(
        array($class, 'preRenderEmail'),
      ),
      '#theme' => 'input__email',
      '#theme_wrappers' => array('form_element'),
    );
  }

  /**
   * Form element validation handler for #type 'email'.
   *
   * Note that #maxlength and #required is validated by _form_validate() already.
   */
  public static function validateEmail(&$element, FormStateInterface $form_state, &$complete_form) {
    $value = trim($element['#value']);
    $form_state->setValueForElement($element, $value);

    if ($value !== '' && !\Drupal::service('email.validator')->isValid($value)) {
      $form_state->setError($element, t('The email address %mail is not valid.', array('%mail' => $value)));
    }
  }

  /**
   * Prepares a #type 'email' render element for input.html.twig.
   *
   * @param array $element
   *   An associative array containing the properties of the element.
   *   Properties used: #title, #value, #description, #size, #maxlength,
   *   #placeholder, #required, #attributes.
   *
   * @return array
   *   The $element with prepared variables ready for input.html.twig.
   */
  public static function preRenderEmail($element) {
    $element['#attributes']['type'] = 'email';
    Element::setAttributes($element, array('id', 'name', 'value', 'size', 'maxlength', 'placeholder'));
    static::setAttributes($element, array('form-email'));
    return $element;
  }

}
