<?php

class PHP_AES_Cipher {
    //Keys
    private static $OPENSSL_CIPHER_NAME = "aes-128-cbc"; 	//Name of OpenSSL Cipher 
    private static $CIPHER_KEY_LEN = 16; 					//128 bits
    
	
    /**
     * Encrypt data using AES Cipher (CBC) with 128 bit key
     * @param data - data to encrypt
     * @return encryptedData data in base64 encoding with iv attached at end after a :
     */
    static function encrypt($data) {
        $key = '1A2sK0da85gvZ5t8'; 	#Same as in JAVA
        $iv = 'E5ur37Azl8p2n40w'; 	#Same as in JAVA
        if (strlen($key) < PHP_AES_Cipher::$CIPHER_KEY_LEN) {
            $key = str_pad("$key", PHP_AES_Cipher::$CIPHER_KEY_LEN, "0"); 	//0 pad to len 16
        } else if (strlen($key) > PHP_AES_Cipher::$CIPHER_KEY_LEN) {
            $key = substr($data, 0, PHP_AES_Cipher::$CIPHER_KEY_LEN); 		//Truncate to 16 bytes
        }
        
        $encodedEncryptedData = base64_encode(openssl_encrypt($data, PHP_AES_Cipher::$OPENSSL_CIPHER_NAME, $key, OPENSSL_RAW_DATA, $iv));
        $encodedIV = base64_encode($iv);
        $encryptedPayload = $encodedEncryptedData.":".$encodedIV;   
        return $encryptedPayload;     
    }
	
	
	 /**
     * Decrypt data using AES Cipher (CBC) with 128 bit key
     * @param data - encrypted data with iv at the end separate by :
     * @return decrypted data string
     */ 
    static function decrypt($data) {
        $key = '1A2sK0da85gvZ5t8'; 	#Same as in JAVA
        if (strlen($key) < PHP_AES_Cipher::$CIPHER_KEY_LEN) {
            $key = str_pad("$key", PHP_AES_Cipher::$CIPHER_KEY_LEN, "0"); 	//0 pad to len 16
        } else if (strlen($key) > PHP_AES_Cipher::$CIPHER_KEY_LEN) {
            $key = substr($data, 0, PHP_AES_Cipher::$CIPHER_KEY_LEN); 		//Truncate to 16 bytes
        }
        $parts = explode(':', $data); //Separate Encrypted data from iv.
        // print_r($parts);
        $decryptedData = openssl_decrypt(base64_decode($parts[0]), PHP_AES_Cipher::$OPENSSL_CIPHER_NAME, $key, OPENSSL_RAW_DATA, base64_decode($parts[1]));     
        return $decryptedData;
    }
}



//Test
// $data = "Carlomagnu";
// echo "Data: $data <br><br>";

// $encrypted = PHP_AES_Cipher::encrypt($key, $iv, $data);
// echo "Encrypted: $encrypted <br><br>";

// $decrypted = PHP_AES_Cipher::decrypt($key, $encrypted);
// echo "Decrypted: $decrypted <br><br>";

?>


