README
====

Legrand Thomas, Padiolleau Rémi, Voyag’INT

Le cahier des charges a été suivi, et chaque partie est fonctionnelle.

# Compte utilisateurs:
Admin : anna_admin
User :  Login: titi Password: titi

# Routes utilisables:
##Front-end:
@Route("/", name="homepage")
@Route("/contact", name="contact")
@Route("/circuit", name="circuit_index")
@Route("/circuit/{id}", name="circuit_show »)
@Route(« /login », name=« login »)
@Route(« /profile/edit », name=« edit_profile »)
@Route(« /logout », name=« logout »)

##Back-end:
@Route(« /register », name=« register »)
@Route("/circuit/new", name="circuit_new")
@Route("/circuit/{id}/edit", name="circuit_edit")
@Route("/circuit/{id}/delete", name="circuit_delete")
@Route("/circuit/{id}/etape/new", name="etape_new")
@Route("/circuit/{id}/etape/{etapeid}/edit", name="etape_edit")
@Route("/circuit/{id}/etape/{etapeid}/delete", name="etape_delete")
@Route("/circuit/{id}/prog/new", name="prog_new")
@Route("/circuit/{id}/prog/{progid}/edit", name="prog_edit")
@Route("/circuit/{id}/prog/{progid}/delete", name="prog_delete")

# Commentaires
A priori tout fonctionne sous Firefox.
Voyagez loin, voyagez bien, Voyag’INT.

