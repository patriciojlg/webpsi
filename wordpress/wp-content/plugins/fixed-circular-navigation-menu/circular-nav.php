<?php
/**
 * @package   Fixed Circular Navigation Menu
 * @author    Enrique Crespo Molera <contact@e-crespo.com>
 * @license   GPL-2.0+
 * @link      http://wordpress-fixed-circular-nav.e-crespo.com
 * @copyright 2014 Enrique Crespo Molera
 *
 * @wordpress-plugin
 * Plugin Name:       Fixed Circular Navigation Menu
 * Plugin URI:        http://wordpress-fixed-circular-nav.e-crespo.com
 * Description:       This plugin adds a fancy customizable fixed circular navigation menu to your wordpress theme. This can be used as an auxiliar navigation or even as a main menu for your website.
 * Version:           1.1.1
 * Author:            Enrique Crespo Molera
 * Author URI:        http://www.e-crespo.com
 * Text Domain:       acn
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /admin/lang
 * WordPress-Plugin-Boilerplate: v2.6.1
 * 
 * Copyright 2014  Enrique Crespo Molera  (email : contact@e-crespo.com)
 *
 *  This program is free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License, version 2, as 
 *  published by the Free Software Foundation.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program; if not, write to the Free Software
 *  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/*----------------------------------------------------------------------------*
 * Public-Facing Functionality
 *----------------------------------------------------------------------------*/

//include the main public class file
require_once( plugin_dir_path( __FILE__ ) . 'public/class-circular-nav.php' );

/*
 * Register hooks that are fired when the plugin is activated or deactivated.
 */
