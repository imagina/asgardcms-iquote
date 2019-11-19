<?php

namespace Modules\Iquote\Services;

use Modules\Iquote\Entities\Characteristic;
use Modules\Iquote\Repositories\CharacteristicRepository;

class CharacteristicOrdener
{
    /**
     * @var CharacteristicRepository
     */
    private $characteristicRepository;

    /**
     * @param CharacteristicRepository $characteristic
     */
    public function __construct(CharacteristicRepository $characteristic)
    {
        $this->characteristicRepository = $characteristic;
    }

    /**
     * @param $data
     */
    public function handle($data)
    {
        $data = $this->convertToArray(json_decode($data));

        foreach ($data as $position => $item) {
            $this->order($position, $item);
        }
    }

    /**
     * Order recursively the menu items
     * @param int   $position
     * @param array $item
     */
    private function order($position, $item)
    {
        $menuItem = $this->characteristicRepository->find($item['id']);
        if (0 === $position && false === $menuItem->isRoot()) {
            return;
        }
        $this->savePosition($menuItem, $position);
        $this->makeItemChildOf($menuItem, null);

        if ($this->hasChildren($item)) {
            $this->handleChildrenForParent($menuItem, $item['children']);
        }
    }

    /**
     * @param Menuitem $parent
     * @param array    $children
     */
    private function handleChildrenForParent(Menuitem $parent, array $children)
    {
        foreach ($children as $position => $item) {
            $menuItem = $this->characteristicRepository->find($item['id']);
            $this->savePosition($menuItem, $position);
            $this->makeItemChildOf($menuItem, $parent->id);

            if ($this->hasChildren($item)) {
                $this->handleChildrenForParent($menuItem, $item['children']);
            }
        }
    }

    /**
     * Save the given position on the menu item
     * @param object $menuItem
     * @param int    $position
     */
    private function savePosition($menuItem, $position)
    {
        $this->characteristicRepository->update($menuItem, compact('position'));
    }

    /**
     * Check if the item has children
     *
     * @param  array $item
     * @return bool
     */
    private function hasChildren($item)
    {
        return isset($item['children']);
    }

    /**
     * Set the given parent id on the given menu item
     *
     * @param object $item
     * @param int    $parent_id
     */
    private function makeItemChildOf($item, $parent_id)
    {
        $this->characteristicRepository->update($item, compact('parent_id'));
    }

    /**
     * Convert the object to array
     * @param $data
     * @return array
     */
    private function convertToArray($data)
    {
        $data = json_decode(json_encode($data), true);

        return $data;
    }
}
