<?php

/**
 * @file
 */
namespace Drupal\chewie\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Creates a Banner Block
 * @Block(
 * id = "block_banner_block",
 * admin_label = @Translation("Banner Block"),
 * )
 */
class BannerBlock extends BlockBase {

    /**
     * {@inheritdoc}
     */
    public function build() {
        return array (
            '#type' => 'markup',
            '#markup' => '<h2>Foo Bar</h2>',
        );
    }

}
