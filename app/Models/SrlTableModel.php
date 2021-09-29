<?php 
    namespace App\Models;

    use CodeIgniter\Model;
    
    class SrlTableModel extends Model{
     
        protected $table  = 'srl_table';
        protected $primaryKey = 'table_id';
        protected $useAutoIncrement = true;

        protected $allowedFields = ['seq'
                                    ,'group_id'
                                    ,'table_name_th'
                                    ,'table_detail'
                                    ,'table_name'
                                    ,'table_pk'
                                    ,'active_status'
                                ];
                                
    }

?>