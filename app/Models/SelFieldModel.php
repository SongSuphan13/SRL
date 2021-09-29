<?php 
    namespace App\Models;

    use CodeIgniter\Model;
    
    class SelFieldModel extends Model{
     
        protected $table  = 'srl_field';
        protected $primaryKey = 'field_id';
        protected $useAutoIncrement = true;

        protected $allowedFields = ['srl_field_label','srl_field_name','srl_field_type','srl_field_length'];
        
        // protected $useTimestamps = true;
        // protected $createdField  = 'create_date';
        // protected $updatedField  = 'update_date';
        
    }
    
    
    
    
    
    
    
?>