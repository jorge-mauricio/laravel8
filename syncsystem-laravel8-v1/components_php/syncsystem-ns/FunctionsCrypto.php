<?php
namespace SyncSystemNS;

class FunctionsCrypto
{
    // Function to encrypt data.
    // **************************************************************************************
    // ref: https:// www.w3schools.com/nodejs/ref_crypto.asp
    // ref: https:// nodejs.org/en/knowledge/cryptography/how-to-use-crypto-module/
    /**
     * Function to encrypt data.
     * @static
     * @param string strValue
     * @param integer encryptMethod 0 - none | 1 - hash | 2 - data
     * @return string
     * @example
     * \SyncSystemNS\FunctionsCrypto::encryptValue("testing encryption", SS_ENCRYPT_METHOD_DATA)
     */
    static function encryptValue(string $strValue, int $encryptMethod = SS_ENCRYPT_METHOD_DATA): string
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
			if($GLOBALS['configCryptHash'] == SS_ENCRYPT_METHOD_HASH_MD5)
			{
				$strReturn = md5($GLOBALS['configCryptKey'] . $strValue . $GLOBALS['configCryptSalt']);
			}
        }
        // ----------------------

        // Data.
        // ----------------------
        if ($encryptMethod === SS_ENCRYPT_METHOD_DATA) {

			//MCrypt PHP library.
			if($GLOBALS['configCryptData'] === SS_ENCRYPT_METHOD_DATA_MCRYPT)
			{
				$strReturn = \SyncSystemNS\FunctionsCrypto::MCryptEncrypt($strValue, $GLOBALS['configCryptKey32Byte']);
                // Debug.
                echo 'strReturn=' . $strReturn . '<br />';
			}
			
			//Defuse php-encryption.
			if($GLOBALS['configCryptData'] === SS_ENCRYPT_METHOD_DATA_DEFUSE)
			{
				$strReturn = \SyncSystemNS\FunctionsCrypto::DefuseEncrypt($strValue, $GLOBALS['configCryptChaveDefusePHPEncryptionRandomKey'], 1);
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


    // MCrypt PHP library.
    // **************************************************************************************
	// ref: http://www.warpconduit.net/2013/04/14/highly-secure-data-encryption-decryption-made-easy-with-php-mcrypt-rijndael-256-and-cbc/
    /**
     * Encrypt data (MCrypt PHP library).
     * @static
     * @param string encrypt
     * @param string key
     * @return string
     * @example
     * \SyncSystemNS\FunctionsCrypto::MCryptEncrypt('testing encryption', $GLOBALS['configCryptKey32Byte'])
     */
	static function MCryptEncrypt($encrypt, $key): string
	{
		$encrypt = serialize($encrypt);
		$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC), MCRYPT_DEV_URANDOM); //windows or php 5.3
		//$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC), MCRYPT_RAND); //php 5.2 and linux
		$key = pack('H*', $key);
		$mac = hash_hmac('sha256', $encrypt, substr(bin2hex($key), -32));
		$passcrypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $encrypt.$mac, MCRYPT_MODE_CBC, $iv);
		$encoded = base64_encode($passcrypt).'|'.base64_encode($iv);

		return $encoded;
	}
	
    /**
     * Decrypt data (MCrypt PHP library).
     * @static
     * @param string encrypt
     * @param string key
     * @return string
     * @example
     * \SyncSystemNS\FunctionsCrypto::MCryptDecrypt("testing encryption", "")
     */
	static function MCryptDecrypt($decrypt, $key): string
	{
		$decrypt = explode('|', $decrypt.'|');
		$decoded = base64_decode($decrypt[0]);
		$iv = base64_decode($decrypt[1]);
		if (strlen($iv)!==mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC)) {
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
     * @param float cryptographyType 1 = data + system default key
     * @return string
     * @example
     * \SyncSystemNS\FunctionsCrypto::DefuseEncrypt('testing encryption', $GLOBALS['configCryptChaveDefusePHPEncryptionRandomKey'])
     */
	static function DefuseEncrypt($strData, $strKey, $cryptographyType = 1): string
	{
		// $cryptographyType: 1 = data + system default key
		$strReturn = "";
		
		
		// Data + system default key.
		if($cryptographyType == 1)
		{
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
     * @param string strCipher
     * @param string strChave
     * @param float cryptographyType 1 = data + system default key
     * @return string
     * @example
     * \SyncSystemNS\FunctionsCrypto::DefuseEncrypt('testing encryption', $GLOBALS['configCryptChaveDefusePHPEncryptionRandomKey'])
     */
	static function DefuseDecrypt($strCipher, $strKey, $cryptographyType = 1): string
	{
		//$cryptographyType: 1 = data + system default key
		$strReturn = "";
		
		if($strCipher <> "")
		{
			// Data + system default key.
			if($cryptographyType == 1)
			{
				$defuseKeyDefault = \Defuse\Crypto\Key::loadFromAsciiSafeString($strKey);
				$strReturn = \Defuse\Crypto\Crypto::decrypt($strCipher, $defuseKeyDefault);
			}
		}
		
		return $strReturn;
	}
	//**************************************************************************************
}

?>