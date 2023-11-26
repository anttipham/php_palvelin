CREATE TABLE TILIT (
    tilinumero INT PRIMARY KEY,
    omistaja VARCHAR(255) NOT NULL,
    summa DECIMAL(10, 2) NOT NULL
);

INSERT INTO TILIT (tilinumero, omistaja, summa)
    VALUES (1, 'Matti Meikäläinen', 1000.00),
           (2, 'Maija Meikäläinen', 2000.00),
           (3, 'Mikko Mallikas', 3000.00);
