<?php

if (! function_exists('api_token')) {
    /**
     * Get the CSRF token value.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    function api_token()
    {
        if(\Illuminate\Support\Facades\Auth::check()){

            return \Illuminate\Support\Facades\Auth::user()->api_token;
        }
    }
}