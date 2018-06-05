INSERT INTO usuarios (nombre, dni, password) VALUES
    ('Antonio', '123123123', crypt('1234', gen_salt('bf', 13)))
  , ('pepe', '123123124', crypt('pepe', gen_salt('bf', 13)))
  , ('Manuel', '123123125', crypt('1234', gen_salt('bf', 13)))
;


INSERT INTO reservas (usuario_id, fecha) VALUES
    (1, '2018/6/9 10:00')
  , (2, '2018/6/9 11:00')
  , (3, '2018/6/9 12:00')
  , (1, '2018/6/9 13:00')
;
