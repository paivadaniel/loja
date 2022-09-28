DROP TABLE IF EXISTS alertas;

CREATE TABLE `alertas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo_alerta` varchar(35) NOT NULL,
  `titulo_mensagem` varchar(100) NOT NULL,
  `mensagem` text DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `imagem` varchar(100) NOT NULL,
  `data_final` date NOT NULL,
  `ativo` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO alertas VALUES("1","Promoção Imperdível","Qual é a boa?","Sabia que o sabiá sabia subiá?","sbt.com.br","banner-1.jpg","2022-09-13","Sim");
INSERT INTO alertas VALUES("3","arqrq","arqrq","ddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddaaaaaaaaa2222222222222222","414141","sem-foto.jpg","2022-08-19","Não");


DROP TABLE IF EXISTS avaliacoes;

CREATE TABLE `avaliacoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `texto` varchar(500) NOT NULL,
  `nota` int(11) NOT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO avaliacoes VALUES("4","17","18","show!!!!!","3","2022-09-14");


DROP TABLE IF EXISTS blog;

CREATE TABLE `blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_autor` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `titulo_url` varchar(200) NOT NULL,
  `descricao_1` varchar(1000) NOT NULL,
  `descricao_2` varchar(1000) NOT NULL,
  `imagem` varchar(150) NOT NULL,
  `palavras` varchar(250) DEFAULT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO blog VALUES("2","6","Meu Primeiro Post no Blog","meu-primeiro-post-no-blog","Essa é a descrição 1","Essa é a descrição 2","16.png","Palavra chave01, palavra chave 02, palavra chave03","2022-09-15");
INSERT INTO blog VALUES("3","6","Segundo Post","segundo-post","Descrição 01 do segundo post","Descrição 02 do segundo post","container01.jpg","Palavra chave01, palavra chave 02, palavra chave03","2022-09-15");
INSERT INTO blog VALUES("4","6","Terceiro Post","terceiro-post","Descrição 01 do terceiro post","Descrição 02 do terceiro post","container02.jpg","Palavra chave01, palavra chave 02, palavra chave03 do terceiro post que tem id 4","2022-09-15");
INSERT INTO blog VALUES("5","6","Quarto Post","quarto-post","Descrição 01 do post 04","Descrição 02 do post 04","09.png","Palavra chave01, palavra chave 02, palavra chave03","2022-09-15");


DROP TABLE IF EXISTS carac;

CREATE TABLE `carac` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

INSERT INTO carac VALUES("3","Cor");
INSERT INTO carac VALUES("4","Numeração");
INSERT INTO carac VALUES("7","Tamanho");


DROP TABLE IF EXISTS carac_itens;

CREATE TABLE `carac_itens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_carac_prod` int(11) NOT NULL,
  `nome_item` varchar(50) NOT NULL,
  `valor_item` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

INSERT INTO carac_itens VALUES("2","28","branco","#FFFFFF");
INSERT INTO carac_itens VALUES("30","28","azul",NULL);
INSERT INTO carac_itens VALUES("31","29","PMel",NULL);
INSERT INTO carac_itens VALUES("32","29","MMel",NULL);
INSERT INTO carac_itens VALUES("33","29","GMel",NULL);
INSERT INTO carac_itens VALUES("34","30","Tamanho1Mel",NULL);
INSERT INTO carac_itens VALUES("35","30","Tamanho2Mel",NULL);
INSERT INTO carac_itens VALUES("37","27","azul","#0625bf");
INSERT INTO carac_itens VALUES("38","27","vermelho","#ff0800");
INSERT INTO carac_itens VALUES("39","27","amarelo","#ffe600");
INSERT INTO carac_itens VALUES("40","31","vermelho","#de0202");
INSERT INTO carac_itens VALUES("41","31","roxo","#7a018a");
INSERT INTO carac_itens VALUES("42","31","marrom","#614505");


DROP TABLE IF EXISTS carac_itens_carrinho;

CREATE TABLE `carac_itens_carrinho` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_carrinho` int(11) NOT NULL,
  `id_carac` int(11) NOT NULL,
  `nome_carac` varchar(35) NOT NULL,
  `nome_item` varchar(35) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=utf8;

