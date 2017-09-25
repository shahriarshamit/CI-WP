<?php
class Kodeo_Admin_UI_Options {
    public $slugs;
    private $sections = false;
    private $options = false;

    public function __construct() {
        // Refer to «Pages» class
        $this->slugs = array(1=>'kodeo-admin-ui-options-general', 'kodeo-admin-ui-options-customization');
        $this->sections = array(
            /** Options Tab **/
            /* Sidebar Menu */
            'kodeo-admin-ui-sidebar' => array(
				'title' => _x( 'Sidebar Menu Settings', 'Option section name', 'kodeo-admin-ui' ),
				'page' => $this->slugs[1],
				'options' => array(
                    'auto-collapse-submenus',
                    'show-menu-separators',
                    'show-menu-icons',
                    'show-menu-counters',
				)
			),
            /* Toolbar Settings */
            'kodeo-admin-ui-toolbar' => array(
				'title' => _x( 'Toolbar Settings', 'Option section name', 'kodeo-admin-ui' ),
				'page' => $this->slugs[1],
				'options' => array(
                    'fixed-admin-toolbar',
                    'show-search-in-toolbar',
					'show-toolbar-notifications',
                    'show-additional-editor-toolbar',
                    'show-help-screen-options-modal',
				)
			),
            /* Other Settings */
            'kodeo-admin-ui-other-settings' => array(
				'title' => _x( 'Other Settings', 'Option section name', 'kodeo-admin-ui' ),
				'page' => $this->slugs[1],
				'options' => array(
                    'dashboard-cols-limit',
                    'widget-cols-limit',
                    'deactivate-postboxes-sortable',
                    'frontend-mini-toolbar',
                    'editor-past-plaintext',
				)
			),
            /** Customization **/
            /* Customization */
            'kodeo-admin-ui-customization' => array(
				'title' => null,
				'page' => $this->slugs[2],
				'options' => array(
					'custom-css',
					'custom-login-css',
					'custom-login-logo',
				)
			),
        );

        $default_option_args = array(
			'secondary-title' => '',
			'type' => 'text',
			'description' => '',
			'options' => array(),
			'disabled-for' => array(),
			'default' => null
		);

        $options = array(
            /* Sidebar Menu */
            'auto-collapse-submenus' => array(
                'title' => _x( 'Auto Collapse Submenus', 'Option Title', 'kodeo-admin-ui' ),
                'type' => 'checkbox',
                'secondary-title' => _x( 'Enable', 'Option Value', 'kodeo-admin-ui' ),
                'description' => __( 'By Theme default submenus are expanded on click. Activate this option if you prefer auto collapse submenus.', 'kodeo-admin-ui' ),
                'default' => false,
                'slug' => $this->slugs[1],
            ),
            'show-menu-icons' => array(
                'title' => _x( 'Menu Icons', 'Option Title', 'kodeo-admin-ui' ),
                'type' => 'checkbox',
                'secondary-title' => _x( 'Show', 'Option Value', 'kodeo-admin-ui' ),
                'description' => __( 'Menu Icons are hidden by default. Activate this option if you want display them.', 'kodeo-admin-ui' ),
                'default' => false,
                'slug' => $this->slugs[1],
            ),
            'show-menu-counters' => array(
                'title' => _x( 'Item Counters', 'Option Title', 'kodeo-admin-ui' ),
                'type' => 'checkbox',
                'secondary-title' => _x( 'Show', 'Option Value', 'kodeo-admin-ui' ),
                'description' => __( 'Item Counters are displayed by default. Deactivate this option if you want hide them.', 'kodeo-admin-ui' ),
                'default' => true,
                'slug' => $this->slugs[1],
            ),
            'show-menu-separators' => array(
                'title' => _x( 'Menu Separators', 'Option Title', 'kodeo-admin-ui' ),
                'type' => 'checkbox',
                'secondary-title' => _x( 'Show', 'Option Value', 'kodeo-admin-ui' ),
                'description' => __( 'Menu Separators are displayed by default. Deactivate this option if you want hide them.', 'kodeo-admin-ui' ),
                'default' => true,
                'slug' => $this->slugs[1],
            ),
            /* Toolbar Settings */
            'fixed-admin-toolbar' => array(
                'title' => _x( 'Fixed Admin Toolbar', 'Option Title', 'kodeo-admin-ui' ),
                'type' => 'checkbox',
                'secondary-title' => _x( 'Enable', 'Option Value', 'kodeo-admin-ui' ),
				'description' => __( 'Activate this option if you want the toolbar stay fixed on top.', 'kodeo-admin-ui' ),
                'default' => false,
                'slug' => $this->slugs[1],
            ),
            'show-search-in-toolbar' => array(
                'title' => _x( 'Search Field in Toolbar', 'Option Title', 'kodeo-admin-ui' ),
                'type' => 'checkbox',
                'secondary-title' => _x( 'Enable', 'Option Value', 'kodeo-admin-ui' ),
				'description' => __( 'For cleaner body content the search field is relocated into the toolbar. Deactivate this option if you want to show it in the body content again.', 'kodeo-admin-ui' ),
                'default' => true,
                'slug' => $this->slugs[1],
            ),
            'show-toolbar-notifications' => array(
                'title' => _x( 'Notifications in Toolbar', 'Option Title', 'kodeo-admin-ui' ),
                'type' => 'checkbox',
                'secondary-title' => _x( 'Enable', 'Option Value', 'kodeo-admin-ui' ),
				'description' => __( 'For cleaner body content notifications are located into a toolbar dropdown. Deactivate this option if you want to show them in the body content again.', 'kodeo-admin-ui' ),
                'default' => true,
                'slug' => $this->slugs[1],
            ),
            'show-additional-editor-toolbar' => array(
                'title' => _x( 'Sticky Editor Toolbar', 'Option Title', 'kodeo-admin-ui' ),
                'type' => 'checkbox',
                'secondary-title' => _x( 'Enable', 'Option Value', 'kodeo-admin-ui' ),
				'description' => __( 'Activate this option if you want to have sticky action buttons on top of the Edit page,', 'kodeo-admin-ui' ),
                'default' => false,
                'slug' => $this->slugs[1],
            ),
            'show-help-screen-options-modal' => array(
                'title' => _x( 'Help and Screen Options as Modal', 'Option Title', 'kodeo-admin-ui' ),
                'type' => 'checkbox',
                'secondary-title' => _x( 'Enable', 'Option Value', 'kodeo-admin-ui' ),
				'description' => __( 'Depending on your screen size it might be better to display the screen options and help content within a modal.', 'kodeo-admin-ui' ),
                'default' => false,
                'slug' => $this->slugs[1],
            ),
            /* Other Settings */
            'dashboard-cols-limit' => array(
                'title' => _x( 'Reduce columns on Dashboard', 'Option Title', 'kodeo-admin-ui' ),
                'type' => 'checkbox',
                'secondary-title' => _x( 'Enable', 'Option Value', 'kodeo-admin-ui' ),
                'description' => __( 'Depending on your Dashboard Widgets it might be useful to have less columns. This option limits the Dashboard columns from 4 to 2 for screen sizes with min. 1500px.', 'kodeo-admin-ui' ),
                'default' => false,
                'slug' => $this->slugs[1],
            ),
            'widget-cols-limit' => array(
                'title' => _x( 'Reduce columns on Widget Page', 'Option Title', 'kodeo-admin-ui' ),
                'type' => 'checkbox',
                'secondary-title' => _x( 'Enable', 'Option Value', 'kodeo-admin-ui' ),
                'description' => __( 'For better usability on Notebook and Tablet screens it is useful to reduce the Widget Holder columns from 2 to 1. This option affects screen sizes between 1250px and 1680px.', 'kodeo-admin-ui' ),
                'default' => false,
                'slug' => $this->slugs[1],
            ),
            'deactivate-postboxes-sortable' => array(
                'title' => _x( 'Drag-And-Drop Sorting of Postboxes', 'Option Title', 'kodeo-admin-ui' ),
                'type' => 'checkbox',
                'secondary-title' => _x( 'Disable', 'Option Value', 'kodeo-admin-ui' ),
				'description' => __( 'By WordPress default postboxes can be reordered by drag and drop. Activate this option in order to disable this behaviour.', 'kodeo-admin-ui' ),
                'default' => false,
                'slug' => $this->slugs[1],
            ),
            'frontend-mini-toolbar' => array(
                'title' => _x( 'Use Mini Toolbar on the Front End', 'Option Title', 'kodeo-admin-ui' ),
                'type' => 'checkbox',
                'secondary-title' => _x( 'Enable', 'Option Value', 'kodeo-admin-ui' ),
                'description' => __( 'Activate this option if you prefer a mini sized toolbar at the front end.', 'kodeo-admin-ui' ),
                'default' => false,
                'slug' => $this->slugs[1],
            ),
            'editor-past-plaintext' => array(
                'title' => _x( 'Visual editor paste everything as plain text', 'Option Title', 'kodeo-admin-ui' ),
                'type' => 'checkbox',
                'secondary-title' => _x( 'Enable', 'Option Value', 'kodeo-admin-ui' ),
                'description' => __( 'This option forces the visual editor to paste everything as plain text', 'kodeo-admin-ui' ),
                'default' => false,
                'slug' => $this->slugs[1],
            ),
            /* Customization */
            'enable-admin-theme' => array(
                'title' => _x( 'Admin Theme', 'Option Title', 'kodeo-admin-ui' ),
            	'type' => 'checkbox',
                'secondary-title' => _x( 'Enable', 'Option Value', 'kodeo-admin-ui' ),
                'description' => '',
                'default' => true,
                'slug' => $this->slugs[2],
            ),
            'color-scheme' => array(
                'title' => _x( ' -> Color Scheme -Select list-', 'Option Title', 'kodeo-admin-ui' ) .' (neu)',
                'type' => 'checkbox',
                'secondary-title' => _x( 'Dropdown', 'Option Value', 'kodeo-admin-ui' ),
                'description' => '',
                'default' => true,
                'slug' => $this->slugs[2],
            ),
            'custom-css' => array(
                'title' => _x( 'Admin CSS', 'Option Title', 'kodeo-admin-ui' ),
                'type' => 'textarea',
                'slug' => $this->slugs[2],
            ),
            'custom-login-css' => array(
                'title' => _x( 'Login CSS', 'Option Title', 'kodeo-admin-ui' ),
                'type' => 'textarea',
                'slug' => $this->slugs[2],
            ),
            'custom-login-logo' => array(
                'title' => _x( 'Login Logo', 'Option Title', 'kodeo-admin-ui' ),
                'type' => 'image',
                'slug' => $this->slugs[2],
            ),
        );

        foreach($options as $key => $value) {
            $this->options[$key] = array_merge($default_option_args, $value);
            $this->options[$key]['name'] = $key;
        }
    }

