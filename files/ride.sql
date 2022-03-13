-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 13-03-2022 a las 20:45:37
-- Versión del servidor: 8.0.28-0ubuntu0.20.04.3
-- Versión de PHP: 7.4.3
SET
  SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

SET
  AUTOCOMMIT = 0;

START TRANSACTION;

SET
  time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;

/*!40101 SET NAMES utf8mb4 */
;

--
-- Base de datos: `freedomride`
--
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `ride`
--
CREATE TABLE `ride` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `ccaa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` int NOT NULL,
  `duration` int NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ride`
--
INSERT INTO
  `ride` (
    `id`,
    `user_id`,
    `active`,
    `ccaa`,
    `name`,
    `location`,
    `address`,
    `telephone`,
    `duration`,
    `description`,
    `level`,
    `image`
  )
VALUES
  (
    1,
    1,
    1,
    'Asturias',
    'Playa de San Pedro',
    'Cudillero (Asturias)',
    'Paseo Esparza, 8 33150 Cudillero (Asturias)',
    645215784,
    2,
    'Nos esperan la arena, las olas, los ríos. Increíble todo lo que se puede hacer Cabalgaremos entre bosques, vadearemos ríos, nos salpicaremos con la mar salada, conoceremos pueblos. Si no sabes, aprenderás a trotar, si sabes, galoparas. Y por veredas entre castaños y musgo volveremos sabiendo un poco más',
    'Todos los niveles',
    'http://www.aventurasacaballo.com/_include/img/work/full/rutas_horas/sanpedro09.jpg'
  ),
  (
    2,
    2,
    1,
    'Asturias',
    'Playón de Bayas',
    'Castrillón (Asturias)',
    'Avenida Aaron, 8 33412 Castrillon (Asturias)',
    685478452,
    7,
    'La ruta transcurre entre pinares, pueblos con palacetes, las lomas que dejan ver la costa cantábrica. El puerto de San Juan de la arena con sus veleros, el río Nalón el mas grande de Asturias. En el playón con sus casi 5 Km. disfrutaremos de sus arenas y sus olas. Galopar y galopar.',
    'Medio',
    'http://www.aventurasacaballo.com/_include/img/work/full/ruta_dia/playas02.jpg'
  ),
  (
    3,
    3,
    1,
    'Cantabria',
    'Picos de Europa',
    'Potes (Cantabria)',
    'Avenida de la Sierra, 7 39570 Potes (Cantabria)',
    692153015,
    8,
    'Recorreremos los picos de Europa, macizos de roca caliza conocidos en el mundo entero. Sus valles glaciares rodeados de bosques, aldeas y pueblos donde los quesos, sidra, carnes forman parte de su cultura. Pasaremos por Potes, Fuentedé, Viego, Soto de Sajambre.',
    'Medio-alto',
    'http://www.aventurasacaballo.com/_include/img/work/thumbs/rutas_dias/photo-004.jpg'
  ),
  (
    4,
    4,
    1,
    'Andalucía',
    'Montes de Málaga',
    'Málaga (Málaga)',
    'Camino Peña, 9 29014 Malaga',
    634812034,
    5,
    'Recorreremos el Parque Natural de los Montes de Málaga, hasta llegar al monte san Antón, teniendo vistas privilegiadas de la preciosa bahía de Málaga. Recorreremos pinares y disfrutaremos de la flora y fauna de la preciosa provincia, así como de los contrastes del mar y la montaña tan cercanos entre sí.',
    'Todos los niveles',
    'https://media.istockphoto.com/photos/people-riding-horses-picture-id506924806?b=1&k=20&m=506924806&s=170667a&w=0&h=DtsN6o03xzaHtoEwMByRWnpNOAJUCvn4qGIpWVxn1Y8='
  ),
  (
    5,
    5,
    1,
    'Andalucía',
    'Doñana',
    'Almonte (Huelva)',
    'Avenida Sepúlveda, s/n 21730 Almonte (Huelva)',
    699725410,
    6,
    'Ver el atardecer en Doñana es una de las cosas más bonitas del mundo. Su luz especial, la fina arena de sus playas. Con este tour recorremos Doñana para disfrutar de una experiencia inolvidable. Antes de llegar a la playa de Matalsacañas donde tiene lugar la ruta de 3 horas a caballo nos pararemos en El Rocio, una aldea donde las calles son de arena. Haremos una visita guiada de sus calles, su marisma y su Ermita. Después de comer continuará la ruta a caballo hasta la puesta de sol.',
    'Todos los niveles',
    'https://safarisacaballo.com/wp-content/uploads/2020/06/AET-16.jpg'
  ),
  (
    6,
    6,
    1,
    'Andalucía',
    'Faro de Trafalgar',
    'Zahora (Cádiz)',
    'Avenida del Atlántico, 8 11159 Zahora (Cádiz)',
    607853142,
    2,
    'Disfruta de la increíble puesta de sol sobre el océano! La hermosa playa de Mangueta ofrece el escenario perfecto. Experimentarás una sensación muy especial: una mezcla de libertad, paz y felicidad. El entorno de la costa atlántica de Cádiz, con sus interminables playas de arena blanca son el entorno perfecto para una ruta inolvidable a caballo.',
    'Todos los niveles',
    'https://static4.lavozdigital.es/media/provincia/2019/07/27/v/caballo-chiclana-0030-ktwE--620x349@abc.jpg'
  ),
  (
    7,
    7,
    1,
    'Extremadura',
    'Valle del Jerte',
    'Jerte (Cáceres)',
    'Plaza Pizarro, 5 10612 Jerte (Cáceres)',
    644187321,
    4,
    'Ruta por la Reserva Natural Garganta de los Infiernos, en la que hacemos un recorrido por bosques de castaño y roble, así como los encinares en un entorno privilegiado, para llegar al espacio más singular de toda la Reserva, Los Pilones del Jerte. Además, si vienes en primavera, podremos disfrutar del espectáculo de los cerezos en flor, por los que es famoso el valle del Jerte en todo el mundo.',
    'Medio',
    'https://upload.wikimedia.org/wikipedia/commons/3/33/Camino_entre_el_bosque_de_cerezos_en_flor.jpg'
  ),
  (
    8,
    8,
    1,
    'Cataluña',
    'Montserrat',
    'Olesa de Montserrat (Barcelona)',
    'Carrer del Penedes, 7, 08640 Olesa de Montserrat (Barcelona)',
    611843780,
    5,
    'A poca distancia de Barcelona y lejos de su bullicio se encuentra Montserrat. Admire los rocosos picos en forma de aguja de la formación montañosa del macizo de Montserrat y visite la abadía de Santa María de Montserrat, encaramada en la ladera.',
    'Todos los niveles',
    'https://www.visitarmontserrat.com/wp-content/uploads/tour-montserrat-paseo-caballo.jpg'
  ),
  (
    9,
    9,
    1,
    'Cataluña',
    'Pirineo Leridano',
    'Vielha (Lérida)',
    'Travessera Yáñez, 9 25530 Vielha (Lérida)',
    622759192,
    5,
    'En esta ruta visitaremos el inigualable paraje del pirineo leridano, en concreto el parque nacional de Aigüestortes y el Lago de San Mauricio. El parque tiene un gran valor biológico, pudiendo verse zorros, aguilas, buitres y demás fauna autóctona. Los grandes desniveles que presenta originan los diferentes ecosistemas: prados, cultivos y bosques. Dado que desde hace años ha sido un espacio protegido y su acceso relativamente inaccesible, ha preservado la flora y la fauna en un estado bastante salvaje.',
    'Medio-alto',
    'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b2/Aig%C3%BCestortes_desde_Son.jpg/800px-Aig%C3%BCestortes_desde_Son.jpg'
  ),
  (
    10,
    10,
    1,
    'Madrid',
    'Sierra de Guadarrama',
    'Rascafría (Madrid)',
    'Calle del Prado, 15 28740 Rascafría (Madrid)',
    633720455,
    3,
    'La Sierra de Madrid encierra paisajes naturales de increíble belleza, y una de las mejores formas de descubrirlos y admirarlos es a lomos de un caballo. Gracias a nuestros recorridos a caballo por el Parque Nacional de la Sierra de Guadarrama, podrás descubrir todos estos hermosos lugares, y disfrutar de unos momentos llenos de aventura y diversión. Disfruta de un paseo por las hermosas montañas de Madrid rodeado de paisajes espectaculares. Tu aventura a caballo te llevará por el campo.',
    'Todos los niveles',
    'https://images.unsplash.com/photo-1494984858525-798dd0b282f5?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80'
  ),
  (
    11,
    11,
    1,
    'La Rioja',
    'Paseo por los viñedos',
    'Haro (La Rioja)',
    'Carretera de las Viñas s/n 26200 Haro (La Rioja)',
    685887321,
    4,
    'Una ruta muy especial, un paseo a caballo rodeado por la belleza del mar de viñedos que rodea la región del Rioja, y por su fantástica naturaleza, explorando ésta bella tierra de la manera más natural: a caballo, una experiencia que nunca olvidará. Además disfrutaremos de la visita a una bodega.',
    'Todos los niveles',
    'https://media.tacdn.com/media/attractions-splice-spp-674x446/0a/c5/95/77.jpg'
  ),
  (
    12,
    12,
    1,
    'Canarias',
    'Puerto de la cruz',
    'La Orotava (Santa Cruz de Tenerife)',
    'Plaza Briones, 12 38311 La Orotava (Tenerife)',
    677854022,
    2,
    'Se trata de una ruta corta pero muy divertida y apta para todos los niveles y edades. Recorreremos montañas, pequeños bosques y llegamos a la zona del jardín botánico y hasta la Playa del Bollullo, donde realizaremos una pequeña travesía para volver posteriormente al inicio de la ruta.',
    'Todos los niveles',
    'https://media.tacdn.com/media/attractions-splice-spp-674x446/0a/73/0f/f6.jpg'
  ),
  (
    13,
    13,
    1,
    'Baleares',
    'Ruta de la Tramontana',
    'Soller (Mallorca)',
    'Plaza Mayor, 4 07100 Soller (Mallorca)',
    699733114,
    5,
    'Partimos del precioso pueblo de Soller haciendo un recorrido por el mismo. Posteriormente llegarmenos hasta el puerto de Soller para despues recorrer los maravillosos pueblos de Deyá y Valldemosa, con vistas a los valles que los roden así como toda lo costa oeste de esta parte de la isla, tan cercana a la sierra de la Tramontana, lo que ofrece unos contrastes naturales únicos.',
    'Todos los niveles',
    'https://images.unsplash.com/photo-1510913950142-d48911b41a53?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80'
  ),
  (
    14,
    14,
    1,
    'Baleares',
    'Cala Mitjana',
    'Ferreries (Menorca)',
    'Passeig Valles, 2 07750 Ferreries (Menorca)',
    647842210,
    3,
    'Ésta ruta discurre por caminos rurales de interior, hasta llegar a Cala Mitjana, una cala virgen situada en la costa sur de Menorca donde destaca el color turquesa de sus aguas dignas de fotografiar para el recuerdo. Durante la temporada baja, se permite montar a caballo en la arena blanca de la playa. Es uno de esos paisajes que inolvidables.',
    'Todos los niveles',
    'https://images.unsplash.com/photo-1512073995635-c7001b907e21?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80'
  ),
  (
    33,
    17,
    1,
    'Andalucía',
    'Sierra de Ronda',
    'Ronda (Málaga)',
    'Plaza Mayor, 1',
    952548794,
    3,
    'Visitaremos todo el entorno del Tajo, viendo el impresionante Puente Nuevo desde abajo. También visitaremos las bodegas ubicadas en dicho entorno, pertenecientes a la denominación de origen Serranía de Ronda.',
    'Medio',
    'https://images.ecestaticos.com/rZeqqdQkqrChHdT5Mw4NEfzBS-o=/0x0:2272x1514/1600x900/filters:fill(white):format(JPG)/f.elconfidencial.com/original/5f1/cfd/416/5f1cfd416b377fbc5a73a25e849db188.jpg'
  );

--
-- Índices para tablas volcadas
--
--
-- Indices de la tabla `ride`
--
ALTER TABLE
  `ride`
ADD
  PRIMARY KEY (`id`),
ADD
  KEY `IDX_9B3D7CD0A76ED395` (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--
--
-- AUTO_INCREMENT de la tabla `ride`
--
ALTER TABLE
  `ride`
MODIFY
  `id` int NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 43;

--
-- Restricciones para tablas volcadas
--
--
-- Filtros para la tabla `ride`
--
ALTER TABLE
  `ride`
ADD
  CONSTRAINT `FK_9B3D7CD0A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;