-- mysql> ALTER USER 'root'@'localhost' IDENTIFIED BY 'testing01';
-- mysql> ALTER USER 'pp2'@'%' IDENTIFIED BY 'Testing_2024';

-- use pp2;
use sql10707793;

DROP TABLE control_horario;
DROP TABLE agendas;
DROP TABLE pagos;
DROP TABLE recetas;
DROP TABLE informes;
DROP TABLE muestras;
DROP TABLE turnos;
DROP TABLE pacientes;
DROP TABLE fichas_medicas;
DROP TABLE historias_clinicas;
DROP TABLE resultados;
DROP TABLE estudios;
DROP TABLE horarios;
DROP TABLE usuarios;
DROP TABLE consultorios;
DROP TABLE profesionales;
DROP TABLE hdt;
DROP TABLE servicios;
DROP TABLE obras_sociales;
DROP TABLE administrativos;
DROP TABLE insumos;

CREATE TABLE usuarios (
    idUsuario INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) UNIQUE NOT NULL,
    contrasena VARCHAR(255) NOT NULL,
    rol INT NOT NULL
);

INSERT INTO usuarios (usuario,contrasena,rol) values 
('administrativo','password01',2),
('CarlosGonzalez','password01',1),
('MariaLopez','password01',1),
('JuanMartinez','password01',1),
('LauraGomez','password01',1),
('LuciaRodriguez','password01',1),
('PedroFernandez','password01',1),
('AnaDiaz','password01',1),
('SofiaPerez','password01',1),
('MartinSuarez','password01',1),
('JulietaLopez','password01',1);

CREATE TABLE servicios (
    idServicio INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    tiempo INT,
    horarioInicio INT,
    horarioFin INT,
    precio FLOAT
);

INSERT INTO servicios (nombre, tiempo, horarioInicio, horarioFin, precio) VALUES
('Emergencias', 15, 7, 17, 150.00),
('Medicina Interna', 15, 7, 17, 150.00),
('Cirugia General', 15, 7, 17, 150.00),
('Pediatria', 15, 7, 17, 150.00),
('Ginecologia y Obstetricia', 15, 7, 17, 150.00),
('Cardiologia', 15, 7, 17, 150.00),
('Neurologia', 15, 7, 17, 150.00),
('Oftalmologia', 15, 7, 17, 150.00),
('Otorrinolaringologia', 15, 7, 17, 150.00),
('Ortopedia y Traumatologia', 15, 7, 17, 150.00),
('Salud Mental', 30, 7, 17, 150.00),
('Urologia', 15, 7, 17, 150.00),
('Gastroenterologia', 15, 7, 17, 150.00),
('Neumologia', 15, 7, 17, 150.00),
('Endocrinologia', 15, 7, 17, 150.00),
('Hematologia', 15, 7, 17, 150.00),
('Reumatologia', 15, 7, 17, 150.00),
('Radiologia', 15, 7, 17, 150.00),
('Anestesiologia', 15, 7, 17, 150.00),
('Unidad de Cuidados Intensivos (UCI)', 15, 7, 17, 150.00),
('Fisio - Kinesiologia', 25, 7, 17, 150.00),
('Laboratorio Clinico', 15, 7, 17, 150.00),
('Farmacia Hospitalaria', 15, 7, 17, 150.00),
('Medicina Fisica y Rehabilitacion', 15, 7, 17, 150.00),
('Medicina del Dolor y Cuidados Paliativos', 15, 7, 17, 150.00),
('Infectologia', 15, 7, 17, 150.00),
('Unidad de Cuidados Coronarios', 15, 7, 17, 150.00),
('Unidad de Quemados', 15, 7, 17, 150.00),
('Neonatologia', 15, 7, 17, 150.00);

