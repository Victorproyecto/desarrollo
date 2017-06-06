<?php
session_start();
include('/config/index.php');

if(isset($_SESSION['username'])):
    header('Location: index.php');
else:
    if(isset($_POST['register'])):
        if(empty($_POST['username']) || empty($_POST['password'])):
            echo 'No dejes campos en blanco';
        elseif(strlen($_POST['username']) > 20):
            echo 'El usuario no puede tener mas de 20 caracteres';
        else:
            $user = $connection->prepare("SELECT username FROM user WHERE username = :username");
            $user->bindParam(':username',$_POST['username']);
            $user->execute();
            if($user->fetch(PDO::FETCH_ASSOC)):
                echo 'El usuario ya existe';
            elseif(strlen($_POST['password']) > 20):
                echo 'La contraseña no puede tener mas de 20 caracteres';
            elseif($_POST['password'] <> $_POST['password2']):
                echo 'Las contraseñas no coinciden';
            else:
                $register = $connection->prepare("INSERT INTO user(id,username,password,mail) VALUES ('',:username,:password,:mail)");
                $register->bindParam(':username',$_POST['username']);
                $register->bindParam(':password',crypt($_POST['password'], '$2a$07$rieh3693fjarjeuf38cw27fg2$'));
                $register->bindParam(':mail', $_POST['mail']);
                $register->execute();
                if($register->rowCount() > 0):
                    $_SESSION['username'] = $_POST['username'];
                 session_start();
                    session_destroy();
                
                    header('Location: index.php');
                else:
                    echo 'Ha ocurrido un error';
                endif;
            endif;
        endif;
    endif;
    echo '<form action="" method="post">
        <input name="username" placeholder="Username"><br>
        <input name="mail" placeholder="Mail"><br>
        <input name="password" type="password" placeholder="Password"><br>
        <input name="password2" type="password" placeholder="Vuelve a ingresar la contraseña"><br>
        <input name="register" type="submit">
    </form>';
endif;
?>