<?php 
    namespace App\Models;

    use CodeIgniter\Model;
    
    class AutGroupMenuModel extends Model{
     
        protected $table  = 'aut_group_menu';
        protected $primaryKey = 'aut_id';
        protected $useAutoIncrement = true;

        protected $allowedFields = [    'group_id'
                                        ,'menu_id'
                                        ,'user_add'
                                        ,'user_edit'
                                        ,'user_view'
                                        ,'user_delete'
                                        ,'user_approve'
                                        ,'user_print'
                                        ,'user_type'
                                    ];
      
        
    }
?>