CREATE TABLE hdt(
    idServicio INT,
    horario VARCHAR (5),
    sobreturno BOOLEAN,
    constraint fk_hdt_s foreign key (idServicio) references servicios(idServicio)
);
INSERT INTO (idServicio, horario, sobreturno) VALUES
(1,'07:00',0),
(1,'07:25',0),
(1,'07:50',0),
(1,'08:15',0),
(1,'08:40',0),
(1,'09:05',0),
(1,'09:30',0),
(1,'09:55',0),
(1,'10:20',0),
(1,'10:45',0),
(1,'11:10',0),
(1,'11:35',0),
(1,'12:45',0),
(1,'13:10',0),
(1,'13:35',0),
(1,'14:00',0),
(1,'14:25',0),
(1,'14:50',0),
(1,'15:15',0),
(1,'15:40',0),
(1,'16:05',0),
(1,'16:30',0),
(1,'16:55',0),
(1,'07:00',1),
(1,'08:00',1),
(1,'09:00',1),
(1,'10:00',1),
(1,'11:00',1),
(1,'13:00',1),
(1,'14:00',1),
(1,'15:00',1),
(1,'16:00',1),
(1,'17:00',1),
(2,'07:00',1),
(2,'08:00',1),
(2,'09:00',1),
(2,'10:00',1),
(2,'11:00',1),
(2,'13:00',1),
(2,'14:00',1),
(2,'15:00',1),
(2,'16:00',1),
(2,'17:00',1),
(2,'07:00',0),
(2,'07:30',0),
(2,'08:00',0),
(2,'08:30',0),
(2,'09:00',0),
(2,'09:30',0),
(2,'10:00',0),
(2,'10:30',0),
(2,'11:00',0),
(2,'11:30',0),
(2,'13:00',0),
(2,'13:30',0),
(2,'14:00',0),
(2,'14:30',0),
(2,'15:00',0),
(2,'15:30',0),
(2,'16:00',0),
(2,'16:30',0),
(2,'17:00',0),
(3,'07:00',0),
(3,'07:15',0),
(3,'07:30',0),
(3,'07:45',0),
(3,'08:00',0),
(3,'08:15',0),
(3,'08:30',0),
(3,'08:45',0),
(3,'09:00',0),
(3,'09:15',0),
(3,'09:30',0),
(3,'09:45',0),
(3,'10:00',0),
(3,'10:15',0),
(3,'10:30',0),
(3,'10:45',0),
(3,'11:00',0),
(3,'11:15',0),
(3,'11:30',0),
(3,'11:45',0),
(3,'13:00',0),
(3,'13:15',0),
(3,'13:30',0),
(3,'13:45',0),
(3,'14:00',0),
(3,'14:15',0),
(3,'14:30',0),
(3,'14:45',0),
(3,'15:00',0),
(3,'15:15',0),
(3,'15:30',0),
(3,'15:45',0),
(3,'16:00',0),
(3,'16:15',0),
(3,'16:30',0),
(3,'16:45',0),
(3,'07:00',1),
(3,'08:00',1),
(3,'09:00',1),
(3,'10:00',1),
(3,'11:00',1),
(3,'13:00',1),
(3,'14:00',1),
(3,'15:00',1),
(3,'16:00',1),
(3,'17:00',1);

CREATE TABLE profesionales (
    idProfesional INT AUTO_INCREMENT PRIMARY KEY,
    idServicio INT,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    dni VARCHAR(50) NOT NULL,
    telefono VARCHAR(50) NOT NULL,
    domicilio VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    numeroMatricula VARCHAR(50) NOT NULL,
    horarioIngreso INT,
    horarioEgreso INT,
    inicioActividad DATE,
    finActividad DATETIME DEFAULT NULL,
    constraint fk_profesionales_s foreign key (idServicio) references servicios(idServicio)
);

INSERT INTO profesionales (idServicio, nombre, apellido, dni, telefono, domicilio, email, numeroMatricula, horarioIngreso, horarioEgreso, inicioActividad) VALUES
(1, 'Juan', 'Perez', '12345678A', '555-1234', 'Calle Falsa 123', 'juan.perez@example.com', 'MAT-001', 9, 18, '2012-01-01'),
(2, 'Maria', 'Gomez', '87654321B', '555-5678', 'Avenida Siempre Viva 742', 'maria.gomez@example.com', 'MAT-002', 9, 18, '2012-01-02'),
(3, 'Luis', 'Martinez', '11223344C', '555-9101', 'Calle de la Luna 456', 'luis.martinez@example.com', 'MAT-003', 9, 18, '2012-01-03'),
(4, 'Ana', 'Lopez', '55667788D', '555-1122', 'Calle del Sol 789', 'ana.lopez@example.com', 'MAT-004', 9, 18, '2012-01-04'),
(5, 'Carlos', 'Fernandez', '33445566E', '555-3344', 'Calle de las Estrellas 101', 'carlos.fernandez@example.com', 'MAT-005', 9, 18, '2012-01-05'),
(6, 'Sofia', 'Rodriguez', '99887766F', '555-5566', 'Calle de los Pinos 102', 'sofia.rodriguez@example.com', 'MAT-006', 9, 18, '2012-01-06'),
(7, 'Miguel', 'Garcia', '22334455G', '555-7788', 'Calle de los Olmos 103', 'miguel.garcia@example.com', 'MAT-007', 9, 18, '2012-01-07'),
(8, 'Lucia', 'Diaz', '44332211H', '555-9900', 'Calle de los Robles 104', 'lucia.diaz@example.com', 'MAT-008', 9, 18, '2012-01-08'),
(9, 'Fernando', 'Sanchez', '66554433I', '555-2211', 'Calle de los Cerezos 105', 'fernando.sanchez@example.com', 'MAT-009', 9, 18, '2012-01-09'),
(10, 'Elena', 'Morales', '77889900J', '555-3322', 'Calle de los Manzanos 106', 'elena.morales@example.com', 'MAT-010', 9, 18, '2012-01-10'),
(11, 'Raul', 'Romero', '88990011K', '555-4433', 'Calle de los Almendros 107', 'raul.romero@example.com', 'MAT-011', 9, 18, '2012-01-11'),
(12, 'Patricia', 'Hernandez', '99001122L', '555-5544', 'Calle de los Naranjos 108', 'patricia.hernandez@example.com', 'MAT-012', 9, 18, '2012-01-12'),
(13, 'Javier', 'Ruiz', '10101010M', '555-6655', 'Calle de los Sauces 109', 'javier.ruiz@example.com', 'MAT-013', 9, 18, '2012-01-13'),
(14, 'Claudia', 'Ramos', '20202020N', '555-7766', 'Calle de los Cedros 110', 'claudia.ramos@example.com', 'MAT-014', 9, 18, '2012-01-14'),
(15, 'Victor', 'Gonzalez', '30303030O', '555-8877', 'Calle de los alamos 111', 'victor.gonzalez@example.com', 'MAT-015', 9, 18, '2012-01-15'),
(16, 'Adriana', 'Torres', '40404040P', '555-9988', 'Calle de los Avellanos 112', 'adriana.torres@example.com', 'MAT-016', 9, 18, '2012-01-16'),
(17, 'Oscar', 'Vargas', '50505050Q', '555-1100', 'Calle de los Arces 113', 'oscar.vargas@example.com', 'MAT-017', 9, 18, '2012-01-17'),
(18, 'Laura', 'Reyes', '60606060R', '555-2211', 'Calle de los Fresnos 114', 'laura.reyes@example.com', 'MAT-018', 9, 18, '2012-01-18'),
(19, 'Diego', 'Ortega', '70707070S', '555-3322', 'Calle de los Olmos 115', 'diego.ortega@example.com', 'MAT-019', 9, 18, '2012-01-19'),
(20, 'Carolina', 'Mendoza', '80808080T', '555-4433', 'Calle de los Castaños 116', 'carolina.mendoza@example.com', 'MAT-020', 9, 18, '2012-01-20');


