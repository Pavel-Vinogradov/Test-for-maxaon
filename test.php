
<?php


// set function 


function config($optionName, $defaultValue = null)
{
  $arr1 =  [
    "site_name" => "My site",
    "site_url" => "http://mysite.ru",
    "db" => [
      "user" => "admin",
      "password" => "ifghigh8y8rt347ghi",
      "name" => "my_database"
    ],
    "app" => [
      "services" => [
        "resizer" => [
          "prefer_format" => "webp",
          "fallback_format" => "jpeg"
        ]
      ]
    ]
  ]; // 
  $length = strlen($optionName); // Определение длины значения веденного нами $optionName
  $arr2 = ''; // Переменная,  которая выдаеет функция
  $keysCount = 0; // Число ключей в $optionName
  $keys[] = ''; // Массив, хранящий все ключи из $optionName
  $tempArray[] = ''; // Массив, хранящий вложенные массивы из $optionName
  // Заполнение массива $keys ключами из $optionName
  for ($i = 0; $i < $length; $i++) {
    if ($optionName[$i] !== '.') {
      $keys[$keysCount] .= $optionName[$i];
    } else {
      $keysCount++;
    }
  }

  // Присваивание значения настройки из $optionName к $arr2
  if ($keysCount !== 0) {
    $tempArray[0] = $arr1[$keys[0]];
    for ($i = 1; $i <= $keysCount; $i++) {
      $tempArray[$i] = $tempArray[$i - 1][$keys[$i]];
    }
    $arr2 = $tempArray[$keysCount];
  } else {
    $arr2 = $arr1[$optionName];
  }

  /*  Проверка ввода $defaultValue
      и совпадения $optionName
      с названиями настроек */
  if ($arr2 === null) {
    if ($defaultValue !== null) {
      return $defaultValue;
    } else {
      throw new Exception('Несуществующий параметр ' . $optionName);
    }
  }
  return $arr2;
}



echo config("site_url"); // http://mysite.ru

echo config("db.user"); // admin

echo config("app.services.resizer.fallback_format"); // jpeg

echo config("db.host", "localhost"); // localhost
