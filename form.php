<?php

echo "<link rel='stylesheet' href='style.css'>";

header('Content-Type: text/html; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $messages = array();

  if (!empty($_COOKIE['save'])) {
    setcookie('save', '', 100000);
    $messages[] = 'Спасибо, результаты сохранены.';
  }

  $errors = array();
  $errors['fio'] = !empty($_COOKIE['fio_error']);
  $errors['year'] = !empty($_COOKIE['year_error']);
  $errors['email'] = !empty($_COOKIE['email_error']);
  $errors['gender'] = !empty($_COOKIE['gender_error']);
  $errors['superpower'] = !empty($_COOKIE['superpower_error']);
  $errors['limbs'] = !empty($_COOKIE['limbs_error']);
  $errors['check'] = !empty($_COOKIE['check_error']);
  $errors['text'] = !empty($_COOKIE['text_error']);

  if ($errors['fio']) {
    setcookie('fio_error', '', 100000);
    $messages[] = '<div class="error">Заполните имя.</div>';
  }
  if ($errors['email']) {
      setcookie('email_error', '', 100000);
      $messages[] = '<div class="error">Заполните email.</div>';
  }
  if ($errors['year']) {
      setcookie('year_error', '', 100000);
      $messages[] = '<div class="error">Выберите год.</div>';
  }
  
  if ($errors['gender']) {
      setcookie('gender_error', '', 100000);
      $messages[] = '<div class="error">Выберите пол.</div>';
  }
  if ($errors['limbs']) {
      setcookie('limbs_error', '', 100000);
      $messages[] = '<div class="error">Выберите конечности.</div>';
  }
  if ($errors['superpower']) {
      setcookie('superpower_error', '', 100000);
      $messages[] = '<div class="error">Выберите сверхспособность.</div>';
  }
  if ($errors['text']) {
      setcookie('text_error', '', 100000);
      $messages[] = '<div class="error">Впишите био.</div>';
  }
  if ($errors['check']) {
      setcookie('check_error', '', 100000);
      $messages[] = '<div class="pas error">Ознакомтесь с контрактом.</div>';
  }
  $values = array();
  $values['fio'] = empty($_COOKIE['fio_value']) ? '' : $_COOKIE['fio_value'];
  $values['email'] = empty($_COOKIE['email_value']) ? '' : $_COOKIE['email_value'];
  $values['year'] = empty($_COOKIE['year_value']) ? '' : $_COOKIE['year_value'];
  $values['gender'] = empty($_COOKIE['gender_value']) ? '' : $_COOKIE['gender_value'];
  $values['superpower'] = empty($_COOKIE['superpower_value']) ? '' : $_COOKIE['superpower_value'];
  $values['limbs'] = empty($_COOKIE['limbs_value']) ? '' : $_COOKIE['limbs_value'];
  $values['text'] = empty($_COOKIE['text_value']) ? '' : $_COOKIE['text_value'];
  $values['check'] = empty($_COOKIE['check_value']) ? 0 : $_COOKIE['check_value'];

  include('form.php');
}
else {
  $errors = FALSE;
  if (empty($_POST['fio'])) {
    setcookie('fio_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    setcookie('fio_value', $_POST['fio'], time() + 30 * 24 * 60 * 60);
  }
  
  $errors = FALSE;
  if (empty($_POST['email'])) {
      setcookie('email_error', '1', time() + 24 * 60 * 60);
      $errors = TRUE;
  }
  else {
      setcookie('email_value', $_POST['email'], time() + 30 * 24 * 60 * 60);
  }
  
  if (($_POST['year'] < 1922) || !is_numeric($_POST['year']) || !preg_match('/^\d+$/', $_POST['year'])) {
      setcookie('year_error', '1', time() + 24 * 60 * 60);
      $errors = TRUE;
  } else {
      setcookie('year_value', $_POST['year'], time() + 30 * 24 * 60 * 60);
  }
  if (empty($_POST['gender'])) {
      setcookie('gender_error', '1', time() + 24 * 60 * 60);
      $errors = TRUE;
  } else {
      setcookie('gender_value', $_POST['gender'], time() + 30 * 24 * 60 * 60);
  }
  if (empty($_POST['superpower'])) {
      setcookie('superpower_error', '1', time() + 24 * 60 * 60);
      $errors = TRUE;
  } else {
      setcookie('superpower_value', $_POST['superpower'], time() + 30 * 24 * 60 * 60);
  }

  if (empty($_POST['text'])) {
      setcookie('text_error', '1', time() + 24 * 60 * 60);
      $errors = TRUE;
  } else {
      setcookie('text_value', $_POST['text'], time() + 30 * 24 * 60 * 60);
  }
  if (empty($_POST['limbs'])) {
      setcookie('limbs_error', '1', time() + 24 * 60 * 60);
      $errors = TRUE;
  } else {
      setcookie('limbs_value', $_POST['limbs'], time() + 30 * 24 * 60 * 60);
  }
  if(!isset($_POST['check'])){
      setcookie('check_error','1',time()+  24 * 60 * 60);
      setcookie('check_value', '', 100000);
      $errors=TRUE;
  }
  else{
      setcookie('check_value', TRUE,time()+ 12 * 30 * 24 * 60 * 60);
      setcookie('check_error','',100000);
  }

  if ($errors) {
    header('Location: index.php');
    exit();
  }
  else {
    setcookie('fio_error', '', 100000);
    setcookie('email_error', '', 100000);
    setcookie('year_error', '', 100000);
    setcookie('gender_error', '',100000);
    setcookie('limbs_error', '',100000);
    setcookie('superpower_error', '', 100000);
    setcookie('text_error', '', 100000);
    setcookie('check_error', '', 100000);
  }

  $user = 'u52806';
  $pass = '7974759';
  $db = new PDO('mysql:host=localhost;dbname=u52813', $user, $pass, [PDO::ATTR_PERSISTENT => true]);
  
  try{
      $stmt = $db->prepare("REPLACE INTO abilities (id,name_of_ability) VALUES (10, 'Бессмертие'), (20, 'Прохождение сквозь стены'), (30, 'Левитация')");
      $stmt-> execute();
  }
  catch (PDOException $e) {
      print('Error : ' . $e->getMessage());
      exit();
  }
  try {
      $stmt = $db->prepare("INSERT INTO form SET name = ?, year = ?, email = ?, pol = ?, limbs = ?, bio = ?");
      $stmt -> execute([$_POST['fio'], $_POST['year'], $_POST['email'],$_POST['gender'], $_POST['limbs'], $_POST['text']]);
  }
  catch(PDOException $e){
      print('Error : ' . $e->getMessage());
      exit();
  }
  
  $id = $db->lastInsertId();
  
  try{
      $stmt = $db->prepare("REPLACE INTO Super (id_s,name) VALUES (10, 'God'), (20, 'fly'), (30, 'idclip'), (40, 'fireball')");
      $stmt-> execute();
  }
  catch (PDOException $e) {
      print('Error : ' . $e->getMessage());
      exit();
  }
  
  try {
      $stmt = $db->prepare("INSERT INTO Sform SET id_per = ?, id_sup = ?");
      foreach ($_POST['superpower'] as $ability) {
          if ($ability=='t')
          {$stmt -> execute([$id, 10]);}
          else if ($ability=='b')
          {$stmt -> execute([$id, 20]);}
          else if ($ability=='c')
          {$stmt -> execute([$id, 30]);}
          else if ($ability=='p')
          {$stmt -> execute([$id, 30]);}
      }
  }
  catch(PDOException $e) {
      print('Error : ' . $e->getMessage());
      exit();
  }
  
  setcookie('save', '1');

  header('Location: index.php');
}
