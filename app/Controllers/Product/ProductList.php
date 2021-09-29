<?php 
    namespace App\Controllers\Product;

    use CodeIgniter\Controller;
    use App\Models\Product\ProductListModel;
    use App\Models\Product\ProductTypeModel;

    class ProductList extends Controller{
        protected $screenNo,$menuCode;

        public function __construct() {
            helper(['func']);
            $this->screenNo = 'A14';
            $this->menuCode = 14;
        }

        public function index(){

            $limit = ($this->request->getPostGet('limit'))?$this->request->getPostGet('limit'):20;
            $offset = ($this->request->getPostGet('page'))?$this->request->getPostGet('page'):1;
            $s_prodtype_code = trim($this->request->getPostGet('s_prodtype_code'));  
            $s_prodtype_name_th = trim($this->request->getPostGet('s_prodtype_name_th'));  
            $s_prodtype_name_en = trim($this->request->getPostGet('s_prodtype_name_en'));  
            $s_active_status = trim($this->request->getPostGet('s_active_status'));  

            $productTypeModel = new ProductTypeModel();
            if($s_prodtype_code != ''){
                $productTypeModel->where('prodtype_code',$s_prodtype_code);
                
            }
            if($s_prodtype_name_th != ''){
                $productTypeModel->like('prodtype_name_th',$s_prodtype_name_th);
            }
            if($s_prodtype_name_en != ''){
                $productTypeModel->like('province_name_en',$s_prodtype_name_en);
            }
            if($s_active_status != ''){
                $productTypeModel->where('active_status',$s_active_status);
            }
            $productTypeModel->where('delete_flag',1);
            $num_rows = $productTypeModel->countAllResults(false);
            $limit = ($limit=='all')?$num_rows:$limit;

            $data = array (
                        'isContent' => true,
                        'isHeader' => true,
                        'isTopNav' => true,
                        'isFooter' => true,
                        'isBreadcrumb' => true,
                        'isForm' => false,
                        'menuCode' => $this->menuCode,
                        'screenNo' => $this->screenNo,
                        'isPost' => $this->request->getPostGet(),
                        'objData' => $productTypeModel->paginate($limit,'',$offset),
                        'numRows'  => $num_rows,
                        'pagination' => $productTypeModel->pager->makeLinks($offset,$limit,$num_rows),
                     );
            echo view('product/product_list/index',$data);
        }
        public function create($id=0){

            $data = array (
                'isContent' => true,
                'isHeader' => true,
                'isTopNav' => true,
                'isFooter' => true,
                'isBreadcrumb' => true,
                'isForm' => '(เพิ่มข้อมูล)',
                'menuCode' => $this->menuCode,
                'screenNo' =>$this->screenNo,
            );
            if($id){
                $productTypeModel = new ProductTypeModel();
                $data['objData'] = $productTypeModel->where('prodtype_id',$id)->first();
                $data['isForm'] = '(แก้ไขข้อมูล)';
                $data['screenNo'] = $this->screenNo.'-'.$id;
            }
            echo view('product/product_list/create',$data);
        }
        public function view($id=0){

        }
        public function save(){
        
        }
        public function delete($id=null){

        }


    }
?>