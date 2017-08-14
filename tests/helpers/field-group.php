<?php

use \Layotter\Acf\Adapter;

if (Adapter::is_pro_installed()) {
    acf_add_local_field_group([
        'key' => 'group_test',
        'title' => '',
        'fields' => [
            [
                'key' => 'field_test',
                'label' => '',
                'name' => 'content',
                'type' => 'wysiwyg',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => '',
                'tabs' => 'all',
                'toolbar' => 'full',
                'media_upload' => 1,
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'layotter',
                    'operator' => '==',
                    'value' => 'element',
                ],
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'page',
                ],
            ],
        ],
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => 1,
        'description' => '',
    ]);
    acf_add_local_field_group([
        'key' => 'group_5991e509a7176',
        'title' => 'options',
        'fields' => [
            [
                'key' => 'field_5991e51351f18',
                'label' => 'option',
                'name' => 'option',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'layotter',
                    'operator' => '==',
                    'value' => 'post_options',
                ],
            ],
            [
                [
                    'param' => 'layotter',
                    'operator' => '==',
                    'value' => 'row_options',
                ],
            ],
            [
                [
                    'param' => 'layotter',
                    'operator' => '==',
                    'value' => 'col_options',
                ],
            ],
            [
                [
                    'param' => 'layotter',
                    'operator' => '==',
                    'value' => 'element_options',
                ],
            ],
        ],
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => 1,
        'description' => '',
    ]);
    // TODO: non Pro field groups
} else {
    register_field_group([
        'id' => 'group_test',
        'title' => '',
        'fields' => [
            [
                'key' => 'field_test',
                'label' => '',
                'name' => 'content',
                'type' => 'wysiwyg',
                'default_value' => '',
                'toolbar' => 'full',
                'media_upload' => 'yes',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'layotter',
                    'operator' => '==',
                    'value' => 'element',
                    'order_no' => 0,
                    'group_no' => 0,
                ],
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'page',
                    'order_no' => 0,
                    'group_no' => 0,
                ],
            ],
        ],
        'options' => [
            'position' => 'normal',
            'layout' => 'no_box',
            'hide_on_screen' => [],
        ],
        'menu_order' => 0,
    ]);
}