<?php 
    namespace App\Models\Setting;

    use CodeIgniter\Model;
    
    class MasterAmphureModel extends Model{
     
        protected $table  = 'master_amphure';
        protected $primaryKey = 'amphure_id';
        protected $useAutoIncrement = true;

        protected $allowedFields =  [
                                         'amphure_code'
                                        ,'amphure_name_th'
                                        ,'amphure_name_en'
                                        ,'province_code'
                                    ]; 
         
        public function get_name_code($province_code){
            $db = db_connect(); 
            $builder = $db->table('master_amphure');
            $builder->select('amphure_name_th');
            $builder->where('amphure_code',$province_code);
            $query =  $builder->get()->getRowArray(); 
            return $query['amphure_name_th'];
        } 
    }
    
    
?>