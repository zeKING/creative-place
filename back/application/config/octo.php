<?php    
    
    $config['prepare_payment'] = 'https://secure.octo.uz/prepare_payment';
    $config['octo_shop_id'] = '4547'; // Уникальный ID магазина (доступен в ЛК магазина)
    $config['octo_secret'] = '4877ea38-6166-45f8-acf7-086131042111'; // Персональный секретный ключ магазина, который генерируется в ЛК магазина.
    $config['auto_capture'] = true; // Если true, то ПС Octo будет автоматически подтверждать списание средств со счета покупателя. Если false, то после авторизации платежа Octo будет ожидать от магазина дополнительного подтверждения окончательного завершения транзакции. По умолчанию false.
    $config['test'] = true; // Тестовый платёж true или нет false
    $config['currency'] = 'UZS'; // Валюта. Варианты: “USD”, “UZS”
    $config['ttl'] = 60; //Время жизни платежа с момента создания (в минутах). По истечению этого времени провести платеж будет невозможно.  
    $config['description'] = 'FreeTravel №';
?>