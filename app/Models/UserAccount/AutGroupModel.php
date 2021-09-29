<?php 
    namespace App\Models\UserAccount;

    use CodeIgniter\Model;
    
    class AutGroupModel extends Model{
     
        protected $table  = 'aut_group';
        protected $primaryKey = 'group_id';
        protected $useAutoIncrement = true;
        protected $returnType     = 'array';
        protected $allowedFields = [
                                         'group_seq'
                                        ,'group_code'
                                        ,'group_name_th'
                                        ,'group_name_en'
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