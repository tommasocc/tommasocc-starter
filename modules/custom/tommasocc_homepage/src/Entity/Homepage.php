<?php

namespace Drupal\tommasocc_homepage\Entity;

use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\RevisionableContentEntityBase;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\tommasocc_homepage\HomepageInterface;

/**
 * Defines the homepage entity class.
 *
 * @ContentEntityType(
 *   id = "homepage",
 *   label = @Translation("Homepage"),
 *   label_collection = @Translation("Homepages"),
 *   label_singular = @Translation("homepage"),
 *   label_plural = @Translation("homepages"),
 *   label_count = @PluralTranslation(
 *     singular = "@count homepages",
 *     plural = "@count homepages",
 *   ),
 *   handlers = {
 *     "list_builder" = "Drupal\tommasocc_homepage\HomepageListBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "form" = {
 *       "add" = "Drupal\tommasocc_homepage\Form\HomepageForm",
 *       "edit" = "Drupal\tommasocc_homepage\Form\HomepageForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     }
 *   },
 *   base_table = "homepage",
 *   data_table = "homepage_field_data",
 *   revision_table = "homepage_revision",
 *   revision_data_table = "homepage_field_revision",
 *   show_revision_ui = TRUE,
 *   translatable = TRUE,
 *   admin_permission = "administer homepage",
 *   entity_keys = {
 *     "id" = "id",
 *     "revision" = "revision_id",
 *     "langcode" = "langcode",
 *     "label" = "label",
 *     "uuid" = "uuid",
 *   },
 *   revision_metadata_keys = {
 *     "revision_created" = "revision_created",
 *     "revision_log_message" = "revision_log",
 *     "revision_user" = "revision_user",
 *   },
 *   links = {
 *     "collection" = "/admin/content/homepage",
 *     "add-form" = "/home/add",
 *     "canonical" = "/home/{homepage}",
 *     "edit-form" = "/home/{homepage}/edit",
 *     "delete-form" = "/home/{homepage}/delete",
 *   },
 *   field_ui_base_route = "entity.homepage.settings",
 * )
 */
class Homepage extends RevisionableContentEntityBase implements HomepageInterface {

  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {

    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['label'] = BaseFieldDefinition::create('string')
      ->setRevisionable(TRUE)
      ->setTranslatable(TRUE)
      ->setLabel(t('Label'))
      ->setRequired(TRUE)
      ->setSetting('max_length', 255)
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -5,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'string',
        'weight' => -5,
      ])
      ->setDisplayConfigurable('view', TRUE);

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setTranslatable(TRUE)
      ->setDescription(t('The time that the homepage was last edited.'));

    return $fields;
  }

}