CREATE TABLE insumos (
    idInsumo INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) UNIQUE,
    cantidadMinima INT,
    cantidadExistente INT,
    descripcion VARCHAR(50),
    observaciones VARCHAR(50)
);

INSERT INTO insumos (nombre, cantidadMinima, cantidadExistente, descripcion, observaciones) VALUES
('Guantes', 275, 385, 'Guantes de latex', 'Caja grande'),
('Mascarillas', 1200, 1680, 'Mascarillas quirurgicas', 'Paquete de 50'),
('Jeringas', 450, 630, 'Jeringas desechables', '10 ml'),
('Agujas Hipodermicas', 1350, 1890, 'Agujas para inyeccion', 'Gauge 23'),
('Algodon', 800, 1120, 'Algodon para curaciones', 'Paquete de 500g'),
('Alcohol', 250, 350, 'Alcohol isopropilico', 'Botella de 1L'),
('Tiritas', 1100, 1540, 'Tiritas adhesivas', 'Paquete de 100'),
('Esparadrapo', 600, 840, 'Cinta adhesiva medica', 'Rollo de 5m'),
('Batas Medicas', 300, 420, 'Batas desechables', 'Talla unica'),
('Gasas', 900, 1260, 'Gasas esteriles', 'Paquete de 100'),
('Termometros', 700, 980, 'Termometros digitales', 'Para uso oral'),
('Oxigeno', 1300, 1820, 'Tanques de oxigeno', 'Capacidad 10L'),
('Desinfectante', 500, 700, 'Desinfectante de superficies', 'Botella de 500ml'),
('Tensiometros', 400, 560, 'Tensiometros manuales', 'Con estetoscopio'),
('Estetoscopios', 600, 840, 'Estetoscopios', 'Doble campana'),
('Vendas', 750, 1050, 'Vendas elasticas', '5m x 10cm'),
('Bisturies', 850, 1190, 'Bisturies desechables', 'Con hoja Nº 11'),
('Suturas', 950, 1330, 'Suturas absorbibles', '0 Vicryl'),
('Tubos de Ensayo', 1150, 1610, 'Tubos de ensayo', 'De vidrio 10ml'),
('Hisopos', 300, 420, 'Hisopos esteriles', 'Paquete de 200'),
('Lancetas', 400, 560, 'Lancetas para glucosa', 'Paquete de 100'),
('Reactivos', 700, 980, 'Reactivos para analisis', 'Diversos tipos'),
('Micro pipetas', 500, 700, 'Micro pipetas', '10-100 µl'),
('Placas de Petri', 350, 490, 'Placas de Petri', '100x15mm'),
('Frascos Recolectores', 250, 350, 'Frascos recolectores', 'Para muestras de orina'),
('Solucion Salina', 600, 840, 'Solucion salina', 'Bolsa de 1L'),
('Tiras Reactivas', 800, 1120, 'Tiras reactivas', 'Para glucosa en sangre'),
('Guantes Esteriles', 950, 1330, 'Guantes esterilizados', 'Talla mediana'),
('Marcadores de Laboratorio', 1000, 1400, 'Marcadores permanentes', 'Para tubos de ensayo'),
('Cubrecalzado', 300, 420, 'Cubrecalzado desechables', 'Paquete de 100'),
('Bolsas de Bioseguridad', 750, 1050, 'Bolsas de bioseguridad', 'Rojas de 10L'),
('Contenedores de Residuos', 800, 1120, 'Contenedores plasticos', 'Para objetos punzantes'),
('Tijeras Medicas', 350, 490, 'Tijeras de acero inoxidable', '15cm'),
('Toallas de Papel', 600, 840, 'Toallas de papel', 'Paquete de 100'),
('Jabon Antiseptico', 700, 980, 'Jabon antiseptico', 'Botella de 500ml'),
('Lamparillas de Alcohol', 450, 630, 'Lamparillas para esterilizacion', 'De vidrio'),
('Gasas Vaselinadas', 500, 700, 'Gasas impregnadas en vaselina', '10x10cm'),
('Tiras de pH', 300, 420, 'Tiras reactivas de pH', 'Paquete de 100'),
('Papel de Filtracion', 200, 280, 'Papel de filtro', 'Diametro 90mm');

