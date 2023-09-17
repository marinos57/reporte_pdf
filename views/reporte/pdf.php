<table border="1">
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Cantidad</th>
            <th>Producto</th>
            <th>Cliente</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($ventas as $venta) : ?>
            <tr>
                <td><?= $venta->fecha ?></td>
                <td><?= $venta->cantidad ?></td>
                <td><?= $venta->producto ?></td>
                <td><?= $venta->cliente ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
