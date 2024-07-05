<?php
add_action('acf/include_fields', function () {
	if (!function_exists('acf_add_local_field_group')) {
		return;
	}

	acf_add_local_field_group(array(
		'key' => 'group_666006d52a9c0',
		'title' => 'Modules List',
		'fields' => array(
			array(
				'key' => 'field_666006d561672',
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
				'layouts' => array (
					'layout_66680824e3abd' => array(
						'key' => 'layout_66680824e3abd',
						'name' => 'banner_module',
						'label' => 'Banner Module',
						'display' => 'block',
						'sub_fields' => array(
							array(
								'key' => 'field_66680838e3abf',
								'label' => 'Image Block',
								'name' => 'image_block',
								'aria-label' => '',
								'type' => 'image',
								'instructions' => 'In this section you can add pictures for modules.',
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
							array(
								'key' => 'field_66684604c0cca',
								'label' => 'Title',
								'name' => 'title',
								'aria-label' => '',
								'type' => 'text',
								'instructions' => 'In this section you can add title for modules.',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'maxlength' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
							),
							array(
								'key' => 'field_66684621c0ccb',
								'label' => 'Description',
								'name' => 'description',
								'aria-label' => '',
								'type' => 'textarea',
								'instructions' => 'In this section you can add a description of modules.',
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
					'layout_6673c54e2104b' => array(
					'key' => 'layout_6673c54e2104b',
					'name' => 'faq',
					'label' => 'Faq',
					'display' => 'block',
					'sub_fields' => array(
						array(
							'key' => 'field_6673cf525a7a7',
							'label' => 'Faq',
							'name' => 'faq',
							'aria-label' => '',
							'type' => 'repeater',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'layout' => 'table',
							'min' => 0,
							'max' => 0,
							'collapsed' => '',
							'button_label' => 'Add Row',
							'rows_per_page' => 20,
							'sub_fields' => array(
								array(
									'key' => 'field_6673cf6c5a7a8',
									'label' => 'Question',
									'name' => 'question',
									'aria-label' => '',
									'type' => 'text',
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
									'placeholder' => '',
									'prepend' => '',
									'append' => '',
									'parent_repeater' => 'field_6673cf525a7a7',
								),
								array(
									'key' => 'field_6673cf785a7a9',
									'label' => 'Answer',
									'name' => 'answer',
									'aria-label' => '',
									'type' => 'wysiwyg',
									'instructions' => '',
									'required' => 1,
									'conditional_logic' => 0,
									'wrapper' => array(
										'width' => '',
										'class' => '',
										'id' => '',
									),
									'default_value' => '',
									'tabs' => 'all',
									'toolbar' => 'full',
									'media_upload' => 1,
									'delay' => 0,
									'parent_repeater' => 'field_6673cf525a7a7',
								),
							),
						),
					),
					'min' => '',
					'max' => '',
				),
					'layout_6672f39075b35' => array(
						'key' => 'layout_6672f39075b35',
						'name' => 'card',
						'label' => 'Card',
						'display' => 'block',
						'sub_fields' => array(
							array(
								'key' => 'field_6672f3a575b37',
								'label' => 'Name',
								'name' => 'name',
								'aria-label' => '',
								'type' => 'text',
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
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
							),
							array(
								'key' => 'field_6672f3ac75b38',
								'label' => 'Date',
								'name' => 'date',
								'aria-label' => '',
								'type' => 'date_picker',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'display_format' => 'F j, Y',
								'return_format' => 'F j, Y',
								'first_day' => 1,
							),
							array(
								'key' => 'field_6672f3c875b39',
								'label' => 'Description',
								'name' => 'description',
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
							array(
								'key' => 'field_6672f3dc75b3a',
								'label' => 'Image',
								'name' => 'image',
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
					'layout_66741577303f8' => array(
						'key' => 'layout_66741577303f8',
						'name' => 'iframe_block',
						'label' => 'Iframe Block',
						'display' => 'block',
						'sub_fields' => array(
							array(
								'key' => 'field_66741591303fa',
								'label' => 'URL',
								'name' => 'url',
								'aria-label' => '',
								'type' => 'url',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'placeholder' => '',
							),
						),
						'min' => '',
						'max' => '',
					),
					'layout_666006e451377' => array(
						'key' => 'layout_666006e451377',
						'name' => 'wysiwyg_block',
						'label' => 'WYSIWYG Content',
						'display' => 'block',
						'sub_fields' => array(
							array(
								'key' => 'field_6660074c61674',
								'label' => 'WYSIWYG Editor',
								'name' => 'wysiwyg_editor',
								'aria-label' => '',
								'type' => 'wysiwyg',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'tabs' => 'all',
								'toolbar' => 'full',
								'media_upload' => 1,
								'delay' => 0,
							),
						),
					),
					'layout_6672f432253d2' => array(
						'key' => 'layout_6672f432253d2',
						'name' => 'image',
						'label' => 'Image',
						'display' => 'block',
						'sub_fields' => array(
							array(
								'key' => 'field_6672f439253d4',
								'label' => 'Image Source',
								'name' => 'image_source',
								'aria-label' => '',
								'type' => 'radio',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'choices' => array(
									'upload' => 'Upload',
									'url' => 'URL',
								),
								'default_value' => '',
								'return_format' => 'value',
								'allow_null' => 0,
								'other_choice' => 0,
								'layout' => 'vertical',
								'save_other_choice' => 0,
							),
							array(
								'key' => 'field_6672f47c253d5',
								'label' => 'Image Upload',
								'name' => 'image_upload',
								'aria-label' => '',
								'type' => 'image',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'field_6672f439253d4',
											'operator' => '==',
											'value' => 'upload',
										),
									),
								),
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
							array(
								'key' => 'field_6672f4a7253d6',
								'label' => 'Image URL',
								'name' => 'image_url',
								'aria-label' => '',
								'type' => 'url',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'field_6672f439253d4',
											'operator' => '==',
											'value' => 'url',
										),
									),
								),
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'placeholder' => '',
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
					'value' => 'post',
				),

			),
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
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










//----
add_action( 'acf/include_fields', function() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
	'key' => 'group_6685d78a401b6',
	'title' => 'Ekipet',
	'fields' => array(
		array(
			'key' => 'field_6685d78a4d18d',
			'label' => 'Emri i Ekipes',
			'name' => '_emri_i_ekipes',
			'aria-label' => '',
			'type' => 'text',
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
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
		),
		array(
			'key' => 'field_6685dad124dd3',
			'label' => 'Pershkrimi i Ekipit',
			'name' => 'pershkrimi_iekipit',
			'aria-label' => '',
			'type' => 'wysiwyg',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'tabs' => 'all',
			'toolbar' => 'full',
			'media_upload' => 1,
			'delay' => 0,
		),
		array(
			'key' => 'field_6685db4724dd4',
			'label' => 'Select_members',
			'name' => 'select_members',
			'aria-label' => '',
			'type' => 'relationship',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'post_type' => array(
				0 => 'members',
			),
			'post_status' => '',
			'taxonomy' => '',
			'filters' => array(
				0 => 'search',
				1 => 'post_type',
				2 => 'taxonomy',
			),
			'return_format' => 'object',
			'min' => '',
			'max' => '',
			'elements' => '',
			'bidirectional' => 0,
			'bidirectional_target' => array(
			),
		),
		array(
			'key' => 'field_6686741aa5ada',
			'label' => 'Name Project',
			'name' => 'name_project',
			'aria-label' => '',
			'type' => 'post_object',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'post_type' => array(
				0 => 'projects',
			),
			'post_status' => '',
			'taxonomy' => '',
			'return_format' => 'object',
			'multiple' => 0,
			'allow_null' => 0,
			'bidirectional' => 0,
			'ui' => 1,
			'bidirectional_target' => array(
			),
		),
		array(
			'key' => 'field_66867436a5adb',
			'label' => 'Description',
			'name' => 'description',
			'aria-label' => '',
			'type' => 'wysiwyg',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'tabs' => 'all',
			'toolbar' => 'full',
			'media_upload' => 1,
			'delay' => 0,
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'teams',
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
) );

	acf_add_local_field_group( array(
	'key' => 'group_6685d08228611',
	'title' => 'Members',
	'fields' => array(
		array(
			'key' => 'field_6685d08295b24',
			'label' => 'Emri',
			'name' => 'emri',
			'aria-label' => '',
			'type' => 'text',
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
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
		),
		array(
			'key' => 'field_668628b8ca47f',
			'label' => 'Mbiemri',
			'name' => 'mbiemri',
			'aria-label' => '',
			'type' => 'text',
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
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
		),
		array(
			'key' => 'field_6685d1661f377',
			'label' => 'Roli',
			'name' => 'roli',
			'aria-label' => '',
			'type' => 'select',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'team_leader' => 'Team Leader',
				'inter' => 'Inter',
			),
			'default_value' => false,
			'return_format' => 'value',
			'multiple' => 0,
			'allow_null' => 0,
			'ui' => 0,
			'ajax' => 0,
			'placeholder' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'members',
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
) );

	acf_add_local_field_group( array(
	'key' => 'group_6683c90b13cab',
	'title' => 'Projects',
	'fields' => array(
		array(
			'key' => 'field_6683c90b36db5',
			'label' => 'Name Project',
			'name' => 'name_project',
			'aria-label' => '',
			'type' => 'text',
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
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
		),
		array(
			'key' => 'field_668673c3c88ed',
			'label' => 'Description',
			'name' => 'description',
			'aria-label' => '',
			'type' => 'wysiwyg',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'tabs' => 'all',
			'toolbar' => 'full',
			'media_upload' => 1,
			'delay' => 0,
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'projects',
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
) );
} );