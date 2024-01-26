<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Get access permission for a specific page based on user group.
     *
     * @param string $pageName   The name or identifier of the page.
     * @param string $userGroup  The user group of the current user.
     *
     * @return array  Returns data in array format
     */
    public function get_access(string $pageName, string $userGroup)
    {
        return \App\Models\User::leftJoin('group_pages', 'users.group_id', '=', 'group_pages.group_id')
            ->leftJoin('groups', 'users.group_id', '=', 'groups.group_id')
            ->leftJoin('pages', 'group_pages.page_id', '=', 'pages.page_id')
            ->where('pages.page_name', '=', $pageName)
            ->where('group_pages.group_id', '=', $userGroup)
            ->select(['group_pages.access', 'pages.page_name', 'pages.action'])
            ->get();
    }

    /**
     * Generate a unique number based on module, code, company, month, and year.
     *
     * @param string $module  The module identifier for the generated number.
     * @param string $code    The code identifier for the generated number.
     * @param string $company The company identifier for the generated number.
     * @param string $month   The month component for the generated number.
     * @param string $year    The year component for the generated number.
     *
     * @return string  The generated unique number.
     */
    public function generateNumber($module, $code, $company, $month, $year)
    {
        $prefix = strtoupper($code);
        $count = \App\Models\Form::where('module', $module)->first()->count + 1;
        $count = ($count > 100) ? 1 : $count;
        $nomor = sprintf('%03d', $count);

        $result = $prefix . '/' . $month . '/' . $nomor . '/' . $company . '/' . $year;

        return $result;
    }
}
