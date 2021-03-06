<?php

namespace Acquia\Blt\Robo\Tasks;

use Robo\Task\Vcs\GitStack;

/**
 * Class GitTask
 * @package Acquia\Blt\Robo\Tasks
 *
 * Runs Git tasks using BLT-specific helpers, such as setting the commit author.
 */
class GitTask extends GitStack {

  /**
   * @inheritDoc
   */
  public function commit($message, $options = "") {
    $message = escapeshellarg($message);
    $git_name = $this->getConfig()->get('git.user.name');
    $git_email = $this->getConfig()->get('git.user.email');

    $command = ['git'];
    if ($git_name && $git_email) {
      $command[] = '-c user.name=' . escapeshellarg($git_name);
      $command[] = '-c user.email=' . escapeshellarg($git_email);
    }
    $command[] = 'commit';
    $command[] = "-m $message";
    $command[] = $options;
    return $this->exec($command);
  }

  /**
   * @inheritDoc
   */
  public function tag($tag_name, $message = "") {
    $message = escapeshellarg($message);
    $tag_name = escapeshellarg($tag_name);
    $git_name = $this->getConfig()->get('git.user.name');
    $git_email = $this->getConfig()->get('git.user.email');

    $command = ['git'];
    if ($git_name && $git_email) {
      $command[] = '-c user.name=' . escapeshellarg($git_name);
      $command[] = '-c user.email=' . escapeshellarg($git_email);
    }
    $command[] = 'tag';
    $command[] = "-a $tag_name";
    $command[] = "-m $message";
    return $this->exec($command);
  }

}