    function get_option( $option_slug ) {
        if ( !isset( $this->options[$option_slug] ) )
            return null;
        else
			return $this->options[$option_slug];
	}

    function get_sections() {
        return $this->sections;
    }

    // Cached Options
    private $saved_options = array();
    // Return saved options from cache or the database
	function get_saved_options() {
		if(empty( $this->saved_options )) {
			// Load all defaults to name => value array
			$default_options = array();
			foreach ( $this->options as $key => $option ) {
				$default_options[ $option['name'] ] = $option['default'];
			}

			// Get saved options from the database
            $saved_options = array();
            foreach($this->slugs as $slug) {
                $result = get_option( $slug, array() );
                $saved_options += is_array($result) ? $result : array();
            }

			// Merge defaults with saved options & save to cache
			$saved_options = array_replace_recursive( $default_options, $saved_options );

			$this->saved_options = $saved_options;
		}

		return $this->saved_options;
	}

    function get_saved_option( $option_slug = '' ) {
		$option_info = $this->get_option( $option_slug );

		// Incompatible arguments
		if ( ! $option_slug || is_null( $option_info ) ) return null;

		// Prepare saved options
		$options = $this->get_saved_options();

		return $options[ $option_slug ];
	}

    // Validation before saving
	function callback_option_validation( $options ) {

        $page = $options['options-page-identification'];

		foreach ( $this->sections as $section ) {
			foreach ( $section['options'] as $option_slug) {
				// Skip this field if it isn't a checkbox
				$original_option = $this->get_option( $option_slug );
				if ( $original_option['type'] !== 'checkbox' ) continue;

                // Skip if this field is from another page
                if ( $original_option['slug'] !== $page ) continue;

				if ( !isset( $options[ $original_option['name'] ] ) ) {
					$options[ $original_option['name'] ] = 0;
				}
			}
		}

		return $options;
    }