INSERT INTO carac_itens_carrinho VALUES("141","525","3","Cor","vermelho");
INSERT INTO carac_itens_carrinho VALUES("142","527","3","Cor","azul");


DROP TABLE IF EXISTS carac_prod;

CREATE TABLE `carac_prod` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_carac` int(11) NOT NULL,
  `id_prod` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

INSERT INTO carac_prod VALUES("27","3","2");
INSERT INTO carac_prod VALUES("28","3","3");
INSERT INTO carac_prod VALUES("29","4","2");
INSERT INTO carac_prod VALUES("30","7","2");
INSERT INTO carac_prod VALUES("31","3","6");


DROP TABLE IF EXISTS carrinho;

CREATE TABLE `carrinho` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `id_venda` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `data` date NOT NULL,
  `combo` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=536 DEFAULT CHARSET=utf8;

INSERT INTO carrinho VALUES("472","18","7","89","1","2022-09-12","Sim");
INSERT INTO carrinho VALUES("483","18","4","91","1","2022-09-12","Não");
INSERT INTO carrinho VALUES("496","18","8","92","1","2022-09-13","Sim");
INSERT INTO carrinho VALUES("497","18","7","92","1","2022-09-13","Sim");
INSERT INTO carrinho VALUES("498","18","8","92","1","2022-09-13","Sim");
INSERT INTO carrinho VALUES("499","18","7","92","1","2022-09-13","Sim");
INSERT INTO carrinho VALUES("501","18","8","92","1","2022-09-13","Sim");
INSERT INTO carrinho VALUES("512","18","17","93","1","2022-09-13","Não");
INSERT INTO carrinho VALUES("513","18","7","93","1","2022-09-13","Não");
INSERT INTO carrinho VALUES("514","18","17","94","1","2022-09-13","Não");
INSERT INTO carrinho VALUES("515","18","7","94","1","2022-09-13","Não");
INSERT INTO carrinho VALUES("516","18","17","95","1","2022-09-13","Não");
INSERT INTO carrinho VALUES("517","18","17","96","1","2022-09-13","Não");
INSERT INTO carrinho VALUES("520","18","17","97","1","2022-09-13","Não");
INSERT INTO carrinho VALUES("523","18","7","98","1","2022-09-13","Sim");
INSERT INTO carrinho VALUES("524","18","17","99","1","2022-09-13","Não");
INSERT INTO carrinho VALUES("525","18","2","99","1","2022-09-13","Não");
INSERT INTO carrinho VALUES("527","18","2","100","1","2022-09-13","Não");
INSERT INTO carrinho VALUES("533","18","7","101","1","2022-09-14","Sim");
INSERT INTO carrinho VALUES("534","18","13",NULL,"1","2022-09-27","Não");


DROP TABLE IF EXISTS categorias;

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `nome_url` varchar(50) NOT NULL,
  `imagem` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

INSERT INTO categorias VALUES("1","categoria teste bica","categoria-teste-bica","pintinho-amarelinho.jpg");
INSERT INTO categorias VALUES("3","galo-teste","galo-teste","sem-foto.jpg");
INSERT INTO categorias VALUES("4","cerveja 2","cerveja-2","sem-foto.jpg");
INSERT INTO categorias VALUES("8","doces coloridos da tia mafalda","doces-coloridos-da-tia-mafalda","sem-foto.jpg");
INSERT INTO categorias VALUES("9","tetsfsf 2","tetsfsf-2","laranja-01.jpg");


DROP TABLE IF EXISTS clientes;

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(55) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `email` varchar(55) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `logradouro` varchar(75) DEFAULT NULL,
  `numero` varchar(20) DEFAULT NULL,
  `complemento` varchar(50) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `cidade` varchar(30) DEFAULT NULL,
  `estado` varchar(5) DEFAULT NULL,
  `cep` varchar(20) DEFAULT NULL,
  `pais` varchar(30) DEFAULT NULL,
  `cartoes` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO clientes VALUES("1","Adamastor Pereira Maluco Beleza","919.191.991-15","pereira@gmail.com","(41) 4141-4141","qualquer","32","nonsense","seido","uma cidade","CE","18015-000",NULL,"11");


DROP TABLE IF EXISTS combos;

CREATE TABLE `combos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `nome_url` varchar(50) NOT NULL,
  `descricao` varchar(1000) DEFAULT NULL,
  `descricao_longa` text DEFAULT NULL,
  `valor` decimal(8,2) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  `tipo_envio` int(11) NOT NULL,
  `palavras` varchar(250) DEFAULT NULL,
  `ativo` varchar(5) NOT NULL,
  `peso` double(8,2) NOT NULL,
  `largura` double(8,2) NOT NULL,
  `altura` double(8,2) NOT NULL,
  `comprimento` double(8,2) NOT NULL,
  `valor_frete` decimal(8,2) DEFAULT NULL,
  `vendas` int(11) DEFAULT NULL,
  `link` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

