<?php
 class PaketzentrumUser {
    public $id;
    public $user_name;
    public $user_type;

    function __construct($id, $user_name, $user_type) {
        $this->id = intval($id);
        $this->user_name = $user_name;
        $this->user_type = $user_type;
    }

    public function getType(): string {
        return $this->user_type;
    }
   

    public static function fromAssoc(Array $assoc): PaketzentrumUser {
        try {
            return new PaketzentrumUser($assoc["user_id"], $assoc["user_user_name"], $assoc["user_user_type"]);
        } catch (Exception $e) {
            throw new Exception("PaketzentrumUser failed to build from assoc.");
        }
    }
 }
?>