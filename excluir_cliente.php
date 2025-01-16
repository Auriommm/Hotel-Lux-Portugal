<?php
// Conexão com o banco de dados
require_once 'config.php';
?>

<?php


// Verificar se o ID foi passado via GET e se é numérico
if (isset($_GET['idcliente']) && is_numeric($_GET['idcliente'])) {
    
   
    $cliente_id = $_GET['idcliente'];
    
        
    
    // Executar a query de exclusão
        $query = "DELETE FROM cliente WHERE id = $cliente_id";
    
        
    
      
    if ($conn->query($query) === TRUE) {
            
           
    echo "Cliente excluído com sucesso!";
        } 
        
    else {
            
            
    echo "Erro ao excluir cliente: " . $conn->error;
        }
    } else {
        
      
    echo "ID inválido ou não especificado.";
    }
    
    // Fechar a conexão com o banco de dados
    
    $
    $conn->close();
    ?>
?>