INSERT INTO combos VALUES("7","combo 5 camisas","combo-5-camisas",NULL,NULL,"32.00","curso-html-5-css-3.jpg","1",NULL,"Sim","0.50","0.00","0.00","0.00","10.00","4",NULL);
INSERT INTO combos VALUES("8","combo 5 calças","combo-5-calcas",NULL,NULL,"50.00","banner-teste.jpg","2","calças do seu madruga, calças pretas, calças baratas, calças para vender igual água","Sim","0.80","0.00","0.00","0.00","12.00",NULL,"http://www.linkcombo.com");
INSERT INTO combos VALUES("9","combo qualquer para teste","combo-qualquer-para-teste","blabla","blablablablablablablablablablablabla","41.00","sem-foto.jpg","4","bing bing bung bung","Sim","0.00","0.00","0.00","0.00","0.00",NULL,"http://www.linkteste.com");


DROP TABLE IF EXISTS comentarios_blog;

CREATE TABLE `comentarios_blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_post` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `comentario` varchar(500) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

INSERT INTO comentarios_blog VALUES("4","2","15","buxada de bode","2022-09-26","20:50:54");
INSERT INTO comentarios_blog VALUES("5","5","18","cuzero!","2022-09-26","20:51:09");
INSERT INTO comentarios_blog VALUES("6","5","15","Bixa!","2022-09-26","20:53:44");
INSERT INTO comentarios_blog VALUES("7","5","16","Pé de burro!","2022-09-26","20:54:10");
INSERT INTO comentarios_blog VALUES("9","2","6","Post do adm","2022-09-27","14:04:48");
INSERT INTO comentarios_blog VALUES("10","2","6","outro post do adm","2022-09-27","14:05:03");
INSERT INTO comentarios_blog VALUES("11","4","6","first!","2022-09-27","14:05:22");


DROP TABLE IF EXISTS cupons;

CREATE TABLE `cupons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(35) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `codigo` varchar(35) NOT NULL,
  `data` date NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS emails;

CREATE TABLE `emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(75) DEFAULT NULL,
  `email` varchar(75) NOT NULL,
  `ativo` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

INSERT INTO emails VALUES("1","Marley Junior Aparecido","paiva.s2.paula@hotmail.com","Sim");
INSERT INTO emails VALUES("3","Marley Junior","admin@gmail.com","Não");
INSERT INTO emails VALUES("4","cadada","jj@gmail.com","Sim");
INSERT INTO emails VALUES("5","Marley Junior","ped@hotmail.com","Sim");
INSERT INTO emails VALUES("6","Marley Junior Aparecido","ped2@hotmail.com","Sim");
INSERT INTO emails VALUES("7","Miséria","ped3@hotmail.com","Sim");
INSERT INTO emails VALUES("8","aadadad","afafafa@mgail.com","Não");
INSERT INTO emails VALUES("9","Marcelo Madureira","madureira@gmail.com","Sim");
INSERT INTO emails VALUES("11","Mardoque","mardoqueu@gmail.com","Não");
INSERT INTO emails VALUES("12","Adamastor Pereira","pereira@gmail.com","Sim");


DROP TABLE IF EXISTS envios_email;

CREATE TABLE `envios_email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` datetime NOT NULL,
  `final` int(11) NOT NULL,
  `assunto` varchar(100) NOT NULL,
  `mensagem` varchar(1000) NOT NULL,
  `link` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO envios_email VALUES("1","2022-09-27 18:46:22",NULL,"Lascado!"," Son of a biti","produto-pao-de-mel-com-chocolate");


DROP TABLE IF EXISTS imagens;

