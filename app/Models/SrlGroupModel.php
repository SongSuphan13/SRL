<?php 
    namespace App\Models;

    use CodeIgniter\Model;
    
    class SrlGroupModel extends Model{
     
        protected $table  = 'srl_group';
        protected $primaryKey = 'group_id';
        protected $useAutoIncrement = true;

        protected $allowedFields = ['seq','group_name','active_status'];
        
        // protected $useTimestamps = true;
        // protected $createdField  = 'create_date';
        // protected $updatedField  = 'update_date';
        
    }
    

?>