<?php 
    namespace App\Models\Product;

    use CodeIgniter\Model;
    
    class ProductTypeModel extends Model{
     
        protected $table  = 'product_type';
        protected $primaryKey = 'prodtype_id';
        protected $useAutoIncrement = true;

        protected $allowedFields =  [
                                         'prodtype_seq'
                                        ,'prodtype_code'
                                        ,'prodtype_name_th'
                                        ,'prodtype_name_en'
                                        ,'prodtype_nameshort_th'
                                        ,'prodtype_nameshort_en'
                                        ,'active_status'
                                        ,'delete_flag'
                                        ,'create_by'
                                        ,'update_by'
                                    ]; 
                                    
        protected $useTimestamps = true;
        protected $createdField  = 'create_date';
        protected $updatedField  = 'update_date';
    }

?>