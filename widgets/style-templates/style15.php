<?php
/**
 * @===================//// Template design
 */

echo '<div class="apostst-gallery-filtering-fifteen apostst-gallery-filtering-common">';
  echo '<div class="container-fluid p-0">';
    echo '<div class="row">';
      echo '<div class="col-xl-12">';
        echo '<div class="apostst-gallery-menu-fifteen d-flex apostst-my-commonsk-class pb-40">';
        include( __DIR__ . '/texo-datas/items.php' );
        echo '</div>';
      echo '</div>';
    echo '</div>';
    echo '<div class="row apostst-grid-fifteen apostst-grid-common">';
      include( __DIR__ . '/texo-datas/datas-all.php' );
    echo '</div>';
  echo '</div>';
echo '</div>';