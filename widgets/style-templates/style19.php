<?php
/**
 * @===================//// Template design
 */

echo '<div class="apostst-gallery-filtering-nineteen apostst-gallery-filtering-common">';
  echo '<div class="container">';
    echo '<div class="row">';
      echo '<div class="col-xl-12">';
        echo '<div class="apostst-gallery-menu-nineteen d-flex apostst-my-commonsk-class pb-40">';
        include( __DIR__ . '/texo-datas/items.php' );
        echo '</div>';
      echo '</div>';
    echo '</div>';
    echo '<div class="row apostst-grid-nineteen apostst-grid-common section" id="boxContainer">';
      include( __DIR__ . '/texo-datas/datas-all.php' );
    echo '</div>';
  echo '</div>';
echo '</div>';