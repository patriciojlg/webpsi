<ul>
<?php
  if ( !empty( $cn_data['cn']) ) :
    foreach ( $cn_data['cn'] as $elm ) : ?>
        
        <?php if ( $elm['el-url'] != '' ) :
                $url_link = $elm['el-url'];
            elseif ( ($elm['el-url'] == '') && ($elm['el-post'] != 'none') ) :
                $url_link = get_permalink( $elm['el-post'] );
            elseif ( ($elm['el-url'] == '') && ($elm['el-post'] == 'none') && ($elm['el-page'] != 'none') ) :
                $url_link = get_permalink( $elm['el-page'] );
            elseif ( ($elm['el-url'] == '') && ($elm['el-post'] == 'none') && ($elm['el-page'] == 'none') ) :
                $url_link = '#';
        endif; ?>
    
        <?php if ( !isset($elm['el-target']) ) :
                $target = "_self";
              elseif ($elm['el-target'] == 'on') :
                $target = "_blank";
        endif; ?>
    
        <?php if ( !isset ($elm['el-icon']) ) : 
            $elm['el-icon'] = 'none';
        endif; ?>
         <?php if ($elm['el-icon'] != 'none') : ?>
        
             <?php if ($elm['el-text'] != '') : ?>
                <li tabindex="-1"><a class="cn-anchor" href="<?php echo $url_link; ?>" target="<?php echo $target; ?>" title="<?php echo $elm['el-title']; ?>" tabindex="-1"><span><p><?php echo $elm['el-text']; ?></p><i class="fa fa-<?php echo $elm['el-icon']; ?>"></i></span></a></li>
             <?php elseif ($elm['el-text'] == '') : ?>
                <li tabindex="-1"><a class="cn-anchor" href="<?php echo $url_link; ?>" target="<?php echo $target; ?>" title="<?php echo $elm['el-title']; ?>" tabindex="-1"><span><i class="fa fa-<?php echo $elm['el-icon']; ?>"></i></span></a></li>
             <?php endif; ?>
        
        <?php elseif ($elm['el-icon'] == 'none') : ?>
        
             <?php if ($elm['el-text'] != '') : ?>
                <li tabindex="-1"><a class="cn-anchor" href="<?php echo $url_link; ?>" target="<?php echo $target; ?>" title="<?php echo $elm['el-title']; ?>" tabindex="-1"><span><p><?php echo $elm['el-text']; ?></p></span></a></li>
             <?php elseif ($elm['el-text'] == '') : ?>
                <li tabindex="-1"><a class="cn-anchor" href="<?php echo $url_link; ?>" target="<?php echo $target; ?>" title="<?php echo $elm['el-title']; ?>" tabindex="-1"><span><p>&nbsp;</p></span></a></li>
            <?php endif; ?>
                
        <?php endif; ?>
    
    <?php endforeach;
  endif;
?>
</ul>