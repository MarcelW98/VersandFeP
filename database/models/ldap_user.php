<?php
    class LDAPUser {
        protected $samaccountname;
        protected $description;
        protected $givenname;
        protected $sn;
        protected $group;
        protected $telephonenumber;
        protected $department;
        protected $physicaldeliveryofficename;
        protected $mail;
        protected $displayname;

        function __construct($samaccountname, $description, $givenname, $sn, $group, $telephonenumber, $department, $physicaldeliveryofficename, $mail, $displayname) {
            $this->samaccountname = $samaccountname;
            $this->description = $description;
            $this->givenname = $givenname;
            $this->sn = $sn;
            $this->group = $group;
            $this->telephonenumber = $telephonenumber;
            $this->department = $department;
            $this->physicaldeliveryofficename = $physicaldeliveryofficename;
            $this->mail = $mail;
            $this->displayname = $displayname;
        }

        public function getNTUser() {
            return $this->samaccountname;
        }

        public function getKostenstelle() {
            return $this->description;
        }

        public function getVorname() {
            return $this->givenname;
        }

        public function getNachname() {
            return $this->sn;
        }

        public function getGroup() {
            return $this->group;
        }

        public function getTelefonnummer() {
            return $this->telephonenumber;
        }

        public function getAbteilung() {
            return $this->department;
        }

        public function getBau() {
            return $this->physicaldeliveryofficename;
        }
        
        public function getMail() {
            return $this->mail;
        }

        public function getdisplayname() {
            return $this->displayname;
        }
    }
    
?>