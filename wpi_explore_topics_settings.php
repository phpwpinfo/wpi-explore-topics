<?php
class wpiExploreTopicsSettings
{

    public function __construct()
    {
       add_action( 'admin_menu', array($this,'wpi_add_admin_menu_et') );
       add_action( 'admin_init', array($this,'wpi_settings_init_et' ));
    }

    /**
     * Add options page
     */

    function wpi_add_admin_menu_et(  ) { 

            add_options_page( 'Explore Topics', 'Explore Topics', 'manage_options', 'wpi_explore_topics', array($this,'wpi_et_options_page') );

    }
    
    function wpi_settings_init_et(  ) { 

            register_setting( 'wpi_et_pluginPage', 'wpi_explore_topics_settings' );

            add_settings_section(
                    'wpi_et_pluginPage_section', 
                    __( 'Add Settings', 'wpi_explore_topics' ), 
                    array($this,'wpi_settings_section_callback'), 
                    'wpi_et_pluginPage'
            );

            add_settings_field( 
                    'wpi_explore_topic_fields', 
                    __( '', 'wpi_explore_topics' ), 
                    array($this,'wpi_explore_topic_fields'), 
                    'wpi_et_pluginPage', 
                    'wpi_et_pluginPage_section' 
            );


    }


    function wpi_explore_topic_fields(  ) { 

            $options = get_option( 'wpi_explore_topics_settings' );
            
            ///Set up defaults
            if($options['placeholder_text']==NULL) $options['placeholder_text'] = "Filter, enter a word or just a few letters";
            if($options['label_text']==NULL) $options['label_text'] = "Explore a wide range of content";
            if($options['instruction_text']==NULL) $options['instruction_text'] = "Note: Please type atleast 3 characters for a valid search";
            if($options['plugin_custom_styles']==NULL)$options['plugin_custom_styles']=".holdleft {
                display: inline;
                float: left;
                margin: 0 20px 0 0;
                text-align: left;
                width: 290px;
            }
            .tagindex h4{
                background-color: #FF0000;
                color: #FFFFFF;
                margin: 2px 0 0;
                padding: 5px;
                text-align: center;
                width: 30px;

            }
            .tagindex {
                padding: 6px 0 10px;
                width: 290px;
            }
            .tagindex ul {
                list-style: none outside none;
                margin: 0;
                padding: 1px 0;
            }
            .tagindex .links {
                border-top: 1px solid #FF9999;
            }
            .wpi_explore_topics_form{
                background-color: #EEEEEE;
                  border: 1px dotted #CCCCCC;
                  padding: 10px;
            }
            #wpi_input_topic{
                font-size:1.5em;width:60%;padding:5px 0 5px 34px;background-size: 30px 30px;background-position: 5px center;border-radius: 10px
            }
            .wpi-explore-widget{margin:20px 0 20px 0}";
            ///////
            
            echo "<table><tr><th>Setting</th><th>Value</th></tr>";

            echo "<tr>";
            echo "<td><label for='label_text'><strong>Input Field Label Text</strong></label></td>";
            echo "<td><input type='text' id='label_text' name='wpi_explore_topics_settings[label_text]' size='50' value='".esc_attr($options['label_text'])."'></td>";
            echo "</tr>";
            
            echo "<tr>";
            echo "<td><label for='placeholder_text'><strong>Input Field Placeholder Text</strong></label></td>";
            echo "<td><input type='text' id='placeholder_text' name='wpi_explore_topics_settings[placeholder_text]' size='50' value='".esc_attr($options['placeholder_text'])."'></td>";
            echo "</tr>";
            
            echo "<tr>";
            echo "<td><label for='instruction_text'><strong>Input Field Instructions Text</strong></label></td>";
            echo "<td><input type='text' id='instruction_text' name='wpi_explore_topics_settings[instruction_text]' size='50' value='".esc_attr($options['instruction_text'])."'></td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td><label for='plugin_custom_styles'><strong>Plugin custom styles</strong></label></td>";
            echo "<td><textarea id='plugin_custom_styles' name='wpi_explore_topics_settings[plugin_custom_styles]' rows='10' cols='40' value=''>".esc_attr($options['plugin_custom_styles'])."</textarea></td>";
            echo "</tr>";

            
            echo "</table>";

    }
    
    
    function wpi_settings_section_callback(  ) { 

	echo __( 'Add your settings below for the Explore Topics plugin', 'wpi_explore_topics' );

    }


    function wpi_et_options_page(  ) { 

            ?>
            <form action='options.php' method='post'>

                    <h2>Explore Topics plugin settings</h2>

                    <?php
                    settings_fields( 'wpi_et_pluginPage' );
                    do_settings_sections( 'wpi_et_pluginPage' );
                    submit_button();
                    ?>

            </form>
            <?php

    }
}
if( is_admin() )
   new wpiExploreTopicsSettings();

