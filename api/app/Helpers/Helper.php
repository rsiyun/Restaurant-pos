<?php
namespace App\Helpers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class Helper
{

    public static function generateSlug($nameToSlug, $table_name)
    {

        while (true) {
            $slug = Str::slug($nameToSlug) . '-' . Str::random(5);

            $slug_count = DB::table($table_name)->where('slug', $slug)->count();

            if ($slug_count == 0) {
                break;
            }
        }

        return $slug;
    }
    public static function getParams($url){
        if (!$url) {
            return null;
        }
        parse_str(parse_url($url)["query"], $params);
        return $params;
    }
}