CREATE TABLE consultorios (
    idConsultorio INT AUTO_INCREMENT PRIMARY KEY,
    idProfesional INT,
    idInsumo INT,
    fechaHoraIngreso DATETIME,
    fechaHoraEgreso DATETIME,
    idServicio INT,
    constraint fk_consultorios_p foreign key (idProfesional) references profesionales(idProfesional),
    constraint fk_consultorios_i foreign key (idInsumo) references insumos(idInsumo)
);

INSERT INTO consultorios (idProfesional, idInsumo, fechaHoraIngreso, fechaHoraEgreso, idServicio) VALUES
(1, 1, '2024-05-20 09:00:00', '2024-05-20 18:00:00', 1),
(2, 2, '2024-05-20 09:00:00', '2024-05-20 18:00:00', 2),
(3, 3, '2024-05-20 09:00:00', '2024-05-20 18:00:00', 3),
(4, 4, '2024-05-20 09:00:00', '2024-05-20 18:00:00', 4),
(5, 5, '2024-05-20 09:00:00', '2024-05-20 18:00:00', 5),
(6, 6, '2024-05-20 09:00:00', '2024-05-20 18:00:00', 6),
(7, 7, '2024-05-20 09:00:00', '2024-05-20 18:00:00', 7),
(8, 8, '2024-05-20 09:00:00', '2024-05-20 18:00:00', 8),
(9, 9, '2024-05-20 09:00:00', '2024-05-20 18:00:00', 9),
(10, 10, '2024-05-20 09:00:00', '2024-05-20 18:00:00', 10),
(11, 11, '2024-05-20 09:00:00', '2024-05-20 18:00:00', 11),
(12, 12, '2024-05-20 09:00:00', '2024-05-20 18:00:00', 12),
(13, 13, '2024-05-20 09:00:00', '2024-05-20 18:00:00', 13),
(14, 14, '2024-05-20 09:00:00', '2024-05-20 18:00:00', 14),
(15, 15, '2024-05-20 09:00:00', '2024-05-20 18:00:00', 15),
(16, 16, '2024-05-20 09:00:00', '2024-05-20 18:00:00', 16);


CREATE TABLE obras_sociales (
    idObraSocial INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100)
);

INSERT INTO obras_sociales (nombre) VALUES
('OSDE'),
('Swiss Medical'),
('Galeno'),
('Medicus'),
('IAPOS'),
('OSPIM'),
('OSSEG'),
('Sancor Salud'),
('OSPERYH'),
('Federada Salud');

CREATE TABLE administrativos (
    idAdministrativo INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50),
    apellido VARCHAR(50),
    dni INT,
    telefono VARCHAR(50),
    domicilio VARCHAR(100),
    email VARCHAR(100),
    horarioLaboral VARCHAR(50)
);

INSERT INTO administrativos (nombre, apellido, dni, telefono, domicilio, email, horarioLaboral) VALUES
('Maria', 'Garcia', 12345678, '555-1234', 'Calle 123', 'maria@example.com', '9:00 - 18:00'),
('Juan', 'Lopez', 23456789, '555-2345', 'Avenida 456', 'juan@example.com', '9:00 - 18:00'),
('Ana', 'Martinez', 34567890, '555-3456', 'Ruta 789', 'ana@example.com', '9:00 - 18:00'),
('Pedro', 'Gomez', 45678901, '555-4567', 'Boulevard 012', 'pedro@example.com', '9:00 - 18:00'),
('Lucia', 'Rodriguez', 56789012, '555-5678', 'Plaza Principal', 'lucia@example.com', '9:00 - 18:00'),
('Carlos', 'Fernandez', 67890123, '555-6789', 'Callejon 345', 'carlos@example.com', '9:00 - 18:00');

CREATE TABLE estudios (
    idEstudio INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) UNIQUE,
    fechaHora DATETIME,
    precio FLOAT,
    prioridad VARCHAR(50)
);

INSERT INTO estudios (nombre, fechaHoraInicio, HoraFin, precio, prioridad) VALUES
('Ecografia abdominal', '2024-05-20 09:00:00', 150.00, 'Alta'),
('Analisis de sangre', '2024-05-21 07:00:00', 80.00, 'Media'),
('Radiografia de torax', '2024-05-22 11:00:00', 120.00, 'Alta'),
('Electrocardiograma', '2024-05-23 12:00:00', 100.00, 'Baja'),
('Resonancia magnetica', '2024-05-24 13:00:00', 300.00, 'Alta'),
('Tomografia computarizada', '2024-05-25 14:00:00', 250.00, 'Media'),
('Colonoscopia', '2024-05-26 15:00:00', 200.00, 'Alta'),
('Mamografia', '2024-05-27 16:00:00', 180.00, 'Media'),
('Endoscopia', '2024-05-28 17:00:00', 220.00, 'Baja'),
('Analisis de orina', '2024-05-28 17:00:00', 220.00, 'Baja'),
('Prueba de esfuerzo', '2024-05-29 18:00:00', 130.00, 'Media');

