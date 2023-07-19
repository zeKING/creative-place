<?php


/**
 * Created by PhpStorm.
 * User: shohsanam
 * Date: 5/20/16
 * Time: 2:12 PM
 */

include "config.php";
include "CoreConfig.php";
include "DatabaseFactory.php";




$task = (!isset($_GET['task']) || empty($_GET['task']) ? 'index' : $_GET['task']);



function getPaydoc($merchant_trans_id)
{

    if(empty($merchant_trans_id)) return false;

    $database = DatabaseFactory::getFactory()->getConnection();
    $sql = "SELECT * FROM cart_u  WHERE id = :id LIMIT 1";
    $query = $database->prepare($sql);

    $query->execute(
        array(
            ':id' => $merchant_trans_id
        )
    );

    return  $query->fetch();
}

function updatePaydoc($merchant_trans_id, $status){
    if(empty($merchant_trans_id)) return false;

    $database = DatabaseFactory::getFactory()->getConnection();

    $sql = "UPDATE cart_u SET status = :status WHERE id = :id  LIMIT 1";

    $query = $database->prepare($sql);

    $params = array(
        ':status' => $status,
        ':id' => $merchant_trans_id
    );

    $query->execute($params);

    if ($query->rowCount() == 1) {
        return true;
    }

    return false;
}



$data = $_POST;

if($data && count($data) > 0){

    $results =  array(
        'click_paydoc_id' => (empty($data['click_paydoc_id']) ? '' : $data['click_paydoc_id']),
        'click_trans_id' => (empty($data['click_trans_id']) ? '' : $data['click_trans_id']),
        'service_id' =>  (empty($data['service_id']) ? '' : $data['service_id']),
        'merchant_trans_id' => (empty($data['merchant_trans_id']) ? '' : $data['merchant_trans_id']),
        'merchant_prepare_id' => (empty($data['merchant_prepare_id']) ? $data['click_paydoc_id'] : $data['merchant_prepare_id']),
        'amount' => (empty($data['amount']) ? '' : round(str_replace(',', '.', $data['amount']), 2)),
        'action' => $data['action'],
        'error' =>  $data['error'],
        'error_note' => (empty($data['error_note']) ? '' : $data['error_note']),
        'sign_time' => (empty($data['sign_time']) ? '' : $data['sign_time']),
        'sign_string' => (empty($data['sign_string']) ? '' : $data['sign_string']),
    );

} else {
    echo 'OSG PAYMENT API v 0.1';
}



if($task == "prepare"){

    if(!empty($results['merchant_trans_id'])){

        $paydoc = getPaydoc($results['merchant_trans_id']);




        if($paydoc && property_exists($paydoc, 'merchant_trans_id') && !empty($paydoc->id)){

            if($paydoc->id != $results['merchant_trans_id'])
            {
                $results['error'] = '-5';
            }

           /*elseif($paydoc->sign_string !=$results['sign_string']){
               $results['error'] = '-1';
			}*/
            else {
                $results['error'] = '0';
                $results['merchant_confirm_id'] = $results['click_paydoc_id'];
            }

        } else {
            $results['error'] = '-5';
        }
 
    } else {
        $results['error'] = '-5';
    }

    echo json_encode($results);
    
    file_put_contents("logs/prepare.txt", json_encode($results ).PHP_EOL);

    file_put_contents("logs/log.txt", 'pre'.json_encode($paydoc ).'-'.json_encode($results).PHP_EOL, FILE_APPEND);

}





elseif ($task == "complete"){


    if(!empty($results['merchant_trans_id'])){

        $paydoc = getPaydoc($results['merchant_trans_id']);

        if($paydoc && property_exists($paydoc, 'merchant_trans_id') && !empty($paydoc->id)){


            if($paydoc->id != $results['merchant_trans_id'])
            {
                $results['error'] = '-6';
            }

            elseif($paydoc->price != $results['amount']){
                $results['error'] = '-2';
            }

            elseif($paydoc->status == 'complete' &&  $results['error'] == '0'){
                $results['error'] = '-4';

                $results['merchant_confirm_id'] = $results['click_paydoc_id'];

            }
            elseif($paydoc->status == 'complete' &&  $results['error'] == '-1'){
                $results['error'] = '-4';

                $results['merchant_confirm_id'] = $results['click_paydoc_id'];

            }
            elseif($results['error'] == '-5017'){
                $update = updatePaydoc($paydoc->id, 'canceled');
                $results['error']= '-9';
            }

            elseif($paydoc->status == 'canceled' && $results['error'] == '-5017'){
                $results['error']= '-9';
            }

            elseif($paydoc->status == 'canceled' && $results['error'] == '0'){
                $results['error']= '-9';
            }

//            elseif($paydoc->sign_string !=$results['sign_string']) {
//                $results['error'] = '-1';
//
//            }

            else {

                $update = updatePaydoc($paydoc->id, 'complete');
                $results['error'] = '0';
                $results['merchant_confirm_id'] = $results['click_paydoc_id'];


            }


        }
        else {
            $results['error'] = '-6';
        }

    } else {
        $results['error'] = '-6';
    }

    echo json_encode($results);

    file_put_contents("logs/complete.txt", json_encode($_POST).PHP_EOL);

    file_put_contents("logs/log.txt", 'com'.json_encode($paydoc ).'-'.json_encode($results).PHP_EOL, FILE_APPEND);


} else {
    echo 'OSG PAYMENT API v 0.1';
}