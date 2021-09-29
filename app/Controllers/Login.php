<?php 
  
    namespace App\Controllers; 
    use CodeIgniter\Controller;
    use App\Models\UserAccount\AutUserModel;
    use App\Controllers\LineLogin;
    use \Firebase\JWT\JWT;
    class Login extends Controller{
     
        public function index(){
           
        }
        public function line(){
         $line =  new LineLogin();
         $url =  $line->getLink(7);
        
         return redirect()->to($url);
        }
        public function linec(){ 
            $line =  new LineLogin();
            $code = $this->request->getPostGet('code');
            $state = $this->request->getPostGet('state');
            $token = $line->token($code,$state); // curl เพื่อขอ id_token
            $token = json_decode($token,true);
           
            // $jwt = $token->id_token;
            // $arr_token = explode('.',$token['id_token']);
            // $tokenw = $line->verify($token['id_token']); // curl เพื่อขอ id_token
            // echo '<pre>';
            // print_r(base64_decode($arr_token[1]));
            // echo '</pre>';
            // echo '<pre>';
            // print_r(base64_decode($arr_token[0]));
            // echo '</pre>';
            $decoded = JWT::decode($token['id_token'],'ce53c663443c4fc1067b129252040f55', array('HS256'));
            echo '<pre>';
            print_r($decoded);
            echo '</pre>';
           
        //    echo base64_decode($token->id_token);
         // echo  $token->token ;
            exit;


        //   
        
        }
        
        public function login(){
            

            $session = session();
            helper(['func']);
            $db = db_connect();
            $username = $this->request->getVar('username');
            $password =  $this->request->getVar('userpassword');

            $userModel = new AutUserModel();
            $data = $userModel->where('username',$username)->first();
            if($data){
                if(password_verify($password,$data['password'])){

                    $res_menu = $db->query("WITH MENU AS (
                                            SELECT
                                                menu_id,
                                                menu_name_th,
                                                menu_code,
                                                menu_img,
                                                parent_id,
                                                menu_type,
                                                menu_url,
                                                menu_seq,
                                                RIGHT (
                                                    replicate('0', 5) + CONVERT (VARCHAR(MAX), menu_seq),
                                                    5
                                                ) AS HIERARCHY
                                            FROM
                                                aut_menu
                                            WHERE
                                                parent_id = 0
                                            
                                            UNION ALL
                                                SELECT
                                                    t.menu_id,
                                                    t.menu_name_th,
                                                    t.menu_code,
                                                    t.menu_img,
                                                    t.parent_id,
                                                    t.menu_type,
                                                    t.menu_url,
                                                    t.menu_seq,
                                                    c.HIERARCHY + '.' + RIGHT (
                                                        replicate('0', 5) + CONVERT (VARCHAR(MAX), t.menu_seq),
                                                        5
                                                    ) AS HIERARCHY
                                                FROM
                                                    aut_menu t
                                                INNER JOIN MENU c ON t.parent_id = c.menu_id
                                            
                                        ) SELECT
                                            *
                                        FROM
                                            MENU
                                        ORDER BY
                                            HIERARCHY")->getResultArray();
                    $arr_menu = array();
                    $arr = 0;                        
                    foreach($res_menu as $key => $val){
                        $mid = $val['parent_id'];
                        //if(in_array($M['MENU_ID'],$arr_group2)){
                          $arr_menu[$mid][$arr]['menu_id'] = $val['menu_id'];
                          $arr_menu[$mid][$arr]['parent_id'] = $val['parent_id'];
                          $arr_menu[$mid][$arr]['menu_name_th'] = $val['menu_name_th'];
                          $arr_menu[$mid][$arr]['menu_code'] = $val['menu_code'];
                          $arr_menu[$mid][$arr]['menu_type'] = $val['menu_type'];
                          $arr_menu[$mid][$arr]['menu_img'] = $val['menu_img'];
                          $arr_menu[$mid][$arr]['menu_url'] = ($val['menu_url'])?$val['menu_url']:'#';
                         
                          $arr++;
                        //} 
                    }
                  
                    $ses = array(
                                'user_id' => $data['user_id'],
                                'user_name' => $data['password'],
                                // 'prefix_id' => $data['prefix_id'],
                                // 'user_fristname' => $data['user_fristname'],
                                // 'user_lastname' => $data['user_lastname'],
                                'user_email' => $data['email'],
                                'user_displaymenu' => 'A',
                                'user_menu' => $arr_menu,
                                'loggin' => true,
                            );
                   $session->set($ses);	
                  return redirect()->to('/menu');
                }else{
                    return redirect()->to('/signin');
                }
            }else{
                return redirect()->to('/signin');
            }
        }
        public function logout(){
            $session = session();
            $session->destroy();
            return redirect()->to('/signin');
        }
    }

?>