CREATE TABLE resultados (
    idResultado INT AUTO_INCREMENT PRIMARY KEY,
    idEstudio INT,
    fecha DATETIME,
    muestra VARCHAR(100),
    descripcion VARCHAR(100),
    comprobanteRetiro BOOLEAN,
    constraint fk_resultados_e foreign key (idEstudio) references estudios(idEstudio)
);

INSERT INTO resultados (idEstudio, fecha, muestra, descripcion, comprobanteRetiro) VALUES
(1, '2024-05-20 09:30:00', 'Sangre', 'Normal', TRUE),
(2, '2024-05-21 10:30:00', 'Sangre', 'Hemoglobina dentro de valores normales', TRUE),
(3, '2024-05-22 11:30:00', 'Radiografia', 'Sin alteraciones significativas', FALSE),
(4, '2024-05-23 12:30:00', 'Electrodos', 'Se observa ritmo cardiaco regular', TRUE),
(5, '2024-05-24 13:30:00', 'Imagenes', 'Presencia de lesion en el tejido blando', TRUE),
(6, '2024-05-25 14:30:00', 'Imagenes', 'Presencia de anomalias en el higado', TRUE),
(7, '2024-05-26 15:30:00', 'Colonoscopia', 'Presencia de polipos benignos', FALSE),
(8, '2024-05-27 16:30:00', 'Mamografia', 'No se detectan masas ni calcificaciones', TRUE),
(9, '2024-05-28 17:30:00', 'Endoscopia', 'ulcera gastrica leve', FALSE),
(10, '2024-05-29 18:30:00', 'Electrocardiograma', 'Ejercicio bien tolerado, sin arritmias', TRUE);


CREATE TABLE historias_clinicas (
    idHistoriaClinica INT AUTO_INCREMENT PRIMARY KEY,
    idEstudio INT,
    idServicio INT,
    idResultado INT,
    fecha DATETIME,
    observacion VARCHAR(100),
    derivadoDesde VARCHAR(100),
    derivadoHacia VARCHAR(100),
    constraint fk_historias_clinicas_e foreign key (idEstudio) references estudios(idEstudio),
    constraint fk_historias_clinicas_s foreign key (idServicio) references servicios(idServicio),
    constraint fk_historias_clinicas_r foreign key (idResultado ) references resultados(idResultado)
);

INSERT INTO historias_clinicas (idEstudio, idServicio, idResultado, fecha, observacion, derivadoDesde, derivadoHacia) VALUES
(1, 1, 1, '2024-05-20 09:30:00', 'Paciente sin sintomas aparentes', 'Consulta medica', 'Eco Doppler'),
(2, 2, 2, '2024-05-21 10:30:00', 'Paciente con fatiga cronica', 'Consulta medica', 'Analisis de glucemia postprandial'),
(3, 3, 3, '2024-05-22 11:30:00', 'Paciente con tos persistente', 'Consulta medica', 'Tomografia de abdomen'),
(4, 4, 4, '2024-05-23 12:30:00', 'Paciente con antecedentes cardiacos', 'Consulta medica', 'Holter de 24hs'),
(5, 5, 5, '2024-05-24 13:30:00', 'Paciente con dolor lumbar cronico', 'Consulta medica', 'Revision por traumatologia'),
(6, 6, 6, '2024-05-25 14:30:00', 'Paciente con sintomas gastrointestinales', 'Consulta medica', 'Colangiorresonancia'),
(7, 7, 7, '2024-05-26 15:30:00', 'Paciente asintomatico', 'Control de rutina', 'Seguimiento medico'),
(8, 8, 8, '2024-05-27 16:30:00', 'Paciente con antecedentes familiares de cancer de mama', 'Consulta medica', 'Seguimiento oncologico'),
(9, 9, 9, '2024-05-28 17:30:00', 'Paciente con dispepsia', 'Consulta medica', 'Esofagoscopia'),
(10, 10, 10, '2024-05-29 18:30:00', 'Paciente con antecedentes de enfermedad cardiovascular', 'Consulta medica', 'Seguimiento cardiologico');


CREATE TABLE fichas_medicas (
    idFichaMedica INT AUTO_INCREMENT PRIMARY KEY,
    idHistoriaClinica INT,
    grupoSanguineo VARCHAR(20),
    observaciones VARCHAR(50),
    constraint fk_fichas_medicas_h foreign key (idHistoriaClinica) references historias_clinicas(idHistoriaClinica)
);

