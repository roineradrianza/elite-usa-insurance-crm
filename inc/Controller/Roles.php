<?php 
namespace RA_ELITE_USA\Controller;

class Roles 
{
  public function __construct() {
    add_action('admin_init', '\RA_ELITE_USA\Controller\Roles::load');
  }

  public static function load()
  {
      add_role(
        'elite_usa_insurance_agent',
        'Insurance Agent',
        array(
          'read' => true,
          'edit_posts' => true,
          'edit_published_posts' => true,
          'delete_published_posts' => true,
          'delete_posts' => true,
          'publish_posts' => true,
          'upload_files' => true,
        )
      );
      add_role(
        'elite_usa_quote_manager',
        'Policy Quote manager',
        array(
          'read' => true,
          'delete_posts' => true,
          'delete_others_posts' => true,
          'delete_private_posts' => true,
          'delete_published_posts' => true,
          'delete_private_posts' => true,
          'edit_others_posts' => true,
          'edit_posts' => true,
          'edit_private_posts' => true,
          'edit_published_posts' => true,
          'manage_categories' => true,
          'publish_posts' => true,
          'read_private_posts' => true,
          'upload_files' => true,
        )
      );
      add_role(
        'elite_usa_superuser',
        'Super User',
        array(
          'activate_plugins' => true,
          'delete_others_pages' => true,
          'delete_others_posts' => true,
          'delete_private_posts' => true,
          'delete_pages' => true,
          'delete_posts' => true,
          'delete_private_pages' => true,
          'delete_private_posts' => true,
          'delete_published_pages' => true,
          'delete_published_posts' => true,
          'edit_dashboard' => true,
          'edit_others_pages' => true,
          'edit_others_posts' => true,
          'edit_posts' => true,
          'edit_private_pages' => true,
          'edit_private_posts' => true,
          'edit_published_pages' => true,
          'edit_published_posts' => true,
          'export' => true,
          'import' => true,
          'list_users' => true,
          'manage_categories' => true,
          'manage_links' => true,
          'manage_options' => true,
          'promote_users' => true,
          'publish_pages' => true,
          'publish_posts' => true,
          'read_private_pages' => true,
          'read_private_posts' => true,
          'remove_users' => true,
          'read' => true,
          'switch_themes' => true,
          'upload_files' => true,
          'customize' => true,
          'delete_site' => true,
          'update_plugins' => true,
          'update_themes' => true,
          'install_plugins' => true,
          'update_core' => true,
          'install_themes' => true,
          'delete_themes' => true,
          'delete_plugins' => true,
          'edit_plugins' => true,
          'edit_themes' => true,
          'edit_files' => true,
          'edit_users' => true,
          'add_users' => true,
          'create_users' => true,
          'delete_users' => true,
          'unfiltered_html' => true,
        )
      );
  }

}

