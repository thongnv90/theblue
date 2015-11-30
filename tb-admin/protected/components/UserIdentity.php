<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
         private $_id;
	public function authenticate()
	{
//		$users=array(
//			// username => password
//			'demo'=>'demo',
//			'admin'=>'admin',
//		);
//		if(!isset($users[$this->username]))
//			$this->errorCode=self::ERROR_USERNAME_INVALID;
//		elseif($users[$this->username]!==$this->password)
//			$this->errorCode=self::ERROR_PASSWORD_INVALID;
//		else
//			$this->errorCode=self::ERROR_NONE;
//		return !$this->errorCode;
            $username = strtolower($this->username);
            $password = $this->password;
            $member = Members::model()->find('LOWER(pr_member_email)=?',array($username));
            //$user = Account::model()->find('LOWER(account_email)=?',array($username));
            if($member===null)
                $this->errorCode=  self::ERROR_PASSWORD_INVALID;
            elseif(Members::model()->generaSalt($password) != $member->pr_member_password || $member->pr_member_status==0)
                $this->errorCode=  self::ERROR_PASSWORD_INVALID;
            else
            {
                $this->_id = $member->pr_primary_key;
                $this->errorCode=  self::ERROR_NONE;
            }
            return !$this->errorCode;
	}
        public function getID()
        {
            return $this->_id;
        }
}