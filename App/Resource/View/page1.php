<!DOCTYPE html>
<html>
    <head>
    <meta charset='utf-8'/>
    </head>
    <body>
        <h1 style='text-align: center;'> Lista de <?= $type ?> ! </h1>
        <table border='1'>
            <thead>
                <tr> 
                    <th> Nome: </th>
                    <th> Email: </th>
                    <th> Telefone: </th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($clients as $client): ?>
                    <tr>
                        <td> <?= $client['nome'] ?> </td>
                        <td> <?= $client['email'] ?> </td>
                        <td> <?= $client['phone'] ?> </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
    </body>
</html>
        