    function action_register_settings() {
        foreach($this->slugs as $slug) {
            register_setting($slug, $slug, array($this, 'callback_option_validation'));
        }

		// Sections
		foreach ($this->sections as $section_slug => $options_section) {
			// Register the section
			add_settings_section(
				$section_slug,
				$options_section['title'],
                false,
				$options_section['page']
			);

			// Register the section's option fields
			foreach ( $options_section['options'] as $option_slug ) {
				$option = $this->get_option( $option_slug );
                // If option does not exist null is returned
				if ( is_null( $option ) ) continue;

                // Arguments required for HTML output
				$args = array(
					'field' => $option
				);

				// Register the field
				add_settings_field(
					$option['name'],
					$option['title'],
					array($this, 'display_form_field'),
					$options_section['page'],
					$section_slug,
					$args
				);
			}
		}
	}

    // Print an option field
    function display_form_field( $args = array() ) {
		// Invalid arguments
		if ( ! isset( $args['field'] ) || ! $args['field'] ) return false;

		// Prepare data to pass to the field
		$field = $args['field'];
        $value = $this->get_saved_option( $field['name'] );
		$name = $field['slug'] . '[' . $field['name'] . ']';

		// Print the input field of the correct type
		call_user_func( array($this, 'display_form_field_type_' . $field['type']), $field, $value, $name );

		if( !empty($field['description']) ) echo '<p class="description">' . $field['description'] . '</p>';

	}

