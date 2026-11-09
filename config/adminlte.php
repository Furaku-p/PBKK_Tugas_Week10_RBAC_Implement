<?php

use JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter;
use JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter;
use JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter;
use JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter;
use JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter;
use JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter;

return [
    'title' => 'Portal Akademik ITS',
    'logo' => '<b>PORTAL</b> AKADEMIK',
    'logo_img' => false,
    'usermenu_enabled' => true,
    'use_route_url' => false,
    'dashboard_url' => 'admin/dashboard',
    'logout_url' => 'logout',
    'logout_method' => null,
    'login_url' => 'login',
    'register_url' => false,
    'layout_fixed_sidebar' => true,
    'sidebar_theme' => 'light',
    'menu' => [
        ['header' => 'MENU UTAMA'],
        [
            'text' => 'Dashboard',
            'route' => 'admin.dashboard',
            'icon' => 'bi bi-grid-1x2',
            'can' => 'view-dashboard',
        ],
        [
            'text' => 'Data Mahasiswa',
            'route' => 'admin.mahasiswa.index',
            'icon' => 'bi bi-people',
            'can' => 'view-mahasiswa',
        ],
        ['header' => 'PENGATURAN AKUN'],
        [
            'text' => 'Ubah Kata Sandi',
            'route' => 'admin.password.edit',
            'icon' => 'bi bi-lock',
        ],
        [
            'text' => 'Website Publik',
            'url' => '/',
            'icon' => 'bi bi-house',
        ],
    ],
    'filters' => [
        GateFilter::class,
        HrefFilter::class,
        ActiveFilter::class,
        ClassesFilter::class,
        LangFilter::class,
        DataFilter::class,
    ],
];
