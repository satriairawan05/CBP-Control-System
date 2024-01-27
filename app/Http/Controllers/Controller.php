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

        // Get the Form model with the specified module
        $form = \App\Models\Form::where('module', $module)->first();

        // Get the current count value
        $count = $form->count;

        // Check if count is greater than or equal to 100, reset to 1 if true, otherwise increment by 1
        $count = ($count >= 100) ? 1 : $count + 1;

        // Format the count with leading zeros
        $nomor = sprintf('%03d', $count);

        // Generate the result based on the specified format
        $result = $prefix . '/' . $this->getRomawiMonth($month) . '/' . $nomor . '/' . $company . '/' . $year;

        // Update the count in the Form model
        $form->update(['count' => $count]);

        // Return the generated result
        return $result;
    }

    /**
     * Converts numeric month to Roman numeral format.
     *
     * @param  string  $month  Month in numeric format (01-12).
     * @return string  Month in Roman numeral format.
     */
    public function getRomawiMonth($month)
    {
        $romawiMonths = [
            'I' => ['1', '01'],
            'II' => ['2', '02'],
            'III' => ['3', '03'],
            'IV' => ['4', '04'],
            'V' => ['5', '05'],
            'VI' => ['6', '06'],
            'VII' => ['7', '07'],
            'VIII' => ['8', '08'],
            'IX' => ['9', '09'],
            'X' => '10',
            'XI' => '11',
            'XII' => '12',
        ];

        foreach ($romawiMonths as $romawi => $numericalMonths) {
            // Check if the numerical month is an array (for multiple representations)
            if (is_array($numericalMonths)) {
                // If the current month is in the array, return the corresponding Romawi numeral
                if (in_array($month, $numericalMonths)) {
                    return $romawi;
                }
            } elseif ($month == $numericalMonths) {
                // If the current month matches the numerical month, return the corresponding Romawi numeral
                return $romawi;
            }
        }

        // If no match is found, return an empty string
        return '';
    }
}