INSERT INTO fichas_medicas (idHistoriaClinica, grupoSanguineo, observaciones) VALUES
(1, 'A+', 'Sin observaciones'),
(2, 'O-', 'Sin observaciones'),
(3, 'B+', 'Hipertension arterial'),
(4, 'AB+', 'Sin observaciones'),
(5, 'A-', 'Sin observaciones'),
(6, 'O+', 'Sin observaciones'),
(7, 'B-', 'Sin observaciones'),
(8, 'AB-', 'Antecedentes familiares de cancer de mama'),
(9, 'O+', 'Sin observaciones'),
(10, 'A+', 'Sin observaciones');

CREATE TABLE pacientes (
    idPaciente INT AUTO_INCREMENT PRIMARY KEY,
    idFichaMedica INT,
    idUsuario INT,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    dni VARCHAR(50) NOT NULL,
    telefono VARCHAR(50) NOT NULL,
    domicilio VARCHAR(50) NOT NULL,
    email VARCHAR(50),
    obraSocial VARCHAR(50),
    prioridad INT,
    constraint fk_pacientes_f foreign key (idFichaMedica) references fichas_medicas(idFichaMedica),
    constraint fk_pacientes_u foreign key (idUsuario) references usuarios(idUsuario)
);

INSERT INTO pacientes (idFichaMedica, idUsuario, nombre, apellido, dni, telefono, domicilio, email, obraSocial, prioridad) VALUES
(1, 2, 'Carlos', 'Gonzalez', '12345678', '555-1234', 'Calle 123', 'carlos@example.com', 'OSDE', 1),
(2, 3, 'Maria', 'Lopez', '23456789', '555-2345', 'Avenida 456', 'maria@example.com', 'Swiss Medical', 2),
(3, 4, 'Juan', 'Martinez', '34567890', '555-3456', 'Ruta 789', 'juan@example.com', 'Galeno', 1),
(4, 5, 'Laura', 'Gomez', '45678901', '555-4567', 'Boulevard 012', 'laura@example.com', 'Medicus', 2),
(5, 6, 'Lucia', 'Rodriguez', '56789012', '555-5678', 'Plaza Principal', 'lucia@example.com', 'IAPOS', 3),
(6, 7, 'Pedro', 'Fernandez', '67890123', '555-6789', 'Callejon 345', 'pedro@example.com', 'OSPIM', 1),
(7, 8, 'Ana', 'Diaz', '78901234', '555-7890', 'Calle 678', 'ana@example.com', 'OSSEG', 2),
(8, 9, 'Sofia', 'Perez', '89012345', '555-8901', 'Avenida 901', 'sofia@example.com', 'Sancor Salud', 3),
(9, 10, 'Martin', 'Suarez', '90123456', '555-9012', 'Calle 234', 'martin@example.com', 'OSPERYH', 1),
(10, 11, 'Julieta', 'Lopez', '01234567', '555-0123', 'Avenida 345', 'julieta@example.com', 'Federada Salud', 2);

CREATE TABLE informes (
    idInformes INT AUTO_INCREMENT PRIMARY KEY,
    idProfesional INT,
    idPaciente INT,
    idEstudio INT,
    idResultado INT,
    fecha DATETIME,
    observacion VARCHAR(100),
    constraint fk_informes_p foreign key (idProfesional) references profesionales(idProfesional),
    constraint fk_informes_pa foreign key (idPaciente) references pacientes(idPaciente),
    constraint fk_informes_e foreign key (idEstudio) references estudios(idEstudio),
    constraint fk_informes_r foreign key (idResultado) references resultados(idResultado)
);

INSERT INTO informes (idProfesional, idPaciente, idEstudio, idResultado, fecha, observacion) VALUES
(1, 1, 1, 1, '2024-05-20 09:30:00', 'Eco abdominal normal'),
(2, 2, 2, 2, '2024-05-21 10:30:00', 'Analisis de sangre dentro de valores normales'),
(3, 3, 3, 3, '2024-05-22 11:30:00', 'Radiografia sin hallazgos significativos'),
(4, 4, 4, 4, '2024-05-23 12:30:00', 'Electrocardiograma sin alteraciones'),
(5, 5, 5, 5, '2024-05-24 13:30:00', 'Lesion detectada en resonancia magnetica'),
(6, 6, 6, 6, '2024-05-25 14:30:00', 'Anomalias en tomografia computarizada'),
(7, 7, 7, 7, '2024-05-26 15:30:00', 'Polipos detectados en colonoscopia'),
(8, 8, 8, 8, '2024-05-27 16:30:00', 'Mamografia normal'),
(9, 9, 9, 9, '2024-05-28 17:30:00', 'ulcera gastrica leve en endoscopia'),
(10, 10, 10, 10, '2024-05-29 18:30:00', 'Prueba de esfuerzo bien tolerada');


CREATE TABLE muestras (
    idMuestra INT AUTO_INCREMENT PRIMARY KEY,
    idPaciente INT,
    fecha DATETIME,
    descripcion VARCHAR(100),
    idResultado INT,
    rotulo VARCHAR(100),
    constraint fk_muestras_p foreign key (idPaciente) references pacientes(idPaciente)
);

