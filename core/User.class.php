<?php
/**
 *  User class used to load any user from the database
 */
$rootpath = $_SERVER['DOCUMENT_ROOT'];
include_once($rootpath.'/core/table.class.php');
 
class User extends table {

    protected $UsrID;
    protected $FName;
    protected $LName;
    protected $Password;
    protected $Email;
    protected $table = "Users";
    protected $IDName = "UsrID";
    private $key; //private in order to dont be used from table class update.
    private $key_size;

	/**
     * 
     */
    public function __construct() {
        $key = pack('H*', "bcb04b7e103a0cd8b54763051cef08bc55abe029fdebae5e1d417e2ffb2a00a3");
        $key_size = strlen($key);
    }

	/**
     * Function to return the User ID
     * 
	 * @return int UsrID 
     */
    public function getUsrID() {
        return $this->UsrID;
    }

	/**
     * Function to set the User ID
     */
    public function setUsrID($uID) {
        $this->UsrID = $uID;
    }

	/**
     * Function to return the User Name. FName + LName
     * 
	 * @return string Name 
     */
    public function getName() {
        return $this->FName . " " . $this->LName;
    }

    /**
     * Function to encrypt the password variable
     * 
     */
    public function encryptPass() {
        $plaintext = trim($this->Password);
        # create a random IV to use with CBC encoding
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);

        # (because of default zero padding)
        $ciphertext = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $this->key, $plaintext, MCRYPT_MODE_CBC, $iv);

        # prepend the IV for it to be available for decryption
        $ciphertext = $iv . $ciphertext;

        # encode the resulting cipher text so it can be represented by a string
        $ciphertext_base64 = base64_encode($ciphertext);

        $this->Password = $ciphertext_base64;
    }

    /**
     * Function to decrypt the password variable
     * 
     * @param int $filtID
     * array $Arr -> array to filter
     * @return array filtered 
     */
    public function decryptPass() {
        $ciphertext_dec = base64_decode($this->Password);

        # retrieves the IV, iv_size should be created using mcrypt_get_iv_size()
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
        $iv_dec = substr($ciphertext_dec, 0, $iv_size);

        # retrieves the cipher text (everything except the $iv_size in the front)
        $ciphertext_dec = substr($ciphertext_dec, $iv_size);

        # may remove 00h valued characters from end of plain text
        $plaintext_dec = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $this->key, $ciphertext_dec, MCRYPT_MODE_CBC, $iv_dec);
        $this->Password = trim($plaintext_dec);
    }

}

?>