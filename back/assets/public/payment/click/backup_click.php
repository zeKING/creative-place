<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Click extends Public_Controller
{
	public function __construct()
	{
		  parent::__construct();	
      $this->load->model('cart_model', 'cart_m');
      /*SERVICE_ID:2820
SECRET_KEY: CR@K5cfS8gD4dAST!Y$d-OK8
MERCHANT USER ID:2935
https://active.uz/ru/active/click/prepare
https://active.uz/ru/active/click/complete*/
	}
	public function prepare()
	{
      $data = $_POST; 
      $results =  array(
          'click_trans_id' => $data['click_trans_id'],
          'service_id' => $data['service_id'],
          'merchant_trans_id' => $data['merchant_trans_id'],
          'merchant_prepare_id' => $data['merchant_prepare_id'],
          'amount' => $data['amount'],
          'action' => $data['action'],
          'error' => $data['error'],
          'error_note' => $data['error_note'],
          'sign_time' => $data['sign_time'],
          'sign_string' => $data['sign_string'],
          'click_paydoc_id' => $data['click_paydoc_id'],
        );
          // Не найден пользователь/заказ
          
          $trans_id = getCart_u($results['merchant_trans_id'], 'id');
          $sign_string =  getCart_u($results['merchant_trans_id'], 'sign_string');
          
         if($results['merchant_trans_id'] == $trans_id){
            $this->updatePaydoc($results['merchant_trans_id'], $results['click_paydoc_id'], $results['merchant_prepare_id'], $results['action'], $results['error']);
                    
                if($results['sign_string'] != $sign_string &&  $results['error'] == '0'){
                   $results['error']= '-1'; //'-1'
                   $results['merchant_prepare_id'] = $results['merchant_trans_id']; 
                   echo json_encode($results);
                } else {
                  $results['error']= 0;
                  echo json_encode($results);
                }
                    
         } else {
           
              $results['error']= '-5';
              echo json_encode($results);
         }
         
         
        
//click_trans_id
/*click_paydoc_id
merchant_prepare_id
amount
action
error*/
      	//enum('pending', 'canceled', 'denied', 'processed')
}
    public function updatePaydoc($trans_id, $paydoc_id, $prepare_id, $action, $error){
        $results =  array(          
          'merchant_trans_id' => $trans_id,
          'merchant_prepare_id' => $prepare_id,
          'action' => $action,
          'error' => $error,
          'click_paydoc_id' => $paydoc_id,
        );
          $this->cart_m->save($results, $trans_id);
    }
  public function complete( )
	{
        $data = $_POST;
        
         $results =  array(
            'click_trans_id' => $data['click_trans_id'],
            'service_id' => $data['service_id'],
            'merchant_trans_id' => $data['merchant_trans_id'],
            'merchant_prepare_id' => $data['merchant_prepare_id'],
            
            'amount' => $data['amount'],
            'action' => $data['action'],
            'error' => $data['error'],
            'error_note' => $data['error_note'],
            'sign_time' => $data['sign_time'],
            'sign_string' => $data['sign_string'],
            'click_paydoc_id' => $data['click_paydoc_id'],
        );
        
         $results['merchant_confirm_id'] = $results['click_paydoc_id']; 
        
        $trans_id = getCart_u($results['merchant_trans_id'], 'id');
        $sign_string =  getCart_u($results['merchant_trans_id'], 'sign_string');
          
         if($results['merchant_trans_id'] == $trans_id && $results['action'] == 1){
            $this->updatePaydoc($results['merchant_trans_id'], $results['click_paydoc_id'], $results['merchant_prepare_id'], $results['action'], $results['error']);
           
            $amount = preg_replace("([^0-9])", "", getCart_u($results['merchant_trans_id'], 'price'));
            // $amount = 500;
            
             
            if($results['amount'] != $amount  &&  $results['error'] == '0'){
                  
                  $results['error']= '-2';
                  echo json_encode($results);
             
              
            }
                
           
            elseif( $results['merchant_prepare_id'] != getCart_u($results['merchant_trans_id'], 'merchant_prepare_id')){
                  $results['error']= -6;
                    echo json_encode($results);
                }
                
                elseif( $results['error'] == '-5017'){
                  $results['error']= -9;
                    echo json_encode($results);
                    
                     $status = array(
                  'status' => 'canceled',
                  );
                  
                  UpdateStatus($results['merchant_trans_id'], $status);
                }
                
                
                
                 elseif($results['error'] == '0' &&  getCart_u($results['merchant_trans_id'], 'status') == 'canceled'){
                    $results['error']= -9;
                    echo json_encode($results);
                }
            
             elseif($results['error'] == '-1' &&  getCart_u($results['merchant_trans_id'], 'status') == 'complete'){
                    $results['error']= -4;
                    echo json_encode($results);
                }
            
            
             elseif( $results['click_paydoc_id'] == getCart_u($results['merchant_trans_id'], 'click_paydoc_id') && getCart_u($results['merchant_trans_id'], 'status') == 'complete'){
                  $results['error']= -4;
                    echo json_encode($results);
                }
                
                 elseif($results['sign_string'] != $sign_string &&  $results['error'] == '0'){
                   $results['error']= '-1'; //'-1'
                 
                   echo json_encode($results);
            }  
                
                
                 
            
            
            
            
            
           else {
                  $results['error']= 0;
                  
                  echo json_encode($results);
                  
                  $status = array(
                  'status' => 'complete',
                  );
                  
                  UpdateStatus($results['merchant_trans_id'], $status);
           }
                
               
              
                
           
          
          
         } else {
          
            $results['error']= '-6';
            echo json_encode($results);
         }
         
         
        
        
        
  }
}