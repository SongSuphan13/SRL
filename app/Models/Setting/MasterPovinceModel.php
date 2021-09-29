<?php 
    namespace App\Models\Setting;

    use CodeIgniter\Model;
    
    class MasterPovinceModel extends Model{
     
        protected $table  = 'master_province';
        protected $primaryKey = 'province_id';
        protected $useAutoIncrement = true;

        protected $allowedFields =  [
                                        'province_code'
                                        ,'province_name_th'
                                        ,'province_name_en'
                                        ,'province_status'
                                    ]; 
                                    
        public function get_name_code($province_code){
            $db = db_connect(); 
            $builder = $db->table('master_province');
            $builder->select('province_name_th');
            $builder->where('province_code',$province_code);
            $query =  $builder->get()->getRowArray(); 
            return $query['province_name_th'];
        } 
    }
    

?>