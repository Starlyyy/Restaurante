create table mesa(
    id_mesa int primary key AUTO_INCREMENT,
    capacidade int(2) not null
);

create table comida(
    id_comida int primary key AUTO_INCREMENT,
    nome varchar(200) not null,
    descricao varchar(500) not null,
    preco decimal(7,2) not null
);

create table bebida(
    id_bebida int primary key AUTO_INCREMENT,
    nome varchar(200) not null,
    alcoolica char(1) not null,
    preco decimal(7,2) not null,

    constraint chk_bebida check (alcoolica in ('S','N'))
);

create table pedido(
    id_pedido int primary key AUTO_INCREMENT,
    id_mesa int not null,
    id_comida int,
    id_bebida int,
    total decimal(8,2) not null,

    foreign key (id_mesa) references mesa(id_mesa),
    foreign key (id_comida) references comida(id_comida),
    foreign key (id_bebida) references bebida(id_bebida),

    constraint chk_bebidaComida check (not(id_bebida is null and id_comida is null))
);

-- Mesas
insert into mesa (capacidade) values
(2),(2),(2),(2),(2),(2),(2),(2),(2),(2),(2),(2),
(4),(4),(4),(4),(4),(4),(4),(4),
(8),(8),(8),(8);

-- Comidas
insert into comida (nome, descricao, preco) values
("Gratinado de frango","Frango cozido no forno com um molho cremoso e uma camada de queijo derretido por cima, que o deixa muito mais saboroso.",30.95),
("Estrongondofe de frango","Criado originalmente na Rússia, mas nada se compara a sua versão mais gostosa. A combinação da carne de frango suculenta com o molho cremoso deixa qualquer um salivando só de pensar.",21.00),
("Macarrão ao molho branco divino","Sirva este molho branco cremoso e suave sobre o macarrão e cada garfada será uma explosão de sabores que eleva o prato a outro patamar!",29.90),
("Purê de grilo frito","Cremoso, crocante e cheio de proteínas saltitantes!",22.39),
("Farofa de smenete de bacuri","Um sabor que desafia a razão, cheia de personalidade",13.55),
("Pizza de calabresa plus","Esta pizza simples une praticidade e sabor, oferece uma textura macia e sensações de sobra a cada mordida.",24.90),
("Croquete de rabo de cururu","Delicado, crocante e de textura rústica, com interior untuoso e notas minerais sutis. Inspirado na culinária ancestral ribeirinha.",10.99),
("Panqueca de carne moída premium","Massa deliciosa e um recheio suculento: a receita para uma refeição maravilhosa!",17.90),
("Pão com mortadela gourmet","Não é à toa que esse sanduíche de mortadela faz o maior sucesso, né? Simples à primeira vista, ganhou fama graças à sua versão turbinada no OverCozido.",15.00),
("O pão que Deus endireitou","Enquanto muitos dizem estar comendo o pão que o diabo amassou, a massa fofinha desse encherá seu coração de esperança num mundo melhor!",9.15),
("Cuscuz de uva peba","Roxo, encorpado, polpa rebelde, uma combinação inesquecível.",16.00),
("Rizzotto de maçã-anã","Cremosidade frutada com um sotaque roceiro.",19.85),
("Morango da tentação","Uma sobremesa tão deliciosa que reacenderá a paixão na sua relação!",47.99),
("Pavê de Mexironga Alienígena","Doce e cítrico, feito com uma fruta exotérica cujo nem os cientistas sabem se é uma mexirica ou uma laranja.",11.20),
("Bolinho tempestade","Uma versão do bolinho de chuva, mas dedicado às pessoas intensas.",6.00),
("Bolo prestigiado","Sabor imponente e transformador. Uma mordida e já poderá sentir valor sociocultural sendo agregado.",12.90),
("Bolo de fubá da vó Maria","Fofinho, saboroso e com um retrogosto de nostalgia. Uma grande viagem às boas lembranças do passado!",8.50);

-- Bebidas
insert into bebida (nome, alcoolica, preco) values
("Limonada suíça","N",6.50),
("Nevasca","S",11.00),
("Suco de milho amarelo","N",7.50),
("Beijo na boca","S",14.50),
("Batida de coco","N",8.00),
("Hidromel","S",16.90),
("Achocolatado emperiquitado","N",10.00),
("Quentinho","S",7.00),
("Bomba de capuccino","N",12.50),
("Tônico de Cajá","S",14.25),
("Chá de semente de seriguela","N",6.80),
("Fermentado de abiu ferido","S",14.20),
("Garapa de pinha de quintal","N",9.89),
("Choconhaque","S",15.99);
