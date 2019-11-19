<?php

namespace Modules\Iquote\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Events\BuildingSidebar;
use Modules\User\Contracts\Authentication;

class RegisterIquoteSidebar implements \Maatwebsite\Sidebar\SidebarExtender
{
    /**
     * @var Authentication
     */
    protected $auth;

    /**
     * @param Authentication $auth
     *
     * @internal param Guard $guard
     */
    public function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    }

    public function handle(BuildingSidebar $sidebar)
    {
        $sidebar->add($this->extendWith($sidebar->getMenu()));
    }

    /**
     * @param Menu $menu
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        $menu->group(trans('core::sidebar.content'), function (Group $group) {
            $group->item(trans('iquote::iquotes.title.iquotes'), function (Item $item) {
                $item->icon('fa fa-copy');
                $item->weight(10);
                $item->authorize(
                     /* append */
                );
                $item->item(trans('iquote::packages.title.packages'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.iquote.package.create');
                    $item->route('admin.iquote.package.index');
                    $item->authorize(
                        $this->auth->hasAccess('iquote.packages.index')
                    );
                });
                $item->item(trans('iquote::products.title.products'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.iquote.product.create');
                    $item->route('admin.iquote.product.index');
                    $item->authorize(
                        $this->auth->hasAccess('iquote.products.index')
                    );
                });
                $item->item(trans('iquote::characteristics.title.characteristics'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.iquote.characteristic.create');
                    $item->route('admin.iquote.characteristic.index');
                    $item->authorize(
                        $this->auth->hasAccess('iquote.characteristics.index')
                    );
                });
                $item->item(trans('iquote::types.title.types'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.iquote.type.create');
                    $item->route('admin.iquote.type.index');
                    $item->authorize(
                        $this->auth->hasAccess('iquote.types.index')
                    );
                });
                $item->item(trans('iquote::quotes.title.quotes'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.iquote.quote.create');
                    $item->route('admin.iquote.quote.index');
                    $item->authorize(
                        $this->auth->hasAccess('iquote.quotes.index')
                    );
                });
// append





            });
        });

        return $menu;
    }
}
