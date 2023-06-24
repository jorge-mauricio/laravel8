<?php

declare(strict_types=1);

namespace SyncSystemNS;

class FunctionsCrypto
{
    // Static properties.
    // ref: https://stackoverflow.com/questions/45132030/nodejs-buffer-equivalent-in-php
    // ----------------------
    protected static $bufCryptKey32ByteFormated = '';
    /* TODO
    protected static $bufCryptKey32ByteFormated = Buffer.from({
        type: 'Buffer',
        data: [
          14, 221, 138, 225,
          153, 222, 125, 150,
          66, 206, 146, 193,
          56,  84, 223, 232,
          171, 136,  50, 186,
          3, 166, 127, 156,
          83, 229, 253, 133,
          111,  13, 185, 167
        ]
    });
    */

    protected static $bufCryptiv16ByteFormated = '';
    /* TODO
    protected static $bufCryptiv16ByteFormated = Buffer.from({
        type: 'Buffer',
        data: [
          145, 244,  19,
          250,   3, 106,
          132, 121, 138,
          254, 238, 238,
          107, 230, 150,
          131
        ]
    });
    */
    // ----------------------

    // Function to encrypt data.
    // **************************************************************************************
    // ref: https:// www.w3schools.com/nodejs/ref_crypto.asp
    // ref: https:// nodejs.org/en/knowledge/cryptography/how-to-use-crypto-module/
    /**
     * Function to encrypt data.
     * @static
     * @param string $strValue
     * @param int $encryptMethod 0 - none | 1 - hash | 2 - data (SS_ENCRYPT_METHOD_DATA)
     * @return string
     * @example
     * \SyncSystemNS\FunctionsCrypto::encryptValue('testing encryption', SS_ENCRYPT_METHOD_DATA)
     */
    public static function encryptValue(string $strValue, int $encryptMethod = SS_ENCRYPT_METHOD_DATA): string
    {
        // encryptMethod: 0 - none | 1 - hash | 2 - data
        // Variables.
        // ----------------------
        $strReturn = '';
        // ----------------------

        // None.
        // ----------------------
        if ($encryptMethod == SS_ENCRYPT_METHOD_NONE) {
            $strReturn = $strValue;
        }
        // ----------------------

        // Hash.
        // ----------------------
        if ($encryptMethod == SS_ENCRYPT_METHOD_HASH) {
            if (config('app.gSystemConfig.configCryptHash') == SS_ENCRYPT_METHOD_HASH_MD5) {
                $strReturn = md5(config('app.gSystemConfig.configCryptKey') . $strValue . config('app.gSystemConfig.configCryptSalt'));
            }
        }
        // ----------------------

        // Data.
        // ----------------------
        if ($encryptMethod === SS_ENCRYPT_METHOD_DATA) {
            //MCrypt PHP library.
            if (config('app.gSystemConfig.configCryptData') === SS_ENCRYPT_METHOD_DATA_MCRYPT) {
                $strReturn = \SyncSystemNS\FunctionsCrypto::MCryptEncrypt($strValue, config('app.gSystemConfig.configCryptKey32Byte'));
                // Debug.
                // echo 'strReturn=' . $strReturn . '<br />';
            }

            //Defuse php-encryption.
            if (config('app.gSystemConfig.configCryptData') === SS_ENCRYPT_METHOD_DATA_DEFUSE) {
                $strReturn = \SyncSystemNS\FunctionsCrypto::defuseEncrypt($strValue, config('app.gSystemConfig.configCryptKeyDefusePHPEncryptionRandomKey'), 1);
            }
        }
        // ----------------------

        return $strReturn;

        // Usage.
        // ----------------------
        // \SyncSystemNS\FunctionsCrypto::encryptValue('testing encryption', SS_ENCRYPT_METHOD_DATA);
        // ----------------------
    }
    // **************************************************************************************

