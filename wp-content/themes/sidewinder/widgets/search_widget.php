<?php

class SearchWidget extends WP_Widget {
    function SearchWidget() {
        parent::WP_Widget(false, $name = 'Sidewinder Search');	
    }

    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        ?>
              <?php echo $before_widget; ?>
                  
					<form action="" method="post" id="searchform" class="search">
					    <fieldset>					    	
					    	<p> <input type="text" name="s" id="s" value="<?php if ( $title ) echo $title; ?>" /> <input type="submit" class="button" value="Search" /> </p>
					    </fieldset>
					</form>
              <?php echo $after_widget; ?>
        <?php
    }

    function update($new_instance, $old_instance) {				
		$instance = $old_instance;
		$instance['title'] 		= strip_tags($new_instance['title']);		
        return $instance;
    }

    function form($instance) {				
        $title = esc_attr($instance['title']);        
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
                       
        <?php 
    }

} 

?>