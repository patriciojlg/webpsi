<?php
/*
 * Depending on number of navigation elements central angle '$yca' for transformations and calculations is different.
 * Moreover, offset '$offset' used for adjusting edges of semicircle changes too.
 */
if ( !empty( $cn_data['cn']) ) {
    $elements = $cn_data['cn'];
    $n_elm = count($elements);

    if ( $n_elm == 2 ){
        $yca = 90;
        $offset = 0;
    }elseif ( $n_elm == 3 ){
        $yca = 70;
        $offset = 30;
    }elseif ( $n_elm == 4 ){
        $yca = 51;
        $offset = 24;
    }elseif ( $n_elm == 5 ){
        $yca = 40;
        $offset = 20;
    }elseif ( $n_elm == 6 ){
        $yca = 32;
        $offset = 12;
    }elseif ( $n_elm == 7 ){
        $yca = 27;
        $offset = 9;
    }elseif ( $n_elm == 8 ){
        $yca = 23.5;
        $offset = 8;
    }


    /*
     * Depending on chosen position, formulas and indexes needed for calculations are different.
     * This is generation of each element css transformation (depending also on the number of navigation elements)
     * Moreover, depending on position, we have to change some absolute and padding overall menu positioning plus some other tweaks in button content
     */
    $position = $cn_data['position'];

    if ($position == 'bottom'){
        $skew_i = 90 - $yca; 
        $skew_a = -$skew_i;
        $rotate_a = -(90 - $yca/2);?>
    /* Main transformations */

    .cn-modern .cn-wrapper li a {
        -webkit-transform: skew(<?php echo $skew_a; ?>deg) rotate(<?php echo $rotate_a; ?>deg) scale(1);
        -ms-transform: skew(<?php echo $skew_a; ?>deg) rotate(<?php echo $rotate_a; ?>deg) scale(1);
        -moz-transform: skew(<?php echo $skew_a; ?>deg) rotate(<?php echo $rotate_a; ?>deg) scale(1);
        transform: skew(<?php echo $skew_a; ?>deg) rotate(<?php echo $rotate_a; ?>deg) scale(1);
    }
        <?php
        for ( $i = 0; $i < $n_elm ; $i++){
            if ($i == 0){
                $rotate_i = ($i * $yca) - $offset/2; ?>
    .cn-modern .cn-wrapper li:first-child {
        -webkit-transform: rotate(<?php echo $rotate_i; ?>deg) skew(<?php echo $skew_i; ?>deg);
        -ms-transform: rotate(<?php echo $rotate_i; ?>deg) skew(<?php echo $skew_i; ?>deg);
        -moz-transform: rotate(<?php echo $rotate_i; ?>deg) skew(<?php echo $skew_i; ?>deg);
        transform: rotate(<?php echo $rotate_i; ?>deg) skew(<?php echo $skew_i; ?>deg);
    }
            <?php
            }else{
                $rotate_i = ($i * $yca) - $offset/2; ?>
    .cn-modern .cn-wrapper li:nth-child(<?php $pos = $i + 1; echo $pos; ?>) {
        -webkit-transform: rotate(<?php echo $rotate_i; ?>deg) skew(<?php echo $skew_i; ?>deg);
        -ms-transform: rotate(<?php echo $rotate_i; ?>deg) skew(<?php echo $skew_i; ?>deg);
        -moz-transform: rotate(<?php echo $rotate_i; ?>deg) skew(<?php echo $skew_i; ?>deg);
        transform: rotate(<?php echo $rotate_i; ?>deg) skew(<?php echo $skew_i; ?>deg);
    }
            <?php
            }
        }?>
    /* Position tweaks */

    .cn-modern .cn-wrapper {
        bottom: -13em;
        left: 50%;
        margin-left: -13em;
    }
    .cn-modern .cn-button {
        left: 50%;
        bottom: -1.75em;
        padding-bottom: 1.45em;
        margin-left: -1.75em;
        padding-top: 0 !important;
    }
    .cn-modern.cn-asb .cn-wrapper.top-position {
        top: auto !important;
    }
    .cn-modern.cn-asb .cn-button.top-position{
        top: auto !important;
    }
    .cn-modern .cn-wrapper li:first-child a span p{
         padding-left: 15px;
     }
     .cn-modern .cn-wrapper li:first-child a span i{
         padding-left: 10px;
     }
     .cn-modern .cn-wrapper li:last-child a span p{
         padding-right: 15px;
     }
     .cn-modern .cn-wrapper li:last-child a span i{
         padding-right: 10px;
     }
    <?php }//End bottom position
    

}

/* 
 * Colors schemes for navigation elements and menu button
 */
