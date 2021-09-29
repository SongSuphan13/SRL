<?php 
    namespace App\Models\Setting;

    use CodeIgniter\Model;
    
    class MasterPrefixModel extends Model{
        protected $table  = 'master_prefix';
        protected $primaryKey = 'prefix_id';
        protected $useAutoIncrement = true;
        protected $returnType     = 'array';

        protected $allowedFields = [
                                        'seq'
                                        ,'prefix_name_th'
                                        ,'prefix_name_en'
                                        ,'prefix_nameshort_th'
                                        ,'prefix_nameshort_en'
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





