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
Un invité doit demander un droit d'inscription à l'administrateur. Un utilisateur enregistré peut visualiser les produits, son panier, ainsi que sa facture. L'administrateur peut modifier les produits.

### Fonctionnalités
| Guest | User | Admin |
| ----- | ---- | ----- |
| Accès à l'accueil, à la connexion et à la demande d'inscription | En plus des droits **Guest**, accès aux articles et la visualisation d'un article et au panier et sa validation | En plus des droits **User**, accès à l'ajout, modification et suppression d'un article ainsi que l'ajout d'un user |


### technologies
- PHP procédural
- PDO
