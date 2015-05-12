<?php namespace Ainet\Support;

class HtmlHelper
{
    public static function e($raw)
    {
        return htmlspecialchars($raw, ENT_QUOTES, 'UTF-8');
    }

    public static function selectBox($options, $selected = null)
    {
        $html = '<option value="">----------</option>';

        foreach ($options as $key => $value){
            if ($key === $selected){
                $html .= '<option value="' . $key . '" selected>' . $value .'</option>';
            } else {
                $html .= '<option value="' . $key . '">' . $value .'</option>';
            }
        }

        return $html;
    }

    public static function error($errors, $key)
    {
        if ($errors && array_key_exists($key, $errors)){
            return '<span class="error"> ' . $errors[$key] . '</span>';
        }
    }
}
