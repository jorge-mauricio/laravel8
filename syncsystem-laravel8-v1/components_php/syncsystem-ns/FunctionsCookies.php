<?php

declare(strict_types=1);

namespace SyncSystemNS;

class FunctionsCookies
{
    // Function to create / set cookie.
    // **************************************************************************************
    /**
     * Function to create / set cookie.
     * @static
     * @param string $cookieName
     * @param string $_cookieValue
     * @param string $_cookiePeriod
     * @return bool
     * @example
     * \SyncSystemNS\FunctionsGeneric::cookieCreate()
     */
    public static function cookieCreate($cookieName, $_cookieValue, $_cookiePeriod = ''): bool
    {
        // Variables.
        // ----------------------
        $strReturn = false;
        $cookiePeriod = ''; // (86400 = 1 dia)
        $cookieOptions = [];
        // ----------------------

        // Stay connected option.
        if ($_cookiePeriod === '1') {
            $cookiePeriod = time() + (86400 * 30 * 365);
        }

        if ($_cookiePeriod === '') {
            $cookiePeriod = time() + (86400);
        }

        if ($_cookieValue) {
            // $cookieOptions = [
            //     // domain: '127.0.0.1:4444',
            //     // secure: process.env.NODE_ENV === 'production'? true: false, / Forces to use https in production.
            //     // expires: new Date(Date.now() + 900000),
            //     httpOnly: true, //  You can't access these tokens in the client's javascript.
            // ];

            // objRoute._res.cookie('cookie_test', 'testing6', cookieOptions);

            /*
            if (gSystemConfig.configCookieSetType == 1)
            {

            }else{

            }
            */

            if (config('app.gSystemConfig.configCookieSetType') === 1) {
                setcookie($cookieName, $_cookieValue, $cookiePeriod, config('app.gSystemConfig.configCookieDirectory'));
            } else {
                setcookie($cookieName, $_cookieValue, $cookiePeriod);
            }

            // Guarantee that cookie will be defined in the first load.
            $_COOKIE[$cookieName] = $_cookieValue;

            $strReturn = true;
        }

        return $strReturn;
    }
    // **************************************************************************************

    // Function read cookie value.
    // **************************************************************************************
    /**
     * Function read cookie value.
     * @static
     * @param string $cookieName 'login' - returns login cookie | 'temp' - returns temporary cookie (temporary id) | '' returns all cookies
     * @return string|array
     * @example
     * \SyncSystemNS\FunctionsGeneric::cookieRead()
     */
    public static function cookieRead($cookieName = ''): string|array
    {
        // cookieName: '' - returns
        // objRoute = {_req: req, _res: res}

        // Variables.
        // ----------------------
        $strReturn = '';
        $objReturn = ['returnStatus' => false]; // (all cookies)

        //$_objBody;
        // ----------------------

        if ($cookieName) {
            if ($cookieName) {
                if (isset($_COOKIE[$cookieName])) {
                    $strReturn = $_COOKIE[$cookieName];
                }
            }

            if ($cookieName === '') {
                // Get values from login cookie.
                if ($strReturn === '') {
                    //$strReturn = \SyncSystemNS\FunctionsCookies::CookieValorLer_Login();
                    //$strReturn = \SyncSystemNS\FunctionsCookies::cookieRead_login();
                        // TODO:
                }

                // Temporary.
                if ($strReturn === '') {
                    $strReturn = $_COOKIE[config('app.gSystemConfig.configNomeCookie') . '_' . "idTblRegisterTemporary"];
                }
            }
        }

        return $strReturn;
    }
    // **************************************************************************************

    // Function to delete cookie.
    // **************************************************************************************
    /**
     * Function to delete cookie.
     * @static
     * @param string $cookieName
     * @return void
     * @example
     * \SyncSystemNS\FunctionsCookies::cookieDelete('')
     */
    public static function cookieDelete(string $cookieName = ''): void
    {
        $cookiePeriod = time() - 3600;

        if (config('app.gSystemConfig.configCookieSetType') === 1) {
            setcookie($cookieName, '', $cookiePeriod, config('app.gSystemConfig.configCookieDirectory'));
        } else {
            setcookie($cookieName, '', $cookiePeriod);
        }

        // Guarantee that the cookie will be deleted in the first load.
        $_COOKIE[$cookieName] = '';
    }
    // **************************************************************************************
}
