<?php

namespace Layotter\Structures;

/**
 * Used to pass around element type meta data in a predictable structure
 */
class ElementTypeMeta implements \JsonSerializable {

    /**
     * @var string Element type
     */
    private $type = '';

    /**
     * @var string Human readable element type title
     */
    private $title = '';

    /**
     * @var string Human readable element type description
     */
    private $description = '';

    /**
     * @var string Icon name from the Font Awesome set
     */
    private $icon = '';

    /**
     * @var int Ordering number relative to other element types
     */
    private $order = 0;

    /**
     * Constructor.
     *
     * @param $type
     * @param $title
     * @param $description
     * @param $icon
     * @param $order
     */
    public function __construct($type, $title, $description, $icon, $order) {
        if (is_string($type)) {
            $this->type = $type;
        }

        if (is_string($title)) {
            $this->title = $title;
        }

        if (is_string($description)) {
            $this->description = $description;
        }

        if (is_string($icon)) {
            $this->icon = $icon;
        }

        if (is_int($order)) {
            $this->order = $order;
        }
    }

    /**
     * Title getter
     *
     * @return string Human readable element type title
     */
    public function get_title() {
        return $this->title;
    }

    /**
     * Order getter
     *
     * @return int Ordering number relative to other element types
     */
    public function get_order() {
        return $this->order;
    }

    /**
     * Return array representation for use in json_encode()
     *
     * @return array
     */
    public function jsonSerialize() {
        return array(
            'type' => $this->type,
            'title' => $this->title,
            'description' => $this->description,
            'icon' => $this->icon,
            'order' => $this->order
        );
    }
}
