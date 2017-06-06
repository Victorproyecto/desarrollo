<?php


include('/config/index.php');

if(isset($_POST['reglibros'])):
    
    
             $sql = $connection->prepare("INSERT INTO libros (id,titulo,autor,paginas) VALUES ('',:titulo,:autor,:paginas)");
             $sql->bindParam(':titulo',$_POST['titulo']);
             $sql->bindParam(':autor',$_POST['autor']);
             $sql->bindParam(':paginas', $_POST['paginas']);
             $sql->execute();
             header('location:listalibros.php');
             endif;
               
        echo '<form action="" method="post">
        <input name="titulo" placeholder="Titulo"><br>
        <input name="autor" placeholder="Autor"><br>
        <input name="paginas" placeholder="Paginas"><br>
        <input name="reglibros" type="submit">
        </form>';
     
                
echo 'Quieres ver la lista de libros registrados ?? <a href="listalibros.php">Listalibros</a> ';