INSERT INTO muestras (idPaciente, fecha, descripcion, idResultado, rotulo) VALUES
(1, '2024-05-20 09:30:00', 'Sangre', 1, 'Muestra A-123'),
(2, '2024-05-21 10:30:00', 'Sangre', 2, 'Muestra B-456'),
(3, '2024-05-22 11:30:00', 'Radiografia', 3, 'Muestra C-789'),
(4, '2024-05-23 12:30:00', 'Electrodos', 4, 'Muestra D-012'),
(5, '2024-05-24 13:30:00', 'Imagenes', 5, 'Muestra E-345'),
(6, '2024-05-25 14:30:00', 'Imagenes', 6, 'Muestra F-678'),
(7, '2024-05-26 15:30:00', 'Colonoscopia', 7, 'Muestra G-901'),
(8, '2024-05-27 16:30:00', 'Mamografia', 8, 'Muestra H-234'),
(9, '2024-05-28 17:30:00', 'Endoscopia', 9, 'Muestra I-567'),
(10, '2024-05-29 18:30:00', 'Electrocardiograma', 10, 'Muestra J-890');

CREATE TABLE turnos (
    idTurno INT AUTO_INCREMENT PRIMARY KEY,
    idProfesional INT,
    idConsultorio INT,
    idServicio INT,
    idPaciente INT,
    fechaHora DATETIME,
    sobreturno BOOLEAN,
    acreditado BOOLEAN,
    constraint fk_turnos_p foreign key (idProfesional) references profesionales(idProfesional),
    constraint fk_turnos_c foreign key (idConsultorio) references consultorios(idConsultorio),
    constraint fk_turnos_s foreign key (idServicio) references servicios(idServicio),
    constraint fk_turnos_pa foreign key (idPaciente) references pacientes(idPaciente)
);

INSERT INTO turnos (idProfesional, idConsultorio, idServicio, idPaciente, fechaHora, sobreturno, acreditado) VALUES
(1, 1, 1, 1, '2024-05-20 09:30:00', FALSE, TRUE),
(2, 2, 2, 2, '2024-05-21 10:30:00', FALSE, TRUE),
(3, 3, 3, 3, '2024-05-22 11:30:00', FALSE, TRUE),
(4, 4, 4, 4, '2024-05-23 12:30:00', FALSE, TRUE),
(5, 5, 5, 5, '2024-05-24 13:30:00', FALSE, TRUE),
(6, 6, 6, 6, '2024-05-25 14:30:00', FALSE, TRUE),
(7, 7, 7, 7, '2024-05-26 15:30:00', FALSE, TRUE),
(8, 8, 8, 8, '2024-05-27 16:30:00', FALSE, TRUE),
(9, 9, 9, 9, '2024-05-28 17:30:00', FALSE, TRUE),
(10, 10, 10, 10, '2024-05-29 18:30:00', FALSE, TRUE);

CREATE TABLE control_horario (
    idProfesional INT,
    fechaHoraIngreso DATETIME,
    fechaHoraEgreso DATETIME,
    constraint fk_control_horario_p foreign key (idProfesional) references profesionales(idProfesional)
);

INSERT INTO control_horario (idProfesional, fechaHoraIngreso, fechaHoraEgreso) VALUES
(1, '2024-05-20 09:00:00', '2024-05-20 18:00:00'),
(2, '2024-05-21 09:00:00', '2024-05-21 18:00:00'),
(3, '2024-05-22 09:00:00', '2024-05-22 18:00:00'),
(4, '2024-05-23 09:00:00', '2024-05-23 18:00:00'),
(5, '2024-05-24 09:00:00', '2024-05-24 18:00:00'),
(6, '2024-05-25 09:00:00', '2024-05-25 18:00:00'),
(7, '2024-05-26 09:00:00', '2024-05-26 18:00:00'),
(8, '2024-05-27 09:00:00', '2024-05-27 18:00:00'),
(9, '2024-05-28 09:00:00', '2024-05-28 18:00:00'),
(10, '2024-05-29 09:00:00', '2024-05-29 18:00:00');

CREATE TABLE agendas (
    idProfesional INT,
    idConsultorio INT,
    idServicio INT,
    fechaHoraIngreso DATETIME,
    fechaHoraEgreso DATETIME,
    constraint fk_agenda_p foreign key (idProfesional) references profesionales(idProfesional),
    constraint fk_agenda_c foreign key (idConsultorio) references consultorios(idConsultorio),
    constraint fk_agenda_s foreign key (idServicio) references servicios(idServicio)
);

INSERT INTO agendas (idProfesional, idConsultorio, idServicio, fechaHoraIngreso, fechaHoraEgreso) VALUES
(1, 1, 1, '2024-05-20 09:00:00', '2024-05-20 18:00:00'),
(2, 2, 2, '2024-05-21 09:00:00', '2024-05-21 18:00:00'),
(3, 3, 3, '2024-05-22 09:00:00', '2024-05-22 18:00:00'),
(4, 4, 4, '2024-05-23 09:00:00', '2024-05-23 18:00:00'),
(5, 5, 5, '2024-05-24 09:00:00', '2024-05-24 18:00:00'),
(6, 6, 6, '2024-05-25 09:00:00', '2024-05-25 18:00:00'),
(7, 7, 7, '2024-05-26 09:00:00', '2024-05-26 18:00:00'),
(8, 8, 8, '2024-05-27 09:00:00', '2024-05-27 18:00:00'),
(9, 9, 9, '2024-05-28 09:00:00', '2024-05-28 18:00:00'),
(10, 10, 10, '2024-05-29 09:00:00', '2024-05-29 18:00:00');