	// Print a text field for options pages
	function display_form_field_type_text( $field, $value, $name ) {
		?>
		<input id="<?php echo 'kodeo-admin-ui-formfield-' . $field['name']; ?>" type="text" class="widefat" name="<?php echo esc_attr( $name ); ?>" value="<?php echo $value; ?>">
		<?php
	}

	// Print a number input field for options pages
	function display_form_field_type_number( $field, $value, $name ) {
		?>
		<input id="<?php echo 'kodeo-admin-ui-formfield-' . $field['name']; ?>" type="number" step="1" min="1" max="999" name="<?php echo esc_attr( $name ); ?>" value="<?php echo $value; ?>">
		<?php
	}

	// Print a textarea field for options pages
	function display_form_field_type_textarea( $field, $value, $name ) {
		?>
		<textarea id="<?php echo 'kodeo-admin-ui-formfield-' . $field['name']; ?>" class="widefat" rows="8" name="<?php echo esc_attr( $name ); ?>"><?php echo $value; ?></textarea>
		<?php
	}

	// Print a code-friendly textarea field for options pages
	function display_form_field_type_code( $field, $value, $name ) {
		?>
		<textarea id="<?php echo 'kodeo-admin-ui-formfield-' . $field['name']; ?>" class="widefat kodeo-textarea-code" rows="8" name="<?php echo esc_attr( $name ); ?>" <?php if ( isset( $field['placeholder'] ) && $field['placeholder'] ) { ?>placeholder="<?=esc_attr($field['placeholder']);?>"<?php } ?>><?php echo $value; ?></textarea>
		<?php
	}