if ( !isset($cn_data['own_scheme']['enabled']) ) {
    $color_scheme = $cn_data['color-scheme'];
    switch ($color_scheme) {
        case "ggish":
          $odd_color = "#40411E";
          $even_color = "#787746";
          $hover_color = "#B4AF91";
          break;
        case "grey":
          $odd_color = "#7F7F7E";
          $even_color = "#A1A19F";
          $hover_color = "#BFBFBE";
          break;
        case "bluish":
          $odd_color = "#75A5E5";
          $even_color = "#82B7FF";
          $hover_color = "#628ABF";
          break;
        case "aqua":
          $odd_color = "#3FB8AF";
          $even_color = "#7FC7AF";
          $hover_color = "#297872";
          break;
        case "green":
          $odd_color = "#168039";
          $even_color = "#389C45";
          $hover_color = "#96ED89";
          break;
        case "yellow":
          $odd_color = "#BFAA15";
          $even_color = "#E5CD19";
          $hover_color = "#FFE31C";
          break;
        case "orange":
          $odd_color = "#DE6D00";
          $even_color = "#EE8900";
          $hover_color = "#FCA600";
          break;
        case "red":
          $odd_color = "#EC6B4D";
          $even_color = "#EC8269";
          $hover_color = "#D74421";
          break;
        case "violet":
          $odd_color = "#B386CF";
          $even_color = "#D0AFE5";
          $hover_color = "#E3CEED";
          break;
        case "brown":
          $odd_color = "#AD9863";
          $even_color = "#C2AA6F";
          $hover_color = "#84754B";
          break;
        case "black":
          $odd_color = "#030202";
          $even_color = "#121111";
          $hover_color = "#262525";
          break;
        case "trans":
          $odd_color = "none !important";
          $even_color = "none !important";
          $hover_color = "none !important";
          break;
        default:
          $odd_color = "#40411E";
          $even_color = "#787746";
          $hover_color = "#B4AF91";
    } 
}
 ?>
/* Colors */

.cn-modern .cn-wrapper li:nth-child(odd) a {
    background-color: <?php echo $odd_color; ?>;
}
.cn-modern .cn-wrapper li:nth-child(even) a {
    background-color: <?php echo $even_color; ?>;
}
.cn-modern .cn-button {
    background-color: <?php echo $cn_data['btn-bg']; ?>;
}
@media screen and (min-width:1280px) { /* Only activate hover, focus, etc, styles on desktop-laptop screens and above */
    .cn-modern .cn-wrapper li.active a {
      background-color: <?php echo $hover_color; ?>;
    }
    .cn-modern .cn-wrapper li:not(.active) a:hover,
    .cn-modern .cn-wrapper li:not(.active) a:active,
    .cn-modern .cn-wrapper li:not(.active) a:focus {
      background-color: <?php echo $hover_color; ?>;
    }
    .cn-modern .cn-button:hover,
    .cn-modern .cn-button:active,
    .cn-modern .cn-button:focus {
        background-color: <?php echo $cn_data['btn-bg-hover']; ?>;
    }
}

<?php



/*
 * Font color and sizes, for navigation elements and button contents
 */
// Button
$small_screens_btn_content_size = $cn_data['btn-content-size'];
$medium_screens_btn_content_size = $small_screens_btn_content_size + 6;
$large_screens_btn_content_size = $small_screens_btn_content_size + 12;
?>
.cn-modern .cn-button-text {
    color: #ffffff;
    font-size: <?php echo $small_screens_btn_content_size; ?>px;
}
@media screen and (min-width:768px) {
    .cn-modern .cn-button-text {
        font-size: <?php echo $medium_screens_btn_content_size; ?>px;
    }
}
@media screen and (min-width:1680px) {
    .cn-modern .cn-button-text {
        font-size: <?php echo $large_screens_btn_content_size; ?>px;
    }
}
<?php
// Navigation elements
$small_screens_nav_icon_size = $cn_data['nav-icon-size'];
$medium_screens_nav_icon_size = $small_screens_nav_icon_size + 6;
$large_screens_nav_icon_size = $small_screens_nav_icon_size + 12;
$small_screens_nav_text_size = $cn_data['nav-text-size'];
$medium_screens_nav_text_size = $small_screens_nav_text_size + 4;
$large_screens_nav_text_size = $small_screens_nav_text_size + 8;
?>
/* Navigation icon and text sizes and colors */

.cn-modern .cn-wrapper li a span {
    color: #ffffff;
    font-size: <?php echo $small_screens_nav_icon_size; ?>px;
}
.cn-modern .cn-wrapper li a span p {
    color: #ffffff;
    font-size: <?php echo $small_screens_nav_text_size; ?>px;
    margin-top: -20px;
}
@media screen and (min-width:768px) {
    .cn-modern .cn-wrapper li a span {
        font-size: <?php echo $medium_screens_nav_icon_size; ?>px;
    }
    .cn-modern .cn-wrapper li a span p {
        font-size: <?php echo $medium_screens_nav_text_size; ?>px;
        margin-top: -25px;
    }
}
@media screen and (min-width:1680px) {
    .cn-modern .cn-wrapper li a span {
        font-size: <?php echo $large_screens_nav_icon_size; ?>px;
    }
    .cn-modern .cn-wrapper li a span p {
        font-size: <?php echo $large_screens_nav_text_size; ?>px;
        margin-top: -30px;
    }
}