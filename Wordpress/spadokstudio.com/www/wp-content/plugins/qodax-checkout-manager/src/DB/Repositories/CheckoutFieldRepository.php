<?php

namespace Qodax\CheckoutManager\DB\Repositories;

if ( ! defined('ABSPATH')) {
    exit;
}

class CheckoutFieldRepository
{
    /**
     * @var \wpdb
     */
    private $wpdb;

    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
    }

    public function findBySection(string $section): array
    {
        $query = $this->wpdb->prepare("
            SELECT *
            FROM " . $this->wpdb->prefix . "qodax_checkout_manager_fields
            WHERE `section` = %s
        ", [ $section ]);

        return $this->wpdb->get_results($query, ARRAY_A);
    }

    public function getCustomFields(): array
    {
        return $this->wpdb->get_results("
            SELECT *
            FROM " . $this->wpdb->prefix . "qodax_checkout_manager_fields
            WHERE native = 0
        ", ARRAY_A);
    }

    public function findByNames(array $names): array
    {
        $patterns = array_map(function ($item) {
            return '%s';
        }, $names);

        $query = $this->wpdb->prepare("
            SELECT *
            FROM " . $this->wpdb->prefix . "qodax_checkout_manager_fields
            WHERE field_name in (" . implode(',', $patterns) . ")
        ", $names);

        return $this->wpdb->get_results($query, ARRAY_A);
    }

    public function all(): array
    {
        return $this->wpdb->get_results("
            SELECT *
            FROM " . $this->wpdb->prefix . "qodax_checkout_manager_fields
        ", ARRAY_A);
    }

    public function deleteBySection(string $section)
    {
        $this->wpdb->query($this->wpdb->prepare(
            "DELETE FROM " . $this->wpdb->prefix . "qodax_checkout_manager_fields WHERE `section` = %s",
            [ $section ]
        ));
    }

    public function insert(array $field, string $section)
    {
        $this->wpdb->insert($this->wpdb->prefix . 'qodax_checkout_manager_fields', [
            'field_name' => $field['name'],
            'field_type' => $field['type'],
            'field_meta' => json_encode($field['meta'], JSON_UNESCAPED_UNICODE),
            'section' => $section,
            'native' => (int)$field['native'],
            'required' => (int)$field['required'],
            'active' => (int)$field['active'],
            'priority' => (int)$field['priority']
        ]);
    }
}