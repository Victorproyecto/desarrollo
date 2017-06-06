<?php
session_start();
include('/config/index.php');

if(isset($_SESSION['username'])):
    echo 'Estas logeado </br>';
    
    echo '</br>';
    echo '</br>';

    echo 'Quieres registrar  un libro ? <a href="formlibros.php">Registrar !</a> ';
    echo '</br>';
    echo '</br>';
    echo ' <a href="formlibros.php">Lista de libros!</a> ';
    echo ' <a href="logout.php">Logout</a>';
    
 
    
     
    
else:
    if(isset($_POST['login'])):
        if(empty($_POST['username']) || empty($_POST['password'])):
            echo 'No dejes campos en blanco';
        elseif(strlen($_POST['username']) > 20):
            echo 'El usuario no puede tener mas de 20 caracteres';
        elseif(strlen($_POST['password']) > 20):
            echo 'La contraseña no puede tener mas de 20 caracteres';
        else:
            $login = $connection->prepare("SELECT username FROM user WHERE username = :username AND password = :password");
            $login->bindParam(':username',$_POST['username']);
            $login->bindParam(':password',crypt($_POST['password'], '$2a$07$rieh3693fjarjeuf38cw27fg2$'));
            $login->execute();
            if($login = $login->fetch(PDO::FETCH_ASSOC)):
                $_SESSION['username'] = $_POST['username'];
                header("Location: formlibros.php");
            else:
                echo 'Datos incorrectos';
            endif;
        endif;
    endif;
    echo '<form action="" method="post">
        <input name="username" placeholder="Username"><br>
        <input name="password" type="password" placeholder="Password"><br>
        <input name="login" type="submit">
    </form>
    
    <a href="register.php">Registrate</a>';
endif;
?>