CREATE TABLE `imagens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produto` int(11) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

INSERT INTO imagens VALUES("4","4","cat-1.jpg");
INSERT INTO imagens VALUES("9","2","20220719_171856.jpg");
INSERT INTO imagens VALUES("10","2","01.jpg");


DROP TABLE IF EXISTS mensagens;

CREATE TABLE `mensagens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_venda` int(11) NOT NULL,
  `mensagem` varchar(1000) NOT NULL,
  `usuario` varchar(25) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

INSERT INTO mensagens VALUES("5","67","Mensagem Admin","Admin","2022-09-09","00:00:00");
INSERT INTO mensagens VALUES("6","67","Mensagem Cliente","Cliente","2022-09-09","00:00:00");
INSERT INTO mensagens VALUES("28","67","Outra mensagem do cliente","Admin","2022-09-09","00:00:00");
INSERT INTO mensagens VALUES("29","71","Mensagem do Admin","Admin","2022-09-09","00:00:00");
INSERT INTO mensagens VALUES("30","71","Mensagem do cliente na id_venda = 71","Cliente","2022-09-09","00:00:00");
INSERT INTO mensagens VALUES("31","71","Administrador respondendo","Admin","2022-09-09","07:20:45");
INSERT INTO mensagens VALUES("32","71","Administrador respondendo denovo","Admin","2022-09-09","07:21:17");
INSERT INTO mensagens VALUES("33","71","Cliente faz outra pergunta no id_venda = 71","Cliente","2022-09-09","00:00:00");
INSERT INTO mensagens VALUES("34","67","Seu pedido foi enviado, o código de postagem é JB24252252BAZ","Admin","2022-09-09","08:25:36");
INSERT INTO mensagens VALUES("35","67","Mudança de status no pedido, pedido Disponivel","Admin","2022-09-09","08:25:58");
INSERT INTO mensagens VALUES("36","67","Mudança de status no pedido, pedido Entregue","Admin","2022-09-09","08:27:31");
INSERT INTO mensagens VALUES("37","74","Parabéns, você ganhou um novo cupom de desconto no valor de 20 reais, poderá usar até o dia 16/09/2022 o seu código para uso do cupom é 919.191.991-15","Admin","2022-09-09","12:22:06");
INSERT INTO mensagens VALUES("38","83","Parabéns, você ganhou um novo cupom de desconto no valor de 20 reais, poderá usar até o dia 19/09/2022. O seu código para uso do cupom é 919.191.991-15","Admin","2022-09-12","09:38:56");
INSERT INTO mensagens VALUES("39","99","Mudança de status no pedido, pedido Retirada","Admin","2022-09-13","19:06:28");


DROP TABLE IF EXISTS prod_combos;

CREATE TABLE `prod_combos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produto` int(11) NOT NULL,
  `id_combo` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

INSERT INTO prod_combos VALUES("32","2","8");
INSERT INTO prod_combos VALUES("33","3","8");
INSERT INTO prod_combos VALUES("34","7","7");
INSERT INTO prod_combos VALUES("35","9","9");
INSERT INTO prod_combos VALUES("36","7","9");


DROP TABLE IF EXISTS produtos;

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) NOT NULL,
  `id_subcategoria` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `nome_url` varchar(100) NOT NULL,
  `descricao` varchar(1000) DEFAULT NULL,
  `descricao_longa` text DEFAULT NULL,
  `valor` decimal(10,2) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  `estoque` int(11) DEFAULT NULL,
  `tipo_envio` int(11) NOT NULL,
  `palavras` varchar(250) DEFAULT NULL,
  `ativo` varchar(5) NOT NULL,
  `peso` double(8,2) DEFAULT NULL,
  `largura` int(11) DEFAULT NULL,
  `altura` int(11) DEFAULT NULL,
  `comprimento` int(11) DEFAULT NULL,
  `modelo` varchar(100) DEFAULT NULL,
  `valor_frete` decimal(8,2) DEFAULT NULL,
  `promocao` varchar(5) DEFAULT NULL,
  `vendas` int(11) DEFAULT NULL,
  `link` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

