DROP TABLE IF EXISTS usuarios CASCADE;

CREATE TABLE usuarios (
    id            BIGSERIAL     PRIMARY KEY
  , nombre        VARCHAR(255)  NOT NULL
  , dni           VARCHAR(255)  NOT NULL UNIQUE
  , password      VARCHAR(255)  NOT NULL
);


DROP TABLE IF EXISTS reservas CASCADE;

CREATE TABLE reservas (
    id           BIGSERIAL     PRIMARY KEY
  , usuario_id   BIGINT        REFERENCES usuarios (id)
                               ON DELETE CASCADE
                               ON UPDATE CASCADE
  , fecha        TIMESTAMP(0)  UNIQUE
);
