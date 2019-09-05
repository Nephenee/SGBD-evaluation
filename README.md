# SGBD-evaluation


## Base de données

### table users
| Colonne | Specificités |
| ------- | ------------ |
| user_id | clé primaire - int(11) IA |
| role_id | clé étrangère - int(11) |
| email | varchar(255) |
| password | varchar(255) |
| firstname | varchar(255) |
| lastname | varchar(255) |
| adress | varchar(255) |
| lastbill | clé étrangère - int(11) |

### table roles
| Colonne | Specificités |
| ------- | ------------ |
| role_id | clé primaire -  int(11) IA |
| role | varchar(255) |

### table products
| Colonne | Specificités |
| ------- | ------------ |
| product_id | clé primaire - int(11) IA |
| name | varchar(255) |
| description | text NULL |
| created | timestamp [CURRENT_TIMESTAMP] |
| image | varchar(255) NULL |
| price | decimal(6,2) [0.00] |

### table bills
| Colonne | Specificités |
| ------- | ------------ |
| bill_id | clé primaire - int(11) IA |
| user_id | clé étrangère - int(11) |
| created | timestamp [CURRENT_TIMESTAMP] |
| price | decimal(6,2) [0.00] |
| adress | varchar(255) - [5 place Charles Hernu, 69100 VILLEURBANNE] |

### table bill_lines
| Colonne | Specificités |
| ------- | ------------ |
| line_id | clé primaire - int(11) IA |
| bill_id | clé étrangère - int(11) |
| product_id | clé étrangère - int(11) |
| quantity | int(11) |
| price | decimal(6,2) [0.00] |
----

## Vagrant

### Spécificités
```sh
Ubuntu/xenial64
private_network : 192.168.33.10
synced_folder : "../DFS15_SGBD_evaluation", "/var/www/html"
```

### Installation
- php 7.3
- mysql 5.7.27
- apache2 2.4.18
- adminer 4.7.3
----

## Projet

### Sujet
*AroBioHuiles* est un site d'e-commerce qui permet l'achat d'huiles essentielles bio.
Un invité ne peut s'enregistrer : seul l'administrateur peut ajouter un utilisateur. Un utilisateur enregistré peut visualiser les produits, son panier, ainsi que sa facture. L'administrateur peut modifier les produits.

### Fonctionnalités
| Guest | User | Admin |
| ----- | ---- | ----- |
| Accès à l'accueil, à la connexion et à la demande d'inscription | En plus des droits **Guest**, accès aux articles et la visualisation d'un article et au panier et sa validation | En plus des droits **User**, accès à l'ajout, modification et suppression d'un article ainsi que l'ajout d'un user |


### technologies / langages
- PHP procédural
- PDO
- triggers

### trigger
Actualisation de la colonne *lastbill* dans la table *users* lorsqu'une facture est créée : lors d'une insertion dans la table *bills*
```mysql
CREATE TRIGGER bills_ai
AFTER INSERT
ON bills FOR EACH ROW
BEGIN
    UPDATE users
    SET users.lastbill = NEW.bill_id
    WHERE users.user_id = NEW.user_id
END |
DELIMITER ;
```