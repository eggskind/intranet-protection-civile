# Routing

### Configuration

Allez dans le fichier **config/routing.json**

Vous y trouverez un tableau de défintion de route.
    
    {
        "ma-route" : 
        {
            "path" : "/mon-url"
        }
    }

### Comment inserer un lien dans une page ?

Pour cela il faut le générer, assurez vous que cette page soit déclarer dans le fichier **config/routing.json**.

Si celle-ci n'est pas encore présente, déclarer la dans ce fichier.

Ensuite depuis votre page php généré la de cette facon 
    
    <a href='<?php echo lib\routing\routing_generate('ma-route'); ?>'>
    
### Comment changer l'url d'une page ?

Assurez vous que cette page soit déclarer dans le fichier **config/routing.json**.

Si celle-ci n'est pas encore présente, déclarer la dans ce fichier.

Ensuite changer l'attribut path et ajouter l'attribut php_file s'il n'est pas présent.

    {
        "ma-route" : 
        {
            "path" : "/ma-nouvelle-url",
            "php_file" : "mon-fichier.php"
        }
    }