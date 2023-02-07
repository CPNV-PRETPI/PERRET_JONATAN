## L'utilisateurs peut se conecter via la vue de login avec sa security string

## Use case diagram

## UserStory 1

#### As

a member

#### I want

to login

#### In order to

access the app

### Test d'acceptation 1

#### Given

le champ de security string est rempli avec une security string valide

#### When

j'appuie sur le bouton de login

#### Then

je suis connecté et j'accède à l'application

### Test d'acceptation 2

#### Given

le champ de security string est rempli avec une security string invalide

#### When

j'appuie sur le bouton de login

#### Then

je suis rejeté et un message d'erreur s'affiche
