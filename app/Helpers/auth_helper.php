<?php

if (!function_exists('current_user')) {
    function current_user()
    {
        return session()->get('user_id');
    }
}

if (!function_exists('user_role')) {
    function user_role()
    {
        return strtoupper(session()->get('role'));
    }
}

if (!function_exists('is_superadmin')) {
    function is_superadmin()
    {
        return user_role() === 'SUPERADMIN';
    }
}

if (!function_exists('is_admin')) {
    function is_admin()
    {
        return user_role() === 'ADMIN';
    }
}

if (!function_exists('is_member')) {
    function is_member()
    {
        return user_role() === 'MEMBER';
    }
}

/*
|--------------------------------------------------------------------------
| PERMISSION RULES
|--------------------------------------------------------------------------
*/

if (!function_exists('can_view_shared')) {
    function can_view_shared()
    {
        return true; // semua role boleh lihat shared
    }
}

if (!function_exists('can_manage_shared')) {
    function can_manage_shared()
    {
        return is_superadmin() || is_admin();
    }
}

if (!function_exists('can_view_personal')) {
    function can_view_personal($ownerId)
    {
        return is_superadmin() || $ownerId == current_user();
    }
}

if (!function_exists('can_manage_personal')) {
    function can_manage_personal($ownerId)
    {
        return is_superadmin() || $ownerId == current_user();
    }
}