<?php 
    namespace App\Models\Product;

    use CodeIgniter\Model;
    
    class ChemicalGroupModel extends Model{
     
        protected $table  = 'chemical_group';
        protected $primaryKey = 'chemi_id';
        protected $useAutoIncrement = true;

        protected $allowedFields =  [
                                         'chemi_seq'
                                        ,'chemi_code'
                                        ,'chemi_name_th'
                                        ,'chemi_name_en'
                                        ,'chemi_nameshort_th'
                                        ,'chemi_nameshort_en'
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