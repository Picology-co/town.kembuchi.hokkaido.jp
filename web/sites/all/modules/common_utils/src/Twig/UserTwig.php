<?php

namespace Drupal\common_utils\Twig;

// Twig実装必要↓
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;
use Twig\TwigFunction;

class UserTwig extends AbstractExtension implements GlobalsInterface {

  public function getName() {
    return 'user_twig_php';
  }

/*   public function getFunctions() {
    return [
      new TwigFunction('userid', [$this, 'getUserId']),
      new TwigFunction('username', [$this, 'getUserName']),
      new TwigFunction('roles', [$this, 'getUserRoles']),
    ];
  } */

  public function getGlobals(): array {

    return [
      'userid' => $this->getUserId(),
      'username' => $this->getUserName(),
      'roles' => $this->getUserRoles(),
    ];
  }

  /**
   * ログイン中のユーザーIDを取得する。
   * @return int $user_id
   */
  public function getUserId() {

    $user_id = \Drupal::currentUser()->id();
    return $user_id;

  }

  /**
   * ログイン中のユーザー名を取得する。
   * @return string $user_name
   */
  public function getUserName() {

    $user_name = \Drupal::currentUser()->getAccountName();
    return $user_name;
  }

  /**
   * ログイン中のユーザーに付与されているロールを取得する。
   * @return array
   */
  public function getUserRoles() {

    $user_role = \Drupal::currentUser()->getRoles();
    return $user_role;
  }
}