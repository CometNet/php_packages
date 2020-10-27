<?php

use Illuminate\Support\MessageBag;

if (!function_exists('ucneter_path')) {

    /**
     * Get admin path.
     *
     * @param string $path
     *
     * @return string
     */
    function ucneter_path($path = '')
    {
        return ucfirst(config('ucenter.directory')).($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}

if (!function_exists('ucenter_base_path')) {
    /**
     * Get admin url.
     *
     * @param string $path
     *
     * @return string
     */
    function ucenter_base_path($path = '')
    {
        $prefix = '/'.trim(config('ucenter.route.prefix'), '/');

        $prefix = ($prefix == '/') ? '' : $prefix;

        $path = trim($path, '/');

        if (is_null($path) || strlen($path) == 0) {
            return $prefix ?: '/';
        }

        return $prefix.'/'.$path;
    }
}


if (!function_exists('ucenter_url')) {
    /**
     * Get admin url.
     *
     * @param string $path
     * @param mixed  $parameters
     * @param bool   $secure
     *
     * @return string
     */
    function ucenter_url($path = '', $parameters = [], $secure = null)
    {
        if (\Illuminate\Support\Facades\URL::isValidUrl($path)) {
            return $path;
        }

        $secure = $secure ?: (config('ucenter.https') || config('ucenter.secure'));

        return url(ucenter_base_path($path), $parameters, $secure);
    }
}

if (!function_exists('ucenter_toastr')) {

    /**
     * Flash a toastr message bag to session.
     *
     * @param string $message
     * @param string $type
     * @param array  $options
     */
    function ucenter_toastr($message = '', $type = 'success', $options = [])
    {
        $toastr = new MessageBag(get_defined_vars());

        session()->flash('toastr', $toastr);
    }
}

if (!function_exists('ucenter_asset')) {

    /**
     * @param $path
     *
     * @return string
     */
    function ucenter_asset($path)
    {
        return asset($path);
    }
}


if (!function_exists('ucenter_trans')) {

    /**
     * Translate the given message.
     *
     * @param string $key
     * @param array  $replace
     * @param string $locale
     *
     * @return \Illuminate\Contracts\Translation\Translator|string|array|null
     */
    function ucenter_trans($key = null, $replace = [], $locale = null)
    {
        $line = __($key, $replace, $locale);

        if (!is_string($line)) {
            return $key;
        }

        return $line;
    }
}

if (!function_exists('ucenter_toastr')) {

    /**
     * Flash a toastr message bag to session.
     *
     * @param string $message
     * @param string $type
     * @param array  $options
     */
    function ucenter_toastr($message = '', $type = 'success', $options = [])
    {
        $toastr = new MessageBag(get_defined_vars());

        session()->flash('toastr', $toastr);
    }
}

if (!function_exists('ucenter_success')) {

    /**
     * Flash a success message bag to session.
     *
     * @param string $title
     * @param string $message
     */
    function ucenter_success($title, $message = '')
    {
        admin_info($title, $message, 'success');
    }
}

if (!function_exists('ucenter_error')) {

    /**
     * Flash a error message bag to session.
     *
     * @param string $title
     * @param string $message
     */
    function ucenter_error($title, $message = '')
    {
        admin_info($title, $message, 'error');
    }
}

if (!function_exists('ucenter_warning')) {

    /**
     * Flash a warning message bag to session.
     *
     * @param string $title
     * @param string $message
     */
    function ucenter_warning($title, $message = '')
    {
        admin_info($title, $message, 'warning');
    }
}

if (!function_exists('ucenter_info')) {

    /**
     * Flash a message bag to session.
     *
     * @param string $title
     * @param string $message
     * @param string $type
     */
    function ucenter_info($title, $message = '', $type = 'info')
    {
        $message = new MessageBag(get_defined_vars());

        session()->flash($type, $message);
    }
}


