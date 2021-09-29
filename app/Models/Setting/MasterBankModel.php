<?php 
    namespace App\Models\Setting;

    use CodeIgniter\Model;
    
    class MasterBankModel extends Model{
     
        protected $table  = 'master_bank';
        protected $primaryKey = 'bank_id';
        protected $useAutoIncrement = true;
        // protected $returnType     = 'array';

        protected $allowedFields = [
                                        'seq'
                                        ,'bank_code'
                                        ,'bank_name_th'
                                        ,'bank_name_en'
                                        ,'bank_nameshort_th'
                                        ,'bank_nameshort_en'
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