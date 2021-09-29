<?php 
    namespace App\Models\Warehouse;

    use CodeIgniter\Model;
    
    class MasterWarehouseModel extends Model{
     
        protected $table  = 'master_warehouse';
        protected $primaryKey = 'wh_id';
        protected $useAutoIncrement = true;
        // protected $returnType     = 'array';

        protected $allowedFields = [
                                         'wh_name_th'
                                        ,'wh_name_en'
                                        ,'address'
                                        ,'province_id'
                                        ,'amphure_id'
                                        ,'tambon_id'
                                        ,'zipcode'
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