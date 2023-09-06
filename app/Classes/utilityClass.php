<?php

namespace App\Classes;

use App\Models\Employee;
use App\Models\PaymentMethod;
use DB;
use App\Models\VoucherSequence;
use App\Models\CustomerOrder;
use App\Models\Currency;

class utilityClass
{

    /*
     * .env value change
     *
     * @param $key string
     * @param $value string
     *
     * @return void
     */
    public static function changeEnvironmentVariable($key, $value)
    {
        $path = base_path('.env');

        if (is_bool(env($key))) {
            $old = env($key) ? 'true' : 'false';
        } elseif (env($key) === null) {
            $old = 'null';
        } else {
            $old = env($key);
        }

        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                $key . "=" . $old, $key . "=" . $value, file_get_contents($path)
            ));
        }

    }

    /*
     * Budapesti most...
     *
     * @return now datetime
     */
    public static function now()
    {
        $timezone = "Europe/Budapest";
        date_default_timezone_set($timezone);
        return date("Y-m-d H:i:s", strtotime('now'));
    }

    /* Nincs kép hexadecimálissá alakítás
     *
     * @return hexadecimal
     */
    public static function noAviablePicture()
    {
        $filename = public_path('img/noAviableImage.jpg');
        $handle = fopen($filename, "rb");
        $contents = bin2hex(fread($handle, filesize($filename)));
        fclose($handle);
        return $contents;
    }

    /*
     * a blobban tárolt hexadecimális kép megjelenítéséhez...
     *
     * @param $picture binary
     *
     * @return base64
     */
    public static function echoPicture($picture)
    {
        $picture = $picture != NULL ? $picture : session('noAviablePicture');
        return base64_encode(pack("H" . strlen($picture), $picture));

    }

}
