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
            ->where('group_pages.group_id', '=', (int) $userGroup)
            ->select(['group_pages.access', 'pages.page_name', 'pages.action'])
            ->get();
    }

    /**
     * Generate a unique number based on module, code, company, month, and year.
     *
     * @param string $module  The module identifier for the generated number.
     * @param string $code    The code identifier for the generated number.
     * @param string $month   The month component for the generated number.
     * @param string $year    The year component for the generated number.
     *
     * @return string  The generated unique number.
     */
    public function generateNumber($module, $code, $month, $year)
    {
        // Get the Form model with the specified module
        $form = \App\Models\Module::where('module', $module)->first();

        // Get the current count value
        $count = $form->count;

        // Check if the month has changed
        if ($form->last_month != $month) {
            // Jika bulan berubah, atur count kembali ke satu
            $count = 1;

            // Update last_month dengan bulan yang sebelumnya (bulan sekarang)
            $form->update(['last_month' => $form->current_month]);

            // Update current_month dengan bulan yang baru dalam format '01', '02', dst.
            $form->update(['current_month' => sprintf('%02d', $month)]);
        } else {
            // If the month is the same, increment count
            $count = ($count >= 999) ? 1 : $count + 1;
        }

        // Format the count with leading zeros
        $nomor = sprintf('%03d', $count);

        // Generate the result based on the specified format
        $result = $code . '/' . $nomor . '/' . 'SMR' . '/' . $this->getRomawiMonth($month) . '/' . $year;

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
        $romanNumerals = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];

        // Convert a numeric month to an array index
        $monthIndex = intval($month) - 1;

        // Check if an array index is valid
        if ($monthIndex >= 0 && $monthIndex < count($romanNumerals)) {
            // Convert a month to Romawi
            return $romanNumerals[$monthIndex];
        } elseif (is_numeric($month) && strlen($month) == 2 && $month[0] == '0') {
            // Convert a two-digit month starting with 0
            return $romanNumerals[intval($month[1]) - 1];
        } else {
            // If the results are not the same, return an empty string
            return '';
        }
    }
}
