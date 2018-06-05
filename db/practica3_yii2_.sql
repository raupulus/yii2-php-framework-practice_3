DROP TABLE IF EXISTS usuarios;

CREATE TABLE usuarios (
    id            BIGSERIAL     PRIMARY KEY
  , nombre        VARCHAR(255)  NOT NULL
  , dni           VARCHAR(255)  NOT NULL UNIQUE
  , password      VARCHAR(255)  NOT NULL
);


DROP TABLE IF EXISTS reservas;

CREATE TABLE reservas (
    id           BIGSERIAL     PRIMARY KEY
  , usuario_id   BIGINT
  , fecha        TIMESTAMP(0)  UNIQUE
);