INSERT INTO produtos VALUES("2","8","6","Pão de Mel com Chocolate","pao-de-mel-com-chocolate","Descrição do Pão de Mel Com Chocolate","Comida de doce","53.45","doces-coloridos.jpg","44","1","pão de mel doce, pão de mel gostoso, comprar pão de mel","Sim","0.20","32","12","24","doce","32.00","Sim","19","http://www.casadopaodemel.com.br");
INSERT INTO produtos VALUES("3","8","3","Pintinho de namquim do Grosso","pintinho-de-namquim-do-grosso",NULL,NULL,"23.99","sem-foto.jpg","1","3",NULL,"Sim","1.00",NULL,NULL,NULL,NULL,"0.00","Sim",NULL,NULL);
INSERT INTO produtos VALUES("4","1","3","ffsfs","ffsfs",NULL,NULL,"100.00","sem-foto.jpg","5","2",NULL,"Não","0.00",NULL,NULL,NULL,NULL,"5.00","Não","3",NULL);
INSERT INTO produtos VALUES("6","9","4","teste produto novo","teste-produto-novo",NULL,NULL,"49.00","sem-foto.jpg","1","1",NULL,"Não","0.00",NULL,NULL,NULL,NULL,"0.00","Não",NULL,NULL);
INSERT INTO produtos VALUES("7","9","3","produto teste promoção","produto-teste-promocao",NULL,NULL,"99.99","sem-foto.jpg","5","2",NULL,"Sim","0.00",NULL,NULL,NULL,NULL,"15.00","Não","3",NULL);
INSERT INTO produtos VALUES("8","1","3","x9","x9",NULL,NULL,"32.00","sem-foto.jpg","5","1","testando","Sim","0.00",NULL,NULL,NULL,NULL,"0.00","Sim",NULL,NULL);
INSERT INTO produtos VALUES("9","1","3","x91","x91",NULL,NULL,"13.50","sem-foto.jpg","5","1",NULL,"Sim","0.00",NULL,NULL,NULL,NULL,"0.00","Não",NULL,NULL);
INSERT INTO produtos VALUES("13","1","3","424qrsfsfsfs","424qrsfsfsfs",NULL,NULL,"42.00","buzanga.jpg","5","1",NULL,"Sim","0.50",NULL,NULL,NULL,NULL,"0.00","Sim","12",NULL);
INSERT INTO produtos VALUES("15","1","3","affafarrr5tet2242","affafarrr5tet2242",NULL,NULL,"67.00","sem-foto.jpg","5","1",NULL,"Sim","0.00",NULL,NULL,NULL,NULL,"0.00","Não","9",NULL);
INSERT INTO produtos VALUES("17","8","4","teste do dia 13 do 09","teste-do-dia-13-do-09","aqui a descrição curta","aqui a descrição longa","49.90","sem-foto.jpg","8","4","teste, setembro","Sim","0.00",NULL,NULL,NULL,NULL,"0.00","Não","4","http://setembroamarelo.com.br");


DROP TABLE IF EXISTS promocoes;

CREATE TABLE `promocoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produto` int(11) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_final` date NOT NULL,
  `ativo` varchar(5) NOT NULL,
  `desconto` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

INSERT INTO promocoes VALUES("31","13","21.00","2022-08-23","2022-08-23","Sim","50");
INSERT INTO promocoes VALUES("32","2","37.42","2022-08-24","2022-08-24","Sim","30");
INSERT INTO promocoes VALUES("33","3","21.59","2022-08-24","2022-08-24","Sim","10");
INSERT INTO promocoes VALUES("34","8","19.20","2022-08-25","2022-08-25","Sim","40");


DROP TABLE IF EXISTS promocoes_banner;

CREATE TABLE `promocoes_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) NOT NULL,
  `link` varchar(100) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  `ativo` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO promocoes_banner VALUES("2","Cuzero Lindo","cruzeiro-lindo","banner-2.jpg","Sim");
INSERT INTO promocoes_banner VALUES("4","Segunda Promoção","cuzero-porco","banner-1.jpg","Sim");
INSERT INTO promocoes_banner VALUES("5","bolsecudo","cuzero-master","banner-promo.jpg","Não");


DROP TABLE IF EXISTS subcategorias;

