<?php

use artsoft\db\PermissionsMigration;

class m190606_131015_add_parallax_permissions extends PermissionsMigration
{

    public function beforeUp()
    {
        $this->addPermissionsGroup('parallaxManagement', 'Parallax Management');
    }

    public function afterDown()
    {
        $this->deletePermissionsGroup('parallaxManagement');
    }

    public function getPermissions()
    {
        return [
            'parallaxManagement' => [
                'links' => [
                    '/admin/parallax/*',
                    '/admin/parallax/default/*',
                ],
                'viewParallaxes' => [
                    'title' => 'View Parallaxes',
                    'links' => [
                        '/admin/parallax/default/index',
                        '/admin/parallax/default/view',
                        '/admin/parallax/default/grid-sort',
                        '/admin/parallax/default/grid-page-size',
                    ],
                    'roles' => [
                        self::ROLE_AUTHOR,
                    ],
                ],
                'editParallaxes' => [
                    'title' => 'Edit Parallaxes',
                    'links' => [
                        '/admin/parallax/default/update',
                        '/admin/parallax/default/bulk-activate',
                        '/admin/parallax/default/bulk-deactivate',
                    ],
                    'roles' => [
                        self::ROLE_AUTHOR,
                    ],
                    'childs' => [
                        'viewParallaxes',
                    ],
                ],
                'createParallaxes' => [
                    'title' => 'Create Parallaxes',
                    'links' => [
                        '/admin/parallax/default/create',
                    ],
                    'roles' => [
                        self::ROLE_AUTHOR,
                    ],
                    'childs' => [
                        'viewParallaxes',
                    ],
                ],
                'deleteParallaxes' => [
                    'title' => 'Delete Parallaxes',
                    'links' => [
                        '/admin/parallax/default/delete',
                        '/admin/parallax/default/bulk-delete',
                    ],
                    'roles' => [
                        self::ROLE_MODERATOR,
                    ],
                    'childs' => [
                        'viewParallaxes',
                    ],
                ],
                'fullParallaxAccess' => [
                    'title' => 'Full Parallax Access',
                    'roles' => [
                        self::ROLE_MODERATOR,
                    ],
                ],                
            ],
        ];
    }

}
