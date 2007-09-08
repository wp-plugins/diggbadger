<?php
	/*
	Plugin Name: DiggBadger
	Plugin URI: http://www.kennycarlile.com/DiggBadger/
	Description: This Wordpress 2.x plugin provides a clean Digg badge/button for your pages and posts. 
	Version: 1.0
	Author: Kenny Carlile
	Author URI: http://www.kennycarlile.com
	
	--------------------------------------------------------------------------------
	
	DiggBadger
	Copyright (C) 2007  Kenny Carlile

	This program is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program.  If not, see <http://www.gnu.org/licenses/>.
	
	--------------------------------------------------------------------------------
	
	References:
		- http://www.digg.com/tools/integrate
	
	--------------------------------------------------------------------------------
		
	Install:
		1. Upload DiggBadger.php to ~/wp_contents/plugins/
		2. Activate DiggBadger plugin
	
	--------------------------------------------------------------------------------
	
	Usage:
		1. Edit your theme and add <?php getDiggBadger(); ?> immediately before or after
			the line with the_content() in the Main Index Template, Single Post, Page Template,
			Archives, and/or any other places you wish to have the DiggBadger appear.
		2. Optionally, you can add the following class to your Stylesheet to style the
			appearance of the DiggBadger. A default style has been provided, however the class
			must be named .diggBadger for it to apply to DiggBadger.
			
			.diggBadger
			{
			    float: right;
			    margin-bottom: 4px;
			    margin-left: 4px;
			}
			
		3. Save the modified theme files.
		
	Required Parameters:
		none
	
	Optional Parameters:
		defaultTopic
			Default: ''
			Specify the default topic for your posts. Valid strings can be found here: http://www.digg.com/tools/integrate#topics
		
		--------------------------------------------------------------------------------
	*/

	function getDiggBadger($defaultTopic = '')
	{
	?>
		<div class="diggBadger">
		    <script type="text/javascript">
		        digg_url = '<?php the_permalink(); ?>';
		        digg_title = '<?php the_title(); ?>';
		        
	        <?php
	        	if($defaultTopic != '')
	        	{
	        ?>
	        		digg_topic = '<?php echo $defaultTopic; ?>';
	        <?php
	        	} // end if test
		
		        /*
		        Use the output buffer to capture the text
		        output from the_ID() rather than having
		        it rendered to the page.
		        */
			?>
		
		        digg_bodytext = '<?php
		            ob_start();
		            the_ID();
		            $postID = ob_get_contents();
		            ob_end_clean();
		            
		            /*
		            Get the body of the post, remove HTML,
		            remove carriage returns and line feeds,
		            escape 's, return only the first 350 char.
		            '''
		            */
		            
		            $postObj = get_post($postID, OBJECT);
		            $body = strip_tags($postObj->post_content);
		            $body = str_replace(chr(10), '', $body);
		            $body = str_replace(chr(13), '', $body);
		            $body = addslashes($body);
		            echo substr($body, 0, 350);
		        ?>';
		    </script>
		    <script src="http://digg.com/tools/diggthis.js"
		        type="text/javascript"></script>
		</div>
	<?php
	} // end getDiggBadger function
	
	// equivalent to hello world for testing to see if the plugin is working
	function testDiggBadger()
	{
		echo 'TESTING';	
	} // end testDiggBadger function
?>