<div class="operation-theme-steps-list">
<div class="left-box-wrapper-outer">
<div class="op-box-wrapper operation-welcome-box-white">
	<div class="op-box-header"><?php esc_html_e('Links to Customizer Settings','ultra-seven'); ?></div>
	<div class="op-box-content">
		<ul class="op-list clearfix">
			<?php
			 $url = admin_url( 'customize.php' );

	        $links = array(
	            array(
	                'label' => __( 'Logo & Site Identity', 'ultra-seven' ),
	                'url' 	=> add_query_arg( array( 'autofocus' => array( 'section' => 'title_tagline' ) ), $url ),
	                'icon' 	=> 'dashicons dashicons-format-image',
	            ),
	            array(
	                'label' => __( 'Header Layouts', 'ultra-seven' ),
	                'url' 	=> add_query_arg( array( 'autofocus' => array( 'section' => 'ultra_seven_header_layouts_section' ) ), $url ),
	                'icon' 	=> 'dashicons dashicons-align-center',
	            ),
	            array(
	                'label' => __( 'Additional Settings', 'ultra-seven' ),
	                'url' 	=> add_query_arg( array( 'autofocus' => array( 'section' => 'ultra_seven_additional_section' ) ), $url ),
	                'icon' 	=> 'dashicons dashicons-layout',
	            ),
	            array(
	                'label' => __( 'Website Layout', 'ultra-seven' ),
	                'url' 	=> add_query_arg( array( 'autofocus' => array( 'section' => 'ultra_seven_webpage_section' ) ), $url ),
	                'icon' 	=> 'dashicons dashicons-admin-customizer',
	            ),
	            array(
	                'label' => __( 'Colors Settings', 'ultra-seven' ),
	                'url' 	=> add_query_arg( array( 'autofocus' => array( 'section' => 'colors' ) ), $url ),
	                'icon' 	=> 'dashicons dashicons-admin-generic',
	            ),
	            array(
	                'label' => __( 'Archive Page Settings', 'ultra-seven' ),
	                'url' 	=> add_query_arg( array( 'autofocus' => array( 'section' => 'ultra_seven_archive_section' ) ), $url ),
	                'icon' 	=> 'dashicons dashicons-welcome-write-blog',
	            ),
	            array(
	                'label' => __( 'Social Icons', 'ultra-seven' ),
	                'url' 	=> add_query_arg( array( 'autofocus' => array( 'section' => 'ultra_seven_social_section' ) ), $url ),
	                'icon' 	=> 'dashicons dashicons-share',
	            ),
	            array(
	                'label' => __( 'Footer Settings', 'ultra-seven' ),
	                'url' 	=> add_query_arg( array( 'autofocus' => array( 'section' => 'ultra_seven_footer_section' ) ), $url ),
	                'icon' 	=> 'dashicons dashicons-admin-generic',
	            ),
	           
	        );

	        $links = apply_filters( 'ultra_seven/dashboard/links', $links );
	        ?> 

			<?php foreach( $links as $l ) { ?>
                <li>
                	<span class="<?php echo esc_attr($l['icon'])?>"></span>
                    <a class="op-quick-setting-link" href="<?php echo esc_url( $l['url'] ); ?>" target="_blank"><?php echo esc_html( $l['label'] ); ?></a>
                </li>
            <?php } ?>
		</ul>
	</div>
</div>

<div class="op-box-wrapper operation-welcome-box-white">
	<div class="op-box-header"><?php esc_html_e('Welcome','ultra-seven'); ?></div>
	<div class="box-content">
		<p><?php esc_html_e('Welcome and thank you for choosing Ultra Seven. Please install and activate all recommended plugins.','ultra-seven'); ?></p>
	</div>
</div>	
</div>


<?php $this->admin_sidebar_contents(); ?>

</div>