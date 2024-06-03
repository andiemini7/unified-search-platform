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
			),
			'min' => '',
			'max' => '',
			'button_label' => 'Add Row',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'modul',
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

add_action( 'init', function() {
	register_post_type( 'modul', array(
	'labels' => array(
		'name' => 'Modules',
		'singular_name' => 'Modul',
		'menu_name' => 'Module',
		'all_items' => 'All Module',
		'edit_item' => 'Edit Module',
		'view_item' => 'View Module',
		'view_items' => 'View Module',
		'add_new_item' => 'Add New Module',
		'add_new' => 'Add New Module',
		'new_item' => 'New Module',
		'parent_item_colon' => 'Parent Module:',
		'search_items' => 'Search Module',
		'not_found' => 'No module found',
		'not_found_in_trash' => 'No module found in Trash',
		'archives' => 'Module Archives',
		'attributes' => 'Module Attributes',
		'insert_into_item' => 'Insert into module',
		'uploaded_to_this_item' => 'Uploaded to this module',
		'filter_items_list' => 'Filter module list',
		'filter_by_date' => 'Filter module by date',
		'items_list_navigation' => 'Module list navigation',
		'items_list' => 'Module list',
		'item_published' => 'Module published.',
		'item_published_privately' => 'Module published privately.',
		'item_reverted_to_draft' => 'Module reverted to draft.',
		'item_scheduled' => 'Module scheduled.',
		'item_updated' => 'Module updated.',
		'item_link' => 'Module Link',
		'item_link_description' => 'A link to a module.',
	),
	'public' => true,
	'show_in_rest' => true,
	'menu_icon' => 'dashicons-admin-post',
	'supports' => array(
		0 => 'title',
		1 => 'editor',
		2 => 'thumbnail',
		3 => 'custom-fields',
	),
	'can_export' => false,
	'delete_with_user' => false,
) );
} );

