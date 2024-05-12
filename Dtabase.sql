DROP TABLE permisos;
DROP TABLE usuarios;
DROP TABLE pantallas;
DROP TABLE roles;

CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) UNIQUE NOT NULL,
    contrasena VARCHAR(255) NOT NULL,
    rol_id INT NOT NULL,
    FOREIGN KEY (rol_id) REFERENCES roles(id)
);

CREATE TABLE pantallas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);

CREATE TABLE permisos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    rol_id INT NOT NULL,
    pantalla_id INT NOT NULL,
    nivel_permiso INT NOT NULL,
    FOREIGN KEY (rol_id) REFERENCES roles(id),
    FOREIGN KEY (pantalla_id) REFERENCES pantallas(id)
);

INSERT INTO pantallas (nombre) VALUES ('login');
INSERT INTO pantallas (nombre) VALUES ('menu_001');
INSERT INTO pantallas (nombre) VALUES ('usuario_abm');
INSERT INTO pantallas (nombre) VALUES ('usuario_permisos');
INSERT INTO roles (nombre) VALUES ('solo_turnos');
INSERT INTO roles (nombre) VALUES ('administrador');
INSERT INTO usuarios (usuario,contrasena,rol_id) values ('paciente','password01',1);
INSERT INTO usuarios (usuario,contrasena,rol_id) values ('administrador','password01',2);
INSERT INTO permisos (rol_id,pantalla_id,nivel_permiso) values (1,1,1);
INSERT INTO permisos (rol_id,pantalla_id,nivel_permiso) values (2,1,1);
INSERT INTO permisos (rol_id,pantalla_id,nivel_permiso) values (1,2,1);
INSERT INTO permisos (rol_id,pantalla_id,nivel_permiso) values (2,2,2);
INSERT INTO permisos (rol_id,pantalla_id,nivel_permiso) values (1,3,0);
INSERT INTO permisos (rol_id,pantalla_id,nivel_permiso) values (2,3,2);
INSERT INTO permisos (rol_id,pantalla_id,nivel_permiso) values (1,4,0);
INSERT INTO permisos (rol_id,pantalla_id,nivel_permiso) values (2,4,2);

drop procedure if exists VerificarUsuario;

delimiter //
create procedure VerificarUsuario(
    IN t_usuario varchar(50),
    IN t_contrasena varchar(255),
    OUT existe boolean
)
begin
    declare t_count INT;
    select count(*) into t_count from usuarios where usuario = t_usuario and contrasena = t_contrasena;
    if t_count > 0 then
        set existe = TRUE;
    else
        set existe = FALSE;
    end if;
end 
//

-- Para probar una salida verdadera y una falsa
-- CALL VerificarUsuario('pirulo', 'gomezd01', @existe);
-- SELECT @existe;
-- CALL VerificarUsuario('paciente', 'password01', @existe);
-- SELECT @existe;