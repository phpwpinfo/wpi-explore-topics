<?php
/*
Plugin Name: WPI Explore Topics
Description: Show all tags in alphabetical order and search as you type filter for a topic/tag
Version: 1.0
Tested up to: WPMU 4.4.2
License: GNU General Public License 2.0 (GPL) http://www.gnu.org/licenses/gpl.html
Author: WPIndex
Author URI: http://phpwpinfo.com
Plugin URI:
tags:tags,search tags, search topic, filter topics, filter tags, 
*/

include(plugin_dir_path( __FILE__ )."/wpi_explore_topics.php");
include(plugin_dir_path( __FILE__ )."/wpi_explore_topics_settings.php");

$wpi_explore_topics=new wpiExploreTopics();
