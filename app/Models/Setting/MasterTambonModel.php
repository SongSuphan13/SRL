<?php 
    namespace App\Models\Setting;

    use CodeIgniter\Model;
    
    class MasterTambonModel extends Model{
     
        protected $table  = 'master_tambon';
        protected $primaryKey = 'tambon_id';
        protected $useAutoIncrement = true;

        protected $allowedFields =  [
                                         'amphure_code'
                                        ,'province_code'
                                        ,'tambon_code'
                                        ,'tambon_name_th'
                                        ,'tambon_name_en'
                                        ,'zipcode'
                                    ];

    }
    
    
?>