register_activation_hook( __FILE__, array( 'Circular_Nav', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Circular_Nav', 'deactivate' ) );


add_action( 'plugins_loaded', array( 'Circular_Nav', 'get_instance' ) );

/*----------------------------------------------------------------------------*
 * Dashboard and Administrative Functionality
 *----------------------------------------------------------------------------*/

if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {

	//include the main admin class file
        require_once( plugin_dir_path( __FILE__ ) . 'admin/admin-page-class.php');

        $plugin_url = plugin_dir_url( __FILE__ );

        /**
         * configure admin option panel page
         */
        $config = array(    
          'menu'           => array('top' => 'circular_nav'),
          'page_title'     => __('Fixed Circular Navigation Menu Settings','acn'),
          'menu_title'     => __('Circular Nav','acn'),
          'capability'     => 'manage_options',         
          'option_group'   => 'circular_nav_options',      
          'id'             => 'circular_nav_admin_page',            
          'fields'         => array(),           
          'local_images'   => false,         
          'use_with_theme' => false,                                                
          'icon_url'       => $plugin_url . 'admin/images/menu_icon.png'  
        );  

        /**
         * instantiate admin option panel page
         */
        $options_panel = new BF_Admin_Circular_Nav($config);
        $options_panel->OpenTabs_container('');

        /**
         * Option tabs
         */
        $options_panel->TabsListing(array(
          'links' => array(
            'options_1' =>  __('Position','acn'),
            'options_2' =>  __('Color schemes','acn'),
            'options_3' =>  __('Menu-button','acn'),
            'options_4' =>  __('Font and icon colors','acn'),
            'options_5' =>  __('Font and icon/image sizes','acn'),
            'options_6' =>  __('Navigation Elements','acn'),
            'options_7' =>  __('Display','acn'),
            'options_8' =>  __('Go Pro version','acn'),
           )
        ));

        /**
         * Position Tab
         */
        $options_panel->OpenTab('options_1');

        $options_panel->Title(__("Position settings","apc"));
        $options_panel->addParagraph(__("Choose where you want the circular menu to be fixed","apc"));
        
        //Position radio field
        $options_panel->addImageRadio('position',
            array(
             'bottom'=> array(
                "label" => __("Bottom","apc"),
                "image" => $plugin_url . 'admin/images/bottom_position.png',
                "disabled" => 'no')),
            array(
                'name'=> __('Fixed at:','acn'),
                'std'=> array('bottom'))
        );
        
        $options_panel->addParagraph(__('only available in pro version:<br/><br/>
            <img src="'.$plugin_url.'admin/images/top_position.png" alt="top position" />&nbsp;&nbsp;&nbsp;
            <img src="'.$plugin_url.'admin/images/left_position.png" alt="left position" />&nbsp;&nbsp;&nbsp;
            <img src="'.$plugin_url.'admin/images/right_position.png" alt="right position" />','apc'));
        
        /**
         * End position Tab
         */   
        $options_panel->CloseTab();


        /**
         * Colors Tab
         */
        $options_panel->OpenTab('options_2');
        
        $options_panel->Title(__('Color settings','acn'));
        $options_panel->addParagraph(__("Configure color appearance. Choose from proposed color patterns or build your own at the bottom","apc"));
        
        //Color scheme radio field
        $options_panel->addImageRadio('color-scheme',
            array(
             'ggish'=> array(
                "label" => __('Grey-greenish','acn'),
                "image" => $plugin_url . 'admin/images/ggish.png'),
              'grey'=> array(
                "label" => __('Grey','acn'),
                "image" => $plugin_url . 'admin/images/grey.png'),
              'bluish'=> array(
                "label" => __('Blue','acn'),
                "image" => $plugin_url . 'admin/images/blue.png'),
              'aqua'=> array(
                "label" => __('Aqua','acn'),
                "image" => $plugin_url . 'admin/images/aqua.png'),
              'green'=> array(
                "label" => __('Green','acn'),
                "image" => $plugin_url . 'admin/images/green.png'),
              'yellow'=> array(
                "label" => __('Yellow','acn'),
                "image" => $plugin_url . 'admin/images/yellow.png'),
              'orange'=> array(
                "label" => __('Orange','acn'),
                "image" => $plugin_url . 'admin/images/orange.png'),
              'red'=> array(
                "label" => __('Red','acn'),
                "image" => $plugin_url . 'admin/images/red.png'),
              'violet'=> array(
                "label" => __('Violet','acn'),
                "image" => $plugin_url . 'admin/images/violet.png'),
              'brown'=> array(
                "label" => __('Brown','acn'),
                "image" => $plugin_url . 'admin/images/brown.png'),
              'black'=> array(
                "label" => __('Black','acn'),
                "image" => $plugin_url . 'admin/images/black.png'),
              'trans'=> array(
                "label" => __('Transparent','acn'),
                "image" => $plugin_url . 'admin/images/trans.png')),
            array(
                'name'=> __('Alternate (odd-even) color scheme for navigation elements','acn'),
                'desc' => __('<small>Pick a predefined color scheme or build your own (see below)</small>','acn'),
                'std'=> array('ggish'))
         );
        
        
       $options_panel->addParagraph(__('<strong>Build your own color scheme is only available in pro version:</strong><br/><br/>
            <img src="'.$plugin_url.'admin/images/owncolors.png" alt="own color scheme" />&nbsp;&nbsp;&nbsp;','apc'));
        
        /**
         * End menu button tab
         */ 
        $options_panel->CloseTab();



        /**
         * Menu button tab
         */
        $options_panel->OpenTab('options_3');
        
        $options_panel->Title(__('Menu button settings','acn'));
        $options_panel->addParagraph(__("Configure contents for the menu button","apc"));
        
        //Menu style radio field
        $options_panel->addImageRadio('menu-style',
            array(
              'text'=> array(
                "label" => __('Only text','acn'),
                "image" => $plugin_url . 'admin/images/text.png')),
            array(
                'name'=> __('Built-in proposed styles for the content inside the menu button','acn'),
                'desc' => __('<small>Pick one or choose custom icons or images (see below)</small>','acn'),
                'std'=> array('text'))
        );
        
         $options_panel->addParagraph(__('only available in pro version:<br/><br/>
            <img src="'.$plugin_url.'admin/images/text_symbol.png" alt="text and symbol" />&nbsp;&nbsp;&nbsp;
            <img src="'.$plugin_url.'admin/images/symbol.png" alt="symbol" />&nbsp;&nbsp;&nbsp;
            <img src="'.$plugin_url.'admin/images/icon.png" alt="icon" />','apc'));
         
         $options_panel->addParagraph(__('<strong><u>Custom text when menu is opened or closed is only available in pro version.</u></strong>','apc'));
         
         $options_panel->addParagraph(__('<strong><u>Custom icons or images when menu is opened or closed are only available in pro version.</u></strong><br/>
             <img src="'.$plugin_url.'admin/images/ownbutton1.png" alt="ownbutton1" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <img src="'.$plugin_url.'admin/images/ownbutton2.png" alt="ownbutton2" />','apc'));
        
        
        
        //Button background color picker
        $options_panel->addColor('btn-bg',array('name'=> __('Button color ','acn'), 'desc' => __('<small>Pick a color</small>','acn'), 'default'=> '#ED6A31', 'std'=>'#ED6A31'));
        
        //Button background color picker on Hover
        $options_panel->addColor('btn-bg-hover',array('name'=> __('Button color on Hover (mouse) ','acn'), 'desc' => __('<small>Pick a color when hovering mouse over menu-button. If you do not want this effect, simply chose same color as button main color above.</small>','acn'), 'default'=> '#edac74', 'std'=>'#edac74'));
        
        /**
         * Close 3rd tab
         */ 
        $options_panel->CloseTab();


        /**
         * Open admin page 4th tab
         */
        $options_panel->OpenTab('options_4');
        
        $options_panel->Title(__('Font and icon color settings','acn'));
        $options_panel->addParagraph(__("Choose colors for icons and texts, both in navigation elements and menu button","apc"));
        
        //Navigation elements color and size picker, for icons and texts
        $options_panel->addParagraph(__('<strong>Custom navigation icon color is only available in pro version.</strong><br/>
            Default color is white (#ffffff)
            <img src="'.$plugin_url.'admin/images/icon_color.png" alt="navigation icon color" />&nbsp;&nbsp;&nbsp;','apc'));
        $options_panel->addParagraph(__('<strong>Custom navigation text color is only available in pro version.</strong><br/>
            Default color is white (#ffffff)
            <img src="'.$plugin_url.'admin/images/text_color.png" alt="navigation text color" />&nbsp;&nbsp;&nbsp;','apc'));
        
        
        //Button elements color and size picker, both for icons and texts
        $options_panel->addParagraph(__('<strong>Custom menu button contents color is only available in pro version.</strong><br/>
            Default color is white (#ffffff)
            <img src="'.$plugin_url.'admin/images/btn_ctn_color.png" alt="button contents color" />&nbsp;&nbsp;&nbsp;','apc'));
        
        /**
         * Close 4th tab
         */
        $options_panel->CloseTab();
        
        
        /**
         * Open admin page 5th tab
         */
        $options_panel->OpenTab('options_5');
        
        $options_panel->Title(__('Font and icon/image sizes settings','acn'));
        $options_panel->addParagraph(__("Choose relative size for icons and texts, both in navigation elements and menu button ","apc"));
        $options_panel->addParagraph(__("<strong><u>Important considerations:</u></strong><br/>
            <ul>
            <li>-> Texts in navigation elements and menu button are using the main font family of your current theme.</li>
            <li>-> Normal text sizes usually fit well for most font families and 3-6 navigation elements (if you are going to use texts). Try different sizes if you are having trouble fitting long texts and/or you are using many navigation elments.</li>
            <li>-> Moreover, you can play around with different configurations that could end in very different display feelings. <br/>
                Maybe it is very useful to have huge icon size if you only have 3 navigations elements, but imaging you have long texts as well so you will perhaps need to set text size to very small</li>
            <li>-> Remember that these are base relative sizes and the plugin will calculate automatically responsive sizes for 3 screen widths (smartphones, tablets and laptops, large screens). So try to test in different devices to check if you are happy with the overall feeling and fitting.</li>   
            <li>-> If you do not want to play with this settings and everything is fitting quite well, simply leave defaults in normal size and forget about all these words ;)</li>
            </ul>","apc"));
        
        
        $options_panel->addSelect('nav-icon-size',array('20'=>__('Small','acn'),'24'=>__('Normal (default)','acn'),'28'=>__('Big','acn')),array('name'=> __('Icon size in navigation elements ','acn'),'desc' => __('<small>More sizes available in pro version</small>','acn'), 'std'=> array('24')));
        $options_panel->addSelect('nav-text-size',array('12'=>__('Small','acn'),'14'=>__('Normal (default)','acn'),'16'=>__('Big','acn')),array('name'=> __('Text size in navigation elements ','acn'),'desc' => __('<small>More sizes available in pro version</small>','acn'), 'std'=> array('14')));
  
        $options_panel->addSelect('btn-content-size',array('16'=>__('Small','acn'),'18'=>__('Normal (default)','acn'),'20'=>__('Big','acn')),array('name'=> __('Text/Icon size inside menu button ','acn'),'desc' => __('<small>More sizes available in pro version</small>','acn'), 'std'=> array('18')));
  
        
        /**
         * Close 5th tab
         */
        $options_panel->CloseTab();
        
        
        /**
         * Open admin page 6th tab
         */
        $options_panel->OpenTab('options_6');
        
        $options_panel->Title(__('Navigation elements settings','acn'));
        $options_panel->addParagraph(__("Set all navigation elements you want for the menu. Remember that <strong>there is a <u>maximum of 8 elements</u></strong> and of course at least there should be 2 elements","apc"));
        
        $options_panel->addParagraph(__('<strong>Custom uploaded icons or images for each navigation element are only available in pro version.</strong><br/>
            <img src="'.$plugin_url.'admin/images/customimagesnav.png" alt="own images in nav elements" />','apc'));
        
       
       // Fields for each navigation element
       // First get a list of font-awesome icons to generate an special radio field to choose from them
       
       $icons = $options_panel->getFontAwesomeIconList();
       array_unshift($icons , 'none'); 
       
       $nav_elements[] = $options_panel->addText('el-title', array('name'=> __('Item title attribute ','acn'),'desc' => __('<small>Hover tooltip in non-touching devices</small>','acn')),true);
       $nav_elements[] = $options_panel->addLargeRadioFa('el-icon',$icons,array('name'=> __('Icon','acn'),'desc' => __('<small>Choose \'none\' if you do not want an icon</small>','acn')),true);
       $nav_elements[] = $options_panel->addText('el-text', array('name'=> __('Text for link ','acn'),'desc' => __('<small>Blank if you do not want any text</small>','acn')),true);
       $nav_elements[] = $options_panel->addText('el-url', array('name'=> __('Link - URL address? ','acn'),'validate' => array('url' => array('param' => '','message' => __("must be a valid URL","apc")))),true);
       $nav_elements[] = $options_panel->addPosts('el-post',array('args' => array('post_type' => 'post')),array('name'=> __('or link to a Post?','acn')),true);
       $nav_elements[] = $options_panel->addPosts('el-page',array('args' => array('post_type' => 'page')),array('name'=> __('or link to a Page?','acn')),true);
       $nav_elements[] = $options_panel->addCheckbox('el-target',array('name'=> __('Open link in another tab','acn'), 'std' => false), true);
       
       //repeater block for navigation elements
       $options_panel->addRepeaterBlock('cn',array('sortable' => true, 'inline' => true, 'name' => __('Click + to add an element or click X to delete, click pencil-edit to open-close each element','acn'),'fields' => $nav_elements, 'desc' => __('Drag & Drop to sort the items as you need','acn')));

       
        /**
         * Close 6th tab
         */
        $options_panel->CloseTab();


        /**
         * Open admin page 7th tab
         */
        $options_panel->OpenTab('options_7');
        
        $options_panel->Title(__('Extra Display Settings','acn'));
        $options_panel->addParagraph(__("Choose when to display the menu ","apc"));
        
        $options_panel->addParagraph(__('<strong>Show the menu depending on screen size only available in pro version</strong><br/><br/>
            <img src="'.$plugin_url.'admin/images/all_screens.png" alt="all screen sizes" />&nbsp;&nbsp;&nbsp;
            <img src="'.$plugin_url.'admin/images/less768.png" alt="less than 768px" />&nbsp;&nbsp;&nbsp;
            <img src="'.$plugin_url.'admin/images/more768.png" alt="more than 768px" />','apc'));
        
                
        //Roles permission checkbox field
        $options_panel->addParagraph(__('<strong><u>Show the menu depending on selected user roles is only available in pro version.</u></strong>','apc'));
        
        /**
         * Close 7th tab
         */
        $options_panel->CloseTab();
        
        /**
         * Open admin page 8th tab
         */
        $options_panel->OpenTab('options_8');
        
        $options_panel->Title(__('Pro version','acn'));
        $options_panel->addParagraph(__("Upgrade to Pro premium version and get all the features and more to come in future updates","apc"));
        
        $options_panel->addParagraph(__('<strong>Visit us on:</strong><br/><br/>
            <a href="http://wordpress-fixed-circular-nav.e-crespo.com/" target="_blank">Wordpress Fixed Circular Navigation Menu official site</a>
           ','apc'));
        
        /**
         * Close 8th tab
         */
        $options_panel->CloseTab();
        
}