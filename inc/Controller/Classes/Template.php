<?php

namespace RA_ELITE_USA\Controller\Classes;

use \RA_ELITE_USA\Controller\Classes\Options;
use \RA_ELITE_USA\Controller\Classes\User;

class Template
{

    public static function load_template($template_name, $ra_elite_usa_insurance_vars = [])
    {
        ob_start();
        extract($ra_elite_usa_insurance_vars);
        include self::locate_template($template_name, $ra_elite_usa_insurance_vars);
        return apply_filters("ra_elite_usa_insurance_{$template_name}", ob_get_clean(), $ra_elite_usa_insurance_vars);
    }

    public static function show_template($template_name, $ra_elite_usa_insurance_vars = [])
    {
        echo self::load_template($template_name, $ra_elite_usa_insurance_vars);
    }

    public static function locate_template($template_name, $ra_elite_usa_insurance_vars = [])
    {
        $template_name = '/views/' . $template_name . '.php';
        $template_name = apply_filters('ra_elite_usa_insurance_template_name', $template_name, $ra_elite_usa_insurance_vars);
        $template = apply_filters('ra_elite_usa_insurance_template_file', RA_ELITE_USA_INSURANCE, $template_name) . $template_name;

        return (locate_template($template_name)) ? locate_template($template_name) : $template;

    }
    
    public static function render_view($styles = [], $scripts = [], $template = '', $vars = [])
    {
        foreach ($styles as $style) {
            ra_elite_usa_insurance_register_style($style);
        }
        foreach ($scripts as $script) {
            ra_elite_usa_insurance_register_script($script);
        }
        return self::show_template($template, $vars);
    }

    public static function dashboard_tabs()
    {
        $options = Options::get_option('routes');
        $tabs = ['tabs' => [
            /*['name'=> 'Dashboard', 'icon' => 'mdi-view-dashboard', 'url' => $options['dashboard']],*/
            ['name' => 'Inbox', 'icon' => 'mdi-inbox', 'url' => $options['inbox'], 'tab_index' => 4],
            ['name' => 'Quotes', 'icon' => 'mdi-text-box-multiple', 'url' => $options['quotes'], 'tab_index' => 0],
            ['name' => 'New Quote', 'icon' => 'mdi-text-box', 'url' => $options['quote_form'], 'tab_index' => 1],
            ['name' => 'Settings', 'icon' => 'mdi-cog', 'url' => $options['user_settings'], 'tab_index' => 2],
            [
                'name' => 'Reports',
                'icon' => 'mdi-chart-areaspline-variant',
                'tab_index' => 3,
                'items' => [
                    [
                        'name' => 'Renewals & News quotes',
                        'url' => $options['reports_renewals_and_new_quotes'],
                        'tab_index' => 5
                    ]
                ]
            ],
        ],
        ];
        return $tabs;
    }

    public static function get_tab_url($name = '')
    {
        $tabs = self::dashboard_tabs();
        $tab = array_search($name, array_column($tabs['tabs'], 'name'));
        return $tab !== false ? $tabs['tabs'][$tab]['url'] : '';
    }

    public static function dashboard_manager_tabs()
    {
        $options = Options::get_option('routes');
        $tabs = ['tabs' => [
            ['name' => 'Inbox', 'icon' => 'mdi-inbox', 'url' => $options['inbox'], 'tab_index' => 4],
            ['name' => 'Quotes', 'icon' => 'mdi-text-box-multiple', 'url' => $options['quotes'], 'tab_index' => 0],
            ['name' => 'Settings', 'icon' => 'mdi-cog', 'url' => $options['user_settings'], 'tab_index' => 2],
            [
                'name' => 'Reports',
                'icon' => 'mdi-chart-areaspline-variant',
                'tab_index' => 3,
                'items' => [
                    [
                        'name' => 'Renewals & News quotes',
                        'url' => $options['reports_renewals_and_new_quotes'],
                        'tab_index' => 5
                    ]
                ]
            ],
        ],
        ];
        $current_user = User::get_current_user();
        if ($current_user['roles'][0] == 'administrator') {
            $tabs['tabs'][] = ['name' => 'Manage Users', 'icon' => 'mdi-account-group', 'url' => $options['user_manager'], 'tab_index' => 6];
        }
        return $tabs;
    }

    public static function dashboard_superuser_tabs()
    {
        $options = Options::get_option('routes');
        $tabs = ['tabs' => [
            ['name' => 'Inbox', 'icon' => 'mdi-inbox', 'url' => $options['inbox'], 'tab_index' => 4],
            ['name' => 'Quotes', 'icon' => 'mdi-text-box-multiple', 'url' => $options['quotes'], 'tab_index' => 0],
            ['name' => 'New Quote', 'icon' => 'mdi-text-box', 'url' => $options['quote_form'], 'tab_index' => 1],
            ['name' => 'Settings', 'icon' => 'mdi-cog', 'url' => $options['user_settings'], 'tab_index' => 2],
            [
                'name' => 'Reports',
                'icon' => 'mdi-chart-areaspline-variant',
                'tab_index' => 3,
                'items' => [
                    [
                        'name' => 'Renewals & News quotes',
                        'url' => $options['reports_renewals_and_new_quotes'],
                        'tab_index' => 5
                    ]
                ]
            ],
            ['name' => 'Manage Users', 'icon' => 'mdi-account-group', 'url' => $options['user_manager'], 'tab_index' => 6],
        ],
        ];
        return $tabs;
    }

    public static function folder_by_rol($user)
    {
        if (empty($user['roles'])) {
            return '';
        }

        $f = 'agent';
        if ($user['roles'][0] == 'administrator' || $user['roles'][0] == 'elite_usa_quote_manager') {
            $f = 'manager';
        } else if ($user['roles'][0] == 'elite_usa_superuser') {
            $f = 'superuser';
        }
        return $f;
    }

    
    public static function render_sidebar_view(array $user): Void
    {
        $user = empty($user) ? User::get_session() : $user;

        $tabs = [];

        switch ($user['roles'][0]) {

            case 'elite_usa_superuser':
                $tabs = self::dashboard_superuser_tabs();
                break;

            case 'elite_usa_quote_manager' || 'administrator':
                $tabs = self::dashboard_manager_tabs();
                break;

            case 'elite_usa_insurance_agent':
                $tabs = self::dashboard_tabs();
                break;
            
            default:

                break;

        }
        
        if (!empty($tabs)) {

            echo self::show_template('interface/parts/sidebar', $tabs);

        }
    }


}
