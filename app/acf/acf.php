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
					'layout_6688695f441ae' => array(
						'key' => 'layout_6688695f441ae',
						'name' => 'teams_module',
						'label' => 'Teams Module',
						'display' => 'block',
						'sub_fields' => array(
							array(
								'key' => 'field_66886973441b0',
								'label' => 'Teams Module',
								'name' => 'teams_module',
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
									0 => 'teams',
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
				'layout_6697a178fb162' => array(
					'key' => 'layout_6697a178fb162',
					'name' => 'resources_module',
					'label' => 'Resources Module',
					'display' => 'block',
					'sub_fields' => array(
						array(
							'key' => 'field_6697a1b0fb164',
							'label' => 'Resource Category',
							'name' => 'resource_category',
							'aria-label' => '',
							'type' => 'taxonomy',
							'instructions' => 'Select the resources category.',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'taxonomy' => 'resource_category',
							'add_term' => 0,
							'save_terms' => 0,
							'load_terms' => 0,
							'return_format' => 'id',
							'field_type' => 'select',
							'allow_null' => 0,
							'bidirectional' => 0,
							'multiple' => 0,
							'bidirectional_target' => array(
							),
						),
						array(
							'key' => 'field_6697a20afb165',
							'label' => 'Resource Selection Type',
							'name' => 'resource_selection_type',
							'aria-label' => '',
							'type' => 'radio',
							'instructions' => 'Choose whether to display the latest 7 resources or manually select resources.',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'choices' => array(
								'Latest' => 'Latest',
								'Manual' => 'Manual',
							),
							'default_value' => '',
							'return_format' => 'value',
							'allow_null' => 0,
							'other_choice' => 0,
							'layout' => 'horizontal',
							'save_other_choice' => 0,
						),
						array(
							'key' => 'field_6697a23efb166',
							'label' => 'Select Resources',
							'name' => 'select_resources',
							'aria-label' => '',
							'type' => 'relationship',
							'instructions' => 'Select resources.',
							'required' => 0,
							'conditional_logic' => array(
								array(
									array(
										'field' => 'field_6697a20afb165',
										'operator' => '==',
										'value' => 'Manual',
									),
								),
							),
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'post_type' => array(
								0 => 'resources',
							),
							'post_status' => '',
							'taxonomy' => '',
							'filters' => array(
								0 => 'taxonomy',
							),
							'return_format' => 'object',
							'min' => '',
							'max' => '',
							'elements' => '',
							'bidirectional' => 0,
							'bidirectional_target' => array(
							),
						),
					),
					'min' => '',
					'max' => '',
				),

				'layout_668da3b98a49e' => array(
					'key' => 'layout_668da3b98a49e',
					'name' => 'stats_module',
					'label' => 'Stats Module',
					'display' => 'block',
					'sub_fields' => array(
						array(
							'key' => 'field_668da4072801b',
							'label' => 'Stats Module',
							'name' => 'stats_module',
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
									'key' => 'field_668da41a2801c',
									'label' => 'Statistic Value',
									'name' => 'statistic_value',
									'aria-label' => '',
									'type' => 'number',
									'instructions' => '',
									'required' => 0,
									'conditional_logic' => 0,
									'wrapper' => array(
										'width' => '',
										'class' => '',
										'id' => '',
									),
									'default_value' => '',
									'min' => '',
									'max' => '',
									'placeholder' => '',
									'step' => '',
									'prepend' => '',
									'append' => '',
									'parent_repeater' => 'field_668da4072801b',
								),
								array(
									'key' => 'field_668da4282801d',
									'label' => 'Statistic Text',
									'name' => 'statistic_text',
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
									'parent_repeater' => 'field_668da4072801b',
								),
							),
						),
					),
					'min' => '',
					'max' => '',
				),
				'layout_669cf37c4f9c2' => array(
					'key' => 'layout_669cf37c4f9c2',
					'name' => 'anchor_menu',
					'label' => 'Anchor Menu',
					'display' => 'block',
					'sub_fields' => array(
						array(
							'key' => 'field_669cf3914f9c8',
							'label' => 'Anchor Menu',
							'name' => 'anchor_menu',
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
					),
					'min' => '',
					'max' => '',
				),
				'layout_6672f39075b35' => array(
									'key' => 'layout_6672f39075b35',
									'name' => 'card',
									'label' => 'Card',
									'sub_fields' => array(
										array(
											'key' => 'field_selection_type',
											'label' => 'Selection Type',
											'name' => 'selection_type',
											'type' => 'radio',
											'choices' => array(
												'latest' => 'Latest',
												'manual' => 'Manual',
											),
											'default_value' => 'latest',
										),
										array(
											'key' => 'field_manual_post_type',
											'label' => 'Select Post Type',
											'name' => 'manual_post_type',
											'type' => 'button_group',
											'choices' => array(
												'post' => 'Posts',
												'teams' => 'Teams',
												'members' => 'Members',
												'documentation' => 'Documentation',
											),
											'layout' => 'horizontal',
											'return_format' => 'value',
											'conditional_logic' => array(
												array(
													array(
														'field' => 'field_selection_type',
														'operator' => '==',
														'value' => 'manual',
													),
												),
											),
										),
										array(
											'key' => 'field_manual_posts',
											'label' => 'Manual Posts',
											'name' => 'manual_posts',
											'type' => 'relationship',
											'post_type' => array('post'), 
											'conditional_logic' => array(
												array(
													array(
														'field' => 'field_selection_type',
														'operator' => '==',
														'value' => 'manual',
													),
													array(
														'field' => 'field_manual_post_type',
														'operator' => '==',
														'value' => 'post',
													),
												),
											),
											'filters' => array(
												'search',
											),
											'elements' => array(
												'featured_image',
											),
										),
										array(
											'key' => 'field_manual_teams',
											'label' => 'Manual Teams',
											'name' => 'manual_teams',
											'type' => 'relationship',
											'post_type' => array('teams'), 
											'conditional_logic' => array(
												array(
													array(
														'field' => 'field_selection_type',
														'operator' => '==',
														'value' => 'manual',
													),
													array(
														'field' => 'field_manual_post_type',
														'operator' => '==',
														'value' => 'teams',
													),
												),
											),
											'filters' => array(
												'search',
											),
											'elements' => array(
												'featured_image',
											),
										),
										array(
											'key' => 'field_manual_members',
											'label' => 'Manual Members',
											'name' => 'manual_members',
											'type' => 'relationship',
											'post_type' => array('members'), 
											'conditional_logic' => array(
												array(
													array(
														'field' => 'field_selection_type',
														'operator' => '==',
														'value' => 'manual',
													),
													array(
														'field' => 'field_manual_post_type',
														'operator' => '==',
														'value' => 'members',
													),
												),
											),
											'filters' => array(
												'search',
											),
											'elements' => array(
												'featured_image',
											),
										),
										array(
											'key' => 'field_card_title',
											'label' => 'Card Title',
											'name' => 'card_title',
											'type' => 'text',
											'instructions' => 'Enter the title for this card section',
										),
										array(
											'key' => 'field_manual_documentation',
											'label' => 'Manual Documentation',
											'name' => 'manual_documentation',
											'type' => 'relationship',
											'post_type' => array('documentation'), 
											'conditional_logic' => array(
												array(
													array(
														'field' => 'field_selection_type',
														'operator' => '==',
														'value' => 'manual',
													),
													array(
														'field' => 'field_manual_post_type',
														'operator' => '==',
														'value' => 'documentation',
													),
												),
											),
											'filters' => array(
												'search',
											),
											'elements' => array(
												'featured_image',
											),
										),
									),
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
				
					'layout_666006e45137b' => array(
						'key' => 'layout_666006e45137b',
						'label' => 'Search Bar',
						'name' => 'search_bar',
						'type' => 'group',
						'sub_fields' => array(
							array(
								'key' => 'field_search_input',
								'label' => 'Search Input',
								'name' => 'search_input',
								'type' => 'text',
								'instructions' => 'Enter placeholder text for the search input.',
							
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
				'label' => 'Name Team',
				'name' => 'name_team',
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
				'label' => 'Description',
				'name' => 'description',
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
				'key' => 'field_668d03122ba39',
				'label' => 'Email',
				'name' => 'email',
				'aria-label' => '',
				'type' => 'email',
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
				'prepend' => '',
				'append' => '',
			),
			array(
				'key' => 'field_668d0a0a32678',
				'label' => 'Project',
				'name' => 'project',
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
					0 => 'projects',
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
				'key' => 'field_668d111cb0a85',
				'label' => 'Team Image',
				'name' => 'team_image',
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
			array(
				'key' => 'field_668d2308240c0',
				'label' => 'Leader Image',
				'name' => 'leader_image',
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
			array(
				'key' => 'field_668e2bafa6133',
				'label' => 'Team Leader',
				'name' => 'team_leader',
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
					0 => 'members',
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
			array(
				'key' => 'field_668e239945d21',
				'label' => 'Email',
				'name' => 'email',
				'aria-label' => '',
				'type' => 'email',
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
				'prepend' => '',
				'append' => '',
			),
			array(
				'key' => 'field_668e24aa4c4da',
				'label' => 'Leader Image',
				'name' => 'leader_image_',
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

add_action( 'acf/include_fields', function() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
	'key' => 'group_66a0c83debaed',
	'title' => 'Resource Fields',
	'fields' => array(
		array(
			'key' => 'field_66a0c8fd48c8a',
			'label' => 'Resource Type',
			'name' => 'resource_type',
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
				'file' => 'File',
				'link' => 'Link',
			),
			'default_value' => '',
			'return_format' => 'value',
			'allow_null' => 0,
			'other_choice' => 0,
			'layout' => 'vertical',
			'save_other_choice' => 0,
		),
		array(
			'key' => 'field_66a0c83e671c8',
			'label' => 'Resource File',
			'name' => 'resource_file',
			'aria-label' => '',
			'type' => 'file',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_66a0c8fd48c8a',
						'operator' => '==',
						'value' => 'file',
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
			'min_size' => '',
			'max_size' => '',
			'mime_types' => 'txt,pdf,doc,docx,html,xml',
		),
		array(
			'key' => 'field_66a0c85a671c9',
			'label' => 'Resource Link',
			'name' => 'resource_link',
			'aria-label' => '',
			'type' => 'url',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_66a0c8fd48c8a',
						'operator' => '==',
						'value' => 'link',
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
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'resources',
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
