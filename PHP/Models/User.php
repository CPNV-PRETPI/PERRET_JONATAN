<?php 


    class User {

        private string $username;

        /**
         * @return string
         */
        public function getUsername(): string
        {
            return $this->username;
        }

        /**
         * @param string $username
         */
        public function setUsername(string $username): void
        {
            $this->username = $username;
        }

        private string $secure_string;

        /**
         * @return string
         */
        public function getSecureString(): string
        {
            return $this->secure_string;
        }

        /**
         * @param string $secure_string
         */
        public function setSecureString(string $secure_string): void
        {
            $this->secure_string = $secure_string;
        }

        private string $policies;

        /**
         * @return string
         */
        public function getPolicies(): string
        {
            return $this->policies;
        }

        /**
         * @param string $policies
         */
        public function setPolicies(string $policies): void
        {
            $this->policies = $policies;
        }

        private string $login_date;

        /**
         * @return string
         */
        public function getLoginDate(): string
        {
            return $this->login_date;
        }

        /**
         * @param string $login_date
         */
        public function setLoginDate(string $login_date): void
        {
            $this->login_date = $login_date;
        }

        /**
         * @param string $username
         * @param string $secure_string
         * @param string $policies
         * @param string $login_date
         */
        public function __construct(string $username, string $secure_string, string $policies, string $login_date = null)
        {
            $this->username = $username;
            $this->secure_string = $secure_string;
            $this->policies = $policies;
            $this->login_date = $login_date == null ? date("Y-m-d H:i:s") : $login_date;
        }
    }
?>