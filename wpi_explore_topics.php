<?php

class wpiExploreTopics {

    public function __construct() {
        add_shortcode('WPI_EXPLORE_TOPICS', array($this, 'wpi_explore_topics'));
        $wpi_explore_topics_options = get_option( 'wpi_explore_topics_settings' );
        $this->plugin_custom_styles=esc_attr($wpi_explore_topics_options['plugin_custom_styles']);
        $this->label_text=esc_attr($wpi_explore_topics_options['label_text']);
        $this->instruction_text=esc_attr($wpi_explore_topics_options['instruction_text']);
        $this->placeholder_text=esc_attr($wpi_explore_topics_options['placeholder_text']);
    }

    function wpi_explore_topics() {
        ///Set up defaults
        if($this->placeholder_text==NULL) $this->placeholder_text = "Filter, enter a word or just a few letters";
        if($this->label_text==NULL) $this->label_text = "Explore a wide range of content";
        if($this->instruction_text==NULL) $this->instruction_text = "Note: Please type atleast 3 characters for a valid search
";
        if($this->plugin_custom_styles==NULL) $this->plugin_custom_styles = ".holdleft {
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
            .wpi-explore-widget{margin:20px 0 20px 0}
";
        ///////
        
        echo "<style>".$this->plugin_custom_styles;
        echo "#wpi_input_topic{
            background-image:url('".plugin_dir_url( __FILE__ )."images/filter.png'); 
            background-repeat: no-repeat; }";
        
        echo "</style>";
        ?>


        <div class="wpi-explore-widget">
            <form method="post" action="/topics" class="wpi_explore_topics_form">
                <label for="wpi_input_topic"> <?php echo __($this->label_text,'wpi_explore_topics'); ?></label>
                <p><input id="wpi_input_topic" name="wpi_tag" placeholder="<?php echo __($this->placeholder_text,'wpi_explore_topics'); ?>"  onkeyup="wpi_et_lookup(this.value);"  /></p>
                <small><?php echo __($this->instruction_text,'wpi_explore_topics'); ?></small>
            </form>
        </div>
        <script>
            jQuery(document).ready(function() {
                jQuery.post("<?php echo plugin_dir_url( __FILE__ ) ?>js/tags.php",  function(data) {
                    if (data.length > 0) {
                        jQuery('#wpi_topic_suggestions').html(data);
                    }
                });

            });
            function wpi_et_lookup(tags) {
                if (tags.length > 2) {
                    jQuery('#wpi_topic_suggestions').empty();
                    jQuery.post("<?php echo plugin_dir_url( __FILE__ ) ?>js/tags.php", {queryString: "" + tags + ""}, function(data) {
                        if (data.length > 0) {
                            jQuery('#wpi_topic_suggestions').html(data);
                        }
                    });
                }
                else if(tags.length == 0){
                    jQuery.post("<?php echo plugin_dir_url( __FILE__ ) ?>js/tags.php",  function(data) {
                    if (data.length > 0) {
                        jQuery('#wpi_topic_suggestions').html(data);
                    }
                });
                }
            } // lookup	
        </script>
        <div id='wpi_topic_suggestions'></div>
        <?php
    }

}
?>