CREATE TABLE `subcategorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `nome_url` varchar(50) NOT NULL,
  `imagem` varchar(150) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO subcategorias VALUES("1","tênis","tenis","cat-6.jpg","2");
INSERT INTO subcategorias VALUES("2","tênis 2","tenis-2","cat-5.jpg","8");
INSERT INTO subcategorias VALUES("3","dindu","dindu","sem-foto.jpg","1");
INSERT INTO subcategorias VALUES("4","deido","deido","garrafa-de-cerveja-pequena-à-disposição-92840768.jpg","8");
INSERT INTO subcategorias VALUES("6","bund","bund","sem-foto.jpg","8");


DROP TABLE IF EXISTS tipo_envios;

CREATE TABLE `tipo_envios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO tipo_envios VALUES("1","correios");
INSERT INTO tipo_envios VALUES("2","fixo");
INSERT INTO tipo_envios VALUES("3","sem frete");
INSERT INTO tipo_envios VALUES("4","digital");


DROP TABLE IF EXISTS usuarios;

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(75) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(25) NOT NULL,
  `senha_crip` varchar(150) NOT NULL,
  `nivel` varchar(20) NOT NULL,
  `data_cad` date NOT NULL,
  `imagem` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

INSERT INTO usuarios VALUES("6","Admin Novo Teste Agora","000.000.000-00","danielantunespaiva@gmail.com","123","202cb962ac59075b964b07152d234b70","Administrador","2022-08-08","buzanga.jpg");
INSERT INTO usuarios VALUES("15","Marcelo Madureira","103.931.093-10","madureira@gmail.com","123","202cb962ac59075b964b07152d234b70","Cliente","2022-08-08",NULL);
INSERT INTO usuarios VALUES("16","Mardoque","111.111.111-11","mardoqueu@gmail.com","123","202cb962ac59075b964b07152d234b70","Cliente","2022-08-08",NULL);
INSERT INTO usuarios VALUES("18","Adamastor Pereira Maluco Beleza","919.191.991-15","pereira@gmail.com","123","202cb962ac59075b964b07152d234b70","Cliente","2022-08-08",NULL);


DROP TABLE IF EXISTS vendas;

CREATE TABLE `vendas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `total` decimal(8,2) NOT NULL,
  `frete` decimal(8,2) NOT NULL,
  `subtotal` decimal(8,2) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `data` date NOT NULL,
  `pago` varchar(5) NOT NULL,
  `status` varchar(35) NOT NULL,
  `rastreio` varchar(35) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8;

INSERT INTO vendas VALUES("88","42.00","0.00","0.00","18","2022-09-12","Sim","Não Enviado",NULL);
INSERT INTO vendas VALUES("89","42.00","0.00","0.00","18","2022-09-12","Sim","Não Enviado",NULL);
INSERT INTO vendas VALUES("90","114.00","0.00","0.00","18","2022-09-12","Sim","Não Enviado",NULL);
INSERT INTO vendas VALUES("91","105.00","0.00","0.00","18","2022-09-12","Não","Não Enviado",NULL);
INSERT INTO vendas VALUES("92","270.00","0.00","0.00","18","2022-09-13","Não","Não Enviado",NULL);
INSERT INTO vendas VALUES("93","164.00","0.00","0.00","18","2022-09-13","Sim","Não Enviado",NULL);
INSERT INTO vendas VALUES("94","164.00","0.00","0.00","18","2022-09-13","Sim","Não Enviado",NULL);
INSERT INTO vendas VALUES("95","49.00","0.00","0.00","18","2022-09-13","Sim","Não Enviado",NULL);
INSERT INTO vendas VALUES("96","49.00","0.00","0.00","18","2022-09-13","Sim","Não Enviado",NULL);
INSERT INTO vendas VALUES("97","49.00","0.00","0.00","18","2022-09-13","Não","Não Enviado",NULL);
INSERT INTO vendas VALUES("98","32.00","0.00","0.00","18","2022-09-13","Não","Não Enviado",NULL);
INSERT INTO vendas VALUES("99","87.00","0.00","0.00","18","2022-09-13","Não","Retirada",NULL);
INSERT INTO vendas VALUES("100","37.00","0.00","0.00","18","2022-09-13","Sim","Retirada",NULL);
INSERT INTO vendas VALUES("101","32.00","0.00","0.00","18","2022-09-14","Sim","Retirada",NULL);