	// Print a checkbox field for options pages
	function display_form_field_type_checkbox( $field, $value, $name ) {
		?>
		<fieldset>
			<label for="<?=esc_attr( 'kodeo-admin-ui-formfield-' . $field['name'] )?>">
				<input id="<?=esc_attr( 'kodeo-admin-ui-formfield-' . $field['name'] )?>" type="checkbox" name="<?=esc_attr( $name )?>" value="1" <?php checked( $value ); ?>>
				<?php if ( $field['secondary-title'] ) { ?>
					<?php echo $field['secondary-title']; ?>
				<?php } ?>
			</label>
		</fieldset>
        <?php
	}

	// Print a radio field for options pages
	function display_form_field_type_radio( $field, $value, $name ) {
		?>
		<fieldset>
			<?php foreach ( $field['options'] as $option_value => $option_title ) { ?>
				<label for="<?php echo esc_attr( 'kodeo-admin-ui-formfield-' . $field['name'] . '-' . $option_value ); ?>">
					<input id="<?php echo esc_attr( 'kodeo-admin-ui-formfield-' . $field['name'] . '-' . $option_value ); ?>" type="radio" name="<?php echo esc_attr( $name ); ?>" value="<?php echo $option_value; ?>" <?php checked( $option_value, $value ); ?>>
					<?php echo $option_title; ?>
				</label><br>
			<?php } ?>
		</fieldset>
		<?php
	}

	// Print an image selection field tied to the media manager
	function display_form_field_type_image( $field, $value, $name ) {
		?>

		<div class="kodeo-form-image-preview" id="kodeo-admin-ui-formfield-<?=$field['name']?>-preview">
            <?php
            if($value) {
                echo wp_get_attachment_image($value, 'thumbnail');
            } else {
                echo '<img src="" alt="">';
            }
            ?>
        </div>

		<input class="kodeo-form-image-input" id="kodeo-admin-ui-formfield-<?=$field['name']?>" type="hidden" name="<?php echo esc_attr( $name ); ?>" value="<?php echo $value; ?>">
		<a href="#" class="button kodeo-media-select-button" id="kodeo-admin-ui-formfield-<?=$field['name']?>-upload-button"><?php _e( 'Select image', 'kodeo-admin-ui' ); ?></a>
		<a class="kodeo-media-delete-button" id="kodeo-admin-ui-formfield-<?=$field['name']?>-delete-button"><?php _e( 'Remove featured image', 'kodeo-admin-ui' ); ?></a>
		<script>
		(function($) {
            /* Select an image from the gallery */
			$('#kodeo-admin-ui-formfield-<?=$field['name']?>-upload-button').click(function() {
                if(typeof wp.media.frames.gk_frame !== "undefined") {
                    wp.media.frames.gk_frame.open();
                } else {
                    wp.media.frames.gk_frame = wp.media({
                        title: '<?php _e( "Select image", "kodeo-admin-ui" ); ?>',
                        multiple: false,
                        library: { type: 'image' },
                        button: { text: '<?php _e( "Select image", "kodeo-admin-ui" ); ?>' } }
                    );

                    // Function used for the image selection and media manager closing
                    wp.media.frames.gk_frame.on('select', function() {
                        var selection = wp.media.frames.gk_frame.state().get('selection');
                        if (typeof selection === "object") {
                            selection.each(function(attachment) {
                                $('#kodeo-admin-ui-formfield-<?=$field['name']?>').val(attachment.attributes.id);
                                var url;
                                try {
                                    url = attachment.attributes.sizes.thumbnail.url;
                                } catch(e) {
                                    url = attachment.attributes.url;
                                }
                                $('#kodeo-admin-ui-formfield-<?=$field['name']?>-preview > img').attr('src', url).attr('srcset', null);
                                return;
                            });
                        }
                    });

                    wp.media.frames.gk_frame.open();
                }
			});
			/* Handle media deletion */
			$('#kodeo-admin-ui-formfield-<?=$field['name']?>-delete-button').click(function() {
				$('#kodeo-admin-ui-formfield-<?=$field['name']?>').val(null);
				$('#kodeo-admin-ui-formfield-<?=$field['name']?>-preview > img').attr('src', null).attr('srcset', null);
			});
		})( jQuery );
		</script>
		<?php
	}
}
