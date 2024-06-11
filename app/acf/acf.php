<?php 

add_action( 'acf/include_fields', function() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
	'key' => 'group_665ceda5a06fb',
	'title' => 'Modules',
	'fields' => array(
		array(
			'key' => 'field_665ceda6e6584',
			'label' => 'Modules',
			'name' => 'modules',
			'aria-label' => '',
			'type' => 'flexible_content',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layouts' => array(
				'layout_665ceddca30d0' => array(
					'key' => 'layout_665ceddca30d0',
					'name' => 'Text_Block',
					'label' => 'Text Block',
					'display' => 'block',
					'sub_fields' => array(
						array(
							'key' => 'field_665cee06e6586',
							'label' => 'Text Block',
							'name' => 'text_block',
							'aria-label' => '',
							'type' => 'textarea',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'maxlength' => '',
							'rows' => '',
							'placeholder' => '',
							'new_lines' => '',
						),
					),
					'min' => '',
					'max' => '',
				),
				'layout_665cee29e6587' => array(
					'key' => 'layout_665cee29e6587',
					'name' => 'Image_Block',
					'label' => 'Image Block',
					'display' => 'block',
					'sub_fields' => array(
						array(
							'key' => 'field_665cee3ce6589',
							'label' => 'Image Block',
							'name' => 'image_block',
							'aria-label' => '',
							'type' => 'image',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'return_format' => 'array',
							'library' => 'all',
							'min_width' => '',
							'min_height' => '',
							'min_size' => '',
							'max_width' => '',
							'max_height' => '',
							'max_size' => '',
							'mime_types' => '',
							'preview_size' => 'medium',
						),
					),
					'min' => '',
					'max' => '',
				),
				'layout_cards_module' => array(
					'key' => 'layout_card',
					'name' => 'Card',
					'label' => 'Card',
					'display' => 'block',
					'sub_fields' => array(
						array(
							'key' => 'field_card_name',
							'label' => 'Name',
							'name' => 'name',
							'type' => 'text',
							'instructions' => 'Enter the name for the card',
							'required' => 1,
						),
						array(
							'key' => 'field_card_date',
							'label' => 'Date',
							'name' => 'date',
							'type' => 'date_picker',
							'instructions' => 'Select the date for the card',
							'required' => 1,
						),
						array(
							'key' => 'field_card_description',
							'label' => 'Description',
							'name' => 'description',
							'type' => 'text',
							'instructions' => 'Enter the description for the card',
							'required' => 1,
						),
					),
					'min' => '',
					'max' => '',
				),
			),
			'min' => '',
			'max' => '',
			'button_label' => 'Add Module',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'documentation',
			),

			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'post',
			),
			
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
	'show_in_rest' => 0,
));
});


