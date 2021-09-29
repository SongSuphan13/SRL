<?php 
    namespace App\Models\UserAccount;

    use CodeIgniter\Model;
    
    class AutUserModel extends Model{
     
        protected $table  = 'aut_user';
        protected $primaryKey = 'user_id';
        protected $useAutoIncrement = true;
        protected $returnType     = 'array';
        protected $allowedFields = [
                                     'username'
                                    ,'password'
                                    ,'prefix_id'
                                    ,'fristname'
                                    ,'lastname'
                                    ,'email'
                                    ,'active_status'
                                    ,'delete_flag'
                                    ,'create_by'
                                    ,'create_date'
                                    ,'update_by'
                                    ,'update_date'
                                ];
        protected $useTimestamps = true;
        protected $createdField  = 'create_date';
        protected $updatedField  = 'update_date';
        
    }

?>