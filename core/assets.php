<?php


class Layotter_Assets {
    public static function backend() {
        // load assets only if necessary
        if (!Layotter::is_enabled()) {
            return;
        }

        // styles
        wp_enqueue_style(
            'layotter',
            plugins_url('assets/css/editor.css', __DIR__)
        );
        wp_enqueue_style(
            'layotter-font-awesome',
            plugins_url('assets/css/font-awesome.min.css', __DIR__)
        );

        // jQuery plugin used to serialize form data
        wp_enqueue_script(
            'layotter-serialize',
            plugins_url('assets/js/vendor/jquery.serialize-object.compiled.js', __DIR__),
            array('jquery')
        );

        // Angular scripts
        // TODO: lol two years and I never minified
        $scripts = array(
            'angular' => 'assets/js/vendor/angular.js',
            'angular-animate' => 'assets/js/vendor/angular-animate.js',
            'angular-sanitize' => 'assets/js/vendor/angular-sanitize.js',
            'angular-ui-sortable' => 'assets/js/vendor/angular-ui-sortable.js',
            'layotter' => 'assets/js/app/app.js',
            'layotter-controller-editor' => 'assets/js/app/controllers/editor.js',
            'layotter-controller-templates' => 'assets/js/app/controllers/templates.js',
            'layotter-controller-form' => 'assets/js/app/controllers/form.js',
            'layotter-service-state' => 'assets/js/app/services/state.js',
            'layotter-service-data' => 'assets/js/app/services/data.js',
            'layotter-service-content' => 'assets/js/app/services/content.js',
            'layotter-service-templates' => 'assets/js/app/services/templates.js',
            'layotter-service-layouts' => 'assets/js/app/services/layouts.js',
            'layotter-service-view' => 'assets/js/app/services/view.js',
            'layotter-service-forms' => 'assets/js/app/services/forms.js',
            'layotter-service-modals' => 'assets/js/app/services/modals.js',
            'layotter-service-history' => 'assets/js/app/services/history.js'
        );
        foreach ($scripts as $name => $path) {
            wp_enqueue_script(
                $name,
                plugins_url($path, __DIR__)
            );
        }

        // fetch default values for post, row and element options
        $post_options = Layotter::assemble_new_options('post');
        $row_options = Layotter::assemble_new_options('row');
        $col_options = Layotter::assemble_new_options('col');
        $element_options = Layotter::assemble_new_options('element');

        // fetch content structure for the current post
        $layotter_post = new Layotter_Post(get_the_ID());

        // inject data for use with Javascript
        wp_localize_script(
            'layotter',
            'layotterData',
            array(
                'postID' => get_the_ID(),
                'isACFPro' => Layotter_Acf::is_pro_installed(),
                'contentStructure' => $layotter_post->to_array(),
                'allowedRowLayouts' => Layotter_Settings::get_allowed_row_layouts(),
                'defaultRowLayout' => Layotter_Settings::get_default_row_layout(),
                'savedLayouts' => $layotter_post->get_available_layouts(),
                'savedTemplates' => $layotter_post->get_available_templates(),
                'enablePostLayouts' => Layotter_Settings::post_layouts_enabled(),
                'enableElementTemplates' => Layotter_Settings::element_templates_enabled(),
                'elementTypes' => $layotter_post->get_available_element_types_metadata(),
                'isOptionsEnabled' => array(
                    'post' => $post_options->is_enabled(),
                    'row' => $row_options->is_enabled(),
                    'col' => $col_options->is_enabled(),
                    'element' => $element_options->is_enabled()
                ),
                'i18n' => array(
                    'delete_row' => __('Delete row', 'layotter'),
                    'delete_element' => __('Delete element', 'layotter'),
                    'delete_template' => __('Delete template', 'layotter'),
                    'edit_template' => __('Edit template', 'layotter'),
                    'cancel' => __('Cancel', 'layotter'),
                    'discard_changes' => __('Discard changes', 'layotter'),
                    'discard_changes_confirmation' => __('Do you want to cancel and discard all changes?', 'layotter'),
                    'delete_row_confirmation' => __('Do you want to delete this row and all its elements?', 'layotter'),
                    'delete_element_confirmation' => __('Do you want to delete this element?', 'layotter'),
                    'delete_template_confirmation' => __('Do you want to delete this template? You can not undo this action.', 'layotter'),
                    'edit_template_confirmation' => __('When editing a template, your changes will be reflected on all pages that are using it. Do you want to edit this template?', 'layotter'),
                    'save_new_layout_confirmation' => __('Please enter a name for your layout:', 'layotter'),
                    'save_layout' => __('Save layout', 'layotter'),
                    'rename_layout_confirmation' => __('Please enter the new name for this layout:', 'layotter'),
                    'rename_layout' => __('Rename layout', 'layotter'),
                    'delete_layout_confirmation' => __('Do want to delete this layout? You can not undo this action.', 'layotter'),
                    'delete_layout' => __('Delete layout', 'layotter'),
                    'load_layout_confirmation' => __('Do want to load this layout and overwrite the existing content?', 'layotter'),
                    'load_layout' => __('Load layout', 'layotter'),
                    'history' => array(
                        'undo' => __('Undo:', 'layotter'),
                        'redo' => __('Redo:', 'layotter'),
                        'add_element' => __('Add element', 'layotter'),
                        'edit_element' => __('Edit element', 'layotter'),
                        'duplicate_element' => __('Duplicate element', 'layotter'),
                        'delete_element' => __('Delete element', 'layotter'),
                        'move_element' => __('Move element', 'layotter'),
                        'save_element_as_template' => __('Save element as template', 'layotter'),
                        'create_element_from_template' => __('Create element from template', 'layotter'),
                        'add_row' => __('Add row', 'layotter'),
                        'change_row_layout' => __('Change row layout', 'layotter'),
                        'duplicate_row' => __('Duplicate row', 'layotter'),
                        'delete_row' => __('Delete row', 'layotter'),
                        'move_row' => __('Move row', 'layotter'),
                        'edit_post_options' => __('Edit post options', 'layotter'),
                        'edit_row_options' => __('Edit row options', 'layotter'),
                        'edit_column_options' => __('Edit column options', 'layotter'),
                        'edit_element_options' => __('Edit element options', 'layotter'),
                        'load_post_layout' => __('Load layout', 'layotter')
                    )
                )
            )
        );
    }


    /**
     * Include basic CSS in the frontend if enabled in settings
     */
    public static function frontend() {
        if (!is_admin() AND Layotter_Settings::default_css_enabled()) {
            wp_enqueue_style('layotter-frontend', plugins_url('assets/css/frontend.css', __DIR__));
        }
    }


    function views() {
        if (!Layotter::is_enabled()) {
            return;
        }

        ?>
        <script type="text/ng-template" id="layotter-form">
            <?php require_once __DIR__ . '/../views/form.php'; ?>
        </script>
        <script type="text/ng-template" id="layotter-add-element">
            <?php require_once __DIR__ . '/../views/add-element.php'; ?>
        </script>
        <script type="text/ng-template" id="layotter-load-layout">
            <?php require_once __DIR__ . '/../views/load-layout.php'; ?>
        </script>
        <script type="text/ng-template" id="layotter-modal-confirm">
            <?php require_once __DIR__ . '/../views/confirm.php'; ?>
        </script>
        <script type="text/ng-template" id="layotter-modal-prompt">
            <?php require_once __DIR__ . '/../views/prompt.php'; ?>
        </script>
        <?php

        require_once __DIR__ . '/../views/templates.php';
    }
}