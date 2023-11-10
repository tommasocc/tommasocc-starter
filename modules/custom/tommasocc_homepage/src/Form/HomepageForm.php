<?php

namespace Drupal\tommasocc_homepage\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the homepage entity edit forms.
 */
class HomepageForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $result = parent::save($form, $form_state);

    $entity = $this->getEntity();

    $message_arguments = ['%label' => $entity->toLink()->toString()];
    $logger_arguments = [
      '%label' => $entity->label(),
      'link' => $entity->toLink($this->t('View'))->toString(),
    ];

    switch ($result) {
      case SAVED_NEW:
        $this->messenger()->addStatus($this->t('New homepage %label has been created.', $message_arguments));
        $this->logger('tommasocc_homepage')->notice('Created new homepage %label', $logger_arguments);
        break;

      case SAVED_UPDATED:
        $this->messenger()->addStatus($this->t('The homepage %label has been updated.', $message_arguments));
        $this->logger('tommasocc_homepage')->notice('Updated homepage %label.', $logger_arguments);
        break;
    }

    $form_state->setRedirect('entity.homepage.canonical', ['homepage' => $entity->id()]);

    return $result;
  }

}