    // Function to encrypt data.
    // **************************************************************************************
    // ref: https:// www.w3schools.com/nodejs/ref_crypto.asp
    // ref: https:// nodejs.org/en/knowledge/cryptography/how-to-use-crypto-module/
    /**
     * Function to encrypt data.
     * @static
     * @param string $strValue
     * @param int $encryptMethod 0 - none | 1 - hash (SS_ENCRYPT_METHOD_HASH) | 2 - data (SS_ENCRYPT_METHOD_DATA)
     * @return string
     * @example
     * \SyncSystemNS\FunctionsCrypto::decryptValue('testing decryption', SS_ENCRYPT_METHOD_DATA)
     */
    public static function decryptValue(string $strValue, int $encryptMethod = SS_ENCRYPT_METHOD_DATA): string
    {
        // TODO: adapt function to differentiate between info encryption and password encryption (hash).

        // Variables.
        // ----------------------
        $strReturn = '';
        // ----------------------
        try {
            // None cryptography.
            // ----------------------
            if ($encryptMethod === SS_ENCRYPT_METHOD_NONE) {
                $strReturn = $strValue;
            }
            // ----------------------

            // Data.
            // ----------------------
            if ($encryptMethod === SS_ENCRYPT_METHOD_DATA) {
            // if ($encryptMethod === SS_ENCRYPT_METHOD_DATA && (string) $strValue !== '') {
                // MCrypt PHP library.
                if (config('app.gSystemConfig.configCryptData') === SS_ENCRYPT_METHOD_DATA_MCRYPT) {
                    $strReturn = \SyncSystemNS\FunctionsCrypto::mCryptDecrypt($strValue, config('app.gSystemConfig.configCryptKey32Byte'));
                }

                //Defuse php-encryption.
                if (config('app.gSystemConfig.configCryptData') === SS_ENCRYPT_METHOD_DATA_DEFUSE) {
                    $strReturn = \SyncSystemNS\FunctionsCrypto::defuseDecrypt($strValue, config('app.gSystemConfig.configCryptKeyDefusePHPEncryptionRandomKey'), 1);
                }

                // Crypto Module algorithm: aes-256-cbc - 32 byte key and 16 byte iv
                if (config('app.gSystemConfig.configCryptData') === SS_ENCRYPT_METHOD_DATA_CRYPTO_MODULE_AES_128_CBC_SIMPLE) {
                    $cryptoKey = crypto::createDecipher('aes-128-cbc', config('app.gSystemConfig.configCryptKey'));
                    $cryptoString = cryptoKey::update($strValue, 'hex', 'utf8');

                    //TODO: $strReturn = $cryptoString . $cryptoKey.final('utf8');
                }

                // Crypto Module algorithm: aes-256-cbc - 32 byte key and 16 byte iv
                if (config('app.gSystemConfig.configCryptData') === SS_ENCRYPT_METHOD_DATA_CRYPTO_MODULE_AES_256_CBC_COMPLEX_32_16) {
                    // Logic.
                    /*
                    TODO:
                    $cryptoiv = Buffer.from(self::bufCryptiv16ByteFormated.toString('hex'), 'hex');
                    $encryptedString = Buffer.from(strValue, 'hex');
                    $cryptDecipher = crypto::createDecipheriv('aes-256-cbc', Buffer.from(this.bufCryptKey32ByteFormated), cryptoiv);
                    $decryptedString = cryptDecipher.update(encryptedString);
                    $decryptedString = Buffer.concat([decryptedString, cryptDecipher.final()]);

                    $strReturn = decryptedString.toString();
                    */
                }
            }
            // ----------------------
        } catch (\Exception $decryptValueError) {
            if (config('app.gSystemConfig.configDebug') === true) {
                if ($decryptValueError->getMessage() !== 'Ciphertext is too short.') {
                    throw new \Error('decryptValueError: ' . $decryptValueError->getMessage());
                    // TODO: log error
                } else {
                    $strReturn = 'decryptValueError: ' . $decryptValueError->getMessage();
                }
            }
        } finally {
            //
        }

        return $strReturn;
    }
    // **************************************************************************************

