DELIMITER $$
CREATE TRIGGER insertinorders 
    AFTER INSERT ON payment
    FOR EACH ROW 
BEGIN
    INSERT INTO orders(order_id,order_amount,order_transaction,order_status,order_currency,payment_id,date) VALUES('',new.payment,new.email,'completed','USD',new.pay_id,new.date);
               
END$$
DELIMITER ;



DELIMITER $$
CREATE TRIGGER initialRate 
    AFTER INSERT ON products
    FOR EACH ROW 
BEGIN
    INSERT INTO rate(rate_id,product_id,rate) VALUES('',new.product_id,0);
               
END$$

DELIMITER ;

DELIMITER $$

CREATE or REPLACE TRIGGER updaterating 
    AFTER INSERT ON cart
    FOR EACH ROW 
BEGIN
    DECLARE x int;
    set x = new.product_id;
    UPDATE rate as r set r.rate = new.quantity where r.product_id = x;
               
END$$
DELIMITER ;