CREATE TABLE pagos (
    idPaciente INT,
    idServicio INT,
    idObraSocial INT,
    fecha DATETIME,
    importe FLOAT,
    factura VARCHAR(50),
    constraint fk_pagos_s foreign key (idServicio) references servicios(idServicio),
    constraint fk_pagos_p foreign key (idPaciente) references pacientes(idPaciente),
    constraint fk_pagos_o foreign key (idObraSocial) references obras_sociales(idObraSocial)
);

INSERT INTO pagos (idPaciente, idServicio, idObraSocial, fecha, importe, factura) VALUES
(1, 1, 1, '2024-05-20 09:30:00', 150.00, 'FAC-001'),
(2, 2, 2, '2024-05-21 10:30:00', 80.00, 'FAC-002'),
(3, 3, 3, '2024-05-22 11:30:00', 120.00, 'FAC-003'),
(4, 4, 4, '2024-05-23 12:30:00', 100.00, 'FAC-004'),
(5, 5, 5, '2024-05-24 13:30:00', 300.00, 'FAC-005'),
(6, 6, 6, '2024-05-25 14:30:00', 250.00, 'FAC-006'),
(7, 7, 7, '2024-05-26 15:30:00', 200.00, 'FAC-007'),
(8, 8, 8, '2024-05-27 16:30:00', 180.00, 'FAC-008'),
(9, 9, 9, '2024-05-28 17:30:00', 220.00, 'FAC-009'),
(10, 10, 10, '2024-05-29 18:30:00', 130.00, 'FAC-010');

CREATE TABLE recetas (
    idPaciente INT,
    idProfesional INT,
    fecha DATETIME,
    descripcion VARCHAR(50),
    constraint fk_recetas_p foreign key (idPaciente) references pacientes(idPaciente),
    constraint fk_recetas_pr foreign key (idProfesional) references profesionales(idProfesional)
);

INSERT INTO recetas (idPaciente, idProfesional, fecha, descripcion) VALUES
(1, 1, '2024-05-20 09:30:00', 'Analgesia para el dolor abdominal'),
(2, 2, '2024-05-21 10:30:00', 'Antibioticos para tratar infeccion'),
(3, 3, '2024-05-22 11:30:00', 'Antiinflamatorios para aliviar dolor'),
(4, 4, '2024-05-23 12:30:00', 'Medicacion para regular ritmo cardiaco'),
(5, 5, '2024-05-24 13:30:00', 'Tratamiento para lesion en tejido blando'),
(6, 6, '2024-05-25 14:30:00', 'Medicamentos para afecciones hepaticas'),
(7, 7, '2024-05-26 15:30:00', 'Laxantes para preparacion de colonoscopia'),
(8, 8, '2024-05-27 16:30:00', 'Indicaciones para seguimiento mamografico'),
(9, 9, '2024-05-28 17:30:00', 'Tratamiento para ulcera gastrica'),
(10, 10, '2024-05-29 18:30:00', 'Recomendaciones post-prueba de esfuerzo');

CREATE TABLE horarios (
    idProfesional INT,
    fecha DATETIME,
    turno VARCHAR(50),
    constraint fk_horarios_p foreign key (idProfesional) references profesionales(idProfesional)
);

INSERT INTO horarios (idProfesional, fecha, turno) VALUES
(1, '2024-05-20', 'Mañana'),
(2, '2024-05-21', 'Mañana'),
(3, '2024-05-22', 'Mañana'),
(4, '2024-05-23', 'Mañana'),
(5, '2024-05-24', 'Mañana'),
(6, '2024-05-25', 'Mañana'),
(7, '2024-05-26', 'Mañana'),
(8, '2024-05-27', 'Mañana'),
(9, '2024-05-28', 'Mañana'),
(10, '2024-05-29', 'Mañana');


drop procedure if exists VerificarUsuario;
delimiter //
CREATE PROCEDURE `VerificarUsuario`(
    IN t_usuario varchar(50),
    IN t_contrasena varchar(255),
    OUT existe boolean,
    OUT rol_id int
)
begin
    declare t_count INT;
    declare t_rol INT;
    select count(*) into t_count from usuarios where usuario = t_usuario and contrasena = t_contrasena;
    if t_count > 0 then
        set existe = TRUE;
        select CONVERT(rol, SIGNED INTEGER) into t_rol from usuarios where usuario = t_usuario;
        set rol_id = t_rol;
	else
        set existe = FALSE;
        set rol_id = NULL;
    end if;
end
//

-- Para probar una salida verdadera y una falsa
-- CALL VerificarUsuario('pirulo', 'gomezd01', @existe, @rol);
-- SELECT @existe,@rol;
-- CALL VerificarUsuario('paciente', 'password01', @existe, @rol);
-- SELECT @existe, @rol;