    // MCrypt PHP library.
    // **************************************************************************************
    // ref: http://www.warpconduit.net/2013/04/14/highly-secure-data-encryption-decryption-made-easy-with-php-mcrypt-rijndael-256-and-cbc/
    /**
     * Encrypt data (MCrypt PHP library).
     * @static
     * @param string $encrypt
     * @param string $key
     * @return string
     * @example
     * \SyncSystemNS\FunctionsCrypto::MCryptEncrypt('testing encryption', config('app.gSystemConfig.configCryptKey32Byte'))
     */
    public static function MCryptEncrypt(string $encrypt, string $key): string
    {
        $encrypt = serialize($encrypt);
        $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC), MCRYPT_DEV_URANDOM); // windows or php 5.3
        //$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC), MCRYPT_RAND); // php 5.2 and linux
        $key = pack('H*', $key);
        $mac = hash_hmac('sha256', $encrypt, substr(bin2hex($key), -32));
        $passcrypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $encrypt.$mac, MCRYPT_MODE_CBC, $iv);
        $encoded = base64_encode($passcrypt).'|'.base64_encode($iv);

        return $encoded;
    }

    /**
     * Decrypt data (MCrypt PHP library).
     * @static
     * @param string $encrypt
     * @param string $key
     * @return string
     * @example
     * \SyncSystemNS\FunctionsCrypto::mCryptDecrypt('testing encryption', '')
     */
    public static function mCryptDecrypt(string $decrypt, string $key): string
    {
        $decrypt = explode('|', $decrypt.'|');
        $decoded = base64_decode($decrypt[0]);
        $iv = base64_decode($decrypt[1]);
        if (strlen($iv) !== mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC)) {
            return false;
        }
        $key = pack('H*', $key);
        $decrypted = trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $decoded, MCRYPT_MODE_CBC, $iv));
        $mac = substr($decrypted, -64);
        $decrypted = substr($decrypted, 0, -64);
        $calcmac = hash_hmac('sha256', $decrypted, substr(bin2hex($key), -32));
        if ($calcmac !== $mac) {
            return false;
        }
        $decrypted = unserialize($decrypted);

        return $decrypted;
    }
    //**************************************************************************************

    // Defuse php-encryption.
    //**************************************************************************************
    /**
     * Encrypt data (Defuse).
     * @static
     * @param string strData
     * @param string strKey
     * @param int cryptographyType 1 = data + system default key
     * @return string
     * @example
     * \SyncSystemNS\FunctionsCrypto::defuseEncrypt('testing encryption', config('app.gSystemConfig.configCryptKeyDefusePHPEncryptionRandomKey'))
     */
    public static function defuseEncrypt(string $strData, string $strKey, int $cryptographyType = 1): string
    {
        // $cryptographyType: 1 = data + system default key
        $strReturn = '';

        // Data + system default key.
        if ($cryptographyType === 1) {
            $defuseKeyDefault = \Defuse\Crypto\Key::loadFromAsciiSafeString($strKey);
            $strReturn = \Defuse\Crypto\Crypto::encrypt($strData, $defuseKeyDefault);
        }

        return $strReturn;
    }
    //**************************************************************************************

    // Defuse php-encryption (decrypt).
    // **************************************************************************************
    // Defuse php-encryption (decrypt).
    /**
     *Defuse php-encryption (decrypt).
     * @static
     * @param string $strCipher
     * @param string $strKey
     * @param int $cryptographyType 1 = data + system default key
     * @return string
     * @example
     * \SyncSystemNS\FunctionsCrypto::defuseEncrypt('testing encryption', config('app.gSystemConfig.configCryptKeyDefusePHPEncryptionRandomKey'))
     */
    public static function defuseDecrypt(string $strCipher, string $strKey, int $cryptographyType = 1): string
    {
        //$cryptographyType: 1 = data + system default key
        $strReturn = '';

        if ($strCipher !== '') {
            // Data + system default key.
            if ($cryptographyType === 1) {
                $defuseKeyDefault = \Defuse\Crypto\Key::loadFromAsciiSafeString($strKey);
                $strReturn = \Defuse\Crypto\Crypto::decrypt($strCipher, $defuseKeyDefault);
            }
        }

        return $strReturn;
    }
    //**************************************************************************************
}
