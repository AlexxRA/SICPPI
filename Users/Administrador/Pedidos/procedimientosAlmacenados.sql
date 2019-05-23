DELIMITER //
	CREATE PROCEDURE procesar_venta(id_cliente int)
	BEGIN
	DECLARE lastPedido INT;
	DECLARE numRegistros INT;
	DECLARE montoTotal DECIMAL(10,2) DEFAULT 0;
	DECLARE a INT;
	SET a = 1;

	SET numRegistros = (SELECT COUNT(*) FROM detalle_pedido_temp);

	IF numRegistros > 0 THEN
		INSERT INTO pedido(rfc,entregado) VALUES(id_cliente,false);
		SET lastPedido = LAST_INSERT_ID();
		INSERT INTO detalle_pedido(id_pedido,cantprod,subtotal,id_producto) SELECT (lastPedido) AS id_pedido, cantprod, subtotal, id_producto FROM detalle_pedido_temp;

		SET total = (SELECT SUM(subtotal) FROM detalle_pedido_temp);
		UPDATE pedido SET total=total WHERE id_pedido = lastPedido;
		DELETE FROM detalle_pedido_temp;

		SELECT * FROM pedidos WHERE id_pedido = lastPedido;

	ELSE
		SELECT 0;
	END IF;
END;//
DELIMITER ;



